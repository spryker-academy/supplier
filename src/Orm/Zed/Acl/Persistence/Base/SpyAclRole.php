<?php

namespace Orm\Zed\Acl\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRule;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery;
use Orm\Zed\AclEntity\Persistence\Base\SpyAclEntityRule as BaseSpyAclEntityRule;
use Orm\Zed\AclEntity\Persistence\Map\SpyAclEntityRuleTableMap;
use Orm\Zed\Acl\Persistence\SpyAclGroup as ChildSpyAclGroup;
use Orm\Zed\Acl\Persistence\SpyAclGroupQuery as ChildSpyAclGroupQuery;
use Orm\Zed\Acl\Persistence\SpyAclGroupsHasRoles as ChildSpyAclGroupsHasRoles;
use Orm\Zed\Acl\Persistence\SpyAclGroupsHasRolesQuery as ChildSpyAclGroupsHasRolesQuery;
use Orm\Zed\Acl\Persistence\SpyAclRole as ChildSpyAclRole;
use Orm\Zed\Acl\Persistence\SpyAclRoleArchive as ChildSpyAclRoleArchive;
use Orm\Zed\Acl\Persistence\SpyAclRoleArchiveQuery as ChildSpyAclRoleArchiveQuery;
use Orm\Zed\Acl\Persistence\SpyAclRoleQuery as ChildSpyAclRoleQuery;
use Orm\Zed\Acl\Persistence\SpyAclRule as ChildSpyAclRule;
use Orm\Zed\Acl\Persistence\SpyAclRuleQuery as ChildSpyAclRuleQuery;
use Orm\Zed\Acl\Persistence\Map\SpyAclGroupsHasRolesTableMap;
use Orm\Zed\Acl\Persistence\Map\SpyAclRoleTableMap;
use Orm\Zed\Acl\Persistence\Map\SpyAclRuleTableMap;
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
 * Base class that represents a row from the 'spy_acl_role' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Acl.Persistence.Base
 */
abstract class SpyAclRole implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Acl\\Persistence\\Map\\SpyAclRoleTableMap';


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
     * The value for the id_acl_role field.
     *
     * @var        int
     */
    protected $id_acl_role;

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
     * @var        ObjectCollection|ChildSpyAclRule[] Collection to store aggregation of ChildSpyAclRule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclRule> Collection to store aggregation of ChildSpyAclRule objects.
     */
    protected $collAclRules;
    protected $collAclRulesPartial;

    /**
     * @var        ObjectCollection|ChildSpyAclGroupsHasRoles[] Collection to store aggregation of ChildSpyAclGroupsHasRoles objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles> Collection to store aggregation of ChildSpyAclGroupsHasRoles objects.
     */
    protected $collSpyAclGroupsHasRoless;
    protected $collSpyAclGroupsHasRolessPartial;

    /**
     * @var        ObjectCollection|SpyAclEntityRule[] Collection to store aggregation of SpyAclEntityRule objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntityRule> Collection to store aggregation of SpyAclEntityRule objects.
     */
    protected $collSpyAclEntityRules;
    protected $collSpyAclEntityRulesPartial;

    /**
     * @var        ObjectCollection|ChildSpyAclGroup[] Cross Collection to store aggregation of ChildSpyAclGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroup> Cross Collection to store aggregation of ChildSpyAclGroup objects.
     */
    protected $collSpyAclGroups;

    /**
     * @var bool
     */
    protected $collSpyAclGroupsPartial;

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
     * @var ObjectCollection|ChildSpyAclGroup[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroup>
     */
    protected $spyAclGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclRule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclRule>
     */
    protected $aclRulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclGroupsHasRoles[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles>
     */
    protected $spyAclGroupsHasRolessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAclEntityRule[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntityRule>
     */
    protected $spyAclEntityRulesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Acl\Persistence\Base\SpyAclRole object.
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
     * Compares this with another <code>SpyAclRole</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyAclRole</code>, delegates to
     * <code>equals(SpyAclRole)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_acl_role] column value.
     *
     * @return int
     */
    public function getIdAclRole()
    {
        return $this->id_acl_role;
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
     * Set the value of [id_acl_role] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdAclRole($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_acl_role !== $v) {
            $this->id_acl_role = $v;
            $this->modifiedColumns[SpyAclRoleTableMap::COL_ID_ACL_ROLE] = true;
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
            $this->modifiedColumns[SpyAclRoleTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[SpyAclRoleTableMap::COL_REFERENCE] = true;
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
                $this->modifiedColumns[SpyAclRoleTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyAclRoleTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyAclRoleTableMap::translateFieldName('IdAclRole', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_acl_role = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyAclRoleTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyAclRoleTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyAclRoleTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyAclRoleTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyAclRoleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Acl\\Persistence\\SpyAclRole'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyAclRoleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyAclRoleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAclRules = null;

            $this->collSpyAclGroupsHasRoless = null;

            $this->collSpyAclEntityRules = null;

            $this->collSpyAclGroups = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyAclRole::setDeleted()
     * @see SpyAclRole::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclRoleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyAclRoleQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // archivable behavior
            if ($ret) {
                if ($this->archiveOnDelete) {
                    // do nothing yet. The object will be archived later when calling ChildSpyAclRoleQuery::delete().
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclRoleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyAclRoleTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyAclRoleTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyAclRoleTableMap::COL_UPDATED_AT)) {
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
                SpyAclRoleTableMap::addInstanceToPool($this);
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

            if ($this->spyAclGroupsScheduledForDeletion !== null) {
                if (!$this->spyAclGroupsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyAclGroupsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdAclRole();
                        $entryPk[0] = $entry->getIdAclGroup();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\Acl\Persistence\SpyAclGroupsHasRolesQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyAclGroupsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyAclGroups) {
                foreach ($this->collSpyAclGroups as $spyAclGroup) {
                    if (!$spyAclGroup->isDeleted() && ($spyAclGroup->isNew() || $spyAclGroup->isModified())) {
                        $spyAclGroup->save($con);
                    }
                }
            }


            if ($this->aclRulesScheduledForDeletion !== null) {
                if (!$this->aclRulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Acl\Persistence\SpyAclRuleQuery::create()
                        ->filterByPrimaryKeys($this->aclRulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->aclRulesScheduledForDeletion = null;
                }
            }

            if ($this->collAclRules !== null) {
                foreach ($this->collAclRules as $referrerFK) {
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

            if ($this->spyAclEntityRulesScheduledForDeletion !== null) {
                if (!$this->spyAclEntityRulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery::create()
                        ->filterByPrimaryKeys($this->spyAclEntityRulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclEntityRulesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclEntityRules !== null) {
                foreach ($this->collSpyAclEntityRules as $referrerFK) {
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

        $this->modifiedColumns[SpyAclRoleTableMap::COL_ID_ACL_ROLE] = true;
        if (null !== $this->id_acl_role) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyAclRoleTableMap::COL_ID_ACL_ROLE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_ID_ACL_ROLE)) {
            $modifiedColumns[':p' . $index++]  = 'id_acl_role';
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_acl_role (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_acl_role':
                        $stmt->bindValue($identifier, $this->id_acl_role, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_acl_role_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdAclRole($pk);

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
        $pos = SpyAclRoleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAclRole();

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
        if (isset($alreadyDumpedObjects['SpyAclRole'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyAclRole'][$this->hashCode()] = true;
        $keys = SpyAclRoleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdAclRole(),
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
            if (null !== $this->collAclRules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclRules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_rules';
                        break;
                    default:
                        $key = 'AclRules';
                }

                $result[$key] = $this->collAclRules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyAclEntityRules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclEntityRules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_entity_rules';
                        break;
                    default:
                        $key = 'SpyAclEntityRules';
                }

                $result[$key] = $this->collSpyAclEntityRules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyAclRoleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdAclRole($value);
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
        $keys = SpyAclRoleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdAclRole($arr[$keys[0]]);
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
        $criteria = new Criteria(SpyAclRoleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyAclRoleTableMap::COL_ID_ACL_ROLE)) {
            $criteria->add(SpyAclRoleTableMap::COL_ID_ACL_ROLE, $this->id_acl_role);
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_NAME)) {
            $criteria->add(SpyAclRoleTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_REFERENCE)) {
            $criteria->add(SpyAclRoleTableMap::COL_REFERENCE, $this->reference);
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyAclRoleTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyAclRoleTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyAclRoleTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyAclRoleQuery::create();
        $criteria->add(SpyAclRoleTableMap::COL_ID_ACL_ROLE, $this->id_acl_role);

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
        $validPk = null !== $this->getIdAclRole();

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
        return $this->getIdAclRole();
    }

    /**
     * Generic method to set the primary key (id_acl_role column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdAclRole($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdAclRole();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Acl\Persistence\SpyAclRole (or compatible) type.
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

            foreach ($this->getAclRules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAclRule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclGroupsHasRoless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclGroupsHasRoles($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclEntityRules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclEntityRule($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAclRole(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Acl\Persistence\SpyAclRole Clone of current object.
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
        if ('AclRule' === $relationName) {
            $this->initAclRules();
            return;
        }
        if ('SpyAclGroupsHasRoles' === $relationName) {
            $this->initSpyAclGroupsHasRoless();
            return;
        }
        if ('SpyAclEntityRule' === $relationName) {
            $this->initSpyAclEntityRules();
            return;
        }
    }

    /**
     * Clears out the collAclRules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAclRules()
     */
    public function clearAclRules()
    {
        $this->collAclRules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAclRules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAclRules($v = true): void
    {
        $this->collAclRulesPartial = $v;
    }

    /**
     * Initializes the collAclRules collection.
     *
     * By default this just sets the collAclRules collection to an empty array (like clearcollAclRules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAclRules(bool $overrideExisting = true): void
    {
        if (null !== $this->collAclRules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclRuleTableMap::getTableMap()->getCollectionClassName();

        $this->collAclRules = new $collectionClassName;
        $this->collAclRules->setModel('\Orm\Zed\Acl\Persistence\SpyAclRule');
    }

    /**
     * Gets an array of ChildSpyAclRule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyAclRule[] List of ChildSpyAclRule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclRule> List of ChildSpyAclRule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAclRules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAclRulesPartial && !$this->isNew();
        if (null === $this->collAclRules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAclRules) {
                    $this->initAclRules();
                } else {
                    $collectionClassName = SpyAclRuleTableMap::getTableMap()->getCollectionClassName();

                    $collAclRules = new $collectionClassName;
                    $collAclRules->setModel('\Orm\Zed\Acl\Persistence\SpyAclRule');

                    return $collAclRules;
                }
            } else {
                $collAclRules = ChildSpyAclRuleQuery::create(null, $criteria)
                    ->filterByAclRole($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAclRulesPartial && count($collAclRules)) {
                        $this->initAclRules(false);

                        foreach ($collAclRules as $obj) {
                            if (false == $this->collAclRules->contains($obj)) {
                                $this->collAclRules->append($obj);
                            }
                        }

                        $this->collAclRulesPartial = true;
                    }

                    return $collAclRules;
                }

                if ($partial && $this->collAclRules) {
                    foreach ($this->collAclRules as $obj) {
                        if ($obj->isNew()) {
                            $collAclRules[] = $obj;
                        }
                    }
                }

                $this->collAclRules = $collAclRules;
                $this->collAclRulesPartial = false;
            }
        }

        return $this->collAclRules;
    }

    /**
     * Sets a collection of ChildSpyAclRule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $aclRules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAclRules(Collection $aclRules, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyAclRule[] $aclRulesToDelete */
        $aclRulesToDelete = $this->getAclRules(new Criteria(), $con)->diff($aclRules);


        $this->aclRulesScheduledForDeletion = $aclRulesToDelete;

        foreach ($aclRulesToDelete as $aclRuleRemoved) {
            $aclRuleRemoved->setAclRole(null);
        }

        $this->collAclRules = null;
        foreach ($aclRules as $aclRule) {
            $this->addAclRule($aclRule);
        }

        $this->collAclRules = $aclRules;
        $this->collAclRulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyAclRule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyAclRule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAclRules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAclRulesPartial && !$this->isNew();
        if (null === $this->collAclRules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAclRules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAclRules());
            }

            $query = ChildSpyAclRuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAclRole($this)
                ->count($con);
        }

        return count($this->collAclRules);
    }

    /**
     * Method called to associate a ChildSpyAclRule object to this object
     * through the ChildSpyAclRule foreign key attribute.
     *
     * @param ChildSpyAclRule $l ChildSpyAclRule
     * @return $this The current object (for fluent API support)
     */
    public function addAclRule(ChildSpyAclRule $l)
    {
        if ($this->collAclRules === null) {
            $this->initAclRules();
            $this->collAclRulesPartial = true;
        }

        if (!$this->collAclRules->contains($l)) {
            $this->doAddAclRule($l);

            if ($this->aclRulesScheduledForDeletion and $this->aclRulesScheduledForDeletion->contains($l)) {
                $this->aclRulesScheduledForDeletion->remove($this->aclRulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyAclRule $aclRule The ChildSpyAclRule object to add.
     */
    protected function doAddAclRule(ChildSpyAclRule $aclRule): void
    {
        $this->collAclRules[]= $aclRule;
        $aclRule->setAclRole($this);
    }

    /**
     * @param ChildSpyAclRule $aclRule The ChildSpyAclRule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAclRule(ChildSpyAclRule $aclRule)
    {
        if ($this->getAclRules()->contains($aclRule)) {
            $pos = $this->collAclRules->search($aclRule);
            $this->collAclRules->remove($pos);
            if (null === $this->aclRulesScheduledForDeletion) {
                $this->aclRulesScheduledForDeletion = clone $this->collAclRules;
                $this->aclRulesScheduledForDeletion->clear();
            }
            $this->aclRulesScheduledForDeletion[]= clone $aclRule;
            $aclRule->setAclRole(null);
        }

        return $this;
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
     * If this ChildSpyAclRole is new, it will return
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
                    ->filterBySpyAclRole($this)
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
            $spyAclGroupsHasRolesRemoved->setSpyAclRole(null);
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
                ->filterBySpyAclRole($this)
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
        $spyAclGroupsHasRoles->setSpyAclRole($this);
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
            $spyAclGroupsHasRoles->setSpyAclRole(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclRole is new, it will return
     * an empty collection; or if this SpyAclRole has previously
     * been saved, it will retrieve related SpyAclGroupsHasRoless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclRole.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyAclGroupsHasRoles[] List of ChildSpyAclGroupsHasRoles objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclGroupsHasRoles}> List of ChildSpyAclGroupsHasRoles objects
     */
    public function getSpyAclGroupsHasRolessJoinSpyAclGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyAclGroupsHasRolesQuery::create(null, $criteria);
        $query->joinWith('SpyAclGroup', $joinBehavior);

        return $this->getSpyAclGroupsHasRoless($query, $con);
    }

    /**
     * Clears out the collSpyAclEntityRules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclEntityRules()
     */
    public function clearSpyAclEntityRules()
    {
        $this->collSpyAclEntityRules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclEntityRules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclEntityRules($v = true): void
    {
        $this->collSpyAclEntityRulesPartial = $v;
    }

    /**
     * Initializes the collSpyAclEntityRules collection.
     *
     * By default this just sets the collSpyAclEntityRules collection to an empty array (like clearcollSpyAclEntityRules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclEntityRules(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclEntityRules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclEntityRuleTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclEntityRules = new $collectionClassName;
        $this->collSpyAclEntityRules->setModel('\Orm\Zed\AclEntity\Persistence\SpyAclEntityRule');
    }

    /**
     * Gets an array of SpyAclEntityRule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAclEntityRule[] List of SpyAclEntityRule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntityRule> List of SpyAclEntityRule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclEntityRules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclEntityRulesPartial && !$this->isNew();
        if (null === $this->collSpyAclEntityRules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclEntityRules) {
                    $this->initSpyAclEntityRules();
                } else {
                    $collectionClassName = SpyAclEntityRuleTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclEntityRules = new $collectionClassName;
                    $collSpyAclEntityRules->setModel('\Orm\Zed\AclEntity\Persistence\SpyAclEntityRule');

                    return $collSpyAclEntityRules;
                }
            } else {
                $collSpyAclEntityRules = SpyAclEntityRuleQuery::create(null, $criteria)
                    ->filterBySpyAclRole($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclEntityRulesPartial && count($collSpyAclEntityRules)) {
                        $this->initSpyAclEntityRules(false);

                        foreach ($collSpyAclEntityRules as $obj) {
                            if (false == $this->collSpyAclEntityRules->contains($obj)) {
                                $this->collSpyAclEntityRules->append($obj);
                            }
                        }

                        $this->collSpyAclEntityRulesPartial = true;
                    }

                    return $collSpyAclEntityRules;
                }

                if ($partial && $this->collSpyAclEntityRules) {
                    foreach ($this->collSpyAclEntityRules as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclEntityRules[] = $obj;
                        }
                    }
                }

                $this->collSpyAclEntityRules = $collSpyAclEntityRules;
                $this->collSpyAclEntityRulesPartial = false;
            }
        }

        return $this->collSpyAclEntityRules;
    }

    /**
     * Sets a collection of SpyAclEntityRule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclEntityRules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclEntityRules(Collection $spyAclEntityRules, ?ConnectionInterface $con = null)
    {
        /** @var SpyAclEntityRule[] $spyAclEntityRulesToDelete */
        $spyAclEntityRulesToDelete = $this->getSpyAclEntityRules(new Criteria(), $con)->diff($spyAclEntityRules);


        $this->spyAclEntityRulesScheduledForDeletion = $spyAclEntityRulesToDelete;

        foreach ($spyAclEntityRulesToDelete as $spyAclEntityRuleRemoved) {
            $spyAclEntityRuleRemoved->setSpyAclRole(null);
        }

        $this->collSpyAclEntityRules = null;
        foreach ($spyAclEntityRules as $spyAclEntityRule) {
            $this->addSpyAclEntityRule($spyAclEntityRule);
        }

        $this->collSpyAclEntityRules = $spyAclEntityRules;
        $this->collSpyAclEntityRulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAclEntityRule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAclEntityRule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclEntityRules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclEntityRulesPartial && !$this->isNew();
        if (null === $this->collSpyAclEntityRules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclEntityRules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclEntityRules());
            }

            $query = SpyAclEntityRuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclRole($this)
                ->count($con);
        }

        return count($this->collSpyAclEntityRules);
    }

    /**
     * Method called to associate a SpyAclEntityRule object to this object
     * through the SpyAclEntityRule foreign key attribute.
     *
     * @param SpyAclEntityRule $l SpyAclEntityRule
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclEntityRule(SpyAclEntityRule $l)
    {
        if ($this->collSpyAclEntityRules === null) {
            $this->initSpyAclEntityRules();
            $this->collSpyAclEntityRulesPartial = true;
        }

        if (!$this->collSpyAclEntityRules->contains($l)) {
            $this->doAddSpyAclEntityRule($l);

            if ($this->spyAclEntityRulesScheduledForDeletion and $this->spyAclEntityRulesScheduledForDeletion->contains($l)) {
                $this->spyAclEntityRulesScheduledForDeletion->remove($this->spyAclEntityRulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAclEntityRule $spyAclEntityRule The SpyAclEntityRule object to add.
     */
    protected function doAddSpyAclEntityRule(SpyAclEntityRule $spyAclEntityRule): void
    {
        $this->collSpyAclEntityRules[]= $spyAclEntityRule;
        $spyAclEntityRule->setSpyAclRole($this);
    }

    /**
     * @param SpyAclEntityRule $spyAclEntityRule The SpyAclEntityRule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclEntityRule(SpyAclEntityRule $spyAclEntityRule)
    {
        if ($this->getSpyAclEntityRules()->contains($spyAclEntityRule)) {
            $pos = $this->collSpyAclEntityRules->search($spyAclEntityRule);
            $this->collSpyAclEntityRules->remove($pos);
            if (null === $this->spyAclEntityRulesScheduledForDeletion) {
                $this->spyAclEntityRulesScheduledForDeletion = clone $this->collSpyAclEntityRules;
                $this->spyAclEntityRulesScheduledForDeletion->clear();
            }
            $this->spyAclEntityRulesScheduledForDeletion[]= clone $spyAclEntityRule;
            $spyAclEntityRule->setSpyAclRole(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclRole is new, it will return
     * an empty collection; or if this SpyAclRole has previously
     * been saved, it will retrieve related SpyAclEntityRules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclRole.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAclEntityRule[] List of SpyAclEntityRule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntityRule}> List of SpyAclEntityRule objects
     */
    public function getSpyAclEntityRulesJoinSpyAclEntitySegment(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAclEntityRuleQuery::create(null, $criteria);
        $query->joinWith('SpyAclEntitySegment', $joinBehavior);

        return $this->getSpyAclEntityRules($query, $con);
    }

    /**
     * Clears out the collSpyAclGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyAclGroups()
     */
    public function clearSpyAclGroups()
    {
        $this->collSpyAclGroups = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyAclGroups crossRef collection.
     *
     * By default this just sets the collSpyAclGroups collection to an empty collection (like clearSpyAclGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyAclGroups()
    {
        $collectionClassName = SpyAclGroupsHasRolesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclGroups = new $collectionClassName;
        $this->collSpyAclGroupsPartial = true;
        $this->collSpyAclGroups->setModel('\Orm\Zed\Acl\Persistence\SpyAclGroup');
    }

    /**
     * Checks if the collSpyAclGroups collection is loaded.
     *
     * @return bool
     */
    public function isSpyAclGroupsLoaded(): bool
    {
        return null !== $this->collSpyAclGroups;
    }

    /**
     * Gets a collection of ChildSpyAclGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSpyAclGroup[] List of ChildSpyAclGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclGroup> List of ChildSpyAclGroup objects
     */
    public function getSpyAclGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclGroupsPartial && !$this->isNew();
        if (null === $this->collSpyAclGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclGroups) {
                    $this->initSpyAclGroups();
                }
            } else {

                $query = ChildSpyAclGroupQuery::create(null, $criteria)
                    ->filterBySpyAclRole($this);
                $collSpyAclGroups = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyAclGroups;
                }

                if ($partial && $this->collSpyAclGroups) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyAclGroups as $obj) {
                        if (!$collSpyAclGroups->contains($obj)) {
                            $collSpyAclGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyAclGroups = $collSpyAclGroups;
                $this->collSpyAclGroupsPartial = false;
            }
        }

        return $this->collSpyAclGroups;
    }

    /**
     * Sets a collection of SpyAclGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclGroups(Collection $spyAclGroups, ?ConnectionInterface $con = null)
    {
        $this->clearSpyAclGroups();
        $currentSpyAclGroups = $this->getSpyAclGroups();

        $spyAclGroupsScheduledForDeletion = $currentSpyAclGroups->diff($spyAclGroups);

        foreach ($spyAclGroupsScheduledForDeletion as $toDelete) {
            $this->removeSpyAclGroup($toDelete);
        }

        foreach ($spyAclGroups as $spyAclGroup) {
            if (!$currentSpyAclGroups->contains($spyAclGroup)) {
                $this->doAddSpyAclGroup($spyAclGroup);
            }
        }

        $this->collSpyAclGroupsPartial = false;
        $this->collSpyAclGroups = $spyAclGroups;

        return $this;
    }

    /**
     * Gets the number of SpyAclGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_acl_groups_has_roles cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyAclGroup objects
     */
    public function countSpyAclGroups(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclGroupsPartial && !$this->isNew();
        if (null === $this->collSpyAclGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclGroups) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyAclGroups());
                }

                $query = ChildSpyAclGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyAclRole($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyAclGroups);
        }
    }

    /**
     * Associate a ChildSpyAclGroup to this object
     * through the spy_acl_groups_has_roles cross reference table.
     *
     * @param ChildSpyAclGroup $spyAclGroup
     * @return ChildSpyAclRole The current object (for fluent API support)
     */
    public function addSpyAclGroup(ChildSpyAclGroup $spyAclGroup)
    {
        if ($this->collSpyAclGroups === null) {
            $this->initSpyAclGroups();
        }

        if (!$this->getSpyAclGroups()->contains($spyAclGroup)) {
            // only add it if the **same** object is not already associated
            $this->collSpyAclGroups->push($spyAclGroup);
            $this->doAddSpyAclGroup($spyAclGroup);
        }

        return $this;
    }

    /**
     *
     * @param ChildSpyAclGroup $spyAclGroup
     */
    protected function doAddSpyAclGroup(ChildSpyAclGroup $spyAclGroup)
    {
        $spyAclGroupsHasRoles = new ChildSpyAclGroupsHasRoles();

        $spyAclGroupsHasRoles->setSpyAclGroup($spyAclGroup);

        $spyAclGroupsHasRoles->setSpyAclRole($this);

        $this->addSpyAclGroupsHasRoles($spyAclGroupsHasRoles);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyAclGroup->isSpyAclRolesLoaded()) {
            $spyAclGroup->initSpyAclRoles();
            $spyAclGroup->getSpyAclRoles()->push($this);
        } elseif (!$spyAclGroup->getSpyAclRoles()->contains($this)) {
            $spyAclGroup->getSpyAclRoles()->push($this);
        }

    }

    /**
     * Remove spyAclGroup of this object
     * through the spy_acl_groups_has_roles cross reference table.
     *
     * @param ChildSpyAclGroup $spyAclGroup
     * @return ChildSpyAclRole The current object (for fluent API support)
     */
    public function removeSpyAclGroup(ChildSpyAclGroup $spyAclGroup)
    {
        if ($this->getSpyAclGroups()->contains($spyAclGroup)) {
            $spyAclGroupsHasRoles = new ChildSpyAclGroupsHasRoles();
            $spyAclGroupsHasRoles->setSpyAclGroup($spyAclGroup);
            if ($spyAclGroup->isSpyAclRolesLoaded()) {
                //remove the back reference if available
                $spyAclGroup->getSpyAclRoles()->removeObject($this);
            }

            $spyAclGroupsHasRoles->setSpyAclRole($this);
            $this->removeSpyAclGroupsHasRoles(clone $spyAclGroupsHasRoles);
            $spyAclGroupsHasRoles->clear();

            $this->collSpyAclGroups->remove($this->collSpyAclGroups->search($spyAclGroup));

            if (null === $this->spyAclGroupsScheduledForDeletion) {
                $this->spyAclGroupsScheduledForDeletion = clone $this->collSpyAclGroups;
                $this->spyAclGroupsScheduledForDeletion->clear();
            }

            $this->spyAclGroupsScheduledForDeletion->push($spyAclGroup);
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
        $this->id_acl_role = null;
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
            if ($this->collAclRules) {
                foreach ($this->collAclRules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclGroupsHasRoless) {
                foreach ($this->collSpyAclGroupsHasRoless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclEntityRules) {
                foreach ($this->collSpyAclEntityRules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclGroups) {
                foreach ($this->collSpyAclGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAclRules = null;
        $this->collSpyAclGroupsHasRoless = null;
        $this->collSpyAclEntityRules = null;
        $this->collSpyAclGroups = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyAclRoleTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyAclRoleTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // archivable behavior

    /**
     * Get an archived version of the current object.
     *
     * @param ConnectionInterface|null $con Optional connection object
     *
     * @return ChildSpyAclRoleArchive An archive object, or null if the current object was never archived
     */
    public function getArchive(?ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            return null;
        }
        $archive = ChildSpyAclRoleArchiveQuery::create()
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
     * @return ChildSpyAclRoleArchive The archive object based on this object
     */
    public function archive(?ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be archived. You must save the current object before calling archive().');
        }
        $archive = $this->getArchive($con);
        if (!$archive) {
            $archive = new ChildSpyAclRoleArchive();
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
     * @param ChildSpyAclRoleArchive $archive An archived object based on the same class
      * @param bool $populateAutoIncrementPrimaryKeys
     *               If true, autoincrement columns are copied from the archive object.
     *               If false, autoincrement columns are left intact.
      *
     * @return ChildSpyAclRole The current object (for fluent API support)
     */
    public function populateFromArchive($archive, bool $populateAutoIncrementPrimaryKeys = false)
    {
        if ($populateAutoIncrementPrimaryKeys) {
            $this->setIdAclRole($archive->getIdAclRole());
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
     * @return $this|ChildSpyAclRole The current object (for fluent API support)
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
