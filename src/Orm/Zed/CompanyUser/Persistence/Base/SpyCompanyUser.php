<?php

namespace Orm\Zed\CompanyUser\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery;
use Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRoleToCompanyUser as BaseSpyCompanyRoleToCompanyUser;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToCompanyUserTableMap;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery;
use Orm\Zed\CompanyUserInvitation\Persistence\Base\SpyCompanyUserInvitation as BaseSpyCompanyUserInvitation;
use Orm\Zed\CompanyUserInvitation\Persistence\Map\SpyCompanyUserInvitationTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser as ChildSpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery as ChildSpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequest as BaseSpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery;
use Orm\Zed\QuoteApproval\Persistence\Base\SpyQuoteApproval as BaseSpyQuoteApproval;
use Orm\Zed\QuoteApproval\Persistence\Map\SpyQuoteApprovalTableMap;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery;
use Orm\Zed\QuoteRequest\Persistence\Base\SpyQuoteRequest as BaseSpyQuoteRequest;
use Orm\Zed\QuoteRequest\Persistence\Map\SpyQuoteRequestTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpyCompanyUserFile as BaseSpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquiry as BaseSpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpyCompanyUserFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryTableMap;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery;
use Orm\Zed\SharedCart\Persistence\Base\SpyQuoteCompanyUser as BaseSpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuoteCompanyUserTableMap;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery;
use Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListCompanyBusinessUnitBlacklist as BaseSpyShoppingListCompanyBusinessUnitBlacklist;
use Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListCompanyUser as BaseSpyShoppingListCompanyUser;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyBusinessUnitBlacklistTableMap;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyUserTableMap;
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
 * Base class that represents a row from the 'spy_company_user' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CompanyUser.Persistence.Base
 */
abstract class SpyCompanyUser implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CompanyUser\\Persistence\\Map\\SpyCompanyUserTableMap';


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
     * The value for the id_company_user field.
     *
     * @var        int
     */
    protected $id_company_user;

    /**
     * The value for the fk_company field.
     *
     * @var        int
     */
    protected $fk_company;

    /**
     * The value for the fk_company_business_unit field.
     *
     * @var        int|null
     */
    protected $fk_company_business_unit;

    /**
     * The value for the fk_customer field.
     *
     * @var        int
     */
    protected $fk_customer;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the is_default field.
     * A flag indicating if an entity is the default one.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_default;

    /**
     * The value for the key field.
     * Key is an identifier for existing entities. This should never be changed.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        SpyCompanyBusinessUnit
     */
    protected $aCompanyBusinessUnit;

    /**
     * @var        SpyCompany
     */
    protected $aCompany;

    /**
     * @var        SpyCustomer
     */
    protected $aCustomer;

    /**
     * @var        ObjectCollection|SpyCompanyUserFile[] Collection to store aggregation of SpyCompanyUserFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserFile> Collection to store aggregation of SpyCompanyUserFile objects.
     */
    protected $collSpyCompanyUserFiles;
    protected $collSpyCompanyUserFilesPartial;

    /**
     * @var        ObjectCollection|SpyCompanyRoleToCompanyUser[] Collection to store aggregation of SpyCompanyRoleToCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRoleToCompanyUser> Collection to store aggregation of SpyCompanyRoleToCompanyUser objects.
     */
    protected $collSpyCompanyRoleToCompanyUsers;
    protected $collSpyCompanyRoleToCompanyUsersPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUserInvitation[] Collection to store aggregation of SpyCompanyUserInvitation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserInvitation> Collection to store aggregation of SpyCompanyUserInvitation objects.
     */
    protected $collSpyCompanyUserInvitations;
    protected $collSpyCompanyUserInvitationsPartial;

    /**
     * @var        ObjectCollection|SpyQuoteCompanyUser[] Collection to store aggregation of SpyQuoteCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteCompanyUser> Collection to store aggregation of SpyQuoteCompanyUser objects.
     */
    protected $collSpyQuoteCompanyUsers;
    protected $collSpyQuoteCompanyUsersPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationRequest[] Collection to store aggregation of SpyMerchantRelationRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest> Collection to store aggregation of SpyMerchantRelationRequest objects.
     */
    protected $collSpyMerchantRelationRequests;
    protected $collSpyMerchantRelationRequestsPartial;

    /**
     * @var        ObjectCollection|SpyQuoteApproval[] Collection to store aggregation of SpyQuoteApproval objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteApproval> Collection to store aggregation of SpyQuoteApproval objects.
     */
    protected $collSpyQuoteApprovals;
    protected $collSpyQuoteApprovalsPartial;

    /**
     * @var        ObjectCollection|SpyQuoteRequest[] Collection to store aggregation of SpyQuoteRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteRequest> Collection to store aggregation of SpyQuoteRequest objects.
     */
    protected $collSpyQuoteRequests;
    protected $collSpyQuoteRequestsPartial;

    /**
     * @var        ObjectCollection|SpySspInquiry[] Collection to store aggregation of SpySspInquiry objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiry> Collection to store aggregation of SpySspInquiry objects.
     */
    protected $collSpySspInquiries;
    protected $collSpySspInquiriesPartial;

    /**
     * @var        ObjectCollection|SpyShoppingListCompanyUser[] Collection to store aggregation of SpyShoppingListCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyUser> Collection to store aggregation of SpyShoppingListCompanyUser objects.
     */
    protected $collSpyShoppingListCompanyUsers;
    protected $collSpyShoppingListCompanyUsersPartial;

    /**
     * @var        ObjectCollection|SpyShoppingListCompanyBusinessUnitBlacklist[] Collection to store aggregation of SpyShoppingListCompanyBusinessUnitBlacklist objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnitBlacklist> Collection to store aggregation of SpyShoppingListCompanyBusinessUnitBlacklist objects.
     */
    protected $collSpyShoppingListCompanyBusinessUnitBlacklists;
    protected $collSpyShoppingListCompanyBusinessUnitBlacklistsPartial;

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
        'spy_company_user.fk_company_business_unit' => 'fk_company_business_unit',
        'spy_company_user.fk_company' => 'fk_company',
        'spy_company_user.fk_customer' => 'fk_customer',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUserFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserFile>
     */
    protected $spyCompanyUserFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyRoleToCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRoleToCompanyUser>
     */
    protected $spyCompanyRoleToCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUserInvitation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserInvitation>
     */
    protected $spyCompanyUserInvitationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuoteCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteCompanyUser>
     */
    protected $spyQuoteCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest>
     */
    protected $spyMerchantRelationRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuoteApproval[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteApproval>
     */
    protected $spyQuoteApprovalsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuoteRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteRequest>
     */
    protected $spyQuoteRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspInquiry[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiry>
     */
    protected $spySspInquiriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyUser>
     */
    protected $spyShoppingListCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListCompanyBusinessUnitBlacklist[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnitBlacklist>
     */
    protected $spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
        $this->is_default = false;
    }

    /**
     * Initializes internal state of Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUser object.
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
     * Compares this with another <code>SpyCompanyUser</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCompanyUser</code>, delegates to
     * <code>equals(SpyCompanyUser)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_company_user] column value.
     *
     * @return int
     */
    public function getIdCompanyUser()
    {
        return $this->id_company_user;
    }

    /**
     * Get the [fk_company] column value.
     *
     * @return int
     */
    public function getFkCompany()
    {
        return $this->fk_company;
    }

    /**
     * Get the [fk_company_business_unit] column value.
     *
     * @return int|null
     */
    public function getFkCompanyBusinessUnit()
    {
        return $this->fk_company_business_unit;
    }

    /**
     * Get the [fk_customer] column value.
     *
     * @return int
     */
    public function getFkCustomer()
    {
        return $this->fk_customer;
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
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function isDefault()
    {
        return $this->getIsDefault();
    }

    /**
     * Get the [key] column value.
     * Key is an identifier for existing entities. This should never be changed.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
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
     * Set the value of [id_company_user] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCompanyUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_company_user !== $v) {
            $this->id_company_user = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_ID_COMPANY_USER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCompany($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_company !== $v) {
            $this->fk_company = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_FK_COMPANY] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getIdCompany() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company_business_unit] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCompanyBusinessUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_company_business_unit !== $v) {
            $this->fk_company_business_unit = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT] = true;
        }

        if ($this->aCompanyBusinessUnit !== null && $this->aCompanyBusinessUnit->getIdCompanyBusinessUnit() !== $v) {
            $this->aCompanyBusinessUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_customer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_customer !== $v) {
            $this->fk_customer = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_FK_CUSTOMER] = true;
        }

        if ($this->aCustomer !== null && $this->aCustomer->getIdCustomer() !== $v) {
            $this->aCustomer = null;
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
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_default] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an entity is the default one.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDefault($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_IS_DEFAULT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Key is an identifier for existing entities. This should never be changed.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->key !== $v) {
            $this->key = $v;
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyCompanyUserTableMap::COL_UUID] = true;
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

            if ($this->is_default !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCompanyUserTableMap::translateFieldName('IdCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCompanyUserTableMap::translateFieldName('FkCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCompanyUserTableMap::translateFieldName('FkCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCompanyUserTableMap::translateFieldName('FkCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_customer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCompanyUserTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCompanyUserTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCompanyUserTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCompanyUserTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpyCompanyUserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser'), 0, $e);
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
        if ($this->aCompany !== null && $this->fk_company !== $this->aCompany->getIdCompany()) {
            $this->aCompany = null;
        }
        if ($this->aCompanyBusinessUnit !== null && $this->fk_company_business_unit !== $this->aCompanyBusinessUnit->getIdCompanyBusinessUnit()) {
            $this->aCompanyBusinessUnit = null;
        }
        if ($this->aCustomer !== null && $this->fk_customer !== $this->aCustomer->getIdCustomer()) {
            $this->aCustomer = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCompanyUserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCompanyUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompanyBusinessUnit = null;
            $this->aCompany = null;
            $this->aCustomer = null;
            $this->collSpyCompanyUserFiles = null;

            $this->collSpyCompanyRoleToCompanyUsers = null;

            $this->collSpyCompanyUserInvitations = null;

            $this->collSpyQuoteCompanyUsers = null;

            $this->collSpyMerchantRelationRequests = null;

            $this->collSpyQuoteApprovals = null;

            $this->collSpyQuoteRequests = null;

            $this->collSpySspInquiries = null;

            $this->collSpyShoppingListCompanyUsers = null;

            $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCompanyUser::setDeleted()
     * @see SpyCompanyUser::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCompanyUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserTableMap::DATABASE_NAME);
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyCompanyUserTableMap::addInstanceToPool($this);
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

            if ($this->aCompanyBusinessUnit !== null) {
                if ($this->aCompanyBusinessUnit->isModified() || $this->aCompanyBusinessUnit->isNew()) {
                    $affectedRows += $this->aCompanyBusinessUnit->save($con);
                }
                $this->setCompanyBusinessUnit($this->aCompanyBusinessUnit);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aCustomer !== null) {
                if ($this->aCustomer->isModified() || $this->aCustomer->isNew()) {
                    $affectedRows += $this->aCustomer->save($con);
                }
                $this->setCustomer($this->aCustomer);
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

            if ($this->spyCompanyUserFilesScheduledForDeletion !== null) {
                if (!$this->spyCompanyUserFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUserFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUserFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUserFiles !== null) {
                foreach ($this->collSpyCompanyUserFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyRoleToCompanyUsersScheduledForDeletion !== null) {
                if (!$this->spyCompanyRoleToCompanyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyRoleToCompanyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyRoleToCompanyUsers !== null) {
                foreach ($this->collSpyCompanyRoleToCompanyUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyUserInvitationsScheduledForDeletion !== null) {
                if (!$this->spyCompanyUserInvitationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUserInvitationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUserInvitationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUserInvitations !== null) {
                foreach ($this->collSpyCompanyUserInvitations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyQuoteCompanyUsersScheduledForDeletion !== null) {
                if (!$this->spyQuoteCompanyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->spyQuoteCompanyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuoteCompanyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuoteCompanyUsers !== null) {
                foreach ($this->collSpyQuoteCompanyUsers as $referrerFK) {
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

            if ($this->spyQuoteApprovalsScheduledForDeletion !== null) {
                if (!$this->spyQuoteApprovalsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery::create()
                        ->filterByPrimaryKeys($this->spyQuoteApprovalsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuoteApprovalsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuoteApprovals !== null) {
                foreach ($this->collSpyQuoteApprovals as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyQuoteRequestsScheduledForDeletion !== null) {
                if (!$this->spyQuoteRequestsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery::create()
                        ->filterByPrimaryKeys($this->spyQuoteRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuoteRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuoteRequests !== null) {
                foreach ($this->collSpyQuoteRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquiriesScheduledForDeletion !== null) {
                if (!$this->spySspInquiriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySspInquiriesScheduledForDeletion as $spySspInquiry) {
                        // need to save related object because we set the relation to null
                        $spySspInquiry->save($con);
                    }
                    $this->spySspInquiriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquiries !== null) {
                foreach ($this->collSpySspInquiries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListCompanyUsersScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListCompanyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListCompanyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyUsers !== null) {
                foreach ($this->collSpyShoppingListCompanyUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists !== null) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $referrerFK) {
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

        $this->modifiedColumns[SpyCompanyUserTableMap::COL_ID_COMPANY_USER] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_ID_COMPANY_USER)) {
            $modifiedColumns[':p' . $index++]  = '`id_company_user`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_company`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_company_business_unit`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = '`fk_customer`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`is_default`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_company_user` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_company_user`':
                        $stmt->bindValue($identifier, $this->id_company_user, PDO::PARAM_INT);

                        break;
                    case '`fk_company`':
                        $stmt->bindValue($identifier, $this->fk_company, PDO::PARAM_INT);

                        break;
                    case '`fk_company_business_unit`':
                        $stmt->bindValue($identifier, $this->fk_company_business_unit, PDO::PARAM_INT);

                        break;
                    case '`fk_customer`':
                        $stmt->bindValue($identifier, $this->fk_customer, PDO::PARAM_INT);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`is_default`':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_company_user_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdCompanyUser($pk);
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
        $pos = SpyCompanyUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCompanyUser();

            case 1:
                return $this->getFkCompany();

            case 2:
                return $this->getFkCompanyBusinessUnit();

            case 3:
                return $this->getFkCustomer();

            case 4:
                return $this->getIsActive();

            case 5:
                return $this->getIsDefault();

            case 6:
                return $this->getKey();

            case 7:
                return $this->getUuid();

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
        if (isset($alreadyDumpedObjects['SpyCompanyUser'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCompanyUser'][$this->hashCode()] = true;
        $keys = SpyCompanyUserTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCompanyUser(),
            $keys[1] => $this->getFkCompany(),
            $keys[2] => $this->getFkCompanyBusinessUnit(),
            $keys[3] => $this->getFkCustomer(),
            $keys[4] => $this->getIsActive(),
            $keys[5] => $this->getIsDefault(),
            $keys[6] => $this->getKey(),
            $keys[7] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompanyBusinessUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_unit';
                        break;
                    default:
                        $key = 'CompanyBusinessUnit';
                }

                $result[$key] = $this->aCompanyBusinessUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompany';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCustomer) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomer';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer';
                        break;
                    default:
                        $key = 'Customer';
                }

                $result[$key] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCompanyUserFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUserFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_user_files';
                        break;
                    default:
                        $key = 'SpyCompanyUserFiles';
                }

                $result[$key] = $this->collSpyCompanyUserFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyRoleToCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyRoleToCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_role_to_company_users';
                        break;
                    default:
                        $key = 'SpyCompanyRoleToCompanyUsers';
                }

                $result[$key] = $this->collSpyCompanyRoleToCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyUserInvitations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUserInvitations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_user_invitations';
                        break;
                    default:
                        $key = 'SpyCompanyUserInvitations';
                }

                $result[$key] = $this->collSpyCompanyUserInvitations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyQuoteCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuoteCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quote_company_users';
                        break;
                    default:
                        $key = 'SpyQuoteCompanyUsers';
                }

                $result[$key] = $this->collSpyQuoteCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyQuoteApprovals) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuoteApprovals';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quote_approvals';
                        break;
                    default:
                        $key = 'SpyQuoteApprovals';
                }

                $result[$key] = $this->collSpyQuoteApprovals->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyQuoteRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuoteRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quote_requests';
                        break;
                    default:
                        $key = 'SpyQuoteRequests';
                }

                $result[$key] = $this->collSpyQuoteRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquiries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquiries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiries';
                        break;
                    default:
                        $key = 'SpySspInquiries';
                }

                $result[$key] = $this->collSpySspInquiries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_users';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyUsers';
                }

                $result[$key] = $this->collSpyShoppingListCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyBusinessUnitBlacklists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_business_unit_blacklists';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyBusinessUnitBlacklists';
                }

                $result[$key] = $this->collSpyShoppingListCompanyBusinessUnitBlacklists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCompanyUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCompanyUser($value);
                break;
            case 1:
                $this->setFkCompany($value);
                break;
            case 2:
                $this->setFkCompanyBusinessUnit($value);
                break;
            case 3:
                $this->setFkCustomer($value);
                break;
            case 4:
                $this->setIsActive($value);
                break;
            case 5:
                $this->setIsDefault($value);
                break;
            case 6:
                $this->setKey($value);
                break;
            case 7:
                $this->setUuid($value);
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
        $keys = SpyCompanyUserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCompanyUser($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompany($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCompanyBusinessUnit($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkCustomer($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsActive($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsDefault($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setKey($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUuid($arr[$keys[7]]);
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
        $criteria = new Criteria(SpyCompanyUserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_ID_COMPANY_USER)) {
            $criteria->add(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $this->id_company_user);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_COMPANY)) {
            $criteria->add(SpyCompanyUserTableMap::COL_FK_COMPANY, $this->fk_company);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $this->fk_company_business_unit);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_FK_CUSTOMER)) {
            $criteria->add(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $this->fk_customer);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyCompanyUserTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SpyCompanyUserTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_KEY)) {
            $criteria->add(SpyCompanyUserTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCompanyUserTableMap::COL_UUID)) {
            $criteria->add(SpyCompanyUserTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyCompanyUserQuery::create();
        $criteria->add(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $this->id_company_user);

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
        $validPk = null !== $this->getIdCompanyUser();

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
        return $this->getIdCompanyUser();
    }

    /**
     * Generic method to set the primary key (id_company_user column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCompanyUser($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCompanyUser();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompany($this->getFkCompany());
        $copyObj->setFkCompanyBusinessUnit($this->getFkCompanyBusinessUnit());
        $copyObj->setFkCustomer($this->getFkCustomer());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setKey($this->getKey());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyUserFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUserFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyRoleToCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyRoleToCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyUserInvitations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUserInvitation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuoteCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuoteApprovals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteApproval($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuoteRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquiries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquiry($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListCompanyBusinessUnitBlacklists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyBusinessUnitBlacklist($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCompanyUser(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser Clone of current object.
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
     * Declares an association between this object and a SpyCompanyBusinessUnit object.
     *
     * @param SpyCompanyBusinessUnit|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompanyBusinessUnit(SpyCompanyBusinessUnit $v = null)
    {
        if ($v === null) {
            $this->setFkCompanyBusinessUnit(NULL);
        } else {
            $this->setFkCompanyBusinessUnit($v->getIdCompanyBusinessUnit());
        }

        $this->aCompanyBusinessUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompanyBusinessUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUser($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompanyBusinessUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompanyBusinessUnit|null The associated SpyCompanyBusinessUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyBusinessUnit(?ConnectionInterface $con = null)
    {
        if ($this->aCompanyBusinessUnit === null && ($this->fk_company_business_unit != 0)) {
            $this->aCompanyBusinessUnit = SpyCompanyBusinessUnitQuery::create()->findPk($this->fk_company_business_unit, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyBusinessUnit->addCompanyUsers($this);
             */
        }

        return $this->aCompanyBusinessUnit;
    }

    /**
     * Declares an association between this object and a SpyCompany object.
     *
     * @param SpyCompany $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(SpyCompany $v = null)
    {
        if ($v === null) {
            $this->setFkCompany(NULL);
        } else {
            $this->setFkCompany($v->getIdCompany());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUser($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompany The associated SpyCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->fk_company != 0)) {
            $this->aCompany = SpyCompanyQuery::create()->findPk($this->fk_company, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addCompanyUsers($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a SpyCustomer object.
     *
     * @param SpyCustomer $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCustomer(SpyCustomer $v = null)
    {
        if ($v === null) {
            $this->setFkCustomer(NULL);
        } else {
            $this->setFkCustomer($v->getIdCustomer());
        }

        $this->aCustomer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCustomer object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUser($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCustomer object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCustomer The associated SpyCustomer object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomer(?ConnectionInterface $con = null)
    {
        if ($this->aCustomer === null && ($this->fk_customer != 0)) {
            $this->aCustomer = SpyCustomerQuery::create()->findPk($this->fk_customer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCustomer->addCompanyUsers($this);
             */
        }

        return $this->aCustomer;
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
        if ('SpyCompanyUserFile' === $relationName) {
            $this->initSpyCompanyUserFiles();
            return;
        }
        if ('SpyCompanyRoleToCompanyUser' === $relationName) {
            $this->initSpyCompanyRoleToCompanyUsers();
            return;
        }
        if ('SpyCompanyUserInvitation' === $relationName) {
            $this->initSpyCompanyUserInvitations();
            return;
        }
        if ('SpyQuoteCompanyUser' === $relationName) {
            $this->initSpyQuoteCompanyUsers();
            return;
        }
        if ('SpyMerchantRelationRequest' === $relationName) {
            $this->initSpyMerchantRelationRequests();
            return;
        }
        if ('SpyQuoteApproval' === $relationName) {
            $this->initSpyQuoteApprovals();
            return;
        }
        if ('SpyQuoteRequest' === $relationName) {
            $this->initSpyQuoteRequests();
            return;
        }
        if ('SpySspInquiry' === $relationName) {
            $this->initSpySspInquiries();
            return;
        }
        if ('SpyShoppingListCompanyUser' === $relationName) {
            $this->initSpyShoppingListCompanyUsers();
            return;
        }
        if ('SpyShoppingListCompanyBusinessUnitBlacklist' === $relationName) {
            $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
            return;
        }
    }

    /**
     * Clears out the collSpyCompanyUserFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUserFiles()
     */
    public function clearSpyCompanyUserFiles()
    {
        $this->collSpyCompanyUserFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUserFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUserFiles($v = true): void
    {
        $this->collSpyCompanyUserFilesPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUserFiles collection.
     *
     * By default this just sets the collSpyCompanyUserFiles collection to an empty array (like clearcollSpyCompanyUserFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUserFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUserFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUserFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUserFiles = new $collectionClassName;
        $this->collSpyCompanyUserFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile');
    }

    /**
     * Gets an array of SpyCompanyUserFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUserFile[] List of SpyCompanyUserFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserFile> List of SpyCompanyUserFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUserFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUserFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUserFiles) {
                    $this->initSpyCompanyUserFiles();
                } else {
                    $collectionClassName = SpyCompanyUserFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUserFiles = new $collectionClassName;
                    $collSpyCompanyUserFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile');

                    return $collSpyCompanyUserFiles;
                }
            } else {
                $collSpyCompanyUserFiles = SpyCompanyUserFileQuery::create(null, $criteria)
                    ->filterByCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUserFilesPartial && count($collSpyCompanyUserFiles)) {
                        $this->initSpyCompanyUserFiles(false);

                        foreach ($collSpyCompanyUserFiles as $obj) {
                            if (false == $this->collSpyCompanyUserFiles->contains($obj)) {
                                $this->collSpyCompanyUserFiles->append($obj);
                            }
                        }

                        $this->collSpyCompanyUserFilesPartial = true;
                    }

                    return $collSpyCompanyUserFiles;
                }

                if ($partial && $this->collSpyCompanyUserFiles) {
                    foreach ($this->collSpyCompanyUserFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUserFiles[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUserFiles = $collSpyCompanyUserFiles;
                $this->collSpyCompanyUserFilesPartial = false;
            }
        }

        return $this->collSpyCompanyUserFiles;
    }

    /**
     * Sets a collection of SpyCompanyUserFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUserFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUserFiles(Collection $spyCompanyUserFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUserFile[] $spyCompanyUserFilesToDelete */
        $spyCompanyUserFilesToDelete = $this->getSpyCompanyUserFiles(new Criteria(), $con)->diff($spyCompanyUserFiles);


        $this->spyCompanyUserFilesScheduledForDeletion = $spyCompanyUserFilesToDelete;

        foreach ($spyCompanyUserFilesToDelete as $spyCompanyUserFileRemoved) {
            $spyCompanyUserFileRemoved->setCompanyUser(null);
        }

        $this->collSpyCompanyUserFiles = null;
        foreach ($spyCompanyUserFiles as $spyCompanyUserFile) {
            $this->addSpyCompanyUserFile($spyCompanyUserFile);
        }

        $this->collSpyCompanyUserFiles = $spyCompanyUserFiles;
        $this->collSpyCompanyUserFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUserFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUserFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUserFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUserFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUserFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUserFiles());
            }

            $query = SpyCompanyUserFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUserFiles);
    }

    /**
     * Method called to associate a SpyCompanyUserFile object to this object
     * through the SpyCompanyUserFile foreign key attribute.
     *
     * @param SpyCompanyUserFile $l SpyCompanyUserFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUserFile(SpyCompanyUserFile $l)
    {
        if ($this->collSpyCompanyUserFiles === null) {
            $this->initSpyCompanyUserFiles();
            $this->collSpyCompanyUserFilesPartial = true;
        }

        if (!$this->collSpyCompanyUserFiles->contains($l)) {
            $this->doAddSpyCompanyUserFile($l);

            if ($this->spyCompanyUserFilesScheduledForDeletion and $this->spyCompanyUserFilesScheduledForDeletion->contains($l)) {
                $this->spyCompanyUserFilesScheduledForDeletion->remove($this->spyCompanyUserFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUserFile $spyCompanyUserFile The SpyCompanyUserFile object to add.
     */
    protected function doAddSpyCompanyUserFile(SpyCompanyUserFile $spyCompanyUserFile): void
    {
        $this->collSpyCompanyUserFiles[]= $spyCompanyUserFile;
        $spyCompanyUserFile->setCompanyUser($this);
    }

    /**
     * @param SpyCompanyUserFile $spyCompanyUserFile The SpyCompanyUserFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUserFile(SpyCompanyUserFile $spyCompanyUserFile)
    {
        if ($this->getSpyCompanyUserFiles()->contains($spyCompanyUserFile)) {
            $pos = $this->collSpyCompanyUserFiles->search($spyCompanyUserFile);
            $this->collSpyCompanyUserFiles->remove($pos);
            if (null === $this->spyCompanyUserFilesScheduledForDeletion) {
                $this->spyCompanyUserFilesScheduledForDeletion = clone $this->collSpyCompanyUserFiles;
                $this->spyCompanyUserFilesScheduledForDeletion->clear();
            }
            $this->spyCompanyUserFilesScheduledForDeletion[]= clone $spyCompanyUserFile;
            $spyCompanyUserFile->setCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyCompanyUserFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUserFile[] List of SpyCompanyUserFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserFile}> List of SpyCompanyUserFile objects
     */
    public function getSpyCompanyUserFilesJoinFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserFileQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getSpyCompanyUserFiles($query, $con);
    }

    /**
     * Clears out the collSpyCompanyRoleToCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyRoleToCompanyUsers()
     */
    public function clearSpyCompanyRoleToCompanyUsers()
    {
        $this->collSpyCompanyRoleToCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyRoleToCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyRoleToCompanyUsers($v = true): void
    {
        $this->collSpyCompanyRoleToCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyRoleToCompanyUsers collection.
     *
     * By default this just sets the collSpyCompanyRoleToCompanyUsers collection to an empty array (like clearcollSpyCompanyRoleToCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyRoleToCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyRoleToCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyRoleToCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyRoleToCompanyUsers = new $collectionClassName;
        $this->collSpyCompanyRoleToCompanyUsers->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser');
    }

    /**
     * Gets an array of SpyCompanyRoleToCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyRoleToCompanyUser[] List of SpyCompanyRoleToCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRoleToCompanyUser> List of SpyCompanyRoleToCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyRoleToCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyRoleToCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyRoleToCompanyUsers) {
                    $this->initSpyCompanyRoleToCompanyUsers();
                } else {
                    $collectionClassName = SpyCompanyRoleToCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyRoleToCompanyUsers = new $collectionClassName;
                    $collSpyCompanyRoleToCompanyUsers->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser');

                    return $collSpyCompanyRoleToCompanyUsers;
                }
            } else {
                $collSpyCompanyRoleToCompanyUsers = SpyCompanyRoleToCompanyUserQuery::create(null, $criteria)
                    ->filterByCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyRoleToCompanyUsersPartial && count($collSpyCompanyRoleToCompanyUsers)) {
                        $this->initSpyCompanyRoleToCompanyUsers(false);

                        foreach ($collSpyCompanyRoleToCompanyUsers as $obj) {
                            if (false == $this->collSpyCompanyRoleToCompanyUsers->contains($obj)) {
                                $this->collSpyCompanyRoleToCompanyUsers->append($obj);
                            }
                        }

                        $this->collSpyCompanyRoleToCompanyUsersPartial = true;
                    }

                    return $collSpyCompanyRoleToCompanyUsers;
                }

                if ($partial && $this->collSpyCompanyRoleToCompanyUsers) {
                    foreach ($this->collSpyCompanyRoleToCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyRoleToCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyRoleToCompanyUsers = $collSpyCompanyRoleToCompanyUsers;
                $this->collSpyCompanyRoleToCompanyUsersPartial = false;
            }
        }

        return $this->collSpyCompanyRoleToCompanyUsers;
    }

    /**
     * Sets a collection of SpyCompanyRoleToCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyRoleToCompanyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyRoleToCompanyUsers(Collection $spyCompanyRoleToCompanyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyRoleToCompanyUser[] $spyCompanyRoleToCompanyUsersToDelete */
        $spyCompanyRoleToCompanyUsersToDelete = $this->getSpyCompanyRoleToCompanyUsers(new Criteria(), $con)->diff($spyCompanyRoleToCompanyUsers);


        $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = $spyCompanyRoleToCompanyUsersToDelete;

        foreach ($spyCompanyRoleToCompanyUsersToDelete as $spyCompanyRoleToCompanyUserRemoved) {
            $spyCompanyRoleToCompanyUserRemoved->setCompanyUser(null);
        }

        $this->collSpyCompanyRoleToCompanyUsers = null;
        foreach ($spyCompanyRoleToCompanyUsers as $spyCompanyRoleToCompanyUser) {
            $this->addSpyCompanyRoleToCompanyUser($spyCompanyRoleToCompanyUser);
        }

        $this->collSpyCompanyRoleToCompanyUsers = $spyCompanyRoleToCompanyUsers;
        $this->collSpyCompanyRoleToCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyRoleToCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyRoleToCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyRoleToCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyRoleToCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyRoleToCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyRoleToCompanyUsers());
            }

            $query = SpyCompanyRoleToCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyCompanyRoleToCompanyUsers);
    }

    /**
     * Method called to associate a SpyCompanyRoleToCompanyUser object to this object
     * through the SpyCompanyRoleToCompanyUser foreign key attribute.
     *
     * @param SpyCompanyRoleToCompanyUser $l SpyCompanyRoleToCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyRoleToCompanyUser(SpyCompanyRoleToCompanyUser $l)
    {
        if ($this->collSpyCompanyRoleToCompanyUsers === null) {
            $this->initSpyCompanyRoleToCompanyUsers();
            $this->collSpyCompanyRoleToCompanyUsersPartial = true;
        }

        if (!$this->collSpyCompanyRoleToCompanyUsers->contains($l)) {
            $this->doAddSpyCompanyRoleToCompanyUser($l);

            if ($this->spyCompanyRoleToCompanyUsersScheduledForDeletion and $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->contains($l)) {
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->remove($this->spyCompanyRoleToCompanyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser The SpyCompanyRoleToCompanyUser object to add.
     */
    protected function doAddSpyCompanyRoleToCompanyUser(SpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser): void
    {
        $this->collSpyCompanyRoleToCompanyUsers[]= $spyCompanyRoleToCompanyUser;
        $spyCompanyRoleToCompanyUser->setCompanyUser($this);
    }

    /**
     * @param SpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser The SpyCompanyRoleToCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyRoleToCompanyUser(SpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser)
    {
        if ($this->getSpyCompanyRoleToCompanyUsers()->contains($spyCompanyRoleToCompanyUser)) {
            $pos = $this->collSpyCompanyRoleToCompanyUsers->search($spyCompanyRoleToCompanyUser);
            $this->collSpyCompanyRoleToCompanyUsers->remove($pos);
            if (null === $this->spyCompanyRoleToCompanyUsersScheduledForDeletion) {
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = clone $this->collSpyCompanyRoleToCompanyUsers;
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyCompanyRoleToCompanyUsersScheduledForDeletion[]= clone $spyCompanyRoleToCompanyUser;
            $spyCompanyRoleToCompanyUser->setCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyCompanyRoleToCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyRoleToCompanyUser[] List of SpyCompanyRoleToCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRoleToCompanyUser}> List of SpyCompanyRoleToCompanyUser objects
     */
    public function getSpyCompanyRoleToCompanyUsersJoinCompanyRole(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyRoleToCompanyUserQuery::create(null, $criteria);
        $query->joinWith('CompanyRole', $joinBehavior);

        return $this->getSpyCompanyRoleToCompanyUsers($query, $con);
    }

    /**
     * Clears out the collSpyCompanyUserInvitations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUserInvitations()
     */
    public function clearSpyCompanyUserInvitations()
    {
        $this->collSpyCompanyUserInvitations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUserInvitations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUserInvitations($v = true): void
    {
        $this->collSpyCompanyUserInvitationsPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUserInvitations collection.
     *
     * By default this just sets the collSpyCompanyUserInvitations collection to an empty array (like clearcollSpyCompanyUserInvitations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUserInvitations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUserInvitations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUserInvitationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUserInvitations = new $collectionClassName;
        $this->collSpyCompanyUserInvitations->setModel('\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation');
    }

    /**
     * Gets an array of SpyCompanyUserInvitation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUserInvitation[] List of SpyCompanyUserInvitation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserInvitation> List of SpyCompanyUserInvitation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUserInvitations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUserInvitationsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserInvitations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUserInvitations) {
                    $this->initSpyCompanyUserInvitations();
                } else {
                    $collectionClassName = SpyCompanyUserInvitationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUserInvitations = new $collectionClassName;
                    $collSpyCompanyUserInvitations->setModel('\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation');

                    return $collSpyCompanyUserInvitations;
                }
            } else {
                $collSpyCompanyUserInvitations = SpyCompanyUserInvitationQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUserInvitationsPartial && count($collSpyCompanyUserInvitations)) {
                        $this->initSpyCompanyUserInvitations(false);

                        foreach ($collSpyCompanyUserInvitations as $obj) {
                            if (false == $this->collSpyCompanyUserInvitations->contains($obj)) {
                                $this->collSpyCompanyUserInvitations->append($obj);
                            }
                        }

                        $this->collSpyCompanyUserInvitationsPartial = true;
                    }

                    return $collSpyCompanyUserInvitations;
                }

                if ($partial && $this->collSpyCompanyUserInvitations) {
                    foreach ($this->collSpyCompanyUserInvitations as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUserInvitations[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUserInvitations = $collSpyCompanyUserInvitations;
                $this->collSpyCompanyUserInvitationsPartial = false;
            }
        }

        return $this->collSpyCompanyUserInvitations;
    }

    /**
     * Sets a collection of SpyCompanyUserInvitation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUserInvitations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUserInvitations(Collection $spyCompanyUserInvitations, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUserInvitation[] $spyCompanyUserInvitationsToDelete */
        $spyCompanyUserInvitationsToDelete = $this->getSpyCompanyUserInvitations(new Criteria(), $con)->diff($spyCompanyUserInvitations);


        $this->spyCompanyUserInvitationsScheduledForDeletion = $spyCompanyUserInvitationsToDelete;

        foreach ($spyCompanyUserInvitationsToDelete as $spyCompanyUserInvitationRemoved) {
            $spyCompanyUserInvitationRemoved->setSpyCompanyUser(null);
        }

        $this->collSpyCompanyUserInvitations = null;
        foreach ($spyCompanyUserInvitations as $spyCompanyUserInvitation) {
            $this->addSpyCompanyUserInvitation($spyCompanyUserInvitation);
        }

        $this->collSpyCompanyUserInvitations = $spyCompanyUserInvitations;
        $this->collSpyCompanyUserInvitationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUserInvitation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUserInvitation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUserInvitations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUserInvitationsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserInvitations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUserInvitations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUserInvitations());
            }

            $query = SpyCompanyUserInvitationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUserInvitations);
    }

    /**
     * Method called to associate a SpyCompanyUserInvitation object to this object
     * through the SpyCompanyUserInvitation foreign key attribute.
     *
     * @param SpyCompanyUserInvitation $l SpyCompanyUserInvitation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUserInvitation(SpyCompanyUserInvitation $l)
    {
        if ($this->collSpyCompanyUserInvitations === null) {
            $this->initSpyCompanyUserInvitations();
            $this->collSpyCompanyUserInvitationsPartial = true;
        }

        if (!$this->collSpyCompanyUserInvitations->contains($l)) {
            $this->doAddSpyCompanyUserInvitation($l);

            if ($this->spyCompanyUserInvitationsScheduledForDeletion and $this->spyCompanyUserInvitationsScheduledForDeletion->contains($l)) {
                $this->spyCompanyUserInvitationsScheduledForDeletion->remove($this->spyCompanyUserInvitationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUserInvitation $spyCompanyUserInvitation The SpyCompanyUserInvitation object to add.
     */
    protected function doAddSpyCompanyUserInvitation(SpyCompanyUserInvitation $spyCompanyUserInvitation): void
    {
        $this->collSpyCompanyUserInvitations[]= $spyCompanyUserInvitation;
        $spyCompanyUserInvitation->setSpyCompanyUser($this);
    }

    /**
     * @param SpyCompanyUserInvitation $spyCompanyUserInvitation The SpyCompanyUserInvitation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUserInvitation(SpyCompanyUserInvitation $spyCompanyUserInvitation)
    {
        if ($this->getSpyCompanyUserInvitations()->contains($spyCompanyUserInvitation)) {
            $pos = $this->collSpyCompanyUserInvitations->search($spyCompanyUserInvitation);
            $this->collSpyCompanyUserInvitations->remove($pos);
            if (null === $this->spyCompanyUserInvitationsScheduledForDeletion) {
                $this->spyCompanyUserInvitationsScheduledForDeletion = clone $this->collSpyCompanyUserInvitations;
                $this->spyCompanyUserInvitationsScheduledForDeletion->clear();
            }
            $this->spyCompanyUserInvitationsScheduledForDeletion[]= clone $spyCompanyUserInvitation;
            $spyCompanyUserInvitation->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyCompanyUserInvitations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUserInvitation[] List of SpyCompanyUserInvitation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserInvitation}> List of SpyCompanyUserInvitation objects
     */
    public function getSpyCompanyUserInvitationsJoinSpyCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserInvitationQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyBusinessUnit', $joinBehavior);

        return $this->getSpyCompanyUserInvitations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyCompanyUserInvitations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUserInvitation[] List of SpyCompanyUserInvitation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserInvitation}> List of SpyCompanyUserInvitation objects
     */
    public function getSpyCompanyUserInvitationsJoinSpyCompanyUserInvitationStatus(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserInvitationQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUserInvitationStatus', $joinBehavior);

        return $this->getSpyCompanyUserInvitations($query, $con);
    }

    /**
     * Clears out the collSpyQuoteCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuoteCompanyUsers()
     */
    public function clearSpyQuoteCompanyUsers()
    {
        $this->collSpyQuoteCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuoteCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuoteCompanyUsers($v = true): void
    {
        $this->collSpyQuoteCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyQuoteCompanyUsers collection.
     *
     * By default this just sets the collSpyQuoteCompanyUsers collection to an empty array (like clearcollSpyQuoteCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuoteCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuoteCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuoteCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuoteCompanyUsers = new $collectionClassName;
        $this->collSpyQuoteCompanyUsers->setModel('\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser');
    }

    /**
     * Gets an array of SpyQuoteCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyQuoteCompanyUser[] List of SpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteCompanyUser> List of SpyQuoteCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuoteCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuoteCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyQuoteCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuoteCompanyUsers) {
                    $this->initSpyQuoteCompanyUsers();
                } else {
                    $collectionClassName = SpyQuoteCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuoteCompanyUsers = new $collectionClassName;
                    $collSpyQuoteCompanyUsers->setModel('\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser');

                    return $collSpyQuoteCompanyUsers;
                }
            } else {
                $collSpyQuoteCompanyUsers = SpyQuoteCompanyUserQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuoteCompanyUsersPartial && count($collSpyQuoteCompanyUsers)) {
                        $this->initSpyQuoteCompanyUsers(false);

                        foreach ($collSpyQuoteCompanyUsers as $obj) {
                            if (false == $this->collSpyQuoteCompanyUsers->contains($obj)) {
                                $this->collSpyQuoteCompanyUsers->append($obj);
                            }
                        }

                        $this->collSpyQuoteCompanyUsersPartial = true;
                    }

                    return $collSpyQuoteCompanyUsers;
                }

                if ($partial && $this->collSpyQuoteCompanyUsers) {
                    foreach ($this->collSpyQuoteCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuoteCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyQuoteCompanyUsers = $collSpyQuoteCompanyUsers;
                $this->collSpyQuoteCompanyUsersPartial = false;
            }
        }

        return $this->collSpyQuoteCompanyUsers;
    }

    /**
     * Sets a collection of SpyQuoteCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuoteCompanyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuoteCompanyUsers(Collection $spyQuoteCompanyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyQuoteCompanyUser[] $spyQuoteCompanyUsersToDelete */
        $spyQuoteCompanyUsersToDelete = $this->getSpyQuoteCompanyUsers(new Criteria(), $con)->diff($spyQuoteCompanyUsers);


        $this->spyQuoteCompanyUsersScheduledForDeletion = $spyQuoteCompanyUsersToDelete;

        foreach ($spyQuoteCompanyUsersToDelete as $spyQuoteCompanyUserRemoved) {
            $spyQuoteCompanyUserRemoved->setSpyCompanyUser(null);
        }

        $this->collSpyQuoteCompanyUsers = null;
        foreach ($spyQuoteCompanyUsers as $spyQuoteCompanyUser) {
            $this->addSpyQuoteCompanyUser($spyQuoteCompanyUser);
        }

        $this->collSpyQuoteCompanyUsers = $spyQuoteCompanyUsers;
        $this->collSpyQuoteCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyQuoteCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyQuoteCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuoteCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuoteCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyQuoteCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuoteCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuoteCompanyUsers());
            }

            $query = SpyQuoteCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyQuoteCompanyUsers);
    }

    /**
     * Method called to associate a SpyQuoteCompanyUser object to this object
     * through the SpyQuoteCompanyUser foreign key attribute.
     *
     * @param SpyQuoteCompanyUser $l SpyQuoteCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuoteCompanyUser(SpyQuoteCompanyUser $l)
    {
        if ($this->collSpyQuoteCompanyUsers === null) {
            $this->initSpyQuoteCompanyUsers();
            $this->collSpyQuoteCompanyUsersPartial = true;
        }

        if (!$this->collSpyQuoteCompanyUsers->contains($l)) {
            $this->doAddSpyQuoteCompanyUser($l);

            if ($this->spyQuoteCompanyUsersScheduledForDeletion and $this->spyQuoteCompanyUsersScheduledForDeletion->contains($l)) {
                $this->spyQuoteCompanyUsersScheduledForDeletion->remove($this->spyQuoteCompanyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyQuoteCompanyUser $spyQuoteCompanyUser The SpyQuoteCompanyUser object to add.
     */
    protected function doAddSpyQuoteCompanyUser(SpyQuoteCompanyUser $spyQuoteCompanyUser): void
    {
        $this->collSpyQuoteCompanyUsers[]= $spyQuoteCompanyUser;
        $spyQuoteCompanyUser->setSpyCompanyUser($this);
    }

    /**
     * @param SpyQuoteCompanyUser $spyQuoteCompanyUser The SpyQuoteCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuoteCompanyUser(SpyQuoteCompanyUser $spyQuoteCompanyUser)
    {
        if ($this->getSpyQuoteCompanyUsers()->contains($spyQuoteCompanyUser)) {
            $pos = $this->collSpyQuoteCompanyUsers->search($spyQuoteCompanyUser);
            $this->collSpyQuoteCompanyUsers->remove($pos);
            if (null === $this->spyQuoteCompanyUsersScheduledForDeletion) {
                $this->spyQuoteCompanyUsersScheduledForDeletion = clone $this->collSpyQuoteCompanyUsers;
                $this->spyQuoteCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyQuoteCompanyUsersScheduledForDeletion[]= clone $spyQuoteCompanyUser;
            $spyQuoteCompanyUser->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuoteCompanyUser[] List of SpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteCompanyUser}> List of SpyQuoteCompanyUser objects
     */
    public function getSpyQuoteCompanyUsersJoinSpyQuote(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuoteCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyQuote', $joinBehavior);

        return $this->getSpyQuoteCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuoteCompanyUser[] List of SpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteCompanyUser}> List of SpyQuoteCompanyUser objects
     */
    public function getSpyQuoteCompanyUsersJoinSpyQuotePermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuoteCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyQuotePermissionGroup', $joinBehavior);

        return $this->getSpyQuoteCompanyUsers($query, $con);
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
     * If this ChildSpyCompanyUser is new, it will return
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
                    ->filterByCompanyUser($this)
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
            $spyMerchantRelationRequestRemoved->setCompanyUser(null);
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
                ->filterByCompanyUser($this)
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
        $spyMerchantRelationRequest->setCompanyUser($this);
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
            $spyMerchantRelationRequest->setCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationRequest[] List of SpyMerchantRelationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequest}> List of SpyMerchantRelationRequest objects
     */
    public function getSpyMerchantRelationRequestsJoinMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationRequestQuery::create(null, $criteria);
        $query->joinWith('Merchant', $joinBehavior);

        return $this->getSpyMerchantRelationRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
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
     * Clears out the collSpyQuoteApprovals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuoteApprovals()
     */
    public function clearSpyQuoteApprovals()
    {
        $this->collSpyQuoteApprovals = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuoteApprovals collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuoteApprovals($v = true): void
    {
        $this->collSpyQuoteApprovalsPartial = $v;
    }

    /**
     * Initializes the collSpyQuoteApprovals collection.
     *
     * By default this just sets the collSpyQuoteApprovals collection to an empty array (like clearcollSpyQuoteApprovals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuoteApprovals(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuoteApprovals && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuoteApprovalTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuoteApprovals = new $collectionClassName;
        $this->collSpyQuoteApprovals->setModel('\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval');
    }

    /**
     * Gets an array of SpyQuoteApproval objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyQuoteApproval[] List of SpyQuoteApproval objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteApproval> List of SpyQuoteApproval objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuoteApprovals(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuoteApprovalsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteApprovals || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuoteApprovals) {
                    $this->initSpyQuoteApprovals();
                } else {
                    $collectionClassName = SpyQuoteApprovalTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuoteApprovals = new $collectionClassName;
                    $collSpyQuoteApprovals->setModel('\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval');

                    return $collSpyQuoteApprovals;
                }
            } else {
                $collSpyQuoteApprovals = SpyQuoteApprovalQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuoteApprovalsPartial && count($collSpyQuoteApprovals)) {
                        $this->initSpyQuoteApprovals(false);

                        foreach ($collSpyQuoteApprovals as $obj) {
                            if (false == $this->collSpyQuoteApprovals->contains($obj)) {
                                $this->collSpyQuoteApprovals->append($obj);
                            }
                        }

                        $this->collSpyQuoteApprovalsPartial = true;
                    }

                    return $collSpyQuoteApprovals;
                }

                if ($partial && $this->collSpyQuoteApprovals) {
                    foreach ($this->collSpyQuoteApprovals as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuoteApprovals[] = $obj;
                        }
                    }
                }

                $this->collSpyQuoteApprovals = $collSpyQuoteApprovals;
                $this->collSpyQuoteApprovalsPartial = false;
            }
        }

        return $this->collSpyQuoteApprovals;
    }

    /**
     * Sets a collection of SpyQuoteApproval objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuoteApprovals A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuoteApprovals(Collection $spyQuoteApprovals, ?ConnectionInterface $con = null)
    {
        /** @var SpyQuoteApproval[] $spyQuoteApprovalsToDelete */
        $spyQuoteApprovalsToDelete = $this->getSpyQuoteApprovals(new Criteria(), $con)->diff($spyQuoteApprovals);


        $this->spyQuoteApprovalsScheduledForDeletion = $spyQuoteApprovalsToDelete;

        foreach ($spyQuoteApprovalsToDelete as $spyQuoteApprovalRemoved) {
            $spyQuoteApprovalRemoved->setSpyCompanyUser(null);
        }

        $this->collSpyQuoteApprovals = null;
        foreach ($spyQuoteApprovals as $spyQuoteApproval) {
            $this->addSpyQuoteApproval($spyQuoteApproval);
        }

        $this->collSpyQuoteApprovals = $spyQuoteApprovals;
        $this->collSpyQuoteApprovalsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyQuoteApproval objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyQuoteApproval objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuoteApprovals(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuoteApprovalsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteApprovals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuoteApprovals) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuoteApprovals());
            }

            $query = SpyQuoteApprovalQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyQuoteApprovals);
    }

    /**
     * Method called to associate a SpyQuoteApproval object to this object
     * through the SpyQuoteApproval foreign key attribute.
     *
     * @param SpyQuoteApproval $l SpyQuoteApproval
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuoteApproval(SpyQuoteApproval $l)
    {
        if ($this->collSpyQuoteApprovals === null) {
            $this->initSpyQuoteApprovals();
            $this->collSpyQuoteApprovalsPartial = true;
        }

        if (!$this->collSpyQuoteApprovals->contains($l)) {
            $this->doAddSpyQuoteApproval($l);

            if ($this->spyQuoteApprovalsScheduledForDeletion and $this->spyQuoteApprovalsScheduledForDeletion->contains($l)) {
                $this->spyQuoteApprovalsScheduledForDeletion->remove($this->spyQuoteApprovalsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyQuoteApproval $spyQuoteApproval The SpyQuoteApproval object to add.
     */
    protected function doAddSpyQuoteApproval(SpyQuoteApproval $spyQuoteApproval): void
    {
        $this->collSpyQuoteApprovals[]= $spyQuoteApproval;
        $spyQuoteApproval->setSpyCompanyUser($this);
    }

    /**
     * @param SpyQuoteApproval $spyQuoteApproval The SpyQuoteApproval object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuoteApproval(SpyQuoteApproval $spyQuoteApproval)
    {
        if ($this->getSpyQuoteApprovals()->contains($spyQuoteApproval)) {
            $pos = $this->collSpyQuoteApprovals->search($spyQuoteApproval);
            $this->collSpyQuoteApprovals->remove($pos);
            if (null === $this->spyQuoteApprovalsScheduledForDeletion) {
                $this->spyQuoteApprovalsScheduledForDeletion = clone $this->collSpyQuoteApprovals;
                $this->spyQuoteApprovalsScheduledForDeletion->clear();
            }
            $this->spyQuoteApprovalsScheduledForDeletion[]= clone $spyQuoteApproval;
            $spyQuoteApproval->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyQuoteApprovals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuoteApproval[] List of SpyQuoteApproval objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteApproval}> List of SpyQuoteApproval objects
     */
    public function getSpyQuoteApprovalsJoinSpyQuote(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuoteApprovalQuery::create(null, $criteria);
        $query->joinWith('SpyQuote', $joinBehavior);

        return $this->getSpyQuoteApprovals($query, $con);
    }

    /**
     * Clears out the collSpyQuoteRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuoteRequests()
     */
    public function clearSpyQuoteRequests()
    {
        $this->collSpyQuoteRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuoteRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuoteRequests($v = true): void
    {
        $this->collSpyQuoteRequestsPartial = $v;
    }

    /**
     * Initializes the collSpyQuoteRequests collection.
     *
     * By default this just sets the collSpyQuoteRequests collection to an empty array (like clearcollSpyQuoteRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuoteRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuoteRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuoteRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuoteRequests = new $collectionClassName;
        $this->collSpyQuoteRequests->setModel('\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest');
    }

    /**
     * Gets an array of SpyQuoteRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyQuoteRequest[] List of SpyQuoteRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteRequest> List of SpyQuoteRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuoteRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuoteRequestsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuoteRequests) {
                    $this->initSpyQuoteRequests();
                } else {
                    $collectionClassName = SpyQuoteRequestTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuoteRequests = new $collectionClassName;
                    $collSpyQuoteRequests->setModel('\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest');

                    return $collSpyQuoteRequests;
                }
            } else {
                $collSpyQuoteRequests = SpyQuoteRequestQuery::create(null, $criteria)
                    ->filterByCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuoteRequestsPartial && count($collSpyQuoteRequests)) {
                        $this->initSpyQuoteRequests(false);

                        foreach ($collSpyQuoteRequests as $obj) {
                            if (false == $this->collSpyQuoteRequests->contains($obj)) {
                                $this->collSpyQuoteRequests->append($obj);
                            }
                        }

                        $this->collSpyQuoteRequestsPartial = true;
                    }

                    return $collSpyQuoteRequests;
                }

                if ($partial && $this->collSpyQuoteRequests) {
                    foreach ($this->collSpyQuoteRequests as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuoteRequests[] = $obj;
                        }
                    }
                }

                $this->collSpyQuoteRequests = $collSpyQuoteRequests;
                $this->collSpyQuoteRequestsPartial = false;
            }
        }

        return $this->collSpyQuoteRequests;
    }

    /**
     * Sets a collection of SpyQuoteRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuoteRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuoteRequests(Collection $spyQuoteRequests, ?ConnectionInterface $con = null)
    {
        /** @var SpyQuoteRequest[] $spyQuoteRequestsToDelete */
        $spyQuoteRequestsToDelete = $this->getSpyQuoteRequests(new Criteria(), $con)->diff($spyQuoteRequests);


        $this->spyQuoteRequestsScheduledForDeletion = $spyQuoteRequestsToDelete;

        foreach ($spyQuoteRequestsToDelete as $spyQuoteRequestRemoved) {
            $spyQuoteRequestRemoved->setCompanyUser(null);
        }

        $this->collSpyQuoteRequests = null;
        foreach ($spyQuoteRequests as $spyQuoteRequest) {
            $this->addSpyQuoteRequest($spyQuoteRequest);
        }

        $this->collSpyQuoteRequests = $spyQuoteRequests;
        $this->collSpyQuoteRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyQuoteRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyQuoteRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuoteRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuoteRequestsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuoteRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuoteRequests());
            }

            $query = SpyQuoteRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyQuoteRequests);
    }

    /**
     * Method called to associate a SpyQuoteRequest object to this object
     * through the SpyQuoteRequest foreign key attribute.
     *
     * @param SpyQuoteRequest $l SpyQuoteRequest
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuoteRequest(SpyQuoteRequest $l)
    {
        if ($this->collSpyQuoteRequests === null) {
            $this->initSpyQuoteRequests();
            $this->collSpyQuoteRequestsPartial = true;
        }

        if (!$this->collSpyQuoteRequests->contains($l)) {
            $this->doAddSpyQuoteRequest($l);

            if ($this->spyQuoteRequestsScheduledForDeletion and $this->spyQuoteRequestsScheduledForDeletion->contains($l)) {
                $this->spyQuoteRequestsScheduledForDeletion->remove($this->spyQuoteRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyQuoteRequest $spyQuoteRequest The SpyQuoteRequest object to add.
     */
    protected function doAddSpyQuoteRequest(SpyQuoteRequest $spyQuoteRequest): void
    {
        $this->collSpyQuoteRequests[]= $spyQuoteRequest;
        $spyQuoteRequest->setCompanyUser($this);
    }

    /**
     * @param SpyQuoteRequest $spyQuoteRequest The SpyQuoteRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuoteRequest(SpyQuoteRequest $spyQuoteRequest)
    {
        if ($this->getSpyQuoteRequests()->contains($spyQuoteRequest)) {
            $pos = $this->collSpyQuoteRequests->search($spyQuoteRequest);
            $this->collSpyQuoteRequests->remove($pos);
            if (null === $this->spyQuoteRequestsScheduledForDeletion) {
                $this->spyQuoteRequestsScheduledForDeletion = clone $this->collSpyQuoteRequests;
                $this->spyQuoteRequestsScheduledForDeletion->clear();
            }
            $this->spyQuoteRequestsScheduledForDeletion[]= clone $spyQuoteRequest;
            $spyQuoteRequest->setCompanyUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySspInquiries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquiries()
     */
    public function clearSpySspInquiries()
    {
        $this->collSpySspInquiries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquiries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquiries($v = true): void
    {
        $this->collSpySspInquiriesPartial = $v;
    }

    /**
     * Initializes the collSpySspInquiries collection.
     *
     * By default this just sets the collSpySspInquiries collection to an empty array (like clearcollSpySspInquiries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquiries(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquiries && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquiryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquiries = new $collectionClassName;
        $this->collSpySspInquiries->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry');
    }

    /**
     * Gets an array of SpySspInquiry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspInquiry[] List of SpySspInquiry objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiry> List of SpySspInquiry objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquiries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquiriesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquiries) {
                    $this->initSpySspInquiries();
                } else {
                    $collectionClassName = SpySspInquiryTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquiries = new $collectionClassName;
                    $collSpySspInquiries->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry');

                    return $collSpySspInquiries;
                }
            } else {
                $collSpySspInquiries = SpySspInquiryQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquiriesPartial && count($collSpySspInquiries)) {
                        $this->initSpySspInquiries(false);

                        foreach ($collSpySspInquiries as $obj) {
                            if (false == $this->collSpySspInquiries->contains($obj)) {
                                $this->collSpySspInquiries->append($obj);
                            }
                        }

                        $this->collSpySspInquiriesPartial = true;
                    }

                    return $collSpySspInquiries;
                }

                if ($partial && $this->collSpySspInquiries) {
                    foreach ($this->collSpySspInquiries as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquiries[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquiries = $collSpySspInquiries;
                $this->collSpySspInquiriesPartial = false;
            }
        }

        return $this->collSpySspInquiries;
    }

    /**
     * Sets a collection of SpySspInquiry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquiries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquiries(Collection $spySspInquiries, ?ConnectionInterface $con = null)
    {
        /** @var SpySspInquiry[] $spySspInquiriesToDelete */
        $spySspInquiriesToDelete = $this->getSpySspInquiries(new Criteria(), $con)->diff($spySspInquiries);


        $this->spySspInquiriesScheduledForDeletion = $spySspInquiriesToDelete;

        foreach ($spySspInquiriesToDelete as $spySspInquiryRemoved) {
            $spySspInquiryRemoved->setSpyCompanyUser(null);
        }

        $this->collSpySspInquiries = null;
        foreach ($spySspInquiries as $spySspInquiry) {
            $this->addSpySspInquiry($spySspInquiry);
        }

        $this->collSpySspInquiries = $spySspInquiries;
        $this->collSpySspInquiriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspInquiry objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspInquiry objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquiries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquiriesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquiries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquiries());
            }

            $query = SpySspInquiryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpySspInquiries);
    }

    /**
     * Method called to associate a SpySspInquiry object to this object
     * through the SpySspInquiry foreign key attribute.
     *
     * @param SpySspInquiry $l SpySspInquiry
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquiry(SpySspInquiry $l)
    {
        if ($this->collSpySspInquiries === null) {
            $this->initSpySspInquiries();
            $this->collSpySspInquiriesPartial = true;
        }

        if (!$this->collSpySspInquiries->contains($l)) {
            $this->doAddSpySspInquiry($l);

            if ($this->spySspInquiriesScheduledForDeletion and $this->spySspInquiriesScheduledForDeletion->contains($l)) {
                $this->spySspInquiriesScheduledForDeletion->remove($this->spySspInquiriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspInquiry $spySspInquiry The SpySspInquiry object to add.
     */
    protected function doAddSpySspInquiry(SpySspInquiry $spySspInquiry): void
    {
        $this->collSpySspInquiries[]= $spySspInquiry;
        $spySspInquiry->setSpyCompanyUser($this);
    }

    /**
     * @param SpySspInquiry $spySspInquiry The SpySspInquiry object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquiry(SpySspInquiry $spySspInquiry)
    {
        if ($this->getSpySspInquiries()->contains($spySspInquiry)) {
            $pos = $this->collSpySspInquiries->search($spySspInquiry);
            $this->collSpySspInquiries->remove($pos);
            if (null === $this->spySspInquiriesScheduledForDeletion) {
                $this->spySspInquiriesScheduledForDeletion = clone $this->collSpySspInquiries;
                $this->spySspInquiriesScheduledForDeletion->clear();
            }
            $this->spySspInquiriesScheduledForDeletion[]= $spySspInquiry;
            $spySspInquiry->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpySspInquiries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspInquiry[] List of SpySspInquiry objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiry}> List of SpySspInquiry objects
     */
    public function getSpySspInquiriesJoinStateMachineItemState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspInquiryQuery::create(null, $criteria);
        $query->joinWith('StateMachineItemState', $joinBehavior);

        return $this->getSpySspInquiries($query, $con);
    }

    /**
     * Clears out the collSpyShoppingListCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyUsers()
     */
    public function clearSpyShoppingListCompanyUsers()
    {
        $this->collSpyShoppingListCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyUsers($v = true): void
    {
        $this->collSpyShoppingListCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyUsers collection.
     *
     * By default this just sets the collSpyShoppingListCompanyUsers collection to an empty array (like clearcollSpyShoppingListCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyUsers = new $collectionClassName;
        $this->collSpyShoppingListCompanyUsers->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser');
    }

    /**
     * Gets an array of SpyShoppingListCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListCompanyUser[] List of SpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyUser> List of SpyShoppingListCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyUsers) {
                    $this->initSpyShoppingListCompanyUsers();
                } else {
                    $collectionClassName = SpyShoppingListCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyUsers = new $collectionClassName;
                    $collSpyShoppingListCompanyUsers->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser');

                    return $collSpyShoppingListCompanyUsers;
                }
            } else {
                $collSpyShoppingListCompanyUsers = SpyShoppingListCompanyUserQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyUsersPartial && count($collSpyShoppingListCompanyUsers)) {
                        $this->initSpyShoppingListCompanyUsers(false);

                        foreach ($collSpyShoppingListCompanyUsers as $obj) {
                            if (false == $this->collSpyShoppingListCompanyUsers->contains($obj)) {
                                $this->collSpyShoppingListCompanyUsers->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyUsersPartial = true;
                    }

                    return $collSpyShoppingListCompanyUsers;
                }

                if ($partial && $this->collSpyShoppingListCompanyUsers) {
                    foreach ($this->collSpyShoppingListCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyUsers = $collSpyShoppingListCompanyUsers;
                $this->collSpyShoppingListCompanyUsersPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyUsers;
    }

    /**
     * Sets a collection of SpyShoppingListCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyUsers(Collection $spyShoppingListCompanyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListCompanyUser[] $spyShoppingListCompanyUsersToDelete */
        $spyShoppingListCompanyUsersToDelete = $this->getSpyShoppingListCompanyUsers(new Criteria(), $con)->diff($spyShoppingListCompanyUsers);


        $this->spyShoppingListCompanyUsersScheduledForDeletion = $spyShoppingListCompanyUsersToDelete;

        foreach ($spyShoppingListCompanyUsersToDelete as $spyShoppingListCompanyUserRemoved) {
            $spyShoppingListCompanyUserRemoved->setSpyCompanyUser(null);
        }

        $this->collSpyShoppingListCompanyUsers = null;
        foreach ($spyShoppingListCompanyUsers as $spyShoppingListCompanyUser) {
            $this->addSpyShoppingListCompanyUser($spyShoppingListCompanyUser);
        }

        $this->collSpyShoppingListCompanyUsers = $spyShoppingListCompanyUsers;
        $this->collSpyShoppingListCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyUsers());
            }

            $query = SpyShoppingListCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyUsers);
    }

    /**
     * Method called to associate a SpyShoppingListCompanyUser object to this object
     * through the SpyShoppingListCompanyUser foreign key attribute.
     *
     * @param SpyShoppingListCompanyUser $l SpyShoppingListCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyUser(SpyShoppingListCompanyUser $l)
    {
        if ($this->collSpyShoppingListCompanyUsers === null) {
            $this->initSpyShoppingListCompanyUsers();
            $this->collSpyShoppingListCompanyUsersPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyUsers->contains($l)) {
            $this->doAddSpyShoppingListCompanyUser($l);

            if ($this->spyShoppingListCompanyUsersScheduledForDeletion and $this->spyShoppingListCompanyUsersScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyUsersScheduledForDeletion->remove($this->spyShoppingListCompanyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListCompanyUser $spyShoppingListCompanyUser The SpyShoppingListCompanyUser object to add.
     */
    protected function doAddSpyShoppingListCompanyUser(SpyShoppingListCompanyUser $spyShoppingListCompanyUser): void
    {
        $this->collSpyShoppingListCompanyUsers[]= $spyShoppingListCompanyUser;
        $spyShoppingListCompanyUser->setSpyCompanyUser($this);
    }

    /**
     * @param SpyShoppingListCompanyUser $spyShoppingListCompanyUser The SpyShoppingListCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyUser(SpyShoppingListCompanyUser $spyShoppingListCompanyUser)
    {
        if ($this->getSpyShoppingListCompanyUsers()->contains($spyShoppingListCompanyUser)) {
            $pos = $this->collSpyShoppingListCompanyUsers->search($spyShoppingListCompanyUser);
            $this->collSpyShoppingListCompanyUsers->remove($pos);
            if (null === $this->spyShoppingListCompanyUsersScheduledForDeletion) {
                $this->spyShoppingListCompanyUsersScheduledForDeletion = clone $this->collSpyShoppingListCompanyUsers;
                $this->spyShoppingListCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyUsersScheduledForDeletion[]= clone $spyShoppingListCompanyUser;
            $spyShoppingListCompanyUser->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyShoppingListCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListCompanyUser[] List of SpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyUser}> List of SpyShoppingListCompanyUser objects
     */
    public function getSpyShoppingListCompanyUsersJoinSpyShoppingList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingList', $joinBehavior);

        return $this->getSpyShoppingListCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyShoppingListCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListCompanyUser[] List of SpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyUser}> List of SpyShoppingListCompanyUser objects
     */
    public function getSpyShoppingListCompanyUsersJoinSpyShoppingListPermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListPermissionGroup', $joinBehavior);

        return $this->getSpyShoppingListCompanyUsers($query, $con);
    }

    /**
     * Clears out the collSpyShoppingListCompanyBusinessUnitBlacklists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyBusinessUnitBlacklists()
     */
    public function clearSpyShoppingListCompanyBusinessUnitBlacklists()
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyBusinessUnitBlacklists collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyBusinessUnitBlacklists($v = true): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyBusinessUnitBlacklists collection.
     *
     * By default this just sets the collSpyShoppingListCompanyBusinessUnitBlacklists collection to an empty array (like clearcollSpyShoppingListCompanyBusinessUnitBlacklists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyBusinessUnitBlacklists(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyBusinessUnitBlacklists && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = new $collectionClassName;
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist');
    }

    /**
     * Gets an array of SpyShoppingListCompanyBusinessUnitBlacklist objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListCompanyBusinessUnitBlacklist[] List of SpyShoppingListCompanyBusinessUnitBlacklist objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnitBlacklist> List of SpyShoppingListCompanyBusinessUnitBlacklist objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyBusinessUnitBlacklists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                    $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
                } else {
                    $collectionClassName = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyBusinessUnitBlacklists = new $collectionClassName;
                    $collSpyShoppingListCompanyBusinessUnitBlacklists->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist');

                    return $collSpyShoppingListCompanyBusinessUnitBlacklists;
                }
            } else {
                $collSpyShoppingListCompanyBusinessUnitBlacklists = SpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria)
                    ->filterBySpyCompanyUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && count($collSpyShoppingListCompanyBusinessUnitBlacklists)) {
                        $this->initSpyShoppingListCompanyBusinessUnitBlacklists(false);

                        foreach ($collSpyShoppingListCompanyBusinessUnitBlacklists as $obj) {
                            if (false == $this->collSpyShoppingListCompanyBusinessUnitBlacklists->contains($obj)) {
                                $this->collSpyShoppingListCompanyBusinessUnitBlacklists->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = true;
                    }

                    return $collSpyShoppingListCompanyBusinessUnitBlacklists;
                }

                if ($partial && $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                    foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyBusinessUnitBlacklists[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyBusinessUnitBlacklists = $collSpyShoppingListCompanyBusinessUnitBlacklists;
                $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyBusinessUnitBlacklists;
    }

    /**
     * Sets a collection of SpyShoppingListCompanyBusinessUnitBlacklist objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyBusinessUnitBlacklists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyBusinessUnitBlacklists(Collection $spyShoppingListCompanyBusinessUnitBlacklists, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListCompanyBusinessUnitBlacklist[] $spyShoppingListCompanyBusinessUnitBlacklistsToDelete */
        $spyShoppingListCompanyBusinessUnitBlacklistsToDelete = $this->getSpyShoppingListCompanyBusinessUnitBlacklists(new Criteria(), $con)->diff($spyShoppingListCompanyBusinessUnitBlacklists);


        $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = $spyShoppingListCompanyBusinessUnitBlacklistsToDelete;

        foreach ($spyShoppingListCompanyBusinessUnitBlacklistsToDelete as $spyShoppingListCompanyBusinessUnitBlacklistRemoved) {
            $spyShoppingListCompanyBusinessUnitBlacklistRemoved->setSpyCompanyUser(null);
        }

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;
        foreach ($spyShoppingListCompanyBusinessUnitBlacklists as $spyShoppingListCompanyBusinessUnitBlacklist) {
            $this->addSpyShoppingListCompanyBusinessUnitBlacklist($spyShoppingListCompanyBusinessUnitBlacklist);
        }

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = $spyShoppingListCompanyBusinessUnitBlacklists;
        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListCompanyBusinessUnitBlacklist objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListCompanyBusinessUnitBlacklist objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyBusinessUnitBlacklists(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyBusinessUnitBlacklists());
            }

            $query = SpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyUser($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyBusinessUnitBlacklists);
    }

    /**
     * Method called to associate a SpyShoppingListCompanyBusinessUnitBlacklist object to this object
     * through the SpyShoppingListCompanyBusinessUnitBlacklist foreign key attribute.
     *
     * @param SpyShoppingListCompanyBusinessUnitBlacklist $l SpyShoppingListCompanyBusinessUnitBlacklist
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyBusinessUnitBlacklist(SpyShoppingListCompanyBusinessUnitBlacklist $l)
    {
        if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists === null) {
            $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
            $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyBusinessUnitBlacklists->contains($l)) {
            $this->doAddSpyShoppingListCompanyBusinessUnitBlacklist($l);

            if ($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion and $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->remove($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist The SpyShoppingListCompanyBusinessUnitBlacklist object to add.
     */
    protected function doAddSpyShoppingListCompanyBusinessUnitBlacklist(SpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists[]= $spyShoppingListCompanyBusinessUnitBlacklist;
        $spyShoppingListCompanyBusinessUnitBlacklist->setSpyCompanyUser($this);
    }

    /**
     * @param SpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist The SpyShoppingListCompanyBusinessUnitBlacklist object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyBusinessUnitBlacklist(SpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist)
    {
        if ($this->getSpyShoppingListCompanyBusinessUnitBlacklists()->contains($spyShoppingListCompanyBusinessUnitBlacklist)) {
            $pos = $this->collSpyShoppingListCompanyBusinessUnitBlacklists->search($spyShoppingListCompanyBusinessUnitBlacklist);
            $this->collSpyShoppingListCompanyBusinessUnitBlacklists->remove($pos);
            if (null === $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion) {
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = clone $this->collSpyShoppingListCompanyBusinessUnitBlacklists;
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion[]= clone $spyShoppingListCompanyBusinessUnitBlacklist;
            $spyShoppingListCompanyBusinessUnitBlacklist->setSpyCompanyUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUser is new, it will return
     * an empty collection; or if this SpyCompanyUser has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnitBlacklists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListCompanyBusinessUnitBlacklist[] List of SpyShoppingListCompanyBusinessUnitBlacklist objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnitBlacklist}> List of SpyShoppingListCompanyBusinessUnitBlacklist objects
     */
    public function getSpyShoppingListCompanyBusinessUnitBlacklistsJoinSpyShoppingListCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListCompanyBusinessUnit', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnitBlacklists($query, $con);
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
        if (null !== $this->aCompanyBusinessUnit) {
            $this->aCompanyBusinessUnit->removeCompanyUser($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeCompanyUser($this);
        }
        if (null !== $this->aCustomer) {
            $this->aCustomer->removeCompanyUser($this);
        }
        $this->id_company_user = null;
        $this->fk_company = null;
        $this->fk_company_business_unit = null;
        $this->fk_customer = null;
        $this->is_active = null;
        $this->is_default = null;
        $this->key = null;
        $this->uuid = null;
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
            if ($this->collSpyCompanyUserFiles) {
                foreach ($this->collSpyCompanyUserFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyRoleToCompanyUsers) {
                foreach ($this->collSpyCompanyRoleToCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyUserInvitations) {
                foreach ($this->collSpyCompanyUserInvitations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuoteCompanyUsers) {
                foreach ($this->collSpyQuoteCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationRequests) {
                foreach ($this->collSpyMerchantRelationRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuoteApprovals) {
                foreach ($this->collSpyQuoteApprovals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuoteRequests) {
                foreach ($this->collSpyQuoteRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquiries) {
                foreach ($this->collSpySspInquiries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListCompanyUsers) {
                foreach ($this->collSpyShoppingListCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyUserFiles = null;
        $this->collSpyCompanyRoleToCompanyUsers = null;
        $this->collSpyCompanyUserInvitations = null;
        $this->collSpyQuoteCompanyUsers = null;
        $this->collSpyMerchantRelationRequests = null;
        $this->collSpyQuoteApprovals = null;
        $this->collSpyQuoteRequests = null;
        $this->collSpySspInquiries = null;
        $this->collSpyShoppingListCompanyUsers = null;
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;
        $this->aCompanyBusinessUnit = null;
        $this->aCompany = null;
        $this->aCustomer = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCompanyUserTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_company_user' . '.' . $this->getIdCompanyUser() . '.' . $this->getFkCustomer();
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

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_company_user.create';
        } else {
            $this->_eventName = 'Entity.spy_company_user.update';
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

        if ($this->_eventName !== 'Entity.spy_company_user.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_company_user',
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
            'name' => 'spy_company_user',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_company_user.delete',
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
            $field = str_replace('spy_company_user.', '', $modifiedColumn);
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
            $field = str_replace('spy_company_user.', '', $additionalValueColumnName);
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
        $columnType = SpyCompanyUserTableMap::getTableMap()->getColumn($column)->getType();
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
