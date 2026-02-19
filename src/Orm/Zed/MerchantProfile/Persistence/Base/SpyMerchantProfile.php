<?php

namespace Orm\Zed\MerchantProfile\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile as ChildSpyMerchantProfile;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress as ChildSpyMerchantProfileAddress;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery as ChildSpyMerchantProfileAddressQuery;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery as ChildSpyMerchantProfileQuery;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileAddressTableMap;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileTableMap;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
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
 * Base class that represents a row from the 'spy_merchant_profile' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantProfile.Persistence.Base
 */
abstract class SpyMerchantProfile implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantProfile\\Persistence\\Map\\SpyMerchantProfileTableMap';


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
     * The value for the id_merchant_profile field.
     *
     * @var        int
     */
    protected $id_merchant_profile;

    /**
     * The value for the contact_person_role field.
     * The role of a contact person.
     * @var        string|null
     */
    protected $contact_person_role;

    /**
     * The value for the contact_person_title field.
     * The title of a contact person (e.g., Mr, Ms).
     * @var        int|null
     */
    protected $contact_person_title;

    /**
     * The value for the contact_person_first_name field.
     * The first name of a contact person.
     * @var        string|null
     */
    protected $contact_person_first_name;

    /**
     * The value for the contact_person_last_name field.
     * The last name of a contact person.
     * @var        string|null
     */
    protected $contact_person_last_name;

    /**
     * The value for the contact_person_phone field.
     * The phone number of a contact person.
     * @var        string|null
     */
    protected $contact_person_phone;

    /**
     * The value for the logo_url field.
     * The URL for the merchant's logo image.
     * @var        string|null
     */
    protected $logo_url;

    /**
     * The value for the public_email field.
     * The publicly visible email address for a merchant.
     * @var        string|null
     */
    protected $public_email;

    /**
     * The value for the public_phone field.
     * The publicly visible phone number for a merchant.
     * @var        string|null
     */
    protected $public_phone;

    /**
     * The value for the fax_number field.
     * The fax number for a merchant profile.
     * @var        string|null
     */
    protected $fax_number;

    /**
     * The value for the description_glossary_key field.
     * The glossary key for the description text.
     * @var        string|null
     */
    protected $description_glossary_key;

    /**
     * The value for the banner_url_glossary_key field.
     * The glossary key for the banner URL.
     * @var        string|null
     */
    protected $banner_url_glossary_key;

    /**
     * The value for the delivery_time_glossary_key field.
     * The glossary key for the delivery time text.
     * @var        string|null
     */
    protected $delivery_time_glossary_key;

    /**
     * The value for the terms_conditions_glossary_key field.
     * The glossary key for the terms and conditions.
     * @var        string|null
     */
    protected $terms_conditions_glossary_key;

    /**
     * The value for the cancellation_policy_glossary_key field.
     * The glossary key for the cancellation policy text.
     * @var        string|null
     */
    protected $cancellation_policy_glossary_key;

    /**
     * The value for the imprint_glossary_key field.
     * The glossary key for the imprint text.
     * @var        string|null
     */
    protected $imprint_glossary_key;

    /**
     * The value for the data_privacy_glossary_key field.
     * The glossary key for the data privacy policy.
     * @var        string|null
     */
    protected $data_privacy_glossary_key;

    /**
     * The value for the fk_merchant field.
     *
     * @var        int
     */
    protected $fk_merchant;

    /**
     * @var        SpyMerchant
     */
    protected $aSpyMerchant;

    /**
     * @var        ObjectCollection|ChildSpyMerchantProfileAddress[] Collection to store aggregation of ChildSpyMerchantProfileAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantProfileAddress> Collection to store aggregation of ChildSpyMerchantProfileAddress objects.
     */
    protected $collSpyMerchantProfileAddresses;
    protected $collSpyMerchantProfileAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyMerchantProfileAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantProfileAddress>
     */
    protected $spyMerchantProfileAddressesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\MerchantProfile\Persistence\Base\SpyMerchantProfile object.
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
     * Compares this with another <code>SpyMerchantProfile</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantProfile</code>, delegates to
     * <code>equals(SpyMerchantProfile)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_profile] column value.
     *
     * @return int
     */
    public function getIdMerchantProfile()
    {
        return $this->id_merchant_profile;
    }

    /**
     * Get the [contact_person_role] column value.
     * The role of a contact person.
     * @return string|null
     */
    public function getContactPersonRole()
    {
        return $this->contact_person_role;
    }

    /**
     * Get the [contact_person_title] column value.
     * The title of a contact person (e.g., Mr, Ms).
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getContactPersonTitle()
    {
        if (null === $this->contact_person_title) {
            return null;
        }
        $valueSet = SpyMerchantProfileTableMap::getValueSet(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
        if (!isset($valueSet[$this->contact_person_title])) {
            throw new PropelException('Unknown stored enum key: ' . $this->contact_person_title);
        }

        return $valueSet[$this->contact_person_title];
    }

    /**
     * Get the [contact_person_first_name] column value.
     * The first name of a contact person.
     * @return string|null
     */
    public function getContactPersonFirstName()
    {
        return $this->contact_person_first_name;
    }

    /**
     * Get the [contact_person_last_name] column value.
     * The last name of a contact person.
     * @return string|null
     */
    public function getContactPersonLastName()
    {
        return $this->contact_person_last_name;
    }

    /**
     * Get the [contact_person_phone] column value.
     * The phone number of a contact person.
     * @return string|null
     */
    public function getContactPersonPhone()
    {
        return $this->contact_person_phone;
    }

    /**
     * Get the [logo_url] column value.
     * The URL for the merchant's logo image.
     * @return string|null
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }

    /**
     * Get the [public_email] column value.
     * The publicly visible email address for a merchant.
     * @return string|null
     */
    public function getPublicEmail()
    {
        return $this->public_email;
    }

    /**
     * Get the [public_phone] column value.
     * The publicly visible phone number for a merchant.
     * @return string|null
     */
    public function getPublicPhone()
    {
        return $this->public_phone;
    }

    /**
     * Get the [fax_number] column value.
     * The fax number for a merchant profile.
     * @return string|null
     */
    public function getFaxNumber()
    {
        return $this->fax_number;
    }

    /**
     * Get the [description_glossary_key] column value.
     * The glossary key for the description text.
     * @return string|null
     */
    public function getDescriptionGlossaryKey()
    {
        return $this->description_glossary_key;
    }

    /**
     * Get the [banner_url_glossary_key] column value.
     * The glossary key for the banner URL.
     * @return string|null
     */
    public function getBannerUrlGlossaryKey()
    {
        return $this->banner_url_glossary_key;
    }

    /**
     * Get the [delivery_time_glossary_key] column value.
     * The glossary key for the delivery time text.
     * @return string|null
     */
    public function getDeliveryTimeGlossaryKey()
    {
        return $this->delivery_time_glossary_key;
    }

    /**
     * Get the [terms_conditions_glossary_key] column value.
     * The glossary key for the terms and conditions.
     * @return string|null
     */
    public function getTermsConditionsGlossaryKey()
    {
        return $this->terms_conditions_glossary_key;
    }

    /**
     * Get the [cancellation_policy_glossary_key] column value.
     * The glossary key for the cancellation policy text.
     * @return string|null
     */
    public function getCancellationPolicyGlossaryKey()
    {
        return $this->cancellation_policy_glossary_key;
    }

    /**
     * Get the [imprint_glossary_key] column value.
     * The glossary key for the imprint text.
     * @return string|null
     */
    public function getImprintGlossaryKey()
    {
        return $this->imprint_glossary_key;
    }

    /**
     * Get the [data_privacy_glossary_key] column value.
     * The glossary key for the data privacy policy.
     * @return string|null
     */
    public function getDataPrivacyGlossaryKey()
    {
        return $this->data_privacy_glossary_key;
    }

    /**
     * Get the [fk_merchant] column value.
     *
     * @return int
     */
    public function getFkMerchant()
    {
        return $this->fk_merchant;
    }

    /**
     * Set the value of [id_merchant_profile] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantProfile($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_profile !== $v) {
            $this->id_merchant_profile = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact_person_role] column.
     * The role of a contact person.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContactPersonRole($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->contact_person_role !== $v) {
            $this->contact_person_role = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact_person_title] column.
     * The title of a contact person (e.g., Mr, Ms).
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setContactPersonTitle($v)
    {
        if ($v !== null) {
            $valueSet = SpyMerchantProfileTableMap::getValueSet(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->contact_person_title !== $v) {
            $this->contact_person_title = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact_person_first_name] column.
     * The first name of a contact person.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContactPersonFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->contact_person_first_name !== $v) {
            $this->contact_person_first_name = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact_person_last_name] column.
     * The last name of a contact person.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContactPersonLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->contact_person_last_name !== $v) {
            $this->contact_person_last_name = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact_person_phone] column.
     * The phone number of a contact person.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContactPersonPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->contact_person_phone !== $v) {
            $this->contact_person_phone = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [logo_url] column.
     * The URL for the merchant's logo image.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLogoUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->logo_url !== $v) {
            $this->logo_url = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_LOGO_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [public_email] column.
     * The publicly visible email address for a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPublicEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->public_email !== $v) {
            $this->public_email = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [public_phone] column.
     * The publicly visible phone number for a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPublicPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->public_phone !== $v) {
            $this->public_phone = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_PUBLIC_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fax_number] column.
     * The fax number for a merchant profile.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFaxNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fax_number !== $v) {
            $this->fax_number = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_FAX_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description_glossary_key] column.
     * The glossary key for the description text.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescriptionGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->description_glossary_key !== $v) {
            $this->description_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [banner_url_glossary_key] column.
     * The glossary key for the banner URL.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBannerUrlGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->banner_url_glossary_key !== $v) {
            $this->banner_url_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [delivery_time_glossary_key] column.
     * The glossary key for the delivery time text.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeliveryTimeGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->delivery_time_glossary_key !== $v) {
            $this->delivery_time_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [terms_conditions_glossary_key] column.
     * The glossary key for the terms and conditions.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTermsConditionsGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->terms_conditions_glossary_key !== $v) {
            $this->terms_conditions_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cancellation_policy_glossary_key] column.
     * The glossary key for the cancellation policy text.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCancellationPolicyGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->cancellation_policy_glossary_key !== $v) {
            $this->cancellation_policy_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [imprint_glossary_key] column.
     * The glossary key for the imprint text.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImprintGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->imprint_glossary_key !== $v) {
            $this->imprint_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [data_privacy_glossary_key] column.
     * The glossary key for the data privacy policy.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDataPrivacyGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->data_privacy_glossary_key !== $v) {
            $this->data_privacy_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_merchant] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkMerchant($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_merchant !== $v) {
            $this->fk_merchant = $v;
            $this->modifiedColumns[SpyMerchantProfileTableMap::COL_FK_MERCHANT] = true;
        }

        if ($this->aSpyMerchant !== null && $this->aSpyMerchant->getIdMerchant() !== $v) {
            $this->aSpyMerchant = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantProfileTableMap::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_profile = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ContactPersonRole', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_person_role = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ContactPersonTitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_person_title = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ContactPersonFirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_person_first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ContactPersonLastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_person_last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ContactPersonPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_person_phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantProfileTableMap::translateFieldName('LogoUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logo_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantProfileTableMap::translateFieldName('PublicEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->public_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantProfileTableMap::translateFieldName('PublicPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->public_phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantProfileTableMap::translateFieldName('FaxNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyMerchantProfileTableMap::translateFieldName('DescriptionGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyMerchantProfileTableMap::translateFieldName('BannerUrlGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->banner_url_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyMerchantProfileTableMap::translateFieldName('DeliveryTimeGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_time_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyMerchantProfileTableMap::translateFieldName('TermsConditionsGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->terms_conditions_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyMerchantProfileTableMap::translateFieldName('CancellationPolicyGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cancellation_policy_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyMerchantProfileTableMap::translateFieldName('ImprintGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imprint_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyMerchantProfileTableMap::translateFieldName('DataPrivacyGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data_privacy_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpyMerchantProfileTableMap::translateFieldName('FkMerchant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = SpyMerchantProfileTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile'), 0, $e);
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
        if ($this->aSpyMerchant !== null && $this->fk_merchant !== $this->aSpyMerchant->getIdMerchant()) {
            $this->aSpyMerchant = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantProfileQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyMerchant = null;
            $this->collSpyMerchantProfileAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantProfile::setDeleted()
     * @see SpyMerchantProfile::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantProfileQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
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
                SpyMerchantProfileTableMap::addInstanceToPool($this);
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

            if ($this->aSpyMerchant !== null) {
                if ($this->aSpyMerchant->isModified() || $this->aSpyMerchant->isNew()) {
                    $affectedRows += $this->aSpyMerchant->save($con);
                }
                $this->setSpyMerchant($this->aSpyMerchant);
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

            if ($this->spyMerchantProfileAddressesScheduledForDeletion !== null) {
                if (!$this->spyMerchantProfileAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantProfileAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantProfileAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProfileAddresses !== null) {
                foreach ($this->collSpyMerchantProfileAddresses as $referrerFK) {
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

        $this->modifiedColumns[SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE] = true;
        if (null !== $this->id_merchant_profile) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE)) {
            $modifiedColumns[':p' . $index++]  = '`id_merchant_profile`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person_role`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person_title`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person_first_name`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person_last_name`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person_phone`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_LOGO_URL)) {
            $modifiedColumns[':p' . $index++]  = '`logo_url`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`public_email`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`public_phone`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_FAX_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`fax_number`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`description_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`banner_url_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_time_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`terms_conditions_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`cancellation_policy_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`imprint_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`data_privacy_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_FK_MERCHANT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_merchant`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_merchant_profile` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_merchant_profile`':
                        $stmt->bindValue($identifier, $this->id_merchant_profile, PDO::PARAM_INT);

                        break;
                    case '`contact_person_role`':
                        $stmt->bindValue($identifier, $this->contact_person_role, PDO::PARAM_STR);

                        break;
                    case '`contact_person_title`':
                        $stmt->bindValue($identifier, $this->contact_person_title, PDO::PARAM_INT);

                        break;
                    case '`contact_person_first_name`':
                        $stmt->bindValue($identifier, $this->contact_person_first_name, PDO::PARAM_STR);

                        break;
                    case '`contact_person_last_name`':
                        $stmt->bindValue($identifier, $this->contact_person_last_name, PDO::PARAM_STR);

                        break;
                    case '`contact_person_phone`':
                        $stmt->bindValue($identifier, $this->contact_person_phone, PDO::PARAM_STR);

                        break;
                    case '`logo_url`':
                        $stmt->bindValue($identifier, $this->logo_url, PDO::PARAM_STR);

                        break;
                    case '`public_email`':
                        $stmt->bindValue($identifier, $this->public_email, PDO::PARAM_STR);

                        break;
                    case '`public_phone`':
                        $stmt->bindValue($identifier, $this->public_phone, PDO::PARAM_STR);

                        break;
                    case '`fax_number`':
                        $stmt->bindValue($identifier, $this->fax_number, PDO::PARAM_STR);

                        break;
                    case '`description_glossary_key`':
                        $stmt->bindValue($identifier, $this->description_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`banner_url_glossary_key`':
                        $stmt->bindValue($identifier, $this->banner_url_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`delivery_time_glossary_key`':
                        $stmt->bindValue($identifier, $this->delivery_time_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`terms_conditions_glossary_key`':
                        $stmt->bindValue($identifier, $this->terms_conditions_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`cancellation_policy_glossary_key`':
                        $stmt->bindValue($identifier, $this->cancellation_policy_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`imprint_glossary_key`':
                        $stmt->bindValue($identifier, $this->imprint_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`data_privacy_glossary_key`':
                        $stmt->bindValue($identifier, $this->data_privacy_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`fk_merchant`':
                        $stmt->bindValue($identifier, $this->fk_merchant, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchantProfile($pk);

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
        $pos = SpyMerchantProfileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantProfile();

            case 1:
                return $this->getContactPersonRole();

            case 2:
                return $this->getContactPersonTitle();

            case 3:
                return $this->getContactPersonFirstName();

            case 4:
                return $this->getContactPersonLastName();

            case 5:
                return $this->getContactPersonPhone();

            case 6:
                return $this->getLogoUrl();

            case 7:
                return $this->getPublicEmail();

            case 8:
                return $this->getPublicPhone();

            case 9:
                return $this->getFaxNumber();

            case 10:
                return $this->getDescriptionGlossaryKey();

            case 11:
                return $this->getBannerUrlGlossaryKey();

            case 12:
                return $this->getDeliveryTimeGlossaryKey();

            case 13:
                return $this->getTermsConditionsGlossaryKey();

            case 14:
                return $this->getCancellationPolicyGlossaryKey();

            case 15:
                return $this->getImprintGlossaryKey();

            case 16:
                return $this->getDataPrivacyGlossaryKey();

            case 17:
                return $this->getFkMerchant();

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
        if (isset($alreadyDumpedObjects['SpyMerchantProfile'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantProfile'][$this->hashCode()] = true;
        $keys = SpyMerchantProfileTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantProfile(),
            $keys[1] => $this->getContactPersonRole(),
            $keys[2] => $this->getContactPersonTitle(),
            $keys[3] => $this->getContactPersonFirstName(),
            $keys[4] => $this->getContactPersonLastName(),
            $keys[5] => $this->getContactPersonPhone(),
            $keys[6] => $this->getLogoUrl(),
            $keys[7] => $this->getPublicEmail(),
            $keys[8] => $this->getPublicPhone(),
            $keys[9] => $this->getFaxNumber(),
            $keys[10] => $this->getDescriptionGlossaryKey(),
            $keys[11] => $this->getBannerUrlGlossaryKey(),
            $keys[12] => $this->getDeliveryTimeGlossaryKey(),
            $keys[13] => $this->getTermsConditionsGlossaryKey(),
            $keys[14] => $this->getCancellationPolicyGlossaryKey(),
            $keys[15] => $this->getImprintGlossaryKey(),
            $keys[16] => $this->getDataPrivacyGlossaryKey(),
            $keys[17] => $this->getFkMerchant(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyMerchant) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchant';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant';
                        break;
                    default:
                        $key = 'SpyMerchant';
                }

                $result[$key] = $this->aSpyMerchant->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyMerchantProfileAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProfileAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_profile_addresses';
                        break;
                    default:
                        $key = 'SpyMerchantProfileAddresses';
                }

                $result[$key] = $this->collSpyMerchantProfileAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyMerchantProfileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantProfile($value);
                break;
            case 1:
                $this->setContactPersonRole($value);
                break;
            case 2:
                $valueSet = SpyMerchantProfileTableMap::getValueSet(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setContactPersonTitle($value);
                break;
            case 3:
                $this->setContactPersonFirstName($value);
                break;
            case 4:
                $this->setContactPersonLastName($value);
                break;
            case 5:
                $this->setContactPersonPhone($value);
                break;
            case 6:
                $this->setLogoUrl($value);
                break;
            case 7:
                $this->setPublicEmail($value);
                break;
            case 8:
                $this->setPublicPhone($value);
                break;
            case 9:
                $this->setFaxNumber($value);
                break;
            case 10:
                $this->setDescriptionGlossaryKey($value);
                break;
            case 11:
                $this->setBannerUrlGlossaryKey($value);
                break;
            case 12:
                $this->setDeliveryTimeGlossaryKey($value);
                break;
            case 13:
                $this->setTermsConditionsGlossaryKey($value);
                break;
            case 14:
                $this->setCancellationPolicyGlossaryKey($value);
                break;
            case 15:
                $this->setImprintGlossaryKey($value);
                break;
            case 16:
                $this->setDataPrivacyGlossaryKey($value);
                break;
            case 17:
                $this->setFkMerchant($value);
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
        $keys = SpyMerchantProfileTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantProfile($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setContactPersonRole($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setContactPersonTitle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setContactPersonFirstName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setContactPersonLastName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setContactPersonPhone($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLogoUrl($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPublicEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPublicPhone($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFaxNumber($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDescriptionGlossaryKey($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setBannerUrlGlossaryKey($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDeliveryTimeGlossaryKey($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTermsConditionsGlossaryKey($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCancellationPolicyGlossaryKey($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setImprintGlossaryKey($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDataPrivacyGlossaryKey($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setFkMerchant($arr[$keys[17]]);
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
        $criteria = new Criteria(SpyMerchantProfileTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $this->id_merchant_profile);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE, $this->contact_person_role);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE, $this->contact_person_title);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME, $this->contact_person_first_name);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME, $this->contact_person_last_name);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE, $this->contact_person_phone);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_LOGO_URL)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_LOGO_URL, $this->logo_url);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL, $this->public_email);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE, $this->public_phone);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_FAX_NUMBER)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_FAX_NUMBER, $this->fax_number);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY, $this->description_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY, $this->banner_url_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY, $this->delivery_time_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY, $this->terms_conditions_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY, $this->cancellation_policy_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY, $this->imprint_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY, $this->data_privacy_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantProfileTableMap::COL_FK_MERCHANT)) {
            $criteria->add(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $this->fk_merchant);
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
        $criteria = ChildSpyMerchantProfileQuery::create();
        $criteria->add(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $this->id_merchant_profile);

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
        $validPk = null !== $this->getIdMerchantProfile();

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
        return $this->getIdMerchantProfile();
    }

    /**
     * Generic method to set the primary key (id_merchant_profile column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantProfile($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantProfile();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setContactPersonRole($this->getContactPersonRole());
        $copyObj->setContactPersonTitle($this->getContactPersonTitle());
        $copyObj->setContactPersonFirstName($this->getContactPersonFirstName());
        $copyObj->setContactPersonLastName($this->getContactPersonLastName());
        $copyObj->setContactPersonPhone($this->getContactPersonPhone());
        $copyObj->setLogoUrl($this->getLogoUrl());
        $copyObj->setPublicEmail($this->getPublicEmail());
        $copyObj->setPublicPhone($this->getPublicPhone());
        $copyObj->setFaxNumber($this->getFaxNumber());
        $copyObj->setDescriptionGlossaryKey($this->getDescriptionGlossaryKey());
        $copyObj->setBannerUrlGlossaryKey($this->getBannerUrlGlossaryKey());
        $copyObj->setDeliveryTimeGlossaryKey($this->getDeliveryTimeGlossaryKey());
        $copyObj->setTermsConditionsGlossaryKey($this->getTermsConditionsGlossaryKey());
        $copyObj->setCancellationPolicyGlossaryKey($this->getCancellationPolicyGlossaryKey());
        $copyObj->setImprintGlossaryKey($this->getImprintGlossaryKey());
        $copyObj->setDataPrivacyGlossaryKey($this->getDataPrivacyGlossaryKey());
        $copyObj->setFkMerchant($this->getFkMerchant());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantProfileAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProfileAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantProfile(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile Clone of current object.
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
     * Declares an association between this object and a SpyMerchant object.
     *
     * @param SpyMerchant $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyMerchant(SpyMerchant $v = null)
    {
        if ($v === null) {
            $this->setFkMerchant(NULL);
        } else {
            $this->setFkMerchant($v->getIdMerchant());
        }

        $this->aSpyMerchant = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyMerchant object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantProfile($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyMerchant object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyMerchant The associated SpyMerchant object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchant(?ConnectionInterface $con = null)
    {
        if ($this->aSpyMerchant === null && ($this->fk_merchant != 0)) {
            $this->aSpyMerchant = SpyMerchantQuery::create()->findPk($this->fk_merchant, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyMerchant->addSpyMerchantProfiles($this);
             */
        }

        return $this->aSpyMerchant;
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
        if ('SpyMerchantProfileAddress' === $relationName) {
            $this->initSpyMerchantProfileAddresses();
            return;
        }
    }

    /**
     * Clears out the collSpyMerchantProfileAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProfileAddresses()
     */
    public function clearSpyMerchantProfileAddresses()
    {
        $this->collSpyMerchantProfileAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProfileAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProfileAddresses($v = true): void
    {
        $this->collSpyMerchantProfileAddressesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProfileAddresses collection.
     *
     * By default this just sets the collSpyMerchantProfileAddresses collection to an empty array (like clearcollSpyMerchantProfileAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProfileAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProfileAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProfileAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProfileAddresses = new $collectionClassName;
        $this->collSpyMerchantProfileAddresses->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress');
    }

    /**
     * Gets an array of ChildSpyMerchantProfileAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantProfile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantProfileAddress[] List of ChildSpyMerchantProfileAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantProfileAddress> List of ChildSpyMerchantProfileAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProfileAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProfileAddressesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfileAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProfileAddresses) {
                    $this->initSpyMerchantProfileAddresses();
                } else {
                    $collectionClassName = SpyMerchantProfileAddressTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProfileAddresses = new $collectionClassName;
                    $collSpyMerchantProfileAddresses->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress');

                    return $collSpyMerchantProfileAddresses;
                }
            } else {
                $collSpyMerchantProfileAddresses = ChildSpyMerchantProfileAddressQuery::create(null, $criteria)
                    ->filterBySpyMerchantProfile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProfileAddressesPartial && count($collSpyMerchantProfileAddresses)) {
                        $this->initSpyMerchantProfileAddresses(false);

                        foreach ($collSpyMerchantProfileAddresses as $obj) {
                            if (false == $this->collSpyMerchantProfileAddresses->contains($obj)) {
                                $this->collSpyMerchantProfileAddresses->append($obj);
                            }
                        }

                        $this->collSpyMerchantProfileAddressesPartial = true;
                    }

                    return $collSpyMerchantProfileAddresses;
                }

                if ($partial && $this->collSpyMerchantProfileAddresses) {
                    foreach ($this->collSpyMerchantProfileAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProfileAddresses[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProfileAddresses = $collSpyMerchantProfileAddresses;
                $this->collSpyMerchantProfileAddressesPartial = false;
            }
        }

        return $this->collSpyMerchantProfileAddresses;
    }

    /**
     * Sets a collection of ChildSpyMerchantProfileAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProfileAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProfileAddresses(Collection $spyMerchantProfileAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyMerchantProfileAddress[] $spyMerchantProfileAddressesToDelete */
        $spyMerchantProfileAddressesToDelete = $this->getSpyMerchantProfileAddresses(new Criteria(), $con)->diff($spyMerchantProfileAddresses);


        $this->spyMerchantProfileAddressesScheduledForDeletion = $spyMerchantProfileAddressesToDelete;

        foreach ($spyMerchantProfileAddressesToDelete as $spyMerchantProfileAddressRemoved) {
            $spyMerchantProfileAddressRemoved->setSpyMerchantProfile(null);
        }

        $this->collSpyMerchantProfileAddresses = null;
        foreach ($spyMerchantProfileAddresses as $spyMerchantProfileAddress) {
            $this->addSpyMerchantProfileAddress($spyMerchantProfileAddress);
        }

        $this->collSpyMerchantProfileAddresses = $spyMerchantProfileAddresses;
        $this->collSpyMerchantProfileAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyMerchantProfileAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantProfileAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProfileAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProfileAddressesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfileAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProfileAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProfileAddresses());
            }

            $query = ChildSpyMerchantProfileAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchantProfile($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProfileAddresses);
    }

    /**
     * Method called to associate a ChildSpyMerchantProfileAddress object to this object
     * through the ChildSpyMerchantProfileAddress foreign key attribute.
     *
     * @param ChildSpyMerchantProfileAddress $l ChildSpyMerchantProfileAddress
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProfileAddress(ChildSpyMerchantProfileAddress $l)
    {
        if ($this->collSpyMerchantProfileAddresses === null) {
            $this->initSpyMerchantProfileAddresses();
            $this->collSpyMerchantProfileAddressesPartial = true;
        }

        if (!$this->collSpyMerchantProfileAddresses->contains($l)) {
            $this->doAddSpyMerchantProfileAddress($l);

            if ($this->spyMerchantProfileAddressesScheduledForDeletion and $this->spyMerchantProfileAddressesScheduledForDeletion->contains($l)) {
                $this->spyMerchantProfileAddressesScheduledForDeletion->remove($this->spyMerchantProfileAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyMerchantProfileAddress $spyMerchantProfileAddress The ChildSpyMerchantProfileAddress object to add.
     */
    protected function doAddSpyMerchantProfileAddress(ChildSpyMerchantProfileAddress $spyMerchantProfileAddress): void
    {
        $this->collSpyMerchantProfileAddresses[]= $spyMerchantProfileAddress;
        $spyMerchantProfileAddress->setSpyMerchantProfile($this);
    }

    /**
     * @param ChildSpyMerchantProfileAddress $spyMerchantProfileAddress The ChildSpyMerchantProfileAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProfileAddress(ChildSpyMerchantProfileAddress $spyMerchantProfileAddress)
    {
        if ($this->getSpyMerchantProfileAddresses()->contains($spyMerchantProfileAddress)) {
            $pos = $this->collSpyMerchantProfileAddresses->search($spyMerchantProfileAddress);
            $this->collSpyMerchantProfileAddresses->remove($pos);
            if (null === $this->spyMerchantProfileAddressesScheduledForDeletion) {
                $this->spyMerchantProfileAddressesScheduledForDeletion = clone $this->collSpyMerchantProfileAddresses;
                $this->spyMerchantProfileAddressesScheduledForDeletion->clear();
            }
            $this->spyMerchantProfileAddressesScheduledForDeletion[]= clone $spyMerchantProfileAddress;
            $spyMerchantProfileAddress->setSpyMerchantProfile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantProfile is new, it will return
     * an empty collection; or if this SpyMerchantProfile has previously
     * been saved, it will retrieve related SpyMerchantProfileAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantProfile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantProfileAddress[] List of ChildSpyMerchantProfileAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantProfileAddress}> List of ChildSpyMerchantProfileAddress objects
     */
    public function getSpyMerchantProfileAddressesJoinSpyCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantProfileAddressQuery::create(null, $criteria);
        $query->joinWith('SpyCountry', $joinBehavior);

        return $this->getSpyMerchantProfileAddresses($query, $con);
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
        if (null !== $this->aSpyMerchant) {
            $this->aSpyMerchant->removeSpyMerchantProfile($this);
        }
        $this->id_merchant_profile = null;
        $this->contact_person_role = null;
        $this->contact_person_title = null;
        $this->contact_person_first_name = null;
        $this->contact_person_last_name = null;
        $this->contact_person_phone = null;
        $this->logo_url = null;
        $this->public_email = null;
        $this->public_phone = null;
        $this->fax_number = null;
        $this->description_glossary_key = null;
        $this->banner_url_glossary_key = null;
        $this->delivery_time_glossary_key = null;
        $this->terms_conditions_glossary_key = null;
        $this->cancellation_policy_glossary_key = null;
        $this->imprint_glossary_key = null;
        $this->data_privacy_glossary_key = null;
        $this->fk_merchant = null;
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
            if ($this->collSpyMerchantProfileAddresses) {
                foreach ($this->collSpyMerchantProfileAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantProfileAddresses = null;
        $this->aSpyMerchant = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantProfileTableMap::DEFAULT_STRING_FORMAT);
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
