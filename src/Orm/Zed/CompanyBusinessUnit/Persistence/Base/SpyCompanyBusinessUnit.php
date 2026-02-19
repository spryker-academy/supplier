<?php

namespace Orm\Zed\CompanyBusinessUnit\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit as ChildSpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery as ChildSpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddressToCompanyBusinessUnit as BaseSpyCompanyUnitAddressToCompanyBusinessUnit;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressToCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery;
use Orm\Zed\CompanyUserInvitation\Persistence\Base\SpyCompanyUserInvitation as BaseSpyCompanyUserInvitation;
use Orm\Zed\CompanyUserInvitation\Persistence\Map\SpyCompanyUserInvitationTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUser as BaseSpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequest as BaseSpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequestToCompanyBusinessUnit as BaseSpyMerchantRelationRequestToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestToCompanyBusinessUnitTableMap;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery;
use Orm\Zed\MerchantRelationship\Persistence\Base\SpyMerchantRelationship as BaseSpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\Base\SpyMerchantRelationshipToCompanyBusinessUnit as BaseSpyMerchantRelationshipToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipTableMap;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipToCompanyBusinessUnitTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpyCompanyBusinessUnitFile as BaseSpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspAsset as BaseSpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspAssetToCompanyBusinessUnit as BaseSpySspAssetToCompanyBusinessUnit;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpyCompanyBusinessUnitFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetToCompanyBusinessUnitTableMap;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery;
use Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListCompanyBusinessUnit as BaseSpyShoppingListCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyBusinessUnitTableMap;
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
 * Base class that represents a row from the 'spy_company_business_unit' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CompanyBusinessUnit.Persistence.Base
 */
abstract class SpyCompanyBusinessUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\Map\\SpyCompanyBusinessUnitTableMap';


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
     * The value for the id_company_business_unit field.
     *
     * @var        int
     */
    protected $id_company_business_unit;

    /**
     * The value for the fk_company field.
     *
     * @var        int
     */
    protected $fk_company;

    /**
     * The value for the fk_parent_company_business_unit field.
     *
     * @var        int|null
     */
    protected $fk_parent_company_business_unit;

    /**
     * The value for the bic field.
     * The Business Identifier Code for a bank account.
     * @var        string|null
     */
    protected $bic;

    /**
     * The value for the default_billing_address field.
     * The identifier for the default billing address.
     * @var        int|null
     */
    protected $default_billing_address;

    /**
     * The value for the email field.
     * The email address of a user or contact.
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the external_url field.
     * An external URL, often for more details or an external resource.
     * @var        string|null
     */
    protected $external_url;

    /**
     * The value for the iban field.
     * The International Bank Account Number.
     * @var        string|null
     */
    protected $iban;

    /**
     * The value for the key field.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the phone field.
     * The phone number.
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        SpyCompany
     */
    protected $aCompany;

    /**
     * @var        ChildSpyCompanyBusinessUnit
     */
    protected $aParentCompanyBusinessUnit;

    /**
     * @var        SpyCompanyUnitAddress
     */
    protected $aCompanyBusinessUnitDefaultBillingAddress;

    /**
     * @var        ObjectCollection|ChildSpyCompanyBusinessUnit[] Collection to store aggregation of ChildSpyCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyBusinessUnit> Collection to store aggregation of ChildSpyCompanyBusinessUnit objects.
     */
    protected $collChildrenCompanyBusinessUnitss;
    protected $collChildrenCompanyBusinessUnitssPartial;

    /**
     * @var        ObjectCollection|SpyCompanyBusinessUnitFile[] Collection to store aggregation of SpyCompanyBusinessUnitFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile> Collection to store aggregation of SpyCompanyBusinessUnitFile objects.
     */
    protected $collSpyCompanyBusinessUnitFiles;
    protected $collSpyCompanyBusinessUnitFilesPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUnitAddressToCompanyBusinessUnit[] Collection to store aggregation of SpyCompanyUnitAddressToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddressToCompanyBusinessUnit> Collection to store aggregation of SpyCompanyUnitAddressToCompanyBusinessUnit objects.
     */
    protected $collSpyCompanyUnitAddressToCompanyBusinessUnits;
    protected $collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUser[] Collection to store aggregation of SpyCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser> Collection to store aggregation of SpyCompanyUser objects.
     */
    protected $collCompanyUsers;
    protected $collCompanyUsersPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUserInvitation[] Collection to store aggregation of SpyCompanyUserInvitation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserInvitation> Collection to store aggregation of SpyCompanyUserInvitation objects.
     */
    protected $collSpyCompanyUserInvitations;
    protected $collSpyCompanyUserInvitationsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationRequest[] Collection to store aggregation of SpyMerchantRelationRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest> Collection to store aggregation of SpyMerchantRelationRequest objects.
     */
    protected $collSpyMerchantRelationRequests;
    protected $collSpyMerchantRelationRequestsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationRequestToCompanyBusinessUnit[] Collection to store aggregation of SpyMerchantRelationRequestToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequestToCompanyBusinessUnit> Collection to store aggregation of SpyMerchantRelationRequestToCompanyBusinessUnit objects.
     */
    protected $collSpyMerchantRelationRequestToCompanyBusinessUnits;
    protected $collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationship[] Collection to store aggregation of SpyMerchantRelationship objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationship> Collection to store aggregation of SpyMerchantRelationship objects.
     */
    protected $collSpyMerchantRelationships;
    protected $collSpyMerchantRelationshipsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationshipToCompanyBusinessUnit[] Collection to store aggregation of SpyMerchantRelationshipToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationshipToCompanyBusinessUnit> Collection to store aggregation of SpyMerchantRelationshipToCompanyBusinessUnit objects.
     */
    protected $collSpyMerchantRelationshipToCompanyBusinessUnits;
    protected $collSpyMerchantRelationshipToCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpyShoppingListCompanyBusinessUnit[] Collection to store aggregation of SpyShoppingListCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnit> Collection to store aggregation of SpyShoppingListCompanyBusinessUnit objects.
     */
    protected $collSpyShoppingListCompanyBusinessUnits;
    protected $collSpyShoppingListCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpySspAsset[] Collection to store aggregation of SpySspAsset objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspAsset> Collection to store aggregation of SpySspAsset objects.
     */
    protected $collSpySspAssets;
    protected $collSpySspAssetsPartial;

    /**
     * @var        ObjectCollection|SpySspAssetToCompanyBusinessUnit[] Collection to store aggregation of SpySspAssetToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspAssetToCompanyBusinessUnit> Collection to store aggregation of SpySspAssetToCompanyBusinessUnit objects.
     */
    protected $collSpySspAssetToCompanyBusinessUnits;
    protected $collSpySspAssetToCompanyBusinessUnitsPartial;

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
     * @var ObjectCollection|ChildSpyCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyBusinessUnit>
     */
    protected $childrenCompanyBusinessUnitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyBusinessUnitFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile>
     */
    protected $spyCompanyBusinessUnitFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUnitAddressToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddressToCompanyBusinessUnit>
     */
    protected $spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser>
     */
    protected $companyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUserInvitation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserInvitation>
     */
    protected $spyCompanyUserInvitationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequest>
     */
    protected $spyMerchantRelationRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationRequestToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationRequestToCompanyBusinessUnit>
     */
    protected $spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationship[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationship>
     */
    protected $spyMerchantRelationshipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationshipToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationshipToCompanyBusinessUnit>
     */
    protected $spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnit>
     */
    protected $spyShoppingListCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspAsset[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspAsset>
     */
    protected $spySspAssetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspAssetToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspAssetToCompanyBusinessUnit>
     */
    protected $spySspAssetToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnit object.
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
     * Compares this with another <code>SpyCompanyBusinessUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCompanyBusinessUnit</code>, delegates to
     * <code>equals(SpyCompanyBusinessUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_company_business_unit] column value.
     *
     * @return int
     */
    public function getIdCompanyBusinessUnit()
    {
        return $this->id_company_business_unit;
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
     * Get the [fk_parent_company_business_unit] column value.
     *
     * @return int|null
     */
    public function getFkParentCompanyBusinessUnit()
    {
        return $this->fk_parent_company_business_unit;
    }

    /**
     * Get the [bic] column value.
     * The Business Identifier Code for a bank account.
     * @return string|null
     */
    public function getBic()
    {
        return $this->bic;
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
     * Get the [email] column value.
     * The email address of a user or contact.
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [external_url] column value.
     * An external URL, often for more details or an external resource.
     * @return string|null
     */
    public function getExternalUrl()
    {
        return $this->external_url;
    }

    /**
     * Get the [iban] column value.
     * The International Bank Account Number.
     * @return string|null
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Get the [key] column value.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
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
     * Get the [phone] column value.
     * The phone number.
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
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
     * Set the value of [id_company_business_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCompanyBusinessUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_company_business_unit !== $v) {
            $this->id_company_business_unit = $v;
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT] = true;
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getIdCompany() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_parent_company_business_unit] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkParentCompanyBusinessUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_parent_company_business_unit !== $v) {
            $this->fk_parent_company_business_unit = $v;
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT] = true;
        }

        if ($this->aParentCompanyBusinessUnit !== null && $this->aParentCompanyBusinessUnit->getIdCompanyBusinessUnit() !== $v) {
            $this->aParentCompanyBusinessUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [bic] column.
     * The Business Identifier Code for a bank account.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBic($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->bic !== $v) {
            $this->bic = $v;
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_BIC] = true;
        }

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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS] = true;
        }

        if ($this->aCompanyBusinessUnitDefaultBillingAddress !== null && $this->aCompanyBusinessUnitDefaultBillingAddress->getIdCompanyUnitAddress() !== $v) {
            $this->aCompanyBusinessUnitDefaultBillingAddress = null;
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [external_url] column.
     * An external URL, often for more details or an external resource.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExternalUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->external_url !== $v) {
            $this->external_url = $v;
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [iban] column.
     * The International Bank Account Number.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIban($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->iban !== $v) {
            $this->iban = $v;
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_IBAN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_PHONE] = true;
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
            $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_UUID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('FkCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('FkParentCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_parent_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Bic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bic = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('DefaultBillingAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_billing_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('ExternalUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->external_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Iban', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iban = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyCompanyBusinessUnitTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SpyCompanyBusinessUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit'), 0, $e);
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
        if ($this->aParentCompanyBusinessUnit !== null && $this->fk_parent_company_business_unit !== $this->aParentCompanyBusinessUnit->getIdCompanyBusinessUnit()) {
            $this->aParentCompanyBusinessUnit = null;
        }
        if ($this->aCompanyBusinessUnitDefaultBillingAddress !== null && $this->default_billing_address !== $this->aCompanyBusinessUnitDefaultBillingAddress->getIdCompanyUnitAddress()) {
            $this->aCompanyBusinessUnitDefaultBillingAddress = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCompanyBusinessUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aParentCompanyBusinessUnit = null;
            $this->aCompanyBusinessUnitDefaultBillingAddress = null;
            $this->collChildrenCompanyBusinessUnitss = null;

            $this->collSpyCompanyBusinessUnitFiles = null;

            $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;

            $this->collCompanyUsers = null;

            $this->collSpyCompanyUserInvitations = null;

            $this->collSpyMerchantRelationRequests = null;

            $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null;

            $this->collSpyMerchantRelationships = null;

            $this->collSpyMerchantRelationshipToCompanyBusinessUnits = null;

            $this->collSpyShoppingListCompanyBusinessUnits = null;

            $this->collSpySspAssets = null;

            $this->collSpySspAssetToCompanyBusinessUnits = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCompanyBusinessUnit::setDeleted()
     * @see SpyCompanyBusinessUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCompanyBusinessUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
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
                SpyCompanyBusinessUnitTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aParentCompanyBusinessUnit !== null) {
                if ($this->aParentCompanyBusinessUnit->isModified() || $this->aParentCompanyBusinessUnit->isNew()) {
                    $affectedRows += $this->aParentCompanyBusinessUnit->save($con);
                }
                $this->setParentCompanyBusinessUnit($this->aParentCompanyBusinessUnit);
            }

            if ($this->aCompanyBusinessUnitDefaultBillingAddress !== null) {
                if ($this->aCompanyBusinessUnitDefaultBillingAddress->isModified() || $this->aCompanyBusinessUnitDefaultBillingAddress->isNew()) {
                    $affectedRows += $this->aCompanyBusinessUnitDefaultBillingAddress->save($con);
                }
                $this->setCompanyBusinessUnitDefaultBillingAddress($this->aCompanyBusinessUnitDefaultBillingAddress);
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

            if ($this->childrenCompanyBusinessUnitssScheduledForDeletion !== null) {
                if (!$this->childrenCompanyBusinessUnitssScheduledForDeletion->isEmpty()) {
                    foreach ($this->childrenCompanyBusinessUnitssScheduledForDeletion as $childrenCompanyBusinessUnits) {
                        // need to save related object because we set the relation to null
                        $childrenCompanyBusinessUnits->save($con);
                    }
                    $this->childrenCompanyBusinessUnitssScheduledForDeletion = null;
                }
            }

            if ($this->collChildrenCompanyBusinessUnitss !== null) {
                foreach ($this->collChildrenCompanyBusinessUnitss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyBusinessUnitFilesScheduledForDeletion !== null) {
                if (!$this->spyCompanyBusinessUnitFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyBusinessUnitFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyBusinessUnitFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyBusinessUnitFiles !== null) {
                foreach ($this->collSpyCompanyBusinessUnitFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits !== null) {
                foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyUsersScheduledForDeletion !== null) {
                if (!$this->companyUsersScheduledForDeletion->isEmpty()) {
                    foreach ($this->companyUsersScheduledForDeletion as $companyUser) {
                        // need to save related object because we set the relation to null
                        $companyUser->save($con);
                    }
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

            if ($this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits !== null) {
                foreach ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits as $referrerFK) {
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

            if ($this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRelationshipToCompanyBusinessUnits !== null) {
                foreach ($this->collSpyMerchantRelationshipToCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyBusinessUnits !== null) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspAssetsScheduledForDeletion !== null) {
                if (!$this->spySspAssetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySspAssetsScheduledForDeletion as $spySspAsset) {
                        // need to save related object because we set the relation to null
                        $spySspAsset->save($con);
                    }
                    $this->spySspAssetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspAssets !== null) {
                foreach ($this->collSpySspAssets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspAssetToCompanyBusinessUnits !== null) {
                foreach ($this->collSpySspAssetToCompanyBusinessUnits as $referrerFK) {
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

        $this->modifiedColumns[SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT] = true;
        if (null !== $this->id_company_business_unit) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`id_company_business_unit`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_company`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_parent_company_business_unit`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_BIC)) {
            $modifiedColumns[':p' . $index++]  = '`bic`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`default_billing_address`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL)) {
            $modifiedColumns[':p' . $index++]  = '`external_url`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_IBAN)) {
            $modifiedColumns[':p' . $index++]  = '`iban`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_company_business_unit` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_company_business_unit`':
                        $stmt->bindValue($identifier, $this->id_company_business_unit, PDO::PARAM_INT);

                        break;
                    case '`fk_company`':
                        $stmt->bindValue($identifier, $this->fk_company, PDO::PARAM_INT);

                        break;
                    case '`fk_parent_company_business_unit`':
                        $stmt->bindValue($identifier, $this->fk_parent_company_business_unit, PDO::PARAM_INT);

                        break;
                    case '`bic`':
                        $stmt->bindValue($identifier, $this->bic, PDO::PARAM_STR);

                        break;
                    case '`default_billing_address`':
                        $stmt->bindValue($identifier, $this->default_billing_address, PDO::PARAM_INT);

                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case '`external_url`':
                        $stmt->bindValue($identifier, $this->external_url, PDO::PARAM_STR);

                        break;
                    case '`iban`':
                        $stmt->bindValue($identifier, $this->iban, PDO::PARAM_STR);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_company_business_unit_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCompanyBusinessUnit($pk);

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
        $pos = SpyCompanyBusinessUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCompanyBusinessUnit();

            case 1:
                return $this->getFkCompany();

            case 2:
                return $this->getFkParentCompanyBusinessUnit();

            case 3:
                return $this->getBic();

            case 4:
                return $this->getDefaultBillingAddress();

            case 5:
                return $this->getEmail();

            case 6:
                return $this->getExternalUrl();

            case 7:
                return $this->getIban();

            case 8:
                return $this->getKey();

            case 9:
                return $this->getName();

            case 10:
                return $this->getPhone();

            case 11:
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
        if (isset($alreadyDumpedObjects['SpyCompanyBusinessUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCompanyBusinessUnit'][$this->hashCode()] = true;
        $keys = SpyCompanyBusinessUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCompanyBusinessUnit(),
            $keys[1] => $this->getFkCompany(),
            $keys[2] => $this->getFkParentCompanyBusinessUnit(),
            $keys[3] => $this->getBic(),
            $keys[4] => $this->getDefaultBillingAddress(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getExternalUrl(),
            $keys[7] => $this->getIban(),
            $keys[8] => $this->getKey(),
            $keys[9] => $this->getName(),
            $keys[10] => $this->getPhone(),
            $keys[11] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aParentCompanyBusinessUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_unit';
                        break;
                    default:
                        $key = 'ParentCompanyBusinessUnit';
                }

                $result[$key] = $this->aParentCompanyBusinessUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompanyBusinessUnitDefaultBillingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_address';
                        break;
                    default:
                        $key = 'CompanyBusinessUnitDefaultBillingAddress';
                }

                $result[$key] = $this->aCompanyBusinessUnitDefaultBillingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collChildrenCompanyBusinessUnitss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_units';
                        break;
                    default:
                        $key = 'ChildrenCompanyBusinessUnitss';
                }

                $result[$key] = $this->collChildrenCompanyBusinessUnitss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyBusinessUnitFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnitFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_unit_files';
                        break;
                    default:
                        $key = 'SpyCompanyBusinessUnitFiles';
                }

                $result[$key] = $this->collSpyCompanyBusinessUnitFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddressToCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_address_to_company_business_units';
                        break;
                    default:
                        $key = 'SpyCompanyUnitAddressToCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationRequestToCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relation_request_to_company_business_units';
                        break;
                    default:
                        $key = 'SpyMerchantRelationRequestToCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyMerchantRelationshipToCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationshipToCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relationship_to_company_business_units';
                        break;
                    default:
                        $key = 'SpyMerchantRelationshipToCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyMerchantRelationshipToCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_business_units';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyShoppingListCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspAssets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspAssets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_assets';
                        break;
                    default:
                        $key = 'SpySspAssets';
                }

                $result[$key] = $this->collSpySspAssets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspAssetToCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspAssetToCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_asset_to_company_business_units';
                        break;
                    default:
                        $key = 'SpySspAssetToCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpySspAssetToCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCompanyBusinessUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCompanyBusinessUnit($value);
                break;
            case 1:
                $this->setFkCompany($value);
                break;
            case 2:
                $this->setFkParentCompanyBusinessUnit($value);
                break;
            case 3:
                $this->setBic($value);
                break;
            case 4:
                $this->setDefaultBillingAddress($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setExternalUrl($value);
                break;
            case 7:
                $this->setIban($value);
                break;
            case 8:
                $this->setKey($value);
                break;
            case 9:
                $this->setName($value);
                break;
            case 10:
                $this->setPhone($value);
                break;
            case 11:
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
        $keys = SpyCompanyBusinessUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCompanyBusinessUnit($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompany($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkParentCompanyBusinessUnit($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBic($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDefaultBillingAddress($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExternalUrl($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIban($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setKey($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPhone($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUuid($arr[$keys[11]]);
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
        $criteria = new Criteria(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $this->id_company_business_unit);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $this->fk_company);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $this->fk_parent_company_business_unit);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_BIC)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_BIC, $this->bic);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $this->default_billing_address);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_EMAIL)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL, $this->external_url);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_IBAN)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_IBAN, $this->iban);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_KEY)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_NAME)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_PHONE)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SpyCompanyBusinessUnitTableMap::COL_UUID)) {
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyCompanyBusinessUnitQuery::create();
        $criteria->add(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $this->id_company_business_unit);

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
        $validPk = null !== $this->getIdCompanyBusinessUnit();

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
        return $this->getIdCompanyBusinessUnit();
    }

    /**
     * Generic method to set the primary key (id_company_business_unit column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCompanyBusinessUnit($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCompanyBusinessUnit();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompany($this->getFkCompany());
        $copyObj->setFkParentCompanyBusinessUnit($this->getFkParentCompanyBusinessUnit());
        $copyObj->setBic($this->getBic());
        $copyObj->setDefaultBillingAddress($this->getDefaultBillingAddress());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setExternalUrl($this->getExternalUrl());
        $copyObj->setIban($this->getIban());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getChildrenCompanyBusinessUnitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChildrenCompanyBusinessUnits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyBusinessUnitFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyBusinessUnitFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyUnitAddressToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUnitAddressToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyUserInvitations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUserInvitation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationRequestToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationRequestToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationships() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationship($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationshipToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationshipToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspAssets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspAsset($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspAssetToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspAssetToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCompanyBusinessUnit(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit Clone of current object.
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
            $v->addCompanyBusinessUnit($this);
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
                $this->aCompany->addCompanyBusinessUnits($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildSpyCompanyBusinessUnit object.
     *
     * @param ChildSpyCompanyBusinessUnit|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setParentCompanyBusinessUnit(ChildSpyCompanyBusinessUnit $v = null)
    {
        if ($v === null) {
            $this->setFkParentCompanyBusinessUnit(NULL);
        } else {
            $this->setFkParentCompanyBusinessUnit($v->getIdCompanyBusinessUnit());
        }

        $this->aParentCompanyBusinessUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCompanyBusinessUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addChildrenCompanyBusinessUnits($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCompanyBusinessUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCompanyBusinessUnit|null The associated ChildSpyCompanyBusinessUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getParentCompanyBusinessUnit(?ConnectionInterface $con = null)
    {
        if ($this->aParentCompanyBusinessUnit === null && ($this->fk_parent_company_business_unit != 0)) {
            $this->aParentCompanyBusinessUnit = ChildSpyCompanyBusinessUnitQuery::create()->findPk($this->fk_parent_company_business_unit, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aParentCompanyBusinessUnit->addChildrenCompanyBusinessUnitss($this);
             */
        }

        return $this->aParentCompanyBusinessUnit;
    }

    /**
     * Declares an association between this object and a SpyCompanyUnitAddress object.
     *
     * @param SpyCompanyUnitAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompanyBusinessUnitDefaultBillingAddress(SpyCompanyUnitAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultBillingAddress(NULL);
        } else {
            $this->setDefaultBillingAddress($v->getIdCompanyUnitAddress());
        }

        $this->aCompanyBusinessUnitDefaultBillingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompanyUnitAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCompanyBusinessUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompanyUnitAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompanyUnitAddress|null The associated SpyCompanyUnitAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyBusinessUnitDefaultBillingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aCompanyBusinessUnitDefaultBillingAddress === null && ($this->default_billing_address != 0)) {
            $this->aCompanyBusinessUnitDefaultBillingAddress = SpyCompanyUnitAddressQuery::create()->findPk($this->default_billing_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyBusinessUnitDefaultBillingAddress->addSpyCompanyBusinessUnits($this);
             */
        }

        return $this->aCompanyBusinessUnitDefaultBillingAddress;
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
        if ('ChildrenCompanyBusinessUnits' === $relationName) {
            $this->initChildrenCompanyBusinessUnitss();
            return;
        }
        if ('SpyCompanyBusinessUnitFile' === $relationName) {
            $this->initSpyCompanyBusinessUnitFiles();
            return;
        }
        if ('SpyCompanyUnitAddressToCompanyBusinessUnit' === $relationName) {
            $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
            return;
        }
        if ('CompanyUser' === $relationName) {
            $this->initCompanyUsers();
            return;
        }
        if ('SpyCompanyUserInvitation' === $relationName) {
            $this->initSpyCompanyUserInvitations();
            return;
        }
        if ('SpyMerchantRelationRequest' === $relationName) {
            $this->initSpyMerchantRelationRequests();
            return;
        }
        if ('SpyMerchantRelationRequestToCompanyBusinessUnit' === $relationName) {
            $this->initSpyMerchantRelationRequestToCompanyBusinessUnits();
            return;
        }
        if ('SpyMerchantRelationship' === $relationName) {
            $this->initSpyMerchantRelationships();
            return;
        }
        if ('SpyMerchantRelationshipToCompanyBusinessUnit' === $relationName) {
            $this->initSpyMerchantRelationshipToCompanyBusinessUnits();
            return;
        }
        if ('SpyShoppingListCompanyBusinessUnit' === $relationName) {
            $this->initSpyShoppingListCompanyBusinessUnits();
            return;
        }
        if ('SpySspAsset' === $relationName) {
            $this->initSpySspAssets();
            return;
        }
        if ('SpySspAssetToCompanyBusinessUnit' === $relationName) {
            $this->initSpySspAssetToCompanyBusinessUnits();
            return;
        }
    }

    /**
     * Clears out the collChildrenCompanyBusinessUnitss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addChildrenCompanyBusinessUnitss()
     */
    public function clearChildrenCompanyBusinessUnitss()
    {
        $this->collChildrenCompanyBusinessUnitss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collChildrenCompanyBusinessUnitss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialChildrenCompanyBusinessUnitss($v = true): void
    {
        $this->collChildrenCompanyBusinessUnitssPartial = $v;
    }

    /**
     * Initializes the collChildrenCompanyBusinessUnitss collection.
     *
     * By default this just sets the collChildrenCompanyBusinessUnitss collection to an empty array (like clearcollChildrenCompanyBusinessUnitss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChildrenCompanyBusinessUnitss(bool $overrideExisting = true): void
    {
        if (null !== $this->collChildrenCompanyBusinessUnitss && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collChildrenCompanyBusinessUnitss = new $collectionClassName;
        $this->collChildrenCompanyBusinessUnitss->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');
    }

    /**
     * Gets an array of ChildSpyCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCompanyBusinessUnit[] List of ChildSpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyBusinessUnit> List of ChildSpyCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getChildrenCompanyBusinessUnitss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collChildrenCompanyBusinessUnitssPartial && !$this->isNew();
        if (null === $this->collChildrenCompanyBusinessUnitss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collChildrenCompanyBusinessUnitss) {
                    $this->initChildrenCompanyBusinessUnitss();
                } else {
                    $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collChildrenCompanyBusinessUnitss = new $collectionClassName;
                    $collChildrenCompanyBusinessUnitss->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');

                    return $collChildrenCompanyBusinessUnitss;
                }
            } else {
                $collChildrenCompanyBusinessUnitss = ChildSpyCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByParentCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collChildrenCompanyBusinessUnitssPartial && count($collChildrenCompanyBusinessUnitss)) {
                        $this->initChildrenCompanyBusinessUnitss(false);

                        foreach ($collChildrenCompanyBusinessUnitss as $obj) {
                            if (false == $this->collChildrenCompanyBusinessUnitss->contains($obj)) {
                                $this->collChildrenCompanyBusinessUnitss->append($obj);
                            }
                        }

                        $this->collChildrenCompanyBusinessUnitssPartial = true;
                    }

                    return $collChildrenCompanyBusinessUnitss;
                }

                if ($partial && $this->collChildrenCompanyBusinessUnitss) {
                    foreach ($this->collChildrenCompanyBusinessUnitss as $obj) {
                        if ($obj->isNew()) {
                            $collChildrenCompanyBusinessUnitss[] = $obj;
                        }
                    }
                }

                $this->collChildrenCompanyBusinessUnitss = $collChildrenCompanyBusinessUnitss;
                $this->collChildrenCompanyBusinessUnitssPartial = false;
            }
        }

        return $this->collChildrenCompanyBusinessUnitss;
    }

    /**
     * Sets a collection of ChildSpyCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $childrenCompanyBusinessUnitss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setChildrenCompanyBusinessUnitss(Collection $childrenCompanyBusinessUnitss, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCompanyBusinessUnit[] $childrenCompanyBusinessUnitssToDelete */
        $childrenCompanyBusinessUnitssToDelete = $this->getChildrenCompanyBusinessUnitss(new Criteria(), $con)->diff($childrenCompanyBusinessUnitss);


        $this->childrenCompanyBusinessUnitssScheduledForDeletion = $childrenCompanyBusinessUnitssToDelete;

        foreach ($childrenCompanyBusinessUnitssToDelete as $childrenCompanyBusinessUnitsRemoved) {
            $childrenCompanyBusinessUnitsRemoved->setParentCompanyBusinessUnit(null);
        }

        $this->collChildrenCompanyBusinessUnitss = null;
        foreach ($childrenCompanyBusinessUnitss as $childrenCompanyBusinessUnits) {
            $this->addChildrenCompanyBusinessUnits($childrenCompanyBusinessUnits);
        }

        $this->collChildrenCompanyBusinessUnitss = $childrenCompanyBusinessUnitss;
        $this->collChildrenCompanyBusinessUnitssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countChildrenCompanyBusinessUnitss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collChildrenCompanyBusinessUnitssPartial && !$this->isNew();
        if (null === $this->collChildrenCompanyBusinessUnitss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChildrenCompanyBusinessUnitss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getChildrenCompanyBusinessUnitss());
            }

            $query = ChildSpyCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByParentCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collChildrenCompanyBusinessUnitss);
    }

    /**
     * Method called to associate a ChildSpyCompanyBusinessUnit object to this object
     * through the ChildSpyCompanyBusinessUnit foreign key attribute.
     *
     * @param ChildSpyCompanyBusinessUnit $l ChildSpyCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addChildrenCompanyBusinessUnits(ChildSpyCompanyBusinessUnit $l)
    {
        if ($this->collChildrenCompanyBusinessUnitss === null) {
            $this->initChildrenCompanyBusinessUnitss();
            $this->collChildrenCompanyBusinessUnitssPartial = true;
        }

        if (!$this->collChildrenCompanyBusinessUnitss->contains($l)) {
            $this->doAddChildrenCompanyBusinessUnits($l);

            if ($this->childrenCompanyBusinessUnitssScheduledForDeletion and $this->childrenCompanyBusinessUnitssScheduledForDeletion->contains($l)) {
                $this->childrenCompanyBusinessUnitssScheduledForDeletion->remove($this->childrenCompanyBusinessUnitssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCompanyBusinessUnit $childrenCompanyBusinessUnits The ChildSpyCompanyBusinessUnit object to add.
     */
    protected function doAddChildrenCompanyBusinessUnits(ChildSpyCompanyBusinessUnit $childrenCompanyBusinessUnits): void
    {
        $this->collChildrenCompanyBusinessUnitss[]= $childrenCompanyBusinessUnits;
        $childrenCompanyBusinessUnits->setParentCompanyBusinessUnit($this);
    }

    /**
     * @param ChildSpyCompanyBusinessUnit $childrenCompanyBusinessUnits The ChildSpyCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeChildrenCompanyBusinessUnits(ChildSpyCompanyBusinessUnit $childrenCompanyBusinessUnits)
    {
        if ($this->getChildrenCompanyBusinessUnitss()->contains($childrenCompanyBusinessUnits)) {
            $pos = $this->collChildrenCompanyBusinessUnitss->search($childrenCompanyBusinessUnits);
            $this->collChildrenCompanyBusinessUnitss->remove($pos);
            if (null === $this->childrenCompanyBusinessUnitssScheduledForDeletion) {
                $this->childrenCompanyBusinessUnitssScheduledForDeletion = clone $this->collChildrenCompanyBusinessUnitss;
                $this->childrenCompanyBusinessUnitssScheduledForDeletion->clear();
            }
            $this->childrenCompanyBusinessUnitssScheduledForDeletion[]= $childrenCompanyBusinessUnits;
            $childrenCompanyBusinessUnits->setParentCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related ChildrenCompanyBusinessUnitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyBusinessUnit[] List of ChildSpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyBusinessUnit}> List of ChildSpyCompanyBusinessUnit objects
     */
    public function getChildrenCompanyBusinessUnitssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getChildrenCompanyBusinessUnitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related ChildrenCompanyBusinessUnitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyBusinessUnit[] List of ChildSpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyBusinessUnit}> List of ChildSpyCompanyBusinessUnit objects
     */
    public function getChildrenCompanyBusinessUnitssJoinCompanyBusinessUnitDefaultBillingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnitDefaultBillingAddress', $joinBehavior);

        return $this->getChildrenCompanyBusinessUnitss($query, $con);
    }

    /**
     * Clears out the collSpyCompanyBusinessUnitFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyBusinessUnitFiles()
     */
    public function clearSpyCompanyBusinessUnitFiles()
    {
        $this->collSpyCompanyBusinessUnitFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyBusinessUnitFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyBusinessUnitFiles($v = true): void
    {
        $this->collSpyCompanyBusinessUnitFilesPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyBusinessUnitFiles collection.
     *
     * By default this just sets the collSpyCompanyBusinessUnitFiles collection to an empty array (like clearcollSpyCompanyBusinessUnitFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyBusinessUnitFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyBusinessUnitFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyBusinessUnitFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyBusinessUnitFiles = new $collectionClassName;
        $this->collSpyCompanyBusinessUnitFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile');
    }

    /**
     * Gets an array of SpyCompanyBusinessUnitFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyBusinessUnitFile[] List of SpyCompanyBusinessUnitFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile> List of SpyCompanyBusinessUnitFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyBusinessUnitFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyBusinessUnitFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnitFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyBusinessUnitFiles) {
                    $this->initSpyCompanyBusinessUnitFiles();
                } else {
                    $collectionClassName = SpyCompanyBusinessUnitFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyBusinessUnitFiles = new $collectionClassName;
                    $collSpyCompanyBusinessUnitFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile');

                    return $collSpyCompanyBusinessUnitFiles;
                }
            } else {
                $collSpyCompanyBusinessUnitFiles = SpyCompanyBusinessUnitFileQuery::create(null, $criteria)
                    ->filterByCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyBusinessUnitFilesPartial && count($collSpyCompanyBusinessUnitFiles)) {
                        $this->initSpyCompanyBusinessUnitFiles(false);

                        foreach ($collSpyCompanyBusinessUnitFiles as $obj) {
                            if (false == $this->collSpyCompanyBusinessUnitFiles->contains($obj)) {
                                $this->collSpyCompanyBusinessUnitFiles->append($obj);
                            }
                        }

                        $this->collSpyCompanyBusinessUnitFilesPartial = true;
                    }

                    return $collSpyCompanyBusinessUnitFiles;
                }

                if ($partial && $this->collSpyCompanyBusinessUnitFiles) {
                    foreach ($this->collSpyCompanyBusinessUnitFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyBusinessUnitFiles[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyBusinessUnitFiles = $collSpyCompanyBusinessUnitFiles;
                $this->collSpyCompanyBusinessUnitFilesPartial = false;
            }
        }

        return $this->collSpyCompanyBusinessUnitFiles;
    }

    /**
     * Sets a collection of SpyCompanyBusinessUnitFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyBusinessUnitFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyBusinessUnitFiles(Collection $spyCompanyBusinessUnitFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyBusinessUnitFile[] $spyCompanyBusinessUnitFilesToDelete */
        $spyCompanyBusinessUnitFilesToDelete = $this->getSpyCompanyBusinessUnitFiles(new Criteria(), $con)->diff($spyCompanyBusinessUnitFiles);


        $this->spyCompanyBusinessUnitFilesScheduledForDeletion = $spyCompanyBusinessUnitFilesToDelete;

        foreach ($spyCompanyBusinessUnitFilesToDelete as $spyCompanyBusinessUnitFileRemoved) {
            $spyCompanyBusinessUnitFileRemoved->setCompanyBusinessUnit(null);
        }

        $this->collSpyCompanyBusinessUnitFiles = null;
        foreach ($spyCompanyBusinessUnitFiles as $spyCompanyBusinessUnitFile) {
            $this->addSpyCompanyBusinessUnitFile($spyCompanyBusinessUnitFile);
        }

        $this->collSpyCompanyBusinessUnitFiles = $spyCompanyBusinessUnitFiles;
        $this->collSpyCompanyBusinessUnitFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyBusinessUnitFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyBusinessUnitFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyBusinessUnitFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyBusinessUnitFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnitFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyBusinessUnitFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyBusinessUnitFiles());
            }

            $query = SpyCompanyBusinessUnitFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyCompanyBusinessUnitFiles);
    }

    /**
     * Method called to associate a SpyCompanyBusinessUnitFile object to this object
     * through the SpyCompanyBusinessUnitFile foreign key attribute.
     *
     * @param SpyCompanyBusinessUnitFile $l SpyCompanyBusinessUnitFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $l)
    {
        if ($this->collSpyCompanyBusinessUnitFiles === null) {
            $this->initSpyCompanyBusinessUnitFiles();
            $this->collSpyCompanyBusinessUnitFilesPartial = true;
        }

        if (!$this->collSpyCompanyBusinessUnitFiles->contains($l)) {
            $this->doAddSpyCompanyBusinessUnitFile($l);

            if ($this->spyCompanyBusinessUnitFilesScheduledForDeletion and $this->spyCompanyBusinessUnitFilesScheduledForDeletion->contains($l)) {
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion->remove($this->spyCompanyBusinessUnitFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile The SpyCompanyBusinessUnitFile object to add.
     */
    protected function doAddSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile): void
    {
        $this->collSpyCompanyBusinessUnitFiles[]= $spyCompanyBusinessUnitFile;
        $spyCompanyBusinessUnitFile->setCompanyBusinessUnit($this);
    }

    /**
     * @param SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile The SpyCompanyBusinessUnitFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile)
    {
        if ($this->getSpyCompanyBusinessUnitFiles()->contains($spyCompanyBusinessUnitFile)) {
            $pos = $this->collSpyCompanyBusinessUnitFiles->search($spyCompanyBusinessUnitFile);
            $this->collSpyCompanyBusinessUnitFiles->remove($pos);
            if (null === $this->spyCompanyBusinessUnitFilesScheduledForDeletion) {
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion = clone $this->collSpyCompanyBusinessUnitFiles;
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion->clear();
            }
            $this->spyCompanyBusinessUnitFilesScheduledForDeletion[]= clone $spyCompanyBusinessUnitFile;
            $spyCompanyBusinessUnitFile->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyCompanyBusinessUnitFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnitFile[] List of SpyCompanyBusinessUnitFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile}> List of SpyCompanyBusinessUnitFile objects
     */
    public function getSpyCompanyBusinessUnitFilesJoinFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitFileQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getSpyCompanyBusinessUnitFiles($query, $con);
    }

    /**
     * Clears out the collSpyCompanyUnitAddressToCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUnitAddressToCompanyBusinessUnits()
     */
    public function clearSpyCompanyUnitAddressToCompanyBusinessUnits()
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUnitAddressToCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUnitAddressToCompanyBusinessUnits($v = true): void
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUnitAddressToCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyCompanyUnitAddressToCompanyBusinessUnits collection to an empty array (like clearcollSpyCompanyUnitAddressToCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUnitAddressToCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyCompanyUnitAddressToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUnitAddressToCompanyBusinessUnit[] List of SpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddressToCompanyBusinessUnit> List of SpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUnitAddressToCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                    $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUnitAddressToCompanyBusinessUnits = new $collectionClassName;
                    $collSpyCompanyUnitAddressToCompanyBusinessUnits->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit');

                    return $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                }
            } else {
                $collSpyCompanyUnitAddressToCompanyBusinessUnits = SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && count($collSpyCompanyUnitAddressToCompanyBusinessUnits)) {
                        $this->initSpyCompanyUnitAddressToCompanyBusinessUnits(false);

                        foreach ($collSpyCompanyUnitAddressToCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                    foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUnitAddressToCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyCompanyUnitAddressToCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyCompanyUnitAddressToCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUnitAddressToCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUnitAddressToCompanyBusinessUnits(Collection $spyCompanyUnitAddressToCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUnitAddressToCompanyBusinessUnit[] $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete */
        $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete = $this->getSpyCompanyUnitAddressToCompanyBusinessUnits(new Criteria(), $con)->diff($spyCompanyUnitAddressToCompanyBusinessUnits);


        $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete;

        foreach ($spyCompanyUnitAddressToCompanyBusinessUnitsToDelete as $spyCompanyUnitAddressToCompanyBusinessUnitRemoved) {
            $spyCompanyUnitAddressToCompanyBusinessUnitRemoved->setCompanyBusinessUnit(null);
        }

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;
        foreach ($spyCompanyUnitAddressToCompanyBusinessUnits as $spyCompanyUnitAddressToCompanyBusinessUnit) {
            $this->addSpyCompanyUnitAddressToCompanyBusinessUnit($spyCompanyUnitAddressToCompanyBusinessUnit);
        }

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = $spyCompanyUnitAddressToCompanyBusinessUnits;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUnitAddressToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUnitAddressToCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUnitAddressToCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUnitAddressToCompanyBusinessUnits());
            }

            $query = SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUnitAddressToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyCompanyUnitAddressToCompanyBusinessUnit object to this object
     * through the SpyCompanyUnitAddressToCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyCompanyUnitAddressToCompanyBusinessUnit $l SpyCompanyUnitAddressToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUnitAddressToCompanyBusinessUnit(SpyCompanyUnitAddressToCompanyBusinessUnit $l)
    {
        if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits === null) {
            $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
            $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyCompanyUnitAddressToCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyCompanyUnitAddressToCompanyBusinessUnit($l);

            if ($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion and $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->remove($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit The SpyCompanyUnitAddressToCompanyBusinessUnit object to add.
     */
    protected function doAddSpyCompanyUnitAddressToCompanyBusinessUnit(SpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit): void
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits[]= $spyCompanyUnitAddressToCompanyBusinessUnit;
        $spyCompanyUnitAddressToCompanyBusinessUnit->setCompanyBusinessUnit($this);
    }

    /**
     * @param SpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit The SpyCompanyUnitAddressToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUnitAddressToCompanyBusinessUnit(SpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit)
    {
        if ($this->getSpyCompanyUnitAddressToCompanyBusinessUnits()->contains($spyCompanyUnitAddressToCompanyBusinessUnit)) {
            $pos = $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->search($spyCompanyUnitAddressToCompanyBusinessUnit);
            $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->remove($pos);
            if (null === $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyCompanyUnitAddressToCompanyBusinessUnits;
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion[]= clone $spyCompanyUnitAddressToCompanyBusinessUnit;
            $spyCompanyUnitAddressToCompanyBusinessUnit->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyCompanyUnitAddressToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddressToCompanyBusinessUnit[] List of SpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddressToCompanyBusinessUnit}> List of SpyCompanyUnitAddressToCompanyBusinessUnit objects
     */
    public function getSpyCompanyUnitAddressToCompanyBusinessUnitsJoinCompanyUnitAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('CompanyUnitAddress', $joinBehavior);

        return $this->getSpyCompanyUnitAddressToCompanyBusinessUnits($query, $con);
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
     * If this ChildSpyCompanyBusinessUnit is new, it will return
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
                    ->filterByCompanyBusinessUnit($this)
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
            $companyUserRemoved->setCompanyBusinessUnit(null);
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
                ->filterByCompanyBusinessUnit($this)
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
        $companyUser->setCompanyBusinessUnit($this);
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
            $this->companyUsersScheduledForDeletion[]= $companyUser;
            $companyUser->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser}> List of SpyCompanyUser objects
     */
    public function getCompanyUsersJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getCompanyUsers($query, $con);
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
     * If this ChildSpyCompanyBusinessUnit is new, it will return
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
                    ->filterBySpyCompanyBusinessUnit($this)
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
            $spyCompanyUserInvitationRemoved->setSpyCompanyBusinessUnit(null);
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
                ->filterBySpyCompanyBusinessUnit($this)
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
        $spyCompanyUserInvitation->setSpyCompanyBusinessUnit($this);
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
            $spyCompanyUserInvitation->setSpyCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyCompanyUserInvitations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyCompanyUserInvitations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUserInvitation[] List of SpyCompanyUserInvitation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserInvitation}> List of SpyCompanyUserInvitation objects
     */
    public function getSpyCompanyUserInvitationsJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserInvitationQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyCompanyUserInvitations($query, $con);
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
     * If this ChildSpyCompanyBusinessUnit is new, it will return
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
                    ->filterByCompanyBusinessUnit($this)
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
            $spyMerchantRelationRequestRemoved->setCompanyBusinessUnit(null);
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
                ->filterByCompanyBusinessUnit($this)
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
        $spyMerchantRelationRequest->setCompanyBusinessUnit($this);
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
            $spyMerchantRelationRequest->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
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
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyMerchantRelationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
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
     * Clears out the collSpyMerchantRelationRequestToCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRelationRequestToCompanyBusinessUnits()
     */
    public function clearSpyMerchantRelationRequestToCompanyBusinessUnits()
    {
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRelationRequestToCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRelationRequestToCompanyBusinessUnits($v = true): void
    {
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRelationRequestToCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyMerchantRelationRequestToCompanyBusinessUnits collection to an empty array (like clearcollSpyMerchantRelationRequestToCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRelationRequestToCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRelationRequestToCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->setModel('\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyMerchantRelationRequestToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRelationRequestToCompanyBusinessUnit[] List of SpyMerchantRelationRequestToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequestToCompanyBusinessUnit> List of SpyMerchantRelationRequestToCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationRequestToCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationRequestToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {
                    $this->initSpyMerchantRelationRequestToCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRelationRequestToCompanyBusinessUnits = new $collectionClassName;
                    $collSpyMerchantRelationRequestToCompanyBusinessUnits->setModel('\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit');

                    return $collSpyMerchantRelationRequestToCompanyBusinessUnits;
                }
            } else {
                $collSpyMerchantRelationRequestToCompanyBusinessUnits = SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial && count($collSpyMerchantRelationRequestToCompanyBusinessUnits)) {
                        $this->initSpyMerchantRelationRequestToCompanyBusinessUnits(false);

                        foreach ($collSpyMerchantRelationRequestToCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyMerchantRelationRequestToCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {
                    foreach ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRelationRequestToCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = $collSpyMerchantRelationRequestToCompanyBusinessUnits;
                $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyMerchantRelationRequestToCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyMerchantRelationRequestToCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRelationRequestToCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRelationRequestToCompanyBusinessUnits(Collection $spyMerchantRelationRequestToCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRelationRequestToCompanyBusinessUnit[] $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete */
        $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete = $this->getSpyMerchantRelationRequestToCompanyBusinessUnits(new Criteria(), $con)->diff($spyMerchantRelationRequestToCompanyBusinessUnits);


        $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete;

        foreach ($spyMerchantRelationRequestToCompanyBusinessUnitsToDelete as $spyMerchantRelationRequestToCompanyBusinessUnitRemoved) {
            $spyMerchantRelationRequestToCompanyBusinessUnitRemoved->setCompanyBusinessUnit(null);
        }

        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null;
        foreach ($spyMerchantRelationRequestToCompanyBusinessUnits as $spyMerchantRelationRequestToCompanyBusinessUnit) {
            $this->addSpyMerchantRelationRequestToCompanyBusinessUnit($spyMerchantRelationRequestToCompanyBusinessUnit);
        }

        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = $spyMerchantRelationRequestToCompanyBusinessUnits;
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRelationRequestToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRelationRequestToCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRelationRequestToCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationRequestToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRelationRequestToCompanyBusinessUnits());
            }

            $query = SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationRequestToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyMerchantRelationRequestToCompanyBusinessUnit object to this object
     * through the SpyMerchantRelationRequestToCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyMerchantRelationRequestToCompanyBusinessUnit $l SpyMerchantRelationRequestToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationRequestToCompanyBusinessUnit(SpyMerchantRelationRequestToCompanyBusinessUnit $l)
    {
        if ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits === null) {
            $this->initSpyMerchantRelationRequestToCompanyBusinessUnits();
            $this->collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyMerchantRelationRequestToCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyMerchantRelationRequestToCompanyBusinessUnit($l);

            if ($this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion and $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->remove($this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit The SpyMerchantRelationRequestToCompanyBusinessUnit object to add.
     */
    protected function doAddSpyMerchantRelationRequestToCompanyBusinessUnit(SpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit): void
    {
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits[]= $spyMerchantRelationRequestToCompanyBusinessUnit;
        $spyMerchantRelationRequestToCompanyBusinessUnit->setCompanyBusinessUnit($this);
    }

    /**
     * @param SpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit The SpyMerchantRelationRequestToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationRequestToCompanyBusinessUnit(SpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit)
    {
        if ($this->getSpyMerchantRelationRequestToCompanyBusinessUnits()->contains($spyMerchantRelationRequestToCompanyBusinessUnit)) {
            $pos = $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->search($spyMerchantRelationRequestToCompanyBusinessUnit);
            $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->remove($pos);
            if (null === $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyMerchantRelationRequestToCompanyBusinessUnits;
                $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion[]= clone $spyMerchantRelationRequestToCompanyBusinessUnit;
            $spyMerchantRelationRequestToCompanyBusinessUnit->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyMerchantRelationRequestToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationRequestToCompanyBusinessUnit[] List of SpyMerchantRelationRequestToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationRequestToCompanyBusinessUnit}> List of SpyMerchantRelationRequestToCompanyBusinessUnit objects
     */
    public function getSpyMerchantRelationRequestToCompanyBusinessUnitsJoinMerchantRelationshipRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('MerchantRelationshipRequest', $joinBehavior);

        return $this->getSpyMerchantRelationRequestToCompanyBusinessUnits($query, $con);
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
     * If this ChildSpyCompanyBusinessUnit is new, it will return
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
                    ->filterByCompanyBusinessUnit($this)
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
            $spyMerchantRelationshipRemoved->setCompanyBusinessUnit(null);
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
                ->filterByCompanyBusinessUnit($this)
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
        $spyMerchantRelationship->setCompanyBusinessUnit($this);
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
            $spyMerchantRelationship->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyMerchantRelationships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationship[] List of SpyMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationship}> List of SpyMerchantRelationship objects
     */
    public function getSpyMerchantRelationshipsJoinMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipQuery::create(null, $criteria);
        $query->joinWith('Merchant', $joinBehavior);

        return $this->getSpyMerchantRelationships($query, $con);
    }

    /**
     * Clears out the collSpyMerchantRelationshipToCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRelationshipToCompanyBusinessUnits()
     */
    public function clearSpyMerchantRelationshipToCompanyBusinessUnits()
    {
        $this->collSpyMerchantRelationshipToCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRelationshipToCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRelationshipToCompanyBusinessUnits($v = true): void
    {
        $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRelationshipToCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyMerchantRelationshipToCompanyBusinessUnits collection to an empty array (like clearcollSpyMerchantRelationshipToCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRelationshipToCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRelationshipToCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRelationshipToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRelationshipToCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyMerchantRelationshipToCompanyBusinessUnits->setModel('\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyMerchantRelationshipToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRelationshipToCompanyBusinessUnit[] List of SpyMerchantRelationshipToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipToCompanyBusinessUnit> List of SpyMerchantRelationshipToCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationshipToCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationshipToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRelationshipToCompanyBusinessUnits) {
                    $this->initSpyMerchantRelationshipToCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyMerchantRelationshipToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRelationshipToCompanyBusinessUnits = new $collectionClassName;
                    $collSpyMerchantRelationshipToCompanyBusinessUnits->setModel('\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit');

                    return $collSpyMerchantRelationshipToCompanyBusinessUnits;
                }
            } else {
                $collSpyMerchantRelationshipToCompanyBusinessUnits = SpyMerchantRelationshipToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial && count($collSpyMerchantRelationshipToCompanyBusinessUnits)) {
                        $this->initSpyMerchantRelationshipToCompanyBusinessUnits(false);

                        foreach ($collSpyMerchantRelationshipToCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyMerchantRelationshipToCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyMerchantRelationshipToCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyMerchantRelationshipToCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyMerchantRelationshipToCompanyBusinessUnits) {
                    foreach ($this->collSpyMerchantRelationshipToCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRelationshipToCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRelationshipToCompanyBusinessUnits = $collSpyMerchantRelationshipToCompanyBusinessUnits;
                $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyMerchantRelationshipToCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyMerchantRelationshipToCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRelationshipToCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRelationshipToCompanyBusinessUnits(Collection $spyMerchantRelationshipToCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRelationshipToCompanyBusinessUnit[] $spyMerchantRelationshipToCompanyBusinessUnitsToDelete */
        $spyMerchantRelationshipToCompanyBusinessUnitsToDelete = $this->getSpyMerchantRelationshipToCompanyBusinessUnits(new Criteria(), $con)->diff($spyMerchantRelationshipToCompanyBusinessUnits);


        $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion = $spyMerchantRelationshipToCompanyBusinessUnitsToDelete;

        foreach ($spyMerchantRelationshipToCompanyBusinessUnitsToDelete as $spyMerchantRelationshipToCompanyBusinessUnitRemoved) {
            $spyMerchantRelationshipToCompanyBusinessUnitRemoved->setCompanyBusinessUnit(null);
        }

        $this->collSpyMerchantRelationshipToCompanyBusinessUnits = null;
        foreach ($spyMerchantRelationshipToCompanyBusinessUnits as $spyMerchantRelationshipToCompanyBusinessUnit) {
            $this->addSpyMerchantRelationshipToCompanyBusinessUnit($spyMerchantRelationshipToCompanyBusinessUnit);
        }

        $this->collSpyMerchantRelationshipToCompanyBusinessUnits = $spyMerchantRelationshipToCompanyBusinessUnits;
        $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRelationshipToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRelationshipToCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRelationshipToCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationshipToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRelationshipToCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRelationshipToCompanyBusinessUnits());
            }

            $query = SpyMerchantRelationshipToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationshipToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyMerchantRelationshipToCompanyBusinessUnit object to this object
     * through the SpyMerchantRelationshipToCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyMerchantRelationshipToCompanyBusinessUnit $l SpyMerchantRelationshipToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationshipToCompanyBusinessUnit(SpyMerchantRelationshipToCompanyBusinessUnit $l)
    {
        if ($this->collSpyMerchantRelationshipToCompanyBusinessUnits === null) {
            $this->initSpyMerchantRelationshipToCompanyBusinessUnits();
            $this->collSpyMerchantRelationshipToCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyMerchantRelationshipToCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyMerchantRelationshipToCompanyBusinessUnit($l);

            if ($this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion and $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->remove($this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRelationshipToCompanyBusinessUnit $spyMerchantRelationshipToCompanyBusinessUnit The SpyMerchantRelationshipToCompanyBusinessUnit object to add.
     */
    protected function doAddSpyMerchantRelationshipToCompanyBusinessUnit(SpyMerchantRelationshipToCompanyBusinessUnit $spyMerchantRelationshipToCompanyBusinessUnit): void
    {
        $this->collSpyMerchantRelationshipToCompanyBusinessUnits[]= $spyMerchantRelationshipToCompanyBusinessUnit;
        $spyMerchantRelationshipToCompanyBusinessUnit->setCompanyBusinessUnit($this);
    }

    /**
     * @param SpyMerchantRelationshipToCompanyBusinessUnit $spyMerchantRelationshipToCompanyBusinessUnit The SpyMerchantRelationshipToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationshipToCompanyBusinessUnit(SpyMerchantRelationshipToCompanyBusinessUnit $spyMerchantRelationshipToCompanyBusinessUnit)
    {
        if ($this->getSpyMerchantRelationshipToCompanyBusinessUnits()->contains($spyMerchantRelationshipToCompanyBusinessUnit)) {
            $pos = $this->collSpyMerchantRelationshipToCompanyBusinessUnits->search($spyMerchantRelationshipToCompanyBusinessUnit);
            $this->collSpyMerchantRelationshipToCompanyBusinessUnits->remove($pos);
            if (null === $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyMerchantRelationshipToCompanyBusinessUnits;
                $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationshipToCompanyBusinessUnitsScheduledForDeletion[]= clone $spyMerchantRelationshipToCompanyBusinessUnit;
            $spyMerchantRelationshipToCompanyBusinessUnit->setCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyMerchantRelationshipToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationshipToCompanyBusinessUnit[] List of SpyMerchantRelationshipToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipToCompanyBusinessUnit}> List of SpyMerchantRelationshipToCompanyBusinessUnit objects
     */
    public function getSpyMerchantRelationshipToCompanyBusinessUnitsJoinMerchantRelationship(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('MerchantRelationship', $joinBehavior);

        return $this->getSpyMerchantRelationshipToCompanyBusinessUnits($query, $con);
    }

    /**
     * Clears out the collSpyShoppingListCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyBusinessUnits()
     */
    public function clearSpyShoppingListCompanyBusinessUnits()
    {
        $this->collSpyShoppingListCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyBusinessUnits($v = true): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyShoppingListCompanyBusinessUnits collection to an empty array (like clearcollSpyShoppingListCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyShoppingListCompanyBusinessUnits->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyShoppingListCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListCompanyBusinessUnit[] List of SpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnit> List of SpyShoppingListCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyBusinessUnits) {
                    $this->initSpyShoppingListCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyShoppingListCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyBusinessUnits = new $collectionClassName;
                    $collSpyShoppingListCompanyBusinessUnits->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit');

                    return $collSpyShoppingListCompanyBusinessUnits;
                }
            } else {
                $collSpyShoppingListCompanyBusinessUnits = SpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterBySpyCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyBusinessUnitsPartial && count($collSpyShoppingListCompanyBusinessUnits)) {
                        $this->initSpyShoppingListCompanyBusinessUnits(false);

                        foreach ($collSpyShoppingListCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyShoppingListCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyShoppingListCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyShoppingListCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyShoppingListCompanyBusinessUnits) {
                    foreach ($this->collSpyShoppingListCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyBusinessUnits = $collSpyShoppingListCompanyBusinessUnits;
                $this->collSpyShoppingListCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyShoppingListCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyBusinessUnits(Collection $spyShoppingListCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListCompanyBusinessUnit[] $spyShoppingListCompanyBusinessUnitsToDelete */
        $spyShoppingListCompanyBusinessUnitsToDelete = $this->getSpyShoppingListCompanyBusinessUnits(new Criteria(), $con)->diff($spyShoppingListCompanyBusinessUnits);


        $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = $spyShoppingListCompanyBusinessUnitsToDelete;

        foreach ($spyShoppingListCompanyBusinessUnitsToDelete as $spyShoppingListCompanyBusinessUnitRemoved) {
            $spyShoppingListCompanyBusinessUnitRemoved->setSpyCompanyBusinessUnit(null);
        }

        $this->collSpyShoppingListCompanyBusinessUnits = null;
        foreach ($spyShoppingListCompanyBusinessUnits as $spyShoppingListCompanyBusinessUnit) {
            $this->addSpyShoppingListCompanyBusinessUnit($spyShoppingListCompanyBusinessUnit);
        }

        $this->collSpyShoppingListCompanyBusinessUnits = $spyShoppingListCompanyBusinessUnits;
        $this->collSpyShoppingListCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyBusinessUnits());
            }

            $query = SpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyShoppingListCompanyBusinessUnit object to this object
     * through the SpyShoppingListCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyShoppingListCompanyBusinessUnit $l SpyShoppingListCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyBusinessUnit(SpyShoppingListCompanyBusinessUnit $l)
    {
        if ($this->collSpyShoppingListCompanyBusinessUnits === null) {
            $this->initSpyShoppingListCompanyBusinessUnits();
            $this->collSpyShoppingListCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyShoppingListCompanyBusinessUnit($l);

            if ($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion and $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->remove($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit The SpyShoppingListCompanyBusinessUnit object to add.
     */
    protected function doAddSpyShoppingListCompanyBusinessUnit(SpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit): void
    {
        $this->collSpyShoppingListCompanyBusinessUnits[]= $spyShoppingListCompanyBusinessUnit;
        $spyShoppingListCompanyBusinessUnit->setSpyCompanyBusinessUnit($this);
    }

    /**
     * @param SpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit The SpyShoppingListCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyBusinessUnit(SpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit)
    {
        if ($this->getSpyShoppingListCompanyBusinessUnits()->contains($spyShoppingListCompanyBusinessUnit)) {
            $pos = $this->collSpyShoppingListCompanyBusinessUnits->search($spyShoppingListCompanyBusinessUnit);
            $this->collSpyShoppingListCompanyBusinessUnits->remove($pos);
            if (null === $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyShoppingListCompanyBusinessUnits;
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion[]= clone $spyShoppingListCompanyBusinessUnit;
            $spyShoppingListCompanyBusinessUnit->setSpyCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListCompanyBusinessUnit[] List of SpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnit}> List of SpyShoppingListCompanyBusinessUnit objects
     */
    public function getSpyShoppingListCompanyBusinessUnitsJoinSpyShoppingList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingList', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListCompanyBusinessUnit[] List of SpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListCompanyBusinessUnit}> List of SpyShoppingListCompanyBusinessUnit objects
     */
    public function getSpyShoppingListCompanyBusinessUnitsJoinSpyShoppingListPermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListPermissionGroup', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnits($query, $con);
    }

    /**
     * Clears out the collSpySspAssets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspAssets()
     */
    public function clearSpySspAssets()
    {
        $this->collSpySspAssets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspAssets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspAssets($v = true): void
    {
        $this->collSpySspAssetsPartial = $v;
    }

    /**
     * Initializes the collSpySspAssets collection.
     *
     * By default this just sets the collSpySspAssets collection to an empty array (like clearcollSpySspAssets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspAssets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspAssets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspAssetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspAssets = new $collectionClassName;
        $this->collSpySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAsset');
    }

    /**
     * Gets an array of SpySspAsset objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspAsset[] List of SpySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAsset> List of SpySspAsset objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspAssets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspAssets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspAssets) {
                    $this->initSpySspAssets();
                } else {
                    $collectionClassName = SpySspAssetTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspAssets = new $collectionClassName;
                    $collSpySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAsset');

                    return $collSpySspAssets;
                }
            } else {
                $collSpySspAssets = SpySspAssetQuery::create(null, $criteria)
                    ->filterBySpyCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspAssetsPartial && count($collSpySspAssets)) {
                        $this->initSpySspAssets(false);

                        foreach ($collSpySspAssets as $obj) {
                            if (false == $this->collSpySspAssets->contains($obj)) {
                                $this->collSpySspAssets->append($obj);
                            }
                        }

                        $this->collSpySspAssetsPartial = true;
                    }

                    return $collSpySspAssets;
                }

                if ($partial && $this->collSpySspAssets) {
                    foreach ($this->collSpySspAssets as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspAssets[] = $obj;
                        }
                    }
                }

                $this->collSpySspAssets = $collSpySspAssets;
                $this->collSpySspAssetsPartial = false;
            }
        }

        return $this->collSpySspAssets;
    }

    /**
     * Sets a collection of SpySspAsset objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspAssets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspAssets(Collection $spySspAssets, ?ConnectionInterface $con = null)
    {
        /** @var SpySspAsset[] $spySspAssetsToDelete */
        $spySspAssetsToDelete = $this->getSpySspAssets(new Criteria(), $con)->diff($spySspAssets);


        $this->spySspAssetsScheduledForDeletion = $spySspAssetsToDelete;

        foreach ($spySspAssetsToDelete as $spySspAssetRemoved) {
            $spySspAssetRemoved->setSpyCompanyBusinessUnit(null);
        }

        $this->collSpySspAssets = null;
        foreach ($spySspAssets as $spySspAsset) {
            $this->addSpySspAsset($spySspAsset);
        }

        $this->collSpySspAssets = $spySspAssets;
        $this->collSpySspAssetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspAsset objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspAsset objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspAssets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspAssets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspAssets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspAssets());
            }

            $query = SpySspAssetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpySspAssets);
    }

    /**
     * Method called to associate a SpySspAsset object to this object
     * through the SpySspAsset foreign key attribute.
     *
     * @param SpySspAsset $l SpySspAsset
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspAsset(SpySspAsset $l)
    {
        if ($this->collSpySspAssets === null) {
            $this->initSpySspAssets();
            $this->collSpySspAssetsPartial = true;
        }

        if (!$this->collSpySspAssets->contains($l)) {
            $this->doAddSpySspAsset($l);

            if ($this->spySspAssetsScheduledForDeletion and $this->spySspAssetsScheduledForDeletion->contains($l)) {
                $this->spySspAssetsScheduledForDeletion->remove($this->spySspAssetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspAsset $spySspAsset The SpySspAsset object to add.
     */
    protected function doAddSpySspAsset(SpySspAsset $spySspAsset): void
    {
        $this->collSpySspAssets[]= $spySspAsset;
        $spySspAsset->setSpyCompanyBusinessUnit($this);
    }

    /**
     * @param SpySspAsset $spySspAsset The SpySspAsset object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspAsset(SpySspAsset $spySspAsset)
    {
        if ($this->getSpySspAssets()->contains($spySspAsset)) {
            $pos = $this->collSpySspAssets->search($spySspAsset);
            $this->collSpySspAssets->remove($pos);
            if (null === $this->spySspAssetsScheduledForDeletion) {
                $this->spySspAssetsScheduledForDeletion = clone $this->collSpySspAssets;
                $this->spySspAssetsScheduledForDeletion->clear();
            }
            $this->spySspAssetsScheduledForDeletion[]= $spySspAsset;
            $spySspAsset->setSpyCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpySspAssets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspAsset[] List of SpySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAsset}> List of SpySspAsset objects
     */
    public function getSpySspAssetsJoinFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspAssetQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getSpySspAssets($query, $con);
    }

    /**
     * Clears out the collSpySspAssetToCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspAssetToCompanyBusinessUnits()
     */
    public function clearSpySspAssetToCompanyBusinessUnits()
    {
        $this->collSpySspAssetToCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspAssetToCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspAssetToCompanyBusinessUnits($v = true): void
    {
        $this->collSpySspAssetToCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpySspAssetToCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpySspAssetToCompanyBusinessUnits collection to an empty array (like clearcollSpySspAssetToCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspAssetToCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspAssetToCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspAssetToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspAssetToCompanyBusinessUnits = new $collectionClassName;
        $this->collSpySspAssetToCompanyBusinessUnits->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpySspAssetToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspAssetToCompanyBusinessUnit[] List of SpySspAssetToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAssetToCompanyBusinessUnit> List of SpySspAssetToCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspAssetToCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspAssetToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpySspAssetToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspAssetToCompanyBusinessUnits) {
                    $this->initSpySspAssetToCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpySspAssetToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspAssetToCompanyBusinessUnits = new $collectionClassName;
                    $collSpySspAssetToCompanyBusinessUnits->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit');

                    return $collSpySspAssetToCompanyBusinessUnits;
                }
            } else {
                $collSpySspAssetToCompanyBusinessUnits = SpySspAssetToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterBySpyCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspAssetToCompanyBusinessUnitsPartial && count($collSpySspAssetToCompanyBusinessUnits)) {
                        $this->initSpySspAssetToCompanyBusinessUnits(false);

                        foreach ($collSpySspAssetToCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpySspAssetToCompanyBusinessUnits->contains($obj)) {
                                $this->collSpySspAssetToCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpySspAssetToCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpySspAssetToCompanyBusinessUnits;
                }

                if ($partial && $this->collSpySspAssetToCompanyBusinessUnits) {
                    foreach ($this->collSpySspAssetToCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspAssetToCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpySspAssetToCompanyBusinessUnits = $collSpySspAssetToCompanyBusinessUnits;
                $this->collSpySspAssetToCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpySspAssetToCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpySspAssetToCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspAssetToCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspAssetToCompanyBusinessUnits(Collection $spySspAssetToCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpySspAssetToCompanyBusinessUnit[] $spySspAssetToCompanyBusinessUnitsToDelete */
        $spySspAssetToCompanyBusinessUnitsToDelete = $this->getSpySspAssetToCompanyBusinessUnits(new Criteria(), $con)->diff($spySspAssetToCompanyBusinessUnits);


        $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion = $spySspAssetToCompanyBusinessUnitsToDelete;

        foreach ($spySspAssetToCompanyBusinessUnitsToDelete as $spySspAssetToCompanyBusinessUnitRemoved) {
            $spySspAssetToCompanyBusinessUnitRemoved->setSpyCompanyBusinessUnit(null);
        }

        $this->collSpySspAssetToCompanyBusinessUnits = null;
        foreach ($spySspAssetToCompanyBusinessUnits as $spySspAssetToCompanyBusinessUnit) {
            $this->addSpySspAssetToCompanyBusinessUnit($spySspAssetToCompanyBusinessUnit);
        }

        $this->collSpySspAssetToCompanyBusinessUnits = $spySspAssetToCompanyBusinessUnits;
        $this->collSpySspAssetToCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspAssetToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspAssetToCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspAssetToCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspAssetToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpySspAssetToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspAssetToCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspAssetToCompanyBusinessUnits());
            }

            $query = SpySspAssetToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpySspAssetToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpySspAssetToCompanyBusinessUnit object to this object
     * through the SpySspAssetToCompanyBusinessUnit foreign key attribute.
     *
     * @param SpySspAssetToCompanyBusinessUnit $l SpySspAssetToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspAssetToCompanyBusinessUnit(SpySspAssetToCompanyBusinessUnit $l)
    {
        if ($this->collSpySspAssetToCompanyBusinessUnits === null) {
            $this->initSpySspAssetToCompanyBusinessUnits();
            $this->collSpySspAssetToCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpySspAssetToCompanyBusinessUnits->contains($l)) {
            $this->doAddSpySspAssetToCompanyBusinessUnit($l);

            if ($this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion and $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->remove($this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspAssetToCompanyBusinessUnit $spySspAssetToCompanyBusinessUnit The SpySspAssetToCompanyBusinessUnit object to add.
     */
    protected function doAddSpySspAssetToCompanyBusinessUnit(SpySspAssetToCompanyBusinessUnit $spySspAssetToCompanyBusinessUnit): void
    {
        $this->collSpySspAssetToCompanyBusinessUnits[]= $spySspAssetToCompanyBusinessUnit;
        $spySspAssetToCompanyBusinessUnit->setSpyCompanyBusinessUnit($this);
    }

    /**
     * @param SpySspAssetToCompanyBusinessUnit $spySspAssetToCompanyBusinessUnit The SpySspAssetToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspAssetToCompanyBusinessUnit(SpySspAssetToCompanyBusinessUnit $spySspAssetToCompanyBusinessUnit)
    {
        if ($this->getSpySspAssetToCompanyBusinessUnits()->contains($spySspAssetToCompanyBusinessUnit)) {
            $pos = $this->collSpySspAssetToCompanyBusinessUnits->search($spySspAssetToCompanyBusinessUnit);
            $this->collSpySspAssetToCompanyBusinessUnits->remove($pos);
            if (null === $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpySspAssetToCompanyBusinessUnits;
                $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spySspAssetToCompanyBusinessUnitsScheduledForDeletion[]= clone $spySspAssetToCompanyBusinessUnit;
            $spySspAssetToCompanyBusinessUnit->setSpyCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpySspAssetToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspAssetToCompanyBusinessUnit[] List of SpySspAssetToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAssetToCompanyBusinessUnit}> List of SpySspAssetToCompanyBusinessUnit objects
     */
    public function getSpySspAssetToCompanyBusinessUnitsJoinSpySspAsset(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspAssetToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('SpySspAsset', $joinBehavior);

        return $this->getSpySspAssetToCompanyBusinessUnits($query, $con);
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
        if (null !== $this->aCompany) {
            $this->aCompany->removeCompanyBusinessUnit($this);
        }
        if (null !== $this->aParentCompanyBusinessUnit) {
            $this->aParentCompanyBusinessUnit->removeChildrenCompanyBusinessUnits($this);
        }
        if (null !== $this->aCompanyBusinessUnitDefaultBillingAddress) {
            $this->aCompanyBusinessUnitDefaultBillingAddress->removeSpyCompanyBusinessUnit($this);
        }
        $this->id_company_business_unit = null;
        $this->fk_company = null;
        $this->fk_parent_company_business_unit = null;
        $this->bic = null;
        $this->default_billing_address = null;
        $this->email = null;
        $this->external_url = null;
        $this->iban = null;
        $this->key = null;
        $this->name = null;
        $this->phone = null;
        $this->uuid = null;
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
            if ($this->collChildrenCompanyBusinessUnitss) {
                foreach ($this->collChildrenCompanyBusinessUnitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyBusinessUnitFiles) {
                foreach ($this->collSpyCompanyBusinessUnitFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyUsers) {
                foreach ($this->collCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyUserInvitations) {
                foreach ($this->collSpyCompanyUserInvitations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationRequests) {
                foreach ($this->collSpyMerchantRelationRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {
                foreach ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationships) {
                foreach ($this->collSpyMerchantRelationships as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationshipToCompanyBusinessUnits) {
                foreach ($this->collSpyMerchantRelationshipToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListCompanyBusinessUnits) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspAssets) {
                foreach ($this->collSpySspAssets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspAssetToCompanyBusinessUnits) {
                foreach ($this->collSpySspAssetToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collChildrenCompanyBusinessUnitss = null;
        $this->collSpyCompanyBusinessUnitFiles = null;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;
        $this->collCompanyUsers = null;
        $this->collSpyCompanyUserInvitations = null;
        $this->collSpyMerchantRelationRequests = null;
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null;
        $this->collSpyMerchantRelationships = null;
        $this->collSpyMerchantRelationshipToCompanyBusinessUnits = null;
        $this->collSpyShoppingListCompanyBusinessUnits = null;
        $this->collSpySspAssets = null;
        $this->collSpySspAssetToCompanyBusinessUnits = null;
        $this->aCompany = null;
        $this->aParentCompanyBusinessUnit = null;
        $this->aCompanyBusinessUnitDefaultBillingAddress = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCompanyBusinessUnitTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_company_business_unit' . '.' . $this->getIdCompanyBusinessUnit() . '.' . $this->getFkCompany();
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
