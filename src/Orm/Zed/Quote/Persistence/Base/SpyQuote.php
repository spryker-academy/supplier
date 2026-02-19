<?php

namespace Orm\Zed\Quote\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery;
use Orm\Zed\QuoteApproval\Persistence\Base\SpyQuoteApproval as BaseSpyQuoteApproval;
use Orm\Zed\QuoteApproval\Persistence\Map\SpyQuoteApprovalTableMap;
use Orm\Zed\Quote\Persistence\SpyQuote as ChildSpyQuote;
use Orm\Zed\Quote\Persistence\SpyQuoteQuery as ChildSpyQuoteQuery;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery;
use Orm\Zed\SharedCart\Persistence\Base\SpyQuoteCompanyUser as BaseSpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuoteCompanyUserTableMap;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
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
 * Base class that represents a row from the 'spy_quote' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Quote.Persistence.Base
 */
abstract class SpyQuote implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Quote\\Persistence\\Map\\SpyQuoteTableMap';


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
     * The value for the id_quote field.
     *
     * @var        int
     */
    protected $id_quote;

    /**
     * The value for the fk_store field.
     *
     * @var        int
     */
    protected $fk_store;

    /**
     * The value for the customer_reference field.
     * A unique reference for a customer.
     * @var        string
     */
    protected $customer_reference;

    /**
     * The value for the is_default field.
     * A flag indicating if an entity is the default one.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_default;

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
     * The value for the quote_data field.
     * A serialized representation of a quote, stored with a sales order amendment.
     * @var        string
     */
    protected $quote_data;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

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
     * @var        SpyStore
     */
    protected $aSpyStore;

    /**
     * @var        ObjectCollection|SpyQuoteCompanyUser[] Collection to store aggregation of SpyQuoteCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteCompanyUser> Collection to store aggregation of SpyQuoteCompanyUser objects.
     */
    protected $collSpyQuoteCompanyUsers;
    protected $collSpyQuoteCompanyUsersPartial;

    /**
     * @var        ObjectCollection|SpyQuoteApproval[] Collection to store aggregation of SpyQuoteApproval objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteApproval> Collection to store aggregation of SpyQuoteApproval objects.
     */
    protected $collSpyQuoteApprovals;
    protected $collSpyQuoteApprovalsPartial;

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
     * @var ObjectCollection|SpyQuoteCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteCompanyUser>
     */
    protected $spyQuoteCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuoteApproval[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuoteApproval>
     */
    protected $spyQuoteApprovalsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_default = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Quote\Persistence\Base\SpyQuote object.
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
     * Compares this with another <code>SpyQuote</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyQuote</code>, delegates to
     * <code>equals(SpyQuote)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_quote] column value.
     *
     * @return int
     */
    public function getIdQuote()
    {
        return $this->id_quote;
    }

    /**
     * Get the [fk_store] column value.
     *
     * @return int
     */
    public function getFkStore()
    {
        return $this->fk_store;
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
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean|null
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean|null
     */
    public function isDefault()
    {
        return $this->getIsDefault();
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
     * Get the [quote_data] column value.
     * A serialized representation of a quote, stored with a sales order amendment.
     * @return string
     */
    public function getQuoteData()
    {
        return $this->quote_data;
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
     * Set the value of [id_quote] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdQuote($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_quote !== $v) {
            $this->id_quote = $v;
            $this->modifiedColumns[SpyQuoteTableMap::COL_ID_QUOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_store] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkStore($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_store !== $v) {
            $this->fk_store = $v;
            $this->modifiedColumns[SpyQuoteTableMap::COL_FK_STORE] = true;
        }

        if ($this->aSpyStore !== null && $this->aSpyStore->getIdStore() !== $v) {
            $this->aSpyStore = null;
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
            $this->modifiedColumns[SpyQuoteTableMap::COL_CUSTOMER_REFERENCE] = true;
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
     * @param bool|integer|string|null $v The new value
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
            $this->modifiedColumns[SpyQuoteTableMap::COL_IS_DEFAULT] = true;
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
            $this->modifiedColumns[SpyQuoteTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyQuoteTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quote_data] column.
     * A serialized representation of a quote, stored with a sales order amendment.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuoteData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quote_data !== $v) {
            $this->quote_data = $v;
            $this->modifiedColumns[SpyQuoteTableMap::COL_QUOTE_DATA] = true;
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
            $this->modifiedColumns[SpyQuoteTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyQuoteTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyQuoteTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyQuoteTableMap::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_quote = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyQuoteTableMap::translateFieldName('FkStore', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_store = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyQuoteTableMap::translateFieldName('CustomerReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyQuoteTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyQuoteTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyQuoteTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyQuoteTableMap::translateFieldName('QuoteData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quote_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyQuoteTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyQuoteTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyQuoteTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SpyQuoteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Quote\\Persistence\\SpyQuote'), 0, $e);
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
        if ($this->aSpyStore !== null && $this->fk_store !== $this->aSpyStore->getIdStore()) {
            $this->aSpyStore = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyQuoteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyQuoteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyStore = null;
            $this->collSpyQuoteCompanyUsers = null;

            $this->collSpyQuoteApprovals = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyQuote::setDeleted()
     * @see SpyQuote::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyQuoteQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyQuoteTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyQuoteTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyQuoteTableMap::COL_UPDATED_AT)) {
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
                SpyQuoteTableMap::addInstanceToPool($this);
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

            if ($this->aSpyStore !== null) {
                if ($this->aSpyStore->isModified() || $this->aSpyStore->isNew()) {
                    $affectedRows += $this->aSpyStore->save($con);
                }
                $this->setSpyStore($this->aSpyStore);
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

        $this->modifiedColumns[SpyQuoteTableMap::COL_ID_QUOTE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyQuoteTableMap::COL_ID_QUOTE)) {
            $modifiedColumns[':p' . $index++]  = '`id_quote`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_FK_STORE)) {
            $modifiedColumns[':p' . $index++]  = '`fk_store`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_CUSTOMER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = '`customer_reference`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`is_default`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_QUOTE_DATA)) {
            $modifiedColumns[':p' . $index++]  = '`quote_data`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_quote` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_quote`':
                        $stmt->bindValue($identifier, $this->id_quote, PDO::PARAM_INT);

                        break;
                    case '`fk_store`':
                        $stmt->bindValue($identifier, $this->fk_store, PDO::PARAM_INT);

                        break;
                    case '`customer_reference`':
                        $stmt->bindValue($identifier, $this->customer_reference, PDO::PARAM_STR);

                        break;
                    case '`is_default`':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`quote_data`':
                        $stmt->bindValue($identifier, $this->quote_data, PDO::PARAM_STR);

                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('id_quote_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdQuote($pk);
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
        $pos = SpyQuoteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdQuote();

            case 1:
                return $this->getFkStore();

            case 2:
                return $this->getCustomerReference();

            case 3:
                return $this->getIsDefault();

            case 4:
                return $this->getKey();

            case 5:
                return $this->getName();

            case 6:
                return $this->getQuoteData();

            case 7:
                return $this->getUuid();

            case 8:
                return $this->getCreatedAt();

            case 9:
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
        if (isset($alreadyDumpedObjects['SpyQuote'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyQuote'][$this->hashCode()] = true;
        $keys = SpyQuoteTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdQuote(),
            $keys[1] => $this->getFkStore(),
            $keys[2] => $this->getCustomerReference(),
            $keys[3] => $this->getIsDefault(),
            $keys[4] => $this->getKey(),
            $keys[5] => $this->getName(),
            $keys[6] => $this->getQuoteData(),
            $keys[7] => $this->getUuid(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyStore) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStore';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_store';
                        break;
                    default:
                        $key = 'SpyStore';
                }

                $result[$key] = $this->aSpyStore->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyQuoteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdQuote($value);
                break;
            case 1:
                $this->setFkStore($value);
                break;
            case 2:
                $this->setCustomerReference($value);
                break;
            case 3:
                $this->setIsDefault($value);
                break;
            case 4:
                $this->setKey($value);
                break;
            case 5:
                $this->setName($value);
                break;
            case 6:
                $this->setQuoteData($value);
                break;
            case 7:
                $this->setUuid($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
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
        $keys = SpyQuoteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdQuote($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkStore($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCustomerReference($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsDefault($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setKey($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQuoteData($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUuid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
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
        $criteria = new Criteria(SpyQuoteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyQuoteTableMap::COL_ID_QUOTE)) {
            $criteria->add(SpyQuoteTableMap::COL_ID_QUOTE, $this->id_quote);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_FK_STORE)) {
            $criteria->add(SpyQuoteTableMap::COL_FK_STORE, $this->fk_store);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_CUSTOMER_REFERENCE)) {
            $criteria->add(SpyQuoteTableMap::COL_CUSTOMER_REFERENCE, $this->customer_reference);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SpyQuoteTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_KEY)) {
            $criteria->add(SpyQuoteTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_NAME)) {
            $criteria->add(SpyQuoteTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_QUOTE_DATA)) {
            $criteria->add(SpyQuoteTableMap::COL_QUOTE_DATA, $this->quote_data);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_UUID)) {
            $criteria->add(SpyQuoteTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyQuoteTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyQuoteTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyQuoteTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyQuoteQuery::create();
        $criteria->add(SpyQuoteTableMap::COL_ID_QUOTE, $this->id_quote);

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
        $validPk = null !== $this->getIdQuote();

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
        return $this->getIdQuote();
    }

    /**
     * Generic method to set the primary key (id_quote column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdQuote($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdQuote();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Quote\Persistence\SpyQuote (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkStore($this->getFkStore());
        $copyObj->setCustomerReference($this->getCustomerReference());
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setQuoteData($this->getQuoteData());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyQuoteCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuoteApprovals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteApproval($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdQuote(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Quote\Persistence\SpyQuote Clone of current object.
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
     * Declares an association between this object and a SpyStore object.
     *
     * @param SpyStore $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyStore(SpyStore $v = null)
    {
        if ($v === null) {
            $this->setFkStore(NULL);
        } else {
            $this->setFkStore($v->getIdStore());
        }

        $this->aSpyStore = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyStore object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyQuote($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyStore object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyStore The associated SpyStore object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyStore(?ConnectionInterface $con = null)
    {
        if ($this->aSpyStore === null && ($this->fk_store != 0)) {
            $this->aSpyStore = SpyStoreQuery::create()->findPk($this->fk_store, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyStore->addSpyQuotes($this);
             */
        }

        return $this->aSpyStore;
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
        if ('SpyQuoteCompanyUser' === $relationName) {
            $this->initSpyQuoteCompanyUsers();
            return;
        }
        if ('SpyQuoteApproval' === $relationName) {
            $this->initSpyQuoteApprovals();
            return;
        }
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
     * If this ChildSpyQuote is new, it will return
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
                    ->filterBySpyQuote($this)
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
            $spyQuoteCompanyUserRemoved->setSpyQuote(null);
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
                ->filterBySpyQuote($this)
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
        $spyQuoteCompanyUser->setSpyQuote($this);
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
            $spyQuoteCompanyUser->setSpyQuote(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuote is new, it will return
     * an empty collection; or if this SpyQuote has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuote.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuoteCompanyUser[] List of SpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteCompanyUser}> List of SpyQuoteCompanyUser objects
     */
    public function getSpyQuoteCompanyUsersJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuoteCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyQuoteCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuote is new, it will return
     * an empty collection; or if this SpyQuote has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuote.
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
     * If this ChildSpyQuote is new, it will return
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
                    ->filterBySpyQuote($this)
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
            $spyQuoteApprovalRemoved->setSpyQuote(null);
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
                ->filterBySpyQuote($this)
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
        $spyQuoteApproval->setSpyQuote($this);
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
            $spyQuoteApproval->setSpyQuote(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuote is new, it will return
     * an empty collection; or if this SpyQuote has previously
     * been saved, it will retrieve related SpyQuoteApprovals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuote.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuoteApproval[] List of SpyQuoteApproval objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuoteApproval}> List of SpyQuoteApproval objects
     */
    public function getSpyQuoteApprovalsJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuoteApprovalQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyQuoteApprovals($query, $con);
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
        if (null !== $this->aSpyStore) {
            $this->aSpyStore->removeSpyQuote($this);
        }
        $this->id_quote = null;
        $this->fk_store = null;
        $this->customer_reference = null;
        $this->is_default = null;
        $this->key = null;
        $this->name = null;
        $this->quote_data = null;
        $this->uuid = null;
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
            if ($this->collSpyQuoteCompanyUsers) {
                foreach ($this->collSpyQuoteCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuoteApprovals) {
                foreach ($this->collSpyQuoteApprovals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyQuoteCompanyUsers = null;
        $this->collSpyQuoteApprovals = null;
        $this->aSpyStore = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyQuoteTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_quote' . '.' . $this->getCustomerReference() . '.' . $this->getIdQuote();
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
        $this->modifiedColumns[SpyQuoteTableMap::COL_UPDATED_AT] = true;

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
