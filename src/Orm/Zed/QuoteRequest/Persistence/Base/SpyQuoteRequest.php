<?php

namespace Orm\Zed\QuoteRequest\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest as ChildSpyQuoteRequest;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery as ChildSpyQuoteRequestQuery;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion as ChildSpyQuoteRequestVersion;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery as ChildSpyQuoteRequestVersionQuery;
use Orm\Zed\QuoteRequest\Persistence\Map\SpyQuoteRequestTableMap;
use Orm\Zed\QuoteRequest\Persistence\Map\SpyQuoteRequestVersionTableMap;
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
 * Base class that represents a row from the 'spy_quote_request' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.QuoteRequest.Persistence.Base
 */
abstract class SpyQuoteRequest implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\QuoteRequest\\Persistence\\Map\\SpyQuoteRequestTableMap';


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
     * The value for the id_quote_request field.
     *
     * @var        int
     */
    protected $id_quote_request;

    /**
     * The value for the fk_company_user field.
     *
     * @var        int
     */
    protected $fk_company_user;

    /**
     * The value for the quote_request_reference field.
     * A unique reference for a quote request.
     * @var        string
     */
    protected $quote_request_reference;

    /**
     * The value for the valid_until field.
     * The date until which an entity is valid.
     * @var        DateTime|null
     */
    protected $valid_until;

    /**
     * The value for the status field.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the is_latest_version_visible field.
     * A flag indicating if the latest version of a quote request is visible.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_latest_version_visible;

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
     * @var        SpyCompanyUser
     */
    protected $aCompanyUser;

    /**
     * @var        ObjectCollection|ChildSpyQuoteRequestVersion[] Collection to store aggregation of ChildSpyQuoteRequestVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuoteRequestVersion> Collection to store aggregation of ChildSpyQuoteRequestVersion objects.
     */
    protected $collSpyQuoteRequestVersions;
    protected $collSpyQuoteRequestVersionsPartial;

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
     * @var ObjectCollection|ChildSpyQuoteRequestVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuoteRequestVersion>
     */
    protected $spyQuoteRequestVersionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_latest_version_visible = true;
    }

    /**
     * Initializes internal state of Orm\Zed\QuoteRequest\Persistence\Base\SpyQuoteRequest object.
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
     * Compares this with another <code>SpyQuoteRequest</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyQuoteRequest</code>, delegates to
     * <code>equals(SpyQuoteRequest)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_quote_request] column value.
     *
     * @return int
     */
    public function getIdQuoteRequest()
    {
        return $this->id_quote_request;
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
     * Get the [quote_request_reference] column value.
     * A unique reference for a quote request.
     * @return string
     */
    public function getQuoteRequestReference()
    {
        return $this->quote_request_reference;
    }

    /**
     * Get the [optionally formatted] temporal [valid_until] column value.
     * The date until which an entity is valid.
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
    public function getValidUntil($format = null)
    {
        if ($format === null) {
            return $this->valid_until;
        } else {
            return $this->valid_until instanceof \DateTimeInterface ? $this->valid_until->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [is_latest_version_visible] column value.
     * A flag indicating if the latest version of a quote request is visible.
     * @return boolean|null
     */
    public function getIsLatestVersionVisible()
    {
        return $this->is_latest_version_visible;
    }

    /**
     * Get the [is_latest_version_visible] column value.
     * A flag indicating if the latest version of a quote request is visible.
     * @return boolean|null
     */
    public function isLatestVersionVisible()
    {
        return $this->getIsLatestVersionVisible();
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
     * Set the value of [id_quote_request] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdQuoteRequest($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_quote_request !== $v) {
            $this->id_quote_request = $v;
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST] = true;
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
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_FK_COMPANY_USER] = true;
        }

        if ($this->aCompanyUser !== null && $this->aCompanyUser->getIdCompanyUser() !== $v) {
            $this->aCompanyUser = null;
        }

        return $this;
    }

    /**
     * Set the value of [quote_request_reference] column.
     * A unique reference for a quote request.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuoteRequestReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quote_request_reference !== $v) {
            $this->quote_request_reference = $v;
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [valid_until] column to a normalized version of the date/time value specified.
     * The date until which an entity is valid.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setValidUntil($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->valid_until !== null || $dt !== null) {
            if ($this->valid_until === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->valid_until->format("Y-m-d H:i:s.u")) {
                $this->valid_until = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyQuoteRequestTableMap::COL_VALID_UNTIL] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [status] column.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @param string|null $v New value
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
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_latest_version_visible] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if the latest version of a quote request is visible.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsLatestVersionVisible($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_latest_version_visible !== $v) {
            $this->is_latest_version_visible = $v;
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE] = true;
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
            $this->modifiedColumns[SpyQuoteRequestTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyQuoteRequestTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyQuoteRequestTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_latest_version_visible !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyQuoteRequestTableMap::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_quote_request = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyQuoteRequestTableMap::translateFieldName('FkCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyQuoteRequestTableMap::translateFieldName('QuoteRequestReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quote_request_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyQuoteRequestTableMap::translateFieldName('ValidUntil', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_until = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyQuoteRequestTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyQuoteRequestTableMap::translateFieldName('IsLatestVersionVisible', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_latest_version_visible = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyQuoteRequestTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyQuoteRequestTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyQuoteRequestTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpyQuoteRequestTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequest'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyQuoteRequestQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompanyUser = null;
            $this->collSpyQuoteRequestVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyQuoteRequest::setDeleted()
     * @see SpyQuoteRequest::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyQuoteRequestQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyQuoteRequestTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyQuoteRequestTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyQuoteRequestTableMap::COL_UPDATED_AT)) {
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
                SpyQuoteRequestTableMap::addInstanceToPool($this);
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

            if ($this->spyQuoteRequestVersionsScheduledForDeletion !== null) {
                if (!$this->spyQuoteRequestVersionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery::create()
                        ->filterByPrimaryKeys($this->spyQuoteRequestVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuoteRequestVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuoteRequestVersions !== null) {
                foreach ($this->collSpyQuoteRequestVersions as $referrerFK) {
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

        $this->modifiedColumns[SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST] = true;
        if (null !== $this->id_quote_request) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST)) {
            $modifiedColumns[':p' . $index++]  = 'id_quote_request';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_company_user';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'quote_request_reference';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_VALID_UNTIL)) {
            $modifiedColumns[':p' . $index++]  = 'valid_until';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_latest_version_visible';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'uuid';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_quote_request (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_quote_request':
                        $stmt->bindValue($identifier, $this->id_quote_request, PDO::PARAM_INT);

                        break;
                    case 'fk_company_user':
                        $stmt->bindValue($identifier, $this->fk_company_user, PDO::PARAM_INT);

                        break;
                    case 'quote_request_reference':
                        $stmt->bindValue($identifier, $this->quote_request_reference, PDO::PARAM_STR);

                        break;
                    case 'valid_until':
                        $stmt->bindValue($identifier, $this->valid_until ? $this->valid_until->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'is_latest_version_visible':
                        $stmt->bindValue($identifier, (int) $this->is_latest_version_visible, PDO::PARAM_INT);

                        break;
                    case 'uuid':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_quote_request_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdQuoteRequest($pk);

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
        $pos = SpyQuoteRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdQuoteRequest();

            case 1:
                return $this->getFkCompanyUser();

            case 2:
                return $this->getQuoteRequestReference();

            case 3:
                return $this->getValidUntil();

            case 4:
                return $this->getStatus();

            case 5:
                return $this->getIsLatestVersionVisible();

            case 6:
                return $this->getUuid();

            case 7:
                return $this->getCreatedAt();

            case 8:
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
        if (isset($alreadyDumpedObjects['SpyQuoteRequest'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyQuoteRequest'][$this->hashCode()] = true;
        $keys = SpyQuoteRequestTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdQuoteRequest(),
            $keys[1] => $this->getFkCompanyUser(),
            $keys[2] => $this->getQuoteRequestReference(),
            $keys[3] => $this->getValidUntil(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getIsLatestVersionVisible(),
            $keys[6] => $this->getUuid(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->collSpyQuoteRequestVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuoteRequestVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quote_request_versions';
                        break;
                    default:
                        $key = 'SpyQuoteRequestVersions';
                }

                $result[$key] = $this->collSpyQuoteRequestVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyQuoteRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdQuoteRequest($value);
                break;
            case 1:
                $this->setFkCompanyUser($value);
                break;
            case 2:
                $this->setQuoteRequestReference($value);
                break;
            case 3:
                $this->setValidUntil($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setIsLatestVersionVisible($value);
                break;
            case 6:
                $this->setUuid($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = SpyQuoteRequestTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdQuoteRequest($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompanyUser($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setQuoteRequestReference($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setValidUntil($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsLatestVersionVisible($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUuid($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyQuoteRequestTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $this->id_quote_request);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $this->fk_company_user);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE, $this->quote_request_reference);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_VALID_UNTIL)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_VALID_UNTIL, $this->valid_until);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_STATUS)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE, $this->is_latest_version_visible);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_UUID)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyQuoteRequestTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyQuoteRequestTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyQuoteRequestQuery::create();
        $criteria->add(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $this->id_quote_request);

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
        $validPk = null !== $this->getIdQuoteRequest();

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
        return $this->getIdQuoteRequest();
    }

    /**
     * Generic method to set the primary key (id_quote_request column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdQuoteRequest($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdQuoteRequest();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompanyUser($this->getFkCompanyUser());
        $copyObj->setQuoteRequestReference($this->getQuoteRequestReference());
        $copyObj->setValidUntil($this->getValidUntil());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsLatestVersionVisible($this->getIsLatestVersionVisible());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyQuoteRequestVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteRequestVersion($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdQuoteRequest(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest Clone of current object.
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
            $v->addSpyQuoteRequest($this);
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
                $this->aCompanyUser->addSpyQuoteRequests($this);
             */
        }

        return $this->aCompanyUser;
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
        if ('SpyQuoteRequestVersion' === $relationName) {
            $this->initSpyQuoteRequestVersions();
            return;
        }
    }

    /**
     * Clears out the collSpyQuoteRequestVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuoteRequestVersions()
     */
    public function clearSpyQuoteRequestVersions()
    {
        $this->collSpyQuoteRequestVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuoteRequestVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuoteRequestVersions($v = true): void
    {
        $this->collSpyQuoteRequestVersionsPartial = $v;
    }

    /**
     * Initializes the collSpyQuoteRequestVersions collection.
     *
     * By default this just sets the collSpyQuoteRequestVersions collection to an empty array (like clearcollSpyQuoteRequestVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuoteRequestVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuoteRequestVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuoteRequestVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuoteRequestVersions = new $collectionClassName;
        $this->collSpyQuoteRequestVersions->setModel('\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion');
    }

    /**
     * Gets an array of ChildSpyQuoteRequestVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyQuoteRequest is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyQuoteRequestVersion[] List of ChildSpyQuoteRequestVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuoteRequestVersion> List of ChildSpyQuoteRequestVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuoteRequestVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuoteRequestVersionsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteRequestVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuoteRequestVersions) {
                    $this->initSpyQuoteRequestVersions();
                } else {
                    $collectionClassName = SpyQuoteRequestVersionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuoteRequestVersions = new $collectionClassName;
                    $collSpyQuoteRequestVersions->setModel('\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion');

                    return $collSpyQuoteRequestVersions;
                }
            } else {
                $collSpyQuoteRequestVersions = ChildSpyQuoteRequestVersionQuery::create(null, $criteria)
                    ->filterBySpyQuoteRequest($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuoteRequestVersionsPartial && count($collSpyQuoteRequestVersions)) {
                        $this->initSpyQuoteRequestVersions(false);

                        foreach ($collSpyQuoteRequestVersions as $obj) {
                            if (false == $this->collSpyQuoteRequestVersions->contains($obj)) {
                                $this->collSpyQuoteRequestVersions->append($obj);
                            }
                        }

                        $this->collSpyQuoteRequestVersionsPartial = true;
                    }

                    return $collSpyQuoteRequestVersions;
                }

                if ($partial && $this->collSpyQuoteRequestVersions) {
                    foreach ($this->collSpyQuoteRequestVersions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuoteRequestVersions[] = $obj;
                        }
                    }
                }

                $this->collSpyQuoteRequestVersions = $collSpyQuoteRequestVersions;
                $this->collSpyQuoteRequestVersionsPartial = false;
            }
        }

        return $this->collSpyQuoteRequestVersions;
    }

    /**
     * Sets a collection of ChildSpyQuoteRequestVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuoteRequestVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuoteRequestVersions(Collection $spyQuoteRequestVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyQuoteRequestVersion[] $spyQuoteRequestVersionsToDelete */
        $spyQuoteRequestVersionsToDelete = $this->getSpyQuoteRequestVersions(new Criteria(), $con)->diff($spyQuoteRequestVersions);


        $this->spyQuoteRequestVersionsScheduledForDeletion = $spyQuoteRequestVersionsToDelete;

        foreach ($spyQuoteRequestVersionsToDelete as $spyQuoteRequestVersionRemoved) {
            $spyQuoteRequestVersionRemoved->setSpyQuoteRequest(null);
        }

        $this->collSpyQuoteRequestVersions = null;
        foreach ($spyQuoteRequestVersions as $spyQuoteRequestVersion) {
            $this->addSpyQuoteRequestVersion($spyQuoteRequestVersion);
        }

        $this->collSpyQuoteRequestVersions = $spyQuoteRequestVersions;
        $this->collSpyQuoteRequestVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyQuoteRequestVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyQuoteRequestVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuoteRequestVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuoteRequestVersionsPartial && !$this->isNew();
        if (null === $this->collSpyQuoteRequestVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuoteRequestVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuoteRequestVersions());
            }

            $query = ChildSpyQuoteRequestVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyQuoteRequest($this)
                ->count($con);
        }

        return count($this->collSpyQuoteRequestVersions);
    }

    /**
     * Method called to associate a ChildSpyQuoteRequestVersion object to this object
     * through the ChildSpyQuoteRequestVersion foreign key attribute.
     *
     * @param ChildSpyQuoteRequestVersion $l ChildSpyQuoteRequestVersion
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuoteRequestVersion(ChildSpyQuoteRequestVersion $l)
    {
        if ($this->collSpyQuoteRequestVersions === null) {
            $this->initSpyQuoteRequestVersions();
            $this->collSpyQuoteRequestVersionsPartial = true;
        }

        if (!$this->collSpyQuoteRequestVersions->contains($l)) {
            $this->doAddSpyQuoteRequestVersion($l);

            if ($this->spyQuoteRequestVersionsScheduledForDeletion and $this->spyQuoteRequestVersionsScheduledForDeletion->contains($l)) {
                $this->spyQuoteRequestVersionsScheduledForDeletion->remove($this->spyQuoteRequestVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyQuoteRequestVersion $spyQuoteRequestVersion The ChildSpyQuoteRequestVersion object to add.
     */
    protected function doAddSpyQuoteRequestVersion(ChildSpyQuoteRequestVersion $spyQuoteRequestVersion): void
    {
        $this->collSpyQuoteRequestVersions[]= $spyQuoteRequestVersion;
        $spyQuoteRequestVersion->setSpyQuoteRequest($this);
    }

    /**
     * @param ChildSpyQuoteRequestVersion $spyQuoteRequestVersion The ChildSpyQuoteRequestVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuoteRequestVersion(ChildSpyQuoteRequestVersion $spyQuoteRequestVersion)
    {
        if ($this->getSpyQuoteRequestVersions()->contains($spyQuoteRequestVersion)) {
            $pos = $this->collSpyQuoteRequestVersions->search($spyQuoteRequestVersion);
            $this->collSpyQuoteRequestVersions->remove($pos);
            if (null === $this->spyQuoteRequestVersionsScheduledForDeletion) {
                $this->spyQuoteRequestVersionsScheduledForDeletion = clone $this->collSpyQuoteRequestVersions;
                $this->spyQuoteRequestVersionsScheduledForDeletion->clear();
            }
            $this->spyQuoteRequestVersionsScheduledForDeletion[]= clone $spyQuoteRequestVersion;
            $spyQuoteRequestVersion->setSpyQuoteRequest(null);
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
        if (null !== $this->aCompanyUser) {
            $this->aCompanyUser->removeSpyQuoteRequest($this);
        }
        $this->id_quote_request = null;
        $this->fk_company_user = null;
        $this->quote_request_reference = null;
        $this->valid_until = null;
        $this->status = null;
        $this->is_latest_version_visible = null;
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
            if ($this->collSpyQuoteRequestVersions) {
                foreach ($this->collSpyQuoteRequestVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyQuoteRequestVersions = null;
        $this->aCompanyUser = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyQuoteRequestTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_quote_request' . '.' . $this->getQuoteRequestReference();
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
        $this->modifiedColumns[SpyQuoteRequestTableMap::COL_UPDATED_AT] = true;

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
