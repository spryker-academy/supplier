<?php

namespace Orm\Zed\Comment\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Comment\Persistence\SpyComment as ChildSpyComment;
use Orm\Zed\Comment\Persistence\SpyCommentQuery as ChildSpyCommentQuery;
use Orm\Zed\Comment\Persistence\SpyCommentTag as ChildSpyCommentTag;
use Orm\Zed\Comment\Persistence\SpyCommentTagQuery as ChildSpyCommentTagQuery;
use Orm\Zed\Comment\Persistence\SpyCommentThread as ChildSpyCommentThread;
use Orm\Zed\Comment\Persistence\SpyCommentThreadQuery as ChildSpyCommentThreadQuery;
use Orm\Zed\Comment\Persistence\SpyCommentToCommentTag as ChildSpyCommentToCommentTag;
use Orm\Zed\Comment\Persistence\SpyCommentToCommentTagQuery as ChildSpyCommentToCommentTagQuery;
use Orm\Zed\Comment\Persistence\Map\SpyCommentTableMap;
use Orm\Zed\Comment\Persistence\Map\SpyCommentToCommentTagTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
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
 * Base class that represents a row from the 'spy_comment' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Comment.Persistence.Base
 */
abstract class SpyComment implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Comment\\Persistence\\Map\\SpyCommentTableMap';


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
     * The value for the id_comment field.
     *
     * @var        int
     */
    protected $id_comment;

    /**
     * The value for the fk_comment_thread field.
     *
     * @var        int
     */
    protected $fk_comment_thread;

    /**
     * The value for the fk_customer field.
     *
     * @var        int|null
     */
    protected $fk_customer;

    /**
     * The value for the fk_user field.
     *
     * @var        int|null
     */
    protected $fk_user;

    /**
     * The value for the is_deleted field.
     * A flag indicating if an entity has been marked as deleted.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_deleted;

    /**
     * The value for the is_updated field.
     * A flag indicating if a comment has been updated.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_updated;

    /**
     * The value for the key field.
     * Key is an identifier for existing entities. This should never be changed.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the message field.
     * A message providing information, success, or error details.
     * @var        string
     */
    protected $message;

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
     * @var        SpyUser
     */
    protected $aUser;

    /**
     * @var        SpyCustomer
     */
    protected $aSpyCustomer;

    /**
     * @var        ChildSpyCommentThread
     */
    protected $aSpyCommentThread;

    /**
     * @var        ObjectCollection|ChildSpyCommentToCommentTag[] Collection to store aggregation of ChildSpyCommentToCommentTag objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCommentToCommentTag> Collection to store aggregation of ChildSpyCommentToCommentTag objects.
     */
    protected $collSpyCommentToCommentTags;
    protected $collSpyCommentToCommentTagsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCommentTag[] Cross Collection to store aggregation of ChildSpyCommentTag objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCommentTag> Cross Collection to store aggregation of ChildSpyCommentTag objects.
     */
    protected $collSpyCommentTags;

    /**
     * @var bool
     */
    protected $collSpyCommentTagsPartial;

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
     * @var ObjectCollection|ChildSpyCommentTag[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCommentTag>
     */
    protected $spyCommentTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCommentToCommentTag[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCommentToCommentTag>
     */
    protected $spyCommentToCommentTagsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_deleted = false;
        $this->is_updated = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Comment\Persistence\Base\SpyComment object.
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
     * Compares this with another <code>SpyComment</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyComment</code>, delegates to
     * <code>equals(SpyComment)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_comment] column value.
     *
     * @return int
     */
    public function getIdComment()
    {
        return $this->id_comment;
    }

    /**
     * Get the [fk_comment_thread] column value.
     *
     * @return int
     */
    public function getFkCommentThread()
    {
        return $this->fk_comment_thread;
    }

    /**
     * Get the [fk_customer] column value.
     *
     * @return int|null
     */
    public function getFkCustomer()
    {
        return $this->fk_customer;
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
     * Get the [is_deleted] column value.
     * A flag indicating if an entity has been marked as deleted.
     * @return boolean|null
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Get the [is_updated] column value.
     * A flag indicating if a comment has been updated.
     * @return boolean|null
     */
    public function getIsUpdated()
    {
        return $this->is_updated;
    }

    /**
     * Get the [is_updated] column value.
     * A flag indicating if a comment has been updated.
     * @return boolean|null
     */
    public function isUpdated()
    {
        return $this->getIsUpdated();
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
     * Get the [message] column value.
     * A message providing information, success, or error details.
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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
     * Set the value of [id_comment] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdComment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_comment !== $v) {
            $this->id_comment = $v;
            $this->modifiedColumns[SpyCommentTableMap::COL_ID_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_comment_thread] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCommentThread($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_comment_thread !== $v) {
            $this->fk_comment_thread = $v;
            $this->modifiedColumns[SpyCommentTableMap::COL_FK_COMMENT_THREAD] = true;
        }

        if ($this->aSpyCommentThread !== null && $this->aSpyCommentThread->getIdCommentThread() !== $v) {
            $this->aSpyCommentThread = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_customer] column.
     *
     * @param int|null $v New value
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
            $this->modifiedColumns[SpyCommentTableMap::COL_FK_CUSTOMER] = true;
        }

        if ($this->aSpyCustomer !== null && $this->aSpyCustomer->getIdCustomer() !== $v) {
            $this->aSpyCustomer = null;
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
            $this->modifiedColumns[SpyCommentTableMap::COL_FK_USER] = true;
        }

        if ($this->aUser !== null && $this->aUser->getIdUser() !== $v) {
            $this->aUser = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_deleted] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an entity has been marked as deleted.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDeleted($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_deleted !== $v) {
            $this->is_deleted = $v;
            $this->modifiedColumns[SpyCommentTableMap::COL_IS_DELETED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_updated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a comment has been updated.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsUpdated($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_updated !== $v) {
            $this->is_updated = $v;
            $this->modifiedColumns[SpyCommentTableMap::COL_IS_UPDATED] = true;
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
            $this->modifiedColumns[SpyCommentTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [message] column.
     * A message providing information, success, or error details.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->message !== $v) {
            $this->message = $v;
            $this->modifiedColumns[SpyCommentTableMap::COL_MESSAGE] = true;
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
            $this->modifiedColumns[SpyCommentTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyCommentTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyCommentTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_deleted !== false) {
                return false;
            }

            if ($this->is_updated !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCommentTableMap::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_comment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCommentTableMap::translateFieldName('FkCommentThread', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_comment_thread = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCommentTableMap::translateFieldName('FkCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_customer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCommentTableMap::translateFieldName('FkUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCommentTableMap::translateFieldName('IsDeleted', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_deleted = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCommentTableMap::translateFieldName('IsUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_updated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCommentTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCommentTableMap::translateFieldName('Message', TableMap::TYPE_PHPNAME, $indexType)];
            $this->message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCommentTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCommentTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCommentTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SpyCommentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Comment\\Persistence\\SpyComment'), 0, $e);
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
        if ($this->aSpyCommentThread !== null && $this->fk_comment_thread !== $this->aSpyCommentThread->getIdCommentThread()) {
            $this->aSpyCommentThread = null;
        }
        if ($this->aSpyCustomer !== null && $this->fk_customer !== $this->aSpyCustomer->getIdCustomer()) {
            $this->aSpyCustomer = null;
        }
        if ($this->aUser !== null && $this->fk_user !== $this->aUser->getIdUser()) {
            $this->aUser = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCommentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCommentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->aSpyCustomer = null;
            $this->aSpyCommentThread = null;
            $this->collSpyCommentToCommentTags = null;

            $this->collSpyCommentTags = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyComment::setDeleted()
     * @see SpyComment::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCommentQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyCommentTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyCommentTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyCommentTableMap::COL_UPDATED_AT)) {
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
                SpyCommentTableMap::addInstanceToPool($this);
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

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aSpyCustomer !== null) {
                if ($this->aSpyCustomer->isModified() || $this->aSpyCustomer->isNew()) {
                    $affectedRows += $this->aSpyCustomer->save($con);
                }
                $this->setSpyCustomer($this->aSpyCustomer);
            }

            if ($this->aSpyCommentThread !== null) {
                if ($this->aSpyCommentThread->isModified() || $this->aSpyCommentThread->isNew()) {
                    $affectedRows += $this->aSpyCommentThread->save($con);
                }
                $this->setSpyCommentThread($this->aSpyCommentThread);
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

            if ($this->spyCommentTagsScheduledForDeletion !== null) {
                if (!$this->spyCommentTagsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyCommentTagsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdComment();
                        $entryPk[1] = $entry->getIdCommentTag();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\Comment\Persistence\SpyCommentToCommentTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyCommentTagsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyCommentTags) {
                foreach ($this->collSpyCommentTags as $spyCommentTag) {
                    if (!$spyCommentTag->isDeleted() && ($spyCommentTag->isNew() || $spyCommentTag->isModified())) {
                        $spyCommentTag->save($con);
                    }
                }
            }


            if ($this->spyCommentToCommentTagsScheduledForDeletion !== null) {
                if (!$this->spyCommentToCommentTagsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Comment\Persistence\SpyCommentToCommentTagQuery::create()
                        ->filterByPrimaryKeys($this->spyCommentToCommentTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCommentToCommentTagsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCommentToCommentTags !== null) {
                foreach ($this->collSpyCommentToCommentTags as $referrerFK) {
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

        $this->modifiedColumns[SpyCommentTableMap::COL_ID_COMMENT] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCommentTableMap::COL_ID_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = '`id_comment`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_COMMENT_THREAD)) {
            $modifiedColumns[':p' . $index++]  = '`fk_comment_thread`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = '`fk_customer`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_USER)) {
            $modifiedColumns[':p' . $index++]  = '`fk_user`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_IS_DELETED)) {
            $modifiedColumns[':p' . $index++]  = '`is_deleted`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_IS_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = '`is_updated`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = '`message`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_comment` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_comment`':
                        $stmt->bindValue($identifier, $this->id_comment, PDO::PARAM_INT);

                        break;
                    case '`fk_comment_thread`':
                        $stmt->bindValue($identifier, $this->fk_comment_thread, PDO::PARAM_INT);

                        break;
                    case '`fk_customer`':
                        $stmt->bindValue($identifier, $this->fk_customer, PDO::PARAM_INT);

                        break;
                    case '`fk_user`':
                        $stmt->bindValue($identifier, $this->fk_user, PDO::PARAM_INT);

                        break;
                    case '`is_deleted`':
                        $stmt->bindValue($identifier, (int) $this->is_deleted, PDO::PARAM_INT);

                        break;
                    case '`is_updated`':
                        $stmt->bindValue($identifier, (int) $this->is_updated, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`message`':
                        $stmt->bindValue($identifier, $this->message, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('id_comment_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdComment($pk);
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
        $pos = SpyCommentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdComment();

            case 1:
                return $this->getFkCommentThread();

            case 2:
                return $this->getFkCustomer();

            case 3:
                return $this->getFkUser();

            case 4:
                return $this->getIsDeleted();

            case 5:
                return $this->getIsUpdated();

            case 6:
                return $this->getKey();

            case 7:
                return $this->getMessage();

            case 8:
                return $this->getUuid();

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
        if (isset($alreadyDumpedObjects['SpyComment'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyComment'][$this->hashCode()] = true;
        $keys = SpyCommentTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdComment(),
            $keys[1] => $this->getFkCommentThread(),
            $keys[2] => $this->getFkCustomer(),
            $keys[3] => $this->getFkUser(),
            $keys[4] => $this->getIsDeleted(),
            $keys[5] => $this->getIsUpdated(),
            $keys[6] => $this->getKey(),
            $keys[7] => $this->getMessage(),
            $keys[8] => $this->getUuid(),
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
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyCustomer) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomer';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer';
                        break;
                    default:
                        $key = 'SpyCustomer';
                }

                $result[$key] = $this->aSpyCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyCommentThread) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCommentThread';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_comment_thread';
                        break;
                    default:
                        $key = 'SpyCommentThread';
                }

                $result[$key] = $this->aSpyCommentThread->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCommentToCommentTags) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCommentToCommentTags';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_comment_to_comment_tags';
                        break;
                    default:
                        $key = 'SpyCommentToCommentTags';
                }

                $result[$key] = $this->collSpyCommentToCommentTags->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCommentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdComment($value);
                break;
            case 1:
                $this->setFkCommentThread($value);
                break;
            case 2:
                $this->setFkCustomer($value);
                break;
            case 3:
                $this->setFkUser($value);
                break;
            case 4:
                $this->setIsDeleted($value);
                break;
            case 5:
                $this->setIsUpdated($value);
                break;
            case 6:
                $this->setKey($value);
                break;
            case 7:
                $this->setMessage($value);
                break;
            case 8:
                $this->setUuid($value);
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
        $keys = SpyCommentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdComment($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCommentThread($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCustomer($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkUser($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsDeleted($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsUpdated($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setKey($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMessage($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUuid($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyCommentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCommentTableMap::COL_ID_COMMENT)) {
            $criteria->add(SpyCommentTableMap::COL_ID_COMMENT, $this->id_comment);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_COMMENT_THREAD)) {
            $criteria->add(SpyCommentTableMap::COL_FK_COMMENT_THREAD, $this->fk_comment_thread);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_CUSTOMER)) {
            $criteria->add(SpyCommentTableMap::COL_FK_CUSTOMER, $this->fk_customer);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_FK_USER)) {
            $criteria->add(SpyCommentTableMap::COL_FK_USER, $this->fk_user);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_IS_DELETED)) {
            $criteria->add(SpyCommentTableMap::COL_IS_DELETED, $this->is_deleted);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_IS_UPDATED)) {
            $criteria->add(SpyCommentTableMap::COL_IS_UPDATED, $this->is_updated);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_KEY)) {
            $criteria->add(SpyCommentTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_MESSAGE)) {
            $criteria->add(SpyCommentTableMap::COL_MESSAGE, $this->message);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_UUID)) {
            $criteria->add(SpyCommentTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyCommentTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyCommentTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyCommentTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyCommentQuery::create();
        $criteria->add(SpyCommentTableMap::COL_ID_COMMENT, $this->id_comment);

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
        $validPk = null !== $this->getIdComment();

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
        return $this->getIdComment();
    }

    /**
     * Generic method to set the primary key (id_comment column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdComment($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdComment();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Comment\Persistence\SpyComment (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCommentThread($this->getFkCommentThread());
        $copyObj->setFkCustomer($this->getFkCustomer());
        $copyObj->setFkUser($this->getFkUser());
        $copyObj->setIsDeleted($this->getIsDeleted());
        $copyObj->setIsUpdated($this->getIsUpdated());
        $copyObj->setKey($this->getKey());
        $copyObj->setMessage($this->getMessage());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCommentToCommentTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCommentToCommentTag($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdComment(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Comment\Persistence\SpyComment Clone of current object.
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
    public function setUser(SpyUser $v = null)
    {
        if ($v === null) {
            $this->setFkUser(NULL);
        } else {
            $this->setFkUser($v->getIdUser());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyUser object, it will not be re-added.
        if ($v !== null) {
            $v->addComment($this);
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
    public function getUser(?ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->fk_user != 0)) {
            $this->aUser = SpyUserQuery::create()->findPk($this->fk_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addComments($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a SpyCustomer object.
     *
     * @param SpyCustomer|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyCustomer(SpyCustomer $v = null)
    {
        if ($v === null) {
            $this->setFkCustomer(NULL);
        } else {
            $this->setFkCustomer($v->getIdCustomer());
        }

        $this->aSpyCustomer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCustomer object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyComment($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCustomer object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCustomer|null The associated SpyCustomer object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomer(?ConnectionInterface $con = null)
    {
        if ($this->aSpyCustomer === null && ($this->fk_customer != 0)) {
            $this->aSpyCustomer = SpyCustomerQuery::create()->findPk($this->fk_customer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyCustomer->addSpyComments($this);
             */
        }

        return $this->aSpyCustomer;
    }

    /**
     * Declares an association between this object and a ChildSpyCommentThread object.
     *
     * @param ChildSpyCommentThread $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyCommentThread(ChildSpyCommentThread $v = null)
    {
        if ($v === null) {
            $this->setFkCommentThread(NULL);
        } else {
            $this->setFkCommentThread($v->getIdCommentThread());
        }

        $this->aSpyCommentThread = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCommentThread object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyComment($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCommentThread object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCommentThread The associated ChildSpyCommentThread object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCommentThread(?ConnectionInterface $con = null)
    {
        if ($this->aSpyCommentThread === null && ($this->fk_comment_thread != 0)) {
            $this->aSpyCommentThread = ChildSpyCommentThreadQuery::create()->findPk($this->fk_comment_thread, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyCommentThread->addSpyComments($this);
             */
        }

        return $this->aSpyCommentThread;
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
        if ('SpyCommentToCommentTag' === $relationName) {
            $this->initSpyCommentToCommentTags();
            return;
        }
    }

    /**
     * Clears out the collSpyCommentToCommentTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCommentToCommentTags()
     */
    public function clearSpyCommentToCommentTags()
    {
        $this->collSpyCommentToCommentTags = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCommentToCommentTags collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCommentToCommentTags($v = true): void
    {
        $this->collSpyCommentToCommentTagsPartial = $v;
    }

    /**
     * Initializes the collSpyCommentToCommentTags collection.
     *
     * By default this just sets the collSpyCommentToCommentTags collection to an empty array (like clearcollSpyCommentToCommentTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCommentToCommentTags(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCommentToCommentTags && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCommentToCommentTagTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCommentToCommentTags = new $collectionClassName;
        $this->collSpyCommentToCommentTags->setModel('\Orm\Zed\Comment\Persistence\SpyCommentToCommentTag');
    }

    /**
     * Gets an array of ChildSpyCommentToCommentTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyComment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCommentToCommentTag[] List of ChildSpyCommentToCommentTag objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCommentToCommentTag> List of ChildSpyCommentToCommentTag objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCommentToCommentTags(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCommentToCommentTagsPartial && !$this->isNew();
        if (null === $this->collSpyCommentToCommentTags || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCommentToCommentTags) {
                    $this->initSpyCommentToCommentTags();
                } else {
                    $collectionClassName = SpyCommentToCommentTagTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCommentToCommentTags = new $collectionClassName;
                    $collSpyCommentToCommentTags->setModel('\Orm\Zed\Comment\Persistence\SpyCommentToCommentTag');

                    return $collSpyCommentToCommentTags;
                }
            } else {
                $collSpyCommentToCommentTags = ChildSpyCommentToCommentTagQuery::create(null, $criteria)
                    ->filterBySpyComment($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCommentToCommentTagsPartial && count($collSpyCommentToCommentTags)) {
                        $this->initSpyCommentToCommentTags(false);

                        foreach ($collSpyCommentToCommentTags as $obj) {
                            if (false == $this->collSpyCommentToCommentTags->contains($obj)) {
                                $this->collSpyCommentToCommentTags->append($obj);
                            }
                        }

                        $this->collSpyCommentToCommentTagsPartial = true;
                    }

                    return $collSpyCommentToCommentTags;
                }

                if ($partial && $this->collSpyCommentToCommentTags) {
                    foreach ($this->collSpyCommentToCommentTags as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCommentToCommentTags[] = $obj;
                        }
                    }
                }

                $this->collSpyCommentToCommentTags = $collSpyCommentToCommentTags;
                $this->collSpyCommentToCommentTagsPartial = false;
            }
        }

        return $this->collSpyCommentToCommentTags;
    }

    /**
     * Sets a collection of ChildSpyCommentToCommentTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCommentToCommentTags A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCommentToCommentTags(Collection $spyCommentToCommentTags, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCommentToCommentTag[] $spyCommentToCommentTagsToDelete */
        $spyCommentToCommentTagsToDelete = $this->getSpyCommentToCommentTags(new Criteria(), $con)->diff($spyCommentToCommentTags);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyCommentToCommentTagsScheduledForDeletion = clone $spyCommentToCommentTagsToDelete;

        foreach ($spyCommentToCommentTagsToDelete as $spyCommentToCommentTagRemoved) {
            $spyCommentToCommentTagRemoved->setSpyComment(null);
        }

        $this->collSpyCommentToCommentTags = null;
        foreach ($spyCommentToCommentTags as $spyCommentToCommentTag) {
            $this->addSpyCommentToCommentTag($spyCommentToCommentTag);
        }

        $this->collSpyCommentToCommentTags = $spyCommentToCommentTags;
        $this->collSpyCommentToCommentTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCommentToCommentTag objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCommentToCommentTag objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCommentToCommentTags(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCommentToCommentTagsPartial && !$this->isNew();
        if (null === $this->collSpyCommentToCommentTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCommentToCommentTags) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCommentToCommentTags());
            }

            $query = ChildSpyCommentToCommentTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyComment($this)
                ->count($con);
        }

        return count($this->collSpyCommentToCommentTags);
    }

    /**
     * Method called to associate a ChildSpyCommentToCommentTag object to this object
     * through the ChildSpyCommentToCommentTag foreign key attribute.
     *
     * @param ChildSpyCommentToCommentTag $l ChildSpyCommentToCommentTag
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCommentToCommentTag(ChildSpyCommentToCommentTag $l)
    {
        if ($this->collSpyCommentToCommentTags === null) {
            $this->initSpyCommentToCommentTags();
            $this->collSpyCommentToCommentTagsPartial = true;
        }

        if (!$this->collSpyCommentToCommentTags->contains($l)) {
            $this->doAddSpyCommentToCommentTag($l);

            if ($this->spyCommentToCommentTagsScheduledForDeletion and $this->spyCommentToCommentTagsScheduledForDeletion->contains($l)) {
                $this->spyCommentToCommentTagsScheduledForDeletion->remove($this->spyCommentToCommentTagsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCommentToCommentTag $spyCommentToCommentTag The ChildSpyCommentToCommentTag object to add.
     */
    protected function doAddSpyCommentToCommentTag(ChildSpyCommentToCommentTag $spyCommentToCommentTag): void
    {
        $this->collSpyCommentToCommentTags[]= $spyCommentToCommentTag;
        $spyCommentToCommentTag->setSpyComment($this);
    }

    /**
     * @param ChildSpyCommentToCommentTag $spyCommentToCommentTag The ChildSpyCommentToCommentTag object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCommentToCommentTag(ChildSpyCommentToCommentTag $spyCommentToCommentTag)
    {
        if ($this->getSpyCommentToCommentTags()->contains($spyCommentToCommentTag)) {
            $pos = $this->collSpyCommentToCommentTags->search($spyCommentToCommentTag);
            $this->collSpyCommentToCommentTags->remove($pos);
            if (null === $this->spyCommentToCommentTagsScheduledForDeletion) {
                $this->spyCommentToCommentTagsScheduledForDeletion = clone $this->collSpyCommentToCommentTags;
                $this->spyCommentToCommentTagsScheduledForDeletion->clear();
            }
            $this->spyCommentToCommentTagsScheduledForDeletion[]= clone $spyCommentToCommentTag;
            $spyCommentToCommentTag->setSpyComment(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyComment is new, it will return
     * an empty collection; or if this SpyComment has previously
     * been saved, it will retrieve related SpyCommentToCommentTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyComment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCommentToCommentTag[] List of ChildSpyCommentToCommentTag objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCommentToCommentTag}> List of ChildSpyCommentToCommentTag objects
     */
    public function getSpyCommentToCommentTagsJoinSpyCommentTag(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCommentToCommentTagQuery::create(null, $criteria);
        $query->joinWith('SpyCommentTag', $joinBehavior);

        return $this->getSpyCommentToCommentTags($query, $con);
    }

    /**
     * Clears out the collSpyCommentTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyCommentTags()
     */
    public function clearSpyCommentTags()
    {
        $this->collSpyCommentTags = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyCommentTags crossRef collection.
     *
     * By default this just sets the collSpyCommentTags collection to an empty collection (like clearSpyCommentTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyCommentTags()
    {
        $collectionClassName = SpyCommentToCommentTagTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCommentTags = new $collectionClassName;
        $this->collSpyCommentTagsPartial = true;
        $this->collSpyCommentTags->setModel('\Orm\Zed\Comment\Persistence\SpyCommentTag');
    }

    /**
     * Checks if the collSpyCommentTags collection is loaded.
     *
     * @return bool
     */
    public function isSpyCommentTagsLoaded(): bool
    {
        return null !== $this->collSpyCommentTags;
    }

    /**
     * Gets a collection of ChildSpyCommentTag objects related by a many-to-many relationship
     * to the current object by way of the spy_comment_to_comment_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyComment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSpyCommentTag[] List of ChildSpyCommentTag objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCommentTag> List of ChildSpyCommentTag objects
     */
    public function getSpyCommentTags(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCommentTagsPartial && !$this->isNew();
        if (null === $this->collSpyCommentTags || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCommentTags) {
                    $this->initSpyCommentTags();
                }
            } else {

                $query = ChildSpyCommentTagQuery::create(null, $criteria)
                    ->filterBySpyComment($this);
                $collSpyCommentTags = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyCommentTags;
                }

                if ($partial && $this->collSpyCommentTags) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyCommentTags as $obj) {
                        if (!$collSpyCommentTags->contains($obj)) {
                            $collSpyCommentTags[] = $obj;
                        }
                    }
                }

                $this->collSpyCommentTags = $collSpyCommentTags;
                $this->collSpyCommentTagsPartial = false;
            }
        }

        return $this->collSpyCommentTags;
    }

    /**
     * Sets a collection of SpyCommentTag objects related by a many-to-many relationship
     * to the current object by way of the spy_comment_to_comment_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCommentTags A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCommentTags(Collection $spyCommentTags, ?ConnectionInterface $con = null)
    {
        $this->clearSpyCommentTags();
        $currentSpyCommentTags = $this->getSpyCommentTags();

        $spyCommentTagsScheduledForDeletion = $currentSpyCommentTags->diff($spyCommentTags);

        foreach ($spyCommentTagsScheduledForDeletion as $toDelete) {
            $this->removeSpyCommentTag($toDelete);
        }

        foreach ($spyCommentTags as $spyCommentTag) {
            if (!$currentSpyCommentTags->contains($spyCommentTag)) {
                $this->doAddSpyCommentTag($spyCommentTag);
            }
        }

        $this->collSpyCommentTagsPartial = false;
        $this->collSpyCommentTags = $spyCommentTags;

        return $this;
    }

    /**
     * Gets the number of SpyCommentTag objects related by a many-to-many relationship
     * to the current object by way of the spy_comment_to_comment_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyCommentTag objects
     */
    public function countSpyCommentTags(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCommentTagsPartial && !$this->isNew();
        if (null === $this->collSpyCommentTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCommentTags) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyCommentTags());
                }

                $query = ChildSpyCommentTagQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyComment($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyCommentTags);
        }
    }

    /**
     * Associate a ChildSpyCommentTag to this object
     * through the spy_comment_to_comment_tag cross reference table.
     *
     * @param ChildSpyCommentTag $spyCommentTag
     * @return ChildSpyComment The current object (for fluent API support)
     */
    public function addSpyCommentTag(ChildSpyCommentTag $spyCommentTag)
    {
        if ($this->collSpyCommentTags === null) {
            $this->initSpyCommentTags();
        }

        if (!$this->getSpyCommentTags()->contains($spyCommentTag)) {
            // only add it if the **same** object is not already associated
            $this->collSpyCommentTags->push($spyCommentTag);
            $this->doAddSpyCommentTag($spyCommentTag);
        }

        return $this;
    }

    /**
     *
     * @param ChildSpyCommentTag $spyCommentTag
     */
    protected function doAddSpyCommentTag(ChildSpyCommentTag $spyCommentTag)
    {
        $spyCommentToCommentTag = new ChildSpyCommentToCommentTag();

        $spyCommentToCommentTag->setSpyCommentTag($spyCommentTag);

        $spyCommentToCommentTag->setSpyComment($this);

        $this->addSpyCommentToCommentTag($spyCommentToCommentTag);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyCommentTag->isSpyCommentsLoaded()) {
            $spyCommentTag->initSpyComments();
            $spyCommentTag->getSpyComments()->push($this);
        } elseif (!$spyCommentTag->getSpyComments()->contains($this)) {
            $spyCommentTag->getSpyComments()->push($this);
        }

    }

    /**
     * Remove spyCommentTag of this object
     * through the spy_comment_to_comment_tag cross reference table.
     *
     * @param ChildSpyCommentTag $spyCommentTag
     * @return ChildSpyComment The current object (for fluent API support)
     */
    public function removeSpyCommentTag(ChildSpyCommentTag $spyCommentTag)
    {
        if ($this->getSpyCommentTags()->contains($spyCommentTag)) {
            $spyCommentToCommentTag = new ChildSpyCommentToCommentTag();
            $spyCommentToCommentTag->setSpyCommentTag($spyCommentTag);
            if ($spyCommentTag->isSpyCommentsLoaded()) {
                //remove the back reference if available
                $spyCommentTag->getSpyComments()->removeObject($this);
            }

            $spyCommentToCommentTag->setSpyComment($this);
            $this->removeSpyCommentToCommentTag(clone $spyCommentToCommentTag);
            $spyCommentToCommentTag->clear();

            $this->collSpyCommentTags->remove($this->collSpyCommentTags->search($spyCommentTag));

            if (null === $this->spyCommentTagsScheduledForDeletion) {
                $this->spyCommentTagsScheduledForDeletion = clone $this->collSpyCommentTags;
                $this->spyCommentTagsScheduledForDeletion->clear();
            }

            $this->spyCommentTagsScheduledForDeletion->push($spyCommentTag);
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
        if (null !== $this->aUser) {
            $this->aUser->removeComment($this);
        }
        if (null !== $this->aSpyCustomer) {
            $this->aSpyCustomer->removeSpyComment($this);
        }
        if (null !== $this->aSpyCommentThread) {
            $this->aSpyCommentThread->removeSpyComment($this);
        }
        $this->id_comment = null;
        $this->fk_comment_thread = null;
        $this->fk_customer = null;
        $this->fk_user = null;
        $this->is_deleted = null;
        $this->is_updated = null;
        $this->key = null;
        $this->message = null;
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
            if ($this->collSpyCommentToCommentTags) {
                foreach ($this->collSpyCommentToCommentTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCommentTags) {
                foreach ($this->collSpyCommentTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCommentToCommentTags = null;
        $this->collSpyCommentTags = null;
        $this->aUser = null;
        $this->aSpyCustomer = null;
        $this->aSpyCommentThread = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCommentTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_comment' . '.' . $this->getIdComment();
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
        $this->modifiedColumns[SpyCommentTableMap::COL_UPDATED_AT] = true;

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
