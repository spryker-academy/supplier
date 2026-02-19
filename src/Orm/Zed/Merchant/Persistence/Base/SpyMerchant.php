<?php

namespace Orm\Zed\Merchant\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery;
use Orm\Zed\MerchantApp\Persistence\Base\SpyMerchantAppOnboardingStatus as BaseSpyMerchantAppOnboardingStatus;
use Orm\Zed\MerchantApp\Persistence\Map\SpyMerchantAppOnboardingStatusTableMap;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery;
use Orm\Zed\MerchantCategory\Persistence\Base\SpyMerchantCategory as BaseSpyMerchantCategory;
use Orm\Zed\MerchantCategory\Persistence\Map\SpyMerchantCategoryTableMap;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery;
use Orm\Zed\MerchantCommission\Persistence\Base\SpyMerchantCommissionMerchant as BaseSpyMerchantCommissionMerchant;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionMerchantTableMap;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery;
use Orm\Zed\MerchantOpeningHours\Persistence\Base\SpyMerchantOpeningHoursDateSchedule as BaseSpyMerchantOpeningHoursDateSchedule;
use Orm\Zed\MerchantOpeningHours\Persistence\Base\SpyMerchantOpeningHoursWeekdaySchedule as BaseSpyMerchantOpeningHoursWeekdaySchedule;
use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursDateScheduleTableMap;
use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursWeekdayScheduleTableMap;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery;
use Orm\Zed\MerchantProduct\Persistence\Base\SpyMerchantProductAbstract as BaseSpyMerchantProductAbstract;
use Orm\Zed\MerchantProduct\Persistence\Map\SpyMerchantProductAbstractTableMap;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery;
use Orm\Zed\MerchantProfile\Persistence\Base\SpyMerchantProfile as BaseSpyMerchantProfile;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequest as BaseSpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery;
use Orm\Zed\MerchantRelationship\Persistence\Base\SpyMerchantRelationship as BaseSpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipTableMap;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStock;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery;
use Orm\Zed\MerchantStock\Persistence\Base\SpyMerchantStock as BaseSpyMerchantStock;
use Orm\Zed\MerchantStock\Persistence\Map\SpyMerchantStockTableMap;
use Orm\Zed\MerchantUser\Persistence\SpyMerchantUser;
use Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery;
use Orm\Zed\MerchantUser\Persistence\Base\SpyMerchantUser as BaseSpyMerchantUser;
use Orm\Zed\MerchantUser\Persistence\Map\SpyMerchantUserTableMap;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant as ChildSpyAclEntitySegmentMerchant;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery as ChildSpyAclEntitySegmentMerchantQuery;
use Orm\Zed\Merchant\Persistence\SpyMerchant as ChildSpyMerchant;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery as ChildSpyMerchantQuery;
use Orm\Zed\Merchant\Persistence\SpyMerchantStore as ChildSpyMerchantStore;
use Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery as ChildSpyMerchantStoreQuery;
use Orm\Zed\Merchant\Persistence\Map\SpyAclEntitySegmentMerchantTableMap;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantStoreTableMap;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery;
use Orm\Zed\ProductOffer\Persistence\Base\SpyProductOffer as BaseSpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferTableMap;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery;
use Orm\Zed\SalesPaymentMerchant\Persistence\Base\SpySalesPaymentMerchantPayout as BaseSpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\Base\SpySalesPaymentMerchantPayoutReversal as BaseSpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\SalesPaymentMerchant\Persistence\Map\SpySalesPaymentMerchantPayoutReversalTableMap;
use Orm\Zed\SalesPaymentMerchant\Persistence\Map\SpySalesPaymentMerchantPayoutTableMap;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery;
use Orm\Zed\Supplier\Persistence\Base\PyzMerchantToSupplier as BasePyzMerchantToSupplier;
use Orm\Zed\Supplier\Persistence\Map\PyzMerchantToSupplierTableMap;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\Url\Persistence\Base\SpyUrl as BaseSpyUrl;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * Base class that represents a row from the 'spy_merchant' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Merchant.Persistence.Base
 */
abstract class SpyMerchant implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Merchant\\Persistence\\Map\\SpyMerchantTableMap';


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
     * The value for the id_merchant field.
     *
     * @var        int
     */
    protected $id_merchant;

    /**
     * The value for the fk_state_machine_process field.
     *
     * @var        int|null
     */
    protected $fk_state_machine_process;

    /**
     * The value for the default_product_abstract_approval_status field.
     * The default approval status for abstract products of a merchant.
     * @var        string|null
     */
    protected $default_product_abstract_approval_status;

    /**
     * The value for the email field.
     * The email address of a user or contact.
     * @var        string
     */
    protected $email;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the is_open_for_relation_request field.
     * A flag indicating if a merchant is open to receiving relationship requests.
     * @var        boolean|null
     */
    protected $is_open_for_relation_request;

    /**
     * The value for the merchant_reference field.
     * A unique reference identifier for a merchant.
     * @var        string
     */
    protected $merchant_reference;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the registration_number field.
     * The official business registration number of a merchant.
     * @var        string|null
     */
    protected $registration_number;

    /**
     * The value for the status field.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @var        string
     */
    protected $status;

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
     * @var        SpyStateMachineProcess
     */
    protected $aSpyStateMachineProcess;

    /**
     * @var        ObjectCollection|PyzMerchantToSupplier[] Collection to store aggregation of PyzMerchantToSupplier objects.
     * @phpstan-var ObjectCollection&\Traversable<PyzMerchantToSupplier> Collection to store aggregation of PyzMerchantToSupplier objects.
     */
    protected $collPyzMerchantToSuppliers;
    protected $collPyzMerchantToSuppliersPartial;

    /**
     * @var        ObjectCollection|ChildSpyMerchantStore[] Collection to store aggregation of ChildSpyMerchantStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantStore> Collection to store aggregation of ChildSpyMerchantStore objects.
     */
    protected $collSpyMerchantStores;
    protected $collSpyMerchantStoresPartial;

    /**
     * @var        ObjectCollection|SpyMerchantAppOnboardingStatus[] Collection to store aggregation of SpyMerchantAppOnboardingStatus objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantAppOnboardingStatus> Collection to store aggregation of SpyMerchantAppOnboardingStatus objects.
     */
    protected $collSpyMerchantAppOnboardingStatuses;
    protected $collSpyMerchantAppOnboardingStatusesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantCategory[] Collection to store aggregation of SpyMerchantCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCategory> Collection to store aggregation of SpyMerchantCategory objects.
     */
    protected $collSpyMerchantCategories;
    protected $collSpyMerchantCategoriesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantCommissionMerchant[] Collection to store aggregation of SpyMerchantCommissionMerchant objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCommissionMerchant> Collection to store aggregation of SpyMerchantCommissionMerchant objects.
     */
    protected $collMerchantCommissions;
    protected $collMerchantCommissionsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantOpeningHoursWeekdaySchedule[] Collection to store aggregation of SpyMerchantOpeningHoursWeekdaySchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantOpeningHoursWeekdaySchedule> Collection to store aggregation of SpyMerchantOpeningHoursWeekdaySchedule objects.
     */
    protected $collSpyMerchantOpeningHoursWeekdaySchedules;
    protected $collSpyMerchantOpeningHoursWeekdaySchedulesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantOpeningHoursDateSchedule[] Collection to store aggregation of SpyMerchantOpeningHoursDateSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantOpeningHoursDateSchedule> Collection to store aggregation of SpyMerchantOpeningHoursDateSchedule objects.
     */
    protected $collSpyMerchantOpeningHoursDateSchedules;
    protected $collSpyMerchantOpeningHoursDateSchedulesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantProductAbstract[] Collection to store aggregation of SpyMerchantProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductAbstract> Collection to store aggregation of SpyMerchantProductAbstract objects.
     */
    protected $collSpyMerchantProductAbstracts;
    protected $collSpyMerchantProductAbstractsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantProfile[] Collection to store aggregation of SpyMerchantProfile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProfile> Collection to store aggregation of SpyMerchantProfile objects.
     */
    protected $collSpyMerchantProfiles;
    protected $collSpyMerchantProfilesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationRequest[] Collection to store aggregation of SpyMerchantRelationRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest> Collection to store aggregation of SpyMerchantRelationRequest objects.
     */
    protected $collSpyMerchantRelationRequests;
    protected $collSpyMerchantRelationRequestsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationship[] Collection to store aggregation of SpyMerchantRelationship objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationship> Collection to store aggregation of SpyMerchantRelationship objects.
     */
    protected $collSpyMerchantRelationships;
    protected $collSpyMerchantRelationshipsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantStock[] Collection to store aggregation of SpyMerchantStock objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStock> Collection to store aggregation of SpyMerchantStock objects.
     */
    protected $collSpyMerchantStocks;
    protected $collSpyMerchantStocksPartial;

    /**
     * @var        ObjectCollection|SpyMerchantUser[] Collection to store aggregation of SpyMerchantUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantUser> Collection to store aggregation of SpyMerchantUser objects.
     */
    protected $collSpyMerchantUsers;
    protected $collSpyMerchantUsersPartial;

    /**
     * @var        ObjectCollection|SpyProductOffer[] Collection to store aggregation of SpyProductOffer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOffer> Collection to store aggregation of SpyProductOffer objects.
     */
    protected $collProductOffers;
    protected $collProductOffersPartial;

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
     * @var        ObjectCollection|SpyUrl[] Collection to store aggregation of SpyUrl objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl> Collection to store aggregation of SpyUrl objects.
     */
    protected $collSpyUrls;
    protected $collSpyUrlsPartial;

    /**
     * @var        ObjectCollection|ChildSpyAclEntitySegmentMerchant[] Collection to store aggregation of ChildSpyAclEntitySegmentMerchant objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclEntitySegmentMerchant> Collection to store aggregation of ChildSpyAclEntitySegmentMerchant objects.
     */
    protected $collSpyAclEntitySegmentMerchants;
    protected $collSpyAclEntitySegmentMerchantsPartial;

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
        'spy_merchant.fk_state_machine_process' => 'fk_state_machine_process',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|PyzMerchantToSupplier[]
     * @phpstan-var ObjectCollection&\Traversable<PyzMerchantToSupplier>
     */
    protected $pyzMerchantToSuppliersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyMerchantStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantStore>
     */
    protected $spyMerchantStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantAppOnboardingStatus[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantAppOnboardingStatus>
     */
    protected $spyMerchantAppOnboardingStatusesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCategory>
     */
    protected $spyMerchantCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantCommissionMerchant[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCommissionMerchant>
     */
    protected $merchantCommissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantOpeningHoursWeekdaySchedule[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantOpeningHoursWeekdaySchedule>
     */
    protected $spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantOpeningHoursDateSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantOpeningHoursDateSchedule>
     */
    protected $spyMerchantOpeningHoursDateSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductAbstract>
     */
    protected $spyMerchantProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantProfile[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProfile>
     */
    protected $spyMerchantProfilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest>
     */
    protected $spyMerchantRelationRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationship[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationship>
     */
    protected $spyMerchantRelationshipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantStock[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStock>
     */
    protected $spyMerchantStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantUser>
     */
    protected $spyMerchantUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOffer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOffer>
     */
    protected $productOffersScheduledForDeletion = null;

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
     * @var ObjectCollection|SpyUrl[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl>
     */
    protected $spyUrlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclEntitySegmentMerchant[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclEntitySegmentMerchant>
     */
    protected $spyAclEntitySegmentMerchantsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Merchant\Persistence\Base\SpyMerchant object.
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
     * Compares this with another <code>SpyMerchant</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchant</code>, delegates to
     * <code>equals(SpyMerchant)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant] column value.
     *
     * @return int
     */
    public function getIdMerchant()
    {
        return $this->id_merchant;
    }

    /**
     * Get the [fk_state_machine_process] column value.
     *
     * @return int|null
     */
    public function getFkStateMachineProcess()
    {
        return $this->fk_state_machine_process;
    }

    /**
     * Get the [default_product_abstract_approval_status] column value.
     * The default approval status for abstract products of a merchant.
     * @return string|null
     */
    public function getDefaultProductAbstractApprovalStatus()
    {
        return $this->default_product_abstract_approval_status;
    }

    /**
     * Get the [email] column value.
     * The email address of a user or contact.
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [is_open_for_relation_request] column value.
     * A flag indicating if a merchant is open to receiving relationship requests.
     * @return boolean|null
     */
    public function getIsOpenForRelationRequest()
    {
        return $this->is_open_for_relation_request;
    }

    /**
     * Get the [is_open_for_relation_request] column value.
     * A flag indicating if a merchant is open to receiving relationship requests.
     * @return boolean|null
     */
    public function isOpenForRelationRequest()
    {
        return $this->getIsOpenForRelationRequest();
    }

    /**
     * Get the [merchant_reference] column value.
     * A unique reference identifier for a merchant.
     * @return string
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
     * Get the [registration_number] column value.
     * The official business registration number of a merchant.
     * @return string|null
     */
    public function getRegistrationNumber()
    {
        return $this->registration_number;
    }

    /**
     * Get the [status] column value.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set the value of [id_merchant] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchant($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant !== $v) {
            $this->id_merchant = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_ID_MERCHANT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_state_machine_process] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkStateMachineProcess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_state_machine_process !== $v) {
            $this->fk_state_machine_process = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS] = true;
        }

        if ($this->aSpyStateMachineProcess !== null && $this->aSpyStateMachineProcess->getIdStateMachineProcess() !== $v) {
            $this->aSpyStateMachineProcess = null;
        }

        return $this;
    }

    /**
     * Set the value of [default_product_abstract_approval_status] column.
     * The default approval status for abstract products of a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultProductAbstractApprovalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->default_product_abstract_approval_status !== $v) {
            $this->default_product_abstract_approval_status = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     * The email address of a user or contact.
     * @param string $v New value
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
            $this->modifiedColumns[SpyMerchantTableMap::COL_EMAIL] = true;
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
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        $this->_initialValues[SpyMerchantTableMap::COL_IS_ACTIVE] = $this->is_active;

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
            $this->modifiedColumns[SpyMerchantTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_open_for_relation_request] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a merchant is open to receiving relationship requests.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsOpenForRelationRequest($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (bool) $v;
            }
        }

        $allowNullValues = true;

        if ($v === null && !$allowNullValues) {
            return $this;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->is_open_for_relation_request !== $v) {
            $this->is_open_for_relation_request = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_reference] column.
     * A unique reference identifier for a merchant.
     * @param string $v New value
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
            $this->modifiedColumns[SpyMerchantTableMap::COL_MERCHANT_REFERENCE] = true;
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
        $this->_initialValues[SpyMerchantTableMap::COL_NAME] = $this->name;

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
            $this->modifiedColumns[SpyMerchantTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [registration_number] column.
     * The official business registration number of a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistrationNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->registration_number !== $v) {
            $this->registration_number = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_REGISTRATION_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[SpyMerchantTableMap::COL_STATUS] = true;
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
                $this->modifiedColumns[SpyMerchantTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_active !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantTableMap::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantTableMap::translateFieldName('FkStateMachineProcess', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_state_machine_process = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantTableMap::translateFieldName('DefaultProductAbstractApprovalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_product_abstract_approval_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantTableMap::translateFieldName('IsOpenForRelationRequest', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_open_for_relation_request = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantTableMap::translateFieldName('MerchantReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantTableMap::translateFieldName('RegistrationNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registration_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyMerchantTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyMerchantTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SpyMerchantTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant'), 0, $e);
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
        if ($this->aSpyStateMachineProcess !== null && $this->fk_state_machine_process !== $this->aSpyStateMachineProcess->getIdStateMachineProcess()) {
            $this->aSpyStateMachineProcess = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyStateMachineProcess = null;
            $this->collPyzMerchantToSuppliers = null;

            $this->collSpyMerchantStores = null;

            $this->collSpyMerchantAppOnboardingStatuses = null;

            $this->collSpyMerchantCategories = null;

            $this->collMerchantCommissions = null;

            $this->collSpyMerchantOpeningHoursWeekdaySchedules = null;

            $this->collSpyMerchantOpeningHoursDateSchedules = null;

            $this->collSpyMerchantProductAbstracts = null;

            $this->collSpyMerchantProfiles = null;

            $this->collSpyMerchantRelationRequests = null;

            $this->collSpyMerchantRelationships = null;

            $this->collSpyMerchantStocks = null;

            $this->collSpyMerchantUsers = null;

            $this->collProductOffers = null;

            $this->collSpySalesPaymentMerchantPayouts = null;

            $this->collSpySalesPaymentMerchantPayoutReversals = null;

            $this->collSpyUrls = null;

            $this->collSpyAclEntitySegmentMerchants = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchant::setDeleted()
     * @see SpyMerchant::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyMerchantTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantTableMap::COL_UPDATED_AT)) {
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

                SpyMerchantTableMap::addInstanceToPool($this);
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

            if ($this->aSpyStateMachineProcess !== null) {
                if ($this->aSpyStateMachineProcess->isModified() || $this->aSpyStateMachineProcess->isNew()) {
                    $affectedRows += $this->aSpyStateMachineProcess->save($con);
                }
                $this->setSpyStateMachineProcess($this->aSpyStateMachineProcess);
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

            if ($this->pyzMerchantToSuppliersScheduledForDeletion !== null) {
                if (!$this->pyzMerchantToSuppliersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery::create()
                        ->filterByPrimaryKeys($this->pyzMerchantToSuppliersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pyzMerchantToSuppliersScheduledForDeletion = null;
                }
            }

            if ($this->collPyzMerchantToSuppliers !== null) {
                foreach ($this->collPyzMerchantToSuppliers as $referrerFK) {
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

            if ($this->spyMerchantAppOnboardingStatusesScheduledForDeletion !== null) {
                if (!$this->spyMerchantAppOnboardingStatusesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantAppOnboardingStatusesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantAppOnboardingStatusesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantAppOnboardingStatuses !== null) {
                foreach ($this->collSpyMerchantAppOnboardingStatuses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantCategoriesScheduledForDeletion !== null) {
                if (!$this->spyMerchantCategoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantCategories !== null) {
                foreach ($this->collSpyMerchantCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->merchantCommissionsScheduledForDeletion !== null) {
                if (!$this->merchantCommissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery::create()
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

            if ($this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion !== null) {
                if (!$this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantOpeningHoursWeekdaySchedules !== null) {
                foreach ($this->collSpyMerchantOpeningHoursWeekdaySchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion !== null) {
                if (!$this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantOpeningHoursDateSchedules !== null) {
                foreach ($this->collSpyMerchantOpeningHoursDateSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyMerchantProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProductAbstracts !== null) {
                foreach ($this->collSpyMerchantProductAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantProfilesScheduledForDeletion !== null) {
                if (!$this->spyMerchantProfilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantProfilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantProfilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProfiles !== null) {
                foreach ($this->collSpyMerchantProfiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantRelationRequestsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRelationRequestsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRelationRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRelationRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRelationRequests !== null) {
                foreach ($this->collSpyMerchantRelationRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantRelationshipsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRelationshipsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRelationshipsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRelationshipsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRelationships !== null) {
                foreach ($this->collSpyMerchantRelationships as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantStocksScheduledForDeletion !== null) {
                if (!$this->spyMerchantStocksScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantStocksScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantStocks !== null) {
                foreach ($this->collSpyMerchantStocks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantUsersScheduledForDeletion !== null) {
                if (!$this->spyMerchantUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantUsers !== null) {
                foreach ($this->collSpyMerchantUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productOffersScheduledForDeletion !== null) {
                if (!$this->productOffersScheduledForDeletion->isEmpty()) {
                    foreach ($this->productOffersScheduledForDeletion as $productOffer) {
                        // need to save related object because we set the relation to null
                        $productOffer->save($con);
                    }
                    $this->productOffersScheduledForDeletion = null;
                }
            }

            if ($this->collProductOffers !== null) {
                foreach ($this->collProductOffers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesPaymentMerchantPayoutsScheduledForDeletion !== null) {
                if (!$this->spySalesPaymentMerchantPayoutsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySalesPaymentMerchantPayoutsScheduledForDeletion as $spySalesPaymentMerchantPayout) {
                        // need to save related object because we set the relation to null
                        $spySalesPaymentMerchantPayout->save($con);
                    }
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
                    foreach ($this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion as $spySalesPaymentMerchantPayoutReversal) {
                        // need to save related object because we set the relation to null
                        $spySalesPaymentMerchantPayoutReversal->save($con);
                    }
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

            if ($this->spyAclEntitySegmentMerchantsScheduledForDeletion !== null) {
                if (!$this->spyAclEntitySegmentMerchantsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery::create()
                        ->filterByPrimaryKeys($this->spyAclEntitySegmentMerchantsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclEntitySegmentMerchantsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclEntitySegmentMerchants !== null) {
                foreach ($this->collSpyAclEntitySegmentMerchants as $referrerFK) {
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

        $this->modifiedColumns[SpyMerchantTableMap::COL_ID_MERCHANT] = true;
        if (null !== $this->id_merchant) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantTableMap::COL_ID_MERCHANT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantTableMap::COL_ID_MERCHANT)) {
            $modifiedColumns[':p' . $index++]  = '`id_merchant`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS)) {
            $modifiedColumns[':p' . $index++]  = '`fk_state_machine_process`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`default_product_abstract_approval_status`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST)) {
            $modifiedColumns[':p' . $index++]  = '`is_open_for_relation_request`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_MERCHANT_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = '`merchant_reference`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_REGISTRATION_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`registration_number`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_merchant` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_merchant`':
                        $stmt->bindValue($identifier, $this->id_merchant, PDO::PARAM_INT);

                        break;
                    case '`fk_state_machine_process`':
                        $stmt->bindValue($identifier, $this->fk_state_machine_process, PDO::PARAM_INT);

                        break;
                    case '`default_product_abstract_approval_status`':
                        $stmt->bindValue($identifier, $this->default_product_abstract_approval_status, PDO::PARAM_STR);

                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`is_open_for_relation_request`':
                        $stmt->bindValue($identifier, (int) $this->is_open_for_relation_request, PDO::PARAM_INT);

                        break;
                    case '`merchant_reference`':
                        $stmt->bindValue($identifier, $this->merchant_reference, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`registration_number`':
                        $stmt->bindValue($identifier, $this->registration_number, PDO::PARAM_STR);

                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_merchant_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchant($pk);

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
        $pos = SpyMerchantTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchant();

            case 1:
                return $this->getFkStateMachineProcess();

            case 2:
                return $this->getDefaultProductAbstractApprovalStatus();

            case 3:
                return $this->getEmail();

            case 4:
                return $this->getIsActive();

            case 5:
                return $this->getIsOpenForRelationRequest();

            case 6:
                return $this->getMerchantReference();

            case 7:
                return $this->getName();

            case 8:
                return $this->getRegistrationNumber();

            case 9:
                return $this->getStatus();

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
        if (isset($alreadyDumpedObjects['SpyMerchant'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchant'][$this->hashCode()] = true;
        $keys = SpyMerchantTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchant(),
            $keys[1] => $this->getFkStateMachineProcess(),
            $keys[2] => $this->getDefaultProductAbstractApprovalStatus(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getIsActive(),
            $keys[5] => $this->getIsOpenForRelationRequest(),
            $keys[6] => $this->getMerchantReference(),
            $keys[7] => $this->getName(),
            $keys[8] => $this->getRegistrationNumber(),
            $keys[9] => $this->getStatus(),
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
            if (null !== $this->aSpyStateMachineProcess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStateMachineProcess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_state_machine_process';
                        break;
                    default:
                        $key = 'SpyStateMachineProcess';
                }

                $result[$key] = $this->aSpyStateMachineProcess->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPyzMerchantToSuppliers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pyzMerchantToSuppliers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pyz_merchant_to_suppliers';
                        break;
                    default:
                        $key = 'PyzMerchantToSuppliers';
                }

                $result[$key] = $this->collPyzMerchantToSuppliers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyMerchantAppOnboardingStatuses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantAppOnboardingStatuses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_app_onboarding_statuses';
                        break;
                    default:
                        $key = 'SpyMerchantAppOnboardingStatuses';
                }

                $result[$key] = $this->collSpyMerchantAppOnboardingStatuses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_categories';
                        break;
                    default:
                        $key = 'SpyMerchantCategories';
                }

                $result[$key] = $this->collSpyMerchantCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMerchantCommissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionMerchants';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_merchants';
                        break;
                    default:
                        $key = 'MerchantCommissions';
                }

                $result[$key] = $this->collMerchantCommissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantOpeningHoursWeekdaySchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantOpeningHoursWeekdaySchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_opening_hours_weekday_schedules';
                        break;
                    default:
                        $key = 'SpyMerchantOpeningHoursWeekdaySchedules';
                }

                $result[$key] = $this->collSpyMerchantOpeningHoursWeekdaySchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantOpeningHoursDateSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantOpeningHoursDateSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_opening_hours_date_schedules';
                        break;
                    default:
                        $key = 'SpyMerchantOpeningHoursDateSchedules';
                }

                $result[$key] = $this->collSpyMerchantOpeningHoursDateSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_product_abstracts';
                        break;
                    default:
                        $key = 'SpyMerchantProductAbstracts';
                }

                $result[$key] = $this->collSpyMerchantProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantProfiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProfiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_profiles';
                        break;
                    default:
                        $key = 'SpyMerchantProfiles';
                }

                $result[$key] = $this->collSpyMerchantProfiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantRelationRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relation_requests';
                        break;
                    default:
                        $key = 'SpyMerchantRelationRequests';
                }

                $result[$key] = $this->collSpyMerchantRelationRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantRelationships) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationships';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relationships';
                        break;
                    default:
                        $key = 'SpyMerchantRelationships';
                }

                $result[$key] = $this->collSpyMerchantRelationships->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_stocks';
                        break;
                    default:
                        $key = 'SpyMerchantStocks';
                }

                $result[$key] = $this->collSpyMerchantStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_users';
                        break;
                    default:
                        $key = 'SpyMerchantUsers';
                }

                $result[$key] = $this->collSpyMerchantUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductOffers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOffers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offers';
                        break;
                    default:
                        $key = 'ProductOffers';
                }

                $result[$key] = $this->collProductOffers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyAclEntitySegmentMerchants) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclEntitySegmentMerchants';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_entity_segment_merchants';
                        break;
                    default:
                        $key = 'SpyAclEntitySegmentMerchants';
                }

                $result[$key] = $this->collSpyAclEntitySegmentMerchants->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyMerchantTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchant($value);
                break;
            case 1:
                $this->setFkStateMachineProcess($value);
                break;
            case 2:
                $this->setDefaultProductAbstractApprovalStatus($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setIsActive($value);
                break;
            case 5:
                $this->setIsOpenForRelationRequest($value);
                break;
            case 6:
                $this->setMerchantReference($value);
                break;
            case 7:
                $this->setName($value);
                break;
            case 8:
                $this->setRegistrationNumber($value);
                break;
            case 9:
                $this->setStatus($value);
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
        $keys = SpyMerchantTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchant($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkStateMachineProcess($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDefaultProductAbstractApprovalStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsActive($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsOpenForRelationRequest($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMerchantReference($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setName($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRegistrationNumber($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStatus($arr[$keys[9]]);
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
        $criteria = new Criteria(SpyMerchantTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantTableMap::COL_ID_MERCHANT)) {
            $criteria->add(SpyMerchantTableMap::COL_ID_MERCHANT, $this->id_merchant);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS)) {
            $criteria->add(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $this->fk_state_machine_process);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS)) {
            $criteria->add(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS, $this->default_product_abstract_approval_status);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_EMAIL)) {
            $criteria->add(SpyMerchantTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyMerchantTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST)) {
            $criteria->add(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST, $this->is_open_for_relation_request);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_MERCHANT_REFERENCE)) {
            $criteria->add(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $this->merchant_reference);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_NAME)) {
            $criteria->add(SpyMerchantTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_REGISTRATION_NUMBER)) {
            $criteria->add(SpyMerchantTableMap::COL_REGISTRATION_NUMBER, $this->registration_number);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_STATUS)) {
            $criteria->add(SpyMerchantTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantQuery::create();
        $criteria->add(SpyMerchantTableMap::COL_ID_MERCHANT, $this->id_merchant);

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
        $validPk = null !== $this->getIdMerchant();

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
        return $this->getIdMerchant();
    }

    /**
     * Generic method to set the primary key (id_merchant column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchant($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchant();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Merchant\Persistence\SpyMerchant (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkStateMachineProcess($this->getFkStateMachineProcess());
        $copyObj->setDefaultProductAbstractApprovalStatus($this->getDefaultProductAbstractApprovalStatus());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsOpenForRelationRequest($this->getIsOpenForRelationRequest());
        $copyObj->setMerchantReference($this->getMerchantReference());
        $copyObj->setName($this->getName());
        $copyObj->setRegistrationNumber($this->getRegistrationNumber());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPyzMerchantToSuppliers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPyzMerchantToSupplier($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantAppOnboardingStatuses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantAppOnboardingStatus($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMerchantCommissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantCommission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantOpeningHoursWeekdaySchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantOpeningHoursWeekdaySchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantOpeningHoursDateSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantOpeningHoursDateSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProductAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantProfiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProfile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationships() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationship($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOffers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOffer($relObj->copy($deepCopy));
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

            foreach ($this->getSpyUrls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUrl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclEntitySegmentMerchants() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclEntitySegmentMerchant($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchant(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchant Clone of current object.
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
     * Declares an association between this object and a SpyStateMachineProcess object.
     *
     * @param SpyStateMachineProcess|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyStateMachineProcess(SpyStateMachineProcess $v = null)
    {
        if ($v === null) {
            $this->setFkStateMachineProcess(NULL);
        } else {
            $this->setFkStateMachineProcess($v->getIdStateMachineProcess());
        }

        $this->aSpyStateMachineProcess = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyStateMachineProcess object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchant($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyStateMachineProcess object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyStateMachineProcess|null The associated SpyStateMachineProcess object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyStateMachineProcess(?ConnectionInterface $con = null)
    {
        if ($this->aSpyStateMachineProcess === null && ($this->fk_state_machine_process != 0)) {
            $this->aSpyStateMachineProcess = SpyStateMachineProcessQuery::create()->findPk($this->fk_state_machine_process, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyStateMachineProcess->addSpyMerchants($this);
             */
        }

        return $this->aSpyStateMachineProcess;
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
        if ('PyzMerchantToSupplier' === $relationName) {
            $this->initPyzMerchantToSuppliers();
            return;
        }
        if ('SpyMerchantStore' === $relationName) {
            $this->initSpyMerchantStores();
            return;
        }
        if ('SpyMerchantAppOnboardingStatus' === $relationName) {
            $this->initSpyMerchantAppOnboardingStatuses();
            return;
        }
        if ('SpyMerchantCategory' === $relationName) {
            $this->initSpyMerchantCategories();
            return;
        }
        if ('MerchantCommission' === $relationName) {
            $this->initMerchantCommissions();
            return;
        }
        if ('SpyMerchantOpeningHoursWeekdaySchedule' === $relationName) {
            $this->initSpyMerchantOpeningHoursWeekdaySchedules();
            return;
        }
        if ('SpyMerchantOpeningHoursDateSchedule' === $relationName) {
            $this->initSpyMerchantOpeningHoursDateSchedules();
            return;
        }
        if ('SpyMerchantProductAbstract' === $relationName) {
            $this->initSpyMerchantProductAbstracts();
            return;
        }
        if ('SpyMerchantProfile' === $relationName) {
            $this->initSpyMerchantProfiles();
            return;
        }
        if ('SpyMerchantRelationRequest' === $relationName) {
            $this->initSpyMerchantRelationRequests();
            return;
        }
        if ('SpyMerchantRelationship' === $relationName) {
            $this->initSpyMerchantRelationships();
            return;
        }
        if ('SpyMerchantStock' === $relationName) {
            $this->initSpyMerchantStocks();
            return;
        }
        if ('SpyMerchantUser' === $relationName) {
            $this->initSpyMerchantUsers();
            return;
        }
        if ('ProductOffer' === $relationName) {
            $this->initProductOffers();
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
        if ('SpyUrl' === $relationName) {
            $this->initSpyUrls();
            return;
        }
        if ('SpyAclEntitySegmentMerchant' === $relationName) {
            $this->initSpyAclEntitySegmentMerchants();
            return;
        }
    }

    /**
     * Clears out the collPyzMerchantToSuppliers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPyzMerchantToSuppliers()
     */
    public function clearPyzMerchantToSuppliers()
    {
        $this->collPyzMerchantToSuppliers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPyzMerchantToSuppliers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPyzMerchantToSuppliers($v = true): void
    {
        $this->collPyzMerchantToSuppliersPartial = $v;
    }

    /**
     * Initializes the collPyzMerchantToSuppliers collection.
     *
     * By default this just sets the collPyzMerchantToSuppliers collection to an empty array (like clearcollPyzMerchantToSuppliers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPyzMerchantToSuppliers(bool $overrideExisting = true): void
    {
        if (null !== $this->collPyzMerchantToSuppliers && !$overrideExisting) {
            return;
        }

        $collectionClassName = PyzMerchantToSupplierTableMap::getTableMap()->getCollectionClassName();

        $this->collPyzMerchantToSuppliers = new $collectionClassName;
        $this->collPyzMerchantToSuppliers->setModel('\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier');
    }

    /**
     * Gets an array of PyzMerchantToSupplier objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|PyzMerchantToSupplier[] List of PyzMerchantToSupplier objects
     * @phpstan-return ObjectCollection&\Traversable<PyzMerchantToSupplier> List of PyzMerchantToSupplier objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPyzMerchantToSuppliers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPyzMerchantToSuppliersPartial && !$this->isNew();
        if (null === $this->collPyzMerchantToSuppliers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPyzMerchantToSuppliers) {
                    $this->initPyzMerchantToSuppliers();
                } else {
                    $collectionClassName = PyzMerchantToSupplierTableMap::getTableMap()->getCollectionClassName();

                    $collPyzMerchantToSuppliers = new $collectionClassName;
                    $collPyzMerchantToSuppliers->setModel('\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier');

                    return $collPyzMerchantToSuppliers;
                }
            } else {
                $collPyzMerchantToSuppliers = PyzMerchantToSupplierQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPyzMerchantToSuppliersPartial && count($collPyzMerchantToSuppliers)) {
                        $this->initPyzMerchantToSuppliers(false);

                        foreach ($collPyzMerchantToSuppliers as $obj) {
                            if (false == $this->collPyzMerchantToSuppliers->contains($obj)) {
                                $this->collPyzMerchantToSuppliers->append($obj);
                            }
                        }

                        $this->collPyzMerchantToSuppliersPartial = true;
                    }

                    return $collPyzMerchantToSuppliers;
                }

                if ($partial && $this->collPyzMerchantToSuppliers) {
                    foreach ($this->collPyzMerchantToSuppliers as $obj) {
                        if ($obj->isNew()) {
                            $collPyzMerchantToSuppliers[] = $obj;
                        }
                    }
                }

                $this->collPyzMerchantToSuppliers = $collPyzMerchantToSuppliers;
                $this->collPyzMerchantToSuppliersPartial = false;
            }
        }

        return $this->collPyzMerchantToSuppliers;
    }

    /**
     * Sets a collection of PyzMerchantToSupplier objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pyzMerchantToSuppliers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPyzMerchantToSuppliers(Collection $pyzMerchantToSuppliers, ?ConnectionInterface $con = null)
    {
        /** @var PyzMerchantToSupplier[] $pyzMerchantToSuppliersToDelete */
        $pyzMerchantToSuppliersToDelete = $this->getPyzMerchantToSuppliers(new Criteria(), $con)->diff($pyzMerchantToSuppliers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pyzMerchantToSuppliersScheduledForDeletion = clone $pyzMerchantToSuppliersToDelete;

        foreach ($pyzMerchantToSuppliersToDelete as $pyzMerchantToSupplierRemoved) {
            $pyzMerchantToSupplierRemoved->setSpyMerchant(null);
        }

        $this->collPyzMerchantToSuppliers = null;
        foreach ($pyzMerchantToSuppliers as $pyzMerchantToSupplier) {
            $this->addPyzMerchantToSupplier($pyzMerchantToSupplier);
        }

        $this->collPyzMerchantToSuppliers = $pyzMerchantToSuppliers;
        $this->collPyzMerchantToSuppliersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BasePyzMerchantToSupplier objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BasePyzMerchantToSupplier objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPyzMerchantToSuppliers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPyzMerchantToSuppliersPartial && !$this->isNew();
        if (null === $this->collPyzMerchantToSuppliers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPyzMerchantToSuppliers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPyzMerchantToSuppliers());
            }

            $query = PyzMerchantToSupplierQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collPyzMerchantToSuppliers);
    }

    /**
     * Method called to associate a PyzMerchantToSupplier object to this object
     * through the PyzMerchantToSupplier foreign key attribute.
     *
     * @param PyzMerchantToSupplier $l PyzMerchantToSupplier
     * @return $this The current object (for fluent API support)
     */
    public function addPyzMerchantToSupplier(PyzMerchantToSupplier $l)
    {
        if ($this->collPyzMerchantToSuppliers === null) {
            $this->initPyzMerchantToSuppliers();
            $this->collPyzMerchantToSuppliersPartial = true;
        }

        if (!$this->collPyzMerchantToSuppliers->contains($l)) {
            $this->doAddPyzMerchantToSupplier($l);

            if ($this->pyzMerchantToSuppliersScheduledForDeletion and $this->pyzMerchantToSuppliersScheduledForDeletion->contains($l)) {
                $this->pyzMerchantToSuppliersScheduledForDeletion->remove($this->pyzMerchantToSuppliersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param PyzMerchantToSupplier $pyzMerchantToSupplier The PyzMerchantToSupplier object to add.
     */
    protected function doAddPyzMerchantToSupplier(PyzMerchantToSupplier $pyzMerchantToSupplier): void
    {
        $this->collPyzMerchantToSuppliers[]= $pyzMerchantToSupplier;
        $pyzMerchantToSupplier->setSpyMerchant($this);
    }

    /**
     * @param PyzMerchantToSupplier $pyzMerchantToSupplier The PyzMerchantToSupplier object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePyzMerchantToSupplier(PyzMerchantToSupplier $pyzMerchantToSupplier)
    {
        if ($this->getPyzMerchantToSuppliers()->contains($pyzMerchantToSupplier)) {
            $pos = $this->collPyzMerchantToSuppliers->search($pyzMerchantToSupplier);
            $this->collPyzMerchantToSuppliers->remove($pos);
            if (null === $this->pyzMerchantToSuppliersScheduledForDeletion) {
                $this->pyzMerchantToSuppliersScheduledForDeletion = clone $this->collPyzMerchantToSuppliers;
                $this->pyzMerchantToSuppliersScheduledForDeletion->clear();
            }
            $this->pyzMerchantToSuppliersScheduledForDeletion[]= clone $pyzMerchantToSupplier;
            $pyzMerchantToSupplier->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related PyzMerchantToSuppliers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|PyzMerchantToSupplier[] List of PyzMerchantToSupplier objects
     * @phpstan-return ObjectCollection&\Traversable<PyzMerchantToSupplier}> List of PyzMerchantToSupplier objects
     */
    public function getPyzMerchantToSuppliersJoinPyzSupplier(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = PyzMerchantToSupplierQuery::create(null, $criteria);
        $query->joinWith('PyzSupplier', $joinBehavior);

        return $this->getPyzMerchantToSuppliers($query, $con);
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
     * Gets an array of ChildSpyMerchantStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantStore[] List of ChildSpyMerchantStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantStore> List of ChildSpyMerchantStore objects
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
                $collSpyMerchantStores = ChildSpyMerchantStoreQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
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
     * Sets a collection of ChildSpyMerchantStore objects related by a one-to-many relationship
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
        /** @var ChildSpyMerchantStore[] $spyMerchantStoresToDelete */
        $spyMerchantStoresToDelete = $this->getSpyMerchantStores(new Criteria(), $con)->diff($spyMerchantStores);


        $this->spyMerchantStoresScheduledForDeletion = $spyMerchantStoresToDelete;

        foreach ($spyMerchantStoresToDelete as $spyMerchantStoreRemoved) {
            $spyMerchantStoreRemoved->setSpyMerchant(null);
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
     * Returns the number of related SpyMerchantStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantStore objects.
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

            $query = ChildSpyMerchantStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantStores);
    }

    /**
     * Method called to associate a ChildSpyMerchantStore object to this object
     * through the ChildSpyMerchantStore foreign key attribute.
     *
     * @param ChildSpyMerchantStore $l ChildSpyMerchantStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantStore(ChildSpyMerchantStore $l)
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
     * @param ChildSpyMerchantStore $spyMerchantStore The ChildSpyMerchantStore object to add.
     */
    protected function doAddSpyMerchantStore(ChildSpyMerchantStore $spyMerchantStore): void
    {
        $this->collSpyMerchantStores[]= $spyMerchantStore;
        $spyMerchantStore->setSpyMerchant($this);
    }

    /**
     * @param ChildSpyMerchantStore $spyMerchantStore The ChildSpyMerchantStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantStore(ChildSpyMerchantStore $spyMerchantStore)
    {
        if ($this->getSpyMerchantStores()->contains($spyMerchantStore)) {
            $pos = $this->collSpyMerchantStores->search($spyMerchantStore);
            $this->collSpyMerchantStores->remove($pos);
            if (null === $this->spyMerchantStoresScheduledForDeletion) {
                $this->spyMerchantStoresScheduledForDeletion = clone $this->collSpyMerchantStores;
                $this->spyMerchantStoresScheduledForDeletion->clear();
            }
            $this->spyMerchantStoresScheduledForDeletion[]= clone $spyMerchantStore;
            $spyMerchantStore->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantStore[] List of ChildSpyMerchantStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantStore}> List of ChildSpyMerchantStore objects
     */
    public function getSpyMerchantStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyMerchantStores($query, $con);
    }

    /**
     * Clears out the collSpyMerchantAppOnboardingStatuses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantAppOnboardingStatuses()
     */
    public function clearSpyMerchantAppOnboardingStatuses()
    {
        $this->collSpyMerchantAppOnboardingStatuses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantAppOnboardingStatuses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantAppOnboardingStatuses($v = true): void
    {
        $this->collSpyMerchantAppOnboardingStatusesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantAppOnboardingStatuses collection.
     *
     * By default this just sets the collSpyMerchantAppOnboardingStatuses collection to an empty array (like clearcollSpyMerchantAppOnboardingStatuses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantAppOnboardingStatuses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantAppOnboardingStatuses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantAppOnboardingStatusTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantAppOnboardingStatuses = new $collectionClassName;
        $this->collSpyMerchantAppOnboardingStatuses->setModel('\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus');
    }

    /**
     * Gets an array of SpyMerchantAppOnboardingStatus objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantAppOnboardingStatus[] List of SpyMerchantAppOnboardingStatus objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantAppOnboardingStatus> List of SpyMerchantAppOnboardingStatus objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantAppOnboardingStatuses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantAppOnboardingStatusesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantAppOnboardingStatuses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantAppOnboardingStatuses) {
                    $this->initSpyMerchantAppOnboardingStatuses();
                } else {
                    $collectionClassName = SpyMerchantAppOnboardingStatusTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantAppOnboardingStatuses = new $collectionClassName;
                    $collSpyMerchantAppOnboardingStatuses->setModel('\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus');

                    return $collSpyMerchantAppOnboardingStatuses;
                }
            } else {
                $collSpyMerchantAppOnboardingStatuses = SpyMerchantAppOnboardingStatusQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantAppOnboardingStatusesPartial && count($collSpyMerchantAppOnboardingStatuses)) {
                        $this->initSpyMerchantAppOnboardingStatuses(false);

                        foreach ($collSpyMerchantAppOnboardingStatuses as $obj) {
                            if (false == $this->collSpyMerchantAppOnboardingStatuses->contains($obj)) {
                                $this->collSpyMerchantAppOnboardingStatuses->append($obj);
                            }
                        }

                        $this->collSpyMerchantAppOnboardingStatusesPartial = true;
                    }

                    return $collSpyMerchantAppOnboardingStatuses;
                }

                if ($partial && $this->collSpyMerchantAppOnboardingStatuses) {
                    foreach ($this->collSpyMerchantAppOnboardingStatuses as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantAppOnboardingStatuses[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantAppOnboardingStatuses = $collSpyMerchantAppOnboardingStatuses;
                $this->collSpyMerchantAppOnboardingStatusesPartial = false;
            }
        }

        return $this->collSpyMerchantAppOnboardingStatuses;
    }

    /**
     * Sets a collection of SpyMerchantAppOnboardingStatus objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantAppOnboardingStatuses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantAppOnboardingStatuses(Collection $spyMerchantAppOnboardingStatuses, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantAppOnboardingStatus[] $spyMerchantAppOnboardingStatusesToDelete */
        $spyMerchantAppOnboardingStatusesToDelete = $this->getSpyMerchantAppOnboardingStatuses(new Criteria(), $con)->diff($spyMerchantAppOnboardingStatuses);


        $this->spyMerchantAppOnboardingStatusesScheduledForDeletion = $spyMerchantAppOnboardingStatusesToDelete;

        foreach ($spyMerchantAppOnboardingStatusesToDelete as $spyMerchantAppOnboardingStatusRemoved) {
            $spyMerchantAppOnboardingStatusRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantAppOnboardingStatuses = null;
        foreach ($spyMerchantAppOnboardingStatuses as $spyMerchantAppOnboardingStatus) {
            $this->addSpyMerchantAppOnboardingStatus($spyMerchantAppOnboardingStatus);
        }

        $this->collSpyMerchantAppOnboardingStatuses = $spyMerchantAppOnboardingStatuses;
        $this->collSpyMerchantAppOnboardingStatusesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantAppOnboardingStatus objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantAppOnboardingStatus objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantAppOnboardingStatuses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantAppOnboardingStatusesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantAppOnboardingStatuses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantAppOnboardingStatuses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantAppOnboardingStatuses());
            }

            $query = SpyMerchantAppOnboardingStatusQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantAppOnboardingStatuses);
    }

    /**
     * Method called to associate a SpyMerchantAppOnboardingStatus object to this object
     * through the SpyMerchantAppOnboardingStatus foreign key attribute.
     *
     * @param SpyMerchantAppOnboardingStatus $l SpyMerchantAppOnboardingStatus
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantAppOnboardingStatus(SpyMerchantAppOnboardingStatus $l)
    {
        if ($this->collSpyMerchantAppOnboardingStatuses === null) {
            $this->initSpyMerchantAppOnboardingStatuses();
            $this->collSpyMerchantAppOnboardingStatusesPartial = true;
        }

        if (!$this->collSpyMerchantAppOnboardingStatuses->contains($l)) {
            $this->doAddSpyMerchantAppOnboardingStatus($l);

            if ($this->spyMerchantAppOnboardingStatusesScheduledForDeletion and $this->spyMerchantAppOnboardingStatusesScheduledForDeletion->contains($l)) {
                $this->spyMerchantAppOnboardingStatusesScheduledForDeletion->remove($this->spyMerchantAppOnboardingStatusesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus The SpyMerchantAppOnboardingStatus object to add.
     */
    protected function doAddSpyMerchantAppOnboardingStatus(SpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus): void
    {
        $this->collSpyMerchantAppOnboardingStatuses[]= $spyMerchantAppOnboardingStatus;
        $spyMerchantAppOnboardingStatus->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus The SpyMerchantAppOnboardingStatus object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantAppOnboardingStatus(SpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus)
    {
        if ($this->getSpyMerchantAppOnboardingStatuses()->contains($spyMerchantAppOnboardingStatus)) {
            $pos = $this->collSpyMerchantAppOnboardingStatuses->search($spyMerchantAppOnboardingStatus);
            $this->collSpyMerchantAppOnboardingStatuses->remove($pos);
            if (null === $this->spyMerchantAppOnboardingStatusesScheduledForDeletion) {
                $this->spyMerchantAppOnboardingStatusesScheduledForDeletion = clone $this->collSpyMerchantAppOnboardingStatuses;
                $this->spyMerchantAppOnboardingStatusesScheduledForDeletion->clear();
            }
            $this->spyMerchantAppOnboardingStatusesScheduledForDeletion[]= clone $spyMerchantAppOnboardingStatus;
            $spyMerchantAppOnboardingStatus->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantAppOnboardingStatuses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantAppOnboardingStatus[] List of SpyMerchantAppOnboardingStatus objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantAppOnboardingStatus}> List of SpyMerchantAppOnboardingStatus objects
     */
    public function getSpyMerchantAppOnboardingStatusesJoinSpyMerchantAppOnboarding(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantAppOnboardingStatusQuery::create(null, $criteria);
        $query->joinWith('SpyMerchantAppOnboarding', $joinBehavior);

        return $this->getSpyMerchantAppOnboardingStatuses($query, $con);
    }

    /**
     * Clears out the collSpyMerchantCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantCategories()
     */
    public function clearSpyMerchantCategories()
    {
        $this->collSpyMerchantCategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantCategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantCategories($v = true): void
    {
        $this->collSpyMerchantCategoriesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantCategories collection.
     *
     * By default this just sets the collSpyMerchantCategories collection to an empty array (like clearcollSpyMerchantCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantCategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantCategories = new $collectionClassName;
        $this->collSpyMerchantCategories->setModel('\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory');
    }

    /**
     * Gets an array of SpyMerchantCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantCategory[] List of SpyMerchantCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCategory> List of SpyMerchantCategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantCategories) {
                    $this->initSpyMerchantCategories();
                } else {
                    $collectionClassName = SpyMerchantCategoryTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantCategories = new $collectionClassName;
                    $collSpyMerchantCategories->setModel('\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory');

                    return $collSpyMerchantCategories;
                }
            } else {
                $collSpyMerchantCategories = SpyMerchantCategoryQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantCategoriesPartial && count($collSpyMerchantCategories)) {
                        $this->initSpyMerchantCategories(false);

                        foreach ($collSpyMerchantCategories as $obj) {
                            if (false == $this->collSpyMerchantCategories->contains($obj)) {
                                $this->collSpyMerchantCategories->append($obj);
                            }
                        }

                        $this->collSpyMerchantCategoriesPartial = true;
                    }

                    return $collSpyMerchantCategories;
                }

                if ($partial && $this->collSpyMerchantCategories) {
                    foreach ($this->collSpyMerchantCategories as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantCategories = $collSpyMerchantCategories;
                $this->collSpyMerchantCategoriesPartial = false;
            }
        }

        return $this->collSpyMerchantCategories;
    }

    /**
     * Sets a collection of SpyMerchantCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantCategories(Collection $spyMerchantCategories, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantCategory[] $spyMerchantCategoriesToDelete */
        $spyMerchantCategoriesToDelete = $this->getSpyMerchantCategories(new Criteria(), $con)->diff($spyMerchantCategories);


        $this->spyMerchantCategoriesScheduledForDeletion = $spyMerchantCategoriesToDelete;

        foreach ($spyMerchantCategoriesToDelete as $spyMerchantCategoryRemoved) {
            $spyMerchantCategoryRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantCategories = null;
        foreach ($spyMerchantCategories as $spyMerchantCategory) {
            $this->addSpyMerchantCategory($spyMerchantCategory);
        }

        $this->collSpyMerchantCategories = $spyMerchantCategories;
        $this->collSpyMerchantCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantCategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantCategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantCategories());
            }

            $query = SpyMerchantCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantCategories);
    }

    /**
     * Method called to associate a SpyMerchantCategory object to this object
     * through the SpyMerchantCategory foreign key attribute.
     *
     * @param SpyMerchantCategory $l SpyMerchantCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantCategory(SpyMerchantCategory $l)
    {
        if ($this->collSpyMerchantCategories === null) {
            $this->initSpyMerchantCategories();
            $this->collSpyMerchantCategoriesPartial = true;
        }

        if (!$this->collSpyMerchantCategories->contains($l)) {
            $this->doAddSpyMerchantCategory($l);

            if ($this->spyMerchantCategoriesScheduledForDeletion and $this->spyMerchantCategoriesScheduledForDeletion->contains($l)) {
                $this->spyMerchantCategoriesScheduledForDeletion->remove($this->spyMerchantCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantCategory $spyMerchantCategory The SpyMerchantCategory object to add.
     */
    protected function doAddSpyMerchantCategory(SpyMerchantCategory $spyMerchantCategory): void
    {
        $this->collSpyMerchantCategories[]= $spyMerchantCategory;
        $spyMerchantCategory->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantCategory $spyMerchantCategory The SpyMerchantCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantCategory(SpyMerchantCategory $spyMerchantCategory)
    {
        if ($this->getSpyMerchantCategories()->contains($spyMerchantCategory)) {
            $pos = $this->collSpyMerchantCategories->search($spyMerchantCategory);
            $this->collSpyMerchantCategories->remove($pos);
            if (null === $this->spyMerchantCategoriesScheduledForDeletion) {
                $this->spyMerchantCategoriesScheduledForDeletion = clone $this->collSpyMerchantCategories;
                $this->spyMerchantCategoriesScheduledForDeletion->clear();
            }
            $this->spyMerchantCategoriesScheduledForDeletion[]= clone $spyMerchantCategory;
            $spyMerchantCategory->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantCategory[] List of SpyMerchantCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCategory}> List of SpyMerchantCategory objects
     */
    public function getSpyMerchantCategoriesJoinSpyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyCategory', $joinBehavior);

        return $this->getSpyMerchantCategories($query, $con);
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

        $collectionClassName = SpyMerchantCommissionMerchantTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantCommissions = new $collectionClassName;
        $this->collMerchantCommissions->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant');
    }

    /**
     * Gets an array of SpyMerchantCommissionMerchant objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantCommissionMerchant[] List of SpyMerchantCommissionMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCommissionMerchant> List of SpyMerchantCommissionMerchant objects
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
                    $collectionClassName = SpyMerchantCommissionMerchantTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantCommissions = new $collectionClassName;
                    $collMerchantCommissions->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant');

                    return $collMerchantCommissions;
                }
            } else {
                $collMerchantCommissions = SpyMerchantCommissionMerchantQuery::create(null, $criteria)
                    ->filterByMerchant($this)
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
     * Sets a collection of SpyMerchantCommissionMerchant objects related by a one-to-many relationship
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
        /** @var SpyMerchantCommissionMerchant[] $merchantCommissionsToDelete */
        $merchantCommissionsToDelete = $this->getMerchantCommissions(new Criteria(), $con)->diff($merchantCommissions);


        $this->merchantCommissionsScheduledForDeletion = $merchantCommissionsToDelete;

        foreach ($merchantCommissionsToDelete as $merchantCommissionRemoved) {
            $merchantCommissionRemoved->setMerchant(null);
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
     * Returns the number of related BaseSpyMerchantCommissionMerchant objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantCommissionMerchant objects.
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

            $query = SpyMerchantCommissionMerchantQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchant($this)
                ->count($con);
        }

        return count($this->collMerchantCommissions);
    }

    /**
     * Method called to associate a SpyMerchantCommissionMerchant object to this object
     * through the SpyMerchantCommissionMerchant foreign key attribute.
     *
     * @param SpyMerchantCommissionMerchant $l SpyMerchantCommissionMerchant
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantCommission(SpyMerchantCommissionMerchant $l)
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
     * @param SpyMerchantCommissionMerchant $merchantCommission The SpyMerchantCommissionMerchant object to add.
     */
    protected function doAddMerchantCommission(SpyMerchantCommissionMerchant $merchantCommission): void
    {
        $this->collMerchantCommissions[]= $merchantCommission;
        $merchantCommission->setMerchant($this);
    }

    /**
     * @param SpyMerchantCommissionMerchant $merchantCommission The SpyMerchantCommissionMerchant object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantCommission(SpyMerchantCommissionMerchant $merchantCommission)
    {
        if ($this->getMerchantCommissions()->contains($merchantCommission)) {
            $pos = $this->collMerchantCommissions->search($merchantCommission);
            $this->collMerchantCommissions->remove($pos);
            if (null === $this->merchantCommissionsScheduledForDeletion) {
                $this->merchantCommissionsScheduledForDeletion = clone $this->collMerchantCommissions;
                $this->merchantCommissionsScheduledForDeletion->clear();
            }
            $this->merchantCommissionsScheduledForDeletion[]= clone $merchantCommission;
            $merchantCommission->setMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related MerchantCommissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantCommissionMerchant[] List of SpyMerchantCommissionMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCommissionMerchant}> List of SpyMerchantCommissionMerchant objects
     */
    public function getMerchantCommissionsJoinMerchantCommission(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantCommissionMerchantQuery::create(null, $criteria);
        $query->joinWith('MerchantCommission', $joinBehavior);

        return $this->getMerchantCommissions($query, $con);
    }

    /**
     * Clears out the collSpyMerchantOpeningHoursWeekdaySchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantOpeningHoursWeekdaySchedules()
     */
    public function clearSpyMerchantOpeningHoursWeekdaySchedules()
    {
        $this->collSpyMerchantOpeningHoursWeekdaySchedules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantOpeningHoursWeekdaySchedules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantOpeningHoursWeekdaySchedules($v = true): void
    {
        $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantOpeningHoursWeekdaySchedules collection.
     *
     * By default this just sets the collSpyMerchantOpeningHoursWeekdaySchedules collection to an empty array (like clearcollSpyMerchantOpeningHoursWeekdaySchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantOpeningHoursWeekdaySchedules(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantOpeningHoursWeekdaySchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantOpeningHoursWeekdayScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantOpeningHoursWeekdaySchedules = new $collectionClassName;
        $this->collSpyMerchantOpeningHoursWeekdaySchedules->setModel('\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule');
    }

    /**
     * Gets an array of SpyMerchantOpeningHoursWeekdaySchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantOpeningHoursWeekdaySchedule[] List of SpyMerchantOpeningHoursWeekdaySchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantOpeningHoursWeekdaySchedule> List of SpyMerchantOpeningHoursWeekdaySchedule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantOpeningHoursWeekdaySchedules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantOpeningHoursWeekdaySchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantOpeningHoursWeekdaySchedules) {
                    $this->initSpyMerchantOpeningHoursWeekdaySchedules();
                } else {
                    $collectionClassName = SpyMerchantOpeningHoursWeekdayScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantOpeningHoursWeekdaySchedules = new $collectionClassName;
                    $collSpyMerchantOpeningHoursWeekdaySchedules->setModel('\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule');

                    return $collSpyMerchantOpeningHoursWeekdaySchedules;
                }
            } else {
                $collSpyMerchantOpeningHoursWeekdaySchedules = SpyMerchantOpeningHoursWeekdayScheduleQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial && count($collSpyMerchantOpeningHoursWeekdaySchedules)) {
                        $this->initSpyMerchantOpeningHoursWeekdaySchedules(false);

                        foreach ($collSpyMerchantOpeningHoursWeekdaySchedules as $obj) {
                            if (false == $this->collSpyMerchantOpeningHoursWeekdaySchedules->contains($obj)) {
                                $this->collSpyMerchantOpeningHoursWeekdaySchedules->append($obj);
                            }
                        }

                        $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial = true;
                    }

                    return $collSpyMerchantOpeningHoursWeekdaySchedules;
                }

                if ($partial && $this->collSpyMerchantOpeningHoursWeekdaySchedules) {
                    foreach ($this->collSpyMerchantOpeningHoursWeekdaySchedules as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantOpeningHoursWeekdaySchedules[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantOpeningHoursWeekdaySchedules = $collSpyMerchantOpeningHoursWeekdaySchedules;
                $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial = false;
            }
        }

        return $this->collSpyMerchantOpeningHoursWeekdaySchedules;
    }

    /**
     * Sets a collection of SpyMerchantOpeningHoursWeekdaySchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantOpeningHoursWeekdaySchedules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantOpeningHoursWeekdaySchedules(Collection $spyMerchantOpeningHoursWeekdaySchedules, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantOpeningHoursWeekdaySchedule[] $spyMerchantOpeningHoursWeekdaySchedulesToDelete */
        $spyMerchantOpeningHoursWeekdaySchedulesToDelete = $this->getSpyMerchantOpeningHoursWeekdaySchedules(new Criteria(), $con)->diff($spyMerchantOpeningHoursWeekdaySchedules);


        $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion = $spyMerchantOpeningHoursWeekdaySchedulesToDelete;

        foreach ($spyMerchantOpeningHoursWeekdaySchedulesToDelete as $spyMerchantOpeningHoursWeekdayScheduleRemoved) {
            $spyMerchantOpeningHoursWeekdayScheduleRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantOpeningHoursWeekdaySchedules = null;
        foreach ($spyMerchantOpeningHoursWeekdaySchedules as $spyMerchantOpeningHoursWeekdaySchedule) {
            $this->addSpyMerchantOpeningHoursWeekdaySchedule($spyMerchantOpeningHoursWeekdaySchedule);
        }

        $this->collSpyMerchantOpeningHoursWeekdaySchedules = $spyMerchantOpeningHoursWeekdaySchedules;
        $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantOpeningHoursWeekdaySchedule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantOpeningHoursWeekdaySchedule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantOpeningHoursWeekdaySchedules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantOpeningHoursWeekdaySchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantOpeningHoursWeekdaySchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantOpeningHoursWeekdaySchedules());
            }

            $query = SpyMerchantOpeningHoursWeekdayScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantOpeningHoursWeekdaySchedules);
    }

    /**
     * Method called to associate a SpyMerchantOpeningHoursWeekdaySchedule object to this object
     * through the SpyMerchantOpeningHoursWeekdaySchedule foreign key attribute.
     *
     * @param SpyMerchantOpeningHoursWeekdaySchedule $l SpyMerchantOpeningHoursWeekdaySchedule
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantOpeningHoursWeekdaySchedule(SpyMerchantOpeningHoursWeekdaySchedule $l)
    {
        if ($this->collSpyMerchantOpeningHoursWeekdaySchedules === null) {
            $this->initSpyMerchantOpeningHoursWeekdaySchedules();
            $this->collSpyMerchantOpeningHoursWeekdaySchedulesPartial = true;
        }

        if (!$this->collSpyMerchantOpeningHoursWeekdaySchedules->contains($l)) {
            $this->doAddSpyMerchantOpeningHoursWeekdaySchedule($l);

            if ($this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion and $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->contains($l)) {
                $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->remove($this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantOpeningHoursWeekdaySchedule $spyMerchantOpeningHoursWeekdaySchedule The SpyMerchantOpeningHoursWeekdaySchedule object to add.
     */
    protected function doAddSpyMerchantOpeningHoursWeekdaySchedule(SpyMerchantOpeningHoursWeekdaySchedule $spyMerchantOpeningHoursWeekdaySchedule): void
    {
        $this->collSpyMerchantOpeningHoursWeekdaySchedules[]= $spyMerchantOpeningHoursWeekdaySchedule;
        $spyMerchantOpeningHoursWeekdaySchedule->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantOpeningHoursWeekdaySchedule $spyMerchantOpeningHoursWeekdaySchedule The SpyMerchantOpeningHoursWeekdaySchedule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantOpeningHoursWeekdaySchedule(SpyMerchantOpeningHoursWeekdaySchedule $spyMerchantOpeningHoursWeekdaySchedule)
    {
        if ($this->getSpyMerchantOpeningHoursWeekdaySchedules()->contains($spyMerchantOpeningHoursWeekdaySchedule)) {
            $pos = $this->collSpyMerchantOpeningHoursWeekdaySchedules->search($spyMerchantOpeningHoursWeekdaySchedule);
            $this->collSpyMerchantOpeningHoursWeekdaySchedules->remove($pos);
            if (null === $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion) {
                $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion = clone $this->collSpyMerchantOpeningHoursWeekdaySchedules;
                $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion->clear();
            }
            $this->spyMerchantOpeningHoursWeekdaySchedulesScheduledForDeletion[]= clone $spyMerchantOpeningHoursWeekdaySchedule;
            $spyMerchantOpeningHoursWeekdaySchedule->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantOpeningHoursWeekdaySchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantOpeningHoursWeekdaySchedule[] List of SpyMerchantOpeningHoursWeekdaySchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantOpeningHoursWeekdaySchedule}> List of SpyMerchantOpeningHoursWeekdaySchedule objects
     */
    public function getSpyMerchantOpeningHoursWeekdaySchedulesJoinSpyWeekdaySchedule(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantOpeningHoursWeekdayScheduleQuery::create(null, $criteria);
        $query->joinWith('SpyWeekdaySchedule', $joinBehavior);

        return $this->getSpyMerchantOpeningHoursWeekdaySchedules($query, $con);
    }

    /**
     * Clears out the collSpyMerchantOpeningHoursDateSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantOpeningHoursDateSchedules()
     */
    public function clearSpyMerchantOpeningHoursDateSchedules()
    {
        $this->collSpyMerchantOpeningHoursDateSchedules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantOpeningHoursDateSchedules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantOpeningHoursDateSchedules($v = true): void
    {
        $this->collSpyMerchantOpeningHoursDateSchedulesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantOpeningHoursDateSchedules collection.
     *
     * By default this just sets the collSpyMerchantOpeningHoursDateSchedules collection to an empty array (like clearcollSpyMerchantOpeningHoursDateSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantOpeningHoursDateSchedules(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantOpeningHoursDateSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantOpeningHoursDateScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantOpeningHoursDateSchedules = new $collectionClassName;
        $this->collSpyMerchantOpeningHoursDateSchedules->setModel('\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule');
    }

    /**
     * Gets an array of SpyMerchantOpeningHoursDateSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantOpeningHoursDateSchedule[] List of SpyMerchantOpeningHoursDateSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantOpeningHoursDateSchedule> List of SpyMerchantOpeningHoursDateSchedule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantOpeningHoursDateSchedules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantOpeningHoursDateSchedulesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantOpeningHoursDateSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantOpeningHoursDateSchedules) {
                    $this->initSpyMerchantOpeningHoursDateSchedules();
                } else {
                    $collectionClassName = SpyMerchantOpeningHoursDateScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantOpeningHoursDateSchedules = new $collectionClassName;
                    $collSpyMerchantOpeningHoursDateSchedules->setModel('\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule');

                    return $collSpyMerchantOpeningHoursDateSchedules;
                }
            } else {
                $collSpyMerchantOpeningHoursDateSchedules = SpyMerchantOpeningHoursDateScheduleQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantOpeningHoursDateSchedulesPartial && count($collSpyMerchantOpeningHoursDateSchedules)) {
                        $this->initSpyMerchantOpeningHoursDateSchedules(false);

                        foreach ($collSpyMerchantOpeningHoursDateSchedules as $obj) {
                            if (false == $this->collSpyMerchantOpeningHoursDateSchedules->contains($obj)) {
                                $this->collSpyMerchantOpeningHoursDateSchedules->append($obj);
                            }
                        }

                        $this->collSpyMerchantOpeningHoursDateSchedulesPartial = true;
                    }

                    return $collSpyMerchantOpeningHoursDateSchedules;
                }

                if ($partial && $this->collSpyMerchantOpeningHoursDateSchedules) {
                    foreach ($this->collSpyMerchantOpeningHoursDateSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantOpeningHoursDateSchedules[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantOpeningHoursDateSchedules = $collSpyMerchantOpeningHoursDateSchedules;
                $this->collSpyMerchantOpeningHoursDateSchedulesPartial = false;
            }
        }

        return $this->collSpyMerchantOpeningHoursDateSchedules;
    }

    /**
     * Sets a collection of SpyMerchantOpeningHoursDateSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantOpeningHoursDateSchedules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantOpeningHoursDateSchedules(Collection $spyMerchantOpeningHoursDateSchedules, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantOpeningHoursDateSchedule[] $spyMerchantOpeningHoursDateSchedulesToDelete */
        $spyMerchantOpeningHoursDateSchedulesToDelete = $this->getSpyMerchantOpeningHoursDateSchedules(new Criteria(), $con)->diff($spyMerchantOpeningHoursDateSchedules);


        $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion = $spyMerchantOpeningHoursDateSchedulesToDelete;

        foreach ($spyMerchantOpeningHoursDateSchedulesToDelete as $spyMerchantOpeningHoursDateScheduleRemoved) {
            $spyMerchantOpeningHoursDateScheduleRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantOpeningHoursDateSchedules = null;
        foreach ($spyMerchantOpeningHoursDateSchedules as $spyMerchantOpeningHoursDateSchedule) {
            $this->addSpyMerchantOpeningHoursDateSchedule($spyMerchantOpeningHoursDateSchedule);
        }

        $this->collSpyMerchantOpeningHoursDateSchedules = $spyMerchantOpeningHoursDateSchedules;
        $this->collSpyMerchantOpeningHoursDateSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantOpeningHoursDateSchedule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantOpeningHoursDateSchedule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantOpeningHoursDateSchedules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantOpeningHoursDateSchedulesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantOpeningHoursDateSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantOpeningHoursDateSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantOpeningHoursDateSchedules());
            }

            $query = SpyMerchantOpeningHoursDateScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantOpeningHoursDateSchedules);
    }

    /**
     * Method called to associate a SpyMerchantOpeningHoursDateSchedule object to this object
     * through the SpyMerchantOpeningHoursDateSchedule foreign key attribute.
     *
     * @param SpyMerchantOpeningHoursDateSchedule $l SpyMerchantOpeningHoursDateSchedule
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantOpeningHoursDateSchedule(SpyMerchantOpeningHoursDateSchedule $l)
    {
        if ($this->collSpyMerchantOpeningHoursDateSchedules === null) {
            $this->initSpyMerchantOpeningHoursDateSchedules();
            $this->collSpyMerchantOpeningHoursDateSchedulesPartial = true;
        }

        if (!$this->collSpyMerchantOpeningHoursDateSchedules->contains($l)) {
            $this->doAddSpyMerchantOpeningHoursDateSchedule($l);

            if ($this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion and $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->contains($l)) {
                $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->remove($this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantOpeningHoursDateSchedule $spyMerchantOpeningHoursDateSchedule The SpyMerchantOpeningHoursDateSchedule object to add.
     */
    protected function doAddSpyMerchantOpeningHoursDateSchedule(SpyMerchantOpeningHoursDateSchedule $spyMerchantOpeningHoursDateSchedule): void
    {
        $this->collSpyMerchantOpeningHoursDateSchedules[]= $spyMerchantOpeningHoursDateSchedule;
        $spyMerchantOpeningHoursDateSchedule->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantOpeningHoursDateSchedule $spyMerchantOpeningHoursDateSchedule The SpyMerchantOpeningHoursDateSchedule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantOpeningHoursDateSchedule(SpyMerchantOpeningHoursDateSchedule $spyMerchantOpeningHoursDateSchedule)
    {
        if ($this->getSpyMerchantOpeningHoursDateSchedules()->contains($spyMerchantOpeningHoursDateSchedule)) {
            $pos = $this->collSpyMerchantOpeningHoursDateSchedules->search($spyMerchantOpeningHoursDateSchedule);
            $this->collSpyMerchantOpeningHoursDateSchedules->remove($pos);
            if (null === $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion) {
                $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion = clone $this->collSpyMerchantOpeningHoursDateSchedules;
                $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion->clear();
            }
            $this->spyMerchantOpeningHoursDateSchedulesScheduledForDeletion[]= clone $spyMerchantOpeningHoursDateSchedule;
            $spyMerchantOpeningHoursDateSchedule->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantOpeningHoursDateSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantOpeningHoursDateSchedule[] List of SpyMerchantOpeningHoursDateSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantOpeningHoursDateSchedule}> List of SpyMerchantOpeningHoursDateSchedule objects
     */
    public function getSpyMerchantOpeningHoursDateSchedulesJoinSpyDateSchedule(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantOpeningHoursDateScheduleQuery::create(null, $criteria);
        $query->joinWith('SpyDateSchedule', $joinBehavior);

        return $this->getSpyMerchantOpeningHoursDateSchedules($query, $con);
    }

    /**
     * Clears out the collSpyMerchantProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProductAbstracts()
     */
    public function clearSpyMerchantProductAbstracts()
    {
        $this->collSpyMerchantProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProductAbstracts($v = true): void
    {
        $this->collSpyMerchantProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProductAbstracts collection.
     *
     * By default this just sets the collSpyMerchantProductAbstracts collection to an empty array (like clearcollSpyMerchantProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProductAbstracts = new $collectionClassName;
        $this->collSpyMerchantProductAbstracts->setModel('\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract');
    }

    /**
     * Gets an array of SpyMerchantProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantProductAbstract[] List of SpyMerchantProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProductAbstract> List of SpyMerchantProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProductAbstracts) {
                    $this->initSpyMerchantProductAbstracts();
                } else {
                    $collectionClassName = SpyMerchantProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProductAbstracts = new $collectionClassName;
                    $collSpyMerchantProductAbstracts->setModel('\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract');

                    return $collSpyMerchantProductAbstracts;
                }
            } else {
                $collSpyMerchantProductAbstracts = SpyMerchantProductAbstractQuery::create(null, $criteria)
                    ->filterByMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProductAbstractsPartial && count($collSpyMerchantProductAbstracts)) {
                        $this->initSpyMerchantProductAbstracts(false);

                        foreach ($collSpyMerchantProductAbstracts as $obj) {
                            if (false == $this->collSpyMerchantProductAbstracts->contains($obj)) {
                                $this->collSpyMerchantProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyMerchantProductAbstractsPartial = true;
                    }

                    return $collSpyMerchantProductAbstracts;
                }

                if ($partial && $this->collSpyMerchantProductAbstracts) {
                    foreach ($this->collSpyMerchantProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProductAbstracts = $collSpyMerchantProductAbstracts;
                $this->collSpyMerchantProductAbstractsPartial = false;
            }
        }

        return $this->collSpyMerchantProductAbstracts;
    }

    /**
     * Sets a collection of SpyMerchantProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProductAbstracts(Collection $spyMerchantProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantProductAbstract[] $spyMerchantProductAbstractsToDelete */
        $spyMerchantProductAbstractsToDelete = $this->getSpyMerchantProductAbstracts(new Criteria(), $con)->diff($spyMerchantProductAbstracts);


        $this->spyMerchantProductAbstractsScheduledForDeletion = $spyMerchantProductAbstractsToDelete;

        foreach ($spyMerchantProductAbstractsToDelete as $spyMerchantProductAbstractRemoved) {
            $spyMerchantProductAbstractRemoved->setMerchant(null);
        }

        $this->collSpyMerchantProductAbstracts = null;
        foreach ($spyMerchantProductAbstracts as $spyMerchantProductAbstract) {
            $this->addSpyMerchantProductAbstract($spyMerchantProductAbstract);
        }

        $this->collSpyMerchantProductAbstracts = $spyMerchantProductAbstracts;
        $this->collSpyMerchantProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProductAbstracts());
            }

            $query = SpyMerchantProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProductAbstracts);
    }

    /**
     * Method called to associate a SpyMerchantProductAbstract object to this object
     * through the SpyMerchantProductAbstract foreign key attribute.
     *
     * @param SpyMerchantProductAbstract $l SpyMerchantProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProductAbstract(SpyMerchantProductAbstract $l)
    {
        if ($this->collSpyMerchantProductAbstracts === null) {
            $this->initSpyMerchantProductAbstracts();
            $this->collSpyMerchantProductAbstractsPartial = true;
        }

        if (!$this->collSpyMerchantProductAbstracts->contains($l)) {
            $this->doAddSpyMerchantProductAbstract($l);

            if ($this->spyMerchantProductAbstractsScheduledForDeletion and $this->spyMerchantProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyMerchantProductAbstractsScheduledForDeletion->remove($this->spyMerchantProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantProductAbstract $spyMerchantProductAbstract The SpyMerchantProductAbstract object to add.
     */
    protected function doAddSpyMerchantProductAbstract(SpyMerchantProductAbstract $spyMerchantProductAbstract): void
    {
        $this->collSpyMerchantProductAbstracts[]= $spyMerchantProductAbstract;
        $spyMerchantProductAbstract->setMerchant($this);
    }

    /**
     * @param SpyMerchantProductAbstract $spyMerchantProductAbstract The SpyMerchantProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProductAbstract(SpyMerchantProductAbstract $spyMerchantProductAbstract)
    {
        if ($this->getSpyMerchantProductAbstracts()->contains($spyMerchantProductAbstract)) {
            $pos = $this->collSpyMerchantProductAbstracts->search($spyMerchantProductAbstract);
            $this->collSpyMerchantProductAbstracts->remove($pos);
            if (null === $this->spyMerchantProductAbstractsScheduledForDeletion) {
                $this->spyMerchantProductAbstractsScheduledForDeletion = clone $this->collSpyMerchantProductAbstracts;
                $this->spyMerchantProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyMerchantProductAbstractsScheduledForDeletion[]= clone $spyMerchantProductAbstract;
            $spyMerchantProductAbstract->setMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantProductAbstract[] List of SpyMerchantProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProductAbstract}> List of SpyMerchantProductAbstract objects
     */
    public function getSpyMerchantProductAbstractsJoinProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantProductAbstractQuery::create(null, $criteria);
        $query->joinWith('ProductAbstract', $joinBehavior);

        return $this->getSpyMerchantProductAbstracts($query, $con);
    }

    /**
     * Clears out the collSpyMerchantProfiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProfiles()
     */
    public function clearSpyMerchantProfiles()
    {
        $this->collSpyMerchantProfiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProfiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProfiles($v = true): void
    {
        $this->collSpyMerchantProfilesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProfiles collection.
     *
     * By default this just sets the collSpyMerchantProfiles collection to an empty array (like clearcollSpyMerchantProfiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProfiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProfiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProfileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProfiles = new $collectionClassName;
        $this->collSpyMerchantProfiles->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile');
    }

    /**
     * Gets an array of SpyMerchantProfile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantProfile[] List of SpyMerchantProfile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProfile> List of SpyMerchantProfile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProfiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProfilesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProfiles) {
                    $this->initSpyMerchantProfiles();
                } else {
                    $collectionClassName = SpyMerchantProfileTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProfiles = new $collectionClassName;
                    $collSpyMerchantProfiles->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile');

                    return $collSpyMerchantProfiles;
                }
            } else {
                $collSpyMerchantProfiles = SpyMerchantProfileQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProfilesPartial && count($collSpyMerchantProfiles)) {
                        $this->initSpyMerchantProfiles(false);

                        foreach ($collSpyMerchantProfiles as $obj) {
                            if (false == $this->collSpyMerchantProfiles->contains($obj)) {
                                $this->collSpyMerchantProfiles->append($obj);
                            }
                        }

                        $this->collSpyMerchantProfilesPartial = true;
                    }

                    return $collSpyMerchantProfiles;
                }

                if ($partial && $this->collSpyMerchantProfiles) {
                    foreach ($this->collSpyMerchantProfiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProfiles[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProfiles = $collSpyMerchantProfiles;
                $this->collSpyMerchantProfilesPartial = false;
            }
        }

        return $this->collSpyMerchantProfiles;
    }

    /**
     * Sets a collection of SpyMerchantProfile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProfiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProfiles(Collection $spyMerchantProfiles, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantProfile[] $spyMerchantProfilesToDelete */
        $spyMerchantProfilesToDelete = $this->getSpyMerchantProfiles(new Criteria(), $con)->diff($spyMerchantProfiles);


        $this->spyMerchantProfilesScheduledForDeletion = $spyMerchantProfilesToDelete;

        foreach ($spyMerchantProfilesToDelete as $spyMerchantProfileRemoved) {
            $spyMerchantProfileRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantProfiles = null;
        foreach ($spyMerchantProfiles as $spyMerchantProfile) {
            $this->addSpyMerchantProfile($spyMerchantProfile);
        }

        $this->collSpyMerchantProfiles = $spyMerchantProfiles;
        $this->collSpyMerchantProfilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantProfile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantProfile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProfiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProfilesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProfiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProfiles());
            }

            $query = SpyMerchantProfileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProfiles);
    }

    /**
     * Method called to associate a SpyMerchantProfile object to this object
     * through the SpyMerchantProfile foreign key attribute.
     *
     * @param SpyMerchantProfile $l SpyMerchantProfile
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProfile(SpyMerchantProfile $l)
    {
        if ($this->collSpyMerchantProfiles === null) {
            $this->initSpyMerchantProfiles();
            $this->collSpyMerchantProfilesPartial = true;
        }

        if (!$this->collSpyMerchantProfiles->contains($l)) {
            $this->doAddSpyMerchantProfile($l);

            if ($this->spyMerchantProfilesScheduledForDeletion and $this->spyMerchantProfilesScheduledForDeletion->contains($l)) {
                $this->spyMerchantProfilesScheduledForDeletion->remove($this->spyMerchantProfilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantProfile $spyMerchantProfile The SpyMerchantProfile object to add.
     */
    protected function doAddSpyMerchantProfile(SpyMerchantProfile $spyMerchantProfile): void
    {
        $this->collSpyMerchantProfiles[]= $spyMerchantProfile;
        $spyMerchantProfile->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantProfile $spyMerchantProfile The SpyMerchantProfile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProfile(SpyMerchantProfile $spyMerchantProfile)
    {
        if ($this->getSpyMerchantProfiles()->contains($spyMerchantProfile)) {
            $pos = $this->collSpyMerchantProfiles->search($spyMerchantProfile);
            $this->collSpyMerchantProfiles->remove($pos);
            if (null === $this->spyMerchantProfilesScheduledForDeletion) {
                $this->spyMerchantProfilesScheduledForDeletion = clone $this->collSpyMerchantProfiles;
                $this->spyMerchantProfilesScheduledForDeletion->clear();
            }
            $this->spyMerchantProfilesScheduledForDeletion[]= clone $spyMerchantProfile;
            $spyMerchantProfile->setSpyMerchant(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyMerchantRelationRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRelationRequests()
     */
    public function clearSpyMerchantRelationRequests()
    {
        $this->collSpyMerchantRelationRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRelationRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRelationRequests($v = true): void
    {
        $this->collSpyMerchantRelationRequestsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRelationRequests collection.
     *
     * By default this just sets the collSpyMerchantRelationRequests collection to an empty array (like clearcollSpyMerchantRelationRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRelationRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRelationRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRelationRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRelationRequests = new $collectionClassName;
        $this->collSpyMerchantRelationRequests->setModel('\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest');
    }

    /**
     * Gets an array of SpyMerchantRelationRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRelationRequest[] List of SpyMerchantRelationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequest> List of SpyMerchantRelationRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRelationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRelationRequests) {
                    $this->initSpyMerchantRelationRequests();
                } else {
                    $collectionClassName = SpyMerchantRelationRequestTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRelationRequests = new $collectionClassName;
                    $collSpyMerchantRelationRequests->setModel('\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest');

                    return $collSpyMerchantRelationRequests;
                }
            } else {
                $collSpyMerchantRelationRequests = SpyMerchantRelationRequestQuery::create(null, $criteria)
                    ->filterByMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRelationRequestsPartial && count($collSpyMerchantRelationRequests)) {
                        $this->initSpyMerchantRelationRequests(false);

                        foreach ($collSpyMerchantRelationRequests as $obj) {
                            if (false == $this->collSpyMerchantRelationRequests->contains($obj)) {
                                $this->collSpyMerchantRelationRequests->append($obj);
                            }
                        }

                        $this->collSpyMerchantRelationRequestsPartial = true;
                    }

                    return $collSpyMerchantRelationRequests;
                }

                if ($partial && $this->collSpyMerchantRelationRequests) {
                    foreach ($this->collSpyMerchantRelationRequests as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRelationRequests[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRelationRequests = $collSpyMerchantRelationRequests;
                $this->collSpyMerchantRelationRequestsPartial = false;
            }
        }

        return $this->collSpyMerchantRelationRequests;
    }

    /**
     * Sets a collection of SpyMerchantRelationRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRelationRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRelationRequests(Collection $spyMerchantRelationRequests, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRelationRequest[] $spyMerchantRelationRequestsToDelete */
        $spyMerchantRelationRequestsToDelete = $this->getSpyMerchantRelationRequests(new Criteria(), $con)->diff($spyMerchantRelationRequests);


        $this->spyMerchantRelationRequestsScheduledForDeletion = $spyMerchantRelationRequestsToDelete;

        foreach ($spyMerchantRelationRequestsToDelete as $spyMerchantRelationRequestRemoved) {
            $spyMerchantRelationRequestRemoved->setMerchant(null);
        }

        $this->collSpyMerchantRelationRequests = null;
        foreach ($spyMerchantRelationRequests as $spyMerchantRelationRequest) {
            $this->addSpyMerchantRelationRequest($spyMerchantRelationRequest);
        }

        $this->collSpyMerchantRelationRequests = $spyMerchantRelationRequests;
        $this->collSpyMerchantRelationRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRelationRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRelationRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRelationRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRelationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRelationRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRelationRequests());
            }

            $query = SpyMerchantRelationRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationRequests);
    }

    /**
     * Method called to associate a SpyMerchantRelationRequest object to this object
     * through the SpyMerchantRelationRequest foreign key attribute.
     *
     * @param SpyMerchantRelationRequest $l SpyMerchantRelationRequest
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationRequest(SpyMerchantRelationRequest $l)
    {
        if ($this->collSpyMerchantRelationRequests === null) {
            $this->initSpyMerchantRelationRequests();
            $this->collSpyMerchantRelationRequestsPartial = true;
        }

        if (!$this->collSpyMerchantRelationRequests->contains($l)) {
            $this->doAddSpyMerchantRelationRequest($l);

            if ($this->spyMerchantRelationRequestsScheduledForDeletion and $this->spyMerchantRelationRequestsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRelationRequestsScheduledForDeletion->remove($this->spyMerchantRelationRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRelationRequest $spyMerchantRelationRequest The SpyMerchantRelationRequest object to add.
     */
    protected function doAddSpyMerchantRelationRequest(SpyMerchantRelationRequest $spyMerchantRelationRequest): void
    {
        $this->collSpyMerchantRelationRequests[]= $spyMerchantRelationRequest;
        $spyMerchantRelationRequest->setMerchant($this);
    }

    /**
     * @param SpyMerchantRelationRequest $spyMerchantRelationRequest The SpyMerchantRelationRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationRequest(SpyMerchantRelationRequest $spyMerchantRelationRequest)
    {
        if ($this->getSpyMerchantRelationRequests()->contains($spyMerchantRelationRequest)) {
            $pos = $this->collSpyMerchantRelationRequests->search($spyMerchantRelationRequest);
            $this->collSpyMerchantRelationRequests->remove($pos);
            if (null === $this->spyMerchantRelationRequestsScheduledForDeletion) {
                $this->spyMerchantRelationRequestsScheduledForDeletion = clone $this->collSpyMerchantRelationRequests;
                $this->spyMerchantRelationRequestsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationRequestsScheduledForDeletion[]= clone $spyMerchantRelationRequest;
            $spyMerchantRelationRequest->setMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationRequest[] List of SpyMerchantRelationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequest}> List of SpyMerchantRelationRequest objects
     */
    public function getSpyMerchantRelationRequestsJoinCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationRequestQuery::create(null, $criteria);
        $query->joinWith('CompanyUser', $joinBehavior);

        return $this->getSpyMerchantRelationRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationRequest[] List of SpyMerchantRelationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequest}> List of SpyMerchantRelationRequest objects
     */
    public function getSpyMerchantRelationRequestsJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationRequestQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getSpyMerchantRelationRequests($query, $con);
    }

    /**
     * Clears out the collSpyMerchantRelationships collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRelationships()
     */
    public function clearSpyMerchantRelationships()
    {
        $this->collSpyMerchantRelationships = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRelationships collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRelationships($v = true): void
    {
        $this->collSpyMerchantRelationshipsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRelationships collection.
     *
     * By default this just sets the collSpyMerchantRelationships collection to an empty array (like clearcollSpyMerchantRelationships());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRelationships(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRelationships && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRelationshipTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRelationships = new $collectionClassName;
        $this->collSpyMerchantRelationships->setModel('\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship');
    }

    /**
     * Gets an array of SpyMerchantRelationship objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRelationship[] List of SpyMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationship> List of SpyMerchantRelationship objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationships(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRelationshipsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationships || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRelationships) {
                    $this->initSpyMerchantRelationships();
                } else {
                    $collectionClassName = SpyMerchantRelationshipTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRelationships = new $collectionClassName;
                    $collSpyMerchantRelationships->setModel('\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship');

                    return $collSpyMerchantRelationships;
                }
            } else {
                $collSpyMerchantRelationships = SpyMerchantRelationshipQuery::create(null, $criteria)
                    ->filterByMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRelationshipsPartial && count($collSpyMerchantRelationships)) {
                        $this->initSpyMerchantRelationships(false);

                        foreach ($collSpyMerchantRelationships as $obj) {
                            if (false == $this->collSpyMerchantRelationships->contains($obj)) {
                                $this->collSpyMerchantRelationships->append($obj);
                            }
                        }

                        $this->collSpyMerchantRelationshipsPartial = true;
                    }

                    return $collSpyMerchantRelationships;
                }

                if ($partial && $this->collSpyMerchantRelationships) {
                    foreach ($this->collSpyMerchantRelationships as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRelationships[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRelationships = $collSpyMerchantRelationships;
                $this->collSpyMerchantRelationshipsPartial = false;
            }
        }

        return $this->collSpyMerchantRelationships;
    }

    /**
     * Sets a collection of SpyMerchantRelationship objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRelationships A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRelationships(Collection $spyMerchantRelationships, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRelationship[] $spyMerchantRelationshipsToDelete */
        $spyMerchantRelationshipsToDelete = $this->getSpyMerchantRelationships(new Criteria(), $con)->diff($spyMerchantRelationships);


        $this->spyMerchantRelationshipsScheduledForDeletion = $spyMerchantRelationshipsToDelete;

        foreach ($spyMerchantRelationshipsToDelete as $spyMerchantRelationshipRemoved) {
            $spyMerchantRelationshipRemoved->setMerchant(null);
        }

        $this->collSpyMerchantRelationships = null;
        foreach ($spyMerchantRelationships as $spyMerchantRelationship) {
            $this->addSpyMerchantRelationship($spyMerchantRelationship);
        }

        $this->collSpyMerchantRelationships = $spyMerchantRelationships;
        $this->collSpyMerchantRelationshipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRelationship objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRelationship objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRelationships(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRelationshipsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationships || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRelationships) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRelationships());
            }

            $query = SpyMerchantRelationshipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationships);
    }

    /**
     * Method called to associate a SpyMerchantRelationship object to this object
     * through the SpyMerchantRelationship foreign key attribute.
     *
     * @param SpyMerchantRelationship $l SpyMerchantRelationship
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationship(SpyMerchantRelationship $l)
    {
        if ($this->collSpyMerchantRelationships === null) {
            $this->initSpyMerchantRelationships();
            $this->collSpyMerchantRelationshipsPartial = true;
        }

        if (!$this->collSpyMerchantRelationships->contains($l)) {
            $this->doAddSpyMerchantRelationship($l);

            if ($this->spyMerchantRelationshipsScheduledForDeletion and $this->spyMerchantRelationshipsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRelationshipsScheduledForDeletion->remove($this->spyMerchantRelationshipsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRelationship $spyMerchantRelationship The SpyMerchantRelationship object to add.
     */
    protected function doAddSpyMerchantRelationship(SpyMerchantRelationship $spyMerchantRelationship): void
    {
        $this->collSpyMerchantRelationships[]= $spyMerchantRelationship;
        $spyMerchantRelationship->setMerchant($this);
    }

    /**
     * @param SpyMerchantRelationship $spyMerchantRelationship The SpyMerchantRelationship object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationship(SpyMerchantRelationship $spyMerchantRelationship)
    {
        if ($this->getSpyMerchantRelationships()->contains($spyMerchantRelationship)) {
            $pos = $this->collSpyMerchantRelationships->search($spyMerchantRelationship);
            $this->collSpyMerchantRelationships->remove($pos);
            if (null === $this->spyMerchantRelationshipsScheduledForDeletion) {
                $this->spyMerchantRelationshipsScheduledForDeletion = clone $this->collSpyMerchantRelationships;
                $this->spyMerchantRelationshipsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationshipsScheduledForDeletion[]= clone $spyMerchantRelationship;
            $spyMerchantRelationship->setMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantRelationships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationship[] List of SpyMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationship}> List of SpyMerchantRelationship objects
     */
    public function getSpyMerchantRelationshipsJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getSpyMerchantRelationships($query, $con);
    }

    /**
     * Clears out the collSpyMerchantStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantStocks()
     */
    public function clearSpyMerchantStocks()
    {
        $this->collSpyMerchantStocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantStocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantStocks($v = true): void
    {
        $this->collSpyMerchantStocksPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantStocks collection.
     *
     * By default this just sets the collSpyMerchantStocks collection to an empty array (like clearcollSpyMerchantStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantStocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantStockTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantStocks = new $collectionClassName;
        $this->collSpyMerchantStocks->setModel('\Orm\Zed\MerchantStock\Persistence\SpyMerchantStock');
    }

    /**
     * Gets an array of SpyMerchantStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantStock[] List of SpyMerchantStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStock> List of SpyMerchantStock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantStocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantStocksPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantStocks) {
                    $this->initSpyMerchantStocks();
                } else {
                    $collectionClassName = SpyMerchantStockTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantStocks = new $collectionClassName;
                    $collSpyMerchantStocks->setModel('\Orm\Zed\MerchantStock\Persistence\SpyMerchantStock');

                    return $collSpyMerchantStocks;
                }
            } else {
                $collSpyMerchantStocks = SpyMerchantStockQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantStocksPartial && count($collSpyMerchantStocks)) {
                        $this->initSpyMerchantStocks(false);

                        foreach ($collSpyMerchantStocks as $obj) {
                            if (false == $this->collSpyMerchantStocks->contains($obj)) {
                                $this->collSpyMerchantStocks->append($obj);
                            }
                        }

                        $this->collSpyMerchantStocksPartial = true;
                    }

                    return $collSpyMerchantStocks;
                }

                if ($partial && $this->collSpyMerchantStocks) {
                    foreach ($this->collSpyMerchantStocks as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantStocks[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantStocks = $collSpyMerchantStocks;
                $this->collSpyMerchantStocksPartial = false;
            }
        }

        return $this->collSpyMerchantStocks;
    }

    /**
     * Sets a collection of SpyMerchantStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantStocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantStocks(Collection $spyMerchantStocks, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantStock[] $spyMerchantStocksToDelete */
        $spyMerchantStocksToDelete = $this->getSpyMerchantStocks(new Criteria(), $con)->diff($spyMerchantStocks);


        $this->spyMerchantStocksScheduledForDeletion = $spyMerchantStocksToDelete;

        foreach ($spyMerchantStocksToDelete as $spyMerchantStockRemoved) {
            $spyMerchantStockRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantStocks = null;
        foreach ($spyMerchantStocks as $spyMerchantStock) {
            $this->addSpyMerchantStock($spyMerchantStock);
        }

        $this->collSpyMerchantStocks = $spyMerchantStocks;
        $this->collSpyMerchantStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantStock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantStock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantStocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantStocksPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantStocks());
            }

            $query = SpyMerchantStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantStocks);
    }

    /**
     * Method called to associate a SpyMerchantStock object to this object
     * through the SpyMerchantStock foreign key attribute.
     *
     * @param SpyMerchantStock $l SpyMerchantStock
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantStock(SpyMerchantStock $l)
    {
        if ($this->collSpyMerchantStocks === null) {
            $this->initSpyMerchantStocks();
            $this->collSpyMerchantStocksPartial = true;
        }

        if (!$this->collSpyMerchantStocks->contains($l)) {
            $this->doAddSpyMerchantStock($l);

            if ($this->spyMerchantStocksScheduledForDeletion and $this->spyMerchantStocksScheduledForDeletion->contains($l)) {
                $this->spyMerchantStocksScheduledForDeletion->remove($this->spyMerchantStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantStock $spyMerchantStock The SpyMerchantStock object to add.
     */
    protected function doAddSpyMerchantStock(SpyMerchantStock $spyMerchantStock): void
    {
        $this->collSpyMerchantStocks[]= $spyMerchantStock;
        $spyMerchantStock->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantStock $spyMerchantStock The SpyMerchantStock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantStock(SpyMerchantStock $spyMerchantStock)
    {
        if ($this->getSpyMerchantStocks()->contains($spyMerchantStock)) {
            $pos = $this->collSpyMerchantStocks->search($spyMerchantStock);
            $this->collSpyMerchantStocks->remove($pos);
            if (null === $this->spyMerchantStocksScheduledForDeletion) {
                $this->spyMerchantStocksScheduledForDeletion = clone $this->collSpyMerchantStocks;
                $this->spyMerchantStocksScheduledForDeletion->clear();
            }
            $this->spyMerchantStocksScheduledForDeletion[]= clone $spyMerchantStock;
            $spyMerchantStock->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantStock[] List of SpyMerchantStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStock}> List of SpyMerchantStock objects
     */
    public function getSpyMerchantStocksJoinSpyStock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantStockQuery::create(null, $criteria);
        $query->joinWith('SpyStock', $joinBehavior);

        return $this->getSpyMerchantStocks($query, $con);
    }

    /**
     * Clears out the collSpyMerchantUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantUsers()
     */
    public function clearSpyMerchantUsers()
    {
        $this->collSpyMerchantUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantUsers($v = true): void
    {
        $this->collSpyMerchantUsersPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantUsers collection.
     *
     * By default this just sets the collSpyMerchantUsers collection to an empty array (like clearcollSpyMerchantUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantUsers = new $collectionClassName;
        $this->collSpyMerchantUsers->setModel('\Orm\Zed\MerchantUser\Persistence\SpyMerchantUser');
    }

    /**
     * Gets an array of SpyMerchantUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantUser[] List of SpyMerchantUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantUser> List of SpyMerchantUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantUsersPartial && !$this->isNew();
        if (null === $this->collSpyMerchantUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantUsers) {
                    $this->initSpyMerchantUsers();
                } else {
                    $collectionClassName = SpyMerchantUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantUsers = new $collectionClassName;
                    $collSpyMerchantUsers->setModel('\Orm\Zed\MerchantUser\Persistence\SpyMerchantUser');

                    return $collSpyMerchantUsers;
                }
            } else {
                $collSpyMerchantUsers = SpyMerchantUserQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantUsersPartial && count($collSpyMerchantUsers)) {
                        $this->initSpyMerchantUsers(false);

                        foreach ($collSpyMerchantUsers as $obj) {
                            if (false == $this->collSpyMerchantUsers->contains($obj)) {
                                $this->collSpyMerchantUsers->append($obj);
                            }
                        }

                        $this->collSpyMerchantUsersPartial = true;
                    }

                    return $collSpyMerchantUsers;
                }

                if ($partial && $this->collSpyMerchantUsers) {
                    foreach ($this->collSpyMerchantUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantUsers = $collSpyMerchantUsers;
                $this->collSpyMerchantUsersPartial = false;
            }
        }

        return $this->collSpyMerchantUsers;
    }

    /**
     * Sets a collection of SpyMerchantUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantUsers(Collection $spyMerchantUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantUser[] $spyMerchantUsersToDelete */
        $spyMerchantUsersToDelete = $this->getSpyMerchantUsers(new Criteria(), $con)->diff($spyMerchantUsers);


        $this->spyMerchantUsersScheduledForDeletion = $spyMerchantUsersToDelete;

        foreach ($spyMerchantUsersToDelete as $spyMerchantUserRemoved) {
            $spyMerchantUserRemoved->setSpyMerchant(null);
        }

        $this->collSpyMerchantUsers = null;
        foreach ($spyMerchantUsers as $spyMerchantUser) {
            $this->addSpyMerchantUser($spyMerchantUser);
        }

        $this->collSpyMerchantUsers = $spyMerchantUsers;
        $this->collSpyMerchantUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantUsersPartial && !$this->isNew();
        if (null === $this->collSpyMerchantUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantUsers());
            }

            $query = SpyMerchantUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyMerchantUsers);
    }

    /**
     * Method called to associate a SpyMerchantUser object to this object
     * through the SpyMerchantUser foreign key attribute.
     *
     * @param SpyMerchantUser $l SpyMerchantUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantUser(SpyMerchantUser $l)
    {
        if ($this->collSpyMerchantUsers === null) {
            $this->initSpyMerchantUsers();
            $this->collSpyMerchantUsersPartial = true;
        }

        if (!$this->collSpyMerchantUsers->contains($l)) {
            $this->doAddSpyMerchantUser($l);

            if ($this->spyMerchantUsersScheduledForDeletion and $this->spyMerchantUsersScheduledForDeletion->contains($l)) {
                $this->spyMerchantUsersScheduledForDeletion->remove($this->spyMerchantUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantUser $spyMerchantUser The SpyMerchantUser object to add.
     */
    protected function doAddSpyMerchantUser(SpyMerchantUser $spyMerchantUser): void
    {
        $this->collSpyMerchantUsers[]= $spyMerchantUser;
        $spyMerchantUser->setSpyMerchant($this);
    }

    /**
     * @param SpyMerchantUser $spyMerchantUser The SpyMerchantUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantUser(SpyMerchantUser $spyMerchantUser)
    {
        if ($this->getSpyMerchantUsers()->contains($spyMerchantUser)) {
            $pos = $this->collSpyMerchantUsers->search($spyMerchantUser);
            $this->collSpyMerchantUsers->remove($pos);
            if (null === $this->spyMerchantUsersScheduledForDeletion) {
                $this->spyMerchantUsersScheduledForDeletion = clone $this->collSpyMerchantUsers;
                $this->spyMerchantUsersScheduledForDeletion->clear();
            }
            $this->spyMerchantUsersScheduledForDeletion[]= clone $spyMerchantUser;
            $spyMerchantUser->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyMerchantUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantUser[] List of SpyMerchantUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantUser}> List of SpyMerchantUser objects
     */
    public function getSpyMerchantUsersJoinSpyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantUserQuery::create(null, $criteria);
        $query->joinWith('SpyUser', $joinBehavior);

        return $this->getSpyMerchantUsers($query, $con);
    }

    /**
     * Clears out the collProductOffers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOffers()
     */
    public function clearProductOffers()
    {
        $this->collProductOffers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOffers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOffers($v = true): void
    {
        $this->collProductOffersPartial = $v;
    }

    /**
     * Initializes the collProductOffers collection.
     *
     * By default this just sets the collProductOffers collection to an empty array (like clearcollProductOffers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOffers(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOffers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOffers = new $collectionClassName;
        $this->collProductOffers->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOffer');
    }

    /**
     * Gets an array of SpyProductOffer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOffer[] List of SpyProductOffer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOffer> List of SpyProductOffer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOffers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOffersPartial && !$this->isNew();
        if (null === $this->collProductOffers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOffers) {
                    $this->initProductOffers();
                } else {
                    $collectionClassName = SpyProductOfferTableMap::getTableMap()->getCollectionClassName();

                    $collProductOffers = new $collectionClassName;
                    $collProductOffers->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOffer');

                    return $collProductOffers;
                }
            } else {
                $collProductOffers = SpyProductOfferQuery::create(null, $criteria)
                    ->filterByMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOffersPartial && count($collProductOffers)) {
                        $this->initProductOffers(false);

                        foreach ($collProductOffers as $obj) {
                            if (false == $this->collProductOffers->contains($obj)) {
                                $this->collProductOffers->append($obj);
                            }
                        }

                        $this->collProductOffersPartial = true;
                    }

                    return $collProductOffers;
                }

                if ($partial && $this->collProductOffers) {
                    foreach ($this->collProductOffers as $obj) {
                        if ($obj->isNew()) {
                            $collProductOffers[] = $obj;
                        }
                    }
                }

                $this->collProductOffers = $collProductOffers;
                $this->collProductOffersPartial = false;
            }
        }

        return $this->collProductOffers;
    }

    /**
     * Sets a collection of SpyProductOffer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOffers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOffers(Collection $productOffers, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOffer[] $productOffersToDelete */
        $productOffersToDelete = $this->getProductOffers(new Criteria(), $con)->diff($productOffers);


        $this->productOffersScheduledForDeletion = $productOffersToDelete;

        foreach ($productOffersToDelete as $productOfferRemoved) {
            $productOfferRemoved->setMerchant(null);
        }

        $this->collProductOffers = null;
        foreach ($productOffers as $productOffer) {
            $this->addProductOffer($productOffer);
        }

        $this->collProductOffers = $productOffers;
        $this->collProductOffersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOffer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOffer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOffers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOffersPartial && !$this->isNew();
        if (null === $this->collProductOffers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOffers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOffers());
            }

            $query = SpyProductOfferQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchant($this)
                ->count($con);
        }

        return count($this->collProductOffers);
    }

    /**
     * Method called to associate a SpyProductOffer object to this object
     * through the SpyProductOffer foreign key attribute.
     *
     * @param SpyProductOffer $l SpyProductOffer
     * @return $this The current object (for fluent API support)
     */
    public function addProductOffer(SpyProductOffer $l)
    {
        if ($this->collProductOffers === null) {
            $this->initProductOffers();
            $this->collProductOffersPartial = true;
        }

        if (!$this->collProductOffers->contains($l)) {
            $this->doAddProductOffer($l);

            if ($this->productOffersScheduledForDeletion and $this->productOffersScheduledForDeletion->contains($l)) {
                $this->productOffersScheduledForDeletion->remove($this->productOffersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOffer $productOffer The SpyProductOffer object to add.
     */
    protected function doAddProductOffer(SpyProductOffer $productOffer): void
    {
        $this->collProductOffers[]= $productOffer;
        $productOffer->setMerchant($this);
    }

    /**
     * @param SpyProductOffer $productOffer The SpyProductOffer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOffer(SpyProductOffer $productOffer)
    {
        if ($this->getProductOffers()->contains($productOffer)) {
            $pos = $this->collProductOffers->search($productOffer);
            $this->collProductOffers->remove($pos);
            if (null === $this->productOffersScheduledForDeletion) {
                $this->productOffersScheduledForDeletion = clone $this->collProductOffers;
                $this->productOffersScheduledForDeletion->clear();
            }
            $this->productOffersScheduledForDeletion[]= $productOffer;
            $productOffer->setMerchant(null);
        }

        return $this;
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
     * If this ChildSpyMerchant is new, it will return
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
                    ->filterBySpyMerchant($this)
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
            $spySalesPaymentMerchantPayoutRemoved->setSpyMerchant(null);
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
                ->filterBySpyMerchant($this)
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
        $spySalesPaymentMerchantPayout->setSpyMerchant($this);
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
            $this->spySalesPaymentMerchantPayoutsScheduledForDeletion[]= $spySalesPaymentMerchantPayout;
            $spySalesPaymentMerchantPayout->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpySalesPaymentMerchantPayouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesPaymentMerchantPayout[] List of SpySalesPaymentMerchantPayout objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayout}> List of SpySalesPaymentMerchantPayout objects
     */
    public function getSpySalesPaymentMerchantPayoutsJoinSpySalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesPaymentMerchantPayoutQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrder', $joinBehavior);

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
     * If this ChildSpyMerchant is new, it will return
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
                    ->filterBySpyMerchant($this)
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
            $spySalesPaymentMerchantPayoutReversalRemoved->setSpyMerchant(null);
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
                ->filterBySpyMerchant($this)
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
        $spySalesPaymentMerchantPayoutReversal->setSpyMerchant($this);
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
            $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion[]= $spySalesPaymentMerchantPayoutReversal;
            $spySalesPaymentMerchantPayoutReversal->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpySalesPaymentMerchantPayoutReversals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesPaymentMerchantPayoutReversal[] List of SpySalesPaymentMerchantPayoutReversal objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayoutReversal}> List of SpySalesPaymentMerchantPayoutReversal objects
     */
    public function getSpySalesPaymentMerchantPayoutReversalsJoinSpySalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesPaymentMerchantPayoutReversalQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrder', $joinBehavior);

        return $this->getSpySalesPaymentMerchantPayoutReversals($query, $con);
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
     * If this ChildSpyMerchant is new, it will return
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
                    ->filterBySpyMerchant($this)
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
            $spyUrlRemoved->setSpyMerchant(null);
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
                ->filterBySpyMerchant($this)
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
        $spyUrl->setSpyMerchant($this);
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
            $this->spyUrlsScheduledForDeletion[]= $spyUrl;
            $spyUrl->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
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
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
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
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
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
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
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
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
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
     * Clears out the collSpyAclEntitySegmentMerchants collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclEntitySegmentMerchants()
     */
    public function clearSpyAclEntitySegmentMerchants()
    {
        $this->collSpyAclEntitySegmentMerchants = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclEntitySegmentMerchants collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclEntitySegmentMerchants($v = true): void
    {
        $this->collSpyAclEntitySegmentMerchantsPartial = $v;
    }

    /**
     * Initializes the collSpyAclEntitySegmentMerchants collection.
     *
     * By default this just sets the collSpyAclEntitySegmentMerchants collection to an empty array (like clearcollSpyAclEntitySegmentMerchants());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclEntitySegmentMerchants(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclEntitySegmentMerchants && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclEntitySegmentMerchantTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclEntitySegmentMerchants = new $collectionClassName;
        $this->collSpyAclEntitySegmentMerchants->setModel('\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant');
    }

    /**
     * Gets an array of ChildSpyAclEntitySegmentMerchant objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyAclEntitySegmentMerchant[] List of ChildSpyAclEntitySegmentMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclEntitySegmentMerchant> List of ChildSpyAclEntitySegmentMerchant objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclEntitySegmentMerchants(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclEntitySegmentMerchantsPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchants || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclEntitySegmentMerchants) {
                    $this->initSpyAclEntitySegmentMerchants();
                } else {
                    $collectionClassName = SpyAclEntitySegmentMerchantTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclEntitySegmentMerchants = new $collectionClassName;
                    $collSpyAclEntitySegmentMerchants->setModel('\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant');

                    return $collSpyAclEntitySegmentMerchants;
                }
            } else {
                $collSpyAclEntitySegmentMerchants = ChildSpyAclEntitySegmentMerchantQuery::create(null, $criteria)
                    ->filterBySpyMerchant($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclEntitySegmentMerchantsPartial && count($collSpyAclEntitySegmentMerchants)) {
                        $this->initSpyAclEntitySegmentMerchants(false);

                        foreach ($collSpyAclEntitySegmentMerchants as $obj) {
                            if (false == $this->collSpyAclEntitySegmentMerchants->contains($obj)) {
                                $this->collSpyAclEntitySegmentMerchants->append($obj);
                            }
                        }

                        $this->collSpyAclEntitySegmentMerchantsPartial = true;
                    }

                    return $collSpyAclEntitySegmentMerchants;
                }

                if ($partial && $this->collSpyAclEntitySegmentMerchants) {
                    foreach ($this->collSpyAclEntitySegmentMerchants as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclEntitySegmentMerchants[] = $obj;
                        }
                    }
                }

                $this->collSpyAclEntitySegmentMerchants = $collSpyAclEntitySegmentMerchants;
                $this->collSpyAclEntitySegmentMerchantsPartial = false;
            }
        }

        return $this->collSpyAclEntitySegmentMerchants;
    }

    /**
     * Sets a collection of ChildSpyAclEntitySegmentMerchant objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclEntitySegmentMerchants A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclEntitySegmentMerchants(Collection $spyAclEntitySegmentMerchants, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyAclEntitySegmentMerchant[] $spyAclEntitySegmentMerchantsToDelete */
        $spyAclEntitySegmentMerchantsToDelete = $this->getSpyAclEntitySegmentMerchants(new Criteria(), $con)->diff($spyAclEntitySegmentMerchants);


        $this->spyAclEntitySegmentMerchantsScheduledForDeletion = $spyAclEntitySegmentMerchantsToDelete;

        foreach ($spyAclEntitySegmentMerchantsToDelete as $spyAclEntitySegmentMerchantRemoved) {
            $spyAclEntitySegmentMerchantRemoved->setSpyMerchant(null);
        }

        $this->collSpyAclEntitySegmentMerchants = null;
        foreach ($spyAclEntitySegmentMerchants as $spyAclEntitySegmentMerchant) {
            $this->addSpyAclEntitySegmentMerchant($spyAclEntitySegmentMerchant);
        }

        $this->collSpyAclEntitySegmentMerchants = $spyAclEntitySegmentMerchants;
        $this->collSpyAclEntitySegmentMerchantsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyAclEntitySegmentMerchant objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyAclEntitySegmentMerchant objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclEntitySegmentMerchants(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclEntitySegmentMerchantsPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchants || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclEntitySegmentMerchants) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclEntitySegmentMerchants());
            }

            $query = ChildSpyAclEntitySegmentMerchantQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchant($this)
                ->count($con);
        }

        return count($this->collSpyAclEntitySegmentMerchants);
    }

    /**
     * Method called to associate a ChildSpyAclEntitySegmentMerchant object to this object
     * through the ChildSpyAclEntitySegmentMerchant foreign key attribute.
     *
     * @param ChildSpyAclEntitySegmentMerchant $l ChildSpyAclEntitySegmentMerchant
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclEntitySegmentMerchant(ChildSpyAclEntitySegmentMerchant $l)
    {
        if ($this->collSpyAclEntitySegmentMerchants === null) {
            $this->initSpyAclEntitySegmentMerchants();
            $this->collSpyAclEntitySegmentMerchantsPartial = true;
        }

        if (!$this->collSpyAclEntitySegmentMerchants->contains($l)) {
            $this->doAddSpyAclEntitySegmentMerchant($l);

            if ($this->spyAclEntitySegmentMerchantsScheduledForDeletion and $this->spyAclEntitySegmentMerchantsScheduledForDeletion->contains($l)) {
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion->remove($this->spyAclEntitySegmentMerchantsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant The ChildSpyAclEntitySegmentMerchant object to add.
     */
    protected function doAddSpyAclEntitySegmentMerchant(ChildSpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant): void
    {
        $this->collSpyAclEntitySegmentMerchants[]= $spyAclEntitySegmentMerchant;
        $spyAclEntitySegmentMerchant->setSpyMerchant($this);
    }

    /**
     * @param ChildSpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant The ChildSpyAclEntitySegmentMerchant object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclEntitySegmentMerchant(ChildSpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant)
    {
        if ($this->getSpyAclEntitySegmentMerchants()->contains($spyAclEntitySegmentMerchant)) {
            $pos = $this->collSpyAclEntitySegmentMerchants->search($spyAclEntitySegmentMerchant);
            $this->collSpyAclEntitySegmentMerchants->remove($pos);
            if (null === $this->spyAclEntitySegmentMerchantsScheduledForDeletion) {
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion = clone $this->collSpyAclEntitySegmentMerchants;
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion->clear();
            }
            $this->spyAclEntitySegmentMerchantsScheduledForDeletion[]= clone $spyAclEntitySegmentMerchant;
            $spyAclEntitySegmentMerchant->setSpyMerchant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchant is new, it will return
     * an empty collection; or if this SpyMerchant has previously
     * been saved, it will retrieve related SpyAclEntitySegmentMerchants from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyAclEntitySegmentMerchant[] List of ChildSpyAclEntitySegmentMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclEntitySegmentMerchant}> List of ChildSpyAclEntitySegmentMerchant objects
     */
    public function getSpyAclEntitySegmentMerchantsJoinSpyAclEntitySegment(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyAclEntitySegmentMerchantQuery::create(null, $criteria);
        $query->joinWith('SpyAclEntitySegment', $joinBehavior);

        return $this->getSpyAclEntitySegmentMerchants($query, $con);
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
        if (null !== $this->aSpyStateMachineProcess) {
            $this->aSpyStateMachineProcess->removeSpyMerchant($this);
        }
        $this->id_merchant = null;
        $this->fk_state_machine_process = null;
        $this->default_product_abstract_approval_status = null;
        $this->email = null;
        $this->is_active = null;
        $this->is_open_for_relation_request = null;
        $this->merchant_reference = null;
        $this->name = null;
        $this->registration_number = null;
        $this->status = null;
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
            if ($this->collPyzMerchantToSuppliers) {
                foreach ($this->collPyzMerchantToSuppliers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantStores) {
                foreach ($this->collSpyMerchantStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantAppOnboardingStatuses) {
                foreach ($this->collSpyMerchantAppOnboardingStatuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantCategories) {
                foreach ($this->collSpyMerchantCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMerchantCommissions) {
                foreach ($this->collMerchantCommissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantOpeningHoursWeekdaySchedules) {
                foreach ($this->collSpyMerchantOpeningHoursWeekdaySchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantOpeningHoursDateSchedules) {
                foreach ($this->collSpyMerchantOpeningHoursDateSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantProductAbstracts) {
                foreach ($this->collSpyMerchantProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantProfiles) {
                foreach ($this->collSpyMerchantProfiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationRequests) {
                foreach ($this->collSpyMerchantRelationRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationships) {
                foreach ($this->collSpyMerchantRelationships as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantStocks) {
                foreach ($this->collSpyMerchantStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantUsers) {
                foreach ($this->collSpyMerchantUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOffers) {
                foreach ($this->collProductOffers as $o) {
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
            if ($this->collSpyUrls) {
                foreach ($this->collSpyUrls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclEntitySegmentMerchants) {
                foreach ($this->collSpyAclEntitySegmentMerchants as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPyzMerchantToSuppliers = null;
        $this->collSpyMerchantStores = null;
        $this->collSpyMerchantAppOnboardingStatuses = null;
        $this->collSpyMerchantCategories = null;
        $this->collMerchantCommissions = null;
        $this->collSpyMerchantOpeningHoursWeekdaySchedules = null;
        $this->collSpyMerchantOpeningHoursDateSchedules = null;
        $this->collSpyMerchantProductAbstracts = null;
        $this->collSpyMerchantProfiles = null;
        $this->collSpyMerchantRelationRequests = null;
        $this->collSpyMerchantRelationships = null;
        $this->collSpyMerchantStocks = null;
        $this->collSpyMerchantUsers = null;
        $this->collProductOffers = null;
        $this->collSpySalesPaymentMerchantPayouts = null;
        $this->collSpySalesPaymentMerchantPayoutReversals = null;
        $this->collSpyUrls = null;
        $this->collSpyAclEntitySegmentMerchants = null;
        $this->aSpyStateMachineProcess = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_merchant.create';
        } else {
            $this->_eventName = 'Entity.spy_merchant.update';
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

        if ($this->_eventName !== 'Entity.spy_merchant.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_merchant',
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
            'name' => 'spy_merchant',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_merchant.delete',
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
        $eventColumns = [
                'spy_merchant.name' => [
                    'column' => 'name',
                ],
                'spy_merchant.is_active' => [
                    'column' => 'is_active',
                ],
        ];

        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (isset($eventColumns[$modifiedColumn])) {

                if (!isset($eventColumns[$modifiedColumn]['value'])) {
                    return true;
                }

                $xmlValue = $eventColumns[$modifiedColumn]['value'];
                $xmlValue = $this->getPhpType($xmlValue, $modifiedColumn);
                $xmlOperator = '';
                if (isset($eventColumns[$modifiedColumn]['operator'])) {
                    $xmlOperator = $eventColumns[$modifiedColumn]['operator'];
                }
                $before = $this->_initialValues[$modifiedColumn];
                $field = str_replace('spy_merchant.', '', $modifiedColumn);
                $after = $this->$field;

                if ($before === null && $after !== null) {
                    return true;
                }

                if ($before !== null && $after === null) {
                    return true;
                }

                switch ($xmlOperator) {
                    case '<':
                        $result = ($before < $xmlValue xor $after < $xmlValue);
                        break;
                    case '>':
                        $result = ($before > $xmlValue xor $after > $xmlValue);
                        break;
                    case '<=':
                        $result = ($before <= $xmlValue xor $after <= $xmlValue);
                        break;
                    case '>=':
                        $result = ($before >= $xmlValue xor $after >= $xmlValue);
                        break;
                    case '<>':
                        $result = ($before <> $xmlValue xor $after <> $xmlValue);
                        break;
                    case '!=':
                        $result = ($before != $xmlValue xor $after != $xmlValue);
                        break;
                    case '==':
                        $result = ($before == $xmlValue xor $after == $xmlValue);
                        break;
                    case '!==':
                        $result = ($before !== $xmlValue xor $after !== $xmlValue);
                        break;
                    default:
                        $result = ($before === $xmlValue xor $after === $xmlValue);
                }

                if ($result) {
                    return true;
                }
            }
        }

        return false;
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
            $field = str_replace('spy_merchant.', '', $modifiedColumn);
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
            $field = str_replace('spy_merchant.', '', $additionalValueColumnName);
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
        $columnType = SpyMerchantTableMap::getTableMap()->getColumn($column)->getType();
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
