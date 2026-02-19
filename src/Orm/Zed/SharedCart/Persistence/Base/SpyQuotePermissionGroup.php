<?php

namespace Orm\Zed\SharedCart\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser as ChildSpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery as ChildSpyQuoteCompanyUserQuery;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup as ChildSpyQuotePermissionGroup;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery as ChildSpyQuotePermissionGroupQuery;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission as ChildSpyQuotePermissionGroupToPermission;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery as ChildSpyQuotePermissionGroupToPermissionQuery;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuoteCompanyUserTableMap;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuotePermissionGroupTableMap;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuotePermissionGroupToPermissionTableMap;
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
 * Base class that represents a row from the 'spy_quote_permission_group' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.SharedCart.Persistence.Base
 */
abstract class SpyQuotePermissionGroup implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\SharedCart\\Persistence\\Map\\SpyQuotePermissionGroupTableMap';


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
     * The value for the id_quote_permission_group field.
     *
     * @var        int
     */
    protected $id_quote_permission_group;

    /**
     * The value for the is_default field.
     * A flag indicating if an entity is the default one.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_default;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * @var        ObjectCollection|ChildSpyQuoteCompanyUser[] Collection to store aggregation of ChildSpyQuoteCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuoteCompanyUser> Collection to store aggregation of ChildSpyQuoteCompanyUser objects.
     */
    protected $collSpyQuoteCompanyUsers;
    protected $collSpyQuoteCompanyUsersPartial;

    /**
     * @var        ObjectCollection|ChildSpyQuotePermissionGroupToPermission[] Collection to store aggregation of ChildSpyQuotePermissionGroupToPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuotePermissionGroupToPermission> Collection to store aggregation of ChildSpyQuotePermissionGroupToPermission objects.
     */
    protected $collSpyQuotePermissionGroupToPermissions;
    protected $collSpyQuotePermissionGroupToPermissionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyQuoteCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuoteCompanyUser>
     */
    protected $spyQuoteCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyQuotePermissionGroupToPermission[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyQuotePermissionGroupToPermission>
     */
    protected $spyQuotePermissionGroupToPermissionsScheduledForDeletion = null;

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
     * Initializes internal state of Orm\Zed\SharedCart\Persistence\Base\SpyQuotePermissionGroup object.
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
     * Compares this with another <code>SpyQuotePermissionGroup</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyQuotePermissionGroup</code>, delegates to
     * <code>equals(SpyQuotePermissionGroup)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_quote_permission_group] column value.
     *
     * @return int
     */
    public function getIdQuotePermissionGroup()
    {
        return $this->id_quote_permission_group;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function isDefault()
    {
        return $this->getIsDefault();
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
     * Set the value of [id_quote_permission_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdQuotePermissionGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_quote_permission_group !== $v) {
            $this->id_quote_permission_group = $v;
            $this->modifiedColumns[SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP] = true;
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
     * @param bool|integer|string $v The new value
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
            $this->modifiedColumns[SpyQuotePermissionGroupTableMap::COL_IS_DEFAULT] = true;
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
            $this->modifiedColumns[SpyQuotePermissionGroupTableMap::COL_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyQuotePermissionGroupTableMap::translateFieldName('IdQuotePermissionGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_quote_permission_group = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyQuotePermissionGroupTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyQuotePermissionGroupTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyQuotePermissionGroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroup'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyQuotePermissionGroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyQuotePermissionGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyQuoteCompanyUsers = null;

            $this->collSpyQuotePermissionGroupToPermissions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyQuotePermissionGroup::setDeleted()
     * @see SpyQuotePermissionGroup::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyQuotePermissionGroupQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupTableMap::DATABASE_NAME);
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
                SpyQuotePermissionGroupTableMap::addInstanceToPool($this);
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

            if ($this->spyQuotePermissionGroupToPermissionsScheduledForDeletion !== null) {
                if (!$this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery::create()
                        ->filterByPrimaryKeys($this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuotePermissionGroupToPermissions !== null) {
                foreach ($this->collSpyQuotePermissionGroupToPermissions as $referrerFK) {
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

        $this->modifiedColumns[SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP)) {
            $modifiedColumns[':p' . $index++]  = 'id_quote_permission_group';
        }
        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = 'is_default';
        }
        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }

        $sql = sprintf(
            'INSERT INTO spy_quote_permission_group (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_quote_permission_group':
                        $stmt->bindValue($identifier, $this->id_quote_permission_group, PDO::PARAM_INT);

                        break;
                    case 'is_default':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_quote_permission_group_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdQuotePermissionGroup($pk);
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
        $pos = SpyQuotePermissionGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdQuotePermissionGroup();

            case 1:
                return $this->getIsDefault();

            case 2:
                return $this->getName();

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
        if (isset($alreadyDumpedObjects['SpyQuotePermissionGroup'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyQuotePermissionGroup'][$this->hashCode()] = true;
        $keys = SpyQuotePermissionGroupTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdQuotePermissionGroup(),
            $keys[1] => $this->getIsDefault(),
            $keys[2] => $this->getName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collSpyQuotePermissionGroupToPermissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuotePermissionGroupToPermissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quote_permission_group_to_permissions';
                        break;
                    default:
                        $key = 'SpyQuotePermissionGroupToPermissions';
                }

                $result[$key] = $this->collSpyQuotePermissionGroupToPermissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyQuotePermissionGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdQuotePermissionGroup($value);
                break;
            case 1:
                $this->setIsDefault($value);
                break;
            case 2:
                $this->setName($value);
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
        $keys = SpyQuotePermissionGroupTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdQuotePermissionGroup($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsDefault($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyQuotePermissionGroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP)) {
            $criteria->add(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $this->id_quote_permission_group);
        }
        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SpyQuotePermissionGroupTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(SpyQuotePermissionGroupTableMap::COL_NAME)) {
            $criteria->add(SpyQuotePermissionGroupTableMap::COL_NAME, $this->name);
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
        $criteria = ChildSpyQuotePermissionGroupQuery::create();
        $criteria->add(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $this->id_quote_permission_group);

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
        $validPk = null !== $this->getIdQuotePermissionGroup();

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
        return $this->getIdQuotePermissionGroup();
    }

    /**
     * Generic method to set the primary key (id_quote_permission_group column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdQuotePermissionGroup($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdQuotePermissionGroup();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setName($this->getName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyQuoteCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuoteCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuotePermissionGroupToPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuotePermissionGroupToPermission($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdQuotePermissionGroup(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup Clone of current object.
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
        if ('SpyQuoteCompanyUser' === $relationName) {
            $this->initSpyQuoteCompanyUsers();
            return;
        }
        if ('SpyQuotePermissionGroupToPermission' === $relationName) {
            $this->initSpyQuotePermissionGroupToPermissions();
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
     * Gets an array of ChildSpyQuoteCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyQuotePermissionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyQuoteCompanyUser[] List of ChildSpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuoteCompanyUser> List of ChildSpyQuoteCompanyUser objects
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
                $collSpyQuoteCompanyUsers = ChildSpyQuoteCompanyUserQuery::create(null, $criteria)
                    ->filterBySpyQuotePermissionGroup($this)
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
     * Sets a collection of ChildSpyQuoteCompanyUser objects related by a one-to-many relationship
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
        /** @var ChildSpyQuoteCompanyUser[] $spyQuoteCompanyUsersToDelete */
        $spyQuoteCompanyUsersToDelete = $this->getSpyQuoteCompanyUsers(new Criteria(), $con)->diff($spyQuoteCompanyUsers);


        $this->spyQuoteCompanyUsersScheduledForDeletion = $spyQuoteCompanyUsersToDelete;

        foreach ($spyQuoteCompanyUsersToDelete as $spyQuoteCompanyUserRemoved) {
            $spyQuoteCompanyUserRemoved->setSpyQuotePermissionGroup(null);
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
     * Returns the number of related SpyQuoteCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyQuoteCompanyUser objects.
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

            $query = ChildSpyQuoteCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyQuotePermissionGroup($this)
                ->count($con);
        }

        return count($this->collSpyQuoteCompanyUsers);
    }

    /**
     * Method called to associate a ChildSpyQuoteCompanyUser object to this object
     * through the ChildSpyQuoteCompanyUser foreign key attribute.
     *
     * @param ChildSpyQuoteCompanyUser $l ChildSpyQuoteCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuoteCompanyUser(ChildSpyQuoteCompanyUser $l)
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
     * @param ChildSpyQuoteCompanyUser $spyQuoteCompanyUser The ChildSpyQuoteCompanyUser object to add.
     */
    protected function doAddSpyQuoteCompanyUser(ChildSpyQuoteCompanyUser $spyQuoteCompanyUser): void
    {
        $this->collSpyQuoteCompanyUsers[]= $spyQuoteCompanyUser;
        $spyQuoteCompanyUser->setSpyQuotePermissionGroup($this);
    }

    /**
     * @param ChildSpyQuoteCompanyUser $spyQuoteCompanyUser The ChildSpyQuoteCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuoteCompanyUser(ChildSpyQuoteCompanyUser $spyQuoteCompanyUser)
    {
        if ($this->getSpyQuoteCompanyUsers()->contains($spyQuoteCompanyUser)) {
            $pos = $this->collSpyQuoteCompanyUsers->search($spyQuoteCompanyUser);
            $this->collSpyQuoteCompanyUsers->remove($pos);
            if (null === $this->spyQuoteCompanyUsersScheduledForDeletion) {
                $this->spyQuoteCompanyUsersScheduledForDeletion = clone $this->collSpyQuoteCompanyUsers;
                $this->spyQuoteCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyQuoteCompanyUsersScheduledForDeletion[]= clone $spyQuoteCompanyUser;
            $spyQuoteCompanyUser->setSpyQuotePermissionGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuotePermissionGroup is new, it will return
     * an empty collection; or if this SpyQuotePermissionGroup has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuotePermissionGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyQuoteCompanyUser[] List of ChildSpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuoteCompanyUser}> List of ChildSpyQuoteCompanyUser objects
     */
    public function getSpyQuoteCompanyUsersJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyQuoteCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyQuoteCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuotePermissionGroup is new, it will return
     * an empty collection; or if this SpyQuotePermissionGroup has previously
     * been saved, it will retrieve related SpyQuoteCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuotePermissionGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyQuoteCompanyUser[] List of ChildSpyQuoteCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuoteCompanyUser}> List of ChildSpyQuoteCompanyUser objects
     */
    public function getSpyQuoteCompanyUsersJoinSpyQuote(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyQuoteCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyQuote', $joinBehavior);

        return $this->getSpyQuoteCompanyUsers($query, $con);
    }

    /**
     * Clears out the collSpyQuotePermissionGroupToPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuotePermissionGroupToPermissions()
     */
    public function clearSpyQuotePermissionGroupToPermissions()
    {
        $this->collSpyQuotePermissionGroupToPermissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuotePermissionGroupToPermissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuotePermissionGroupToPermissions($v = true): void
    {
        $this->collSpyQuotePermissionGroupToPermissionsPartial = $v;
    }

    /**
     * Initializes the collSpyQuotePermissionGroupToPermissions collection.
     *
     * By default this just sets the collSpyQuotePermissionGroupToPermissions collection to an empty array (like clearcollSpyQuotePermissionGroupToPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuotePermissionGroupToPermissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuotePermissionGroupToPermissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuotePermissionGroupToPermissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuotePermissionGroupToPermissions = new $collectionClassName;
        $this->collSpyQuotePermissionGroupToPermissions->setModel('\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission');
    }

    /**
     * Gets an array of ChildSpyQuotePermissionGroupToPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyQuotePermissionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyQuotePermissionGroupToPermission[] List of ChildSpyQuotePermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuotePermissionGroupToPermission> List of ChildSpyQuotePermissionGroupToPermission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuotePermissionGroupToPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuotePermissionGroupToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyQuotePermissionGroupToPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuotePermissionGroupToPermissions) {
                    $this->initSpyQuotePermissionGroupToPermissions();
                } else {
                    $collectionClassName = SpyQuotePermissionGroupToPermissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuotePermissionGroupToPermissions = new $collectionClassName;
                    $collSpyQuotePermissionGroupToPermissions->setModel('\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission');

                    return $collSpyQuotePermissionGroupToPermissions;
                }
            } else {
                $collSpyQuotePermissionGroupToPermissions = ChildSpyQuotePermissionGroupToPermissionQuery::create(null, $criteria)
                    ->filterByQuotePermissionGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuotePermissionGroupToPermissionsPartial && count($collSpyQuotePermissionGroupToPermissions)) {
                        $this->initSpyQuotePermissionGroupToPermissions(false);

                        foreach ($collSpyQuotePermissionGroupToPermissions as $obj) {
                            if (false == $this->collSpyQuotePermissionGroupToPermissions->contains($obj)) {
                                $this->collSpyQuotePermissionGroupToPermissions->append($obj);
                            }
                        }

                        $this->collSpyQuotePermissionGroupToPermissionsPartial = true;
                    }

                    return $collSpyQuotePermissionGroupToPermissions;
                }

                if ($partial && $this->collSpyQuotePermissionGroupToPermissions) {
                    foreach ($this->collSpyQuotePermissionGroupToPermissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuotePermissionGroupToPermissions[] = $obj;
                        }
                    }
                }

                $this->collSpyQuotePermissionGroupToPermissions = $collSpyQuotePermissionGroupToPermissions;
                $this->collSpyQuotePermissionGroupToPermissionsPartial = false;
            }
        }

        return $this->collSpyQuotePermissionGroupToPermissions;
    }

    /**
     * Sets a collection of ChildSpyQuotePermissionGroupToPermission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuotePermissionGroupToPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuotePermissionGroupToPermissions(Collection $spyQuotePermissionGroupToPermissions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyQuotePermissionGroupToPermission[] $spyQuotePermissionGroupToPermissionsToDelete */
        $spyQuotePermissionGroupToPermissionsToDelete = $this->getSpyQuotePermissionGroupToPermissions(new Criteria(), $con)->diff($spyQuotePermissionGroupToPermissions);


        $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion = $spyQuotePermissionGroupToPermissionsToDelete;

        foreach ($spyQuotePermissionGroupToPermissionsToDelete as $spyQuotePermissionGroupToPermissionRemoved) {
            $spyQuotePermissionGroupToPermissionRemoved->setQuotePermissionGroup(null);
        }

        $this->collSpyQuotePermissionGroupToPermissions = null;
        foreach ($spyQuotePermissionGroupToPermissions as $spyQuotePermissionGroupToPermission) {
            $this->addSpyQuotePermissionGroupToPermission($spyQuotePermissionGroupToPermission);
        }

        $this->collSpyQuotePermissionGroupToPermissions = $spyQuotePermissionGroupToPermissions;
        $this->collSpyQuotePermissionGroupToPermissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyQuotePermissionGroupToPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyQuotePermissionGroupToPermission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuotePermissionGroupToPermissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuotePermissionGroupToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyQuotePermissionGroupToPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuotePermissionGroupToPermissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuotePermissionGroupToPermissions());
            }

            $query = ChildSpyQuotePermissionGroupToPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByQuotePermissionGroup($this)
                ->count($con);
        }

        return count($this->collSpyQuotePermissionGroupToPermissions);
    }

    /**
     * Method called to associate a ChildSpyQuotePermissionGroupToPermission object to this object
     * through the ChildSpyQuotePermissionGroupToPermission foreign key attribute.
     *
     * @param ChildSpyQuotePermissionGroupToPermission $l ChildSpyQuotePermissionGroupToPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuotePermissionGroupToPermission(ChildSpyQuotePermissionGroupToPermission $l)
    {
        if ($this->collSpyQuotePermissionGroupToPermissions === null) {
            $this->initSpyQuotePermissionGroupToPermissions();
            $this->collSpyQuotePermissionGroupToPermissionsPartial = true;
        }

        if (!$this->collSpyQuotePermissionGroupToPermissions->contains($l)) {
            $this->doAddSpyQuotePermissionGroupToPermission($l);

            if ($this->spyQuotePermissionGroupToPermissionsScheduledForDeletion and $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->contains($l)) {
                $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->remove($this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission The ChildSpyQuotePermissionGroupToPermission object to add.
     */
    protected function doAddSpyQuotePermissionGroupToPermission(ChildSpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission): void
    {
        $this->collSpyQuotePermissionGroupToPermissions[]= $spyQuotePermissionGroupToPermission;
        $spyQuotePermissionGroupToPermission->setQuotePermissionGroup($this);
    }

    /**
     * @param ChildSpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission The ChildSpyQuotePermissionGroupToPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuotePermissionGroupToPermission(ChildSpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission)
    {
        if ($this->getSpyQuotePermissionGroupToPermissions()->contains($spyQuotePermissionGroupToPermission)) {
            $pos = $this->collSpyQuotePermissionGroupToPermissions->search($spyQuotePermissionGroupToPermission);
            $this->collSpyQuotePermissionGroupToPermissions->remove($pos);
            if (null === $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion) {
                $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion = clone $this->collSpyQuotePermissionGroupToPermissions;
                $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->clear();
            }
            $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion[]= clone $spyQuotePermissionGroupToPermission;
            $spyQuotePermissionGroupToPermission->setQuotePermissionGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyQuotePermissionGroup is new, it will return
     * an empty collection; or if this SpyQuotePermissionGroup has previously
     * been saved, it will retrieve related SpyQuotePermissionGroupToPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyQuotePermissionGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyQuotePermissionGroupToPermission[] List of ChildSpyQuotePermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyQuotePermissionGroupToPermission}> List of ChildSpyQuotePermissionGroupToPermission objects
     */
    public function getSpyQuotePermissionGroupToPermissionsJoinPermission(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyQuotePermissionGroupToPermissionQuery::create(null, $criteria);
        $query->joinWith('Permission', $joinBehavior);

        return $this->getSpyQuotePermissionGroupToPermissions($query, $con);
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
        $this->id_quote_permission_group = null;
        $this->is_default = null;
        $this->name = null;
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
            if ($this->collSpyQuotePermissionGroupToPermissions) {
                foreach ($this->collSpyQuotePermissionGroupToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyQuoteCompanyUsers = null;
        $this->collSpyQuotePermissionGroupToPermissions = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyQuotePermissionGroupTableMap::DEFAULT_STRING_FORMAT);
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
