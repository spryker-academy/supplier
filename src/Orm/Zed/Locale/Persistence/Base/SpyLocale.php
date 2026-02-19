<?php

namespace Orm\Zed\Locale\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery;
use Orm\Zed\AvailabilityNotification\Persistence\Base\SpyAvailabilityNotificationSubscription as BaseSpyAvailabilityNotificationSubscription;
use Orm\Zed\AvailabilityNotification\Persistence\Map\SpyAvailabilityNotificationSubscriptionTableMap;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery;
use Orm\Zed\CategoryImage\Persistence\Base\SpyCategoryImageSet as BaseSpyCategoryImageSet;
use Orm\Zed\CategoryImage\Persistence\Map\SpyCategoryImageSetTableMap;
use Orm\Zed\Category\Persistence\SpyCategoryAttribute;
use Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery;
use Orm\Zed\Category\Persistence\Base\SpyCategoryAttribute as BaseSpyCategoryAttribute;
use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery;
use Orm\Zed\Cms\Persistence\Base\SpyCmsPageLocalizedAttributes as BaseSpyCmsPageLocalizedAttributes;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageLocalizedAttributesTableMap;
use Orm\Zed\Content\Persistence\SpyContentLocalized;
use Orm\Zed\Content\Persistence\SpyContentLocalizedQuery;
use Orm\Zed\Content\Persistence\Base\SpyContentLocalized as BaseSpyContentLocalized;
use Orm\Zed\Content\Persistence\Map\SpyContentLocalizedTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Base\SpyCustomer as BaseSpyCustomer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery;
use Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery;
use Orm\Zed\FileManager\Persistence\Base\SpyFileDirectoryLocalizedAttributes as BaseSpyFileDirectoryLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\Base\SpyFileLocalizedAttributes as BaseSpyFileLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\Map\SpyFileDirectoryLocalizedAttributesTableMap;
use Orm\Zed\FileManager\Persistence\Map\SpyFileLocalizedAttributesTableMap;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery;
use Orm\Zed\Glossary\Persistence\Base\SpyGlossaryTranslation as BaseSpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\Map\SpyGlossaryTranslationTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale as ChildSpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery as ChildSpyLocaleQuery;
use Orm\Zed\Locale\Persistence\SpyLocaleStore as ChildSpyLocaleStore;
use Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery as ChildSpyLocaleStoreQuery;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleStoreTableMap;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery;
use Orm\Zed\Navigation\Persistence\Base\SpyNavigationNodeLocalizedAttributes as BaseSpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\Map\SpyNavigationNodeLocalizedAttributesTableMap;
use Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation;
use Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery;
use Orm\Zed\ProductAttribute\Persistence\Base\SpyProductManagementAttributeValueTranslation as BaseSpyProductManagementAttributeValueTranslation;
use Orm\Zed\ProductAttribute\Persistence\Map\SpyProductManagementAttributeValueTranslationTableMap;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery;
use Orm\Zed\ProductDiscontinued\Persistence\Base\SpyProductDiscontinuedNote as BaseSpyProductDiscontinuedNote;
use Orm\Zed\ProductDiscontinued\Persistence\Map\SpyProductDiscontinuedNoteTableMap;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\Base\SpyProductImageSet as BaseSpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetTableMap;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery;
use Orm\Zed\ProductLabel\Persistence\Base\SpyProductLabelLocalizedAttributes as BaseSpyProductLabelLocalizedAttributes;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelLocalizedAttributesTableMap;
use Orm\Zed\ProductReview\Persistence\SpyProductReview;
use Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery;
use Orm\Zed\ProductReview\Persistence\Base\SpyProductReview as BaseSpyProductReview;
use Orm\Zed\ProductReview\Persistence\Map\SpyProductReviewTableMap;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearch;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery;
use Orm\Zed\ProductSearch\Persistence\Base\SpyProductSearch as BaseSpyProductSearch;
use Orm\Zed\ProductSearch\Persistence\Map\SpyProductSearchTableMap;
use Orm\Zed\ProductSet\Persistence\SpyProductSetData;
use Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery;
use Orm\Zed\ProductSet\Persistence\Base\SpyProductSetData as BaseSpyProductSetData;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductSetDataTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\Base\SpyProductAbstractLocalizedAttributes as BaseSpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\Base\SpyProductLocalizedAttributes as BaseSpyProductLocalizedAttributes;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractLocalizedAttributesTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductLocalizedAttributesTableMap;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrder as BaseSpySalesOrder;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Orm\Zed\Store\Persistence\Base\SpyStore as BaseSpyStore;
use Orm\Zed\Store\Persistence\Map\SpyStoreTableMap;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchSearchQuery;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
use Orm\Zed\Touch\Persistence\SpyTouchStorageQuery;
use Orm\Zed\Touch\Persistence\Base\SpyTouchSearch as BaseSpyTouchSearch;
use Orm\Zed\Touch\Persistence\Base\SpyTouchStorage as BaseSpyTouchStorage;
use Orm\Zed\Touch\Persistence\Map\SpyTouchSearchTableMap;
use Orm\Zed\Touch\Persistence\Map\SpyTouchStorageTableMap;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\Url\Persistence\Base\SpyUrl as BaseSpyUrl;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
use Orm\Zed\User\Persistence\SpyUser;
use Orm\Zed\User\Persistence\SpyUserQuery;
use Orm\Zed\User\Persistence\Base\SpyUser as BaseSpyUser;
use Orm\Zed\User\Persistence\Map\SpyUserTableMap;
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
 * Base class that represents a row from the 'spy_locale' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Locale.Persistence.Base
 */
abstract class SpyLocale implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Locale\\Persistence\\Map\\SpyLocaleTableMap';


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
     * The value for the id_locale field.
     *
     * @var        int
     */
    protected $id_locale;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the locale_name field.
     * The name of a locale, such as "en_US" or "de_DE".
     * @var        string
     */
    protected $locale_name;

    /**
     * @var        ObjectCollection|SpyAvailabilityNotificationSubscription[] Collection to store aggregation of SpyAvailabilityNotificationSubscription objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription> Collection to store aggregation of SpyAvailabilityNotificationSubscription objects.
     */
    protected $collSpyAvailabilityNotificationSubscriptions;
    protected $collSpyAvailabilityNotificationSubscriptionsPartial;

    /**
     * @var        ObjectCollection|SpyCategoryAttribute[] Collection to store aggregation of SpyCategoryAttribute objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryAttribute> Collection to store aggregation of SpyCategoryAttribute objects.
     */
    protected $collSpyCategoryAttributes;
    protected $collSpyCategoryAttributesPartial;

    /**
     * @var        ObjectCollection|SpyCategoryImageSet[] Collection to store aggregation of SpyCategoryImageSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryImageSet> Collection to store aggregation of SpyCategoryImageSet objects.
     */
    protected $collSpyCategoryImageSets;
    protected $collSpyCategoryImageSetsPartial;

    /**
     * @var        ObjectCollection|SpyCmsPageLocalizedAttributes[] Collection to store aggregation of SpyCmsPageLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsPageLocalizedAttributes> Collection to store aggregation of SpyCmsPageLocalizedAttributes objects.
     */
    protected $collSpyCmsPageLocalizedAttributess;
    protected $collSpyCmsPageLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyContentLocalized[] Collection to store aggregation of SpyContentLocalized objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyContentLocalized> Collection to store aggregation of SpyContentLocalized objects.
     */
    protected $collSpyContentLocalizeds;
    protected $collSpyContentLocalizedsPartial;

    /**
     * @var        ObjectCollection|SpyCustomer[] Collection to store aggregation of SpyCustomer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomer> Collection to store aggregation of SpyCustomer objects.
     */
    protected $collSpyCustomers;
    protected $collSpyCustomersPartial;

    /**
     * @var        ObjectCollection|SpyFileLocalizedAttributes[] Collection to store aggregation of SpyFileLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyFileLocalizedAttributes> Collection to store aggregation of SpyFileLocalizedAttributes objects.
     */
    protected $collSpyFileLocalizedAttributess;
    protected $collSpyFileLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyFileDirectoryLocalizedAttributes[] Collection to store aggregation of SpyFileDirectoryLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyFileDirectoryLocalizedAttributes> Collection to store aggregation of SpyFileDirectoryLocalizedAttributes objects.
     */
    protected $collSpyFileDirectoryLocalizedAttributess;
    protected $collSpyFileDirectoryLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyGlossaryTranslation[] Collection to store aggregation of SpyGlossaryTranslation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyGlossaryTranslation> Collection to store aggregation of SpyGlossaryTranslation objects.
     */
    protected $collSpyGlossaryTranslations;
    protected $collSpyGlossaryTranslationsPartial;

    /**
     * @var        ObjectCollection|ChildSpyLocaleStore[] Collection to store aggregation of ChildSpyLocaleStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyLocaleStore> Collection to store aggregation of ChildSpyLocaleStore objects.
     */
    protected $collLocaleStores;
    protected $collLocaleStoresPartial;

    /**
     * @var        ObjectCollection|SpyNavigationNodeLocalizedAttributes[] Collection to store aggregation of SpyNavigationNodeLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyNavigationNodeLocalizedAttributes> Collection to store aggregation of SpyNavigationNodeLocalizedAttributes objects.
     */
    protected $collSpyNavigationNodeLocalizedAttributess;
    protected $collSpyNavigationNodeLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstractLocalizedAttributes[] Collection to store aggregation of SpyProductAbstractLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractLocalizedAttributes> Collection to store aggregation of SpyProductAbstractLocalizedAttributes objects.
     */
    protected $collSpyProductAbstractLocalizedAttributess;
    protected $collSpyProductAbstractLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyProductLocalizedAttributes[] Collection to store aggregation of SpyProductLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLocalizedAttributes> Collection to store aggregation of SpyProductLocalizedAttributes objects.
     */
    protected $collSpyProductLocalizedAttributess;
    protected $collSpyProductLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyProductManagementAttributeValueTranslation[] Collection to store aggregation of SpyProductManagementAttributeValueTranslation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductManagementAttributeValueTranslation> Collection to store aggregation of SpyProductManagementAttributeValueTranslation objects.
     */
    protected $collSpyProductManagementAttributeValueTranslations;
    protected $collSpyProductManagementAttributeValueTranslationsPartial;

    /**
     * @var        ObjectCollection|SpyProductDiscontinuedNote[] Collection to store aggregation of SpyProductDiscontinuedNote objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductDiscontinuedNote> Collection to store aggregation of SpyProductDiscontinuedNote objects.
     */
    protected $collSpyProductDiscontinuedNotes;
    protected $collSpyProductDiscontinuedNotesPartial;

    /**
     * @var        ObjectCollection|SpyProductImageSet[] Collection to store aggregation of SpyProductImageSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet> Collection to store aggregation of SpyProductImageSet objects.
     */
    protected $collSpyProductImageSets;
    protected $collSpyProductImageSetsPartial;

    /**
     * @var        ObjectCollection|SpyProductLabelLocalizedAttributes[] Collection to store aggregation of SpyProductLabelLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelLocalizedAttributes> Collection to store aggregation of SpyProductLabelLocalizedAttributes objects.
     */
    protected $collSpyProductLabelLocalizedAttributess;
    protected $collSpyProductLabelLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpyProductReview[] Collection to store aggregation of SpyProductReview objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductReview> Collection to store aggregation of SpyProductReview objects.
     */
    protected $collSpyProductReviews;
    protected $collSpyProductReviewsPartial;

    /**
     * @var        ObjectCollection|SpyProductSearch[] Collection to store aggregation of SpyProductSearch objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearch> Collection to store aggregation of SpyProductSearch objects.
     */
    protected $collSpyProductSearches;
    protected $collSpyProductSearchesPartial;

    /**
     * @var        ObjectCollection|SpyProductSetData[] Collection to store aggregation of SpyProductSetData objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSetData> Collection to store aggregation of SpyProductSetData objects.
     */
    protected $collSpyProductSetDatas;
    protected $collSpyProductSetDatasPartial;

    /**
     * @var        ObjectCollection|SpySalesOrder[] Collection to store aggregation of SpySalesOrder objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrder> Collection to store aggregation of SpySalesOrder objects.
     */
    protected $collSpySalesOrders;
    protected $collSpySalesOrdersPartial;

    /**
     * @var        ObjectCollection|SpyStore[] Collection to store aggregation of SpyStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStore> Collection to store aggregation of SpyStore objects.
     */
    protected $collStoreDefaults;
    protected $collStoreDefaultsPartial;

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
     * @var        ObjectCollection|SpyUrl[] Collection to store aggregation of SpyUrl objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl> Collection to store aggregation of SpyUrl objects.
     */
    protected $collSpyUrls;
    protected $collSpyUrlsPartial;

    /**
     * @var        ObjectCollection|SpyUser[] Collection to store aggregation of SpyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUser> Collection to store aggregation of SpyUser objects.
     */
    protected $collSpyUsers;
    protected $collSpyUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAvailabilityNotificationSubscription[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription>
     */
    protected $spyAvailabilityNotificationSubscriptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCategoryAttribute[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryAttribute>
     */
    protected $spyCategoryAttributesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCategoryImageSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryImageSet>
     */
    protected $spyCategoryImageSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsPageLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsPageLocalizedAttributes>
     */
    protected $spyCmsPageLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyContentLocalized[]
     * @phpstan-var ObjectCollection&\Traversable<SpyContentLocalized>
     */
    protected $spyContentLocalizedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomer>
     */
    protected $spyCustomersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyFileLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyFileLocalizedAttributes>
     */
    protected $spyFileLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyFileDirectoryLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyFileDirectoryLocalizedAttributes>
     */
    protected $spyFileDirectoryLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyGlossaryTranslation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyGlossaryTranslation>
     */
    protected $spyGlossaryTranslationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyLocaleStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyLocaleStore>
     */
    protected $localeStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyNavigationNodeLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyNavigationNodeLocalizedAttributes>
     */
    protected $spyNavigationNodeLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstractLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractLocalizedAttributes>
     */
    protected $spyProductAbstractLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLocalizedAttributes>
     */
    protected $spyProductLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductManagementAttributeValueTranslation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductManagementAttributeValueTranslation>
     */
    protected $spyProductManagementAttributeValueTranslationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductDiscontinuedNote[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductDiscontinuedNote>
     */
    protected $spyProductDiscontinuedNotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductImageSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet>
     */
    protected $spyProductImageSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductLabelLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelLocalizedAttributes>
     */
    protected $spyProductLabelLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductReview[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductReview>
     */
    protected $spyProductReviewsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductSearch[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearch>
     */
    protected $spyProductSearchesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductSetData[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSetData>
     */
    protected $spyProductSetDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrder[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrder>
     */
    protected $spySalesOrdersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStore>
     */
    protected $storeDefaultsScheduledForDeletion = null;

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
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUrl[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl>
     */
    protected $spyUrlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUser>
     */
    protected $spyUsersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
    }

    /**
     * Initializes internal state of Orm\Zed\Locale\Persistence\Base\SpyLocale object.
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
     * Compares this with another <code>SpyLocale</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyLocale</code>, delegates to
     * <code>equals(SpyLocale)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_locale] column value.
     *
     * @return int
     */
    public function getIdLocale()
    {
        return $this->id_locale;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [locale_name] column value.
     * The name of a locale, such as "en_US" or "de_DE".
     * @return string
     */
    public function getLocaleName()
    {
        return $this->locale_name;
    }

    /**
     * Set the value of [id_locale] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdLocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_locale !== $v) {
            $this->id_locale = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_ID_LOCALE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A boolean flag indicating if an entity is currently active.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [locale_name] column.
     * The name of a locale, such as "en_US" or "de_DE".
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocaleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->locale_name !== $v) {
            $this->locale_name = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_LOCALE_NAME] = true;
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
            if ($this->is_active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyLocaleTableMap::translateFieldName('IdLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyLocaleTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyLocaleTableMap::translateFieldName('LocaleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locale_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyLocaleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyLocaleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyAvailabilityNotificationSubscriptions = null;

            $this->collSpyCategoryAttributes = null;

            $this->collSpyCategoryImageSets = null;

            $this->collSpyCmsPageLocalizedAttributess = null;

            $this->collSpyContentLocalizeds = null;

            $this->collSpyCustomers = null;

            $this->collSpyFileLocalizedAttributess = null;

            $this->collSpyFileDirectoryLocalizedAttributess = null;

            $this->collSpyGlossaryTranslations = null;

            $this->collLocaleStores = null;

            $this->collSpyNavigationNodeLocalizedAttributess = null;

            $this->collSpyProductAbstractLocalizedAttributess = null;

            $this->collSpyProductLocalizedAttributess = null;

            $this->collSpyProductManagementAttributeValueTranslations = null;

            $this->collSpyProductDiscontinuedNotes = null;

            $this->collSpyProductImageSets = null;

            $this->collSpyProductLabelLocalizedAttributess = null;

            $this->collSpyProductReviews = null;

            $this->collSpyProductSearches = null;

            $this->collSpyProductSetDatas = null;

            $this->collSpySalesOrders = null;

            $this->collStoreDefaults = null;

            $this->collTouchStorages = null;

            $this->collTouchSearches = null;

            $this->collSpyUrls = null;

            $this->collSpyUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyLocale::setDeleted()
     * @see SpyLocale::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyLocaleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                SpyLocaleTableMap::addInstanceToPool($this);
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

            if ($this->spyCategoryAttributesScheduledForDeletion !== null) {
                if (!$this->spyCategoryAttributesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery::create()
                        ->filterByPrimaryKeys($this->spyCategoryAttributesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCategoryAttributesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCategoryAttributes !== null) {
                foreach ($this->collSpyCategoryAttributes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCategoryImageSetsScheduledForDeletion !== null) {
                if (!$this->spyCategoryImageSetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCategoryImageSetsScheduledForDeletion as $spyCategoryImageSet) {
                        // need to save related object because we set the relation to null
                        $spyCategoryImageSet->save($con);
                    }
                    $this->spyCategoryImageSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCategoryImageSets !== null) {
                foreach ($this->collSpyCategoryImageSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsPageLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyCmsPageLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsPageLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsPageLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsPageLocalizedAttributess !== null) {
                foreach ($this->collSpyCmsPageLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyContentLocalizedsScheduledForDeletion !== null) {
                if (!$this->spyContentLocalizedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyContentLocalizedsScheduledForDeletion as $spyContentLocalized) {
                        // need to save related object because we set the relation to null
                        $spyContentLocalized->save($con);
                    }
                    $this->spyContentLocalizedsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyContentLocalizeds !== null) {
                foreach ($this->collSpyContentLocalizeds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCustomersScheduledForDeletion !== null) {
                if (!$this->spyCustomersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCustomersScheduledForDeletion as $spyCustomer) {
                        // need to save related object because we set the relation to null
                        $spyCustomer->save($con);
                    }
                    $this->spyCustomersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomers !== null) {
                foreach ($this->collSpyCustomers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyFileLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyFileLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyFileLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyFileLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyFileLocalizedAttributess !== null) {
                foreach ($this->collSpyFileLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyFileDirectoryLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyFileDirectoryLocalizedAttributess !== null) {
                foreach ($this->collSpyFileDirectoryLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyGlossaryTranslationsScheduledForDeletion !== null) {
                if (!$this->spyGlossaryTranslationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery::create()
                        ->filterByPrimaryKeys($this->spyGlossaryTranslationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyGlossaryTranslationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyGlossaryTranslations !== null) {
                foreach ($this->collSpyGlossaryTranslations as $referrerFK) {
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

            if ($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyNavigationNodeLocalizedAttributess !== null) {
                foreach ($this->collSpyNavigationNodeLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractLocalizedAttributess !== null) {
                foreach ($this->collSpyProductAbstractLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyProductLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyProductLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductLocalizedAttributess !== null) {
                foreach ($this->collSpyProductLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductManagementAttributeValueTranslationsScheduledForDeletion !== null) {
                if (!$this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery::create()
                        ->filterByPrimaryKeys($this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductManagementAttributeValueTranslations !== null) {
                foreach ($this->collSpyProductManagementAttributeValueTranslations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductDiscontinuedNotesScheduledForDeletion !== null) {
                if (!$this->spyProductDiscontinuedNotesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery::create()
                        ->filterByPrimaryKeys($this->spyProductDiscontinuedNotesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductDiscontinuedNotesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductDiscontinuedNotes !== null) {
                foreach ($this->collSpyProductDiscontinuedNotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductImageSetsScheduledForDeletion !== null) {
                if (!$this->spyProductImageSetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductImageSetsScheduledForDeletion as $spyProductImageSet) {
                        // need to save related object because we set the relation to null
                        $spyProductImageSet->save($con);
                    }
                    $this->spyProductImageSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductImageSets !== null) {
                foreach ($this->collSpyProductImageSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductLabelLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyProductLabelLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyProductLabelLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductLabelLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductLabelLocalizedAttributess !== null) {
                foreach ($this->collSpyProductLabelLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductReviewsScheduledForDeletion !== null) {
                if (!$this->spyProductReviewsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery::create()
                        ->filterByPrimaryKeys($this->spyProductReviewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductReviewsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductReviews !== null) {
                foreach ($this->collSpyProductReviews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductSearchesScheduledForDeletion !== null) {
                if (!$this->spyProductSearchesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductSearchesScheduledForDeletion as $spyProductSearch) {
                        // need to save related object because we set the relation to null
                        $spyProductSearch->save($con);
                    }
                    $this->spyProductSearchesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductSearches !== null) {
                foreach ($this->collSpyProductSearches as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductSetDatasScheduledForDeletion !== null) {
                if (!$this->spyProductSetDatasScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery::create()
                        ->filterByPrimaryKeys($this->spyProductSetDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductSetDatasScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductSetDatas !== null) {
                foreach ($this->collSpyProductSetDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesOrdersScheduledForDeletion !== null) {
                if (!$this->spySalesOrdersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySalesOrdersScheduledForDeletion as $spySalesOrder) {
                        // need to save related object because we set the relation to null
                        $spySalesOrder->save($con);
                    }
                    $this->spySalesOrdersScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrders !== null) {
                foreach ($this->collSpySalesOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->storeDefaultsScheduledForDeletion !== null) {
                if (!$this->storeDefaultsScheduledForDeletion->isEmpty()) {
                    foreach ($this->storeDefaultsScheduledForDeletion as $storeDefault) {
                        // need to save related object because we set the relation to null
                        $storeDefault->save($con);
                    }
                    $this->storeDefaultsScheduledForDeletion = null;
                }
            }

            if ($this->collStoreDefaults !== null) {
                foreach ($this->collStoreDefaults as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->touchStoragesScheduledForDeletion !== null) {
                if (!$this->touchStoragesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery::create()
                        ->filterByPrimaryKeys($this->touchStoragesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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
                    \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery::create()
                        ->filterByPrimaryKeys($this->touchSearchesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->spyUrlsScheduledForDeletion !== null) {
                if (!$this->spyUrlsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Url\Persistence\SpyUrlQuery::create()
                        ->filterByPrimaryKeys($this->spyUrlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyUrlsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyUrls !== null) {
                foreach ($this->collSpyUrls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyUsersScheduledForDeletion !== null) {
                if (!$this->spyUsersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyUsersScheduledForDeletion as $spyUser) {
                        // need to save related object because we set the relation to null
                        $spyUser->save($con);
                    }
                    $this->spyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyUsers !== null) {
                foreach ($this->collSpyUsers as $referrerFK) {
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

        $this->modifiedColumns[SpyLocaleTableMap::COL_ID_LOCALE] = true;
        if (null !== $this->id_locale) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyLocaleTableMap::COL_ID_LOCALE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyLocaleTableMap::COL_ID_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'id_locale';
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_LOCALE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'locale_name';
        }

        $sql = sprintf(
            'INSERT INTO spy_locale (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_locale':
                        $stmt->bindValue($identifier, $this->id_locale, PDO::PARAM_INT);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'locale_name':
                        $stmt->bindValue($identifier, $this->locale_name, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_locale_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdLocale($pk);

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
        $pos = SpyLocaleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdLocale();

            case 1:
                return $this->getIsActive();

            case 2:
                return $this->getLocaleName();

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
        if (isset($alreadyDumpedObjects['SpyLocale'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyLocale'][$this->hashCode()] = true;
        $keys = SpyLocaleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdLocale(),
            $keys[1] => $this->getIsActive(),
            $keys[2] => $this->getLocaleName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collSpyCategoryAttributes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryAttributes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_attributes';
                        break;
                    default:
                        $key = 'SpyCategoryAttributes';
                }

                $result[$key] = $this->collSpyCategoryAttributes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCategoryImageSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryImageSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_image_sets';
                        break;
                    default:
                        $key = 'SpyCategoryImageSets';
                }

                $result[$key] = $this->collSpyCategoryImageSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsPageLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsPageLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_page_localized_attributess';
                        break;
                    default:
                        $key = 'SpyCmsPageLocalizedAttributess';
                }

                $result[$key] = $this->collSpyCmsPageLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyContentLocalizeds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyContentLocalizeds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_content_localizeds';
                        break;
                    default:
                        $key = 'SpyContentLocalizeds';
                }

                $result[$key] = $this->collSpyContentLocalizeds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCustomers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customers';
                        break;
                    default:
                        $key = 'SpyCustomers';
                }

                $result[$key] = $this->collSpyCustomers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyFileLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFileLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file_localized_attributess';
                        break;
                    default:
                        $key = 'SpyFileLocalizedAttributess';
                }

                $result[$key] = $this->collSpyFileLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyFileDirectoryLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFileDirectoryLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file_directory_localized_attributess';
                        break;
                    default:
                        $key = 'SpyFileDirectoryLocalizedAttributess';
                }

                $result[$key] = $this->collSpyFileDirectoryLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyGlossaryTranslations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyGlossaryTranslations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_glossary_translations';
                        break;
                    default:
                        $key = 'SpyGlossaryTranslations';
                }

                $result[$key] = $this->collSpyGlossaryTranslations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyNavigationNodeLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNavigationNodeLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_navigation_node_localized_attributess';
                        break;
                    default:
                        $key = 'SpyNavigationNodeLocalizedAttributess';
                }

                $result[$key] = $this->collSpyNavigationNodeLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_localized_attributess';
                        break;
                    default:
                        $key = 'SpyProductAbstractLocalizedAttributess';
                }

                $result[$key] = $this->collSpyProductAbstractLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_localized_attributess';
                        break;
                    default:
                        $key = 'SpyProductLocalizedAttributess';
                }

                $result[$key] = $this->collSpyProductLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductManagementAttributeValueTranslations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductManagementAttributeValueTranslations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_management_attribute_value_translations';
                        break;
                    default:
                        $key = 'SpyProductManagementAttributeValueTranslations';
                }

                $result[$key] = $this->collSpyProductManagementAttributeValueTranslations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductDiscontinuedNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductDiscontinuedNotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_discontinued_notes';
                        break;
                    default:
                        $key = 'SpyProductDiscontinuedNotes';
                }

                $result[$key] = $this->collSpyProductDiscontinuedNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductImageSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductImageSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_image_sets';
                        break;
                    default:
                        $key = 'SpyProductImageSets';
                }

                $result[$key] = $this->collSpyProductImageSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductLabelLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLabelLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_label_localized_attributess';
                        break;
                    default:
                        $key = 'SpyProductLabelLocalizedAttributess';
                }

                $result[$key] = $this->collSpyProductLabelLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductReviews) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductReviews';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_reviews';
                        break;
                    default:
                        $key = 'SpyProductReviews';
                }

                $result[$key] = $this->collSpyProductReviews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductSearches) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSearches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_searches';
                        break;
                    default:
                        $key = 'SpyProductSearches';
                }

                $result[$key] = $this->collSpyProductSearches->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductSetDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSetDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_set_datas';
                        break;
                    default:
                        $key = 'SpyProductSetDatas';
                }

                $result[$key] = $this->collSpyProductSetDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_orders';
                        break;
                    default:
                        $key = 'SpySalesOrders';
                }

                $result[$key] = $this->collSpySalesOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStoreDefaults) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stores';
                        break;
                    default:
                        $key = 'StoreDefaults';
                }

                $result[$key] = $this->collStoreDefaults->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyUrls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUrls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_urls';
                        break;
                    default:
                        $key = 'SpyUrls';
                }

                $result[$key] = $this->collSpyUrls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_users';
                        break;
                    default:
                        $key = 'SpyUsers';
                }

                $result[$key] = $this->collSpyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyLocaleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdLocale($value);
                break;
            case 1:
                $this->setIsActive($value);
                break;
            case 2:
                $this->setLocaleName($value);
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
        $keys = SpyLocaleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdLocale($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLocaleName($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyLocaleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyLocaleTableMap::COL_ID_LOCALE)) {
            $criteria->add(SpyLocaleTableMap::COL_ID_LOCALE, $this->id_locale);
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyLocaleTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_LOCALE_NAME)) {
            $criteria->add(SpyLocaleTableMap::COL_LOCALE_NAME, $this->locale_name);
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
        $criteria = ChildSpyLocaleQuery::create();
        $criteria->add(SpyLocaleTableMap::COL_ID_LOCALE, $this->id_locale);

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
        $validPk = null !== $this->getIdLocale();

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
        return $this->getIdLocale();
    }

    /**
     * Generic method to set the primary key (id_locale column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdLocale($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdLocale();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Locale\Persistence\SpyLocale (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setLocaleName($this->getLocaleName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyAvailabilityNotificationSubscriptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAvailabilityNotificationSubscription($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCategoryAttributes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCategoryAttribute($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCategoryImageSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCategoryImageSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsPageLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsPageLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyContentLocalizeds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyContentLocalized($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCustomers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyFileLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyFileLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyFileDirectoryLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyFileDirectoryLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyGlossaryTranslations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyGlossaryTranslation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLocaleStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocaleStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyNavigationNodeLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyNavigationNodeLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductManagementAttributeValueTranslations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductManagementAttributeValueTranslation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductDiscontinuedNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductDiscontinuedNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductImageSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductImageSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductLabelLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductLabelLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductReview($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductSearches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductSearch($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductSetDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductSetData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStoreDefaults() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStoreDefault($relObj->copy($deepCopy));
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

            foreach ($this->getSpyUrls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUrl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdLocale(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Locale\Persistence\SpyLocale Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('SpyAvailabilityNotificationSubscription' === $relationName) {
            $this->initSpyAvailabilityNotificationSubscriptions();
            return;
        }
        if ('SpyCategoryAttribute' === $relationName) {
            $this->initSpyCategoryAttributes();
            return;
        }
        if ('SpyCategoryImageSet' === $relationName) {
            $this->initSpyCategoryImageSets();
            return;
        }
        if ('SpyCmsPageLocalizedAttributes' === $relationName) {
            $this->initSpyCmsPageLocalizedAttributess();
            return;
        }
        if ('SpyContentLocalized' === $relationName) {
            $this->initSpyContentLocalizeds();
            return;
        }
        if ('SpyCustomer' === $relationName) {
            $this->initSpyCustomers();
            return;
        }
        if ('SpyFileLocalizedAttributes' === $relationName) {
            $this->initSpyFileLocalizedAttributess();
            return;
        }
        if ('SpyFileDirectoryLocalizedAttributes' === $relationName) {
            $this->initSpyFileDirectoryLocalizedAttributess();
            return;
        }
        if ('SpyGlossaryTranslation' === $relationName) {
            $this->initSpyGlossaryTranslations();
            return;
        }
        if ('LocaleStore' === $relationName) {
            $this->initLocaleStores();
            return;
        }
        if ('SpyNavigationNodeLocalizedAttributes' === $relationName) {
            $this->initSpyNavigationNodeLocalizedAttributess();
            return;
        }
        if ('SpyProductAbstractLocalizedAttributes' === $relationName) {
            $this->initSpyProductAbstractLocalizedAttributess();
            return;
        }
        if ('SpyProductLocalizedAttributes' === $relationName) {
            $this->initSpyProductLocalizedAttributess();
            return;
        }
        if ('SpyProductManagementAttributeValueTranslation' === $relationName) {
            $this->initSpyProductManagementAttributeValueTranslations();
            return;
        }
        if ('SpyProductDiscontinuedNote' === $relationName) {
            $this->initSpyProductDiscontinuedNotes();
            return;
        }
        if ('SpyProductImageSet' === $relationName) {
            $this->initSpyProductImageSets();
            return;
        }
        if ('SpyProductLabelLocalizedAttributes' === $relationName) {
            $this->initSpyProductLabelLocalizedAttributess();
            return;
        }
        if ('SpyProductReview' === $relationName) {
            $this->initSpyProductReviews();
            return;
        }
        if ('SpyProductSearch' === $relationName) {
            $this->initSpyProductSearches();
            return;
        }
        if ('SpyProductSetData' === $relationName) {
            $this->initSpyProductSetDatas();
            return;
        }
        if ('SpySalesOrder' === $relationName) {
            $this->initSpySalesOrders();
            return;
        }
        if ('StoreDefault' === $relationName) {
            $this->initStoreDefaults();
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
        if ('SpyUrl' === $relationName) {
            $this->initSpyUrls();
            return;
        }
        if ('SpyUser' === $relationName) {
            $this->initSpyUsers();
            return;
        }
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
     * If this ChildSpyLocale is new, it will return
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
                    ->filterBySpyLocale($this)
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
            $spyAvailabilityNotificationSubscriptionRemoved->setSpyLocale(null);
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
                ->filterBySpyLocale($this)
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
        $spyAvailabilityNotificationSubscription->setSpyLocale($this);
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
            $spyAvailabilityNotificationSubscription->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyAvailabilityNotificationSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAvailabilityNotificationSubscription[] List of SpyAvailabilityNotificationSubscription objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription}> List of SpyAvailabilityNotificationSubscription objects
     */
    public function getSpyAvailabilityNotificationSubscriptionsJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAvailabilityNotificationSubscriptionQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyAvailabilityNotificationSubscriptions($query, $con);
    }

    /**
     * Clears out the collSpyCategoryAttributes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCategoryAttributes()
     */
    public function clearSpyCategoryAttributes()
    {
        $this->collSpyCategoryAttributes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCategoryAttributes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCategoryAttributes($v = true): void
    {
        $this->collSpyCategoryAttributesPartial = $v;
    }

    /**
     * Initializes the collSpyCategoryAttributes collection.
     *
     * By default this just sets the collSpyCategoryAttributes collection to an empty array (like clearcollSpyCategoryAttributes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCategoryAttributes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCategoryAttributes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryAttributeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategoryAttributes = new $collectionClassName;
        $this->collSpyCategoryAttributes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryAttribute');
    }

    /**
     * Gets an array of SpyCategoryAttribute objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCategoryAttribute[] List of SpyCategoryAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryAttribute> List of SpyCategoryAttribute objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCategoryAttributes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoryAttributesPartial && !$this->isNew();
        if (null === $this->collSpyCategoryAttributes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategoryAttributes) {
                    $this->initSpyCategoryAttributes();
                } else {
                    $collectionClassName = SpyCategoryAttributeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCategoryAttributes = new $collectionClassName;
                    $collSpyCategoryAttributes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryAttribute');

                    return $collSpyCategoryAttributes;
                }
            } else {
                $collSpyCategoryAttributes = SpyCategoryAttributeQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCategoryAttributesPartial && count($collSpyCategoryAttributes)) {
                        $this->initSpyCategoryAttributes(false);

                        foreach ($collSpyCategoryAttributes as $obj) {
                            if (false == $this->collSpyCategoryAttributes->contains($obj)) {
                                $this->collSpyCategoryAttributes->append($obj);
                            }
                        }

                        $this->collSpyCategoryAttributesPartial = true;
                    }

                    return $collSpyCategoryAttributes;
                }

                if ($partial && $this->collSpyCategoryAttributes) {
                    foreach ($this->collSpyCategoryAttributes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCategoryAttributes[] = $obj;
                        }
                    }
                }

                $this->collSpyCategoryAttributes = $collSpyCategoryAttributes;
                $this->collSpyCategoryAttributesPartial = false;
            }
        }

        return $this->collSpyCategoryAttributes;
    }

    /**
     * Sets a collection of SpyCategoryAttribute objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategoryAttributes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategoryAttributes(Collection $spyCategoryAttributes, ?ConnectionInterface $con = null)
    {
        /** @var SpyCategoryAttribute[] $spyCategoryAttributesToDelete */
        $spyCategoryAttributesToDelete = $this->getSpyCategoryAttributes(new Criteria(), $con)->diff($spyCategoryAttributes);


        $this->spyCategoryAttributesScheduledForDeletion = $spyCategoryAttributesToDelete;

        foreach ($spyCategoryAttributesToDelete as $spyCategoryAttributeRemoved) {
            $spyCategoryAttributeRemoved->setLocale(null);
        }

        $this->collSpyCategoryAttributes = null;
        foreach ($spyCategoryAttributes as $spyCategoryAttribute) {
            $this->addSpyCategoryAttribute($spyCategoryAttribute);
        }

        $this->collSpyCategoryAttributes = $spyCategoryAttributes;
        $this->collSpyCategoryAttributesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCategoryAttribute objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCategoryAttribute objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCategoryAttributes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoryAttributesPartial && !$this->isNew();
        if (null === $this->collSpyCategoryAttributes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategoryAttributes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCategoryAttributes());
            }

            $query = SpyCategoryAttributeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyCategoryAttributes);
    }

    /**
     * Method called to associate a SpyCategoryAttribute object to this object
     * through the SpyCategoryAttribute foreign key attribute.
     *
     * @param SpyCategoryAttribute $l SpyCategoryAttribute
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCategoryAttribute(SpyCategoryAttribute $l)
    {
        if ($this->collSpyCategoryAttributes === null) {
            $this->initSpyCategoryAttributes();
            $this->collSpyCategoryAttributesPartial = true;
        }

        if (!$this->collSpyCategoryAttributes->contains($l)) {
            $this->doAddSpyCategoryAttribute($l);

            if ($this->spyCategoryAttributesScheduledForDeletion and $this->spyCategoryAttributesScheduledForDeletion->contains($l)) {
                $this->spyCategoryAttributesScheduledForDeletion->remove($this->spyCategoryAttributesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCategoryAttribute $spyCategoryAttribute The SpyCategoryAttribute object to add.
     */
    protected function doAddSpyCategoryAttribute(SpyCategoryAttribute $spyCategoryAttribute): void
    {
        $this->collSpyCategoryAttributes[]= $spyCategoryAttribute;
        $spyCategoryAttribute->setLocale($this);
    }

    /**
     * @param SpyCategoryAttribute $spyCategoryAttribute The SpyCategoryAttribute object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCategoryAttribute(SpyCategoryAttribute $spyCategoryAttribute)
    {
        if ($this->getSpyCategoryAttributes()->contains($spyCategoryAttribute)) {
            $pos = $this->collSpyCategoryAttributes->search($spyCategoryAttribute);
            $this->collSpyCategoryAttributes->remove($pos);
            if (null === $this->spyCategoryAttributesScheduledForDeletion) {
                $this->spyCategoryAttributesScheduledForDeletion = clone $this->collSpyCategoryAttributes;
                $this->spyCategoryAttributesScheduledForDeletion->clear();
            }
            $this->spyCategoryAttributesScheduledForDeletion[]= clone $spyCategoryAttribute;
            $spyCategoryAttribute->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCategoryAttributes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCategoryAttribute[] List of SpyCategoryAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryAttribute}> List of SpyCategoryAttribute objects
     */
    public function getSpyCategoryAttributesJoinCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCategoryAttributeQuery::create(null, $criteria);
        $query->joinWith('Category', $joinBehavior);

        return $this->getSpyCategoryAttributes($query, $con);
    }

    /**
     * Clears out the collSpyCategoryImageSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCategoryImageSets()
     */
    public function clearSpyCategoryImageSets()
    {
        $this->collSpyCategoryImageSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCategoryImageSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCategoryImageSets($v = true): void
    {
        $this->collSpyCategoryImageSetsPartial = $v;
    }

    /**
     * Initializes the collSpyCategoryImageSets collection.
     *
     * By default this just sets the collSpyCategoryImageSets collection to an empty array (like clearcollSpyCategoryImageSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCategoryImageSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCategoryImageSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryImageSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategoryImageSets = new $collectionClassName;
        $this->collSpyCategoryImageSets->setModel('\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet');
    }

    /**
     * Gets an array of SpyCategoryImageSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCategoryImageSet[] List of SpyCategoryImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryImageSet> List of SpyCategoryImageSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCategoryImageSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoryImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyCategoryImageSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategoryImageSets) {
                    $this->initSpyCategoryImageSets();
                } else {
                    $collectionClassName = SpyCategoryImageSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCategoryImageSets = new $collectionClassName;
                    $collSpyCategoryImageSets->setModel('\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet');

                    return $collSpyCategoryImageSets;
                }
            } else {
                $collSpyCategoryImageSets = SpyCategoryImageSetQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCategoryImageSetsPartial && count($collSpyCategoryImageSets)) {
                        $this->initSpyCategoryImageSets(false);

                        foreach ($collSpyCategoryImageSets as $obj) {
                            if (false == $this->collSpyCategoryImageSets->contains($obj)) {
                                $this->collSpyCategoryImageSets->append($obj);
                            }
                        }

                        $this->collSpyCategoryImageSetsPartial = true;
                    }

                    return $collSpyCategoryImageSets;
                }

                if ($partial && $this->collSpyCategoryImageSets) {
                    foreach ($this->collSpyCategoryImageSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCategoryImageSets[] = $obj;
                        }
                    }
                }

                $this->collSpyCategoryImageSets = $collSpyCategoryImageSets;
                $this->collSpyCategoryImageSetsPartial = false;
            }
        }

        return $this->collSpyCategoryImageSets;
    }

    /**
     * Sets a collection of SpyCategoryImageSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategoryImageSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategoryImageSets(Collection $spyCategoryImageSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyCategoryImageSet[] $spyCategoryImageSetsToDelete */
        $spyCategoryImageSetsToDelete = $this->getSpyCategoryImageSets(new Criteria(), $con)->diff($spyCategoryImageSets);


        $this->spyCategoryImageSetsScheduledForDeletion = $spyCategoryImageSetsToDelete;

        foreach ($spyCategoryImageSetsToDelete as $spyCategoryImageSetRemoved) {
            $spyCategoryImageSetRemoved->setSpyLocale(null);
        }

        $this->collSpyCategoryImageSets = null;
        foreach ($spyCategoryImageSets as $spyCategoryImageSet) {
            $this->addSpyCategoryImageSet($spyCategoryImageSet);
        }

        $this->collSpyCategoryImageSets = $spyCategoryImageSets;
        $this->collSpyCategoryImageSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCategoryImageSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCategoryImageSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCategoryImageSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoryImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyCategoryImageSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategoryImageSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCategoryImageSets());
            }

            $query = SpyCategoryImageSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyCategoryImageSets);
    }

    /**
     * Method called to associate a SpyCategoryImageSet object to this object
     * through the SpyCategoryImageSet foreign key attribute.
     *
     * @param SpyCategoryImageSet $l SpyCategoryImageSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCategoryImageSet(SpyCategoryImageSet $l)
    {
        if ($this->collSpyCategoryImageSets === null) {
            $this->initSpyCategoryImageSets();
            $this->collSpyCategoryImageSetsPartial = true;
        }

        if (!$this->collSpyCategoryImageSets->contains($l)) {
            $this->doAddSpyCategoryImageSet($l);

            if ($this->spyCategoryImageSetsScheduledForDeletion and $this->spyCategoryImageSetsScheduledForDeletion->contains($l)) {
                $this->spyCategoryImageSetsScheduledForDeletion->remove($this->spyCategoryImageSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCategoryImageSet $spyCategoryImageSet The SpyCategoryImageSet object to add.
     */
    protected function doAddSpyCategoryImageSet(SpyCategoryImageSet $spyCategoryImageSet): void
    {
        $this->collSpyCategoryImageSets[]= $spyCategoryImageSet;
        $spyCategoryImageSet->setSpyLocale($this);
    }

    /**
     * @param SpyCategoryImageSet $spyCategoryImageSet The SpyCategoryImageSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCategoryImageSet(SpyCategoryImageSet $spyCategoryImageSet)
    {
        if ($this->getSpyCategoryImageSets()->contains($spyCategoryImageSet)) {
            $pos = $this->collSpyCategoryImageSets->search($spyCategoryImageSet);
            $this->collSpyCategoryImageSets->remove($pos);
            if (null === $this->spyCategoryImageSetsScheduledForDeletion) {
                $this->spyCategoryImageSetsScheduledForDeletion = clone $this->collSpyCategoryImageSets;
                $this->spyCategoryImageSetsScheduledForDeletion->clear();
            }
            $this->spyCategoryImageSetsScheduledForDeletion[]= $spyCategoryImageSet;
            $spyCategoryImageSet->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCategoryImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCategoryImageSet[] List of SpyCategoryImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryImageSet}> List of SpyCategoryImageSet objects
     */
    public function getSpyCategoryImageSetsJoinSpyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCategoryImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyCategory', $joinBehavior);

        return $this->getSpyCategoryImageSets($query, $con);
    }

    /**
     * Clears out the collSpyCmsPageLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsPageLocalizedAttributess()
     */
    public function clearSpyCmsPageLocalizedAttributess()
    {
        $this->collSpyCmsPageLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsPageLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsPageLocalizedAttributess($v = true): void
    {
        $this->collSpyCmsPageLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyCmsPageLocalizedAttributess collection.
     *
     * By default this just sets the collSpyCmsPageLocalizedAttributess collection to an empty array (like clearcollSpyCmsPageLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsPageLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsPageLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsPageLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsPageLocalizedAttributess = new $collectionClassName;
        $this->collSpyCmsPageLocalizedAttributess->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes');
    }

    /**
     * Gets an array of SpyCmsPageLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsPageLocalizedAttributes[] List of SpyCmsPageLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsPageLocalizedAttributes> List of SpyCmsPageLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsPageLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsPageLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsPageLocalizedAttributess) {
                    $this->initSpyCmsPageLocalizedAttributess();
                } else {
                    $collectionClassName = SpyCmsPageLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsPageLocalizedAttributess = new $collectionClassName;
                    $collSpyCmsPageLocalizedAttributess->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes');

                    return $collSpyCmsPageLocalizedAttributess;
                }
            } else {
                $collSpyCmsPageLocalizedAttributess = SpyCmsPageLocalizedAttributesQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsPageLocalizedAttributessPartial && count($collSpyCmsPageLocalizedAttributess)) {
                        $this->initSpyCmsPageLocalizedAttributess(false);

                        foreach ($collSpyCmsPageLocalizedAttributess as $obj) {
                            if (false == $this->collSpyCmsPageLocalizedAttributess->contains($obj)) {
                                $this->collSpyCmsPageLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyCmsPageLocalizedAttributessPartial = true;
                    }

                    return $collSpyCmsPageLocalizedAttributess;
                }

                if ($partial && $this->collSpyCmsPageLocalizedAttributess) {
                    foreach ($this->collSpyCmsPageLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsPageLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsPageLocalizedAttributess = $collSpyCmsPageLocalizedAttributess;
                $this->collSpyCmsPageLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyCmsPageLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyCmsPageLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsPageLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsPageLocalizedAttributess(Collection $spyCmsPageLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsPageLocalizedAttributes[] $spyCmsPageLocalizedAttributessToDelete */
        $spyCmsPageLocalizedAttributessToDelete = $this->getSpyCmsPageLocalizedAttributess(new Criteria(), $con)->diff($spyCmsPageLocalizedAttributess);


        $this->spyCmsPageLocalizedAttributessScheduledForDeletion = $spyCmsPageLocalizedAttributessToDelete;

        foreach ($spyCmsPageLocalizedAttributessToDelete as $spyCmsPageLocalizedAttributesRemoved) {
            $spyCmsPageLocalizedAttributesRemoved->setLocale(null);
        }

        $this->collSpyCmsPageLocalizedAttributess = null;
        foreach ($spyCmsPageLocalizedAttributess as $spyCmsPageLocalizedAttributes) {
            $this->addSpyCmsPageLocalizedAttributes($spyCmsPageLocalizedAttributes);
        }

        $this->collSpyCmsPageLocalizedAttributess = $spyCmsPageLocalizedAttributess;
        $this->collSpyCmsPageLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsPageLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsPageLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsPageLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsPageLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsPageLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsPageLocalizedAttributess());
            }

            $query = SpyCmsPageLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyCmsPageLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyCmsPageLocalizedAttributes object to this object
     * through the SpyCmsPageLocalizedAttributes foreign key attribute.
     *
     * @param SpyCmsPageLocalizedAttributes $l SpyCmsPageLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsPageLocalizedAttributes(SpyCmsPageLocalizedAttributes $l)
    {
        if ($this->collSpyCmsPageLocalizedAttributess === null) {
            $this->initSpyCmsPageLocalizedAttributess();
            $this->collSpyCmsPageLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyCmsPageLocalizedAttributess->contains($l)) {
            $this->doAddSpyCmsPageLocalizedAttributes($l);

            if ($this->spyCmsPageLocalizedAttributessScheduledForDeletion and $this->spyCmsPageLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion->remove($this->spyCmsPageLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes The SpyCmsPageLocalizedAttributes object to add.
     */
    protected function doAddSpyCmsPageLocalizedAttributes(SpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes): void
    {
        $this->collSpyCmsPageLocalizedAttributess[]= $spyCmsPageLocalizedAttributes;
        $spyCmsPageLocalizedAttributes->setLocale($this);
    }

    /**
     * @param SpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes The SpyCmsPageLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsPageLocalizedAttributes(SpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes)
    {
        if ($this->getSpyCmsPageLocalizedAttributess()->contains($spyCmsPageLocalizedAttributes)) {
            $pos = $this->collSpyCmsPageLocalizedAttributess->search($spyCmsPageLocalizedAttributes);
            $this->collSpyCmsPageLocalizedAttributess->remove($pos);
            if (null === $this->spyCmsPageLocalizedAttributessScheduledForDeletion) {
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion = clone $this->collSpyCmsPageLocalizedAttributess;
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyCmsPageLocalizedAttributessScheduledForDeletion[]= clone $spyCmsPageLocalizedAttributes;
            $spyCmsPageLocalizedAttributes->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCmsPageLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsPageLocalizedAttributes[] List of SpyCmsPageLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsPageLocalizedAttributes}> List of SpyCmsPageLocalizedAttributes objects
     */
    public function getSpyCmsPageLocalizedAttributessJoinSpyCmsPage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsPageLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyCmsPage', $joinBehavior);

        return $this->getSpyCmsPageLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyContentLocalizeds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyContentLocalizeds()
     */
    public function clearSpyContentLocalizeds()
    {
        $this->collSpyContentLocalizeds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyContentLocalizeds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyContentLocalizeds($v = true): void
    {
        $this->collSpyContentLocalizedsPartial = $v;
    }

    /**
     * Initializes the collSpyContentLocalizeds collection.
     *
     * By default this just sets the collSpyContentLocalizeds collection to an empty array (like clearcollSpyContentLocalizeds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyContentLocalizeds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyContentLocalizeds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyContentLocalizedTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyContentLocalizeds = new $collectionClassName;
        $this->collSpyContentLocalizeds->setModel('\Orm\Zed\Content\Persistence\SpyContentLocalized');
    }

    /**
     * Gets an array of SpyContentLocalized objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyContentLocalized[] List of SpyContentLocalized objects
     * @phpstan-return ObjectCollection&\Traversable<SpyContentLocalized> List of SpyContentLocalized objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyContentLocalizeds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyContentLocalizedsPartial && !$this->isNew();
        if (null === $this->collSpyContentLocalizeds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyContentLocalizeds) {
                    $this->initSpyContentLocalizeds();
                } else {
                    $collectionClassName = SpyContentLocalizedTableMap::getTableMap()->getCollectionClassName();

                    $collSpyContentLocalizeds = new $collectionClassName;
                    $collSpyContentLocalizeds->setModel('\Orm\Zed\Content\Persistence\SpyContentLocalized');

                    return $collSpyContentLocalizeds;
                }
            } else {
                $collSpyContentLocalizeds = SpyContentLocalizedQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyContentLocalizedsPartial && count($collSpyContentLocalizeds)) {
                        $this->initSpyContentLocalizeds(false);

                        foreach ($collSpyContentLocalizeds as $obj) {
                            if (false == $this->collSpyContentLocalizeds->contains($obj)) {
                                $this->collSpyContentLocalizeds->append($obj);
                            }
                        }

                        $this->collSpyContentLocalizedsPartial = true;
                    }

                    return $collSpyContentLocalizeds;
                }

                if ($partial && $this->collSpyContentLocalizeds) {
                    foreach ($this->collSpyContentLocalizeds as $obj) {
                        if ($obj->isNew()) {
                            $collSpyContentLocalizeds[] = $obj;
                        }
                    }
                }

                $this->collSpyContentLocalizeds = $collSpyContentLocalizeds;
                $this->collSpyContentLocalizedsPartial = false;
            }
        }

        return $this->collSpyContentLocalizeds;
    }

    /**
     * Sets a collection of SpyContentLocalized objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyContentLocalizeds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyContentLocalizeds(Collection $spyContentLocalizeds, ?ConnectionInterface $con = null)
    {
        /** @var SpyContentLocalized[] $spyContentLocalizedsToDelete */
        $spyContentLocalizedsToDelete = $this->getSpyContentLocalizeds(new Criteria(), $con)->diff($spyContentLocalizeds);


        $this->spyContentLocalizedsScheduledForDeletion = $spyContentLocalizedsToDelete;

        foreach ($spyContentLocalizedsToDelete as $spyContentLocalizedRemoved) {
            $spyContentLocalizedRemoved->setSpyLocale(null);
        }

        $this->collSpyContentLocalizeds = null;
        foreach ($spyContentLocalizeds as $spyContentLocalized) {
            $this->addSpyContentLocalized($spyContentLocalized);
        }

        $this->collSpyContentLocalizeds = $spyContentLocalizeds;
        $this->collSpyContentLocalizedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyContentLocalized objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyContentLocalized objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyContentLocalizeds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyContentLocalizedsPartial && !$this->isNew();
        if (null === $this->collSpyContentLocalizeds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyContentLocalizeds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyContentLocalizeds());
            }

            $query = SpyContentLocalizedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyContentLocalizeds);
    }

    /**
     * Method called to associate a SpyContentLocalized object to this object
     * through the SpyContentLocalized foreign key attribute.
     *
     * @param SpyContentLocalized $l SpyContentLocalized
     * @return $this The current object (for fluent API support)
     */
    public function addSpyContentLocalized(SpyContentLocalized $l)
    {
        if ($this->collSpyContentLocalizeds === null) {
            $this->initSpyContentLocalizeds();
            $this->collSpyContentLocalizedsPartial = true;
        }

        if (!$this->collSpyContentLocalizeds->contains($l)) {
            $this->doAddSpyContentLocalized($l);

            if ($this->spyContentLocalizedsScheduledForDeletion and $this->spyContentLocalizedsScheduledForDeletion->contains($l)) {
                $this->spyContentLocalizedsScheduledForDeletion->remove($this->spyContentLocalizedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyContentLocalized $spyContentLocalized The SpyContentLocalized object to add.
     */
    protected function doAddSpyContentLocalized(SpyContentLocalized $spyContentLocalized): void
    {
        $this->collSpyContentLocalizeds[]= $spyContentLocalized;
        $spyContentLocalized->setSpyLocale($this);
    }

    /**
     * @param SpyContentLocalized $spyContentLocalized The SpyContentLocalized object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyContentLocalized(SpyContentLocalized $spyContentLocalized)
    {
        if ($this->getSpyContentLocalizeds()->contains($spyContentLocalized)) {
            $pos = $this->collSpyContentLocalizeds->search($spyContentLocalized);
            $this->collSpyContentLocalizeds->remove($pos);
            if (null === $this->spyContentLocalizedsScheduledForDeletion) {
                $this->spyContentLocalizedsScheduledForDeletion = clone $this->collSpyContentLocalizeds;
                $this->spyContentLocalizedsScheduledForDeletion->clear();
            }
            $this->spyContentLocalizedsScheduledForDeletion[]= $spyContentLocalized;
            $spyContentLocalized->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyContentLocalizeds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyContentLocalized[] List of SpyContentLocalized objects
     * @phpstan-return ObjectCollection&\Traversable<SpyContentLocalized}> List of SpyContentLocalized objects
     */
    public function getSpyContentLocalizedsJoinSpyContent(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyContentLocalizedQuery::create(null, $criteria);
        $query->joinWith('SpyContent', $joinBehavior);

        return $this->getSpyContentLocalizeds($query, $con);
    }

    /**
     * Clears out the collSpyCustomers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomers()
     */
    public function clearSpyCustomers()
    {
        $this->collSpyCustomers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomers($v = true): void
    {
        $this->collSpyCustomersPartial = $v;
    }

    /**
     * Initializes the collSpyCustomers collection.
     *
     * By default this just sets the collSpyCustomers collection to an empty array (like clearcollSpyCustomers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomers = new $collectionClassName;
        $this->collSpyCustomers->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');
    }

    /**
     * Gets an array of SpyCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer> List of SpyCustomer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomers) {
                    $this->initSpyCustomers();
                } else {
                    $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomers = new $collectionClassName;
                    $collSpyCustomers->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');

                    return $collSpyCustomers;
                }
            } else {
                $collSpyCustomers = SpyCustomerQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomersPartial && count($collSpyCustomers)) {
                        $this->initSpyCustomers(false);

                        foreach ($collSpyCustomers as $obj) {
                            if (false == $this->collSpyCustomers->contains($obj)) {
                                $this->collSpyCustomers->append($obj);
                            }
                        }

                        $this->collSpyCustomersPartial = true;
                    }

                    return $collSpyCustomers;
                }

                if ($partial && $this->collSpyCustomers) {
                    foreach ($this->collSpyCustomers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomers[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomers = $collSpyCustomers;
                $this->collSpyCustomersPartial = false;
            }
        }

        return $this->collSpyCustomers;
    }

    /**
     * Sets a collection of SpyCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomers(Collection $spyCustomers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomer[] $spyCustomersToDelete */
        $spyCustomersToDelete = $this->getSpyCustomers(new Criteria(), $con)->diff($spyCustomers);


        $this->spyCustomersScheduledForDeletion = $spyCustomersToDelete;

        foreach ($spyCustomersToDelete as $spyCustomerRemoved) {
            $spyCustomerRemoved->setLocale(null);
        }

        $this->collSpyCustomers = null;
        foreach ($spyCustomers as $spyCustomer) {
            $this->addSpyCustomer($spyCustomer);
        }

        $this->collSpyCustomers = $spyCustomers;
        $this->collSpyCustomersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomers());
            }

            $query = SpyCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyCustomers);
    }

    /**
     * Method called to associate a SpyCustomer object to this object
     * through the SpyCustomer foreign key attribute.
     *
     * @param SpyCustomer $l SpyCustomer
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomer(SpyCustomer $l)
    {
        if ($this->collSpyCustomers === null) {
            $this->initSpyCustomers();
            $this->collSpyCustomersPartial = true;
        }

        if (!$this->collSpyCustomers->contains($l)) {
            $this->doAddSpyCustomer($l);

            if ($this->spyCustomersScheduledForDeletion and $this->spyCustomersScheduledForDeletion->contains($l)) {
                $this->spyCustomersScheduledForDeletion->remove($this->spyCustomersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomer $spyCustomer The SpyCustomer object to add.
     */
    protected function doAddSpyCustomer(SpyCustomer $spyCustomer): void
    {
        $this->collSpyCustomers[]= $spyCustomer;
        $spyCustomer->setLocale($this);
    }

    /**
     * @param SpyCustomer $spyCustomer The SpyCustomer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomer(SpyCustomer $spyCustomer)
    {
        if ($this->getSpyCustomers()->contains($spyCustomer)) {
            $pos = $this->collSpyCustomers->search($spyCustomer);
            $this->collSpyCustomers->remove($pos);
            if (null === $this->spyCustomersScheduledForDeletion) {
                $this->spyCustomersScheduledForDeletion = clone $this->collSpyCustomers;
                $this->spyCustomersScheduledForDeletion->clear();
            }
            $this->spyCustomersScheduledForDeletion[]= $spyCustomer;
            $spyCustomer->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer}> List of SpyCustomer objects
     */
    public function getSpyCustomersJoinSpyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerQuery::create(null, $criteria);
        $query->joinWith('SpyUser', $joinBehavior);

        return $this->getSpyCustomers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer}> List of SpyCustomer objects
     */
    public function getSpyCustomersJoinBillingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerQuery::create(null, $criteria);
        $query->joinWith('BillingAddress', $joinBehavior);

        return $this->getSpyCustomers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer}> List of SpyCustomer objects
     */
    public function getSpyCustomersJoinShippingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerQuery::create(null, $criteria);
        $query->joinWith('ShippingAddress', $joinBehavior);

        return $this->getSpyCustomers($query, $con);
    }

    /**
     * Clears out the collSpyFileLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyFileLocalizedAttributess()
     */
    public function clearSpyFileLocalizedAttributess()
    {
        $this->collSpyFileLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyFileLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyFileLocalizedAttributess($v = true): void
    {
        $this->collSpyFileLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyFileLocalizedAttributess collection.
     *
     * By default this just sets the collSpyFileLocalizedAttributess collection to an empty array (like clearcollSpyFileLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyFileLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyFileLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyFileLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyFileLocalizedAttributess = new $collectionClassName;
        $this->collSpyFileLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes');
    }

    /**
     * Gets an array of SpyFileLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyFileLocalizedAttributes[] List of SpyFileLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyFileLocalizedAttributes> List of SpyFileLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyFileLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyFileLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyFileLocalizedAttributess) {
                    $this->initSpyFileLocalizedAttributess();
                } else {
                    $collectionClassName = SpyFileLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyFileLocalizedAttributess = new $collectionClassName;
                    $collSpyFileLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes');

                    return $collSpyFileLocalizedAttributess;
                }
            } else {
                $collSpyFileLocalizedAttributess = SpyFileLocalizedAttributesQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyFileLocalizedAttributessPartial && count($collSpyFileLocalizedAttributess)) {
                        $this->initSpyFileLocalizedAttributess(false);

                        foreach ($collSpyFileLocalizedAttributess as $obj) {
                            if (false == $this->collSpyFileLocalizedAttributess->contains($obj)) {
                                $this->collSpyFileLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyFileLocalizedAttributessPartial = true;
                    }

                    return $collSpyFileLocalizedAttributess;
                }

                if ($partial && $this->collSpyFileLocalizedAttributess) {
                    foreach ($this->collSpyFileLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyFileLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyFileLocalizedAttributess = $collSpyFileLocalizedAttributess;
                $this->collSpyFileLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyFileLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyFileLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyFileLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyFileLocalizedAttributess(Collection $spyFileLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyFileLocalizedAttributes[] $spyFileLocalizedAttributessToDelete */
        $spyFileLocalizedAttributessToDelete = $this->getSpyFileLocalizedAttributess(new Criteria(), $con)->diff($spyFileLocalizedAttributess);


        $this->spyFileLocalizedAttributessScheduledForDeletion = $spyFileLocalizedAttributessToDelete;

        foreach ($spyFileLocalizedAttributessToDelete as $spyFileLocalizedAttributesRemoved) {
            $spyFileLocalizedAttributesRemoved->setLocale(null);
        }

        $this->collSpyFileLocalizedAttributess = null;
        foreach ($spyFileLocalizedAttributess as $spyFileLocalizedAttributes) {
            $this->addSpyFileLocalizedAttributes($spyFileLocalizedAttributes);
        }

        $this->collSpyFileLocalizedAttributess = $spyFileLocalizedAttributess;
        $this->collSpyFileLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyFileLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyFileLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyFileLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyFileLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyFileLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyFileLocalizedAttributess());
            }

            $query = SpyFileLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyFileLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyFileLocalizedAttributes object to this object
     * through the SpyFileLocalizedAttributes foreign key attribute.
     *
     * @param SpyFileLocalizedAttributes $l SpyFileLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyFileLocalizedAttributes(SpyFileLocalizedAttributes $l)
    {
        if ($this->collSpyFileLocalizedAttributess === null) {
            $this->initSpyFileLocalizedAttributess();
            $this->collSpyFileLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyFileLocalizedAttributess->contains($l)) {
            $this->doAddSpyFileLocalizedAttributes($l);

            if ($this->spyFileLocalizedAttributessScheduledForDeletion and $this->spyFileLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyFileLocalizedAttributessScheduledForDeletion->remove($this->spyFileLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyFileLocalizedAttributes $spyFileLocalizedAttributes The SpyFileLocalizedAttributes object to add.
     */
    protected function doAddSpyFileLocalizedAttributes(SpyFileLocalizedAttributes $spyFileLocalizedAttributes): void
    {
        $this->collSpyFileLocalizedAttributess[]= $spyFileLocalizedAttributes;
        $spyFileLocalizedAttributes->setLocale($this);
    }

    /**
     * @param SpyFileLocalizedAttributes $spyFileLocalizedAttributes The SpyFileLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyFileLocalizedAttributes(SpyFileLocalizedAttributes $spyFileLocalizedAttributes)
    {
        if ($this->getSpyFileLocalizedAttributess()->contains($spyFileLocalizedAttributes)) {
            $pos = $this->collSpyFileLocalizedAttributess->search($spyFileLocalizedAttributes);
            $this->collSpyFileLocalizedAttributess->remove($pos);
            if (null === $this->spyFileLocalizedAttributessScheduledForDeletion) {
                $this->spyFileLocalizedAttributessScheduledForDeletion = clone $this->collSpyFileLocalizedAttributess;
                $this->spyFileLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyFileLocalizedAttributessScheduledForDeletion[]= clone $spyFileLocalizedAttributes;
            $spyFileLocalizedAttributes->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyFileLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyFileLocalizedAttributes[] List of SpyFileLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyFileLocalizedAttributes}> List of SpyFileLocalizedAttributes objects
     */
    public function getSpyFileLocalizedAttributessJoinSpyFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyFileLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyFile', $joinBehavior);

        return $this->getSpyFileLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyFileDirectoryLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyFileDirectoryLocalizedAttributess()
     */
    public function clearSpyFileDirectoryLocalizedAttributess()
    {
        $this->collSpyFileDirectoryLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyFileDirectoryLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyFileDirectoryLocalizedAttributess($v = true): void
    {
        $this->collSpyFileDirectoryLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyFileDirectoryLocalizedAttributess collection.
     *
     * By default this just sets the collSpyFileDirectoryLocalizedAttributess collection to an empty array (like clearcollSpyFileDirectoryLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyFileDirectoryLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyFileDirectoryLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyFileDirectoryLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyFileDirectoryLocalizedAttributess = new $collectionClassName;
        $this->collSpyFileDirectoryLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes');
    }

    /**
     * Gets an array of SpyFileDirectoryLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyFileDirectoryLocalizedAttributes[] List of SpyFileDirectoryLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyFileDirectoryLocalizedAttributes> List of SpyFileDirectoryLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyFileDirectoryLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyFileDirectoryLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileDirectoryLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyFileDirectoryLocalizedAttributess) {
                    $this->initSpyFileDirectoryLocalizedAttributess();
                } else {
                    $collectionClassName = SpyFileDirectoryLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyFileDirectoryLocalizedAttributess = new $collectionClassName;
                    $collSpyFileDirectoryLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes');

                    return $collSpyFileDirectoryLocalizedAttributess;
                }
            } else {
                $collSpyFileDirectoryLocalizedAttributess = SpyFileDirectoryLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyFileDirectoryLocalizedAttributessPartial && count($collSpyFileDirectoryLocalizedAttributess)) {
                        $this->initSpyFileDirectoryLocalizedAttributess(false);

                        foreach ($collSpyFileDirectoryLocalizedAttributess as $obj) {
                            if (false == $this->collSpyFileDirectoryLocalizedAttributess->contains($obj)) {
                                $this->collSpyFileDirectoryLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyFileDirectoryLocalizedAttributessPartial = true;
                    }

                    return $collSpyFileDirectoryLocalizedAttributess;
                }

                if ($partial && $this->collSpyFileDirectoryLocalizedAttributess) {
                    foreach ($this->collSpyFileDirectoryLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyFileDirectoryLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyFileDirectoryLocalizedAttributess = $collSpyFileDirectoryLocalizedAttributess;
                $this->collSpyFileDirectoryLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyFileDirectoryLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyFileDirectoryLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyFileDirectoryLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyFileDirectoryLocalizedAttributess(Collection $spyFileDirectoryLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyFileDirectoryLocalizedAttributes[] $spyFileDirectoryLocalizedAttributessToDelete */
        $spyFileDirectoryLocalizedAttributessToDelete = $this->getSpyFileDirectoryLocalizedAttributess(new Criteria(), $con)->diff($spyFileDirectoryLocalizedAttributess);


        $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion = $spyFileDirectoryLocalizedAttributessToDelete;

        foreach ($spyFileDirectoryLocalizedAttributessToDelete as $spyFileDirectoryLocalizedAttributesRemoved) {
            $spyFileDirectoryLocalizedAttributesRemoved->setSpyLocale(null);
        }

        $this->collSpyFileDirectoryLocalizedAttributess = null;
        foreach ($spyFileDirectoryLocalizedAttributess as $spyFileDirectoryLocalizedAttributes) {
            $this->addSpyFileDirectoryLocalizedAttributes($spyFileDirectoryLocalizedAttributes);
        }

        $this->collSpyFileDirectoryLocalizedAttributess = $spyFileDirectoryLocalizedAttributess;
        $this->collSpyFileDirectoryLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyFileDirectoryLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyFileDirectoryLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyFileDirectoryLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyFileDirectoryLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileDirectoryLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyFileDirectoryLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyFileDirectoryLocalizedAttributess());
            }

            $query = SpyFileDirectoryLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyFileDirectoryLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyFileDirectoryLocalizedAttributes object to this object
     * through the SpyFileDirectoryLocalizedAttributes foreign key attribute.
     *
     * @param SpyFileDirectoryLocalizedAttributes $l SpyFileDirectoryLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyFileDirectoryLocalizedAttributes(SpyFileDirectoryLocalizedAttributes $l)
    {
        if ($this->collSpyFileDirectoryLocalizedAttributess === null) {
            $this->initSpyFileDirectoryLocalizedAttributess();
            $this->collSpyFileDirectoryLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyFileDirectoryLocalizedAttributess->contains($l)) {
            $this->doAddSpyFileDirectoryLocalizedAttributes($l);

            if ($this->spyFileDirectoryLocalizedAttributessScheduledForDeletion and $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->remove($this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyFileDirectoryLocalizedAttributes $spyFileDirectoryLocalizedAttributes The SpyFileDirectoryLocalizedAttributes object to add.
     */
    protected function doAddSpyFileDirectoryLocalizedAttributes(SpyFileDirectoryLocalizedAttributes $spyFileDirectoryLocalizedAttributes): void
    {
        $this->collSpyFileDirectoryLocalizedAttributess[]= $spyFileDirectoryLocalizedAttributes;
        $spyFileDirectoryLocalizedAttributes->setSpyLocale($this);
    }

    /**
     * @param SpyFileDirectoryLocalizedAttributes $spyFileDirectoryLocalizedAttributes The SpyFileDirectoryLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyFileDirectoryLocalizedAttributes(SpyFileDirectoryLocalizedAttributes $spyFileDirectoryLocalizedAttributes)
    {
        if ($this->getSpyFileDirectoryLocalizedAttributess()->contains($spyFileDirectoryLocalizedAttributes)) {
            $pos = $this->collSpyFileDirectoryLocalizedAttributess->search($spyFileDirectoryLocalizedAttributes);
            $this->collSpyFileDirectoryLocalizedAttributess->remove($pos);
            if (null === $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion) {
                $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion = clone $this->collSpyFileDirectoryLocalizedAttributess;
                $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyFileDirectoryLocalizedAttributessScheduledForDeletion[]= clone $spyFileDirectoryLocalizedAttributes;
            $spyFileDirectoryLocalizedAttributes->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyFileDirectoryLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyFileDirectoryLocalizedAttributes[] List of SpyFileDirectoryLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyFileDirectoryLocalizedAttributes}> List of SpyFileDirectoryLocalizedAttributes objects
     */
    public function getSpyFileDirectoryLocalizedAttributessJoinSpyFileDirectory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyFileDirectoryLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyFileDirectory', $joinBehavior);

        return $this->getSpyFileDirectoryLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyGlossaryTranslations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyGlossaryTranslations()
     */
    public function clearSpyGlossaryTranslations()
    {
        $this->collSpyGlossaryTranslations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyGlossaryTranslations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyGlossaryTranslations($v = true): void
    {
        $this->collSpyGlossaryTranslationsPartial = $v;
    }

    /**
     * Initializes the collSpyGlossaryTranslations collection.
     *
     * By default this just sets the collSpyGlossaryTranslations collection to an empty array (like clearcollSpyGlossaryTranslations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyGlossaryTranslations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyGlossaryTranslations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyGlossaryTranslationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyGlossaryTranslations = new $collectionClassName;
        $this->collSpyGlossaryTranslations->setModel('\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation');
    }

    /**
     * Gets an array of SpyGlossaryTranslation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyGlossaryTranslation[] List of SpyGlossaryTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyGlossaryTranslation> List of SpyGlossaryTranslation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyGlossaryTranslations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyGlossaryTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyGlossaryTranslations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyGlossaryTranslations) {
                    $this->initSpyGlossaryTranslations();
                } else {
                    $collectionClassName = SpyGlossaryTranslationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyGlossaryTranslations = new $collectionClassName;
                    $collSpyGlossaryTranslations->setModel('\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation');

                    return $collSpyGlossaryTranslations;
                }
            } else {
                $collSpyGlossaryTranslations = SpyGlossaryTranslationQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyGlossaryTranslationsPartial && count($collSpyGlossaryTranslations)) {
                        $this->initSpyGlossaryTranslations(false);

                        foreach ($collSpyGlossaryTranslations as $obj) {
                            if (false == $this->collSpyGlossaryTranslations->contains($obj)) {
                                $this->collSpyGlossaryTranslations->append($obj);
                            }
                        }

                        $this->collSpyGlossaryTranslationsPartial = true;
                    }

                    return $collSpyGlossaryTranslations;
                }

                if ($partial && $this->collSpyGlossaryTranslations) {
                    foreach ($this->collSpyGlossaryTranslations as $obj) {
                        if ($obj->isNew()) {
                            $collSpyGlossaryTranslations[] = $obj;
                        }
                    }
                }

                $this->collSpyGlossaryTranslations = $collSpyGlossaryTranslations;
                $this->collSpyGlossaryTranslationsPartial = false;
            }
        }

        return $this->collSpyGlossaryTranslations;
    }

    /**
     * Sets a collection of SpyGlossaryTranslation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyGlossaryTranslations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyGlossaryTranslations(Collection $spyGlossaryTranslations, ?ConnectionInterface $con = null)
    {
        /** @var SpyGlossaryTranslation[] $spyGlossaryTranslationsToDelete */
        $spyGlossaryTranslationsToDelete = $this->getSpyGlossaryTranslations(new Criteria(), $con)->diff($spyGlossaryTranslations);


        $this->spyGlossaryTranslationsScheduledForDeletion = $spyGlossaryTranslationsToDelete;

        foreach ($spyGlossaryTranslationsToDelete as $spyGlossaryTranslationRemoved) {
            $spyGlossaryTranslationRemoved->setLocale(null);
        }

        $this->collSpyGlossaryTranslations = null;
        foreach ($spyGlossaryTranslations as $spyGlossaryTranslation) {
            $this->addSpyGlossaryTranslation($spyGlossaryTranslation);
        }

        $this->collSpyGlossaryTranslations = $spyGlossaryTranslations;
        $this->collSpyGlossaryTranslationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyGlossaryTranslation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyGlossaryTranslation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyGlossaryTranslations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyGlossaryTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyGlossaryTranslations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyGlossaryTranslations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyGlossaryTranslations());
            }

            $query = SpyGlossaryTranslationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyGlossaryTranslations);
    }

    /**
     * Method called to associate a SpyGlossaryTranslation object to this object
     * through the SpyGlossaryTranslation foreign key attribute.
     *
     * @param SpyGlossaryTranslation $l SpyGlossaryTranslation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyGlossaryTranslation(SpyGlossaryTranslation $l)
    {
        if ($this->collSpyGlossaryTranslations === null) {
            $this->initSpyGlossaryTranslations();
            $this->collSpyGlossaryTranslationsPartial = true;
        }

        if (!$this->collSpyGlossaryTranslations->contains($l)) {
            $this->doAddSpyGlossaryTranslation($l);

            if ($this->spyGlossaryTranslationsScheduledForDeletion and $this->spyGlossaryTranslationsScheduledForDeletion->contains($l)) {
                $this->spyGlossaryTranslationsScheduledForDeletion->remove($this->spyGlossaryTranslationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyGlossaryTranslation $spyGlossaryTranslation The SpyGlossaryTranslation object to add.
     */
    protected function doAddSpyGlossaryTranslation(SpyGlossaryTranslation $spyGlossaryTranslation): void
    {
        $this->collSpyGlossaryTranslations[]= $spyGlossaryTranslation;
        $spyGlossaryTranslation->setLocale($this);
    }

    /**
     * @param SpyGlossaryTranslation $spyGlossaryTranslation The SpyGlossaryTranslation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyGlossaryTranslation(SpyGlossaryTranslation $spyGlossaryTranslation)
    {
        if ($this->getSpyGlossaryTranslations()->contains($spyGlossaryTranslation)) {
            $pos = $this->collSpyGlossaryTranslations->search($spyGlossaryTranslation);
            $this->collSpyGlossaryTranslations->remove($pos);
            if (null === $this->spyGlossaryTranslationsScheduledForDeletion) {
                $this->spyGlossaryTranslationsScheduledForDeletion = clone $this->collSpyGlossaryTranslations;
                $this->spyGlossaryTranslationsScheduledForDeletion->clear();
            }
            $this->spyGlossaryTranslationsScheduledForDeletion[]= clone $spyGlossaryTranslation;
            $spyGlossaryTranslation->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyGlossaryTranslations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyGlossaryTranslation[] List of SpyGlossaryTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyGlossaryTranslation}> List of SpyGlossaryTranslation objects
     */
    public function getSpyGlossaryTranslationsJoinGlossaryKey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyGlossaryTranslationQuery::create(null, $criteria);
        $query->joinWith('GlossaryKey', $joinBehavior);

        return $this->getSpyGlossaryTranslations($query, $con);
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
     * Gets an array of ChildSpyLocaleStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyLocaleStore[] List of ChildSpyLocaleStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyLocaleStore> List of ChildSpyLocaleStore objects
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
                $collLocaleStores = ChildSpyLocaleStoreQuery::create(null, $criteria)
                    ->filterByLocale($this)
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
     * Sets a collection of ChildSpyLocaleStore objects related by a one-to-many relationship
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
        /** @var ChildSpyLocaleStore[] $localeStoresToDelete */
        $localeStoresToDelete = $this->getLocaleStores(new Criteria(), $con)->diff($localeStores);


        $this->localeStoresScheduledForDeletion = $localeStoresToDelete;

        foreach ($localeStoresToDelete as $localeStoreRemoved) {
            $localeStoreRemoved->setLocale(null);
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
     * Returns the number of related SpyLocaleStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyLocaleStore objects.
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

            $query = ChildSpyLocaleStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collLocaleStores);
    }

    /**
     * Method called to associate a ChildSpyLocaleStore object to this object
     * through the ChildSpyLocaleStore foreign key attribute.
     *
     * @param ChildSpyLocaleStore $l ChildSpyLocaleStore
     * @return $this The current object (for fluent API support)
     */
    public function addLocaleStore(ChildSpyLocaleStore $l)
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
     * @param ChildSpyLocaleStore $localeStore The ChildSpyLocaleStore object to add.
     */
    protected function doAddLocaleStore(ChildSpyLocaleStore $localeStore): void
    {
        $this->collLocaleStores[]= $localeStore;
        $localeStore->setLocale($this);
    }

    /**
     * @param ChildSpyLocaleStore $localeStore The ChildSpyLocaleStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeLocaleStore(ChildSpyLocaleStore $localeStore)
    {
        if ($this->getLocaleStores()->contains($localeStore)) {
            $pos = $this->collLocaleStores->search($localeStore);
            $this->collLocaleStores->remove($pos);
            if (null === $this->localeStoresScheduledForDeletion) {
                $this->localeStoresScheduledForDeletion = clone $this->collLocaleStores;
                $this->localeStoresScheduledForDeletion->clear();
            }
            $this->localeStoresScheduledForDeletion[]= clone $localeStore;
            $localeStore->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related LocaleStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyLocaleStore[] List of ChildSpyLocaleStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyLocaleStore}> List of ChildSpyLocaleStore objects
     */
    public function getLocaleStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyLocaleStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getLocaleStores($query, $con);
    }

    /**
     * Clears out the collSpyNavigationNodeLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyNavigationNodeLocalizedAttributess()
     */
    public function clearSpyNavigationNodeLocalizedAttributess()
    {
        $this->collSpyNavigationNodeLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyNavigationNodeLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyNavigationNodeLocalizedAttributess($v = true): void
    {
        $this->collSpyNavigationNodeLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyNavigationNodeLocalizedAttributess collection.
     *
     * By default this just sets the collSpyNavigationNodeLocalizedAttributess collection to an empty array (like clearcollSpyNavigationNodeLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyNavigationNodeLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyNavigationNodeLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyNavigationNodeLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyNavigationNodeLocalizedAttributess = new $collectionClassName;
        $this->collSpyNavigationNodeLocalizedAttributess->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes');
    }

    /**
     * Gets an array of SpyNavigationNodeLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyNavigationNodeLocalizedAttributes[] List of SpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyNavigationNodeLocalizedAttributes> List of SpyNavigationNodeLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyNavigationNodeLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyNavigationNodeLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyNavigationNodeLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyNavigationNodeLocalizedAttributess) {
                    $this->initSpyNavigationNodeLocalizedAttributess();
                } else {
                    $collectionClassName = SpyNavigationNodeLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyNavigationNodeLocalizedAttributess = new $collectionClassName;
                    $collSpyNavigationNodeLocalizedAttributess->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes');

                    return $collSpyNavigationNodeLocalizedAttributess;
                }
            } else {
                $collSpyNavigationNodeLocalizedAttributess = SpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyNavigationNodeLocalizedAttributessPartial && count($collSpyNavigationNodeLocalizedAttributess)) {
                        $this->initSpyNavigationNodeLocalizedAttributess(false);

                        foreach ($collSpyNavigationNodeLocalizedAttributess as $obj) {
                            if (false == $this->collSpyNavigationNodeLocalizedAttributess->contains($obj)) {
                                $this->collSpyNavigationNodeLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyNavigationNodeLocalizedAttributessPartial = true;
                    }

                    return $collSpyNavigationNodeLocalizedAttributess;
                }

                if ($partial && $this->collSpyNavigationNodeLocalizedAttributess) {
                    foreach ($this->collSpyNavigationNodeLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyNavigationNodeLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyNavigationNodeLocalizedAttributess = $collSpyNavigationNodeLocalizedAttributess;
                $this->collSpyNavigationNodeLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyNavigationNodeLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyNavigationNodeLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyNavigationNodeLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyNavigationNodeLocalizedAttributess(Collection $spyNavigationNodeLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyNavigationNodeLocalizedAttributes[] $spyNavigationNodeLocalizedAttributessToDelete */
        $spyNavigationNodeLocalizedAttributessToDelete = $this->getSpyNavigationNodeLocalizedAttributess(new Criteria(), $con)->diff($spyNavigationNodeLocalizedAttributess);


        $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = $spyNavigationNodeLocalizedAttributessToDelete;

        foreach ($spyNavigationNodeLocalizedAttributessToDelete as $spyNavigationNodeLocalizedAttributesRemoved) {
            $spyNavigationNodeLocalizedAttributesRemoved->setSpyLocale(null);
        }

        $this->collSpyNavigationNodeLocalizedAttributess = null;
        foreach ($spyNavigationNodeLocalizedAttributess as $spyNavigationNodeLocalizedAttributes) {
            $this->addSpyNavigationNodeLocalizedAttributes($spyNavigationNodeLocalizedAttributes);
        }

        $this->collSpyNavigationNodeLocalizedAttributess = $spyNavigationNodeLocalizedAttributess;
        $this->collSpyNavigationNodeLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyNavigationNodeLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyNavigationNodeLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyNavigationNodeLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyNavigationNodeLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyNavigationNodeLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyNavigationNodeLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyNavigationNodeLocalizedAttributess());
            }

            $query = SpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyNavigationNodeLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyNavigationNodeLocalizedAttributes object to this object
     * through the SpyNavigationNodeLocalizedAttributes foreign key attribute.
     *
     * @param SpyNavigationNodeLocalizedAttributes $l SpyNavigationNodeLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyNavigationNodeLocalizedAttributes(SpyNavigationNodeLocalizedAttributes $l)
    {
        if ($this->collSpyNavigationNodeLocalizedAttributess === null) {
            $this->initSpyNavigationNodeLocalizedAttributess();
            $this->collSpyNavigationNodeLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyNavigationNodeLocalizedAttributess->contains($l)) {
            $this->doAddSpyNavigationNodeLocalizedAttributes($l);

            if ($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion and $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->remove($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes The SpyNavigationNodeLocalizedAttributes object to add.
     */
    protected function doAddSpyNavigationNodeLocalizedAttributes(SpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes): void
    {
        $this->collSpyNavigationNodeLocalizedAttributess[]= $spyNavigationNodeLocalizedAttributes;
        $spyNavigationNodeLocalizedAttributes->setSpyLocale($this);
    }

    /**
     * @param SpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes The SpyNavigationNodeLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyNavigationNodeLocalizedAttributes(SpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes)
    {
        if ($this->getSpyNavigationNodeLocalizedAttributess()->contains($spyNavigationNodeLocalizedAttributes)) {
            $pos = $this->collSpyNavigationNodeLocalizedAttributess->search($spyNavigationNodeLocalizedAttributes);
            $this->collSpyNavigationNodeLocalizedAttributess->remove($pos);
            if (null === $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion) {
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = clone $this->collSpyNavigationNodeLocalizedAttributess;
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion[]= clone $spyNavigationNodeLocalizedAttributes;
            $spyNavigationNodeLocalizedAttributes->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyNavigationNodeLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyNavigationNodeLocalizedAttributes[] List of SpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyNavigationNodeLocalizedAttributes}> List of SpyNavigationNodeLocalizedAttributes objects
     */
    public function getSpyNavigationNodeLocalizedAttributessJoinSpyNavigationNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyNavigationNode', $joinBehavior);

        return $this->getSpyNavigationNodeLocalizedAttributess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyNavigationNodeLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyNavigationNodeLocalizedAttributes[] List of SpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyNavigationNodeLocalizedAttributes}> List of SpyNavigationNodeLocalizedAttributes objects
     */
    public function getSpyNavigationNodeLocalizedAttributessJoinSpyUrl(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyUrl', $joinBehavior);

        return $this->getSpyNavigationNodeLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractLocalizedAttributess()
     */
    public function clearSpyProductAbstractLocalizedAttributess()
    {
        $this->collSpyProductAbstractLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractLocalizedAttributess($v = true): void
    {
        $this->collSpyProductAbstractLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractLocalizedAttributess collection.
     *
     * By default this just sets the collSpyProductAbstractLocalizedAttributess collection to an empty array (like clearcollSpyProductAbstractLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractLocalizedAttributess = new $collectionClassName;
        $this->collSpyProductAbstractLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes');
    }

    /**
     * Gets an array of SpyProductAbstractLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAbstractLocalizedAttributes[] List of SpyProductAbstractLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractLocalizedAttributes> List of SpyProductAbstractLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractLocalizedAttributess) {
                    $this->initSpyProductAbstractLocalizedAttributess();
                } else {
                    $collectionClassName = SpyProductAbstractLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractLocalizedAttributess = new $collectionClassName;
                    $collSpyProductAbstractLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes');

                    return $collSpyProductAbstractLocalizedAttributess;
                }
            } else {
                $collSpyProductAbstractLocalizedAttributess = SpyProductAbstractLocalizedAttributesQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractLocalizedAttributessPartial && count($collSpyProductAbstractLocalizedAttributess)) {
                        $this->initSpyProductAbstractLocalizedAttributess(false);

                        foreach ($collSpyProductAbstractLocalizedAttributess as $obj) {
                            if (false == $this->collSpyProductAbstractLocalizedAttributess->contains($obj)) {
                                $this->collSpyProductAbstractLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractLocalizedAttributessPartial = true;
                    }

                    return $collSpyProductAbstractLocalizedAttributess;
                }

                if ($partial && $this->collSpyProductAbstractLocalizedAttributess) {
                    foreach ($this->collSpyProductAbstractLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractLocalizedAttributess = $collSpyProductAbstractLocalizedAttributess;
                $this->collSpyProductAbstractLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyProductAbstractLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyProductAbstractLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractLocalizedAttributess(Collection $spyProductAbstractLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAbstractLocalizedAttributes[] $spyProductAbstractLocalizedAttributessToDelete */
        $spyProductAbstractLocalizedAttributessToDelete = $this->getSpyProductAbstractLocalizedAttributess(new Criteria(), $con)->diff($spyProductAbstractLocalizedAttributess);


        $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = $spyProductAbstractLocalizedAttributessToDelete;

        foreach ($spyProductAbstractLocalizedAttributessToDelete as $spyProductAbstractLocalizedAttributesRemoved) {
            $spyProductAbstractLocalizedAttributesRemoved->setLocale(null);
        }

        $this->collSpyProductAbstractLocalizedAttributess = null;
        foreach ($spyProductAbstractLocalizedAttributess as $spyProductAbstractLocalizedAttributes) {
            $this->addSpyProductAbstractLocalizedAttributes($spyProductAbstractLocalizedAttributes);
        }

        $this->collSpyProductAbstractLocalizedAttributess = $spyProductAbstractLocalizedAttributess;
        $this->collSpyProductAbstractLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAbstractLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAbstractLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractLocalizedAttributess());
            }

            $query = SpyProductAbstractLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyProductAbstractLocalizedAttributes object to this object
     * through the SpyProductAbstractLocalizedAttributes foreign key attribute.
     *
     * @param SpyProductAbstractLocalizedAttributes $l SpyProductAbstractLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractLocalizedAttributes(SpyProductAbstractLocalizedAttributes $l)
    {
        if ($this->collSpyProductAbstractLocalizedAttributess === null) {
            $this->initSpyProductAbstractLocalizedAttributess();
            $this->collSpyProductAbstractLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyProductAbstractLocalizedAttributess->contains($l)) {
            $this->doAddSpyProductAbstractLocalizedAttributes($l);

            if ($this->spyProductAbstractLocalizedAttributessScheduledForDeletion and $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->remove($this->spyProductAbstractLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes The SpyProductAbstractLocalizedAttributes object to add.
     */
    protected function doAddSpyProductAbstractLocalizedAttributes(SpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes): void
    {
        $this->collSpyProductAbstractLocalizedAttributess[]= $spyProductAbstractLocalizedAttributes;
        $spyProductAbstractLocalizedAttributes->setLocale($this);
    }

    /**
     * @param SpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes The SpyProductAbstractLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractLocalizedAttributes(SpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes)
    {
        if ($this->getSpyProductAbstractLocalizedAttributess()->contains($spyProductAbstractLocalizedAttributes)) {
            $pos = $this->collSpyProductAbstractLocalizedAttributess->search($spyProductAbstractLocalizedAttributes);
            $this->collSpyProductAbstractLocalizedAttributess->remove($pos);
            if (null === $this->spyProductAbstractLocalizedAttributessScheduledForDeletion) {
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = clone $this->collSpyProductAbstractLocalizedAttributess;
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyProductAbstractLocalizedAttributessScheduledForDeletion[]= clone $spyProductAbstractLocalizedAttributes;
            $spyProductAbstractLocalizedAttributes->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductAbstractLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAbstractLocalizedAttributes[] List of SpyProductAbstractLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractLocalizedAttributes}> List of SpyProductAbstractLocalizedAttributes objects
     */
    public function getSpyProductAbstractLocalizedAttributessJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAbstractLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductAbstractLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductLocalizedAttributess()
     */
    public function clearSpyProductLocalizedAttributess()
    {
        $this->collSpyProductLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductLocalizedAttributess($v = true): void
    {
        $this->collSpyProductLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyProductLocalizedAttributess collection.
     *
     * By default this just sets the collSpyProductLocalizedAttributess collection to an empty array (like clearcollSpyProductLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLocalizedAttributess = new $collectionClassName;
        $this->collSpyProductLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes');
    }

    /**
     * Gets an array of SpyProductLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductLocalizedAttributes[] List of SpyProductLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLocalizedAttributes> List of SpyProductLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLocalizedAttributess) {
                    $this->initSpyProductLocalizedAttributess();
                } else {
                    $collectionClassName = SpyProductLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductLocalizedAttributess = new $collectionClassName;
                    $collSpyProductLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes');

                    return $collSpyProductLocalizedAttributess;
                }
            } else {
                $collSpyProductLocalizedAttributess = SpyProductLocalizedAttributesQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductLocalizedAttributessPartial && count($collSpyProductLocalizedAttributess)) {
                        $this->initSpyProductLocalizedAttributess(false);

                        foreach ($collSpyProductLocalizedAttributess as $obj) {
                            if (false == $this->collSpyProductLocalizedAttributess->contains($obj)) {
                                $this->collSpyProductLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyProductLocalizedAttributessPartial = true;
                    }

                    return $collSpyProductLocalizedAttributess;
                }

                if ($partial && $this->collSpyProductLocalizedAttributess) {
                    foreach ($this->collSpyProductLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLocalizedAttributess = $collSpyProductLocalizedAttributess;
                $this->collSpyProductLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyProductLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyProductLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLocalizedAttributess(Collection $spyProductLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductLocalizedAttributes[] $spyProductLocalizedAttributessToDelete */
        $spyProductLocalizedAttributessToDelete = $this->getSpyProductLocalizedAttributess(new Criteria(), $con)->diff($spyProductLocalizedAttributess);


        $this->spyProductLocalizedAttributessScheduledForDeletion = $spyProductLocalizedAttributessToDelete;

        foreach ($spyProductLocalizedAttributessToDelete as $spyProductLocalizedAttributesRemoved) {
            $spyProductLocalizedAttributesRemoved->setLocale(null);
        }

        $this->collSpyProductLocalizedAttributess = null;
        foreach ($spyProductLocalizedAttributess as $spyProductLocalizedAttributes) {
            $this->addSpyProductLocalizedAttributes($spyProductLocalizedAttributes);
        }

        $this->collSpyProductLocalizedAttributess = $spyProductLocalizedAttributess;
        $this->collSpyProductLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductLocalizedAttributess());
            }

            $query = SpyProductLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyProductLocalizedAttributes object to this object
     * through the SpyProductLocalizedAttributes foreign key attribute.
     *
     * @param SpyProductLocalizedAttributes $l SpyProductLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductLocalizedAttributes(SpyProductLocalizedAttributes $l)
    {
        if ($this->collSpyProductLocalizedAttributess === null) {
            $this->initSpyProductLocalizedAttributess();
            $this->collSpyProductLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyProductLocalizedAttributess->contains($l)) {
            $this->doAddSpyProductLocalizedAttributes($l);

            if ($this->spyProductLocalizedAttributessScheduledForDeletion and $this->spyProductLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyProductLocalizedAttributessScheduledForDeletion->remove($this->spyProductLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductLocalizedAttributes $spyProductLocalizedAttributes The SpyProductLocalizedAttributes object to add.
     */
    protected function doAddSpyProductLocalizedAttributes(SpyProductLocalizedAttributes $spyProductLocalizedAttributes): void
    {
        $this->collSpyProductLocalizedAttributess[]= $spyProductLocalizedAttributes;
        $spyProductLocalizedAttributes->setLocale($this);
    }

    /**
     * @param SpyProductLocalizedAttributes $spyProductLocalizedAttributes The SpyProductLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductLocalizedAttributes(SpyProductLocalizedAttributes $spyProductLocalizedAttributes)
    {
        if ($this->getSpyProductLocalizedAttributess()->contains($spyProductLocalizedAttributes)) {
            $pos = $this->collSpyProductLocalizedAttributess->search($spyProductLocalizedAttributes);
            $this->collSpyProductLocalizedAttributess->remove($pos);
            if (null === $this->spyProductLocalizedAttributessScheduledForDeletion) {
                $this->spyProductLocalizedAttributessScheduledForDeletion = clone $this->collSpyProductLocalizedAttributess;
                $this->spyProductLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyProductLocalizedAttributessScheduledForDeletion[]= clone $spyProductLocalizedAttributes;
            $spyProductLocalizedAttributes->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductLocalizedAttributes[] List of SpyProductLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLocalizedAttributes}> List of SpyProductLocalizedAttributes objects
     */
    public function getSpyProductLocalizedAttributessJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductManagementAttributeValueTranslations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductManagementAttributeValueTranslations()
     */
    public function clearSpyProductManagementAttributeValueTranslations()
    {
        $this->collSpyProductManagementAttributeValueTranslations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductManagementAttributeValueTranslations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductManagementAttributeValueTranslations($v = true): void
    {
        $this->collSpyProductManagementAttributeValueTranslationsPartial = $v;
    }

    /**
     * Initializes the collSpyProductManagementAttributeValueTranslations collection.
     *
     * By default this just sets the collSpyProductManagementAttributeValueTranslations collection to an empty array (like clearcollSpyProductManagementAttributeValueTranslations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductManagementAttributeValueTranslations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductManagementAttributeValueTranslations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductManagementAttributeValueTranslationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductManagementAttributeValueTranslations = new $collectionClassName;
        $this->collSpyProductManagementAttributeValueTranslations->setModel('\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation');
    }

    /**
     * Gets an array of SpyProductManagementAttributeValueTranslation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductManagementAttributeValueTranslation[] List of SpyProductManagementAttributeValueTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductManagementAttributeValueTranslation> List of SpyProductManagementAttributeValueTranslation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductManagementAttributeValueTranslations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductManagementAttributeValueTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyProductManagementAttributeValueTranslations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductManagementAttributeValueTranslations) {
                    $this->initSpyProductManagementAttributeValueTranslations();
                } else {
                    $collectionClassName = SpyProductManagementAttributeValueTranslationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductManagementAttributeValueTranslations = new $collectionClassName;
                    $collSpyProductManagementAttributeValueTranslations->setModel('\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation');

                    return $collSpyProductManagementAttributeValueTranslations;
                }
            } else {
                $collSpyProductManagementAttributeValueTranslations = SpyProductManagementAttributeValueTranslationQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductManagementAttributeValueTranslationsPartial && count($collSpyProductManagementAttributeValueTranslations)) {
                        $this->initSpyProductManagementAttributeValueTranslations(false);

                        foreach ($collSpyProductManagementAttributeValueTranslations as $obj) {
                            if (false == $this->collSpyProductManagementAttributeValueTranslations->contains($obj)) {
                                $this->collSpyProductManagementAttributeValueTranslations->append($obj);
                            }
                        }

                        $this->collSpyProductManagementAttributeValueTranslationsPartial = true;
                    }

                    return $collSpyProductManagementAttributeValueTranslations;
                }

                if ($partial && $this->collSpyProductManagementAttributeValueTranslations) {
                    foreach ($this->collSpyProductManagementAttributeValueTranslations as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductManagementAttributeValueTranslations[] = $obj;
                        }
                    }
                }

                $this->collSpyProductManagementAttributeValueTranslations = $collSpyProductManagementAttributeValueTranslations;
                $this->collSpyProductManagementAttributeValueTranslationsPartial = false;
            }
        }

        return $this->collSpyProductManagementAttributeValueTranslations;
    }

    /**
     * Sets a collection of SpyProductManagementAttributeValueTranslation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductManagementAttributeValueTranslations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductManagementAttributeValueTranslations(Collection $spyProductManagementAttributeValueTranslations, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductManagementAttributeValueTranslation[] $spyProductManagementAttributeValueTranslationsToDelete */
        $spyProductManagementAttributeValueTranslationsToDelete = $this->getSpyProductManagementAttributeValueTranslations(new Criteria(), $con)->diff($spyProductManagementAttributeValueTranslations);


        $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion = $spyProductManagementAttributeValueTranslationsToDelete;

        foreach ($spyProductManagementAttributeValueTranslationsToDelete as $spyProductManagementAttributeValueTranslationRemoved) {
            $spyProductManagementAttributeValueTranslationRemoved->setSpyLocale(null);
        }

        $this->collSpyProductManagementAttributeValueTranslations = null;
        foreach ($spyProductManagementAttributeValueTranslations as $spyProductManagementAttributeValueTranslation) {
            $this->addSpyProductManagementAttributeValueTranslation($spyProductManagementAttributeValueTranslation);
        }

        $this->collSpyProductManagementAttributeValueTranslations = $spyProductManagementAttributeValueTranslations;
        $this->collSpyProductManagementAttributeValueTranslationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductManagementAttributeValueTranslation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductManagementAttributeValueTranslation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductManagementAttributeValueTranslations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductManagementAttributeValueTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyProductManagementAttributeValueTranslations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductManagementAttributeValueTranslations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductManagementAttributeValueTranslations());
            }

            $query = SpyProductManagementAttributeValueTranslationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductManagementAttributeValueTranslations);
    }

    /**
     * Method called to associate a SpyProductManagementAttributeValueTranslation object to this object
     * through the SpyProductManagementAttributeValueTranslation foreign key attribute.
     *
     * @param SpyProductManagementAttributeValueTranslation $l SpyProductManagementAttributeValueTranslation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductManagementAttributeValueTranslation(SpyProductManagementAttributeValueTranslation $l)
    {
        if ($this->collSpyProductManagementAttributeValueTranslations === null) {
            $this->initSpyProductManagementAttributeValueTranslations();
            $this->collSpyProductManagementAttributeValueTranslationsPartial = true;
        }

        if (!$this->collSpyProductManagementAttributeValueTranslations->contains($l)) {
            $this->doAddSpyProductManagementAttributeValueTranslation($l);

            if ($this->spyProductManagementAttributeValueTranslationsScheduledForDeletion and $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->contains($l)) {
                $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->remove($this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductManagementAttributeValueTranslation $spyProductManagementAttributeValueTranslation The SpyProductManagementAttributeValueTranslation object to add.
     */
    protected function doAddSpyProductManagementAttributeValueTranslation(SpyProductManagementAttributeValueTranslation $spyProductManagementAttributeValueTranslation): void
    {
        $this->collSpyProductManagementAttributeValueTranslations[]= $spyProductManagementAttributeValueTranslation;
        $spyProductManagementAttributeValueTranslation->setSpyLocale($this);
    }

    /**
     * @param SpyProductManagementAttributeValueTranslation $spyProductManagementAttributeValueTranslation The SpyProductManagementAttributeValueTranslation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductManagementAttributeValueTranslation(SpyProductManagementAttributeValueTranslation $spyProductManagementAttributeValueTranslation)
    {
        if ($this->getSpyProductManagementAttributeValueTranslations()->contains($spyProductManagementAttributeValueTranslation)) {
            $pos = $this->collSpyProductManagementAttributeValueTranslations->search($spyProductManagementAttributeValueTranslation);
            $this->collSpyProductManagementAttributeValueTranslations->remove($pos);
            if (null === $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion) {
                $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion = clone $this->collSpyProductManagementAttributeValueTranslations;
                $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion->clear();
            }
            $this->spyProductManagementAttributeValueTranslationsScheduledForDeletion[]= clone $spyProductManagementAttributeValueTranslation;
            $spyProductManagementAttributeValueTranslation->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductManagementAttributeValueTranslations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductManagementAttributeValueTranslation[] List of SpyProductManagementAttributeValueTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductManagementAttributeValueTranslation}> List of SpyProductManagementAttributeValueTranslation objects
     */
    public function getSpyProductManagementAttributeValueTranslationsJoinSpyProductManagementAttributeValue(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductManagementAttributeValueTranslationQuery::create(null, $criteria);
        $query->joinWith('SpyProductManagementAttributeValue', $joinBehavior);

        return $this->getSpyProductManagementAttributeValueTranslations($query, $con);
    }

    /**
     * Clears out the collSpyProductDiscontinuedNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductDiscontinuedNotes()
     */
    public function clearSpyProductDiscontinuedNotes()
    {
        $this->collSpyProductDiscontinuedNotes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductDiscontinuedNotes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductDiscontinuedNotes($v = true): void
    {
        $this->collSpyProductDiscontinuedNotesPartial = $v;
    }

    /**
     * Initializes the collSpyProductDiscontinuedNotes collection.
     *
     * By default this just sets the collSpyProductDiscontinuedNotes collection to an empty array (like clearcollSpyProductDiscontinuedNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductDiscontinuedNotes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductDiscontinuedNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductDiscontinuedNoteTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductDiscontinuedNotes = new $collectionClassName;
        $this->collSpyProductDiscontinuedNotes->setModel('\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote');
    }

    /**
     * Gets an array of SpyProductDiscontinuedNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductDiscontinuedNote[] List of SpyProductDiscontinuedNote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductDiscontinuedNote> List of SpyProductDiscontinuedNote objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductDiscontinuedNotes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductDiscontinuedNotesPartial && !$this->isNew();
        if (null === $this->collSpyProductDiscontinuedNotes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductDiscontinuedNotes) {
                    $this->initSpyProductDiscontinuedNotes();
                } else {
                    $collectionClassName = SpyProductDiscontinuedNoteTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductDiscontinuedNotes = new $collectionClassName;
                    $collSpyProductDiscontinuedNotes->setModel('\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote');

                    return $collSpyProductDiscontinuedNotes;
                }
            } else {
                $collSpyProductDiscontinuedNotes = SpyProductDiscontinuedNoteQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductDiscontinuedNotesPartial && count($collSpyProductDiscontinuedNotes)) {
                        $this->initSpyProductDiscontinuedNotes(false);

                        foreach ($collSpyProductDiscontinuedNotes as $obj) {
                            if (false == $this->collSpyProductDiscontinuedNotes->contains($obj)) {
                                $this->collSpyProductDiscontinuedNotes->append($obj);
                            }
                        }

                        $this->collSpyProductDiscontinuedNotesPartial = true;
                    }

                    return $collSpyProductDiscontinuedNotes;
                }

                if ($partial && $this->collSpyProductDiscontinuedNotes) {
                    foreach ($this->collSpyProductDiscontinuedNotes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductDiscontinuedNotes[] = $obj;
                        }
                    }
                }

                $this->collSpyProductDiscontinuedNotes = $collSpyProductDiscontinuedNotes;
                $this->collSpyProductDiscontinuedNotesPartial = false;
            }
        }

        return $this->collSpyProductDiscontinuedNotes;
    }

    /**
     * Sets a collection of SpyProductDiscontinuedNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductDiscontinuedNotes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductDiscontinuedNotes(Collection $spyProductDiscontinuedNotes, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductDiscontinuedNote[] $spyProductDiscontinuedNotesToDelete */
        $spyProductDiscontinuedNotesToDelete = $this->getSpyProductDiscontinuedNotes(new Criteria(), $con)->diff($spyProductDiscontinuedNotes);


        $this->spyProductDiscontinuedNotesScheduledForDeletion = $spyProductDiscontinuedNotesToDelete;

        foreach ($spyProductDiscontinuedNotesToDelete as $spyProductDiscontinuedNoteRemoved) {
            $spyProductDiscontinuedNoteRemoved->setLocale(null);
        }

        $this->collSpyProductDiscontinuedNotes = null;
        foreach ($spyProductDiscontinuedNotes as $spyProductDiscontinuedNote) {
            $this->addSpyProductDiscontinuedNote($spyProductDiscontinuedNote);
        }

        $this->collSpyProductDiscontinuedNotes = $spyProductDiscontinuedNotes;
        $this->collSpyProductDiscontinuedNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductDiscontinuedNote objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductDiscontinuedNote objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductDiscontinuedNotes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductDiscontinuedNotesPartial && !$this->isNew();
        if (null === $this->collSpyProductDiscontinuedNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductDiscontinuedNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductDiscontinuedNotes());
            }

            $query = SpyProductDiscontinuedNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductDiscontinuedNotes);
    }

    /**
     * Method called to associate a SpyProductDiscontinuedNote object to this object
     * through the SpyProductDiscontinuedNote foreign key attribute.
     *
     * @param SpyProductDiscontinuedNote $l SpyProductDiscontinuedNote
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductDiscontinuedNote(SpyProductDiscontinuedNote $l)
    {
        if ($this->collSpyProductDiscontinuedNotes === null) {
            $this->initSpyProductDiscontinuedNotes();
            $this->collSpyProductDiscontinuedNotesPartial = true;
        }

        if (!$this->collSpyProductDiscontinuedNotes->contains($l)) {
            $this->doAddSpyProductDiscontinuedNote($l);

            if ($this->spyProductDiscontinuedNotesScheduledForDeletion and $this->spyProductDiscontinuedNotesScheduledForDeletion->contains($l)) {
                $this->spyProductDiscontinuedNotesScheduledForDeletion->remove($this->spyProductDiscontinuedNotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductDiscontinuedNote $spyProductDiscontinuedNote The SpyProductDiscontinuedNote object to add.
     */
    protected function doAddSpyProductDiscontinuedNote(SpyProductDiscontinuedNote $spyProductDiscontinuedNote): void
    {
        $this->collSpyProductDiscontinuedNotes[]= $spyProductDiscontinuedNote;
        $spyProductDiscontinuedNote->setLocale($this);
    }

    /**
     * @param SpyProductDiscontinuedNote $spyProductDiscontinuedNote The SpyProductDiscontinuedNote object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductDiscontinuedNote(SpyProductDiscontinuedNote $spyProductDiscontinuedNote)
    {
        if ($this->getSpyProductDiscontinuedNotes()->contains($spyProductDiscontinuedNote)) {
            $pos = $this->collSpyProductDiscontinuedNotes->search($spyProductDiscontinuedNote);
            $this->collSpyProductDiscontinuedNotes->remove($pos);
            if (null === $this->spyProductDiscontinuedNotesScheduledForDeletion) {
                $this->spyProductDiscontinuedNotesScheduledForDeletion = clone $this->collSpyProductDiscontinuedNotes;
                $this->spyProductDiscontinuedNotesScheduledForDeletion->clear();
            }
            $this->spyProductDiscontinuedNotesScheduledForDeletion[]= clone $spyProductDiscontinuedNote;
            $spyProductDiscontinuedNote->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductDiscontinuedNotes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductDiscontinuedNote[] List of SpyProductDiscontinuedNote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductDiscontinuedNote}> List of SpyProductDiscontinuedNote objects
     */
    public function getSpyProductDiscontinuedNotesJoinProductDiscontinued(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductDiscontinuedNoteQuery::create(null, $criteria);
        $query->joinWith('ProductDiscontinued', $joinBehavior);

        return $this->getSpyProductDiscontinuedNotes($query, $con);
    }

    /**
     * Clears out the collSpyProductImageSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductImageSets()
     */
    public function clearSpyProductImageSets()
    {
        $this->collSpyProductImageSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductImageSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductImageSets($v = true): void
    {
        $this->collSpyProductImageSetsPartial = $v;
    }

    /**
     * Initializes the collSpyProductImageSets collection.
     *
     * By default this just sets the collSpyProductImageSets collection to an empty array (like clearcollSpyProductImageSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductImageSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductImageSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductImageSets = new $collectionClassName;
        $this->collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');
    }

    /**
     * Gets an array of SpyProductImageSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet> List of SpyProductImageSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductImageSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductImageSets) {
                    $this->initSpyProductImageSets();
                } else {
                    $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductImageSets = new $collectionClassName;
                    $collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');

                    return $collSpyProductImageSets;
                }
            } else {
                $collSpyProductImageSets = SpyProductImageSetQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductImageSetsPartial && count($collSpyProductImageSets)) {
                        $this->initSpyProductImageSets(false);

                        foreach ($collSpyProductImageSets as $obj) {
                            if (false == $this->collSpyProductImageSets->contains($obj)) {
                                $this->collSpyProductImageSets->append($obj);
                            }
                        }

                        $this->collSpyProductImageSetsPartial = true;
                    }

                    return $collSpyProductImageSets;
                }

                if ($partial && $this->collSpyProductImageSets) {
                    foreach ($this->collSpyProductImageSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductImageSets[] = $obj;
                        }
                    }
                }

                $this->collSpyProductImageSets = $collSpyProductImageSets;
                $this->collSpyProductImageSetsPartial = false;
            }
        }

        return $this->collSpyProductImageSets;
    }

    /**
     * Sets a collection of SpyProductImageSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductImageSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductImageSets(Collection $spyProductImageSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductImageSet[] $spyProductImageSetsToDelete */
        $spyProductImageSetsToDelete = $this->getSpyProductImageSets(new Criteria(), $con)->diff($spyProductImageSets);


        $this->spyProductImageSetsScheduledForDeletion = $spyProductImageSetsToDelete;

        foreach ($spyProductImageSetsToDelete as $spyProductImageSetRemoved) {
            $spyProductImageSetRemoved->setSpyLocale(null);
        }

        $this->collSpyProductImageSets = null;
        foreach ($spyProductImageSets as $spyProductImageSet) {
            $this->addSpyProductImageSet($spyProductImageSet);
        }

        $this->collSpyProductImageSets = $spyProductImageSets;
        $this->collSpyProductImageSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductImageSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductImageSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductImageSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductImageSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductImageSets());
            }

            $query = SpyProductImageSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductImageSets);
    }

    /**
     * Method called to associate a SpyProductImageSet object to this object
     * through the SpyProductImageSet foreign key attribute.
     *
     * @param SpyProductImageSet $l SpyProductImageSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductImageSet(SpyProductImageSet $l)
    {
        if ($this->collSpyProductImageSets === null) {
            $this->initSpyProductImageSets();
            $this->collSpyProductImageSetsPartial = true;
        }

        if (!$this->collSpyProductImageSets->contains($l)) {
            $this->doAddSpyProductImageSet($l);

            if ($this->spyProductImageSetsScheduledForDeletion and $this->spyProductImageSetsScheduledForDeletion->contains($l)) {
                $this->spyProductImageSetsScheduledForDeletion->remove($this->spyProductImageSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to add.
     */
    protected function doAddSpyProductImageSet(SpyProductImageSet $spyProductImageSet): void
    {
        $this->collSpyProductImageSets[]= $spyProductImageSet;
        $spyProductImageSet->setSpyLocale($this);
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductImageSet(SpyProductImageSet $spyProductImageSet)
    {
        if ($this->getSpyProductImageSets()->contains($spyProductImageSet)) {
            $pos = $this->collSpyProductImageSets->search($spyProductImageSet);
            $this->collSpyProductImageSets->remove($pos);
            if (null === $this->spyProductImageSetsScheduledForDeletion) {
                $this->spyProductImageSetsScheduledForDeletion = clone $this->collSpyProductImageSets;
                $this->spyProductImageSetsScheduledForDeletion->clear();
            }
            $this->spyProductImageSetsScheduledForDeletion[]= $spyProductImageSet;
            $spyProductImageSet->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyConfigurableBundleTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyConfigurableBundleTemplate', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }

    /**
     * Clears out the collSpyProductLabelLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductLabelLocalizedAttributess()
     */
    public function clearSpyProductLabelLocalizedAttributess()
    {
        $this->collSpyProductLabelLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductLabelLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductLabelLocalizedAttributess($v = true): void
    {
        $this->collSpyProductLabelLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyProductLabelLocalizedAttributess collection.
     *
     * By default this just sets the collSpyProductLabelLocalizedAttributess collection to an empty array (like clearcollSpyProductLabelLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductLabelLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductLabelLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLabelLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLabelLocalizedAttributess = new $collectionClassName;
        $this->collSpyProductLabelLocalizedAttributess->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes');
    }

    /**
     * Gets an array of SpyProductLabelLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductLabelLocalizedAttributes[] List of SpyProductLabelLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelLocalizedAttributes> List of SpyProductLabelLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductLabelLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductLabelLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLabelLocalizedAttributess) {
                    $this->initSpyProductLabelLocalizedAttributess();
                } else {
                    $collectionClassName = SpyProductLabelLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductLabelLocalizedAttributess = new $collectionClassName;
                    $collSpyProductLabelLocalizedAttributess->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes');

                    return $collSpyProductLabelLocalizedAttributess;
                }
            } else {
                $collSpyProductLabelLocalizedAttributess = SpyProductLabelLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductLabelLocalizedAttributessPartial && count($collSpyProductLabelLocalizedAttributess)) {
                        $this->initSpyProductLabelLocalizedAttributess(false);

                        foreach ($collSpyProductLabelLocalizedAttributess as $obj) {
                            if (false == $this->collSpyProductLabelLocalizedAttributess->contains($obj)) {
                                $this->collSpyProductLabelLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyProductLabelLocalizedAttributessPartial = true;
                    }

                    return $collSpyProductLabelLocalizedAttributess;
                }

                if ($partial && $this->collSpyProductLabelLocalizedAttributess) {
                    foreach ($this->collSpyProductLabelLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductLabelLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLabelLocalizedAttributess = $collSpyProductLabelLocalizedAttributess;
                $this->collSpyProductLabelLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyProductLabelLocalizedAttributess;
    }

    /**
     * Sets a collection of SpyProductLabelLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLabelLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLabelLocalizedAttributess(Collection $spyProductLabelLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductLabelLocalizedAttributes[] $spyProductLabelLocalizedAttributessToDelete */
        $spyProductLabelLocalizedAttributessToDelete = $this->getSpyProductLabelLocalizedAttributess(new Criteria(), $con)->diff($spyProductLabelLocalizedAttributess);


        $this->spyProductLabelLocalizedAttributessScheduledForDeletion = $spyProductLabelLocalizedAttributessToDelete;

        foreach ($spyProductLabelLocalizedAttributessToDelete as $spyProductLabelLocalizedAttributesRemoved) {
            $spyProductLabelLocalizedAttributesRemoved->setSpyLocale(null);
        }

        $this->collSpyProductLabelLocalizedAttributess = null;
        foreach ($spyProductLabelLocalizedAttributess as $spyProductLabelLocalizedAttributes) {
            $this->addSpyProductLabelLocalizedAttributes($spyProductLabelLocalizedAttributes);
        }

        $this->collSpyProductLabelLocalizedAttributess = $spyProductLabelLocalizedAttributess;
        $this->collSpyProductLabelLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductLabelLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductLabelLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductLabelLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductLabelLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLabelLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductLabelLocalizedAttributess());
            }

            $query = SpyProductLabelLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductLabelLocalizedAttributess);
    }

    /**
     * Method called to associate a SpyProductLabelLocalizedAttributes object to this object
     * through the SpyProductLabelLocalizedAttributes foreign key attribute.
     *
     * @param SpyProductLabelLocalizedAttributes $l SpyProductLabelLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductLabelLocalizedAttributes(SpyProductLabelLocalizedAttributes $l)
    {
        if ($this->collSpyProductLabelLocalizedAttributess === null) {
            $this->initSpyProductLabelLocalizedAttributess();
            $this->collSpyProductLabelLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyProductLabelLocalizedAttributess->contains($l)) {
            $this->doAddSpyProductLabelLocalizedAttributes($l);

            if ($this->spyProductLabelLocalizedAttributessScheduledForDeletion and $this->spyProductLabelLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion->remove($this->spyProductLabelLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes The SpyProductLabelLocalizedAttributes object to add.
     */
    protected function doAddSpyProductLabelLocalizedAttributes(SpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes): void
    {
        $this->collSpyProductLabelLocalizedAttributess[]= $spyProductLabelLocalizedAttributes;
        $spyProductLabelLocalizedAttributes->setSpyLocale($this);
    }

    /**
     * @param SpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes The SpyProductLabelLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductLabelLocalizedAttributes(SpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes)
    {
        if ($this->getSpyProductLabelLocalizedAttributess()->contains($spyProductLabelLocalizedAttributes)) {
            $pos = $this->collSpyProductLabelLocalizedAttributess->search($spyProductLabelLocalizedAttributes);
            $this->collSpyProductLabelLocalizedAttributess->remove($pos);
            if (null === $this->spyProductLabelLocalizedAttributessScheduledForDeletion) {
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion = clone $this->collSpyProductLabelLocalizedAttributess;
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyProductLabelLocalizedAttributessScheduledForDeletion[]= clone $spyProductLabelLocalizedAttributes;
            $spyProductLabelLocalizedAttributes->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductLabelLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductLabelLocalizedAttributes[] List of SpyProductLabelLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelLocalizedAttributes}> List of SpyProductLabelLocalizedAttributes objects
     */
    public function getSpyProductLabelLocalizedAttributessJoinSpyProductLabel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductLabelLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyProductLabel', $joinBehavior);

        return $this->getSpyProductLabelLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductReviews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductReviews()
     */
    public function clearSpyProductReviews()
    {
        $this->collSpyProductReviews = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductReviews collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductReviews($v = true): void
    {
        $this->collSpyProductReviewsPartial = $v;
    }

    /**
     * Initializes the collSpyProductReviews collection.
     *
     * By default this just sets the collSpyProductReviews collection to an empty array (like clearcollSpyProductReviews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductReviews(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductReviews && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductReviewTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductReviews = new $collectionClassName;
        $this->collSpyProductReviews->setModel('\Orm\Zed\ProductReview\Persistence\SpyProductReview');
    }

    /**
     * Gets an array of SpyProductReview objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductReview[] List of SpyProductReview objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductReview> List of SpyProductReview objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductReviews(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductReviewsPartial && !$this->isNew();
        if (null === $this->collSpyProductReviews || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductReviews) {
                    $this->initSpyProductReviews();
                } else {
                    $collectionClassName = SpyProductReviewTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductReviews = new $collectionClassName;
                    $collSpyProductReviews->setModel('\Orm\Zed\ProductReview\Persistence\SpyProductReview');

                    return $collSpyProductReviews;
                }
            } else {
                $collSpyProductReviews = SpyProductReviewQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductReviewsPartial && count($collSpyProductReviews)) {
                        $this->initSpyProductReviews(false);

                        foreach ($collSpyProductReviews as $obj) {
                            if (false == $this->collSpyProductReviews->contains($obj)) {
                                $this->collSpyProductReviews->append($obj);
                            }
                        }

                        $this->collSpyProductReviewsPartial = true;
                    }

                    return $collSpyProductReviews;
                }

                if ($partial && $this->collSpyProductReviews) {
                    foreach ($this->collSpyProductReviews as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductReviews[] = $obj;
                        }
                    }
                }

                $this->collSpyProductReviews = $collSpyProductReviews;
                $this->collSpyProductReviewsPartial = false;
            }
        }

        return $this->collSpyProductReviews;
    }

    /**
     * Sets a collection of SpyProductReview objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductReviews A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductReviews(Collection $spyProductReviews, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductReview[] $spyProductReviewsToDelete */
        $spyProductReviewsToDelete = $this->getSpyProductReviews(new Criteria(), $con)->diff($spyProductReviews);


        $this->spyProductReviewsScheduledForDeletion = $spyProductReviewsToDelete;

        foreach ($spyProductReviewsToDelete as $spyProductReviewRemoved) {
            $spyProductReviewRemoved->setSpyLocale(null);
        }

        $this->collSpyProductReviews = null;
        foreach ($spyProductReviews as $spyProductReview) {
            $this->addSpyProductReview($spyProductReview);
        }

        $this->collSpyProductReviews = $spyProductReviews;
        $this->collSpyProductReviewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductReview objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductReview objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductReviews(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductReviewsPartial && !$this->isNew();
        if (null === $this->collSpyProductReviews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductReviews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductReviews());
            }

            $query = SpyProductReviewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductReviews);
    }

    /**
     * Method called to associate a SpyProductReview object to this object
     * through the SpyProductReview foreign key attribute.
     *
     * @param SpyProductReview $l SpyProductReview
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductReview(SpyProductReview $l)
    {
        if ($this->collSpyProductReviews === null) {
            $this->initSpyProductReviews();
            $this->collSpyProductReviewsPartial = true;
        }

        if (!$this->collSpyProductReviews->contains($l)) {
            $this->doAddSpyProductReview($l);

            if ($this->spyProductReviewsScheduledForDeletion and $this->spyProductReviewsScheduledForDeletion->contains($l)) {
                $this->spyProductReviewsScheduledForDeletion->remove($this->spyProductReviewsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductReview $spyProductReview The SpyProductReview object to add.
     */
    protected function doAddSpyProductReview(SpyProductReview $spyProductReview): void
    {
        $this->collSpyProductReviews[]= $spyProductReview;
        $spyProductReview->setSpyLocale($this);
    }

    /**
     * @param SpyProductReview $spyProductReview The SpyProductReview object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductReview(SpyProductReview $spyProductReview)
    {
        if ($this->getSpyProductReviews()->contains($spyProductReview)) {
            $pos = $this->collSpyProductReviews->search($spyProductReview);
            $this->collSpyProductReviews->remove($pos);
            if (null === $this->spyProductReviewsScheduledForDeletion) {
                $this->spyProductReviewsScheduledForDeletion = clone $this->collSpyProductReviews;
                $this->spyProductReviewsScheduledForDeletion->clear();
            }
            $this->spyProductReviewsScheduledForDeletion[]= clone $spyProductReview;
            $spyProductReview->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductReview[] List of SpyProductReview objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductReview}> List of SpyProductReview objects
     */
    public function getSpyProductReviewsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductReviewQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductReviews($query, $con);
    }

    /**
     * Clears out the collSpyProductSearches collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductSearches()
     */
    public function clearSpyProductSearches()
    {
        $this->collSpyProductSearches = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductSearches collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductSearches($v = true): void
    {
        $this->collSpyProductSearchesPartial = $v;
    }

    /**
     * Initializes the collSpyProductSearches collection.
     *
     * By default this just sets the collSpyProductSearches collection to an empty array (like clearcollSpyProductSearches());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductSearches(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductSearches && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductSearchTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductSearches = new $collectionClassName;
        $this->collSpyProductSearches->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearch');
    }

    /**
     * Gets an array of SpyProductSearch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductSearch[] List of SpyProductSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSearch> List of SpyProductSearch objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSearches(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductSearchesPartial && !$this->isNew();
        if (null === $this->collSpyProductSearches || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductSearches) {
                    $this->initSpyProductSearches();
                } else {
                    $collectionClassName = SpyProductSearchTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductSearches = new $collectionClassName;
                    $collSpyProductSearches->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearch');

                    return $collSpyProductSearches;
                }
            } else {
                $collSpyProductSearches = SpyProductSearchQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductSearchesPartial && count($collSpyProductSearches)) {
                        $this->initSpyProductSearches(false);

                        foreach ($collSpyProductSearches as $obj) {
                            if (false == $this->collSpyProductSearches->contains($obj)) {
                                $this->collSpyProductSearches->append($obj);
                            }
                        }

                        $this->collSpyProductSearchesPartial = true;
                    }

                    return $collSpyProductSearches;
                }

                if ($partial && $this->collSpyProductSearches) {
                    foreach ($this->collSpyProductSearches as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductSearches[] = $obj;
                        }
                    }
                }

                $this->collSpyProductSearches = $collSpyProductSearches;
                $this->collSpyProductSearchesPartial = false;
            }
        }

        return $this->collSpyProductSearches;
    }

    /**
     * Sets a collection of SpyProductSearch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductSearches A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductSearches(Collection $spyProductSearches, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductSearch[] $spyProductSearchesToDelete */
        $spyProductSearchesToDelete = $this->getSpyProductSearches(new Criteria(), $con)->diff($spyProductSearches);


        $this->spyProductSearchesScheduledForDeletion = $spyProductSearchesToDelete;

        foreach ($spyProductSearchesToDelete as $spyProductSearchRemoved) {
            $spyProductSearchRemoved->setSpyLocale(null);
        }

        $this->collSpyProductSearches = null;
        foreach ($spyProductSearches as $spyProductSearch) {
            $this->addSpyProductSearch($spyProductSearch);
        }

        $this->collSpyProductSearches = $spyProductSearches;
        $this->collSpyProductSearchesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductSearch objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductSearch objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductSearches(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductSearchesPartial && !$this->isNew();
        if (null === $this->collSpyProductSearches || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductSearches) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductSearches());
            }

            $query = SpyProductSearchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductSearches);
    }

    /**
     * Method called to associate a SpyProductSearch object to this object
     * through the SpyProductSearch foreign key attribute.
     *
     * @param SpyProductSearch $l SpyProductSearch
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductSearch(SpyProductSearch $l)
    {
        if ($this->collSpyProductSearches === null) {
            $this->initSpyProductSearches();
            $this->collSpyProductSearchesPartial = true;
        }

        if (!$this->collSpyProductSearches->contains($l)) {
            $this->doAddSpyProductSearch($l);

            if ($this->spyProductSearchesScheduledForDeletion and $this->spyProductSearchesScheduledForDeletion->contains($l)) {
                $this->spyProductSearchesScheduledForDeletion->remove($this->spyProductSearchesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductSearch $spyProductSearch The SpyProductSearch object to add.
     */
    protected function doAddSpyProductSearch(SpyProductSearch $spyProductSearch): void
    {
        $this->collSpyProductSearches[]= $spyProductSearch;
        $spyProductSearch->setSpyLocale($this);
    }

    /**
     * @param SpyProductSearch $spyProductSearch The SpyProductSearch object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductSearch(SpyProductSearch $spyProductSearch)
    {
        if ($this->getSpyProductSearches()->contains($spyProductSearch)) {
            $pos = $this->collSpyProductSearches->search($spyProductSearch);
            $this->collSpyProductSearches->remove($pos);
            if (null === $this->spyProductSearchesScheduledForDeletion) {
                $this->spyProductSearchesScheduledForDeletion = clone $this->collSpyProductSearches;
                $this->spyProductSearchesScheduledForDeletion->clear();
            }
            $this->spyProductSearchesScheduledForDeletion[]= $spyProductSearch;
            $spyProductSearch->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductSearch[] List of SpyProductSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSearch}> List of SpyProductSearch objects
     */
    public function getSpyProductSearchesJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductSearchQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductSearches($query, $con);
    }

    /**
     * Clears out the collSpyProductSetDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductSetDatas()
     */
    public function clearSpyProductSetDatas()
    {
        $this->collSpyProductSetDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductSetDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductSetDatas($v = true): void
    {
        $this->collSpyProductSetDatasPartial = $v;
    }

    /**
     * Initializes the collSpyProductSetDatas collection.
     *
     * By default this just sets the collSpyProductSetDatas collection to an empty array (like clearcollSpyProductSetDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductSetDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductSetDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductSetDataTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductSetDatas = new $collectionClassName;
        $this->collSpyProductSetDatas->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductSetData');
    }

    /**
     * Gets an array of SpyProductSetData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductSetData[] List of SpyProductSetData objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSetData> List of SpyProductSetData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSetDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductSetDatasPartial && !$this->isNew();
        if (null === $this->collSpyProductSetDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductSetDatas) {
                    $this->initSpyProductSetDatas();
                } else {
                    $collectionClassName = SpyProductSetDataTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductSetDatas = new $collectionClassName;
                    $collSpyProductSetDatas->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductSetData');

                    return $collSpyProductSetDatas;
                }
            } else {
                $collSpyProductSetDatas = SpyProductSetDataQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductSetDatasPartial && count($collSpyProductSetDatas)) {
                        $this->initSpyProductSetDatas(false);

                        foreach ($collSpyProductSetDatas as $obj) {
                            if (false == $this->collSpyProductSetDatas->contains($obj)) {
                                $this->collSpyProductSetDatas->append($obj);
                            }
                        }

                        $this->collSpyProductSetDatasPartial = true;
                    }

                    return $collSpyProductSetDatas;
                }

                if ($partial && $this->collSpyProductSetDatas) {
                    foreach ($this->collSpyProductSetDatas as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductSetDatas[] = $obj;
                        }
                    }
                }

                $this->collSpyProductSetDatas = $collSpyProductSetDatas;
                $this->collSpyProductSetDatasPartial = false;
            }
        }

        return $this->collSpyProductSetDatas;
    }

    /**
     * Sets a collection of SpyProductSetData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductSetDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductSetDatas(Collection $spyProductSetDatas, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductSetData[] $spyProductSetDatasToDelete */
        $spyProductSetDatasToDelete = $this->getSpyProductSetDatas(new Criteria(), $con)->diff($spyProductSetDatas);


        $this->spyProductSetDatasScheduledForDeletion = $spyProductSetDatasToDelete;

        foreach ($spyProductSetDatasToDelete as $spyProductSetDataRemoved) {
            $spyProductSetDataRemoved->setSpyLocale(null);
        }

        $this->collSpyProductSetDatas = null;
        foreach ($spyProductSetDatas as $spyProductSetData) {
            $this->addSpyProductSetData($spyProductSetData);
        }

        $this->collSpyProductSetDatas = $spyProductSetDatas;
        $this->collSpyProductSetDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductSetData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductSetData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductSetDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductSetDatasPartial && !$this->isNew();
        if (null === $this->collSpyProductSetDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductSetDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductSetDatas());
            }

            $query = SpyProductSetDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyProductSetDatas);
    }

    /**
     * Method called to associate a SpyProductSetData object to this object
     * through the SpyProductSetData foreign key attribute.
     *
     * @param SpyProductSetData $l SpyProductSetData
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductSetData(SpyProductSetData $l)
    {
        if ($this->collSpyProductSetDatas === null) {
            $this->initSpyProductSetDatas();
            $this->collSpyProductSetDatasPartial = true;
        }

        if (!$this->collSpyProductSetDatas->contains($l)) {
            $this->doAddSpyProductSetData($l);

            if ($this->spyProductSetDatasScheduledForDeletion and $this->spyProductSetDatasScheduledForDeletion->contains($l)) {
                $this->spyProductSetDatasScheduledForDeletion->remove($this->spyProductSetDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductSetData $spyProductSetData The SpyProductSetData object to add.
     */
    protected function doAddSpyProductSetData(SpyProductSetData $spyProductSetData): void
    {
        $this->collSpyProductSetDatas[]= $spyProductSetData;
        $spyProductSetData->setSpyLocale($this);
    }

    /**
     * @param SpyProductSetData $spyProductSetData The SpyProductSetData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductSetData(SpyProductSetData $spyProductSetData)
    {
        if ($this->getSpyProductSetDatas()->contains($spyProductSetData)) {
            $pos = $this->collSpyProductSetDatas->search($spyProductSetData);
            $this->collSpyProductSetDatas->remove($pos);
            if (null === $this->spyProductSetDatasScheduledForDeletion) {
                $this->spyProductSetDatasScheduledForDeletion = clone $this->collSpyProductSetDatas;
                $this->spyProductSetDatasScheduledForDeletion->clear();
            }
            $this->spyProductSetDatasScheduledForDeletion[]= clone $spyProductSetData;
            $spyProductSetData->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyProductSetDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductSetData[] List of SpyProductSetData objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSetData}> List of SpyProductSetData objects
     */
    public function getSpyProductSetDatasJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductSetDataQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyProductSetDatas($query, $con);
    }

    /**
     * Clears out the collSpySalesOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrders()
     */
    public function clearSpySalesOrders()
    {
        $this->collSpySalesOrders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrders($v = true): void
    {
        $this->collSpySalesOrdersPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrders collection.
     *
     * By default this just sets the collSpySalesOrders collection to an empty array (like clearcollSpySalesOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrders(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrders = new $collectionClassName;
        $this->collSpySalesOrders->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrder');
    }

    /**
     * Gets an array of SpySalesOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrder[] List of SpySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrder> List of SpySalesOrder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrders) {
                    $this->initSpySalesOrders();
                } else {
                    $collectionClassName = SpySalesOrderTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrders = new $collectionClassName;
                    $collSpySalesOrders->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrder');

                    return $collSpySalesOrders;
                }
            } else {
                $collSpySalesOrders = SpySalesOrderQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrdersPartial && count($collSpySalesOrders)) {
                        $this->initSpySalesOrders(false);

                        foreach ($collSpySalesOrders as $obj) {
                            if (false == $this->collSpySalesOrders->contains($obj)) {
                                $this->collSpySalesOrders->append($obj);
                            }
                        }

                        $this->collSpySalesOrdersPartial = true;
                    }

                    return $collSpySalesOrders;
                }

                if ($partial && $this->collSpySalesOrders) {
                    foreach ($this->collSpySalesOrders as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrders[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrders = $collSpySalesOrders;
                $this->collSpySalesOrdersPartial = false;
            }
        }

        return $this->collSpySalesOrders;
    }

    /**
     * Sets a collection of SpySalesOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrders(Collection $spySalesOrders, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrder[] $spySalesOrdersToDelete */
        $spySalesOrdersToDelete = $this->getSpySalesOrders(new Criteria(), $con)->diff($spySalesOrders);


        $this->spySalesOrdersScheduledForDeletion = $spySalesOrdersToDelete;

        foreach ($spySalesOrdersToDelete as $spySalesOrderRemoved) {
            $spySalesOrderRemoved->setLocale(null);
        }

        $this->collSpySalesOrders = null;
        foreach ($spySalesOrders as $spySalesOrder) {
            $this->addSpySalesOrder($spySalesOrder);
        }

        $this->collSpySalesOrders = $spySalesOrders;
        $this->collSpySalesOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrders());
            }

            $query = SpySalesOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpySalesOrders);
    }

    /**
     * Method called to associate a SpySalesOrder object to this object
     * through the SpySalesOrder foreign key attribute.
     *
     * @param SpySalesOrder $l SpySalesOrder
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrder(SpySalesOrder $l)
    {
        if ($this->collSpySalesOrders === null) {
            $this->initSpySalesOrders();
            $this->collSpySalesOrdersPartial = true;
        }

        if (!$this->collSpySalesOrders->contains($l)) {
            $this->doAddSpySalesOrder($l);

            if ($this->spySalesOrdersScheduledForDeletion and $this->spySalesOrdersScheduledForDeletion->contains($l)) {
                $this->spySalesOrdersScheduledForDeletion->remove($this->spySalesOrdersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrder $spySalesOrder The SpySalesOrder object to add.
     */
    protected function doAddSpySalesOrder(SpySalesOrder $spySalesOrder): void
    {
        $this->collSpySalesOrders[]= $spySalesOrder;
        $spySalesOrder->setLocale($this);
    }

    /**
     * @param SpySalesOrder $spySalesOrder The SpySalesOrder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrder(SpySalesOrder $spySalesOrder)
    {
        if ($this->getSpySalesOrders()->contains($spySalesOrder)) {
            $pos = $this->collSpySalesOrders->search($spySalesOrder);
            $this->collSpySalesOrders->remove($pos);
            if (null === $this->spySalesOrdersScheduledForDeletion) {
                $this->spySalesOrdersScheduledForDeletion = clone $this->collSpySalesOrders;
                $this->spySalesOrdersScheduledForDeletion->clear();
            }
            $this->spySalesOrdersScheduledForDeletion[]= $spySalesOrder;
            $spySalesOrder->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpySalesOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrder[] List of SpySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrder}> List of SpySalesOrder objects
     */
    public function getSpySalesOrdersJoinBillingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderQuery::create(null, $criteria);
        $query->joinWith('BillingAddress', $joinBehavior);

        return $this->getSpySalesOrders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpySalesOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrder[] List of SpySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrder}> List of SpySalesOrder objects
     */
    public function getSpySalesOrdersJoinShippingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderQuery::create(null, $criteria);
        $query->joinWith('ShippingAddress', $joinBehavior);

        return $this->getSpySalesOrders($query, $con);
    }

    /**
     * Clears out the collStoreDefaults collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStoreDefaults()
     */
    public function clearStoreDefaults()
    {
        $this->collStoreDefaults = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStoreDefaults collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStoreDefaults($v = true): void
    {
        $this->collStoreDefaultsPartial = $v;
    }

    /**
     * Initializes the collStoreDefaults collection.
     *
     * By default this just sets the collStoreDefaults collection to an empty array (like clearcollStoreDefaults());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStoreDefaults(bool $overrideExisting = true): void
    {
        if (null !== $this->collStoreDefaults && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collStoreDefaults = new $collectionClassName;
        $this->collStoreDefaults->setModel('\Orm\Zed\Store\Persistence\SpyStore');
    }

    /**
     * Gets an array of SpyStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyStore[] List of SpyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStore> List of SpyStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStoreDefaults(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStoreDefaultsPartial && !$this->isNew();
        if (null === $this->collStoreDefaults || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStoreDefaults) {
                    $this->initStoreDefaults();
                } else {
                    $collectionClassName = SpyStoreTableMap::getTableMap()->getCollectionClassName();

                    $collStoreDefaults = new $collectionClassName;
                    $collStoreDefaults->setModel('\Orm\Zed\Store\Persistence\SpyStore');

                    return $collStoreDefaults;
                }
            } else {
                $collStoreDefaults = SpyStoreQuery::create(null, $criteria)
                    ->filterByDefaultLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStoreDefaultsPartial && count($collStoreDefaults)) {
                        $this->initStoreDefaults(false);

                        foreach ($collStoreDefaults as $obj) {
                            if (false == $this->collStoreDefaults->contains($obj)) {
                                $this->collStoreDefaults->append($obj);
                            }
                        }

                        $this->collStoreDefaultsPartial = true;
                    }

                    return $collStoreDefaults;
                }

                if ($partial && $this->collStoreDefaults) {
                    foreach ($this->collStoreDefaults as $obj) {
                        if ($obj->isNew()) {
                            $collStoreDefaults[] = $obj;
                        }
                    }
                }

                $this->collStoreDefaults = $collStoreDefaults;
                $this->collStoreDefaultsPartial = false;
            }
        }

        return $this->collStoreDefaults;
    }

    /**
     * Sets a collection of SpyStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $storeDefaults A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStoreDefaults(Collection $storeDefaults, ?ConnectionInterface $con = null)
    {
        /** @var SpyStore[] $storeDefaultsToDelete */
        $storeDefaultsToDelete = $this->getStoreDefaults(new Criteria(), $con)->diff($storeDefaults);


        $this->storeDefaultsScheduledForDeletion = $storeDefaultsToDelete;

        foreach ($storeDefaultsToDelete as $storeDefaultRemoved) {
            $storeDefaultRemoved->setDefaultLocale(null);
        }

        $this->collStoreDefaults = null;
        foreach ($storeDefaults as $storeDefault) {
            $this->addStoreDefault($storeDefault);
        }

        $this->collStoreDefaults = $storeDefaults;
        $this->collStoreDefaultsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStoreDefaults(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStoreDefaultsPartial && !$this->isNew();
        if (null === $this->collStoreDefaults || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStoreDefaults) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStoreDefaults());
            }

            $query = SpyStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDefaultLocale($this)
                ->count($con);
        }

        return count($this->collStoreDefaults);
    }

    /**
     * Method called to associate a SpyStore object to this object
     * through the SpyStore foreign key attribute.
     *
     * @param SpyStore $l SpyStore
     * @return $this The current object (for fluent API support)
     */
    public function addStoreDefault(SpyStore $l)
    {
        if ($this->collStoreDefaults === null) {
            $this->initStoreDefaults();
            $this->collStoreDefaultsPartial = true;
        }

        if (!$this->collStoreDefaults->contains($l)) {
            $this->doAddStoreDefault($l);

            if ($this->storeDefaultsScheduledForDeletion and $this->storeDefaultsScheduledForDeletion->contains($l)) {
                $this->storeDefaultsScheduledForDeletion->remove($this->storeDefaultsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyStore $storeDefault The SpyStore object to add.
     */
    protected function doAddStoreDefault(SpyStore $storeDefault): void
    {
        $this->collStoreDefaults[]= $storeDefault;
        $storeDefault->setDefaultLocale($this);
    }

    /**
     * @param SpyStore $storeDefault The SpyStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStoreDefault(SpyStore $storeDefault)
    {
        if ($this->getStoreDefaults()->contains($storeDefault)) {
            $pos = $this->collStoreDefaults->search($storeDefault);
            $this->collStoreDefaults->remove($pos);
            if (null === $this->storeDefaultsScheduledForDeletion) {
                $this->storeDefaultsScheduledForDeletion = clone $this->collStoreDefaults;
                $this->storeDefaultsScheduledForDeletion->clear();
            }
            $this->storeDefaultsScheduledForDeletion[]= $storeDefault;
            $storeDefault->setDefaultLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related StoreDefaults from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStore[] List of SpyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStore}> List of SpyStore objects
     */
    public function getStoreDefaultsJoinDefaultCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStoreQuery::create(null, $criteria);
        $query->joinWith('DefaultCurrency', $joinBehavior);

        return $this->getStoreDefaults($query, $con);
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
     * If this ChildSpyLocale is new, it will return
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
                    ->filterByLocale($this)
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
            $touchStorageRemoved->setLocale(null);
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
                ->filterByLocale($this)
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
        $touchStorage->setLocale($this);
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
            $this->touchStoragesScheduledForDeletion[]= clone $touchStorage;
            $touchStorage->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
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
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage}> List of SpyTouchStorage objects
     */
    public function getTouchStoragesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchStorageQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

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
     * If this ChildSpyLocale is new, it will return
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
                    ->filterByLocale($this)
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
            $touchSearchRemoved->setLocale(null);
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
                ->filterByLocale($this)
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
        $touchSearch->setLocale($this);
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
            $this->touchSearchesScheduledForDeletion[]= clone $touchSearch;
            $touchSearch->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
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
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch}> List of SpyTouchSearch objects
     */
    public function getTouchSearchesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchSearchQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getTouchSearches($query, $con);
    }

    /**
     * Clears out the collSpyUrls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyUrls()
     */
    public function clearSpyUrls()
    {
        $this->collSpyUrls = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyUrls collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyUrls($v = true): void
    {
        $this->collSpyUrlsPartial = $v;
    }

    /**
     * Initializes the collSpyUrls collection.
     *
     * By default this just sets the collSpyUrls collection to an empty array (like clearcollSpyUrls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyUrls(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyUrls && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUrls = new $collectionClassName;
        $this->collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');
    }

    /**
     * Gets an array of SpyUrl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl> List of SpyUrl objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUrls(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUrls) {
                    $this->initSpyUrls();
                } else {
                    $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

                    $collSpyUrls = new $collectionClassName;
                    $collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');

                    return $collSpyUrls;
                }
            } else {
                $collSpyUrls = SpyUrlQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyUrlsPartial && count($collSpyUrls)) {
                        $this->initSpyUrls(false);

                        foreach ($collSpyUrls as $obj) {
                            if (false == $this->collSpyUrls->contains($obj)) {
                                $this->collSpyUrls->append($obj);
                            }
                        }

                        $this->collSpyUrlsPartial = true;
                    }

                    return $collSpyUrls;
                }

                if ($partial && $this->collSpyUrls) {
                    foreach ($this->collSpyUrls as $obj) {
                        if ($obj->isNew()) {
                            $collSpyUrls[] = $obj;
                        }
                    }
                }

                $this->collSpyUrls = $collSpyUrls;
                $this->collSpyUrlsPartial = false;
            }
        }

        return $this->collSpyUrls;
    }

    /**
     * Sets a collection of SpyUrl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUrls A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUrls(Collection $spyUrls, ?ConnectionInterface $con = null)
    {
        /** @var SpyUrl[] $spyUrlsToDelete */
        $spyUrlsToDelete = $this->getSpyUrls(new Criteria(), $con)->diff($spyUrls);


        $this->spyUrlsScheduledForDeletion = $spyUrlsToDelete;

        foreach ($spyUrlsToDelete as $spyUrlRemoved) {
            $spyUrlRemoved->setSpyLocale(null);
        }

        $this->collSpyUrls = null;
        foreach ($spyUrls as $spyUrl) {
            $this->addSpyUrl($spyUrl);
        }

        $this->collSpyUrls = $spyUrls;
        $this->collSpyUrlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyUrl objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyUrl objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyUrls(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUrls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyUrls());
            }

            $query = SpyUrlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyUrls);
    }

    /**
     * Method called to associate a SpyUrl object to this object
     * through the SpyUrl foreign key attribute.
     *
     * @param SpyUrl $l SpyUrl
     * @return $this The current object (for fluent API support)
     */
    public function addSpyUrl(SpyUrl $l)
    {
        if ($this->collSpyUrls === null) {
            $this->initSpyUrls();
            $this->collSpyUrlsPartial = true;
        }

        if (!$this->collSpyUrls->contains($l)) {
            $this->doAddSpyUrl($l);

            if ($this->spyUrlsScheduledForDeletion and $this->spyUrlsScheduledForDeletion->contains($l)) {
                $this->spyUrlsScheduledForDeletion->remove($this->spyUrlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to add.
     */
    protected function doAddSpyUrl(SpyUrl $spyUrl): void
    {
        $this->collSpyUrls[]= $spyUrl;
        $spyUrl->setSpyLocale($this);
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyUrl(SpyUrl $spyUrl)
    {
        if ($this->getSpyUrls()->contains($spyUrl)) {
            $pos = $this->collSpyUrls->search($spyUrl);
            $this->collSpyUrls->remove($pos);
            if (null === $this->spyUrlsScheduledForDeletion) {
                $this->spyUrlsScheduledForDeletion = clone $this->collSpyUrls;
                $this->spyUrlsScheduledForDeletion->clear();
            }
            $this->spyUrlsScheduledForDeletion[]= clone $spyUrl;
            $spyUrl->setSpyLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyCategoryNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyCategoryNode', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinCmsPage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('CmsPage', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyUrlRedirect(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyUrlRedirect', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }

    /**
     * Clears out the collSpyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyUsers()
     */
    public function clearSpyUsers()
    {
        $this->collSpyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyUsers($v = true): void
    {
        $this->collSpyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyUsers collection.
     *
     * By default this just sets the collSpyUsers collection to an empty array (like clearcollSpyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUsers = new $collectionClassName;
        $this->collSpyUsers->setModel('\Orm\Zed\User\Persistence\SpyUser');
    }

    /**
     * Gets an array of SpyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyUser[] List of SpyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUser> List of SpyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUsersPartial && !$this->isNew();
        if (null === $this->collSpyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUsers) {
                    $this->initSpyUsers();
                } else {
                    $collectionClassName = SpyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyUsers = new $collectionClassName;
                    $collSpyUsers->setModel('\Orm\Zed\User\Persistence\SpyUser');

                    return $collSpyUsers;
                }
            } else {
                $collSpyUsers = SpyUserQuery::create(null, $criteria)
                    ->filterBySpyLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyUsersPartial && count($collSpyUsers)) {
                        $this->initSpyUsers(false);

                        foreach ($collSpyUsers as $obj) {
                            if (false == $this->collSpyUsers->contains($obj)) {
                                $this->collSpyUsers->append($obj);
                            }
                        }

                        $this->collSpyUsersPartial = true;
                    }

                    return $collSpyUsers;
                }

                if ($partial && $this->collSpyUsers) {
                    foreach ($this->collSpyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyUsers = $collSpyUsers;
                $this->collSpyUsersPartial = false;
            }
        }

        return $this->collSpyUsers;
    }

    /**
     * Sets a collection of SpyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUsers(Collection $spyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyUser[] $spyUsersToDelete */
        $spyUsersToDelete = $this->getSpyUsers(new Criteria(), $con)->diff($spyUsers);


        $this->spyUsersScheduledForDeletion = $spyUsersToDelete;

        foreach ($spyUsersToDelete as $spyUserRemoved) {
            $spyUserRemoved->setSpyLocale(null);
        }

        $this->collSpyUsers = null;
        foreach ($spyUsers as $spyUser) {
            $this->addSpyUser($spyUser);
        }

        $this->collSpyUsers = $spyUsers;
        $this->collSpyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUsersPartial && !$this->isNew();
        if (null === $this->collSpyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyUsers());
            }

            $query = SpyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyLocale($this)
                ->count($con);
        }

        return count($this->collSpyUsers);
    }

    /**
     * Method called to associate a SpyUser object to this object
     * through the SpyUser foreign key attribute.
     *
     * @param SpyUser $l SpyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyUser(SpyUser $l)
    {
        if ($this->collSpyUsers === null) {
            $this->initSpyUsers();
            $this->collSpyUsersPartial = true;
        }

        if (!$this->collSpyUsers->contains($l)) {
            $this->doAddSpyUser($l);

            if ($this->spyUsersScheduledForDeletion and $this->spyUsersScheduledForDeletion->contains($l)) {
                $this->spyUsersScheduledForDeletion->remove($this->spyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyUser $spyUser The SpyUser object to add.
     */
    protected function doAddSpyUser(SpyUser $spyUser): void
    {
        $this->collSpyUsers[]= $spyUser;
        $spyUser->setSpyLocale($this);
    }

    /**
     * @param SpyUser $spyUser The SpyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyUser(SpyUser $spyUser)
    {
        if ($this->getSpyUsers()->contains($spyUser)) {
            $pos = $this->collSpyUsers->search($spyUser);
            $this->collSpyUsers->remove($pos);
            if (null === $this->spyUsersScheduledForDeletion) {
                $this->spyUsersScheduledForDeletion = clone $this->collSpyUsers;
                $this->spyUsersScheduledForDeletion->clear();
            }
            $this->spyUsersScheduledForDeletion[]= $spyUser;
            $spyUser->setSpyLocale(null);
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
        $this->id_locale = null;
        $this->is_active = null;
        $this->locale_name = null;
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
            if ($this->collSpyAvailabilityNotificationSubscriptions) {
                foreach ($this->collSpyAvailabilityNotificationSubscriptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategoryAttributes) {
                foreach ($this->collSpyCategoryAttributes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategoryImageSets) {
                foreach ($this->collSpyCategoryImageSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsPageLocalizedAttributess) {
                foreach ($this->collSpyCmsPageLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyContentLocalizeds) {
                foreach ($this->collSpyContentLocalizeds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCustomers) {
                foreach ($this->collSpyCustomers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyFileLocalizedAttributess) {
                foreach ($this->collSpyFileLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyFileDirectoryLocalizedAttributess) {
                foreach ($this->collSpyFileDirectoryLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyGlossaryTranslations) {
                foreach ($this->collSpyGlossaryTranslations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLocaleStores) {
                foreach ($this->collLocaleStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyNavigationNodeLocalizedAttributess) {
                foreach ($this->collSpyNavigationNodeLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractLocalizedAttributess) {
                foreach ($this->collSpyProductAbstractLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLocalizedAttributess) {
                foreach ($this->collSpyProductLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductManagementAttributeValueTranslations) {
                foreach ($this->collSpyProductManagementAttributeValueTranslations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductDiscontinuedNotes) {
                foreach ($this->collSpyProductDiscontinuedNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductImageSets) {
                foreach ($this->collSpyProductImageSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLabelLocalizedAttributess) {
                foreach ($this->collSpyProductLabelLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductReviews) {
                foreach ($this->collSpyProductReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductSearches) {
                foreach ($this->collSpyProductSearches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductSetDatas) {
                foreach ($this->collSpyProductSetDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrders) {
                foreach ($this->collSpySalesOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStoreDefaults) {
                foreach ($this->collStoreDefaults as $o) {
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
            if ($this->collSpyUrls) {
                foreach ($this->collSpyUrls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyUsers) {
                foreach ($this->collSpyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyAvailabilityNotificationSubscriptions = null;
        $this->collSpyCategoryAttributes = null;
        $this->collSpyCategoryImageSets = null;
        $this->collSpyCmsPageLocalizedAttributess = null;
        $this->collSpyContentLocalizeds = null;
        $this->collSpyCustomers = null;
        $this->collSpyFileLocalizedAttributess = null;
        $this->collSpyFileDirectoryLocalizedAttributess = null;
        $this->collSpyGlossaryTranslations = null;
        $this->collLocaleStores = null;
        $this->collSpyNavigationNodeLocalizedAttributess = null;
        $this->collSpyProductAbstractLocalizedAttributess = null;
        $this->collSpyProductLocalizedAttributess = null;
        $this->collSpyProductManagementAttributeValueTranslations = null;
        $this->collSpyProductDiscontinuedNotes = null;
        $this->collSpyProductImageSets = null;
        $this->collSpyProductLabelLocalizedAttributess = null;
        $this->collSpyProductReviews = null;
        $this->collSpyProductSearches = null;
        $this->collSpyProductSetDatas = null;
        $this->collSpySalesOrders = null;
        $this->collStoreDefaults = null;
        $this->collTouchStorages = null;
        $this->collTouchSearches = null;
        $this->collSpyUrls = null;
        $this->collSpyUsers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyLocaleTableMap::DEFAULT_STRING_FORMAT);
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
