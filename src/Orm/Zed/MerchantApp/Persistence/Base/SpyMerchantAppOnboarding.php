<?php

namespace Orm\Zed\MerchantApp\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\KernelApp\Persistence\SpyAppConfig;
use Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding as ChildSpyMerchantAppOnboarding;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingQuery as ChildSpyMerchantAppOnboardingQuery;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus as ChildSpyMerchantAppOnboardingStatus;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery as ChildSpyMerchantAppOnboardingStatusQuery;
use Orm\Zed\MerchantApp\Persistence\Map\SpyMerchantAppOnboardingStatusTableMap;
use Orm\Zed\MerchantApp\Persistence\Map\SpyMerchantAppOnboardingTableMap;
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
 * Base class that represents a row from the 'spy_merchant_app_onboarding' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantApp.Persistence.Base
 */
abstract class SpyMerchantAppOnboarding implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantApp\\Persistence\\Map\\SpyMerchantAppOnboardingTableMap';


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
     * The value for the id_merchant_app_onboarding field.
     *
     * @var        int
     */
    protected $id_merchant_app_onboarding;

    /**
     * The value for the onboarding_url field.
     * The URL where a merchant can start the onboarding process for an app.
     * @var        string
     */
    protected $onboarding_url;

    /**
     * The value for the onboarding_strategy field.
     * The strategy used for merchant app onboarding (e.g., 'iframe', 'redirect').
     * @var        int
     */
    protected $onboarding_strategy;

    /**
     * The value for the type field.
     * Type can be e.g. 'payment' or 'legal' which is used to identify if a specific entity can be displayed and what. F.e. if onboarding of Payment Apps should be displayed in the Merchant Portal.
     * @var        string
     */
    protected $type;

    /**
     * The value for the app_name field.
     * The name of the application for which a merchant is being onboarded.
     * @var        string
     */
    protected $app_name;

    /**
     * The value for the app_identifier field.
     * A unique identifier for an application.
     * @var        string
     */
    protected $app_identifier;

    /**
     * The value for the additional_content field.
     * Additional content (text, links) to display for merchants.
     * @var        string|null
     */
    protected $additional_content;

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
     * @var        SpyAppConfig
     */
    protected $aSpyAppConfig;

    /**
     * @var        ObjectCollection|ChildSpyMerchantAppOnboardingStatus[] Collection to store aggregation of ChildSpyMerchantAppOnboardingStatus objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantAppOnboardingStatus> Collection to store aggregation of ChildSpyMerchantAppOnboardingStatus objects.
     */
    protected $collSpyMerchantAppOnboardingStatuses;
    protected $collSpyMerchantAppOnboardingStatusesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyMerchantAppOnboardingStatus[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantAppOnboardingStatus>
     */
    protected $spyMerchantAppOnboardingStatusesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\MerchantApp\Persistence\Base\SpyMerchantAppOnboarding object.
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
     * Compares this with another <code>SpyMerchantAppOnboarding</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantAppOnboarding</code>, delegates to
     * <code>equals(SpyMerchantAppOnboarding)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_app_onboarding] column value.
     *
     * @return int
     */
    public function getIdMerchantAppOnboarding()
    {
        return $this->id_merchant_app_onboarding;
    }

    /**
     * Get the [onboarding_url] column value.
     * The URL where a merchant can start the onboarding process for an app.
     * @return string
     */
    public function getOnboardingUrl()
    {
        return $this->onboarding_url;
    }

    /**
     * Get the [onboarding_strategy] column value.
     * The strategy used for merchant app onboarding (e.g., 'iframe', 'redirect').
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnboardingStrategy()
    {
        if (null === $this->onboarding_strategy) {
            return null;
        }
        $valueSet = SpyMerchantAppOnboardingTableMap::getValueSet(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
        if (!isset($valueSet[$this->onboarding_strategy])) {
            throw new PropelException('Unknown stored enum key: ' . $this->onboarding_strategy);
        }

        return $valueSet[$this->onboarding_strategy];
    }

    /**
     * Get the [type] column value.
     * Type can be e.g. 'payment' or 'legal' which is used to identify if a specific entity can be displayed and what. F.e. if onboarding of Payment Apps should be displayed in the Merchant Portal.
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [app_name] column value.
     * The name of the application for which a merchant is being onboarded.
     * @return string
     */
    public function getAppName()
    {
        return $this->app_name;
    }

    /**
     * Get the [app_identifier] column value.
     * A unique identifier for an application.
     * @return string
     */
    public function getAppIdentifier()
    {
        return $this->app_identifier;
    }

    /**
     * Get the [additional_content] column value.
     * Additional content (text, links) to display for merchants.
     * @return string|null
     */
    public function getAdditionalContent()
    {
        return $this->additional_content;
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
     * Set the value of [id_merchant_app_onboarding] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantAppOnboarding($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_app_onboarding !== $v) {
            $this->id_merchant_app_onboarding = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [onboarding_url] column.
     * The URL where a merchant can start the onboarding process for an app.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnboardingUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->onboarding_url !== $v) {
            $this->onboarding_url = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [onboarding_strategy] column.
     * The strategy used for merchant app onboarding (e.g., 'iframe', 'redirect').
     * @param string $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOnboardingStrategy($v)
    {
        if ($v !== null) {
            $valueSet = SpyMerchantAppOnboardingTableMap::getValueSet(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->onboarding_strategy !== $v) {
            $this->onboarding_strategy = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     * Type can be e.g. 'payment' or 'legal' which is used to identify if a specific entity can be displayed and what. F.e. if onboarding of Payment Apps should be displayed in the Merchant Portal.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [app_name] column.
     * The name of the application for which a merchant is being onboarded.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAppName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->app_name !== $v) {
            $this->app_name = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_APP_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [app_identifier] column.
     * A unique identifier for an application.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAppIdentifier($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->app_identifier !== $v) {
            $this->app_identifier = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER] = true;
        }

        if ($this->aSpyAppConfig !== null && $this->aSpyAppConfig->getAppIdentifier() !== $v) {
            $this->aSpyAppConfig = null;
        }

        return $this;
    }

    /**
     * Set the value of [additional_content] column.
     * Additional content (text, links) to display for merchants.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdditionalContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->additional_content !== $v) {
            $this->additional_content = $v;
            $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT] = true;
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
                $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_app_onboarding = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('OnboardingUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->onboarding_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('OnboardingStrategy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->onboarding_strategy = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('AppName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->app_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('AppIdentifier', TableMap::TYPE_PHPNAME, $indexType)];
            $this->app_identifier = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('AdditionalContent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_content = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantAppOnboardingTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpyMerchantAppOnboardingTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding'), 0, $e);
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
        if ($this->aSpyAppConfig !== null && $this->app_identifier !== $this->aSpyAppConfig->getAppIdentifier()) {
            $this->aSpyAppConfig = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantAppOnboardingQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyAppConfig = null;
            $this->collSpyMerchantAppOnboardingStatuses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantAppOnboarding::setDeleted()
     * @see SpyMerchantAppOnboarding::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantAppOnboardingQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT)) {
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
                SpyMerchantAppOnboardingTableMap::addInstanceToPool($this);
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

            if ($this->aSpyAppConfig !== null) {
                if ($this->aSpyAppConfig->isModified() || $this->aSpyAppConfig->isNew()) {
                    $affectedRows += $this->aSpyAppConfig->save($con);
                }
                $this->setSpyAppConfig($this->aSpyAppConfig);
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

        $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING] = true;
        if (null !== $this->id_merchant_app_onboarding) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING)) {
            $modifiedColumns[':p' . $index++]  = 'id_merchant_app_onboarding';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL)) {
            $modifiedColumns[':p' . $index++]  = 'onboarding_url';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY)) {
            $modifiedColumns[':p' . $index++]  = 'onboarding_strategy';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_APP_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'app_name';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER)) {
            $modifiedColumns[':p' . $index++]  = 'app_identifier';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = 'additional_content';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_merchant_app_onboarding (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_merchant_app_onboarding':
                        $stmt->bindValue($identifier, $this->id_merchant_app_onboarding, PDO::PARAM_INT);

                        break;
                    case 'onboarding_url':
                        $stmt->bindValue($identifier, $this->onboarding_url, PDO::PARAM_STR);

                        break;
                    case 'onboarding_strategy':
                        $stmt->bindValue($identifier, $this->onboarding_strategy, PDO::PARAM_INT);

                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);

                        break;
                    case 'app_name':
                        $stmt->bindValue($identifier, $this->app_name, PDO::PARAM_STR);

                        break;
                    case 'app_identifier':
                        $stmt->bindValue($identifier, $this->app_identifier, PDO::PARAM_STR);

                        break;
                    case 'additional_content':
                        $stmt->bindValue($identifier, $this->additional_content, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_merchant_app_onboarding_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchantAppOnboarding($pk);

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
        $pos = SpyMerchantAppOnboardingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantAppOnboarding();

            case 1:
                return $this->getOnboardingUrl();

            case 2:
                return $this->getOnboardingStrategy();

            case 3:
                return $this->getType();

            case 4:
                return $this->getAppName();

            case 5:
                return $this->getAppIdentifier();

            case 6:
                return $this->getAdditionalContent();

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
        if (isset($alreadyDumpedObjects['SpyMerchantAppOnboarding'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantAppOnboarding'][$this->hashCode()] = true;
        $keys = SpyMerchantAppOnboardingTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantAppOnboarding(),
            $keys[1] => $this->getOnboardingUrl(),
            $keys[2] => $this->getOnboardingStrategy(),
            $keys[3] => $this->getType(),
            $keys[4] => $this->getAppName(),
            $keys[5] => $this->getAppIdentifier(),
            $keys[6] => $this->getAdditionalContent(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        ];
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
            if (null !== $this->aSpyAppConfig) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAppConfig';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_app_config';
                        break;
                    default:
                        $key = 'SpyAppConfig';
                }

                $result[$key] = $this->aSpyAppConfig->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyMerchantAppOnboardingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantAppOnboarding($value);
                break;
            case 1:
                $this->setOnboardingUrl($value);
                break;
            case 2:
                $valueSet = SpyMerchantAppOnboardingTableMap::getValueSet(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setOnboardingStrategy($value);
                break;
            case 3:
                $this->setType($value);
                break;
            case 4:
                $this->setAppName($value);
                break;
            case 5:
                $this->setAppIdentifier($value);
                break;
            case 6:
                $this->setAdditionalContent($value);
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
        $keys = SpyMerchantAppOnboardingTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantAppOnboarding($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOnboardingUrl($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOnboardingStrategy($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAppName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAppIdentifier($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAdditionalContent($arr[$keys[6]]);
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
        $criteria = new Criteria(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $this->id_merchant_app_onboarding);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL, $this->onboarding_url);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY, $this->onboarding_strategy);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_TYPE)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_APP_NAME)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_APP_NAME, $this->app_name);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER, $this->app_identifier);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT, $this->additional_content);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantAppOnboardingQuery::create();
        $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $this->id_merchant_app_onboarding);

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
        $validPk = null !== $this->getIdMerchantAppOnboarding();

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
        return $this->getIdMerchantAppOnboarding();
    }

    /**
     * Generic method to set the primary key (id_merchant_app_onboarding column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantAppOnboarding($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantAppOnboarding();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOnboardingUrl($this->getOnboardingUrl());
        $copyObj->setOnboardingStrategy($this->getOnboardingStrategy());
        $copyObj->setType($this->getType());
        $copyObj->setAppName($this->getAppName());
        $copyObj->setAppIdentifier($this->getAppIdentifier());
        $copyObj->setAdditionalContent($this->getAdditionalContent());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantAppOnboardingStatuses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantAppOnboardingStatus($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantAppOnboarding(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding Clone of current object.
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
     * Declares an association between this object and a SpyAppConfig object.
     *
     * @param SpyAppConfig $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyAppConfig(SpyAppConfig $v = null)
    {
        if ($v === null) {
            $this->setAppIdentifier(NULL);
        } else {
            $this->setAppIdentifier($v->getAppIdentifier());
        }

        $this->aSpyAppConfig = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyAppConfig object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantAppOnboarding($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyAppConfig object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyAppConfig The associated SpyAppConfig object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAppConfig(?ConnectionInterface $con = null)
    {
        if ($this->aSpyAppConfig === null && (($this->app_identifier !== "" && $this->app_identifier !== null))) {
            $this->aSpyAppConfig = SpyAppConfigQuery::create()
                ->filterBySpyMerchantAppOnboarding($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyAppConfig->addSpyMerchantAppOnboardings($this);
             */
        }

        return $this->aSpyAppConfig;
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
        if ('SpyMerchantAppOnboardingStatus' === $relationName) {
            $this->initSpyMerchantAppOnboardingStatuses();
            return;
        }
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
     * Gets an array of ChildSpyMerchantAppOnboardingStatus objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantAppOnboarding is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantAppOnboardingStatus[] List of ChildSpyMerchantAppOnboardingStatus objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantAppOnboardingStatus> List of ChildSpyMerchantAppOnboardingStatus objects
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
                $collSpyMerchantAppOnboardingStatuses = ChildSpyMerchantAppOnboardingStatusQuery::create(null, $criteria)
                    ->filterBySpyMerchantAppOnboarding($this)
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
     * Sets a collection of ChildSpyMerchantAppOnboardingStatus objects related by a one-to-many relationship
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
        /** @var ChildSpyMerchantAppOnboardingStatus[] $spyMerchantAppOnboardingStatusesToDelete */
        $spyMerchantAppOnboardingStatusesToDelete = $this->getSpyMerchantAppOnboardingStatuses(new Criteria(), $con)->diff($spyMerchantAppOnboardingStatuses);


        $this->spyMerchantAppOnboardingStatusesScheduledForDeletion = $spyMerchantAppOnboardingStatusesToDelete;

        foreach ($spyMerchantAppOnboardingStatusesToDelete as $spyMerchantAppOnboardingStatusRemoved) {
            $spyMerchantAppOnboardingStatusRemoved->setSpyMerchantAppOnboarding(null);
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
     * Returns the number of related SpyMerchantAppOnboardingStatus objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantAppOnboardingStatus objects.
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

            $query = ChildSpyMerchantAppOnboardingStatusQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyMerchantAppOnboarding($this)
                ->count($con);
        }

        return count($this->collSpyMerchantAppOnboardingStatuses);
    }

    /**
     * Method called to associate a ChildSpyMerchantAppOnboardingStatus object to this object
     * through the ChildSpyMerchantAppOnboardingStatus foreign key attribute.
     *
     * @param ChildSpyMerchantAppOnboardingStatus $l ChildSpyMerchantAppOnboardingStatus
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantAppOnboardingStatus(ChildSpyMerchantAppOnboardingStatus $l)
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
     * @param ChildSpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus The ChildSpyMerchantAppOnboardingStatus object to add.
     */
    protected function doAddSpyMerchantAppOnboardingStatus(ChildSpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus): void
    {
        $this->collSpyMerchantAppOnboardingStatuses[]= $spyMerchantAppOnboardingStatus;
        $spyMerchantAppOnboardingStatus->setSpyMerchantAppOnboarding($this);
    }

    /**
     * @param ChildSpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus The ChildSpyMerchantAppOnboardingStatus object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantAppOnboardingStatus(ChildSpyMerchantAppOnboardingStatus $spyMerchantAppOnboardingStatus)
    {
        if ($this->getSpyMerchantAppOnboardingStatuses()->contains($spyMerchantAppOnboardingStatus)) {
            $pos = $this->collSpyMerchantAppOnboardingStatuses->search($spyMerchantAppOnboardingStatus);
            $this->collSpyMerchantAppOnboardingStatuses->remove($pos);
            if (null === $this->spyMerchantAppOnboardingStatusesScheduledForDeletion) {
                $this->spyMerchantAppOnboardingStatusesScheduledForDeletion = clone $this->collSpyMerchantAppOnboardingStatuses;
                $this->spyMerchantAppOnboardingStatusesScheduledForDeletion->clear();
            }
            $this->spyMerchantAppOnboardingStatusesScheduledForDeletion[]= clone $spyMerchantAppOnboardingStatus;
            $spyMerchantAppOnboardingStatus->setSpyMerchantAppOnboarding(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantAppOnboarding is new, it will return
     * an empty collection; or if this SpyMerchantAppOnboarding has previously
     * been saved, it will retrieve related SpyMerchantAppOnboardingStatuses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantAppOnboarding.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantAppOnboardingStatus[] List of ChildSpyMerchantAppOnboardingStatus objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantAppOnboardingStatus}> List of ChildSpyMerchantAppOnboardingStatus objects
     */
    public function getSpyMerchantAppOnboardingStatusesJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantAppOnboardingStatusQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyMerchantAppOnboardingStatuses($query, $con);
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
        if (null !== $this->aSpyAppConfig) {
            $this->aSpyAppConfig->removeSpyMerchantAppOnboarding($this);
        }
        $this->id_merchant_app_onboarding = null;
        $this->onboarding_url = null;
        $this->onboarding_strategy = null;
        $this->type = null;
        $this->app_name = null;
        $this->app_identifier = null;
        $this->additional_content = null;
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
            if ($this->collSpyMerchantAppOnboardingStatuses) {
                foreach ($this->collSpyMerchantAppOnboardingStatuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantAppOnboardingStatuses = null;
        $this->aSpyAppConfig = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantAppOnboardingTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT] = true;

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
