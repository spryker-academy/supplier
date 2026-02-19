<?php

namespace Orm\Zed\Acl\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Acl\Persistence\SpyAclGroup as ChildSpyAclGroup;
use Orm\Zed\Acl\Persistence\SpyAclGroupArchive as ChildSpyAclGroupArchive;
use Orm\Zed\Acl\Persistence\SpyAclGroupArchiveQuery as ChildSpyAclGroupArchiveQuery;
use Orm\Zed\Acl\Persistence\SpyAclGroupQuery as ChildSpyAclGroupQuery;
use Orm\Zed\Acl\Persistence\SpyAclGroupsHasRoles as ChildSpyAclGroupsHasRoles;
use Orm\Zed\Acl\Persistence\SpyAclGroupsHasRolesQuery as ChildSpyAclGroupsHasRolesQuery;
use Orm\Zed\Acl\Persistence\SpyAclRole as ChildSpyAclRole;
use Orm\Zed\Acl\Persistence\SpyAclRoleQuery as ChildSpyAclRoleQuery;
use Orm\Zed\Acl\Persistence\SpyAclUserHasGroup as ChildSpyAclUserHasGroup;
use Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery as ChildSpyAclUserHasGroupQuery;
use Orm\Zed\Acl\Persistence\Map\SpyAclGroupTableMap;
use Orm\Zed\Acl\Persistence\Map\SpyAclGroupsHasRolesTableMap;
use Orm\Zed\Acl\Persistence\Map\SpyAclUserHasGroupTableMap;
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
 * Base class that represents a row from the 'spy_acl_group' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Acl.Persistence.Base
 */
abstract class SpyAclGroup implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Acl\\Persistence\\Map\\SpyAclGroupTableMap';


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
     * The value for the id_acl_group field.
     *
     * @var        int
     */
    protected $id_acl_group;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the reference field.
     * A reference to another resource or definition.
     * @var        string|null
     */
    protected $reference;

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
     * @var        ObjectCollection|ChildSpyAclUserHasGroup[] Collection to store aggregation of ChildSpyAclUserHasGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclUserHasGroup> Collection to store aggregation of ChildSpyAclUserHasGroup objects.
     */
    protected $collSpyAclUserHasGroups;
    protected $collSpyAclUserHasGroupsPartial;

    /**
     * @var        ObjectCollection|ChildSpyAclGroupsHasRoles[] Collection to store aggregation of ChildSpyAclGroupsHasRoles objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles> Collection to store aggregation of ChildSpyAclGroupsHasRoles objects.
     */
    protected $collSpyAclGroupsHasRoless;
    protected $collSpyAclGroupsHasRolessPartial;

    /**
     * @var        ObjectCollection|SpyUser[] Cross Collection to store aggregation of SpyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUser> Cross Collection to store aggregation of SpyUser objects.
     */
    protected $collSpyUsers;

    /**
     * @var bool
     */
    protected $collSpyUsersPartial;

    /**
     * @var        ObjectCollection|ChildSpyAclRole[] Cross Collection to store aggregation of ChildSpyAclRole objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclRole> Cross Collection to store aggregation of ChildSpyAclRole objects.
     */
    protected $collSpyAclRoles;

    /**
     * @var bool
     */
    protected $collSpyAclRolesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // archivable behavior
    protected $archiveOnDelete = true;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUser>
     */
    protected $spyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclRole[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclRole>
     */
    protected $spyAclRolesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclUserHasGroup[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclUserHasGroup>
     */
    protected $spyAclUserHasGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclGroupsHasRoles[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles>
     */
    protected $spyAclGroupsHasRolessScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Acl\Persistence\Base\SpyAclGroup object.
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
     * Compares this with another <code>SpyAclGroup</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyAclGroup</code>, delegates to
     * <code>equals(SpyAclGroup)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_acl_group] column value.
     *
     * @return int
     */
    public function getIdAclGroup()
    {
        return $this->id_acl_group;
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
     * Get the [reference] column value.
     * A reference to another resource or definition.
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
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
     * Set the value of [id_acl_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdAclGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_acl_group !== $v) {
            $this->id_acl_group = $v;
            $this->modifiedColumns[SpyAclGroupTableMap::COL_ID_ACL_GROUP] = true;
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
            $this->modifiedColumns[SpyAclGroupTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reference] column.
     * A reference to another resource or definition.
     * @param string|null $v New value
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
            $this->modifiedColumns[SpyAclGroupTableMap::COL_REFERENCE] = true;
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
                $this->modifiedColumns[SpyAclGroupTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyAclGroupTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyAclGroupTableMap::translateFieldName('IdAclGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_acl_group = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyAclGroupTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyAclGroupTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyAclGroupTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyAclGroupTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyAclGroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Acl\\Persistence\\SpyAclGroup'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyAclGroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyAclGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyAclUserHasGroups = null;

            $this->collSpyAclGroupsHasRoless = null;

            $this->collSpyUsers = null;
            $this->collSpyAclRoles = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyAclGroup::setDeleted()
     * @see SpyAclGroup::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclGroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyAclGroupQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // archivable behavior
            if ($ret) {
                if ($this->archiveOnDelete) {
                    // do nothing yet. The object will be archived later when calling ChildSpyAclGroupQuery::delete().
                } else {
                    $deleteQuery->setArchiveOnDelete(false);
                    $this->archiveOnDelete = true;
                }
            }

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclGroupTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyAclGroupTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyAclGroupTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyAclGroupTableMap::COL_UPDATED_AT)) {
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
                SpyAclGroupTableMap::addInstanceToPool($this);
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

            if ($this->spyUsersScheduledForDeletion !== null) {
                if (!$this->spyUsersScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyUsersScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdAclGroup();
                        $entryPk[1] = $entry->getIdUser();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyUsersScheduledForDeletion = null;
                }

            }

            if ($this->collSpyUsers) {
                foreach ($this->collSpyUsers as $spyUser) {
                    if (!$spyUser->isDeleted() && ($spyUser->isNew() || $spyUser->isModified())) {
                        $spyUser->save($con);
                    }
                }
            }


            if ($this->spyAclRolesScheduledForDeletion !== null) {
                if (!$this->spyAclRolesScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyAclRolesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdAclGroup();
                        $entryPk[1] = $entry->getIdAclRole();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\Acl\Persistence\SpyAclGroupsHasRolesQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyAclRolesScheduledForDeletion = null;
                }

            }

            if ($this->collSpyAclRoles) {
                foreach ($this->collSpyAclRoles as $spyAclRole) {
                    if (!$spyAclRole->isDeleted() && ($spyAclRole->isNew() || $spyAclRole->isModified())) {
                        $spyAclRole->save($con);
                    }
                }
            }


            if ($this->spyAclUserHasGroupsScheduledForDeletion !== null) {
                if (!$this->spyAclUserHasGroupsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery::create()
                        ->filterByPrimaryKeys($this->spyAclUserHasGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclUserHasGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclUserHasGroups !== null) {
                foreach ($this->collSpyAclUserHasGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyAclGroupsHasRolessScheduledForDeletion !== null) {
                if (!$this->spyAclGroupsHasRolessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Acl\Persistence\SpyAclGroupsHasRolesQuery::create()
                        ->filterByPrimaryKeys($this->spyAclGroupsHasRolessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclGroupsHasRolessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclGroupsHasRoless !== null) {
                foreach ($this->collSpyAclGroupsHasRoless as $referrerFK) {
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

        $this->modifiedColumns[SpyAclGroupTableMap::COL_ID_ACL_GROUP] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_ID_ACL_GROUP)) {
            $modifiedColumns[':p' . $index++]  = 'id_acl_group';
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_acl_group (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_acl_group':
                        $stmt->bindValue($identifier, $this->id_acl_group, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'reference':
                        $stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_acl_group_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdAclGroup($pk);
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
        $pos = SpyAclGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAclGroup();

            case 1:
                return $this->getName();

            case 2:
                return $this->getReference();

            case 3:
                return $this->getCreatedAt();

            case 4:
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
        if (isset($alreadyDumpedObjects['SpyAclGroup'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyAclGroup'][$this->hashCode()] = true;
        $keys = SpyAclGroupTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdAclGroup(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getReference(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyAclUserHasGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclUserHasGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_user_has_groups';
                        break;
                    default:
                        $key = 'SpyAclUserHasGroups';
                }

                $result[$key] = $this->collSpyAclUserHasGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyAclGroupsHasRoless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclGroupsHasRoless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_groups_has_roless';
                        break;
                    default:
                        $key = 'SpyAclGroupsHasRoless';
                }

                $result[$key] = $this->collSpyAclGroupsHasRoless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyAclGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdAclGroup($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setReference($value);
                break;
            case 3:
                $this->setCreatedAt($value);
                break;
            case 4:
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
        $keys = SpyAclGroupTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdAclGroup($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setReference($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatedAt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUpdatedAt($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyAclGroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyAclGroupTableMap::COL_ID_ACL_GROUP)) {
            $criteria->add(SpyAclGroupTableMap::COL_ID_ACL_GROUP, $this->id_acl_group);
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_NAME)) {
            $criteria->add(SpyAclGroupTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_REFERENCE)) {
            $criteria->add(SpyAclGroupTableMap::COL_REFERENCE, $this->reference);
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyAclGroupTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyAclGroupTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyAclGroupTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyAclGroupQuery::create();
        $criteria->add(SpyAclGroupTableMap::COL_ID_ACL_GROUP, $this->id_acl_group);

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
        $validPk = null !== $this->getIdAclGroup();

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
        return $this->getIdAclGroup();
    }

    /**
     * Generic method to set the primary key (id_acl_group column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdAclGroup($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdAclGroup();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Acl\Persistence\SpyAclGroup (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setReference($this->getReference());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyAclUserHasGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclUserHasGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclGroupsHasRoless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclGroupsHasRoles($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAclGroup(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Acl\Persistence\SpyAclGroup Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('SpyAclUserHasGroup' === $relationName) {
            $this->initSpyAclUserHasGroups();
            return;
        }
        if ('SpyAclGroupsHasRoles' === $relationName) {
            $this->initSpyAclGroupsHasRoless();
            return;
        }
    }

    /**
     * Clears out the collSpyAclUserHasGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclUserHasGroups()
     */
    public function clearSpyAclUserHasGroups()
    {
        $this->collSpyAclUserHasGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclUserHasGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclUserHasGroups($v = true): void
    {
        $this->collSpyAclUserHasGroupsPartial = $v;
    }

    /**
     * Initializes the collSpyAclUserHasGroups collection.
     *
     * By default this just sets the collSpyAclUserHasGroups collection to an empty array (like clearcollSpyAclUserHasGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclUserHasGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclUserHasGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclUserHasGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclUserHasGroups = new $collectionClassName;
        $this->collSpyAclUserHasGroups->setModel('\Orm\Zed\Acl\Persistence\SpyAclUserHasGroup');
    }

    /**
     * Gets an array of ChildSpyAclUserHasGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyAclUserHasGroup[] List of ChildSpyAclUserHasGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclUserHasGroup> List of ChildSpyAclUserHasGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclUserHasGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclUserHasGroupsPartial && !$this->isNew();
        if (null === $this->collSpyAclUserHasGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclUserHasGroups) {
                    $this->initSpyAclUserHasGroups();
                } else {
                    $collectionClassName = SpyAclUserHasGroupTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclUserHasGroups = new $collectionClassName;
                    $collSpyAclUserHasGroups->setModel('\Orm\Zed\Acl\Persistence\SpyAclUserHasGroup');

                    return $collSpyAclUserHasGroups;
                }
            } else {
                $collSpyAclUserHasGroups = ChildSpyAclUserHasGroupQuery::create(null, $criteria)
                    ->filterBySpyAclGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclUserHasGroupsPartial && count($collSpyAclUserHasGroups)) {
                        $this->initSpyAclUserHasGroups(false);

                        foreach ($collSpyAclUserHasGroups as $obj) {
                            if (false == $this->collSpyAclUserHasGroups->contains($obj)) {
                                $this->collSpyAclUserHasGroups->append($obj);
                            }
                        }

                        $this->collSpyAclUserHasGroupsPartial = true;
                    }

                    return $collSpyAclUserHasGroups;
                }

                if ($partial && $this->collSpyAclUserHasGroups) {
                    foreach ($this->collSpyAclUserHasGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclUserHasGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyAclUserHasGroups = $collSpyAclUserHasGroups;
                $this->collSpyAclUserHasGroupsPartial = false;
            }
        }

        return $this->collSpyAclUserHasGroups;
    }

    /**
     * Sets a collection of ChildSpyAclUserHasGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclUserHasGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclUserHasGroups(Collection $spyAclUserHasGroups, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyAclUserHasGroup[] $spyAclUserHasGroupsToDelete */
        $spyAclUserHasGroupsToDelete = $this->getSpyAclUserHasGroups(new Criteria(), $con)->diff($spyAclUserHasGroups);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyAclUserHasGroupsScheduledForDeletion = clone $spyAclUserHasGroupsToDelete;

        foreach ($spyAclUserHasGroupsToDelete as $spyAclUserHasGroupRemoved) {
            $spyAclUserHasGroupRemoved->setSpyAclGroup(null);
        }

        $this->collSpyAclUserHasGroups = null;
        foreach ($spyAclUserHasGroups as $spyAclUserHasGroup) {
            $this->addSpyAclUserHasGroup($spyAclUserHasGroup);
        }

        $this->collSpyAclUserHasGroups = $spyAclUserHasGroups;
        $this->collSpyAclUserHasGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyAclUserHasGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyAclUserHasGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclUserHasGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclUserHasGroupsPartial && !$this->isNew();
        if (null === $this->collSpyAclUserHasGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclUserHasGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclUserHasGroups());
            }

            $query = ChildSpyAclUserHasGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclGroup($this)
                ->count($con);
        }

        return count($this->collSpyAclUserHasGroups);
    }

    /**
     * Method called to associate a ChildSpyAclUserHasGroup object to this object
     * through the ChildSpyAclUserHasGroup foreign key attribute.
     *
     * @param ChildSpyAclUserHasGroup $l ChildSpyAclUserHasGroup
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclUserHasGroup(ChildSpyAclUserHasGroup $l)
    {
        if ($this->collSpyAclUserHasGroups === null) {
            $this->initSpyAclUserHasGroups();
            $this->collSpyAclUserHasGroupsPartial = true;
        }

        if (!$this->collSpyAclUserHasGroups->contains($l)) {
            $this->doAddSpyAclUserHasGroup($l);

            if ($this->spyAclUserHasGroupsScheduledForDeletion and $this->spyAclUserHasGroupsScheduledForDeletion->contains($l)) {
                $this->spyAclUserHasGroupsScheduledForDeletion->remove($this->spyAclUserHasGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyAclUserHasGroup $spyAclUserHasGroup The ChildSpyAclUserHasGroup object to add.
     */
    protected function doAddSpyAclUserHasGroup(ChildSpyAclUserHasGroup $spyAclUserHasGroup): void
    {
        $this->collSpyAclUserHasGroups[]= $spyAclUserHasGroup;
        $spyAclUserHasGroup->setSpyAclGroup($this);
    }

    /**
     * @param ChildSpyAclUserHasGroup $spyAclUserHasGroup The ChildSpyAclUserHasGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclUserHasGroup(ChildSpyAclUserHasGroup $spyAclUserHasGroup)
    {
        if ($this->getSpyAclUserHasGroups()->contains($spyAclUserHasGroup)) {
            $pos = $this->collSpyAclUserHasGroups->search($spyAclUserHasGroup);
            $this->collSpyAclUserHasGroups->remove($pos);
            if (null === $this->spyAclUserHasGroupsScheduledForDeletion) {
                $this->spyAclUserHasGroupsScheduledForDeletion = clone $this->collSpyAclUserHasGroups;
                $this->spyAclUserHasGroupsScheduledForDeletion->clear();
            }
            $this->spyAclUserHasGroupsScheduledForDeletion[]= clone $spyAclUserHasGroup;
            $spyAclUserHasGroup->setSpyAclGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclGroup is new, it will return
     * an empty collection; or if this SpyAclGroup has previously
     * been saved, it will retrieve related SpyAclUserHasGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyAclUserHasGroup[] List of ChildSpyAclUserHasGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclUserHasGroup}> List of ChildSpyAclUserHasGroup objects
     */
    public function getSpyAclUserHasGroupsJoinSpyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyAclUserHasGroupQuery::create(null, $criteria);
        $query->joinWith('SpyUser', $joinBehavior);

        return $this->getSpyAclUserHasGroups($query, $con);
    }

    /**
     * Clears out the collSpyAclGroupsHasRoless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclGroupsHasRoless()
     */
    public function clearSpyAclGroupsHasRoless()
    {
        $this->collSpyAclGroupsHasRoless = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclGroupsHasRoless collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclGroupsHasRoless($v = true): void
    {
        $this->collSpyAclGroupsHasRolessPartial = $v;
    }

    /**
     * Initializes the collSpyAclGroupsHasRoless collection.
     *
     * By default this just sets the collSpyAclGroupsHasRoless collection to an empty array (like clearcollSpyAclGroupsHasRoless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclGroupsHasRoless(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclGroupsHasRoless && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclGroupsHasRolesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclGroupsHasRoless = new $collectionClassName;
        $this->collSpyAclGroupsHasRoless->setModel('\Orm\Zed\Acl\Persistence\SpyAclGroupsHasRoles');
    }

    /**
     * Gets an array of ChildSpyAclGroupsHasRoles objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyAclGroupsHasRoles[] List of ChildSpyAclGroupsHasRoles objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles> List of ChildSpyAclGroupsHasRoles objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclGroupsHasRoless(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclGroupsHasRolessPartial && !$this->isNew();
        if (null === $this->collSpyAclGroupsHasRoless || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclGroupsHasRoless) {
                    $this->initSpyAclGroupsHasRoless();
                } else {
                    $collectionClassName = SpyAclGroupsHasRolesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclGroupsHasRoless = new $collectionClassName;
                    $collSpyAclGroupsHasRoless->setModel('\Orm\Zed\Acl\Persistence\SpyAclGroupsHasRoles');

                    return $collSpyAclGroupsHasRoless;
                }
            } else {
                $collSpyAclGroupsHasRoless = ChildSpyAclGroupsHasRolesQuery::create(null, $criteria)
                    ->filterBySpyAclGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclGroupsHasRolessPartial && count($collSpyAclGroupsHasRoless)) {
                        $this->initSpyAclGroupsHasRoless(false);

                        foreach ($collSpyAclGroupsHasRoless as $obj) {
                            if (false == $this->collSpyAclGroupsHasRoless->contains($obj)) {
                                $this->collSpyAclGroupsHasRoless->append($obj);
                            }
                        }

                        $this->collSpyAclGroupsHasRolessPartial = true;
                    }

                    return $collSpyAclGroupsHasRoless;
                }

                if ($partial && $this->collSpyAclGroupsHasRoless) {
                    foreach ($this->collSpyAclGroupsHasRoless as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclGroupsHasRoless[] = $obj;
                        }
                    }
                }

                $this->collSpyAclGroupsHasRoless = $collSpyAclGroupsHasRoless;
                $this->collSpyAclGroupsHasRolessPartial = false;
            }
        }

        return $this->collSpyAclGroupsHasRoless;
    }

    /**
     * Sets a collection of ChildSpyAclGroupsHasRoles objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclGroupsHasRoless A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclGroupsHasRoless(Collection $spyAclGroupsHasRoless, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyAclGroupsHasRoles[] $spyAclGroupsHasRolessToDelete */
        $spyAclGroupsHasRolessToDelete = $this->getSpyAclGroupsHasRoless(new Criteria(), $con)->diff($spyAclGroupsHasRoless);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyAclGroupsHasRolessScheduledForDeletion = clone $spyAclGroupsHasRolessToDelete;

        foreach ($spyAclGroupsHasRolessToDelete as $spyAclGroupsHasRolesRemoved) {
            $spyAclGroupsHasRolesRemoved->setSpyAclGroup(null);
        }

        $this->collSpyAclGroupsHasRoless = null;
        foreach ($spyAclGroupsHasRoless as $spyAclGroupsHasRoles) {
            $this->addSpyAclGroupsHasRoles($spyAclGroupsHasRoles);
        }

        $this->collSpyAclGroupsHasRoless = $spyAclGroupsHasRoless;
        $this->collSpyAclGroupsHasRolessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyAclGroupsHasRoles objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyAclGroupsHasRoles objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclGroupsHasRoless(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclGroupsHasRolessPartial && !$this->isNew();
        if (null === $this->collSpyAclGroupsHasRoless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclGroupsHasRoless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclGroupsHasRoless());
            }

            $query = ChildSpyAclGroupsHasRolesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclGroup($this)
                ->count($con);
        }

        return count($this->collSpyAclGroupsHasRoless);
    }

    /**
     * Method called to associate a ChildSpyAclGroupsHasRoles object to this object
     * through the ChildSpyAclGroupsHasRoles foreign key attribute.
     *
     * @param ChildSpyAclGroupsHasRoles $l ChildSpyAclGroupsHasRoles
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclGroupsHasRoles(ChildSpyAclGroupsHasRoles $l)
    {
        if ($this->collSpyAclGroupsHasRoless === null) {
            $this->initSpyAclGroupsHasRoless();
            $this->collSpyAclGroupsHasRolessPartial = true;
        }

        if (!$this->collSpyAclGroupsHasRoless->contains($l)) {
            $this->doAddSpyAclGroupsHasRoles($l);

            if ($this->spyAclGroupsHasRolessScheduledForDeletion and $this->spyAclGroupsHasRolessScheduledForDeletion->contains($l)) {
                $this->spyAclGroupsHasRolessScheduledForDeletion->remove($this->spyAclGroupsHasRolessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyAclGroupsHasRoles $spyAclGroupsHasRoles The ChildSpyAclGroupsHasRoles object to add.
     */
    protected function doAddSpyAclGroupsHasRoles(ChildSpyAclGroupsHasRoles $spyAclGroupsHasRoles): void
    {
        $this->collSpyAclGroupsHasRoless[]= $spyAclGroupsHasRoles;
        $spyAclGroupsHasRoles->setSpyAclGroup($this);
    }

    /**
     * @param ChildSpyAclGroupsHasRoles $spyAclGroupsHasRoles The ChildSpyAclGroupsHasRoles object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclGroupsHasRoles(ChildSpyAclGroupsHasRoles $spyAclGroupsHasRoles)
    {
        if ($this->getSpyAclGroupsHasRoless()->contains($spyAclGroupsHasRoles)) {
            $pos = $this->collSpyAclGroupsHasRoless->search($spyAclGroupsHasRoles);
            $this->collSpyAclGroupsHasRoless->remove($pos);
            if (null === $this->spyAclGroupsHasRolessScheduledForDeletion) {
                $this->spyAclGroupsHasRolessScheduledForDeletion = clone $this->collSpyAclGroupsHasRoless;
                $this->spyAclGroupsHasRolessScheduledForDeletion->clear();
            }
            $this->spyAclGroupsHasRolessScheduledForDeletion[]= clone $spyAclGroupsHasRoles;
            $spyAclGroupsHasRoles->setSpyAclGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclGroup is new, it will return
     * an empty collection; or if this SpyAclGroup has previously
     * been saved, it will retrieve related SpyAclGroupsHasRoless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyAclGroupsHasRoles[] List of ChildSpyAclGroupsHasRoles objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles}> List of ChildSpyAclGroupsHasRoles objects
     */
    public function getSpyAclGroupsHasRolessJoinSpyAclRole(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyAclGroupsHasRolesQuery::create(null, $criteria);
        $query->joinWith('SpyAclRole', $joinBehavior);

        return $this->getSpyAclGroupsHasRoless($query, $con);
    }

    /**
     * Clears out the collSpyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyUsers()
     */
    public function clearSpyUsers()
    {
        $this->collSpyUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyUsers crossRef collection.
     *
     * By default this just sets the collSpyUsers collection to an empty collection (like clearSpyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyUsers()
    {
        $collectionClassName = SpyAclUserHasGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUsers = new $collectionClassName;
        $this->collSpyUsersPartial = true;
        $this->collSpyUsers->setModel('\Orm\Zed\User\Persistence\SpyUser');
    }

    /**
     * Checks if the collSpyUsers collection is loaded.
     *
     * @return bool
     */
    public function isSpyUsersLoaded(): bool
    {
        return null !== $this->collSpyUsers;
    }

    /**
     * Gets a collection of SpyUser objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_user_has_group cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyUser[] List of SpyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUser> List of SpyUser objects
     */
    public function getSpyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUsersPartial && !$this->isNew();
        if (null === $this->collSpyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUsers) {
                    $this->initSpyUsers();
                }
            } else {

                $query = SpyUserQuery::create(null, $criteria)
                    ->filterBySpyAclGroup($this);
                $collSpyUsers = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyUsers;
                }

                if ($partial && $this->collSpyUsers) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyUsers as $obj) {
                        if (!$collSpyUsers->contains($obj)) {
                            $collSpyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyUsers = $collSpyUsers;
                $this->collSpyUsersPartial = false;
            }
        }

        return $this->collSpyUsers;
    }

    /**
     * Sets a collection of SpyUser objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_user_has_group cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUsers(Collection $spyUsers, ?ConnectionInterface $con = null)
    {
        $this->clearSpyUsers();
        $currentSpyUsers = $this->getSpyUsers();

        $spyUsersScheduledForDeletion = $currentSpyUsers->diff($spyUsers);

        foreach ($spyUsersScheduledForDeletion as $toDelete) {
            $this->removeSpyUser($toDelete);
        }

        foreach ($spyUsers as $spyUser) {
            if (!$currentSpyUsers->contains($spyUser)) {
                $this->doAddSpyUser($spyUser);
            }
        }

        $this->collSpyUsersPartial = false;
        $this->collSpyUsers = $spyUsers;

        return $this;
    }

    /**
     * Gets the number of SpyUser objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_user_has_group cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyUser objects
     */
    public function countSpyUsers(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUsersPartial && !$this->isNew();
        if (null === $this->collSpyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUsers) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyUsers());
                }

                $query = SpyUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyAclGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyUsers);
        }
    }

    /**
     * Associate a SpyUser to this object
     * through the spy_acl_user_has_group cross reference table.
     *
     * @param SpyUser $spyUser
     * @return ChildSpyAclGroup The current object (for fluent API support)
     */
    public function addSpyUser(SpyUser $spyUser)
    {
        if ($this->collSpyUsers === null) {
            $this->initSpyUsers();
        }

        if (!$this->getSpyUsers()->contains($spyUser)) {
            // only add it if the **same** object is not already associated
            $this->collSpyUsers->push($spyUser);
            $this->doAddSpyUser($spyUser);
        }

        return $this;
    }

    /**
     *
     * @param SpyUser $spyUser
     */
    protected function doAddSpyUser(SpyUser $spyUser)
    {
        $spyAclUserHasGroup = new ChildSpyAclUserHasGroup();

        $spyAclUserHasGroup->setSpyUser($spyUser);

        $spyAclUserHasGroup->setSpyAclGroup($this);

        $this->addSpyAclUserHasGroup($spyAclUserHasGroup);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyUser->isSpyAclGroupsLoaded()) {
            $spyUser->initSpyAclGroups();
            $spyUser->getSpyAclGroups()->push($this);
        } elseif (!$spyUser->getSpyAclGroups()->contains($this)) {
            $spyUser->getSpyAclGroups()->push($this);
        }

    }

    /**
     * Remove spyUser of this object
     * through the spy_acl_user_has_group cross reference table.
     *
     * @param SpyUser $spyUser
     * @return ChildSpyAclGroup The current object (for fluent API support)
     */
    public function removeSpyUser(SpyUser $spyUser)
    {
        if ($this->getSpyUsers()->contains($spyUser)) {
            $spyAclUserHasGroup = new ChildSpyAclUserHasGroup();
            $spyAclUserHasGroup->setSpyUser($spyUser);
            if ($spyUser->isSpyAclGroupsLoaded()) {
                //remove the back reference if available
                $spyUser->getSpyAclGroups()->removeObject($this);
            }

            $spyAclUserHasGroup->setSpyAclGroup($this);
            $this->removeSpyAclUserHasGroup(clone $spyAclUserHasGroup);
            $spyAclUserHasGroup->clear();

            $this->collSpyUsers->remove($this->collSpyUsers->search($spyUser));

            if (null === $this->spyUsersScheduledForDeletion) {
                $this->spyUsersScheduledForDeletion = clone $this->collSpyUsers;
                $this->spyUsersScheduledForDeletion->clear();
            }

            $this->spyUsersScheduledForDeletion->push($spyUser);
        }


        return $this;
    }

    /**
     * Clears out the collSpyAclRoles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyAclRoles()
     */
    public function clearSpyAclRoles()
    {
        $this->collSpyAclRoles = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyAclRoles crossRef collection.
     *
     * By default this just sets the collSpyAclRoles collection to an empty collection (like clearSpyAclRoles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyAclRoles()
    {
        $collectionClassName = SpyAclGroupsHasRolesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclRoles = new $collectionClassName;
        $this->collSpyAclRolesPartial = true;
        $this->collSpyAclRoles->setModel('\Orm\Zed\Acl\Persistence\SpyAclRole');
    }

    /**
     * Checks if the collSpyAclRoles collection is loaded.
     *
     * @return bool
     */
    public function isSpyAclRolesLoaded(): bool
    {
        return null !== $this->collSpyAclRoles;
    }

    /**
     * Gets a collection of ChildSpyAclRole objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSpyAclRole[] List of ChildSpyAclRole objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclRole> List of ChildSpyAclRole objects
     */
    public function getSpyAclRoles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclRolesPartial && !$this->isNew();
        if (null === $this->collSpyAclRoles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclRoles) {
                    $this->initSpyAclRoles();
                }
            } else {

                $query = ChildSpyAclRoleQuery::create(null, $criteria)
                    ->filterBySpyAclGroup($this);
                $collSpyAclRoles = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyAclRoles;
                }

                if ($partial && $this->collSpyAclRoles) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyAclRoles as $obj) {
                        if (!$collSpyAclRoles->contains($obj)) {
                            $collSpyAclRoles[] = $obj;
                        }
                    }
                }

                $this->collSpyAclRoles = $collSpyAclRoles;
                $this->collSpyAclRolesPartial = false;
            }
        }

        return $this->collSpyAclRoles;
    }

    /**
     * Sets a collection of SpyAclRole objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclRoles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclRoles(Collection $spyAclRoles, ?ConnectionInterface $con = null)
    {
        $this->clearSpyAclRoles();
        $currentSpyAclRoles = $this->getSpyAclRoles();

        $spyAclRolesScheduledForDeletion = $currentSpyAclRoles->diff($spyAclRoles);

        foreach ($spyAclRolesScheduledForDeletion as $toDelete) {
            $this->removeSpyAclRole($toDelete);
        }

        foreach ($spyAclRoles as $spyAclRole) {
            if (!$currentSpyAclRoles->contains($spyAclRole)) {
                $this->doAddSpyAclRole($spyAclRole);
            }
        }

        $this->collSpyAclRolesPartial = false;
        $this->collSpyAclRoles = $spyAclRoles;

        return $this;
    }

    /**
     * Gets the number of SpyAclRole objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyAclRole objects
     */
    public function countSpyAclRoles(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclRolesPartial && !$this->isNew();
        if (null === $this->collSpyAclRoles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclRoles) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyAclRoles());
                }

                $query = ChildSpyAclRoleQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyAclGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyAclRoles);
        }
    }

    /**
     * Associate a ChildSpyAclRole to this object
     * through the spy_acl_groups_has_roles cross reference table.
     *
     * @param ChildSpyAclRole $spyAclRole
     * @return ChildSpyAclGroup The current object (for fluent API support)
     */
    public function addSpyAclRole(ChildSpyAclRole $spyAclRole)
    {
        if ($this->collSpyAclRoles === null) {
            $this->initSpyAclRoles();
        }

        if (!$this->getSpyAclRoles()->contains($spyAclRole)) {
            // only add it if the **same** object is not already associated
            $this->collSpyAclRoles->push($spyAclRole);
            $this->doAddSpyAclRole($spyAclRole);
        }

        return $this;
    }

    /**
     *
     * @param ChildSpyAclRole $spyAclRole
     */
    protected function doAddSpyAclRole(ChildSpyAclRole $spyAclRole)
    {
        $spyAclGroupsHasRoles = new ChildSpyAclGroupsHasRoles();

        $spyAclGroupsHasRoles->setSpyAclRole($spyAclRole);

        $spyAclGroupsHasRoles->setSpyAclGroup($this);

        $this->addSpyAclGroupsHasRoles($spyAclGroupsHasRoles);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyAclRole->isSpyAclGroupsLoaded()) {
            $spyAclRole->initSpyAclGroups();
            $spyAclRole->getSpyAclGroups()->push($this);
        } elseif (!$spyAclRole->getSpyAclGroups()->contains($this)) {
            $spyAclRole->getSpyAclGroups()->push($this);
        }

    }

    /**
     * Remove spyAclRole of this object
     * through the spy_acl_groups_has_roles cross reference table.
     *
     * @param ChildSpyAclRole $spyAclRole
     * @return ChildSpyAclGroup The current object (for fluent API support)
     */
    public function removeSpyAclRole(ChildSpyAclRole $spyAclRole)
    {
        if ($this->getSpyAclRoles()->contains($spyAclRole)) {
            $spyAclGroupsHasRoles = new ChildSpyAclGroupsHasRoles();
            $spyAclGroupsHasRoles->setSpyAclRole($spyAclRole);
            if ($spyAclRole->isSpyAclGroupsLoaded()) {
                //remove the back reference if available
                $spyAclRole->getSpyAclGroups()->removeObject($this);
            }

            $spyAclGroupsHasRoles->setSpyAclGroup($this);
            $this->removeSpyAclGroupsHasRoles(clone $spyAclGroupsHasRoles);
            $spyAclGroupsHasRoles->clear();

            $this->collSpyAclRoles->remove($this->collSpyAclRoles->search($spyAclRole));

            if (null === $this->spyAclRolesScheduledForDeletion) {
                $this->spyAclRolesScheduledForDeletion = clone $this->collSpyAclRoles;
                $this->spyAclRolesScheduledForDeletion->clear();
            }

            $this->spyAclRolesScheduledForDeletion->push($spyAclRole);
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
        $this->id_acl_group = null;
        $this->name = null;
        $this->reference = null;
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
            if ($this->collSpyAclUserHasGroups) {
                foreach ($this->collSpyAclUserHasGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclGroupsHasRoless) {
                foreach ($this->collSpyAclGroupsHasRoless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyUsers) {
                foreach ($this->collSpyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclRoles) {
                foreach ($this->collSpyAclRoles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyAclUserHasGroups = null;
        $this->collSpyAclGroupsHasRoless = null;
        $this->collSpyUsers = null;
        $this->collSpyAclRoles = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyAclGroupTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyAclGroupTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // archivable behavior

    /**
     * Get an archived version of the current object.
     *
     * @param ConnectionInterface|null $con Optional connection object
     *
     * @return ChildSpyAclGroupArchive An archive object, or null if the current object was never archived
     */
    public function getArchive(?ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            return null;
        }
        $archive = ChildSpyAclGroupArchiveQuery::create()
            ->filterByPrimaryKey($this->getPrimaryKey())
            ->findOne($con);

        return $archive;
    }
    /**
     * Copy the data of the current object into a $archiveTablePhpName archive object.
     * The archived object is then saved.
     * If the current object has already been archived, the archived object
     * is updated and not duplicated.
     *
     * @param ConnectionInterface|null $con Optional connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException If the object is new
     *
     * @return ChildSpyAclGroupArchive The archive object based on this object
     */
    public function archive(?ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be archived. You must save the current object before calling archive().');
        }
        $archive = $this->getArchive($con);
        if (!$archive) {
            $archive = new ChildSpyAclGroupArchive();
            $archive->setPrimaryKey($this->getPrimaryKey());
        }
        $this->copyInto($archive, $deepCopy = false, $makeNew = false);
        $archive->setArchivedAt(time());
        $archive->save($con);

        return $archive;
    }

    /**
     * Revert the the current object to the state it had when it was last archived.
     * The object must be saved afterwards if the changes must persist.
     *
     * @param ConnectionInterface|null $con Optional connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException If the object has no corresponding archive.
     *
     * @return $this The current object (for fluent API support)
     */
    public function restoreFromArchive(?ConnectionInterface $con = null)
    {
        $archive = $this->getArchive($con);
        if (!$archive) {
            throw new PropelException('The current object has never been archived and cannot be restored');
        }
        $this->populateFromArchive($archive);

        return $this;
    }

    /**
     * Populates the the current object based on a $archiveTablePhpName archive object.
     *
     * @param ChildSpyAclGroupArchive $archive An archived object based on the same class
      * @param bool $populateAutoIncrementPrimaryKeys
     *               If true, autoincrement columns are copied from the archive object.
     *               If false, autoincrement columns are left intact.
      *
     * @return ChildSpyAclGroup The current object (for fluent API support)
     */
    public function populateFromArchive($archive, bool $populateAutoIncrementPrimaryKeys = false)
    {
        if ($populateAutoIncrementPrimaryKeys) {
            $this->setIdAclGroup($archive->getIdAclGroup());
        }
        $this->setName($archive->getName());
        $this->setReference($archive->getReference());
        $this->setCreatedAt($archive->getCreatedAt());
        $this->setUpdatedAt($archive->getUpdatedAt());

        return $this;
    }

    /**
     * Removes the object from the database without archiving it.
     *
     * @param ConnectionInterface|null $con Optional connection object
     *
     * @return $this|ChildSpyAclGroup The current object (for fluent API support)
     */
    public function deleteWithoutArchive(?ConnectionInterface $con = null)
    {
        $this->archiveOnDelete = false;

        return $this->delete($con);
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
