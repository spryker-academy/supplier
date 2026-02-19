<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry as ChildSpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile as ChildSpySspInquiryFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery as ChildSpySspInquiryFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery as ChildSpySspInquiryQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder as ChildSpySspInquirySalesOrder;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery as ChildSpySspInquirySalesOrderQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset as ChildSpySspInquirySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery as ChildSpySspInquirySspAssetQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquirySalesOrderTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquirySspAssetTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryTableMap;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery;
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
 * Base class that represents a row from the 'spy_ssp_inquiry' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.SelfServicePortal.Persistence.Base
 */
abstract class SpySspInquiry implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\Map\\SpySspInquiryTableMap';


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
     * The value for the id_ssp_inquiry field.
     *
     * @var        int
     */
    protected $id_ssp_inquiry;

    /**
     * The value for the reference field.
     *
     * @var        string
     */
    protected $reference;

    /**
     * The value for the fk_company_user field.
     *
     * @var        int|null
     */
    protected $fk_company_user;

    /**
     * The value for the subject field.
     *
     * @var        string
     */
    protected $subject;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the fk_state_machine_item_state field.
     *
     * @var        int|null
     */
    protected $fk_state_machine_item_state;

    /**
     * The value for the type field.
     *
     * @var        string
     */
    protected $type;

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
    protected $aSpyCompanyUser;

    /**
     * @var        SpyStateMachineItemState
     */
    protected $aStateMachineItemState;

    /**
     * @var        ObjectCollection|ChildSpySspInquiryFile[] Collection to store aggregation of ChildSpySspInquiryFile objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquiryFile> Collection to store aggregation of ChildSpySspInquiryFile objects.
     */
    protected $collSpySspInquiryFiles;
    protected $collSpySspInquiryFilesPartial;

    /**
     * @var        ObjectCollection|ChildSpySspInquirySalesOrder[] Collection to store aggregation of ChildSpySspInquirySalesOrder objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquirySalesOrder> Collection to store aggregation of ChildSpySspInquirySalesOrder objects.
     */
    protected $collSpySspInquirySalesOrders;
    protected $collSpySspInquirySalesOrdersPartial;

    /**
     * @var        ObjectCollection|ChildSpySspInquirySspAsset[] Collection to store aggregation of ChildSpySspInquirySspAsset objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquirySspAsset> Collection to store aggregation of ChildSpySspInquirySspAsset objects.
     */
    protected $collSpySspInquirySspAssets;
    protected $collSpySspInquirySspAssetsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspInquiryFile[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquiryFile>
     */
    protected $spySspInquiryFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspInquirySalesOrder[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquirySalesOrder>
     */
    protected $spySspInquirySalesOrdersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspInquirySspAsset[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspInquirySspAsset>
     */
    protected $spySspInquirySspAssetsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquiry object.
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
     * Compares this with another <code>SpySspInquiry</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySspInquiry</code>, delegates to
     * <code>equals(SpySspInquiry)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_ssp_inquiry] column value.
     *
     * @return int
     */
    public function getIdSspInquiry()
    {
        return $this->id_ssp_inquiry;
    }

    /**
     * Get the [reference] column value.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get the [fk_company_user] column value.
     *
     * @return int|null
     */
    public function getFkCompanyUser()
    {
        return $this->fk_company_user;
    }

    /**
     * Get the [subject] column value.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [fk_state_machine_item_state] column value.
     *
     * @return int|null
     */
    public function getFkStateMachineItemState()
    {
        return $this->fk_state_machine_item_state;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * Set the value of [id_ssp_inquiry] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSspInquiry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_ssp_inquiry !== $v) {
            $this->id_ssp_inquiry = $v;
            $this->modifiedColumns[SpySspInquiryTableMap::COL_ID_SSP_INQUIRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reference] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->reference !== $v) {
            $this->reference = $v;
            $this->modifiedColumns[SpySspInquiryTableMap::COL_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company_user] column.
     *
     * @param int|null $v New value
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
            $this->modifiedColumns[SpySspInquiryTableMap::COL_FK_COMPANY_USER] = true;
        }

        if ($this->aSpyCompanyUser !== null && $this->aSpyCompanyUser->getIdCompanyUser() !== $v) {
            $this->aSpyCompanyUser = null;
        }

        return $this;
    }

    /**
     * Set the value of [subject] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->subject !== $v) {
            $this->subject = $v;
            $this->modifiedColumns[SpySspInquiryTableMap::COL_SUBJECT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SpySspInquiryTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_state_machine_item_state] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkStateMachineItemState($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_state_machine_item_state !== $v) {
            $this->fk_state_machine_item_state = $v;
            $this->modifiedColumns[SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE] = true;
        }

        if ($this->aStateMachineItemState !== null && $this->aStateMachineItemState->getIdStateMachineItemState() !== $v) {
            $this->aStateMachineItemState = null;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     *
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
            $this->modifiedColumns[SpySspInquiryTableMap::COL_TYPE] = true;
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
                $this->modifiedColumns[SpySspInquiryTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySspInquiryTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySspInquiryTableMap::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_ssp_inquiry = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySspInquiryTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySspInquiryTableMap::translateFieldName('FkCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySspInquiryTableMap::translateFieldName('Subject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySspInquiryTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySspInquiryTableMap::translateFieldName('FkStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_state_machine_item_state = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySspInquiryTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySspInquiryTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpySspInquiryTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpySspInquiryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiry'), 0, $e);
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
        if ($this->aSpyCompanyUser !== null && $this->fk_company_user !== $this->aSpyCompanyUser->getIdCompanyUser()) {
            $this->aSpyCompanyUser = null;
        }
        if ($this->aStateMachineItemState !== null && $this->fk_state_machine_item_state !== $this->aStateMachineItemState->getIdStateMachineItemState()) {
            $this->aStateMachineItemState = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySspInquiryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyCompanyUser = null;
            $this->aStateMachineItemState = null;
            $this->collSpySspInquiryFiles = null;

            $this->collSpySspInquirySalesOrders = null;

            $this->collSpySspInquirySspAssets = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySspInquiry::setDeleted()
     * @see SpySspInquiry::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySspInquiryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpySspInquiryTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySspInquiryTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpySspInquiryTableMap::COL_UPDATED_AT)) {
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
                SpySspInquiryTableMap::addInstanceToPool($this);
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

            if ($this->aSpyCompanyUser !== null) {
                if ($this->aSpyCompanyUser->isModified() || $this->aSpyCompanyUser->isNew()) {
                    $affectedRows += $this->aSpyCompanyUser->save($con);
                }
                $this->setSpyCompanyUser($this->aSpyCompanyUser);
            }

            if ($this->aStateMachineItemState !== null) {
                if ($this->aStateMachineItemState->isModified() || $this->aStateMachineItemState->isNew()) {
                    $affectedRows += $this->aStateMachineItemState->save($con);
                }
                $this->setStateMachineItemState($this->aStateMachineItemState);
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

            if ($this->spySspInquiryFilesScheduledForDeletion !== null) {
                if (!$this->spySspInquiryFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquiryFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquiryFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquiryFiles !== null) {
                foreach ($this->collSpySspInquiryFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquirySalesOrdersScheduledForDeletion !== null) {
                if (!$this->spySspInquirySalesOrdersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquirySalesOrdersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquirySalesOrdersScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquirySalesOrders !== null) {
                foreach ($this->collSpySspInquirySalesOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquirySspAssetsScheduledForDeletion !== null) {
                if (!$this->spySspInquirySspAssetsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquirySspAssetsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquirySspAssetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquirySspAssets !== null) {
                foreach ($this->collSpySspInquirySspAssets as $referrerFK) {
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

        $this->modifiedColumns[SpySspInquiryTableMap::COL_ID_SSP_INQUIRY] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY)) {
            $modifiedColumns[':p' . $index++]  = 'id_ssp_inquiry';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_FK_COMPANY_USER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_company_user';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'subject';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_state_machine_item_state';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_ssp_inquiry (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_ssp_inquiry':
                        $stmt->bindValue($identifier, $this->id_ssp_inquiry, PDO::PARAM_INT);

                        break;
                    case 'reference':
                        $stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);

                        break;
                    case 'fk_company_user':
                        $stmt->bindValue($identifier, $this->fk_company_user, PDO::PARAM_INT);

                        break;
                    case 'subject':
                        $stmt->bindValue($identifier, $this->subject, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'fk_state_machine_item_state':
                        $stmt->bindValue($identifier, $this->fk_state_machine_item_state, PDO::PARAM_INT);

                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('id_ssp_inquiry_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdSspInquiry($pk);
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
        $pos = SpySspInquiryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSspInquiry();

            case 1:
                return $this->getReference();

            case 2:
                return $this->getFkCompanyUser();

            case 3:
                return $this->getSubject();

            case 4:
                return $this->getDescription();

            case 5:
                return $this->getFkStateMachineItemState();

            case 6:
                return $this->getType();

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
        if (isset($alreadyDumpedObjects['SpySspInquiry'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySspInquiry'][$this->hashCode()] = true;
        $keys = SpySspInquiryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSspInquiry(),
            $keys[1] => $this->getReference(),
            $keys[2] => $this->getFkCompanyUser(),
            $keys[3] => $this->getSubject(),
            $keys[4] => $this->getDescription(),
            $keys[5] => $this->getFkStateMachineItemState(),
            $keys[6] => $this->getType(),
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
            if (null !== $this->aSpyCompanyUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_user';
                        break;
                    default:
                        $key = 'SpyCompanyUser';
                }

                $result[$key] = $this->aSpyCompanyUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStateMachineItemState) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStateMachineItemState';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_state_machine_item_state';
                        break;
                    default:
                        $key = 'StateMachineItemState';
                }

                $result[$key] = $this->aStateMachineItemState->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpySspInquiryFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquiryFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_files';
                        break;
                    default:
                        $key = 'SpySspInquiryFiles';
                }

                $result[$key] = $this->collSpySspInquiryFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquirySalesOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquirySalesOrders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_sales_orders';
                        break;
                    default:
                        $key = 'SpySspInquirySalesOrders';
                }

                $result[$key] = $this->collSpySspInquirySalesOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquirySspAssets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquirySspAssets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_ssp_assets';
                        break;
                    default:
                        $key = 'SpySspInquirySspAssets';
                }

                $result[$key] = $this->collSpySspInquirySspAssets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpySspInquiryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSspInquiry($value);
                break;
            case 1:
                $this->setReference($value);
                break;
            case 2:
                $this->setFkCompanyUser($value);
                break;
            case 3:
                $this->setSubject($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
            case 5:
                $this->setFkStateMachineItemState($value);
                break;
            case 6:
                $this->setType($value);
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
        $keys = SpySspInquiryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSspInquiry($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setReference($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCompanyUser($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSubject($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFkStateMachineItemState($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setType($arr[$keys[6]]);
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
        $criteria = new Criteria(SpySspInquiryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY)) {
            $criteria->add(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $this->id_ssp_inquiry);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_REFERENCE)) {
            $criteria->add(SpySspInquiryTableMap::COL_REFERENCE, $this->reference);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_FK_COMPANY_USER)) {
            $criteria->add(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $this->fk_company_user);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_SUBJECT)) {
            $criteria->add(SpySspInquiryTableMap::COL_SUBJECT, $this->subject);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_DESCRIPTION)) {
            $criteria->add(SpySspInquiryTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE)) {
            $criteria->add(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $this->fk_state_machine_item_state);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_TYPE)) {
            $criteria->add(SpySspInquiryTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySspInquiryTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySspInquiryTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySspInquiryTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySspInquiryQuery::create();
        $criteria->add(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $this->id_ssp_inquiry);

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
        $validPk = null !== $this->getIdSspInquiry();

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
        return $this->getIdSspInquiry();
    }

    /**
     * Generic method to set the primary key (id_ssp_inquiry column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdSspInquiry($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSspInquiry();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setReference($this->getReference());
        $copyObj->setFkCompanyUser($this->getFkCompanyUser());
        $copyObj->setSubject($this->getSubject());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setFkStateMachineItemState($this->getFkStateMachineItemState());
        $copyObj->setType($this->getType());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpySspInquiryFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquiryFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquirySalesOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquirySalesOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquirySspAssets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquirySspAsset($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSspInquiry(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry Clone of current object.
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
     * @param SpyCompanyUser|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyCompanyUser(SpyCompanyUser $v = null)
    {
        if ($v === null) {
            $this->setFkCompanyUser(NULL);
        } else {
            $this->setFkCompanyUser($v->getIdCompanyUser());
        }

        $this->aSpyCompanyUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompanyUser object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySspInquiry($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompanyUser object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompanyUser|null The associated SpyCompanyUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUser(?ConnectionInterface $con = null)
    {
        if ($this->aSpyCompanyUser === null && ($this->fk_company_user != 0)) {
            $this->aSpyCompanyUser = SpyCompanyUserQuery::create()->findPk($this->fk_company_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyCompanyUser->addSpySspInquiries($this);
             */
        }

        return $this->aSpyCompanyUser;
    }

    /**
     * Declares an association between this object and a SpyStateMachineItemState object.
     *
     * @param SpyStateMachineItemState|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStateMachineItemState(SpyStateMachineItemState $v = null)
    {
        if ($v === null) {
            $this->setFkStateMachineItemState(NULL);
        } else {
            $this->setFkStateMachineItemState($v->getIdStateMachineItemState());
        }

        $this->aStateMachineItemState = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyStateMachineItemState object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySspInquiry($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyStateMachineItemState object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyStateMachineItemState|null The associated SpyStateMachineItemState object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStateMachineItemState(?ConnectionInterface $con = null)
    {
        if ($this->aStateMachineItemState === null && ($this->fk_state_machine_item_state != 0)) {
            $this->aStateMachineItemState = SpyStateMachineItemStateQuery::create()->findPk($this->fk_state_machine_item_state, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStateMachineItemState->addSpySspInquiries($this);
             */
        }

        return $this->aStateMachineItemState;
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
        if ('SpySspInquiryFile' === $relationName) {
            $this->initSpySspInquiryFiles();
            return;
        }
        if ('SpySspInquirySalesOrder' === $relationName) {
            $this->initSpySspInquirySalesOrders();
            return;
        }
        if ('SpySspInquirySspAsset' === $relationName) {
            $this->initSpySspInquirySspAssets();
            return;
        }
    }

    /**
     * Clears out the collSpySspInquiryFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquiryFiles()
     */
    public function clearSpySspInquiryFiles()
    {
        $this->collSpySspInquiryFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquiryFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquiryFiles($v = true): void
    {
        $this->collSpySspInquiryFilesPartial = $v;
    }

    /**
     * Initializes the collSpySspInquiryFiles collection.
     *
     * By default this just sets the collSpySspInquiryFiles collection to an empty array (like clearcollSpySspInquiryFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquiryFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquiryFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquiryFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquiryFiles = new $collectionClassName;
        $this->collSpySspInquiryFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile');
    }

    /**
     * Gets an array of ChildSpySspInquiryFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspInquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspInquiryFile[] List of ChildSpySspInquiryFile objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquiryFile> List of ChildSpySspInquiryFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquiryFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquiryFilesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiryFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquiryFiles) {
                    $this->initSpySspInquiryFiles();
                } else {
                    $collectionClassName = SpySspInquiryFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquiryFiles = new $collectionClassName;
                    $collSpySspInquiryFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile');

                    return $collSpySspInquiryFiles;
                }
            } else {
                $collSpySspInquiryFiles = ChildSpySspInquiryFileQuery::create(null, $criteria)
                    ->filterBySpySspInquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquiryFilesPartial && count($collSpySspInquiryFiles)) {
                        $this->initSpySspInquiryFiles(false);

                        foreach ($collSpySspInquiryFiles as $obj) {
                            if (false == $this->collSpySspInquiryFiles->contains($obj)) {
                                $this->collSpySspInquiryFiles->append($obj);
                            }
                        }

                        $this->collSpySspInquiryFilesPartial = true;
                    }

                    return $collSpySspInquiryFiles;
                }

                if ($partial && $this->collSpySspInquiryFiles) {
                    foreach ($this->collSpySspInquiryFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquiryFiles[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquiryFiles = $collSpySspInquiryFiles;
                $this->collSpySspInquiryFilesPartial = false;
            }
        }

        return $this->collSpySspInquiryFiles;
    }

    /**
     * Sets a collection of ChildSpySspInquiryFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquiryFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquiryFiles(Collection $spySspInquiryFiles, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspInquiryFile[] $spySspInquiryFilesToDelete */
        $spySspInquiryFilesToDelete = $this->getSpySspInquiryFiles(new Criteria(), $con)->diff($spySspInquiryFiles);


        $this->spySspInquiryFilesScheduledForDeletion = $spySspInquiryFilesToDelete;

        foreach ($spySspInquiryFilesToDelete as $spySspInquiryFileRemoved) {
            $spySspInquiryFileRemoved->setSpySspInquiry(null);
        }

        $this->collSpySspInquiryFiles = null;
        foreach ($spySspInquiryFiles as $spySspInquiryFile) {
            $this->addSpySspInquiryFile($spySspInquiryFile);
        }

        $this->collSpySspInquiryFiles = $spySspInquiryFiles;
        $this->collSpySspInquiryFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspInquiryFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspInquiryFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquiryFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquiryFilesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiryFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquiryFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquiryFiles());
            }

            $query = ChildSpySspInquiryFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySspInquiry($this)
                ->count($con);
        }

        return count($this->collSpySspInquiryFiles);
    }

    /**
     * Method called to associate a ChildSpySspInquiryFile object to this object
     * through the ChildSpySspInquiryFile foreign key attribute.
     *
     * @param ChildSpySspInquiryFile $l ChildSpySspInquiryFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquiryFile(ChildSpySspInquiryFile $l)
    {
        if ($this->collSpySspInquiryFiles === null) {
            $this->initSpySspInquiryFiles();
            $this->collSpySspInquiryFilesPartial = true;
        }

        if (!$this->collSpySspInquiryFiles->contains($l)) {
            $this->doAddSpySspInquiryFile($l);

            if ($this->spySspInquiryFilesScheduledForDeletion and $this->spySspInquiryFilesScheduledForDeletion->contains($l)) {
                $this->spySspInquiryFilesScheduledForDeletion->remove($this->spySspInquiryFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspInquiryFile $spySspInquiryFile The ChildSpySspInquiryFile object to add.
     */
    protected function doAddSpySspInquiryFile(ChildSpySspInquiryFile $spySspInquiryFile): void
    {
        $this->collSpySspInquiryFiles[]= $spySspInquiryFile;
        $spySspInquiryFile->setSpySspInquiry($this);
    }

    /**
     * @param ChildSpySspInquiryFile $spySspInquiryFile The ChildSpySspInquiryFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquiryFile(ChildSpySspInquiryFile $spySspInquiryFile)
    {
        if ($this->getSpySspInquiryFiles()->contains($spySspInquiryFile)) {
            $pos = $this->collSpySspInquiryFiles->search($spySspInquiryFile);
            $this->collSpySspInquiryFiles->remove($pos);
            if (null === $this->spySspInquiryFilesScheduledForDeletion) {
                $this->spySspInquiryFilesScheduledForDeletion = clone $this->collSpySspInquiryFiles;
                $this->spySspInquiryFilesScheduledForDeletion->clear();
            }
            $this->spySspInquiryFilesScheduledForDeletion[]= clone $spySspInquiryFile;
            $spySspInquiryFile->setSpySspInquiry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspInquiry is new, it will return
     * an empty collection; or if this SpySspInquiry has previously
     * been saved, it will retrieve related SpySspInquiryFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspInquiry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspInquiryFile[] List of ChildSpySspInquiryFile objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquiryFile}> List of ChildSpySspInquiryFile objects
     */
    public function getSpySspInquiryFilesJoinSpyFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspInquiryFileQuery::create(null, $criteria);
        $query->joinWith('SpyFile', $joinBehavior);

        return $this->getSpySspInquiryFiles($query, $con);
    }

    /**
     * Clears out the collSpySspInquirySalesOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquirySalesOrders()
     */
    public function clearSpySspInquirySalesOrders()
    {
        $this->collSpySspInquirySalesOrders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquirySalesOrders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquirySalesOrders($v = true): void
    {
        $this->collSpySspInquirySalesOrdersPartial = $v;
    }

    /**
     * Initializes the collSpySspInquirySalesOrders collection.
     *
     * By default this just sets the collSpySspInquirySalesOrders collection to an empty array (like clearcollSpySspInquirySalesOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquirySalesOrders(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquirySalesOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquirySalesOrderTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquirySalesOrders = new $collectionClassName;
        $this->collSpySspInquirySalesOrders->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder');
    }

    /**
     * Gets an array of ChildSpySspInquirySalesOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspInquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspInquirySalesOrder[] List of ChildSpySspInquirySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquirySalesOrder> List of ChildSpySspInquirySalesOrder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquirySalesOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquirySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquirySalesOrders) {
                    $this->initSpySspInquirySalesOrders();
                } else {
                    $collectionClassName = SpySspInquirySalesOrderTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquirySalesOrders = new $collectionClassName;
                    $collSpySspInquirySalesOrders->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder');

                    return $collSpySspInquirySalesOrders;
                }
            } else {
                $collSpySspInquirySalesOrders = ChildSpySspInquirySalesOrderQuery::create(null, $criteria)
                    ->filterBySpySspInquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquirySalesOrdersPartial && count($collSpySspInquirySalesOrders)) {
                        $this->initSpySspInquirySalesOrders(false);

                        foreach ($collSpySspInquirySalesOrders as $obj) {
                            if (false == $this->collSpySspInquirySalesOrders->contains($obj)) {
                                $this->collSpySspInquirySalesOrders->append($obj);
                            }
                        }

                        $this->collSpySspInquirySalesOrdersPartial = true;
                    }

                    return $collSpySspInquirySalesOrders;
                }

                if ($partial && $this->collSpySspInquirySalesOrders) {
                    foreach ($this->collSpySspInquirySalesOrders as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquirySalesOrders[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquirySalesOrders = $collSpySspInquirySalesOrders;
                $this->collSpySspInquirySalesOrdersPartial = false;
            }
        }

        return $this->collSpySspInquirySalesOrders;
    }

    /**
     * Sets a collection of ChildSpySspInquirySalesOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquirySalesOrders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquirySalesOrders(Collection $spySspInquirySalesOrders, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspInquirySalesOrder[] $spySspInquirySalesOrdersToDelete */
        $spySspInquirySalesOrdersToDelete = $this->getSpySspInquirySalesOrders(new Criteria(), $con)->diff($spySspInquirySalesOrders);


        $this->spySspInquirySalesOrdersScheduledForDeletion = $spySspInquirySalesOrdersToDelete;

        foreach ($spySspInquirySalesOrdersToDelete as $spySspInquirySalesOrderRemoved) {
            $spySspInquirySalesOrderRemoved->setSpySspInquiry(null);
        }

        $this->collSpySspInquirySalesOrders = null;
        foreach ($spySspInquirySalesOrders as $spySspInquirySalesOrder) {
            $this->addSpySspInquirySalesOrder($spySspInquirySalesOrder);
        }

        $this->collSpySspInquirySalesOrders = $spySspInquirySalesOrders;
        $this->collSpySspInquirySalesOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspInquirySalesOrder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspInquirySalesOrder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquirySalesOrders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquirySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquirySalesOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquirySalesOrders());
            }

            $query = ChildSpySspInquirySalesOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySspInquiry($this)
                ->count($con);
        }

        return count($this->collSpySspInquirySalesOrders);
    }

    /**
     * Method called to associate a ChildSpySspInquirySalesOrder object to this object
     * through the ChildSpySspInquirySalesOrder foreign key attribute.
     *
     * @param ChildSpySspInquirySalesOrder $l ChildSpySspInquirySalesOrder
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquirySalesOrder(ChildSpySspInquirySalesOrder $l)
    {
        if ($this->collSpySspInquirySalesOrders === null) {
            $this->initSpySspInquirySalesOrders();
            $this->collSpySspInquirySalesOrdersPartial = true;
        }

        if (!$this->collSpySspInquirySalesOrders->contains($l)) {
            $this->doAddSpySspInquirySalesOrder($l);

            if ($this->spySspInquirySalesOrdersScheduledForDeletion and $this->spySspInquirySalesOrdersScheduledForDeletion->contains($l)) {
                $this->spySspInquirySalesOrdersScheduledForDeletion->remove($this->spySspInquirySalesOrdersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspInquirySalesOrder $spySspInquirySalesOrder The ChildSpySspInquirySalesOrder object to add.
     */
    protected function doAddSpySspInquirySalesOrder(ChildSpySspInquirySalesOrder $spySspInquirySalesOrder): void
    {
        $this->collSpySspInquirySalesOrders[]= $spySspInquirySalesOrder;
        $spySspInquirySalesOrder->setSpySspInquiry($this);
    }

    /**
     * @param ChildSpySspInquirySalesOrder $spySspInquirySalesOrder The ChildSpySspInquirySalesOrder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquirySalesOrder(ChildSpySspInquirySalesOrder $spySspInquirySalesOrder)
    {
        if ($this->getSpySspInquirySalesOrders()->contains($spySspInquirySalesOrder)) {
            $pos = $this->collSpySspInquirySalesOrders->search($spySspInquirySalesOrder);
            $this->collSpySspInquirySalesOrders->remove($pos);
            if (null === $this->spySspInquirySalesOrdersScheduledForDeletion) {
                $this->spySspInquirySalesOrdersScheduledForDeletion = clone $this->collSpySspInquirySalesOrders;
                $this->spySspInquirySalesOrdersScheduledForDeletion->clear();
            }
            $this->spySspInquirySalesOrdersScheduledForDeletion[]= clone $spySspInquirySalesOrder;
            $spySspInquirySalesOrder->setSpySspInquiry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspInquiry is new, it will return
     * an empty collection; or if this SpySspInquiry has previously
     * been saved, it will retrieve related SpySspInquirySalesOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspInquiry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspInquirySalesOrder[] List of ChildSpySspInquirySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquirySalesOrder}> List of ChildSpySspInquirySalesOrder objects
     */
    public function getSpySspInquirySalesOrdersJoinSpySalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspInquirySalesOrderQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrder', $joinBehavior);

        return $this->getSpySspInquirySalesOrders($query, $con);
    }

    /**
     * Clears out the collSpySspInquirySspAssets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquirySspAssets()
     */
    public function clearSpySspInquirySspAssets()
    {
        $this->collSpySspInquirySspAssets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquirySspAssets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquirySspAssets($v = true): void
    {
        $this->collSpySspInquirySspAssetsPartial = $v;
    }

    /**
     * Initializes the collSpySspInquirySspAssets collection.
     *
     * By default this just sets the collSpySspInquirySspAssets collection to an empty array (like clearcollSpySspInquirySspAssets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquirySspAssets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquirySspAssets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquirySspAssetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquirySspAssets = new $collectionClassName;
        $this->collSpySspInquirySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset');
    }

    /**
     * Gets an array of ChildSpySspInquirySspAsset objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspInquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspInquirySspAsset[] List of ChildSpySspInquirySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquirySspAsset> List of ChildSpySspInquirySspAsset objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquirySspAssets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquirySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySspAssets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquirySspAssets) {
                    $this->initSpySspInquirySspAssets();
                } else {
                    $collectionClassName = SpySspInquirySspAssetTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquirySspAssets = new $collectionClassName;
                    $collSpySspInquirySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset');

                    return $collSpySspInquirySspAssets;
                }
            } else {
                $collSpySspInquirySspAssets = ChildSpySspInquirySspAssetQuery::create(null, $criteria)
                    ->filterBySpySspInquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquirySspAssetsPartial && count($collSpySspInquirySspAssets)) {
                        $this->initSpySspInquirySspAssets(false);

                        foreach ($collSpySspInquirySspAssets as $obj) {
                            if (false == $this->collSpySspInquirySspAssets->contains($obj)) {
                                $this->collSpySspInquirySspAssets->append($obj);
                            }
                        }

                        $this->collSpySspInquirySspAssetsPartial = true;
                    }

                    return $collSpySspInquirySspAssets;
                }

                if ($partial && $this->collSpySspInquirySspAssets) {
                    foreach ($this->collSpySspInquirySspAssets as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquirySspAssets[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquirySspAssets = $collSpySspInquirySspAssets;
                $this->collSpySspInquirySspAssetsPartial = false;
            }
        }

        return $this->collSpySspInquirySspAssets;
    }

    /**
     * Sets a collection of ChildSpySspInquirySspAsset objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquirySspAssets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquirySspAssets(Collection $spySspInquirySspAssets, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspInquirySspAsset[] $spySspInquirySspAssetsToDelete */
        $spySspInquirySspAssetsToDelete = $this->getSpySspInquirySspAssets(new Criteria(), $con)->diff($spySspInquirySspAssets);


        $this->spySspInquirySspAssetsScheduledForDeletion = $spySspInquirySspAssetsToDelete;

        foreach ($spySspInquirySspAssetsToDelete as $spySspInquirySspAssetRemoved) {
            $spySspInquirySspAssetRemoved->setSpySspInquiry(null);
        }

        $this->collSpySspInquirySspAssets = null;
        foreach ($spySspInquirySspAssets as $spySspInquirySspAsset) {
            $this->addSpySspInquirySspAsset($spySspInquirySspAsset);
        }

        $this->collSpySspInquirySspAssets = $spySspInquirySspAssets;
        $this->collSpySspInquirySspAssetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspInquirySspAsset objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspInquirySspAsset objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquirySspAssets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquirySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySspAssets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquirySspAssets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquirySspAssets());
            }

            $query = ChildSpySspInquirySspAssetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySspInquiry($this)
                ->count($con);
        }

        return count($this->collSpySspInquirySspAssets);
    }

    /**
     * Method called to associate a ChildSpySspInquirySspAsset object to this object
     * through the ChildSpySspInquirySspAsset foreign key attribute.
     *
     * @param ChildSpySspInquirySspAsset $l ChildSpySspInquirySspAsset
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquirySspAsset(ChildSpySspInquirySspAsset $l)
    {
        if ($this->collSpySspInquirySspAssets === null) {
            $this->initSpySspInquirySspAssets();
            $this->collSpySspInquirySspAssetsPartial = true;
        }

        if (!$this->collSpySspInquirySspAssets->contains($l)) {
            $this->doAddSpySspInquirySspAsset($l);

            if ($this->spySspInquirySspAssetsScheduledForDeletion and $this->spySspInquirySspAssetsScheduledForDeletion->contains($l)) {
                $this->spySspInquirySspAssetsScheduledForDeletion->remove($this->spySspInquirySspAssetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspInquirySspAsset $spySspInquirySspAsset The ChildSpySspInquirySspAsset object to add.
     */
    protected function doAddSpySspInquirySspAsset(ChildSpySspInquirySspAsset $spySspInquirySspAsset): void
    {
        $this->collSpySspInquirySspAssets[]= $spySspInquirySspAsset;
        $spySspInquirySspAsset->setSpySspInquiry($this);
    }

    /**
     * @param ChildSpySspInquirySspAsset $spySspInquirySspAsset The ChildSpySspInquirySspAsset object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquirySspAsset(ChildSpySspInquirySspAsset $spySspInquirySspAsset)
    {
        if ($this->getSpySspInquirySspAssets()->contains($spySspInquirySspAsset)) {
            $pos = $this->collSpySspInquirySspAssets->search($spySspInquirySspAsset);
            $this->collSpySspInquirySspAssets->remove($pos);
            if (null === $this->spySspInquirySspAssetsScheduledForDeletion) {
                $this->spySspInquirySspAssetsScheduledForDeletion = clone $this->collSpySspInquirySspAssets;
                $this->spySspInquirySspAssetsScheduledForDeletion->clear();
            }
            $this->spySspInquirySspAssetsScheduledForDeletion[]= clone $spySspInquirySspAsset;
            $spySspInquirySspAsset->setSpySspInquiry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspInquiry is new, it will return
     * an empty collection; or if this SpySspInquiry has previously
     * been saved, it will retrieve related SpySspInquirySspAssets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspInquiry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspInquirySspAsset[] List of ChildSpySspInquirySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspInquirySspAsset}> List of ChildSpySspInquirySspAsset objects
     */
    public function getSpySspInquirySspAssetsJoinSpySspAsset(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspInquirySspAssetQuery::create(null, $criteria);
        $query->joinWith('SpySspAsset', $joinBehavior);

        return $this->getSpySspInquirySspAssets($query, $con);
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
        if (null !== $this->aSpyCompanyUser) {
            $this->aSpyCompanyUser->removeSpySspInquiry($this);
        }
        if (null !== $this->aStateMachineItemState) {
            $this->aStateMachineItemState->removeSpySspInquiry($this);
        }
        $this->id_ssp_inquiry = null;
        $this->reference = null;
        $this->fk_company_user = null;
        $this->subject = null;
        $this->description = null;
        $this->fk_state_machine_item_state = null;
        $this->type = null;
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
            if ($this->collSpySspInquiryFiles) {
                foreach ($this->collSpySspInquiryFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquirySalesOrders) {
                foreach ($this->collSpySspInquirySalesOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquirySspAssets) {
                foreach ($this->collSpySspInquirySspAssets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpySspInquiryFiles = null;
        $this->collSpySspInquirySalesOrders = null;
        $this->collSpySspInquirySspAssets = null;
        $this->aSpyCompanyUser = null;
        $this->aStateMachineItemState = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySspInquiryTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySspInquiryTableMap::COL_UPDATED_AT] = true;

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
