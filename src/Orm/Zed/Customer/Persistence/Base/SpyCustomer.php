<?php

namespace Orm\Zed\Customer\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Comment\Persistence\SpyComment;
use Orm\Zed\Comment\Persistence\SpyCommentQuery;
use Orm\Zed\Comment\Persistence\Base\SpyComment as BaseSpyComment;
use Orm\Zed\Comment\Persistence\Map\SpyCommentTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUser as BaseSpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequest;
use Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequestQuery;
use Orm\Zed\CustomerDataChangeRequest\Persistence\Base\SpyCustomerDataChangeRequest as BaseSpyCustomerDataChangeRequest;
use Orm\Zed\CustomerDataChangeRequest\Persistence\Map\SpyCustomerDataChangeRequestTableMap;
use Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount;
use Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery;
use Orm\Zed\CustomerDiscountConnector\Persistence\Base\SpyCustomerDiscount as BaseSpyCustomerDiscount;
use Orm\Zed\CustomerDiscountConnector\Persistence\Map\SpyCustomerDiscountTableMap;
use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer;
use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomerQuery;
use Orm\Zed\CustomerGroup\Persistence\Base\SpyCustomerGroupToCustomer as BaseSpyCustomerGroupToCustomer;
use Orm\Zed\CustomerGroup\Persistence\Map\SpyCustomerGroupToCustomerTableMap;
use Orm\Zed\CustomerNote\Persistence\SpyCustomerNote;
use Orm\Zed\CustomerNote\Persistence\SpyCustomerNoteQuery;
use Orm\Zed\CustomerNote\Persistence\Base\SpyCustomerNote as BaseSpyCustomerNote;
use Orm\Zed\CustomerNote\Persistence\Map\SpyCustomerNoteTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomer as ChildSpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress as ChildSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery as ChildSpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery as ChildSpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuth;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthQuery;
use Orm\Zed\MultiFactorAuth\Persistence\Base\SpyCustomerMultiFactorAuth as BaseSpyCustomerMultiFactorAuth;
use Orm\Zed\MultiFactorAuth\Persistence\Map\SpyCustomerMultiFactorAuthTableMap;
use Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber;
use Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery;
use Orm\Zed\Newsletter\Persistence\Base\SpyNewsletterSubscriber as BaseSpyNewsletterSubscriber;
use Orm\Zed\Newsletter\Persistence\Map\SpyNewsletterSubscriberTableMap;
use Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission;
use Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery;
use Orm\Zed\ProductCustomerPermission\Persistence\Base\SpyProductCustomerPermission as BaseSpyProductCustomerPermission;
use Orm\Zed\ProductCustomerPermission\Persistence\Map\SpyProductCustomerPermissionTableMap;
use Orm\Zed\User\Persistence\SpyUser;
use Orm\Zed\User\Persistence\SpyUserQuery;
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
 * Base class that represents a row from the 'spy_customer' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Customer.Persistence.Base
 */
abstract class SpyCustomer implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Customer\\Persistence\\Map\\SpyCustomerTableMap';


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
     * The value for the id_customer field.
     *
     * @var        int
     */
    protected $id_customer;

    /**
     * The value for the fk_locale field.
     *
     * @var        int|null
     */
    protected $fk_locale;

    /**
     * The value for the fk_user field.
     *
     * @var        int|null
     */
    protected $fk_user;

    /**
     * The value for the anonymized_at field.
     * The timestamp when customer data was anonymized.
     * @var        DateTime|null
     */
    protected $anonymized_at;

    /**
     * The value for the company field.
     * A company entity.
     * @var        string|null
     */
    protected $company;

    /**
     * The value for the customer_reference field.
     * A unique reference for a customer.
     * @var        string
     */
    protected $customer_reference;

    /**
     * The value for the date_of_birth field.
     * The customer's date of birth.
     * @var        DateTime|null
     */
    protected $date_of_birth;

    /**
     * The value for the default_billing_address field.
     * The identifier for the default billing address.
     * @var        int|null
     */
    protected $default_billing_address;

    /**
     * The value for the default_shipping_address field.
     * The identifier for the default shipping address.
     * @var        int|null
     */
    protected $default_shipping_address;

    /**
     * The value for the email field.
     * The email address of a user or contact.
     * @var        string
     */
    protected $email;

    /**
     * The value for the first_name field.
     * The first name of a person.
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the gender field.
     * The gender of a person.
     * @var        int|null
     */
    protected $gender;

    /**
     * The value for the last_name field.
     * The last name of a user or customer.
     * @var        string|null
     */
    protected $last_name;

    /**
     * The value for the password field.
     * The password for a user account, used for authentication.
     * @var        string|null
     */
    protected $password;

    /**
     * The value for the phone field.
     * The phone number.
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the registered field.
     * The date when a user registered.
     * @var        DateTime|null
     */
    protected $registered;

    /**
     * The value for the registration_key field.
     * A key used to confirm a new user registration.
     * @var        string|null
     */
    protected $registration_key;

    /**
     * The value for the restore_password_date field.
     * The date when a password restore was requested.
     * @var        DateTime|null
     */
    protected $restore_password_date;

    /**
     * The value for the restore_password_key field.
     * A key used to verify a password restore request.
     * @var        string|null
     */
    protected $restore_password_key;

    /**
     * The value for the salutation field.
     * The salutation of a person (e.g., Mr., Mrs., Dr.).
     * @var        int|null
     */
    protected $salutation;

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
     * @var        SpyUser
     */
    protected $aSpyUser;

    /**
     * @var        ChildSpyCustomerAddress
     */
    protected $aBillingAddress;

    /**
     * @var        ChildSpyCustomerAddress
     */
    protected $aShippingAddress;

    /**
     * @var        SpyLocale
     */
    protected $aLocale;

    /**
     * @var        ObjectCollection|SpyComment[] Collection to store aggregation of SpyComment objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyComment> Collection to store aggregation of SpyComment objects.
     */
    protected $collSpyComments;
    protected $collSpyCommentsPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUser[] Collection to store aggregation of SpyCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser> Collection to store aggregation of SpyCompanyUser objects.
     */
    protected $collCompanyUsers;
    protected $collCompanyUsersPartial;

    /**
     * @var        ObjectCollection|ChildSpyCustomerAddress[] Collection to store aggregation of ChildSpyCustomerAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomerAddress> Collection to store aggregation of ChildSpyCustomerAddress objects.
     */
    protected $collAddresses;
    protected $collAddressesPartial;

    /**
     * @var        ObjectCollection|SpyCustomerDataChangeRequest[] Collection to store aggregation of SpyCustomerDataChangeRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDataChangeRequest> Collection to store aggregation of SpyCustomerDataChangeRequest objects.
     */
    protected $collCustomerDataChangeRequests;
    protected $collCustomerDataChangeRequestsPartial;

    /**
     * @var        ObjectCollection|SpyCustomerDiscount[] Collection to store aggregation of SpyCustomerDiscount objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDiscount> Collection to store aggregation of SpyCustomerDiscount objects.
     */
    protected $collSpyCustomerDiscounts;
    protected $collSpyCustomerDiscountsPartial;

    /**
     * @var        ObjectCollection|SpyCustomerGroupToCustomer[] Collection to store aggregation of SpyCustomerGroupToCustomer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerGroupToCustomer> Collection to store aggregation of SpyCustomerGroupToCustomer objects.
     */
    protected $collSpyCustomerGroupToCustomers;
    protected $collSpyCustomerGroupToCustomersPartial;

    /**
     * @var        ObjectCollection|SpyCustomerNote[] Collection to store aggregation of SpyCustomerNote objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerNote> Collection to store aggregation of SpyCustomerNote objects.
     */
    protected $collCustomerNotes;
    protected $collCustomerNotesPartial;

    /**
     * @var        ObjectCollection|SpyCustomerMultiFactorAuth[] Collection to store aggregation of SpyCustomerMultiFactorAuth objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerMultiFactorAuth> Collection to store aggregation of SpyCustomerMultiFactorAuth objects.
     */
    protected $collSpyCustomerMultiFactorAuths;
    protected $collSpyCustomerMultiFactorAuthsPartial;

    /**
     * @var        ObjectCollection|SpyNewsletterSubscriber[] Collection to store aggregation of SpyNewsletterSubscriber objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyNewsletterSubscriber> Collection to store aggregation of SpyNewsletterSubscriber objects.
     */
    protected $collSpyNewsletterSubscribers;
    protected $collSpyNewsletterSubscribersPartial;

    /**
     * @var        ObjectCollection|SpyProductCustomerPermission[] Collection to store aggregation of SpyProductCustomerPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCustomerPermission> Collection to store aggregation of SpyProductCustomerPermission objects.
     */
    protected $collSpyProductCustomerPermissions;
    protected $collSpyProductCustomerPermissionsPartial;

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
        'spy_customer.fk_user' => 'fk_user',
        'spy_customer.default_billing_address' => 'default_billing_address',
        'spy_customer.default_shipping_address' => 'default_shipping_address',
        'spy_customer.fk_locale' => 'fk_locale',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyComment[]
     * @phpstan-var ObjectCollection&\Traversable<SpyComment>
     */
    protected $spyCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser>
     */
    protected $companyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCustomerAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomerAddress>
     */
    protected $addressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerDataChangeRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDataChangeRequest>
     */
    protected $customerDataChangeRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerDiscount[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDiscount>
     */
    protected $spyCustomerDiscountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerGroupToCustomer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerGroupToCustomer>
     */
    protected $spyCustomerGroupToCustomersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerNote[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerNote>
     */
    protected $customerNotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerMultiFactorAuth[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerMultiFactorAuth>
     */
    protected $spyCustomerMultiFactorAuthsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyNewsletterSubscriber[]
     * @phpstan-var ObjectCollection&\Traversable<SpyNewsletterSubscriber>
     */
    protected $spyNewsletterSubscribersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductCustomerPermission[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCustomerPermission>
     */
    protected $spyProductCustomerPermissionsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Customer\Persistence\Base\SpyCustomer object.
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
     * Compares this with another <code>SpyCustomer</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCustomer</code>, delegates to
     * <code>equals(SpyCustomer)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_customer] column value.
     *
     * @return int
     */
    public function getIdCustomer()
    {
        return $this->id_customer;
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
     * Get the [fk_user] column value.
     *
     * @return int|null
     */
    public function getFkUser()
    {
        return $this->fk_user;
    }

    /**
     * Get the [optionally formatted] temporal [anonymized_at] column value.
     * The timestamp when customer data was anonymized.
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
    public function getAnonymizedAt($format = null)
    {
        if ($format === null) {
            return $this->anonymized_at;
        } else {
            return $this->anonymized_at instanceof \DateTimeInterface ? $this->anonymized_at->format($format) : null;
        }
    }

    /**
     * Get the [company] column value.
     * A company entity.
     * @return string|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get the [customer_reference] column value.
     * A unique reference for a customer.
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * Get the [optionally formatted] temporal [date_of_birth] column value.
     * The customer's date of birth.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getDateOfBirth($format = null)
    {
        if ($format === null) {
            return $this->date_of_birth;
        } else {
            return $this->date_of_birth instanceof \DateTimeInterface ? $this->date_of_birth->format($format) : null;
        }
    }

    /**
     * Get the [default_billing_address] column value.
     * The identifier for the default billing address.
     * @return int|null
     */
    public function getDefaultBillingAddress()
    {
        return $this->default_billing_address;
    }

    /**
     * Get the [default_shipping_address] column value.
     * The identifier for the default shipping address.
     * @return int|null
     */
    public function getDefaultShippingAddress()
    {
        return $this->default_shipping_address;
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
     * Get the [first_name] column value.
     * The first name of a person.
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [gender] column value.
     * The gender of a person.
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGender()
    {
        if (null === $this->gender) {
            return null;
        }
        $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
        if (!isset($valueSet[$this->gender])) {
            throw new PropelException('Unknown stored enum key: ' . $this->gender);
        }

        return $valueSet[$this->gender];
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
     * Get the [password] column value.
     * The password for a user account, used for authentication.
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [phone] column value.
     * The phone number.
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [optionally formatted] temporal [registered] column value.
     * The date when a user registered.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getRegistered($format = null)
    {
        if ($format === null) {
            return $this->registered;
        } else {
            return $this->registered instanceof \DateTimeInterface ? $this->registered->format($format) : null;
        }
    }

    /**
     * Get the [registration_key] column value.
     * A key used to confirm a new user registration.
     * @return string|null
     */
    public function getRegistrationKey()
    {
        return $this->registration_key;
    }

    /**
     * Get the [optionally formatted] temporal [restore_password_date] column value.
     * The date when a password restore was requested.
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
    public function getRestorePasswordDate($format = null)
    {
        if ($format === null) {
            return $this->restore_password_date;
        } else {
            return $this->restore_password_date instanceof \DateTimeInterface ? $this->restore_password_date->format($format) : null;
        }
    }

    /**
     * Get the [restore_password_key] column value.
     * A key used to verify a password restore request.
     * @return string|null
     */
    public function getRestorePasswordKey()
    {
        return $this->restore_password_key;
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
        $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
        if (!isset($valueSet[$this->salutation])) {
            throw new PropelException('Unknown stored enum key: ' . $this->salutation);
        }

        return $valueSet[$this->salutation];
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
     * Set the value of [id_customer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_customer !== $v) {
            $this->id_customer = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_ID_CUSTOMER] = true;
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_FK_LOCALE] = true;
        }

        if ($this->aLocale !== null && $this->aLocale->getIdLocale() !== $v) {
            $this->aLocale = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_user] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_user !== $v) {
            $this->fk_user = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_FK_USER] = true;
        }

        if ($this->aSpyUser !== null && $this->aSpyUser->getIdUser() !== $v) {
            $this->aSpyUser = null;
        }

        return $this;
    }

    /**
     * Sets the value of [anonymized_at] column to a normalized version of the date/time value specified.
     * The timestamp when customer data was anonymized.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setAnonymizedAt($v)
    {
        $this->_initialValues[SpyCustomerTableMap::COL_ANONYMIZED_AT] = $this->anonymized_at;

        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->anonymized_at !== null || $dt !== null) {
            if ($this->anonymized_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->anonymized_at->format("Y-m-d H:i:s.u")) {
                $this->anonymized_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_ANONYMIZED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [company] column.
     * A company entity.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompany($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->company !== $v) {
            $this->company = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_COMPANY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_reference] column.
     * A unique reference for a customer.
     * @param string $v New value
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_CUSTOMER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date_of_birth] column to a normalized version of the date/time value specified.
     * The customer's date of birth.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_of_birth !== null || $dt !== null) {
            if ($this->date_of_birth === null || $dt === null || $dt->format("Y-m-d") !== $this->date_of_birth->format("Y-m-d")) {
                $this->date_of_birth = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_DATE_OF_BIRTH] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [default_billing_address] column.
     * The identifier for the default billing address.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultBillingAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->default_billing_address !== $v) {
            $this->default_billing_address = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS] = true;
        }

        if ($this->aBillingAddress !== null && $this->aBillingAddress->getIdCustomerAddress() !== $v) {
            $this->aBillingAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [default_shipping_address] column.
     * The identifier for the default shipping address.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultShippingAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->default_shipping_address !== $v) {
            $this->default_shipping_address = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS] = true;
        }

        if ($this->aShippingAddress !== null && $this->aShippingAddress->getIdCustomerAddress() !== $v) {
            $this->aShippingAddress = null;
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_EMAIL] = true;
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gender] column.
     * The gender of a person.
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_GENDER] = true;
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     * The password for a user account, used for authentication.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        $this->_initialValues[SpyCustomerTableMap::COL_PASSWORD] = $this->password;

        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_PASSWORD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     * The phone number.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [registered] column to a normalized version of the date/time value specified.
     * The date when a user registered.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered !== null || $dt !== null) {
            if ($this->registered === null || $dt === null || $dt->format("Y-m-d") !== $this->registered->format("Y-m-d")) {
                $this->registered = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_REGISTERED] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [registration_key] column.
     * A key used to confirm a new user registration.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistrationKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->registration_key !== $v) {
            $this->registration_key = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_REGISTRATION_KEY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [restore_password_date] column to a normalized version of the date/time value specified.
     * The date when a password restore was requested.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRestorePasswordDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->restore_password_date !== null || $dt !== null) {
            if ($this->restore_password_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->restore_password_date->format("Y-m-d H:i:s.u")) {
                $this->restore_password_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [restore_password_key] column.
     * A key used to verify a password restore request.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRestorePasswordKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->restore_password_key !== $v) {
            $this->restore_password_key = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY] = true;
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
            $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_SALUTATION] = true;
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
                $this->modifiedColumns[SpyCustomerTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyCustomerTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCustomerTableMap::translateFieldName('IdCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_customer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCustomerTableMap::translateFieldName('FkLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCustomerTableMap::translateFieldName('FkUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCustomerTableMap::translateFieldName('AnonymizedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->anonymized_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCustomerTableMap::translateFieldName('Company', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCustomerTableMap::translateFieldName('CustomerReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCustomerTableMap::translateFieldName('DateOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_of_birth = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCustomerTableMap::translateFieldName('DefaultBillingAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_billing_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCustomerTableMap::translateFieldName('DefaultShippingAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_shipping_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCustomerTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCustomerTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyCustomerTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyCustomerTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyCustomerTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyCustomerTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyCustomerTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->registered = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyCustomerTableMap::translateFieldName('RegistrationKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registration_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpyCustomerTableMap::translateFieldName('RestorePasswordDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->restore_password_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpyCustomerTableMap::translateFieldName('RestorePasswordKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restore_password_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SpyCustomerTableMap::translateFieldName('Salutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salutation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SpyCustomerTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SpyCustomerTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 22; // 22 = SpyCustomerTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer'), 0, $e);
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
        if ($this->aSpyUser !== null && $this->fk_user !== $this->aSpyUser->getIdUser()) {
            $this->aSpyUser = null;
        }
        if ($this->aBillingAddress !== null && $this->default_billing_address !== $this->aBillingAddress->getIdCustomerAddress()) {
            $this->aBillingAddress = null;
        }
        if ($this->aShippingAddress !== null && $this->default_shipping_address !== $this->aShippingAddress->getIdCustomerAddress()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCustomerTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCustomerQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyUser = null;
            $this->aBillingAddress = null;
            $this->aShippingAddress = null;
            $this->aLocale = null;
            $this->collSpyComments = null;

            $this->collCompanyUsers = null;

            $this->collAddresses = null;

            $this->collCustomerDataChangeRequests = null;

            $this->collSpyCustomerDiscounts = null;

            $this->collSpyCustomerGroupToCustomers = null;

            $this->collCustomerNotes = null;

            $this->collSpyCustomerMultiFactorAuths = null;

            $this->collSpyNewsletterSubscribers = null;

            $this->collSpyProductCustomerPermissions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCustomer::setDeleted()
     * @see SpyCustomer::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCustomerQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
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

                SpyCustomerTableMap::addInstanceToPool($this);
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

            if ($this->aSpyUser !== null) {
                if ($this->aSpyUser->isModified() || $this->aSpyUser->isNew()) {
                    $affectedRows += $this->aSpyUser->save($con);
                }
                $this->setSpyUser($this->aSpyUser);
            }

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

            if ($this->spyCommentsScheduledForDeletion !== null) {
                if (!$this->spyCommentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCommentsScheduledForDeletion as $spyComment) {
                        // need to save related object because we set the relation to null
                        $spyComment->save($con);
                    }
                    $this->spyCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyComments !== null) {
                foreach ($this->collSpyComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyUsersScheduledForDeletion !== null) {
                if (!$this->companyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->companyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->companyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyUsers !== null) {
                foreach ($this->collCompanyUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->addressesScheduledForDeletion !== null) {
                if (!$this->addressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery::create()
                        ->filterByPrimaryKeys($this->addressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->addressesScheduledForDeletion = null;
                }
            }

            if ($this->collAddresses !== null) {
                foreach ($this->collAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customerDataChangeRequestsScheduledForDeletion !== null) {
                if (!$this->customerDataChangeRequestsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequestQuery::create()
                        ->filterByPrimaryKeys($this->customerDataChangeRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customerDataChangeRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerDataChangeRequests !== null) {
                foreach ($this->collCustomerDataChangeRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCustomerDiscountsScheduledForDeletion !== null) {
                if (!$this->spyCustomerDiscountsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery::create()
                        ->filterByPrimaryKeys($this->spyCustomerDiscountsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCustomerDiscountsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomerDiscounts !== null) {
                foreach ($this->collSpyCustomerDiscounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCustomerGroupToCustomersScheduledForDeletion !== null) {
                if (!$this->spyCustomerGroupToCustomersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomerQuery::create()
                        ->filterByPrimaryKeys($this->spyCustomerGroupToCustomersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCustomerGroupToCustomersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomerGroupToCustomers !== null) {
                foreach ($this->collSpyCustomerGroupToCustomers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customerNotesScheduledForDeletion !== null) {
                if (!$this->customerNotesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CustomerNote\Persistence\SpyCustomerNoteQuery::create()
                        ->filterByPrimaryKeys($this->customerNotesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customerNotesScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerNotes !== null) {
                foreach ($this->collCustomerNotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCustomerMultiFactorAuthsScheduledForDeletion !== null) {
                if (!$this->spyCustomerMultiFactorAuthsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthQuery::create()
                        ->filterByPrimaryKeys($this->spyCustomerMultiFactorAuthsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCustomerMultiFactorAuthsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomerMultiFactorAuths !== null) {
                foreach ($this->collSpyCustomerMultiFactorAuths as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyNewsletterSubscribersScheduledForDeletion !== null) {
                if (!$this->spyNewsletterSubscribersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyNewsletterSubscribersScheduledForDeletion as $spyNewsletterSubscriber) {
                        // need to save related object because we set the relation to null
                        $spyNewsletterSubscriber->save($con);
                    }
                    $this->spyNewsletterSubscribersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyNewsletterSubscribers !== null) {
                foreach ($this->collSpyNewsletterSubscribers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductCustomerPermissionsScheduledForDeletion !== null) {
                if (!$this->spyProductCustomerPermissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery::create()
                        ->filterByPrimaryKeys($this->spyProductCustomerPermissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductCustomerPermissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductCustomerPermissions !== null) {
                foreach ($this->collSpyProductCustomerPermissions as $referrerFK) {
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

        $this->modifiedColumns[SpyCustomerTableMap::COL_ID_CUSTOMER] = true;
        if (null !== $this->id_customer) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCustomerTableMap::COL_ID_CUSTOMER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ID_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = 'id_customer';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_locale';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_USER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_user';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ANONYMIZED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'anonymized_at';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = 'company';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'customer_reference';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DATE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'date_of_birth';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'default_billing_address';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'default_shipping_address';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = 'registered';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTRATION_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'registration_key';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'restore_password_date';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'restore_password_key';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'salutation';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_customer (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_customer':
                        $stmt->bindValue($identifier, $this->id_customer, PDO::PARAM_INT);

                        break;
                    case 'fk_locale':
                        $stmt->bindValue($identifier, $this->fk_locale, PDO::PARAM_INT);

                        break;
                    case 'fk_user':
                        $stmt->bindValue($identifier, $this->fk_user, PDO::PARAM_INT);

                        break;
                    case 'anonymized_at':
                        $stmt->bindValue($identifier, $this->anonymized_at ? $this->anonymized_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'company':
                        $stmt->bindValue($identifier, $this->company, PDO::PARAM_STR);

                        break;
                    case 'customer_reference':
                        $stmt->bindValue($identifier, $this->customer_reference, PDO::PARAM_STR);

                        break;
                    case 'date_of_birth':
                        $stmt->bindValue($identifier, $this->date_of_birth ? $this->date_of_birth->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'default_billing_address':
                        $stmt->bindValue($identifier, $this->default_billing_address, PDO::PARAM_INT);

                        break;
                    case 'default_shipping_address':
                        $stmt->bindValue($identifier, $this->default_shipping_address, PDO::PARAM_INT);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_INT);

                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);

                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);

                        break;
                    case 'registered':
                        $stmt->bindValue($identifier, $this->registered ? $this->registered->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'registration_key':
                        $stmt->bindValue($identifier, $this->registration_key, PDO::PARAM_STR);

                        break;
                    case 'restore_password_date':
                        $stmt->bindValue($identifier, $this->restore_password_date ? $this->restore_password_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'restore_password_key':
                        $stmt->bindValue($identifier, $this->restore_password_key, PDO::PARAM_STR);

                        break;
                    case 'salutation':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_customer_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCustomer($pk);

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
        $pos = SpyCustomerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCustomer();

            case 1:
                return $this->getFkLocale();

            case 2:
                return $this->getFkUser();

            case 3:
                return $this->getAnonymizedAt();

            case 4:
                return $this->getCompany();

            case 5:
                return $this->getCustomerReference();

            case 6:
                return $this->getDateOfBirth();

            case 7:
                return $this->getDefaultBillingAddress();

            case 8:
                return $this->getDefaultShippingAddress();

            case 9:
                return $this->getEmail();

            case 10:
                return $this->getFirstName();

            case 11:
                return $this->getGender();

            case 12:
                return $this->getLastName();

            case 13:
                return $this->getPassword();

            case 14:
                return $this->getPhone();

            case 15:
                return $this->getRegistered();

            case 16:
                return $this->getRegistrationKey();

            case 17:
                return $this->getRestorePasswordDate();

            case 18:
                return $this->getRestorePasswordKey();

            case 19:
                return $this->getSalutation();

            case 20:
                return $this->getCreatedAt();

            case 21:
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
        if (isset($alreadyDumpedObjects['SpyCustomer'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCustomer'][$this->hashCode()] = true;
        $keys = SpyCustomerTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCustomer(),
            $keys[1] => $this->getFkLocale(),
            $keys[2] => $this->getFkUser(),
            $keys[3] => $this->getAnonymizedAt(),
            $keys[4] => $this->getCompany(),
            $keys[5] => $this->getCustomerReference(),
            $keys[6] => $this->getDateOfBirth(),
            $keys[7] => $this->getDefaultBillingAddress(),
            $keys[8] => $this->getDefaultShippingAddress(),
            $keys[9] => $this->getEmail(),
            $keys[10] => $this->getFirstName(),
            $keys[11] => $this->getGender(),
            $keys[12] => $this->getLastName(),
            $keys[13] => $this->getPassword(),
            $keys[14] => $this->getPhone(),
            $keys[15] => $this->getRegistered(),
            $keys[16] => $this->getRegistrationKey(),
            $keys[17] => $this->getRestorePasswordDate(),
            $keys[18] => $this->getRestorePasswordKey(),
            $keys[19] => $this->getSalutation(),
            $keys[20] => $this->getCreatedAt(),
            $keys[21] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_user';
                        break;
                    default:
                        $key = 'SpyUser';
                }

                $result[$key] = $this->aSpyUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBillingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_address';
                        break;
                    default:
                        $key = 'BillingAddress';
                }

                $result[$key] = $this->aBillingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShippingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_address';
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
            if (null !== $this->collSpyComments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyComments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_comments';
                        break;
                    default:
                        $key = 'SpyComments';
                }

                $result[$key] = $this->collSpyComments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_users';
                        break;
                    default:
                        $key = 'CompanyUsers';
                }

                $result[$key] = $this->collCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_addresses';
                        break;
                    default:
                        $key = 'Addresses';
                }

                $result[$key] = $this->collAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomerDataChangeRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerDataChangeRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_data_change_requests';
                        break;
                    default:
                        $key = 'CustomerDataChangeRequests';
                }

                $result[$key] = $this->collCustomerDataChangeRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCustomerDiscounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerDiscounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_discounts';
                        break;
                    default:
                        $key = 'SpyCustomerDiscounts';
                }

                $result[$key] = $this->collSpyCustomerDiscounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCustomerGroupToCustomers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerGroupToCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_group_to_customers';
                        break;
                    default:
                        $key = 'SpyCustomerGroupToCustomers';
                }

                $result[$key] = $this->collSpyCustomerGroupToCustomers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomerNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerNotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_notes';
                        break;
                    default:
                        $key = 'CustomerNotes';
                }

                $result[$key] = $this->collCustomerNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCustomerMultiFactorAuths) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerMultiFactorAuths';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_multi_factor_auths';
                        break;
                    default:
                        $key = 'SpyCustomerMultiFactorAuths';
                }

                $result[$key] = $this->collSpyCustomerMultiFactorAuths->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyNewsletterSubscribers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNewsletterSubscribers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_newsletter_subscribers';
                        break;
                    default:
                        $key = 'SpyNewsletterSubscribers';
                }

                $result[$key] = $this->collSpyNewsletterSubscribers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductCustomerPermissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductCustomerPermissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_customer_permissions';
                        break;
                    default:
                        $key = 'SpyProductCustomerPermissions';
                }

                $result[$key] = $this->collSpyProductCustomerPermissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCustomerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCustomer($value);
                break;
            case 1:
                $this->setFkLocale($value);
                break;
            case 2:
                $this->setFkUser($value);
                break;
            case 3:
                $this->setAnonymizedAt($value);
                break;
            case 4:
                $this->setCompany($value);
                break;
            case 5:
                $this->setCustomerReference($value);
                break;
            case 6:
                $this->setDateOfBirth($value);
                break;
            case 7:
                $this->setDefaultBillingAddress($value);
                break;
            case 8:
                $this->setDefaultShippingAddress($value);
                break;
            case 9:
                $this->setEmail($value);
                break;
            case 10:
                $this->setFirstName($value);
                break;
            case 11:
                $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setGender($value);
                break;
            case 12:
                $this->setLastName($value);
                break;
            case 13:
                $this->setPassword($value);
                break;
            case 14:
                $this->setPhone($value);
                break;
            case 15:
                $this->setRegistered($value);
                break;
            case 16:
                $this->setRegistrationKey($value);
                break;
            case 17:
                $this->setRestorePasswordDate($value);
                break;
            case 18:
                $this->setRestorePasswordKey($value);
                break;
            case 19:
                $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSalutation($value);
                break;
            case 20:
                $this->setCreatedAt($value);
                break;
            case 21:
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
        $keys = SpyCustomerTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCustomer($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkLocale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkUser($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAnonymizedAt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCompany($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCustomerReference($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDateOfBirth($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDefaultBillingAddress($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDefaultShippingAddress($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEmail($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFirstName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setGender($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLastName($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPassword($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPhone($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setRegistered($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setRegistrationKey($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setRestorePasswordDate($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setRestorePasswordKey($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setSalutation($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setCreatedAt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setUpdatedAt($arr[$keys[21]]);
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
        $criteria = new Criteria(SpyCustomerTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCustomerTableMap::COL_ID_CUSTOMER)) {
            $criteria->add(SpyCustomerTableMap::COL_ID_CUSTOMER, $this->id_customer);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_LOCALE)) {
            $criteria->add(SpyCustomerTableMap::COL_FK_LOCALE, $this->fk_locale);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_USER)) {
            $criteria->add(SpyCustomerTableMap::COL_FK_USER, $this->fk_user);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ANONYMIZED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_ANONYMIZED_AT, $this->anonymized_at);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_COMPANY)) {
            $criteria->add(SpyCustomerTableMap::COL_COMPANY, $this->company);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE)) {
            $criteria->add(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE, $this->customer_reference);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DATE_OF_BIRTH)) {
            $criteria->add(SpyCustomerTableMap::COL_DATE_OF_BIRTH, $this->date_of_birth);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $criteria->add(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS, $this->default_billing_address);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS)) {
            $criteria->add(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS, $this->default_shipping_address);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_EMAIL)) {
            $criteria->add(SpyCustomerTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FIRST_NAME)) {
            $criteria->add(SpyCustomerTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GENDER)) {
            $criteria->add(SpyCustomerTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_LAST_NAME)) {
            $criteria->add(SpyCustomerTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PASSWORD)) {
            $criteria->add(SpyCustomerTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PHONE)) {
            $criteria->add(SpyCustomerTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTERED)) {
            $criteria->add(SpyCustomerTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTRATION_KEY)) {
            $criteria->add(SpyCustomerTableMap::COL_REGISTRATION_KEY, $this->registration_key);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE)) {
            $criteria->add(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE, $this->restore_password_date);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY)) {
            $criteria->add(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY, $this->restore_password_key);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_SALUTATION)) {
            $criteria->add(SpyCustomerTableMap::COL_SALUTATION, $this->salutation);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyCustomerQuery::create();
        $criteria->add(SpyCustomerTableMap::COL_ID_CUSTOMER, $this->id_customer);

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
        $validPk = null !== $this->getIdCustomer();

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
        return $this->getIdCustomer();
    }

    /**
     * Generic method to set the primary key (id_customer column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCustomer($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCustomer();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Customer\Persistence\SpyCustomer (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkLocale($this->getFkLocale());
        $copyObj->setFkUser($this->getFkUser());
        $copyObj->setAnonymizedAt($this->getAnonymizedAt());
        $copyObj->setCompany($this->getCompany());
        $copyObj->setCustomerReference($this->getCustomerReference());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setDefaultBillingAddress($this->getDefaultBillingAddress());
        $copyObj->setDefaultShippingAddress($this->getDefaultShippingAddress());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setGender($this->getGender());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setRegistrationKey($this->getRegistrationKey());
        $copyObj->setRestorePasswordDate($this->getRestorePasswordDate());
        $copyObj->setRestorePasswordKey($this->getRestorePasswordKey());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomerDataChangeRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerDataChangeRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCustomerDiscounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomerDiscount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCustomerGroupToCustomers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomerGroupToCustomer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomerNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCustomerMultiFactorAuths() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomerMultiFactorAuth($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyNewsletterSubscribers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyNewsletterSubscriber($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductCustomerPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductCustomerPermission($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCustomer(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer Clone of current object.
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
     * Declares an association between this object and a SpyUser object.
     *
     * @param SpyUser|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyUser(SpyUser $v = null)
    {
        if ($v === null) {
            $this->setFkUser(NULL);
        } else {
            $this->setFkUser($v->getIdUser());
        }

        $this->aSpyUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyUser object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCustomer($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyUser object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyUser|null The associated SpyUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUser(?ConnectionInterface $con = null)
    {
        if ($this->aSpyUser === null && ($this->fk_user != 0)) {
            $this->aSpyUser = SpyUserQuery::create()->findPk($this->fk_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyUser->addSpyCustomers($this);
             */
        }

        return $this->aSpyUser;
    }

    /**
     * Declares an association between this object and a ChildSpyCustomerAddress object.
     *
     * @param ChildSpyCustomerAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBillingAddress(ChildSpyCustomerAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultBillingAddress(NULL);
        } else {
            $this->setDefaultBillingAddress($v->getIdCustomerAddress());
        }

        $this->aBillingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomerAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerBillingAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomerAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomerAddress|null The associated ChildSpyCustomerAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBillingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aBillingAddress === null && ($this->default_billing_address != 0)) {
            $this->aBillingAddress = ChildSpyCustomerAddressQuery::create()->findPk($this->default_billing_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBillingAddress->addCustomerBillingAddresses($this);
             */
        }

        return $this->aBillingAddress;
    }

    /**
     * Declares an association between this object and a ChildSpyCustomerAddress object.
     *
     * @param ChildSpyCustomerAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setShippingAddress(ChildSpyCustomerAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultShippingAddress(NULL);
        } else {
            $this->setDefaultShippingAddress($v->getIdCustomerAddress());
        }

        $this->aShippingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomerAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerShippingAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomerAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomerAddress|null The associated ChildSpyCustomerAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aShippingAddress === null && ($this->default_shipping_address != 0)) {
            $this->aShippingAddress = ChildSpyCustomerAddressQuery::create()->findPk($this->default_shipping_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShippingAddress->addCustomerShippingAddresses($this);
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
            $v->addSpyCustomer($this);
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
                $this->aLocale->addSpyCustomers($this);
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
        if ('SpyComment' === $relationName) {
            $this->initSpyComments();
            return;
        }
        if ('CompanyUser' === $relationName) {
            $this->initCompanyUsers();
            return;
        }
        if ('Address' === $relationName) {
            $this->initAddresses();
            return;
        }
        if ('CustomerDataChangeRequest' === $relationName) {
            $this->initCustomerDataChangeRequests();
            return;
        }
        if ('SpyCustomerDiscount' === $relationName) {
            $this->initSpyCustomerDiscounts();
            return;
        }
        if ('SpyCustomerGroupToCustomer' === $relationName) {
            $this->initSpyCustomerGroupToCustomers();
            return;
        }
        if ('CustomerNote' === $relationName) {
            $this->initCustomerNotes();
            return;
        }
        if ('SpyCustomerMultiFactorAuth' === $relationName) {
            $this->initSpyCustomerMultiFactorAuths();
            return;
        }
        if ('SpyNewsletterSubscriber' === $relationName) {
            $this->initSpyNewsletterSubscribers();
            return;
        }
        if ('SpyProductCustomerPermission' === $relationName) {
            $this->initSpyProductCustomerPermissions();
            return;
        }
    }

    /**
     * Clears out the collSpyComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyComments()
     */
    public function clearSpyComments()
    {
        $this->collSpyComments = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyComments collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyComments($v = true): void
    {
        $this->collSpyCommentsPartial = $v;
    }

    /**
     * Initializes the collSpyComments collection.
     *
     * By default this just sets the collSpyComments collection to an empty array (like clearcollSpyComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyComments(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyComments && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCommentTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyComments = new $collectionClassName;
        $this->collSpyComments->setModel('\Orm\Zed\Comment\Persistence\SpyComment');
    }

    /**
     * Gets an array of SpyComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyComment[] List of SpyComment objects
     * @phpstan-return ObjectCollection&\Traversable<SpyComment> List of SpyComment objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyComments(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCommentsPartial && !$this->isNew();
        if (null === $this->collSpyComments || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyComments) {
                    $this->initSpyComments();
                } else {
                    $collectionClassName = SpyCommentTableMap::getTableMap()->getCollectionClassName();

                    $collSpyComments = new $collectionClassName;
                    $collSpyComments->setModel('\Orm\Zed\Comment\Persistence\SpyComment');

                    return $collSpyComments;
                }
            } else {
                $collSpyComments = SpyCommentQuery::create(null, $criteria)
                    ->filterBySpyCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCommentsPartial && count($collSpyComments)) {
                        $this->initSpyComments(false);

                        foreach ($collSpyComments as $obj) {
                            if (false == $this->collSpyComments->contains($obj)) {
                                $this->collSpyComments->append($obj);
                            }
                        }

                        $this->collSpyCommentsPartial = true;
                    }

                    return $collSpyComments;
                }

                if ($partial && $this->collSpyComments) {
                    foreach ($this->collSpyComments as $obj) {
                        if ($obj->isNew()) {
                            $collSpyComments[] = $obj;
                        }
                    }
                }

                $this->collSpyComments = $collSpyComments;
                $this->collSpyCommentsPartial = false;
            }
        }

        return $this->collSpyComments;
    }

    /**
     * Sets a collection of SpyComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyComments A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyComments(Collection $spyComments, ?ConnectionInterface $con = null)
    {
        /** @var SpyComment[] $spyCommentsToDelete */
        $spyCommentsToDelete = $this->getSpyComments(new Criteria(), $con)->diff($spyComments);


        $this->spyCommentsScheduledForDeletion = $spyCommentsToDelete;

        foreach ($spyCommentsToDelete as $spyCommentRemoved) {
            $spyCommentRemoved->setSpyCustomer(null);
        }

        $this->collSpyComments = null;
        foreach ($spyComments as $spyComment) {
            $this->addSpyComment($spyComment);
        }

        $this->collSpyComments = $spyComments;
        $this->collSpyCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyComment objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyComment objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyComments(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCommentsPartial && !$this->isNew();
        if (null === $this->collSpyComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyComments());
            }

            $query = SpyCommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCustomer($this)
                ->count($con);
        }

        return count($this->collSpyComments);
    }

    /**
     * Method called to associate a SpyComment object to this object
     * through the SpyComment foreign key attribute.
     *
     * @param SpyComment $l SpyComment
     * @return $this The current object (for fluent API support)
     */
    public function addSpyComment(SpyComment $l)
    {
        if ($this->collSpyComments === null) {
            $this->initSpyComments();
            $this->collSpyCommentsPartial = true;
        }

        if (!$this->collSpyComments->contains($l)) {
            $this->doAddSpyComment($l);

            if ($this->spyCommentsScheduledForDeletion and $this->spyCommentsScheduledForDeletion->contains($l)) {
                $this->spyCommentsScheduledForDeletion->remove($this->spyCommentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyComment $spyComment The SpyComment object to add.
     */
    protected function doAddSpyComment(SpyComment $spyComment): void
    {
        $this->collSpyComments[]= $spyComment;
        $spyComment->setSpyCustomer($this);
    }

    /**
     * @param SpyComment $spyComment The SpyComment object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyComment(SpyComment $spyComment)
    {
        if ($this->getSpyComments()->contains($spyComment)) {
            $pos = $this->collSpyComments->search($spyComment);
            $this->collSpyComments->remove($pos);
            if (null === $this->spyCommentsScheduledForDeletion) {
                $this->spyCommentsScheduledForDeletion = clone $this->collSpyComments;
                $this->spyCommentsScheduledForDeletion->clear();
            }
            $this->spyCommentsScheduledForDeletion[]= $spyComment;
            $spyComment->setSpyCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related SpyComments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyComment[] List of SpyComment objects
     * @phpstan-return ObjectCollection&\Traversable<SpyComment}> List of SpyComment objects
     */
    public function getSpyCommentsJoinUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCommentQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getSpyComments($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related SpyComments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyComment[] List of SpyComment objects
     * @phpstan-return ObjectCollection&\Traversable<SpyComment}> List of SpyComment objects
     */
    public function getSpyCommentsJoinSpyCommentThread(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCommentQuery::create(null, $criteria);
        $query->joinWith('SpyCommentThread', $joinBehavior);

        return $this->getSpyComments($query, $con);
    }

    /**
     * Clears out the collCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyUsers()
     */
    public function clearCompanyUsers()
    {
        $this->collCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyUsers($v = true): void
    {
        $this->collCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collCompanyUsers collection.
     *
     * By default this just sets the collCompanyUsers collection to an empty array (like clearcollCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyUsers = new $collectionClassName;
        $this->collCompanyUsers->setModel('\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser');
    }

    /**
     * Gets an array of SpyCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser> List of SpyCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyUsersPartial && !$this->isNew();
        if (null === $this->collCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyUsers) {
                    $this->initCompanyUsers();
                } else {
                    $collectionClassName = SpyCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyUsers = new $collectionClassName;
                    $collCompanyUsers->setModel('\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser');

                    return $collCompanyUsers;
                }
            } else {
                $collCompanyUsers = SpyCompanyUserQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyUsersPartial && count($collCompanyUsers)) {
                        $this->initCompanyUsers(false);

                        foreach ($collCompanyUsers as $obj) {
                            if (false == $this->collCompanyUsers->contains($obj)) {
                                $this->collCompanyUsers->append($obj);
                            }
                        }

                        $this->collCompanyUsersPartial = true;
                    }

                    return $collCompanyUsers;
                }

                if ($partial && $this->collCompanyUsers) {
                    foreach ($this->collCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collCompanyUsers = $collCompanyUsers;
                $this->collCompanyUsersPartial = false;
            }
        }

        return $this->collCompanyUsers;
    }

    /**
     * Sets a collection of SpyCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyUsers(Collection $companyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUser[] $companyUsersToDelete */
        $companyUsersToDelete = $this->getCompanyUsers(new Criteria(), $con)->diff($companyUsers);


        $this->companyUsersScheduledForDeletion = $companyUsersToDelete;

        foreach ($companyUsersToDelete as $companyUserRemoved) {
            $companyUserRemoved->setCustomer(null);
        }

        $this->collCompanyUsers = null;
        foreach ($companyUsers as $companyUser) {
            $this->addCompanyUser($companyUser);
        }

        $this->collCompanyUsers = $companyUsers;
        $this->collCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyUsersPartial && !$this->isNew();
        if (null === $this->collCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyUsers());
            }

            $query = SpyCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collCompanyUsers);
    }

    /**
     * Method called to associate a SpyCompanyUser object to this object
     * through the SpyCompanyUser foreign key attribute.
     *
     * @param SpyCompanyUser $l SpyCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyUser(SpyCompanyUser $l)
    {
        if ($this->collCompanyUsers === null) {
            $this->initCompanyUsers();
            $this->collCompanyUsersPartial = true;
        }

        if (!$this->collCompanyUsers->contains($l)) {
            $this->doAddCompanyUser($l);

            if ($this->companyUsersScheduledForDeletion and $this->companyUsersScheduledForDeletion->contains($l)) {
                $this->companyUsersScheduledForDeletion->remove($this->companyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUser $companyUser The SpyCompanyUser object to add.
     */
    protected function doAddCompanyUser(SpyCompanyUser $companyUser): void
    {
        $this->collCompanyUsers[]= $companyUser;
        $companyUser->setCustomer($this);
    }

    /**
     * @param SpyCompanyUser $companyUser The SpyCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyUser(SpyCompanyUser $companyUser)
    {
        if ($this->getCompanyUsers()->contains($companyUser)) {
            $pos = $this->collCompanyUsers->search($companyUser);
            $this->collCompanyUsers->remove($pos);
            if (null === $this->companyUsersScheduledForDeletion) {
                $this->companyUsersScheduledForDeletion = clone $this->collCompanyUsers;
                $this->companyUsersScheduledForDeletion->clear();
            }
            $this->companyUsersScheduledForDeletion[]= clone $companyUser;
            $companyUser->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser}> List of SpyCompanyUser objects
     */
    public function getCompanyUsersJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser}> List of SpyCompanyUser objects
     */
    public function getCompanyUsersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCompanyUsers($query, $con);
    }

    /**
     * Clears out the collAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAddresses()
     */
    public function clearAddresses()
    {
        $this->collAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAddresses($v = true): void
    {
        $this->collAddressesPartial = $v;
    }

    /**
     * Initializes the collAddresses collection.
     *
     * By default this just sets the collAddresses collection to an empty array (like clearcollAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collAddresses = new $collectionClassName;
        $this->collAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');
    }

    /**
     * Gets an array of ChildSpyCustomerAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress> List of ChildSpyCustomerAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAddressesPartial && !$this->isNew();
        if (null === $this->collAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAddresses) {
                    $this->initAddresses();
                } else {
                    $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

                    $collAddresses = new $collectionClassName;
                    $collAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');

                    return $collAddresses;
                }
            } else {
                $collAddresses = ChildSpyCustomerAddressQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAddressesPartial && count($collAddresses)) {
                        $this->initAddresses(false);

                        foreach ($collAddresses as $obj) {
                            if (false == $this->collAddresses->contains($obj)) {
                                $this->collAddresses->append($obj);
                            }
                        }

                        $this->collAddressesPartial = true;
                    }

                    return $collAddresses;
                }

                if ($partial && $this->collAddresses) {
                    foreach ($this->collAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collAddresses[] = $obj;
                        }
                    }
                }

                $this->collAddresses = $collAddresses;
                $this->collAddressesPartial = false;
            }
        }

        return $this->collAddresses;
    }

    /**
     * Sets a collection of ChildSpyCustomerAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $addresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAddresses(Collection $addresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCustomerAddress[] $addressesToDelete */
        $addressesToDelete = $this->getAddresses(new Criteria(), $con)->diff($addresses);


        $this->addressesScheduledForDeletion = $addressesToDelete;

        foreach ($addressesToDelete as $addressRemoved) {
            $addressRemoved->setCustomer(null);
        }

        $this->collAddresses = null;
        foreach ($addresses as $address) {
            $this->addAddress($address);
        }

        $this->collAddresses = $addresses;
        $this->collAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCustomerAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCustomerAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAddressesPartial && !$this->isNew();
        if (null === $this->collAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAddresses());
            }

            $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collAddresses);
    }

    /**
     * Method called to associate a ChildSpyCustomerAddress object to this object
     * through the ChildSpyCustomerAddress foreign key attribute.
     *
     * @param ChildSpyCustomerAddress $l ChildSpyCustomerAddress
     * @return $this The current object (for fluent API support)
     */
    public function addAddress(ChildSpyCustomerAddress $l)
    {
        if ($this->collAddresses === null) {
            $this->initAddresses();
            $this->collAddressesPartial = true;
        }

        if (!$this->collAddresses->contains($l)) {
            $this->doAddAddress($l);

            if ($this->addressesScheduledForDeletion and $this->addressesScheduledForDeletion->contains($l)) {
                $this->addressesScheduledForDeletion->remove($this->addressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCustomerAddress $address The ChildSpyCustomerAddress object to add.
     */
    protected function doAddAddress(ChildSpyCustomerAddress $address): void
    {
        $this->collAddresses[]= $address;
        $address->setCustomer($this);
    }

    /**
     * @param ChildSpyCustomerAddress $address The ChildSpyCustomerAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAddress(ChildSpyCustomerAddress $address)
    {
        if ($this->getAddresses()->contains($address)) {
            $pos = $this->collAddresses->search($address);
            $this->collAddresses->remove($pos);
            if (null === $this->addressesScheduledForDeletion) {
                $this->addressesScheduledForDeletion = clone $this->collAddresses;
                $this->addressesScheduledForDeletion->clear();
            }
            $this->addressesScheduledForDeletion[]= clone $address;
            $address->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related Addresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress}> List of ChildSpyCustomerAddress objects
     */
    public function getAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related Addresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress}> List of ChildSpyCustomerAddress objects
     */
    public function getAddressesJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getAddresses($query, $con);
    }

    /**
     * Clears out the collCustomerDataChangeRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerDataChangeRequests()
     */
    public function clearCustomerDataChangeRequests()
    {
        $this->collCustomerDataChangeRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerDataChangeRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerDataChangeRequests($v = true): void
    {
        $this->collCustomerDataChangeRequestsPartial = $v;
    }

    /**
     * Initializes the collCustomerDataChangeRequests collection.
     *
     * By default this just sets the collCustomerDataChangeRequests collection to an empty array (like clearcollCustomerDataChangeRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerDataChangeRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerDataChangeRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerDataChangeRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerDataChangeRequests = new $collectionClassName;
        $this->collCustomerDataChangeRequests->setModel('\Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequest');
    }

    /**
     * Gets an array of SpyCustomerDataChangeRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerDataChangeRequest[] List of SpyCustomerDataChangeRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerDataChangeRequest> List of SpyCustomerDataChangeRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerDataChangeRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerDataChangeRequestsPartial && !$this->isNew();
        if (null === $this->collCustomerDataChangeRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerDataChangeRequests) {
                    $this->initCustomerDataChangeRequests();
                } else {
                    $collectionClassName = SpyCustomerDataChangeRequestTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerDataChangeRequests = new $collectionClassName;
                    $collCustomerDataChangeRequests->setModel('\Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequest');

                    return $collCustomerDataChangeRequests;
                }
            } else {
                $collCustomerDataChangeRequests = SpyCustomerDataChangeRequestQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerDataChangeRequestsPartial && count($collCustomerDataChangeRequests)) {
                        $this->initCustomerDataChangeRequests(false);

                        foreach ($collCustomerDataChangeRequests as $obj) {
                            if (false == $this->collCustomerDataChangeRequests->contains($obj)) {
                                $this->collCustomerDataChangeRequests->append($obj);
                            }
                        }

                        $this->collCustomerDataChangeRequestsPartial = true;
                    }

                    return $collCustomerDataChangeRequests;
                }

                if ($partial && $this->collCustomerDataChangeRequests) {
                    foreach ($this->collCustomerDataChangeRequests as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerDataChangeRequests[] = $obj;
                        }
                    }
                }

                $this->collCustomerDataChangeRequests = $collCustomerDataChangeRequests;
                $this->collCustomerDataChangeRequestsPartial = false;
            }
        }

        return $this->collCustomerDataChangeRequests;
    }

    /**
     * Sets a collection of SpyCustomerDataChangeRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerDataChangeRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerDataChangeRequests(Collection $customerDataChangeRequests, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerDataChangeRequest[] $customerDataChangeRequestsToDelete */
        $customerDataChangeRequestsToDelete = $this->getCustomerDataChangeRequests(new Criteria(), $con)->diff($customerDataChangeRequests);


        $this->customerDataChangeRequestsScheduledForDeletion = $customerDataChangeRequestsToDelete;

        foreach ($customerDataChangeRequestsToDelete as $customerDataChangeRequestRemoved) {
            $customerDataChangeRequestRemoved->setCustomer(null);
        }

        $this->collCustomerDataChangeRequests = null;
        foreach ($customerDataChangeRequests as $customerDataChangeRequest) {
            $this->addCustomerDataChangeRequest($customerDataChangeRequest);
        }

        $this->collCustomerDataChangeRequests = $customerDataChangeRequests;
        $this->collCustomerDataChangeRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerDataChangeRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerDataChangeRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerDataChangeRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerDataChangeRequestsPartial && !$this->isNew();
        if (null === $this->collCustomerDataChangeRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerDataChangeRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerDataChangeRequests());
            }

            $query = SpyCustomerDataChangeRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collCustomerDataChangeRequests);
    }

    /**
     * Method called to associate a SpyCustomerDataChangeRequest object to this object
     * through the SpyCustomerDataChangeRequest foreign key attribute.
     *
     * @param SpyCustomerDataChangeRequest $l SpyCustomerDataChangeRequest
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerDataChangeRequest(SpyCustomerDataChangeRequest $l)
    {
        if ($this->collCustomerDataChangeRequests === null) {
            $this->initCustomerDataChangeRequests();
            $this->collCustomerDataChangeRequestsPartial = true;
        }

        if (!$this->collCustomerDataChangeRequests->contains($l)) {
            $this->doAddCustomerDataChangeRequest($l);

            if ($this->customerDataChangeRequestsScheduledForDeletion and $this->customerDataChangeRequestsScheduledForDeletion->contains($l)) {
                $this->customerDataChangeRequestsScheduledForDeletion->remove($this->customerDataChangeRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerDataChangeRequest $customerDataChangeRequest The SpyCustomerDataChangeRequest object to add.
     */
    protected function doAddCustomerDataChangeRequest(SpyCustomerDataChangeRequest $customerDataChangeRequest): void
    {
        $this->collCustomerDataChangeRequests[]= $customerDataChangeRequest;
        $customerDataChangeRequest->setCustomer($this);
    }

    /**
     * @param SpyCustomerDataChangeRequest $customerDataChangeRequest The SpyCustomerDataChangeRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerDataChangeRequest(SpyCustomerDataChangeRequest $customerDataChangeRequest)
    {
        if ($this->getCustomerDataChangeRequests()->contains($customerDataChangeRequest)) {
            $pos = $this->collCustomerDataChangeRequests->search($customerDataChangeRequest);
            $this->collCustomerDataChangeRequests->remove($pos);
            if (null === $this->customerDataChangeRequestsScheduledForDeletion) {
                $this->customerDataChangeRequestsScheduledForDeletion = clone $this->collCustomerDataChangeRequests;
                $this->customerDataChangeRequestsScheduledForDeletion->clear();
            }
            $this->customerDataChangeRequestsScheduledForDeletion[]= clone $customerDataChangeRequest;
            $customerDataChangeRequest->setCustomer(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyCustomerDiscounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomerDiscounts()
     */
    public function clearSpyCustomerDiscounts()
    {
        $this->collSpyCustomerDiscounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomerDiscounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomerDiscounts($v = true): void
    {
        $this->collSpyCustomerDiscountsPartial = $v;
    }

    /**
     * Initializes the collSpyCustomerDiscounts collection.
     *
     * By default this just sets the collSpyCustomerDiscounts collection to an empty array (like clearcollSpyCustomerDiscounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomerDiscounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomerDiscounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerDiscountTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomerDiscounts = new $collectionClassName;
        $this->collSpyCustomerDiscounts->setModel('\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount');
    }

    /**
     * Gets an array of SpyCustomerDiscount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerDiscount[] List of SpyCustomerDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerDiscount> List of SpyCustomerDiscount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomerDiscounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomerDiscountsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerDiscounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomerDiscounts) {
                    $this->initSpyCustomerDiscounts();
                } else {
                    $collectionClassName = SpyCustomerDiscountTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomerDiscounts = new $collectionClassName;
                    $collSpyCustomerDiscounts->setModel('\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount');

                    return $collSpyCustomerDiscounts;
                }
            } else {
                $collSpyCustomerDiscounts = SpyCustomerDiscountQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomerDiscountsPartial && count($collSpyCustomerDiscounts)) {
                        $this->initSpyCustomerDiscounts(false);

                        foreach ($collSpyCustomerDiscounts as $obj) {
                            if (false == $this->collSpyCustomerDiscounts->contains($obj)) {
                                $this->collSpyCustomerDiscounts->append($obj);
                            }
                        }

                        $this->collSpyCustomerDiscountsPartial = true;
                    }

                    return $collSpyCustomerDiscounts;
                }

                if ($partial && $this->collSpyCustomerDiscounts) {
                    foreach ($this->collSpyCustomerDiscounts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomerDiscounts[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomerDiscounts = $collSpyCustomerDiscounts;
                $this->collSpyCustomerDiscountsPartial = false;
            }
        }

        return $this->collSpyCustomerDiscounts;
    }

    /**
     * Sets a collection of SpyCustomerDiscount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomerDiscounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomerDiscounts(Collection $spyCustomerDiscounts, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerDiscount[] $spyCustomerDiscountsToDelete */
        $spyCustomerDiscountsToDelete = $this->getSpyCustomerDiscounts(new Criteria(), $con)->diff($spyCustomerDiscounts);


        $this->spyCustomerDiscountsScheduledForDeletion = $spyCustomerDiscountsToDelete;

        foreach ($spyCustomerDiscountsToDelete as $spyCustomerDiscountRemoved) {
            $spyCustomerDiscountRemoved->setCustomer(null);
        }

        $this->collSpyCustomerDiscounts = null;
        foreach ($spyCustomerDiscounts as $spyCustomerDiscount) {
            $this->addSpyCustomerDiscount($spyCustomerDiscount);
        }

        $this->collSpyCustomerDiscounts = $spyCustomerDiscounts;
        $this->collSpyCustomerDiscountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerDiscount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerDiscount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomerDiscounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomerDiscountsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerDiscounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomerDiscounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomerDiscounts());
            }

            $query = SpyCustomerDiscountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collSpyCustomerDiscounts);
    }

    /**
     * Method called to associate a SpyCustomerDiscount object to this object
     * through the SpyCustomerDiscount foreign key attribute.
     *
     * @param SpyCustomerDiscount $l SpyCustomerDiscount
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomerDiscount(SpyCustomerDiscount $l)
    {
        if ($this->collSpyCustomerDiscounts === null) {
            $this->initSpyCustomerDiscounts();
            $this->collSpyCustomerDiscountsPartial = true;
        }

        if (!$this->collSpyCustomerDiscounts->contains($l)) {
            $this->doAddSpyCustomerDiscount($l);

            if ($this->spyCustomerDiscountsScheduledForDeletion and $this->spyCustomerDiscountsScheduledForDeletion->contains($l)) {
                $this->spyCustomerDiscountsScheduledForDeletion->remove($this->spyCustomerDiscountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerDiscount $spyCustomerDiscount The SpyCustomerDiscount object to add.
     */
    protected function doAddSpyCustomerDiscount(SpyCustomerDiscount $spyCustomerDiscount): void
    {
        $this->collSpyCustomerDiscounts[]= $spyCustomerDiscount;
        $spyCustomerDiscount->setCustomer($this);
    }

    /**
     * @param SpyCustomerDiscount $spyCustomerDiscount The SpyCustomerDiscount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomerDiscount(SpyCustomerDiscount $spyCustomerDiscount)
    {
        if ($this->getSpyCustomerDiscounts()->contains($spyCustomerDiscount)) {
            $pos = $this->collSpyCustomerDiscounts->search($spyCustomerDiscount);
            $this->collSpyCustomerDiscounts->remove($pos);
            if (null === $this->spyCustomerDiscountsScheduledForDeletion) {
                $this->spyCustomerDiscountsScheduledForDeletion = clone $this->collSpyCustomerDiscounts;
                $this->spyCustomerDiscountsScheduledForDeletion->clear();
            }
            $this->spyCustomerDiscountsScheduledForDeletion[]= clone $spyCustomerDiscount;
            $spyCustomerDiscount->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related SpyCustomerDiscounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerDiscount[] List of SpyCustomerDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerDiscount}> List of SpyCustomerDiscount objects
     */
    public function getSpyCustomerDiscountsJoinDiscount(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerDiscountQuery::create(null, $criteria);
        $query->joinWith('Discount', $joinBehavior);

        return $this->getSpyCustomerDiscounts($query, $con);
    }

    /**
     * Clears out the collSpyCustomerGroupToCustomers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomerGroupToCustomers()
     */
    public function clearSpyCustomerGroupToCustomers()
    {
        $this->collSpyCustomerGroupToCustomers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomerGroupToCustomers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomerGroupToCustomers($v = true): void
    {
        $this->collSpyCustomerGroupToCustomersPartial = $v;
    }

    /**
     * Initializes the collSpyCustomerGroupToCustomers collection.
     *
     * By default this just sets the collSpyCustomerGroupToCustomers collection to an empty array (like clearcollSpyCustomerGroupToCustomers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomerGroupToCustomers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomerGroupToCustomers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerGroupToCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomerGroupToCustomers = new $collectionClassName;
        $this->collSpyCustomerGroupToCustomers->setModel('\Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer');
    }

    /**
     * Gets an array of SpyCustomerGroupToCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerGroupToCustomer[] List of SpyCustomerGroupToCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerGroupToCustomer> List of SpyCustomerGroupToCustomer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomerGroupToCustomers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomerGroupToCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomerGroupToCustomers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomerGroupToCustomers) {
                    $this->initSpyCustomerGroupToCustomers();
                } else {
                    $collectionClassName = SpyCustomerGroupToCustomerTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomerGroupToCustomers = new $collectionClassName;
                    $collSpyCustomerGroupToCustomers->setModel('\Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer');

                    return $collSpyCustomerGroupToCustomers;
                }
            } else {
                $collSpyCustomerGroupToCustomers = SpyCustomerGroupToCustomerQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomerGroupToCustomersPartial && count($collSpyCustomerGroupToCustomers)) {
                        $this->initSpyCustomerGroupToCustomers(false);

                        foreach ($collSpyCustomerGroupToCustomers as $obj) {
                            if (false == $this->collSpyCustomerGroupToCustomers->contains($obj)) {
                                $this->collSpyCustomerGroupToCustomers->append($obj);
                            }
                        }

                        $this->collSpyCustomerGroupToCustomersPartial = true;
                    }

                    return $collSpyCustomerGroupToCustomers;
                }

                if ($partial && $this->collSpyCustomerGroupToCustomers) {
                    foreach ($this->collSpyCustomerGroupToCustomers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomerGroupToCustomers[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomerGroupToCustomers = $collSpyCustomerGroupToCustomers;
                $this->collSpyCustomerGroupToCustomersPartial = false;
            }
        }

        return $this->collSpyCustomerGroupToCustomers;
    }

    /**
     * Sets a collection of SpyCustomerGroupToCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomerGroupToCustomers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomerGroupToCustomers(Collection $spyCustomerGroupToCustomers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerGroupToCustomer[] $spyCustomerGroupToCustomersToDelete */
        $spyCustomerGroupToCustomersToDelete = $this->getSpyCustomerGroupToCustomers(new Criteria(), $con)->diff($spyCustomerGroupToCustomers);


        $this->spyCustomerGroupToCustomersScheduledForDeletion = $spyCustomerGroupToCustomersToDelete;

        foreach ($spyCustomerGroupToCustomersToDelete as $spyCustomerGroupToCustomerRemoved) {
            $spyCustomerGroupToCustomerRemoved->setCustomer(null);
        }

        $this->collSpyCustomerGroupToCustomers = null;
        foreach ($spyCustomerGroupToCustomers as $spyCustomerGroupToCustomer) {
            $this->addSpyCustomerGroupToCustomer($spyCustomerGroupToCustomer);
        }

        $this->collSpyCustomerGroupToCustomers = $spyCustomerGroupToCustomers;
        $this->collSpyCustomerGroupToCustomersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerGroupToCustomer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerGroupToCustomer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomerGroupToCustomers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomerGroupToCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomerGroupToCustomers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomerGroupToCustomers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomerGroupToCustomers());
            }

            $query = SpyCustomerGroupToCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collSpyCustomerGroupToCustomers);
    }

    /**
     * Method called to associate a SpyCustomerGroupToCustomer object to this object
     * through the SpyCustomerGroupToCustomer foreign key attribute.
     *
     * @param SpyCustomerGroupToCustomer $l SpyCustomerGroupToCustomer
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomerGroupToCustomer(SpyCustomerGroupToCustomer $l)
    {
        if ($this->collSpyCustomerGroupToCustomers === null) {
            $this->initSpyCustomerGroupToCustomers();
            $this->collSpyCustomerGroupToCustomersPartial = true;
        }

        if (!$this->collSpyCustomerGroupToCustomers->contains($l)) {
            $this->doAddSpyCustomerGroupToCustomer($l);

            if ($this->spyCustomerGroupToCustomersScheduledForDeletion and $this->spyCustomerGroupToCustomersScheduledForDeletion->contains($l)) {
                $this->spyCustomerGroupToCustomersScheduledForDeletion->remove($this->spyCustomerGroupToCustomersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer The SpyCustomerGroupToCustomer object to add.
     */
    protected function doAddSpyCustomerGroupToCustomer(SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer): void
    {
        $this->collSpyCustomerGroupToCustomers[]= $spyCustomerGroupToCustomer;
        $spyCustomerGroupToCustomer->setCustomer($this);
    }

    /**
     * @param SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer The SpyCustomerGroupToCustomer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomerGroupToCustomer(SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer)
    {
        if ($this->getSpyCustomerGroupToCustomers()->contains($spyCustomerGroupToCustomer)) {
            $pos = $this->collSpyCustomerGroupToCustomers->search($spyCustomerGroupToCustomer);
            $this->collSpyCustomerGroupToCustomers->remove($pos);
            if (null === $this->spyCustomerGroupToCustomersScheduledForDeletion) {
                $this->spyCustomerGroupToCustomersScheduledForDeletion = clone $this->collSpyCustomerGroupToCustomers;
                $this->spyCustomerGroupToCustomersScheduledForDeletion->clear();
            }
            $this->spyCustomerGroupToCustomersScheduledForDeletion[]= clone $spyCustomerGroupToCustomer;
            $spyCustomerGroupToCustomer->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related SpyCustomerGroupToCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerGroupToCustomer[] List of SpyCustomerGroupToCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerGroupToCustomer}> List of SpyCustomerGroupToCustomer objects
     */
    public function getSpyCustomerGroupToCustomersJoinCustomerGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerGroupToCustomerQuery::create(null, $criteria);
        $query->joinWith('CustomerGroup', $joinBehavior);

        return $this->getSpyCustomerGroupToCustomers($query, $con);
    }

    /**
     * Clears out the collCustomerNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerNotes()
     */
    public function clearCustomerNotes()
    {
        $this->collCustomerNotes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerNotes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerNotes($v = true): void
    {
        $this->collCustomerNotesPartial = $v;
    }

    /**
     * Initializes the collCustomerNotes collection.
     *
     * By default this just sets the collCustomerNotes collection to an empty array (like clearcollCustomerNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerNotes(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerNoteTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerNotes = new $collectionClassName;
        $this->collCustomerNotes->setModel('\Orm\Zed\CustomerNote\Persistence\SpyCustomerNote');
    }

    /**
     * Gets an array of SpyCustomerNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerNote[] List of SpyCustomerNote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerNote> List of SpyCustomerNote objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerNotes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerNotesPartial && !$this->isNew();
        if (null === $this->collCustomerNotes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerNotes) {
                    $this->initCustomerNotes();
                } else {
                    $collectionClassName = SpyCustomerNoteTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerNotes = new $collectionClassName;
                    $collCustomerNotes->setModel('\Orm\Zed\CustomerNote\Persistence\SpyCustomerNote');

                    return $collCustomerNotes;
                }
            } else {
                $collCustomerNotes = SpyCustomerNoteQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerNotesPartial && count($collCustomerNotes)) {
                        $this->initCustomerNotes(false);

                        foreach ($collCustomerNotes as $obj) {
                            if (false == $this->collCustomerNotes->contains($obj)) {
                                $this->collCustomerNotes->append($obj);
                            }
                        }

                        $this->collCustomerNotesPartial = true;
                    }

                    return $collCustomerNotes;
                }

                if ($partial && $this->collCustomerNotes) {
                    foreach ($this->collCustomerNotes as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerNotes[] = $obj;
                        }
                    }
                }

                $this->collCustomerNotes = $collCustomerNotes;
                $this->collCustomerNotesPartial = false;
            }
        }

        return $this->collCustomerNotes;
    }

    /**
     * Sets a collection of SpyCustomerNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerNotes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerNotes(Collection $customerNotes, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerNote[] $customerNotesToDelete */
        $customerNotesToDelete = $this->getCustomerNotes(new Criteria(), $con)->diff($customerNotes);


        $this->customerNotesScheduledForDeletion = $customerNotesToDelete;

        foreach ($customerNotesToDelete as $customerNoteRemoved) {
            $customerNoteRemoved->setCustomer(null);
        }

        $this->collCustomerNotes = null;
        foreach ($customerNotes as $customerNote) {
            $this->addCustomerNote($customerNote);
        }

        $this->collCustomerNotes = $customerNotes;
        $this->collCustomerNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerNote objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerNote objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerNotes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerNotesPartial && !$this->isNew();
        if (null === $this->collCustomerNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerNotes());
            }

            $query = SpyCustomerNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collCustomerNotes);
    }

    /**
     * Method called to associate a SpyCustomerNote object to this object
     * through the SpyCustomerNote foreign key attribute.
     *
     * @param SpyCustomerNote $l SpyCustomerNote
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerNote(SpyCustomerNote $l)
    {
        if ($this->collCustomerNotes === null) {
            $this->initCustomerNotes();
            $this->collCustomerNotesPartial = true;
        }

        if (!$this->collCustomerNotes->contains($l)) {
            $this->doAddCustomerNote($l);

            if ($this->customerNotesScheduledForDeletion and $this->customerNotesScheduledForDeletion->contains($l)) {
                $this->customerNotesScheduledForDeletion->remove($this->customerNotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerNote $customerNote The SpyCustomerNote object to add.
     */
    protected function doAddCustomerNote(SpyCustomerNote $customerNote): void
    {
        $this->collCustomerNotes[]= $customerNote;
        $customerNote->setCustomer($this);
    }

    /**
     * @param SpyCustomerNote $customerNote The SpyCustomerNote object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerNote(SpyCustomerNote $customerNote)
    {
        if ($this->getCustomerNotes()->contains($customerNote)) {
            $pos = $this->collCustomerNotes->search($customerNote);
            $this->collCustomerNotes->remove($pos);
            if (null === $this->customerNotesScheduledForDeletion) {
                $this->customerNotesScheduledForDeletion = clone $this->collCustomerNotes;
                $this->customerNotesScheduledForDeletion->clear();
            }
            $this->customerNotesScheduledForDeletion[]= clone $customerNote;
            $customerNote->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related CustomerNotes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerNote[] List of SpyCustomerNote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerNote}> List of SpyCustomerNote objects
     */
    public function getCustomerNotesJoinUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerNoteQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getCustomerNotes($query, $con);
    }

    /**
     * Clears out the collSpyCustomerMultiFactorAuths collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomerMultiFactorAuths()
     */
    public function clearSpyCustomerMultiFactorAuths()
    {
        $this->collSpyCustomerMultiFactorAuths = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomerMultiFactorAuths collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomerMultiFactorAuths($v = true): void
    {
        $this->collSpyCustomerMultiFactorAuthsPartial = $v;
    }

    /**
     * Initializes the collSpyCustomerMultiFactorAuths collection.
     *
     * By default this just sets the collSpyCustomerMultiFactorAuths collection to an empty array (like clearcollSpyCustomerMultiFactorAuths());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomerMultiFactorAuths(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomerMultiFactorAuths && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerMultiFactorAuthTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomerMultiFactorAuths = new $collectionClassName;
        $this->collSpyCustomerMultiFactorAuths->setModel('\Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuth');
    }

    /**
     * Gets an array of SpyCustomerMultiFactorAuth objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerMultiFactorAuth[] List of SpyCustomerMultiFactorAuth objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerMultiFactorAuth> List of SpyCustomerMultiFactorAuth objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomerMultiFactorAuths(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomerMultiFactorAuthsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerMultiFactorAuths || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomerMultiFactorAuths) {
                    $this->initSpyCustomerMultiFactorAuths();
                } else {
                    $collectionClassName = SpyCustomerMultiFactorAuthTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomerMultiFactorAuths = new $collectionClassName;
                    $collSpyCustomerMultiFactorAuths->setModel('\Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuth');

                    return $collSpyCustomerMultiFactorAuths;
                }
            } else {
                $collSpyCustomerMultiFactorAuths = SpyCustomerMultiFactorAuthQuery::create(null, $criteria)
                    ->filterBySpyCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomerMultiFactorAuthsPartial && count($collSpyCustomerMultiFactorAuths)) {
                        $this->initSpyCustomerMultiFactorAuths(false);

                        foreach ($collSpyCustomerMultiFactorAuths as $obj) {
                            if (false == $this->collSpyCustomerMultiFactorAuths->contains($obj)) {
                                $this->collSpyCustomerMultiFactorAuths->append($obj);
                            }
                        }

                        $this->collSpyCustomerMultiFactorAuthsPartial = true;
                    }

                    return $collSpyCustomerMultiFactorAuths;
                }

                if ($partial && $this->collSpyCustomerMultiFactorAuths) {
                    foreach ($this->collSpyCustomerMultiFactorAuths as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomerMultiFactorAuths[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomerMultiFactorAuths = $collSpyCustomerMultiFactorAuths;
                $this->collSpyCustomerMultiFactorAuthsPartial = false;
            }
        }

        return $this->collSpyCustomerMultiFactorAuths;
    }

    /**
     * Sets a collection of SpyCustomerMultiFactorAuth objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomerMultiFactorAuths A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomerMultiFactorAuths(Collection $spyCustomerMultiFactorAuths, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerMultiFactorAuth[] $spyCustomerMultiFactorAuthsToDelete */
        $spyCustomerMultiFactorAuthsToDelete = $this->getSpyCustomerMultiFactorAuths(new Criteria(), $con)->diff($spyCustomerMultiFactorAuths);


        $this->spyCustomerMultiFactorAuthsScheduledForDeletion = $spyCustomerMultiFactorAuthsToDelete;

        foreach ($spyCustomerMultiFactorAuthsToDelete as $spyCustomerMultiFactorAuthRemoved) {
            $spyCustomerMultiFactorAuthRemoved->setSpyCustomer(null);
        }

        $this->collSpyCustomerMultiFactorAuths = null;
        foreach ($spyCustomerMultiFactorAuths as $spyCustomerMultiFactorAuth) {
            $this->addSpyCustomerMultiFactorAuth($spyCustomerMultiFactorAuth);
        }

        $this->collSpyCustomerMultiFactorAuths = $spyCustomerMultiFactorAuths;
        $this->collSpyCustomerMultiFactorAuthsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerMultiFactorAuth objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerMultiFactorAuth objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomerMultiFactorAuths(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomerMultiFactorAuthsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerMultiFactorAuths || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomerMultiFactorAuths) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomerMultiFactorAuths());
            }

            $query = SpyCustomerMultiFactorAuthQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCustomer($this)
                ->count($con);
        }

        return count($this->collSpyCustomerMultiFactorAuths);
    }

    /**
     * Method called to associate a SpyCustomerMultiFactorAuth object to this object
     * through the SpyCustomerMultiFactorAuth foreign key attribute.
     *
     * @param SpyCustomerMultiFactorAuth $l SpyCustomerMultiFactorAuth
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomerMultiFactorAuth(SpyCustomerMultiFactorAuth $l)
    {
        if ($this->collSpyCustomerMultiFactorAuths === null) {
            $this->initSpyCustomerMultiFactorAuths();
            $this->collSpyCustomerMultiFactorAuthsPartial = true;
        }

        if (!$this->collSpyCustomerMultiFactorAuths->contains($l)) {
            $this->doAddSpyCustomerMultiFactorAuth($l);

            if ($this->spyCustomerMultiFactorAuthsScheduledForDeletion and $this->spyCustomerMultiFactorAuthsScheduledForDeletion->contains($l)) {
                $this->spyCustomerMultiFactorAuthsScheduledForDeletion->remove($this->spyCustomerMultiFactorAuthsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerMultiFactorAuth $spyCustomerMultiFactorAuth The SpyCustomerMultiFactorAuth object to add.
     */
    protected function doAddSpyCustomerMultiFactorAuth(SpyCustomerMultiFactorAuth $spyCustomerMultiFactorAuth): void
    {
        $this->collSpyCustomerMultiFactorAuths[]= $spyCustomerMultiFactorAuth;
        $spyCustomerMultiFactorAuth->setSpyCustomer($this);
    }

    /**
     * @param SpyCustomerMultiFactorAuth $spyCustomerMultiFactorAuth The SpyCustomerMultiFactorAuth object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomerMultiFactorAuth(SpyCustomerMultiFactorAuth $spyCustomerMultiFactorAuth)
    {
        if ($this->getSpyCustomerMultiFactorAuths()->contains($spyCustomerMultiFactorAuth)) {
            $pos = $this->collSpyCustomerMultiFactorAuths->search($spyCustomerMultiFactorAuth);
            $this->collSpyCustomerMultiFactorAuths->remove($pos);
            if (null === $this->spyCustomerMultiFactorAuthsScheduledForDeletion) {
                $this->spyCustomerMultiFactorAuthsScheduledForDeletion = clone $this->collSpyCustomerMultiFactorAuths;
                $this->spyCustomerMultiFactorAuthsScheduledForDeletion->clear();
            }
            $this->spyCustomerMultiFactorAuthsScheduledForDeletion[]= clone $spyCustomerMultiFactorAuth;
            $spyCustomerMultiFactorAuth->setSpyCustomer(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyNewsletterSubscribers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyNewsletterSubscribers()
     */
    public function clearSpyNewsletterSubscribers()
    {
        $this->collSpyNewsletterSubscribers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyNewsletterSubscribers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyNewsletterSubscribers($v = true): void
    {
        $this->collSpyNewsletterSubscribersPartial = $v;
    }

    /**
     * Initializes the collSpyNewsletterSubscribers collection.
     *
     * By default this just sets the collSpyNewsletterSubscribers collection to an empty array (like clearcollSpyNewsletterSubscribers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyNewsletterSubscribers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyNewsletterSubscribers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyNewsletterSubscriberTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyNewsletterSubscribers = new $collectionClassName;
        $this->collSpyNewsletterSubscribers->setModel('\Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber');
    }

    /**
     * Gets an array of SpyNewsletterSubscriber objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyNewsletterSubscriber[] List of SpyNewsletterSubscriber objects
     * @phpstan-return ObjectCollection&\Traversable<SpyNewsletterSubscriber> List of SpyNewsletterSubscriber objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyNewsletterSubscribers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyNewsletterSubscribersPartial && !$this->isNew();
        if (null === $this->collSpyNewsletterSubscribers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyNewsletterSubscribers) {
                    $this->initSpyNewsletterSubscribers();
                } else {
                    $collectionClassName = SpyNewsletterSubscriberTableMap::getTableMap()->getCollectionClassName();

                    $collSpyNewsletterSubscribers = new $collectionClassName;
                    $collSpyNewsletterSubscribers->setModel('\Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber');

                    return $collSpyNewsletterSubscribers;
                }
            } else {
                $collSpyNewsletterSubscribers = SpyNewsletterSubscriberQuery::create(null, $criteria)
                    ->filterBySpyCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyNewsletterSubscribersPartial && count($collSpyNewsletterSubscribers)) {
                        $this->initSpyNewsletterSubscribers(false);

                        foreach ($collSpyNewsletterSubscribers as $obj) {
                            if (false == $this->collSpyNewsletterSubscribers->contains($obj)) {
                                $this->collSpyNewsletterSubscribers->append($obj);
                            }
                        }

                        $this->collSpyNewsletterSubscribersPartial = true;
                    }

                    return $collSpyNewsletterSubscribers;
                }

                if ($partial && $this->collSpyNewsletterSubscribers) {
                    foreach ($this->collSpyNewsletterSubscribers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyNewsletterSubscribers[] = $obj;
                        }
                    }
                }

                $this->collSpyNewsletterSubscribers = $collSpyNewsletterSubscribers;
                $this->collSpyNewsletterSubscribersPartial = false;
            }
        }

        return $this->collSpyNewsletterSubscribers;
    }

    /**
     * Sets a collection of SpyNewsletterSubscriber objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyNewsletterSubscribers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyNewsletterSubscribers(Collection $spyNewsletterSubscribers, ?ConnectionInterface $con = null)
    {
        /** @var SpyNewsletterSubscriber[] $spyNewsletterSubscribersToDelete */
        $spyNewsletterSubscribersToDelete = $this->getSpyNewsletterSubscribers(new Criteria(), $con)->diff($spyNewsletterSubscribers);


        $this->spyNewsletterSubscribersScheduledForDeletion = $spyNewsletterSubscribersToDelete;

        foreach ($spyNewsletterSubscribersToDelete as $spyNewsletterSubscriberRemoved) {
            $spyNewsletterSubscriberRemoved->setSpyCustomer(null);
        }

        $this->collSpyNewsletterSubscribers = null;
        foreach ($spyNewsletterSubscribers as $spyNewsletterSubscriber) {
            $this->addSpyNewsletterSubscriber($spyNewsletterSubscriber);
        }

        $this->collSpyNewsletterSubscribers = $spyNewsletterSubscribers;
        $this->collSpyNewsletterSubscribersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyNewsletterSubscriber objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyNewsletterSubscriber objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyNewsletterSubscribers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyNewsletterSubscribersPartial && !$this->isNew();
        if (null === $this->collSpyNewsletterSubscribers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyNewsletterSubscribers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyNewsletterSubscribers());
            }

            $query = SpyNewsletterSubscriberQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCustomer($this)
                ->count($con);
        }

        return count($this->collSpyNewsletterSubscribers);
    }

    /**
     * Method called to associate a SpyNewsletterSubscriber object to this object
     * through the SpyNewsletterSubscriber foreign key attribute.
     *
     * @param SpyNewsletterSubscriber $l SpyNewsletterSubscriber
     * @return $this The current object (for fluent API support)
     */
    public function addSpyNewsletterSubscriber(SpyNewsletterSubscriber $l)
    {
        if ($this->collSpyNewsletterSubscribers === null) {
            $this->initSpyNewsletterSubscribers();
            $this->collSpyNewsletterSubscribersPartial = true;
        }

        if (!$this->collSpyNewsletterSubscribers->contains($l)) {
            $this->doAddSpyNewsletterSubscriber($l);

            if ($this->spyNewsletterSubscribersScheduledForDeletion and $this->spyNewsletterSubscribersScheduledForDeletion->contains($l)) {
                $this->spyNewsletterSubscribersScheduledForDeletion->remove($this->spyNewsletterSubscribersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyNewsletterSubscriber $spyNewsletterSubscriber The SpyNewsletterSubscriber object to add.
     */
    protected function doAddSpyNewsletterSubscriber(SpyNewsletterSubscriber $spyNewsletterSubscriber): void
    {
        $this->collSpyNewsletterSubscribers[]= $spyNewsletterSubscriber;
        $spyNewsletterSubscriber->setSpyCustomer($this);
    }

    /**
     * @param SpyNewsletterSubscriber $spyNewsletterSubscriber The SpyNewsletterSubscriber object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyNewsletterSubscriber(SpyNewsletterSubscriber $spyNewsletterSubscriber)
    {
        if ($this->getSpyNewsletterSubscribers()->contains($spyNewsletterSubscriber)) {
            $pos = $this->collSpyNewsletterSubscribers->search($spyNewsletterSubscriber);
            $this->collSpyNewsletterSubscribers->remove($pos);
            if (null === $this->spyNewsletterSubscribersScheduledForDeletion) {
                $this->spyNewsletterSubscribersScheduledForDeletion = clone $this->collSpyNewsletterSubscribers;
                $this->spyNewsletterSubscribersScheduledForDeletion->clear();
            }
            $this->spyNewsletterSubscribersScheduledForDeletion[]= $spyNewsletterSubscriber;
            $spyNewsletterSubscriber->setSpyCustomer(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductCustomerPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductCustomerPermissions()
     */
    public function clearSpyProductCustomerPermissions()
    {
        $this->collSpyProductCustomerPermissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductCustomerPermissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductCustomerPermissions($v = true): void
    {
        $this->collSpyProductCustomerPermissionsPartial = $v;
    }

    /**
     * Initializes the collSpyProductCustomerPermissions collection.
     *
     * By default this just sets the collSpyProductCustomerPermissions collection to an empty array (like clearcollSpyProductCustomerPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductCustomerPermissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductCustomerPermissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductCustomerPermissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductCustomerPermissions = new $collectionClassName;
        $this->collSpyProductCustomerPermissions->setModel('\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission');
    }

    /**
     * Gets an array of SpyProductCustomerPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductCustomerPermission[] List of SpyProductCustomerPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCustomerPermission> List of SpyProductCustomerPermission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductCustomerPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductCustomerPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyProductCustomerPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductCustomerPermissions) {
                    $this->initSpyProductCustomerPermissions();
                } else {
                    $collectionClassName = SpyProductCustomerPermissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductCustomerPermissions = new $collectionClassName;
                    $collSpyProductCustomerPermissions->setModel('\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission');

                    return $collSpyProductCustomerPermissions;
                }
            } else {
                $collSpyProductCustomerPermissions = SpyProductCustomerPermissionQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductCustomerPermissionsPartial && count($collSpyProductCustomerPermissions)) {
                        $this->initSpyProductCustomerPermissions(false);

                        foreach ($collSpyProductCustomerPermissions as $obj) {
                            if (false == $this->collSpyProductCustomerPermissions->contains($obj)) {
                                $this->collSpyProductCustomerPermissions->append($obj);
                            }
                        }

                        $this->collSpyProductCustomerPermissionsPartial = true;
                    }

                    return $collSpyProductCustomerPermissions;
                }

                if ($partial && $this->collSpyProductCustomerPermissions) {
                    foreach ($this->collSpyProductCustomerPermissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductCustomerPermissions[] = $obj;
                        }
                    }
                }

                $this->collSpyProductCustomerPermissions = $collSpyProductCustomerPermissions;
                $this->collSpyProductCustomerPermissionsPartial = false;
            }
        }

        return $this->collSpyProductCustomerPermissions;
    }

    /**
     * Sets a collection of SpyProductCustomerPermission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductCustomerPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductCustomerPermissions(Collection $spyProductCustomerPermissions, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductCustomerPermission[] $spyProductCustomerPermissionsToDelete */
        $spyProductCustomerPermissionsToDelete = $this->getSpyProductCustomerPermissions(new Criteria(), $con)->diff($spyProductCustomerPermissions);


        $this->spyProductCustomerPermissionsScheduledForDeletion = $spyProductCustomerPermissionsToDelete;

        foreach ($spyProductCustomerPermissionsToDelete as $spyProductCustomerPermissionRemoved) {
            $spyProductCustomerPermissionRemoved->setCustomer(null);
        }

        $this->collSpyProductCustomerPermissions = null;
        foreach ($spyProductCustomerPermissions as $spyProductCustomerPermission) {
            $this->addSpyProductCustomerPermission($spyProductCustomerPermission);
        }

        $this->collSpyProductCustomerPermissions = $spyProductCustomerPermissions;
        $this->collSpyProductCustomerPermissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductCustomerPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductCustomerPermission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductCustomerPermissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductCustomerPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyProductCustomerPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductCustomerPermissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductCustomerPermissions());
            }

            $query = SpyProductCustomerPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collSpyProductCustomerPermissions);
    }

    /**
     * Method called to associate a SpyProductCustomerPermission object to this object
     * through the SpyProductCustomerPermission foreign key attribute.
     *
     * @param SpyProductCustomerPermission $l SpyProductCustomerPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductCustomerPermission(SpyProductCustomerPermission $l)
    {
        if ($this->collSpyProductCustomerPermissions === null) {
            $this->initSpyProductCustomerPermissions();
            $this->collSpyProductCustomerPermissionsPartial = true;
        }

        if (!$this->collSpyProductCustomerPermissions->contains($l)) {
            $this->doAddSpyProductCustomerPermission($l);

            if ($this->spyProductCustomerPermissionsScheduledForDeletion and $this->spyProductCustomerPermissionsScheduledForDeletion->contains($l)) {
                $this->spyProductCustomerPermissionsScheduledForDeletion->remove($this->spyProductCustomerPermissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductCustomerPermission $spyProductCustomerPermission The SpyProductCustomerPermission object to add.
     */
    protected function doAddSpyProductCustomerPermission(SpyProductCustomerPermission $spyProductCustomerPermission): void
    {
        $this->collSpyProductCustomerPermissions[]= $spyProductCustomerPermission;
        $spyProductCustomerPermission->setCustomer($this);
    }

    /**
     * @param SpyProductCustomerPermission $spyProductCustomerPermission The SpyProductCustomerPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductCustomerPermission(SpyProductCustomerPermission $spyProductCustomerPermission)
    {
        if ($this->getSpyProductCustomerPermissions()->contains($spyProductCustomerPermission)) {
            $pos = $this->collSpyProductCustomerPermissions->search($spyProductCustomerPermission);
            $this->collSpyProductCustomerPermissions->remove($pos);
            if (null === $this->spyProductCustomerPermissionsScheduledForDeletion) {
                $this->spyProductCustomerPermissionsScheduledForDeletion = clone $this->collSpyProductCustomerPermissions;
                $this->spyProductCustomerPermissionsScheduledForDeletion->clear();
            }
            $this->spyProductCustomerPermissionsScheduledForDeletion[]= clone $spyProductCustomerPermission;
            $spyProductCustomerPermission->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related SpyProductCustomerPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductCustomerPermission[] List of SpyProductCustomerPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCustomerPermission}> List of SpyProductCustomerPermission objects
     */
    public function getSpyProductCustomerPermissionsJoinProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductCustomerPermissionQuery::create(null, $criteria);
        $query->joinWith('ProductAbstract', $joinBehavior);

        return $this->getSpyProductCustomerPermissions($query, $con);
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
        if (null !== $this->aSpyUser) {
            $this->aSpyUser->removeSpyCustomer($this);
        }
        if (null !== $this->aBillingAddress) {
            $this->aBillingAddress->removeCustomerBillingAddress($this);
        }
        if (null !== $this->aShippingAddress) {
            $this->aShippingAddress->removeCustomerShippingAddress($this);
        }
        if (null !== $this->aLocale) {
            $this->aLocale->removeSpyCustomer($this);
        }
        $this->id_customer = null;
        $this->fk_locale = null;
        $this->fk_user = null;
        $this->anonymized_at = null;
        $this->company = null;
        $this->customer_reference = null;
        $this->date_of_birth = null;
        $this->default_billing_address = null;
        $this->default_shipping_address = null;
        $this->email = null;
        $this->first_name = null;
        $this->gender = null;
        $this->last_name = null;
        $this->password = null;
        $this->phone = null;
        $this->registered = null;
        $this->registration_key = null;
        $this->restore_password_date = null;
        $this->restore_password_key = null;
        $this->salutation = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collSpyComments) {
                foreach ($this->collSpyComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyUsers) {
                foreach ($this->collCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAddresses) {
                foreach ($this->collAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomerDataChangeRequests) {
                foreach ($this->collCustomerDataChangeRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCustomerDiscounts) {
                foreach ($this->collSpyCustomerDiscounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCustomerGroupToCustomers) {
                foreach ($this->collSpyCustomerGroupToCustomers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomerNotes) {
                foreach ($this->collCustomerNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCustomerMultiFactorAuths) {
                foreach ($this->collSpyCustomerMultiFactorAuths as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyNewsletterSubscribers) {
                foreach ($this->collSpyNewsletterSubscribers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductCustomerPermissions) {
                foreach ($this->collSpyProductCustomerPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyComments = null;
        $this->collCompanyUsers = null;
        $this->collAddresses = null;
        $this->collCustomerDataChangeRequests = null;
        $this->collSpyCustomerDiscounts = null;
        $this->collSpyCustomerGroupToCustomers = null;
        $this->collCustomerNotes = null;
        $this->collSpyCustomerMultiFactorAuths = null;
        $this->collSpyNewsletterSubscribers = null;
        $this->collSpyProductCustomerPermissions = null;
        $this->aSpyUser = null;
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
        return (string) $this->exportTo(SpyCustomerTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyCustomerTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_customer.create';
        } else {
            $this->_eventName = 'Entity.spy_customer.update';
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

        if ($this->_eventName !== 'Entity.spy_customer.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_customer',
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
            'name' => 'spy_customer',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_customer.delete',
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
                'spy_customer.anonymized_at' => [
                    'column' => 'anonymized_at',
                ],
                'spy_customer.password' => [
                    'column' => 'password',
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
                $field = str_replace('spy_customer.', '', $modifiedColumn);
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
            $field = str_replace('spy_customer.', '', $modifiedColumn);
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
            $field = str_replace('spy_customer.', '', $additionalValueColumnName);
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
        $columnType = SpyCustomerTableMap::getTableMap()->getColumn($column)->getType();
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
