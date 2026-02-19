<?php

namespace Orm\Zed\MerchantRelationRequest\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest as ChildSpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery as ChildSpyMerchantRelationRequestQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit as ChildSpyMerchantRelationRequestToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery as ChildSpyMerchantRelationRequestToCompanyBusinessUnitQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestToCompanyBusinessUnitTableMap;
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
use Propel\Runtime\Util\PropelDateTime;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_merchant_relation_request' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantRelationRequest.Persistence.Base
 */
abstract class SpyMerchantRelationRequest implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\Map\\SpyMerchantRelationRequestTableMap';


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
     * The value for the id_merchant_relation_request field.
     *
     * @var        int
     */
    protected $id_merchant_relation_request;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * The value for the status field.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @var        string
     */
    protected $status;

    /**
     * The value for the is_split_enabled field.
     * A flag indicating if the merchant relation request allows for split orders.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_split_enabled;

    /**
     * The value for the request_note field.
     * A note or message included with a merchant relation request.
     * @var        string|null
     */
    protected $request_note;

    /**
     * The value for the decision_note field.
     * A note explaining a decision, e.g., for a merchant relation request.
     * @var        string|null
     */
    protected $decision_note;

    /**
     * The value for the fk_company_user field.
     *
     * @var        int
     */
    protected $fk_company_user;

    /**
     * The value for the fk_merchant field.
     *
     * @var        int
     */
    protected $fk_merchant;

    /**
     * The value for the fk_company_business_unit field.
     *
     * @var        int
     */
    protected $fk_company_business_unit;

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
     * @var        SpyCompanyUser
     */
    protected $aCompanyUser;

    /**
     * @var        SpyMerchant
     */
    protected $aMerchant;

    /**
     * @var        SpyCompanyBusinessUnit
     */
    protected $aCompanyBusinessUnit;

    /**
     * @var        ObjectCollection|ChildSpyMerchantRelationRequestToCompanyBusinessUnit[] Collection to store aggregation of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantRelationRequestToCompanyBusinessUnit> Collection to store aggregation of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects.
     */
    protected $collSpyMerchantRelationRequestToCompanyBusinessUnits;
    protected $collSpyMerchantRelationRequestToCompanyBusinessUnitsPartial;

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
     * @var ObjectCollection|ChildSpyMerchantRelationRequestToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantRelationRequestToCompanyBusinessUnit>
     */
    protected $spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_split_enabled = false;
    }

    /**
     * Initializes internal state of Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequest object.
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
     * Compares this with another <code>SpyMerchantRelationRequest</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantRelationRequest</code>, delegates to
     * <code>equals(SpyMerchantRelationRequest)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_relation_request] column value.
     *
     * @return int
     */
    public function getIdMerchantRelationRequest()
    {
        return $this->id_merchant_relation_request;
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
     * Get the [status] column value.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [is_split_enabled] column value.
     * A flag indicating if the merchant relation request allows for split orders.
     * @return boolean|null
     */
    public function getIsSplitEnabled()
    {
        return $this->is_split_enabled;
    }

    /**
     * Get the [is_split_enabled] column value.
     * A flag indicating if the merchant relation request allows for split orders.
     * @return boolean|null
     */
    public function isSplitEnabled()
    {
        return $this->getIsSplitEnabled();
    }

    /**
     * Get the [request_note] column value.
     * A note or message included with a merchant relation request.
     * @return string|null
     */
    public function getRequestNote()
    {
        return $this->request_note;
    }

    /**
     * Get the [decision_note] column value.
     * A note explaining a decision, e.g., for a merchant relation request.
     * @return string|null
     */
    public function getDecisionNote()
    {
        return $this->decision_note;
    }

    /**
     * Get the [fk_company_user] column value.
     *
     * @return int
     */
    public function getFkCompanyUser()
    {
        return $this->fk_company_user;
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
     * Get the [fk_company_business_unit] column value.
     *
     * @return int
     */
    public function getFkCompanyBusinessUnit()
    {
        return $this->fk_company_business_unit;
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
     * Set the value of [id_merchant_relation_request] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantRelationRequest($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_relation_request !== $v) {
            $this->id_merchant_relation_request = $v;
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST] = true;
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
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_UUID] = true;
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
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_split_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if the merchant relation request allows for split orders.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsSplitEnabled($v)
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
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->is_split_enabled !== $v) {
            $this->is_split_enabled = $v;
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [request_note] column.
     * A note or message included with a merchant relation request.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRequestNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->request_note !== $v) {
            $this->request_note = $v;
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [decision_note] column.
     * A note explaining a decision, e.g., for a merchant relation request.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDecisionNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->decision_note !== $v) {
            $this->decision_note = $v;
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company_user] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCompanyUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_company_user !== $v) {
            $this->fk_company_user = $v;
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER] = true;
        }

        if ($this->aCompanyUser !== null && $this->aCompanyUser->getIdCompanyUser() !== $v) {
            $this->aCompanyUser = null;
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
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT] = true;
        }

        if ($this->aMerchant !== null && $this->aMerchant->getIdMerchant() !== $v) {
            $this->aMerchant = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company_business_unit] column.
     *
     * @param int $v New value
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
            $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT] = true;
        }

        if ($this->aCompanyBusinessUnit !== null && $this->aCompanyBusinessUnit->getIdCompanyBusinessUnit() !== $v) {
            $this->aCompanyBusinessUnit = null;
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
                $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_split_enabled !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_relation_request = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('IsSplitEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_split_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('RequestNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->request_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('DecisionNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->decision_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('FkCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('FkMerchant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('FkCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyMerchantRelationRequestTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SpyMerchantRelationRequestTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest'), 0, $e);
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
        if ($this->aCompanyUser !== null && $this->fk_company_user !== $this->aCompanyUser->getIdCompanyUser()) {
            $this->aCompanyUser = null;
        }
        if ($this->aMerchant !== null && $this->fk_merchant !== $this->aMerchant->getIdMerchant()) {
            $this->aMerchant = null;
        }
        if ($this->aCompanyBusinessUnit !== null && $this->fk_company_business_unit !== $this->aCompanyBusinessUnit->getIdCompanyBusinessUnit()) {
            $this->aCompanyBusinessUnit = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantRelationRequestQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompanyUser = null;
            $this->aMerchant = null;
            $this->aCompanyBusinessUnit = null;
            $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantRelationRequest::setDeleted()
     * @see SpyMerchantRelationRequest::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantRelationRequestQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT)) {
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT)) {
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
                    // uuid behavior
                    $this->updateUuidAfterInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyMerchantRelationRequestTableMap::addInstanceToPool($this);
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

            if ($this->aCompanyUser !== null) {
                if ($this->aCompanyUser->isModified() || $this->aCompanyUser->isNew()) {
                    $affectedRows += $this->aCompanyUser->save($con);
                }
                $this->setCompanyUser($this->aCompanyUser);
            }

            if ($this->aMerchant !== null) {
                if ($this->aMerchant->isModified() || $this->aMerchant->isNew()) {
                    $affectedRows += $this->aMerchant->save($con);
                }
                $this->setMerchant($this->aMerchant);
            }

            if ($this->aCompanyBusinessUnit !== null) {
                if ($this->aCompanyBusinessUnit->isModified() || $this->aCompanyBusinessUnit->isNew()) {
                    $affectedRows += $this->aCompanyBusinessUnit->save($con);
                }
                $this->setCompanyBusinessUnit($this->aCompanyBusinessUnit);
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

        $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST] = true;
        if (null !== $this->id_merchant_relation_request) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST)) {
            $modifiedColumns[':p' . $index++]  = 'id_merchant_relation_request';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'uuid';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'is_split_enabled';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'request_note';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'decision_note';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_company_user';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_merchant';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_company_business_unit';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_merchant_relation_request (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_merchant_relation_request':
                        $stmt->bindValue($identifier, $this->id_merchant_relation_request, PDO::PARAM_INT);

                        break;
                    case 'uuid':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'is_split_enabled':
                        $stmt->bindValue($identifier, (int) $this->is_split_enabled, PDO::PARAM_INT);

                        break;
                    case 'request_note':
                        $stmt->bindValue($identifier, $this->request_note, PDO::PARAM_STR);

                        break;
                    case 'decision_note':
                        $stmt->bindValue($identifier, $this->decision_note, PDO::PARAM_STR);

                        break;
                    case 'fk_company_user':
                        $stmt->bindValue($identifier, $this->fk_company_user, PDO::PARAM_INT);

                        break;
                    case 'fk_merchant':
                        $stmt->bindValue($identifier, $this->fk_merchant, PDO::PARAM_INT);

                        break;
                    case 'fk_company_business_unit':
                        $stmt->bindValue($identifier, $this->fk_company_business_unit, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_merchant_relation_request_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchantRelationRequest($pk);

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
        $pos = SpyMerchantRelationRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantRelationRequest();

            case 1:
                return $this->getUuid();

            case 2:
                return $this->getStatus();

            case 3:
                return $this->getIsSplitEnabled();

            case 4:
                return $this->getRequestNote();

            case 5:
                return $this->getDecisionNote();

            case 6:
                return $this->getFkCompanyUser();

            case 7:
                return $this->getFkMerchant();

            case 8:
                return $this->getFkCompanyBusinessUnit();

            case 9:
                return $this->getCreatedAt();

            case 10:
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
        if (isset($alreadyDumpedObjects['SpyMerchantRelationRequest'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantRelationRequest'][$this->hashCode()] = true;
        $keys = SpyMerchantRelationRequestTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantRelationRequest(),
            $keys[1] => $this->getUuid(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getIsSplitEnabled(),
            $keys[4] => $this->getRequestNote(),
            $keys[5] => $this->getDecisionNote(),
            $keys[6] => $this->getFkCompanyUser(),
            $keys[7] => $this->getFkMerchant(),
            $keys[8] => $this->getFkCompanyBusinessUnit(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompanyUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_user';
                        break;
                    default:
                        $key = 'CompanyUser';
                }

                $result[$key] = $this->aCompanyUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMerchant) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchant';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant';
                        break;
                    default:
                        $key = 'Merchant';
                }

                $result[$key] = $this->aMerchant->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
        $pos = SpyMerchantRelationRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantRelationRequest($value);
                break;
            case 1:
                $this->setUuid($value);
                break;
            case 2:
                $this->setStatus($value);
                break;
            case 3:
                $this->setIsSplitEnabled($value);
                break;
            case 4:
                $this->setRequestNote($value);
                break;
            case 5:
                $this->setDecisionNote($value);
                break;
            case 6:
                $this->setFkCompanyUser($value);
                break;
            case 7:
                $this->setFkMerchant($value);
                break;
            case 8:
                $this->setFkCompanyBusinessUnit($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
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
        $keys = SpyMerchantRelationRequestTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantRelationRequest($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUuid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsSplitEnabled($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRequestNote($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDecisionNote($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFkCompanyUser($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFkMerchant($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFkCompanyBusinessUnit($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
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
        $criteria = new Criteria(SpyMerchantRelationRequestTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $this->id_merchant_relation_request);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UUID)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_STATUS)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED, $this->is_split_enabled);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE, $this->request_note);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE, $this->decision_note);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $this->fk_company_user);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $this->fk_merchant);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $this->fk_company_business_unit);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantRelationRequestQuery::create();
        $criteria->add(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $this->id_merchant_relation_request);

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
        $validPk = null !== $this->getIdMerchantRelationRequest();

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
        return $this->getIdMerchantRelationRequest();
    }

    /**
     * Generic method to set the primary key (id_merchant_relation_request column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantRelationRequest($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantRelationRequest();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUuid($this->getUuid());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsSplitEnabled($this->getIsSplitEnabled());
        $copyObj->setRequestNote($this->getRequestNote());
        $copyObj->setDecisionNote($this->getDecisionNote());
        $copyObj->setFkCompanyUser($this->getFkCompanyUser());
        $copyObj->setFkMerchant($this->getFkMerchant());
        $copyObj->setFkCompanyBusinessUnit($this->getFkCompanyBusinessUnit());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantRelationRequestToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationRequestToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantRelationRequest(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest Clone of current object.
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
     * Declares an association between this object and a SpyCompanyUser object.
     *
     * @param SpyCompanyUser $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompanyUser(SpyCompanyUser $v = null)
    {
        if ($v === null) {
            $this->setFkCompanyUser(NULL);
        } else {
            $this->setFkCompanyUser($v->getIdCompanyUser());
        }

        $this->aCompanyUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompanyUser object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantRelationRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompanyUser object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompanyUser The associated SpyCompanyUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyUser(?ConnectionInterface $con = null)
    {
        if ($this->aCompanyUser === null && ($this->fk_company_user != 0)) {
            $this->aCompanyUser = SpyCompanyUserQuery::create()->findPk($this->fk_company_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyUser->addSpyMerchantRelationRequests($this);
             */
        }

        return $this->aCompanyUser;
    }

    /**
     * Declares an association between this object and a SpyMerchant object.
     *
     * @param SpyMerchant $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMerchant(SpyMerchant $v = null)
    {
        if ($v === null) {
            $this->setFkMerchant(NULL);
        } else {
            $this->setFkMerchant($v->getIdMerchant());
        }

        $this->aMerchant = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyMerchant object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantRelationRequest($this);
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
    public function getMerchant(?ConnectionInterface $con = null)
    {
        if ($this->aMerchant === null && ($this->fk_merchant != 0)) {
            $this->aMerchant = SpyMerchantQuery::create()->findPk($this->fk_merchant, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMerchant->addSpyMerchantRelationRequests($this);
             */
        }

        return $this->aMerchant;
    }

    /**
     * Declares an association between this object and a SpyCompanyBusinessUnit object.
     *
     * @param SpyCompanyBusinessUnit $v
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
            $v->addSpyMerchantRelationRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompanyBusinessUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompanyBusinessUnit The associated SpyCompanyBusinessUnit object.
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
                $this->aCompanyBusinessUnit->addSpyMerchantRelationRequests($this);
             */
        }

        return $this->aCompanyBusinessUnit;
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
        if ('SpyMerchantRelationRequestToCompanyBusinessUnit' === $relationName) {
            $this->initSpyMerchantRelationRequestToCompanyBusinessUnits();
            return;
        }
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
     * Gets an array of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantRelationRequest is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantRelationRequestToCompanyBusinessUnit[] List of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantRelationRequestToCompanyBusinessUnit> List of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects
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
                $collSpyMerchantRelationRequestToCompanyBusinessUnits = ChildSpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByMerchantRelationshipRequest($this)
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
     * Sets a collection of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects related by a one-to-many relationship
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
        /** @var ChildSpyMerchantRelationRequestToCompanyBusinessUnit[] $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete */
        $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete = $this->getSpyMerchantRelationRequestToCompanyBusinessUnits(new Criteria(), $con)->diff($spyMerchantRelationRequestToCompanyBusinessUnits);


        $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = $spyMerchantRelationRequestToCompanyBusinessUnitsToDelete;

        foreach ($spyMerchantRelationRequestToCompanyBusinessUnitsToDelete as $spyMerchantRelationRequestToCompanyBusinessUnitRemoved) {
            $spyMerchantRelationRequestToCompanyBusinessUnitRemoved->setMerchantRelationshipRequest(null);
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
     * Returns the number of related SpyMerchantRelationRequestToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantRelationRequestToCompanyBusinessUnit objects.
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

            $query = ChildSpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchantRelationshipRequest($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationRequestToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a ChildSpyMerchantRelationRequestToCompanyBusinessUnit object to this object
     * through the ChildSpyMerchantRelationRequestToCompanyBusinessUnit foreign key attribute.
     *
     * @param ChildSpyMerchantRelationRequestToCompanyBusinessUnit $l ChildSpyMerchantRelationRequestToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationRequestToCompanyBusinessUnit(ChildSpyMerchantRelationRequestToCompanyBusinessUnit $l)
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
     * @param ChildSpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit The ChildSpyMerchantRelationRequestToCompanyBusinessUnit object to add.
     */
    protected function doAddSpyMerchantRelationRequestToCompanyBusinessUnit(ChildSpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit): void
    {
        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits[]= $spyMerchantRelationRequestToCompanyBusinessUnit;
        $spyMerchantRelationRequestToCompanyBusinessUnit->setMerchantRelationshipRequest($this);
    }

    /**
     * @param ChildSpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit The ChildSpyMerchantRelationRequestToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationRequestToCompanyBusinessUnit(ChildSpyMerchantRelationRequestToCompanyBusinessUnit $spyMerchantRelationRequestToCompanyBusinessUnit)
    {
        if ($this->getSpyMerchantRelationRequestToCompanyBusinessUnits()->contains($spyMerchantRelationRequestToCompanyBusinessUnit)) {
            $pos = $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->search($spyMerchantRelationRequestToCompanyBusinessUnit);
            $this->collSpyMerchantRelationRequestToCompanyBusinessUnits->remove($pos);
            if (null === $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyMerchantRelationRequestToCompanyBusinessUnits;
                $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationRequestToCompanyBusinessUnitsScheduledForDeletion[]= clone $spyMerchantRelationRequestToCompanyBusinessUnit;
            $spyMerchantRelationRequestToCompanyBusinessUnit->setMerchantRelationshipRequest(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantRelationRequest is new, it will return
     * an empty collection; or if this SpyMerchantRelationRequest has previously
     * been saved, it will retrieve related SpyMerchantRelationRequestToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantRelationRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantRelationRequestToCompanyBusinessUnit[] List of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantRelationRequestToCompanyBusinessUnit}> List of ChildSpyMerchantRelationRequestToCompanyBusinessUnit objects
     */
    public function getSpyMerchantRelationRequestToCompanyBusinessUnitsJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantRelationRequestToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getSpyMerchantRelationRequestToCompanyBusinessUnits($query, $con);
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
        if (null !== $this->aCompanyUser) {
            $this->aCompanyUser->removeSpyMerchantRelationRequest($this);
        }
        if (null !== $this->aMerchant) {
            $this->aMerchant->removeSpyMerchantRelationRequest($this);
        }
        if (null !== $this->aCompanyBusinessUnit) {
            $this->aCompanyBusinessUnit->removeSpyMerchantRelationRequest($this);
        }
        $this->id_merchant_relation_request = null;
        $this->uuid = null;
        $this->status = null;
        $this->is_split_enabled = null;
        $this->request_note = null;
        $this->decision_note = null;
        $this->fk_company_user = null;
        $this->fk_merchant = null;
        $this->fk_company_business_unit = null;
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
            if ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits) {
                foreach ($this->collSpyMerchantRelationRequestToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantRelationRequestToCompanyBusinessUnits = null;
        $this->aCompanyUser = null;
        $this->aMerchant = null;
        $this->aCompanyBusinessUnit = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantRelationRequestTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_merchant_relation_request' . '.' . $this->getIdMerchantRelationRequest();
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantRelationRequestTableMap::COL_UPDATED_AT] = true;

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
