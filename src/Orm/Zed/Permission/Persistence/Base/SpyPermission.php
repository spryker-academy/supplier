<?php

namespace Orm\Zed\Permission\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRoleToPermission as BaseSpyCompanyRoleToPermission;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToPermissionTableMap;
use Orm\Zed\Permission\Persistence\SpyPermission as ChildSpyPermission;
use Orm\Zed\Permission\Persistence\SpyPermissionQuery as ChildSpyPermissionQuery;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery;
use Orm\Zed\SharedCart\Persistence\Base\SpyQuotePermissionGroupToPermission as BaseSpyQuotePermissionGroupToPermission;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuotePermissionGroupToPermissionTableMap;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupToPermission;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupToPermissionQuery;
use Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListPermissionGroupToPermission as BaseSpyShoppingListPermissionGroupToPermission;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListPermissionGroupToPermissionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Collection\ObjectCombinationCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_permission' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Permission.Persistence.Base
 */
abstract class SpyPermission implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Permission\\Persistence\\Map\\SpyPermissionTableMap';


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
     * The value for the id_permission field.
     *
     * @var        int
     */
    protected $id_permission;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string
     */
    protected $key;

    /**
     * The value for the configuration_signature field.
     * A signature to verify the integrity of a configuration.
     * @var        string|null
     */
    protected $configuration_signature;

    /**
     * @var        ObjectCollection|SpyCompanyRoleToPermission[] Collection to store aggregation of SpyCompanyRoleToPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRoleToPermission> Collection to store aggregation of SpyCompanyRoleToPermission objects.
     */
    protected $collSpyCompanyRoleToPermissions;
    protected $collSpyCompanyRoleToPermissionsPartial;

    /**
     * @var        ObjectCollection|SpyQuotePermissionGroupToPermission[] Collection to store aggregation of SpyQuotePermissionGroupToPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuotePermissionGroupToPermission> Collection to store aggregation of SpyQuotePermissionGroupToPermission objects.
     */
    protected $collSpyQuotePermissionGroupToPermissions;
    protected $collSpyQuotePermissionGroupToPermissionsPartial;

    /**
     * @var        ObjectCollection|SpyShoppingListPermissionGroupToPermission[] Collection to store aggregation of SpyShoppingListPermissionGroupToPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListPermissionGroupToPermission> Collection to store aggregation of SpyShoppingListPermissionGroupToPermission objects.
     */
    protected $collSpyShoppingListPermissionGroupToPermissions;
    protected $collSpyShoppingListPermissionGroupToPermissionsPartial;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildSpyCompanyRole combinations.
     */
    protected $combinationCollCompanyRoleIdCompanyRoleToPermissions;

    /**
     * @var bool
     */
    protected $combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial;

    /**
     * @var        ObjectCollection|SpyCompanyRole[] Cross Collection to store aggregation of SpyCompanyRole objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRole> Cross Collection to store aggregation of SpyCompanyRole objects.
     */
    protected $collCompanyRoles;

    /**
     * @var bool
     */
    protected $collCompanyRolesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildSpyCompanyRole combinations.
     */
    protected $combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyRoleToPermission[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRoleToPermission>
     */
    protected $spyCompanyRoleToPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuotePermissionGroupToPermission[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuotePermissionGroupToPermission>
     */
    protected $spyQuotePermissionGroupToPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListPermissionGroupToPermission[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListPermissionGroupToPermission>
     */
    protected $spyShoppingListPermissionGroupToPermissionsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Permission\Persistence\Base\SpyPermission object.
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
     * Compares this with another <code>SpyPermission</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyPermission</code>, delegates to
     * <code>equals(SpyPermission)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_permission] column value.
     *
     * @return int
     */
    public function getIdPermission()
    {
        return $this->id_permission;
    }

    /**
     * Get the [key] column value.
     * A unique key used to identify an entity or a piece of data.
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the [configuration_signature] column value.
     * A signature to verify the integrity of a configuration.
     * @return string|null
     */
    public function getConfigurationSignature()
    {
        return $this->configuration_signature;
    }

    /**
     * Set the value of [id_permission] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdPermission($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_permission !== $v) {
            $this->id_permission = $v;
            $this->modifiedColumns[SpyPermissionTableMap::COL_ID_PERMISSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * A unique key used to identify an entity or a piece of data.
     * @param string $v New value
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
            $this->modifiedColumns[SpyPermissionTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [configuration_signature] column.
     * A signature to verify the integrity of a configuration.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setConfigurationSignature($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->configuration_signature !== $v) {
            $this->configuration_signature = $v;
            $this->modifiedColumns[SpyPermissionTableMap::COL_CONFIGURATION_SIGNATURE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyPermissionTableMap::translateFieldName('IdPermission', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_permission = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyPermissionTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyPermissionTableMap::translateFieldName('ConfigurationSignature', TableMap::TYPE_PHPNAME, $indexType)];
            $this->configuration_signature = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyPermissionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Permission\\Persistence\\SpyPermission'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyPermissionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyPermissionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyCompanyRoleToPermissions = null;

            $this->collSpyQuotePermissionGroupToPermissions = null;

            $this->collSpyShoppingListPermissionGroupToPermissions = null;

            $this->collCompanyRoleIdCompanyRoleToPermissions = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyPermission::setDeleted()
     * @see SpyPermission::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPermissionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyPermissionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPermissionTableMap::DATABASE_NAME);
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
                SpyPermissionTableMap::addInstanceToPool($this);
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

            if ($this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion !== null) {
                if (!$this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion as $combination) {
                        $entryPk = [];

                        $entryPk[2] = $this->getIdPermission();
                        $entryPk[1] = $combination[0]->getIdCompanyRole();
                        //$combination[1] = IdCompanyRoleToPermission;
                        $entryPk[0] = $combination[1];

                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion = null;
                }

            }

            if (null !== $this->combinationCollCompanyRoleIdCompanyRoleToPermissions) {
                foreach ($this->combinationCollCompanyRoleIdCompanyRoleToPermissions as $combination) {

                    //$combination[0] = SpyCompanyRole (spy_company_role_to_permission-fk_company_role)
                    if (!$combination[0]->isDeleted() && ($combination[0]->isNew() || $combination[0]->isModified())) {
                        $combination[0]->save($con);
                    }

                    //$combination[1] = IdCompanyRoleToPermission; Nothing to save.
                }
            }


            if ($this->spyCompanyRoleToPermissionsScheduledForDeletion !== null) {
                if (!$this->spyCompanyRoleToPermissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyRoleToPermissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyRoleToPermissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyRoleToPermissions !== null) {
                foreach ($this->collSpyCompanyRoleToPermissions as $referrerFK) {
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

            if ($this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupToPermissionQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListPermissionGroupToPermissions !== null) {
                foreach ($this->collSpyShoppingListPermissionGroupToPermissions as $referrerFK) {
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

        $this->modifiedColumns[SpyPermissionTableMap::COL_ID_PERMISSION] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyPermissionTableMap::COL_ID_PERMISSION)) {
            $modifiedColumns[':p' . $index++]  = '`id_permission`';
        }
        if ($this->isColumnModified(SpyPermissionTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyPermissionTableMap::COL_CONFIGURATION_SIGNATURE)) {
            $modifiedColumns[':p' . $index++]  = '`configuration_signature`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_permission` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_permission`':
                        $stmt->bindValue($identifier, $this->id_permission, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`configuration_signature`':
                        $stmt->bindValue($identifier, $this->configuration_signature, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_permission_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdPermission($pk);
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
        $pos = SpyPermissionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdPermission();

            case 1:
                return $this->getKey();

            case 2:
                return $this->getConfigurationSignature();

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
        if (isset($alreadyDumpedObjects['SpyPermission'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyPermission'][$this->hashCode()] = true;
        $keys = SpyPermissionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdPermission(),
            $keys[1] => $this->getKey(),
            $keys[2] => $this->getConfigurationSignature(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyCompanyRoleToPermissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyRoleToPermissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_role_to_permissions';
                        break;
                    default:
                        $key = 'SpyCompanyRoleToPermissions';
                }

                $result[$key] = $this->collSpyCompanyRoleToPermissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyShoppingListPermissionGroupToPermissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListPermissionGroupToPermissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_permission_group_to_permissions';
                        break;
                    default:
                        $key = 'SpyShoppingListPermissionGroupToPermissions';
                }

                $result[$key] = $this->collSpyShoppingListPermissionGroupToPermissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyPermissionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdPermission($value);
                break;
            case 1:
                $this->setKey($value);
                break;
            case 2:
                $this->setConfigurationSignature($value);
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
        $keys = SpyPermissionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdPermission($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setKey($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setConfigurationSignature($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyPermissionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyPermissionTableMap::COL_ID_PERMISSION)) {
            $criteria->add(SpyPermissionTableMap::COL_ID_PERMISSION, $this->id_permission);
        }
        if ($this->isColumnModified(SpyPermissionTableMap::COL_KEY)) {
            $criteria->add(SpyPermissionTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyPermissionTableMap::COL_CONFIGURATION_SIGNATURE)) {
            $criteria->add(SpyPermissionTableMap::COL_CONFIGURATION_SIGNATURE, $this->configuration_signature);
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
        $criteria = ChildSpyPermissionQuery::create();
        $criteria->add(SpyPermissionTableMap::COL_ID_PERMISSION, $this->id_permission);

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
        $validPk = null !== $this->getIdPermission();

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
        return $this->getIdPermission();
    }

    /**
     * Generic method to set the primary key (id_permission column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdPermission($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdPermission();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Permission\Persistence\SpyPermission (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setKey($this->getKey());
        $copyObj->setConfigurationSignature($this->getConfigurationSignature());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyRoleToPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyRoleToPermission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuotePermissionGroupToPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuotePermissionGroupToPermission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListPermissionGroupToPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListPermissionGroupToPermission($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdPermission(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Permission\Persistence\SpyPermission Clone of current object.
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
        if ('SpyCompanyRoleToPermission' === $relationName) {
            $this->initSpyCompanyRoleToPermissions();
            return;
        }
        if ('SpyQuotePermissionGroupToPermission' === $relationName) {
            $this->initSpyQuotePermissionGroupToPermissions();
            return;
        }
        if ('SpyShoppingListPermissionGroupToPermission' === $relationName) {
            $this->initSpyShoppingListPermissionGroupToPermissions();
            return;
        }
    }

    /**
     * Clears out the collSpyCompanyRoleToPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyRoleToPermissions()
     */
    public function clearSpyCompanyRoleToPermissions()
    {
        $this->collSpyCompanyRoleToPermissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyRoleToPermissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyRoleToPermissions($v = true): void
    {
        $this->collSpyCompanyRoleToPermissionsPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyRoleToPermissions collection.
     *
     * By default this just sets the collSpyCompanyRoleToPermissions collection to an empty array (like clearcollSpyCompanyRoleToPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyRoleToPermissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyRoleToPermissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyRoleToPermissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyRoleToPermissions = new $collectionClassName;
        $this->collSpyCompanyRoleToPermissions->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission');
    }

    /**
     * Gets an array of SpyCompanyRoleToPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyPermission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyRoleToPermission[] List of SpyCompanyRoleToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRoleToPermission> List of SpyCompanyRoleToPermission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyRoleToPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyRoleToPermissions) {
                    $this->initSpyCompanyRoleToPermissions();
                } else {
                    $collectionClassName = SpyCompanyRoleToPermissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyRoleToPermissions = new $collectionClassName;
                    $collSpyCompanyRoleToPermissions->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission');

                    return $collSpyCompanyRoleToPermissions;
                }
            } else {
                $collSpyCompanyRoleToPermissions = SpyCompanyRoleToPermissionQuery::create(null, $criteria)
                    ->filterByPermission($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyRoleToPermissionsPartial && count($collSpyCompanyRoleToPermissions)) {
                        $this->initSpyCompanyRoleToPermissions(false);

                        foreach ($collSpyCompanyRoleToPermissions as $obj) {
                            if (false == $this->collSpyCompanyRoleToPermissions->contains($obj)) {
                                $this->collSpyCompanyRoleToPermissions->append($obj);
                            }
                        }

                        $this->collSpyCompanyRoleToPermissionsPartial = true;
                    }

                    return $collSpyCompanyRoleToPermissions;
                }

                if ($partial && $this->collSpyCompanyRoleToPermissions) {
                    foreach ($this->collSpyCompanyRoleToPermissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyRoleToPermissions[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyRoleToPermissions = $collSpyCompanyRoleToPermissions;
                $this->collSpyCompanyRoleToPermissionsPartial = false;
            }
        }

        return $this->collSpyCompanyRoleToPermissions;
    }

    /**
     * Sets a collection of SpyCompanyRoleToPermission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyRoleToPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyRoleToPermissions(Collection $spyCompanyRoleToPermissions, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyRoleToPermission[] $spyCompanyRoleToPermissionsToDelete */
        $spyCompanyRoleToPermissionsToDelete = $this->getSpyCompanyRoleToPermissions(new Criteria(), $con)->diff($spyCompanyRoleToPermissions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyCompanyRoleToPermissionsScheduledForDeletion = clone $spyCompanyRoleToPermissionsToDelete;

        foreach ($spyCompanyRoleToPermissionsToDelete as $spyCompanyRoleToPermissionRemoved) {
            $spyCompanyRoleToPermissionRemoved->setPermission(null);
        }

        $this->collSpyCompanyRoleToPermissions = null;
        foreach ($spyCompanyRoleToPermissions as $spyCompanyRoleToPermission) {
            $this->addSpyCompanyRoleToPermission($spyCompanyRoleToPermission);
        }

        $this->collSpyCompanyRoleToPermissions = $spyCompanyRoleToPermissions;
        $this->collSpyCompanyRoleToPermissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyRoleToPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyRoleToPermission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyRoleToPermissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyRoleToPermissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyRoleToPermissions());
            }

            $query = SpyCompanyRoleToPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPermission($this)
                ->count($con);
        }

        return count($this->collSpyCompanyRoleToPermissions);
    }

    /**
     * Method called to associate a SpyCompanyRoleToPermission object to this object
     * through the SpyCompanyRoleToPermission foreign key attribute.
     *
     * @param SpyCompanyRoleToPermission $l SpyCompanyRoleToPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyRoleToPermission(SpyCompanyRoleToPermission $l)
    {
        if ($this->collSpyCompanyRoleToPermissions === null) {
            $this->initSpyCompanyRoleToPermissions();
            $this->collSpyCompanyRoleToPermissionsPartial = true;
        }

        if (!$this->collSpyCompanyRoleToPermissions->contains($l)) {
            $this->doAddSpyCompanyRoleToPermission($l);

            if ($this->spyCompanyRoleToPermissionsScheduledForDeletion and $this->spyCompanyRoleToPermissionsScheduledForDeletion->contains($l)) {
                $this->spyCompanyRoleToPermissionsScheduledForDeletion->remove($this->spyCompanyRoleToPermissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyRoleToPermission $spyCompanyRoleToPermission The SpyCompanyRoleToPermission object to add.
     */
    protected function doAddSpyCompanyRoleToPermission(SpyCompanyRoleToPermission $spyCompanyRoleToPermission): void
    {
        $this->collSpyCompanyRoleToPermissions[]= $spyCompanyRoleToPermission;
        $spyCompanyRoleToPermission->setPermission($this);
    }

    /**
     * @param SpyCompanyRoleToPermission $spyCompanyRoleToPermission The SpyCompanyRoleToPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyRoleToPermission(SpyCompanyRoleToPermission $spyCompanyRoleToPermission)
    {
        if ($this->getSpyCompanyRoleToPermissions()->contains($spyCompanyRoleToPermission)) {
            $pos = $this->collSpyCompanyRoleToPermissions->search($spyCompanyRoleToPermission);
            $this->collSpyCompanyRoleToPermissions->remove($pos);
            if (null === $this->spyCompanyRoleToPermissionsScheduledForDeletion) {
                $this->spyCompanyRoleToPermissionsScheduledForDeletion = clone $this->collSpyCompanyRoleToPermissions;
                $this->spyCompanyRoleToPermissionsScheduledForDeletion->clear();
            }
            $this->spyCompanyRoleToPermissionsScheduledForDeletion[]= clone $spyCompanyRoleToPermission;
            $spyCompanyRoleToPermission->setPermission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyPermission is new, it will return
     * an empty collection; or if this SpyPermission has previously
     * been saved, it will retrieve related SpyCompanyRoleToPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyPermission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyRoleToPermission[] List of SpyCompanyRoleToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRoleToPermission}> List of SpyCompanyRoleToPermission objects
     */
    public function getSpyCompanyRoleToPermissionsJoinCompanyRole(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyRoleToPermissionQuery::create(null, $criteria);
        $query->joinWith('CompanyRole', $joinBehavior);

        return $this->getSpyCompanyRoleToPermissions($query, $con);
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
     * Gets an array of SpyQuotePermissionGroupToPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyPermission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyQuotePermissionGroupToPermission[] List of SpyQuotePermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuotePermissionGroupToPermission> List of SpyQuotePermissionGroupToPermission objects
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
                $collSpyQuotePermissionGroupToPermissions = SpyQuotePermissionGroupToPermissionQuery::create(null, $criteria)
                    ->filterByPermission($this)
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
     * Sets a collection of SpyQuotePermissionGroupToPermission objects related by a one-to-many relationship
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
        /** @var SpyQuotePermissionGroupToPermission[] $spyQuotePermissionGroupToPermissionsToDelete */
        $spyQuotePermissionGroupToPermissionsToDelete = $this->getSpyQuotePermissionGroupToPermissions(new Criteria(), $con)->diff($spyQuotePermissionGroupToPermissions);


        $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion = $spyQuotePermissionGroupToPermissionsToDelete;

        foreach ($spyQuotePermissionGroupToPermissionsToDelete as $spyQuotePermissionGroupToPermissionRemoved) {
            $spyQuotePermissionGroupToPermissionRemoved->setPermission(null);
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
     * Returns the number of related BaseSpyQuotePermissionGroupToPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyQuotePermissionGroupToPermission objects.
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

            $query = SpyQuotePermissionGroupToPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPermission($this)
                ->count($con);
        }

        return count($this->collSpyQuotePermissionGroupToPermissions);
    }

    /**
     * Method called to associate a SpyQuotePermissionGroupToPermission object to this object
     * through the SpyQuotePermissionGroupToPermission foreign key attribute.
     *
     * @param SpyQuotePermissionGroupToPermission $l SpyQuotePermissionGroupToPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuotePermissionGroupToPermission(SpyQuotePermissionGroupToPermission $l)
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
     * @param SpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission The SpyQuotePermissionGroupToPermission object to add.
     */
    protected function doAddSpyQuotePermissionGroupToPermission(SpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission): void
    {
        $this->collSpyQuotePermissionGroupToPermissions[]= $spyQuotePermissionGroupToPermission;
        $spyQuotePermissionGroupToPermission->setPermission($this);
    }

    /**
     * @param SpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission The SpyQuotePermissionGroupToPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuotePermissionGroupToPermission(SpyQuotePermissionGroupToPermission $spyQuotePermissionGroupToPermission)
    {
        if ($this->getSpyQuotePermissionGroupToPermissions()->contains($spyQuotePermissionGroupToPermission)) {
            $pos = $this->collSpyQuotePermissionGroupToPermissions->search($spyQuotePermissionGroupToPermission);
            $this->collSpyQuotePermissionGroupToPermissions->remove($pos);
            if (null === $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion) {
                $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion = clone $this->collSpyQuotePermissionGroupToPermissions;
                $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion->clear();
            }
            $this->spyQuotePermissionGroupToPermissionsScheduledForDeletion[]= clone $spyQuotePermissionGroupToPermission;
            $spyQuotePermissionGroupToPermission->setPermission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyPermission is new, it will return
     * an empty collection; or if this SpyPermission has previously
     * been saved, it will retrieve related SpyQuotePermissionGroupToPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyPermission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyQuotePermissionGroupToPermission[] List of SpyQuotePermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuotePermissionGroupToPermission}> List of SpyQuotePermissionGroupToPermission objects
     */
    public function getSpyQuotePermissionGroupToPermissionsJoinQuotePermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyQuotePermissionGroupToPermissionQuery::create(null, $criteria);
        $query->joinWith('QuotePermissionGroup', $joinBehavior);

        return $this->getSpyQuotePermissionGroupToPermissions($query, $con);
    }

    /**
     * Clears out the collSpyShoppingListPermissionGroupToPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListPermissionGroupToPermissions()
     */
    public function clearSpyShoppingListPermissionGroupToPermissions()
    {
        $this->collSpyShoppingListPermissionGroupToPermissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListPermissionGroupToPermissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListPermissionGroupToPermissions($v = true): void
    {
        $this->collSpyShoppingListPermissionGroupToPermissionsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListPermissionGroupToPermissions collection.
     *
     * By default this just sets the collSpyShoppingListPermissionGroupToPermissions collection to an empty array (like clearcollSpyShoppingListPermissionGroupToPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListPermissionGroupToPermissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListPermissionGroupToPermissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListPermissionGroupToPermissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListPermissionGroupToPermissions = new $collectionClassName;
        $this->collSpyShoppingListPermissionGroupToPermissions->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupToPermission');
    }

    /**
     * Gets an array of SpyShoppingListPermissionGroupToPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyPermission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListPermissionGroupToPermission[] List of SpyShoppingListPermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListPermissionGroupToPermission> List of SpyShoppingListPermissionGroupToPermission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListPermissionGroupToPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListPermissionGroupToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListPermissionGroupToPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListPermissionGroupToPermissions) {
                    $this->initSpyShoppingListPermissionGroupToPermissions();
                } else {
                    $collectionClassName = SpyShoppingListPermissionGroupToPermissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListPermissionGroupToPermissions = new $collectionClassName;
                    $collSpyShoppingListPermissionGroupToPermissions->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupToPermission');

                    return $collSpyShoppingListPermissionGroupToPermissions;
                }
            } else {
                $collSpyShoppingListPermissionGroupToPermissions = SpyShoppingListPermissionGroupToPermissionQuery::create(null, $criteria)
                    ->filterBySpyPermission($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListPermissionGroupToPermissionsPartial && count($collSpyShoppingListPermissionGroupToPermissions)) {
                        $this->initSpyShoppingListPermissionGroupToPermissions(false);

                        foreach ($collSpyShoppingListPermissionGroupToPermissions as $obj) {
                            if (false == $this->collSpyShoppingListPermissionGroupToPermissions->contains($obj)) {
                                $this->collSpyShoppingListPermissionGroupToPermissions->append($obj);
                            }
                        }

                        $this->collSpyShoppingListPermissionGroupToPermissionsPartial = true;
                    }

                    return $collSpyShoppingListPermissionGroupToPermissions;
                }

                if ($partial && $this->collSpyShoppingListPermissionGroupToPermissions) {
                    foreach ($this->collSpyShoppingListPermissionGroupToPermissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListPermissionGroupToPermissions[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListPermissionGroupToPermissions = $collSpyShoppingListPermissionGroupToPermissions;
                $this->collSpyShoppingListPermissionGroupToPermissionsPartial = false;
            }
        }

        return $this->collSpyShoppingListPermissionGroupToPermissions;
    }

    /**
     * Sets a collection of SpyShoppingListPermissionGroupToPermission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListPermissionGroupToPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListPermissionGroupToPermissions(Collection $spyShoppingListPermissionGroupToPermissions, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListPermissionGroupToPermission[] $spyShoppingListPermissionGroupToPermissionsToDelete */
        $spyShoppingListPermissionGroupToPermissionsToDelete = $this->getSpyShoppingListPermissionGroupToPermissions(new Criteria(), $con)->diff($spyShoppingListPermissionGroupToPermissions);


        $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion = $spyShoppingListPermissionGroupToPermissionsToDelete;

        foreach ($spyShoppingListPermissionGroupToPermissionsToDelete as $spyShoppingListPermissionGroupToPermissionRemoved) {
            $spyShoppingListPermissionGroupToPermissionRemoved->setSpyPermission(null);
        }

        $this->collSpyShoppingListPermissionGroupToPermissions = null;
        foreach ($spyShoppingListPermissionGroupToPermissions as $spyShoppingListPermissionGroupToPermission) {
            $this->addSpyShoppingListPermissionGroupToPermission($spyShoppingListPermissionGroupToPermission);
        }

        $this->collSpyShoppingListPermissionGroupToPermissions = $spyShoppingListPermissionGroupToPermissions;
        $this->collSpyShoppingListPermissionGroupToPermissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListPermissionGroupToPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListPermissionGroupToPermission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListPermissionGroupToPermissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListPermissionGroupToPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListPermissionGroupToPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListPermissionGroupToPermissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListPermissionGroupToPermissions());
            }

            $query = SpyShoppingListPermissionGroupToPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyPermission($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListPermissionGroupToPermissions);
    }

    /**
     * Method called to associate a SpyShoppingListPermissionGroupToPermission object to this object
     * through the SpyShoppingListPermissionGroupToPermission foreign key attribute.
     *
     * @param SpyShoppingListPermissionGroupToPermission $l SpyShoppingListPermissionGroupToPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListPermissionGroupToPermission(SpyShoppingListPermissionGroupToPermission $l)
    {
        if ($this->collSpyShoppingListPermissionGroupToPermissions === null) {
            $this->initSpyShoppingListPermissionGroupToPermissions();
            $this->collSpyShoppingListPermissionGroupToPermissionsPartial = true;
        }

        if (!$this->collSpyShoppingListPermissionGroupToPermissions->contains($l)) {
            $this->doAddSpyShoppingListPermissionGroupToPermission($l);

            if ($this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion and $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->remove($this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListPermissionGroupToPermission $spyShoppingListPermissionGroupToPermission The SpyShoppingListPermissionGroupToPermission object to add.
     */
    protected function doAddSpyShoppingListPermissionGroupToPermission(SpyShoppingListPermissionGroupToPermission $spyShoppingListPermissionGroupToPermission): void
    {
        $this->collSpyShoppingListPermissionGroupToPermissions[]= $spyShoppingListPermissionGroupToPermission;
        $spyShoppingListPermissionGroupToPermission->setSpyPermission($this);
    }

    /**
     * @param SpyShoppingListPermissionGroupToPermission $spyShoppingListPermissionGroupToPermission The SpyShoppingListPermissionGroupToPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListPermissionGroupToPermission(SpyShoppingListPermissionGroupToPermission $spyShoppingListPermissionGroupToPermission)
    {
        if ($this->getSpyShoppingListPermissionGroupToPermissions()->contains($spyShoppingListPermissionGroupToPermission)) {
            $pos = $this->collSpyShoppingListPermissionGroupToPermissions->search($spyShoppingListPermissionGroupToPermission);
            $this->collSpyShoppingListPermissionGroupToPermissions->remove($pos);
            if (null === $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion) {
                $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion = clone $this->collSpyShoppingListPermissionGroupToPermissions;
                $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion->clear();
            }
            $this->spyShoppingListPermissionGroupToPermissionsScheduledForDeletion[]= clone $spyShoppingListPermissionGroupToPermission;
            $spyShoppingListPermissionGroupToPermission->setSpyPermission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyPermission is new, it will return
     * an empty collection; or if this SpyPermission has previously
     * been saved, it will retrieve related SpyShoppingListPermissionGroupToPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyPermission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListPermissionGroupToPermission[] List of SpyShoppingListPermissionGroupToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListPermissionGroupToPermission}> List of SpyShoppingListPermissionGroupToPermission objects
     */
    public function getSpyShoppingListPermissionGroupToPermissionsJoinSpyShoppingListPermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListPermissionGroupToPermissionQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListPermissionGroup', $joinBehavior);

        return $this->getSpyShoppingListPermissionGroupToPermissions($query, $con);
    }

    /**
     * Clears out the collCompanyRoleIdCompanyRoleToPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCompanyRoleIdCompanyRoleToPermissions()
     */
    public function clearCompanyRoleIdCompanyRoleToPermissions()
    {
        $this->collCompanyRoleIdCompanyRoleToPermissions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the combinationCollCompanyRoleIdCompanyRoleToPermissions crossRef collection.
     *
     * By default this just sets the combinationCollCompanyRoleIdCompanyRoleToPermissions collection to an empty collection (like clearCompanyRoleIdCompanyRoleToPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initCompanyRoleIdCompanyRoleToPermissions()
    {
        $this->combinationCollCompanyRoleIdCompanyRoleToPermissions = new ObjectCombinationCollection;
        $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial = true;
    }

    /**
     * Checks if the combinationCollCompanyRoleIdCompanyRoleToPermissions collection is loaded.
     *
     * @return bool
     */
    public function isCompanyRoleIdCompanyRoleToPermissionsLoaded(): bool
    {
        return null !== $this->combinationCollCompanyRoleIdCompanyRoleToPermissions;
    }

    /**
     * Returns a new query object pre configured with filters from current object and given arguments to query the database.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     *
     * @return SpyCompanyRoleQuery
     */
    public function createCompanyRolesQuery($idCompanyRoleToPermission = null, ?Criteria $criteria = null)
    {
        $criteria = SpyCompanyRoleQuery::create($criteria)
            ->filterByPermission($this);

        $spyCompanyRoleToPermissionQuery = $criteria->useSpyCompanyRoleToPermissionQuery();

        if (null !== $idCompanyRoleToPermission) {
            $spyCompanyRoleToPermissionQuery->filterByIdCompanyRoleToPermission($idCompanyRoleToPermission);
        }

        $spyCompanyRoleToPermissionQuery->endUse();

        return $criteria;
    }

    /**
     * Gets a combined collection of SpyCompanyRole objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyPermission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCombinationCollection Combination list of SpyCompanyRole objects
     */
    public function getCompanyRoleIdCompanyRoleToPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->combinationCollCompanyRoleIdCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->combinationCollCompanyRoleIdCompanyRoleToPermissions) {
                    $this->initCompanyRoleIdCompanyRoleToPermissions();
                }
            } else {

                $query = SpyCompanyRoleToPermissionQuery::create(null, $criteria)
                    ->filterByPermission($this)
                    ->joinCompanyRole()
                ;

                $items = $query->find($con);
                $combinationCollCompanyRoleIdCompanyRoleToPermissions = new ObjectCombinationCollection();
                foreach ($items as $item) {
                    $combination = [];

                    $combination[] = $item->getCompanyRole();
                    $combination[] = $item->getIdCompanyRoleToPermission();
                    $combinationCollCompanyRoleIdCompanyRoleToPermissions[] = $combination;
                }

                if (null !== $criteria) {
                    return $combinationCollCompanyRoleIdCompanyRoleToPermissions;
                }

                if ($partial && $this->combinationCollCompanyRoleIdCompanyRoleToPermissions) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->combinationCollCompanyRoleIdCompanyRoleToPermissions as $obj) {
                        if (!$combinationCollCompanyRoleIdCompanyRoleToPermissions->contains(...$obj)) {
                            $combinationCollCompanyRoleIdCompanyRoleToPermissions[] = $obj;
                        }
                    }
                }

                $this->combinationCollCompanyRoleIdCompanyRoleToPermissions = $combinationCollCompanyRoleIdCompanyRoleToPermissions;
                $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial = false;
            }
        }

        return $this->combinationCollCompanyRoleIdCompanyRoleToPermissions;
    }

    /**
     * Returns a not cached ObjectCollection of SpyCompanyRole objects. This will hit always the databases.
     * If you have attached new SpyCompanyRole object to this object you need to call `save` first to get
     * the correct return value. Use getCompanyRoleIdCompanyRoleToPermissions() to get the current internal state.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return SpyCompanyRole[]|ObjectCollection
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRole>
     */
    public function getCompanyRoles($idCompanyRoleToPermission = null, ?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        return $this->createCompanyRolesQuery($idCompanyRoleToPermission, $criteria)->find($con);
    }

    /**
     * Sets a collection of ChildSpyCompanyRole objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyRoleIdCompanyRoleToPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyRoleIdCompanyRoleToPermissions(Collection $companyRoleIdCompanyRoleToPermissions, ?ConnectionInterface $con = null)
    {
        $this->clearCompanyRoleIdCompanyRoleToPermissions();
        $currentCompanyRoleIdCompanyRoleToPermissions = $this->getCompanyRoleIdCompanyRoleToPermissions();

        $combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion = $currentCompanyRoleIdCompanyRoleToPermissions->diff($companyRoleIdCompanyRoleToPermissions);

        foreach ($combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion as $toDelete) {
            $this->removeCompanyRoleIdCompanyRoleToPermission(...$toDelete);
        }

        foreach ($companyRoleIdCompanyRoleToPermissions as $companyRoleIdCompanyRoleToPermission) {
            if (!$currentCompanyRoleIdCompanyRoleToPermissions->contains(...$companyRoleIdCompanyRoleToPermission)) {
                $this->doAddCompanyRoleIdCompanyRoleToPermission(...$companyRoleIdCompanyRoleToPermission);
            }
        }

        $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial = false;
        $this->combinationCollCompanyRoleIdCompanyRoleToPermissions = $companyRoleIdCompanyRoleToPermissions;

        return $this;
    }

    /**
     * Gets the number of ChildSpyCompanyRole objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related ChildSpyCompanyRole objects
     */
    public function countCompanyRoleIdCompanyRoleToPermissions(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->combinationCollCompanyRoleIdCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->combinationCollCompanyRoleIdCompanyRoleToPermissions) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getCompanyRoleIdCompanyRoleToPermissions());
                }

                $query = SpyCompanyRoleToPermissionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPermission($this)
                    ->count($con);
            }
        } else {
            return count($this->combinationCollCompanyRoleIdCompanyRoleToPermissions);
        }
    }

    /**
     * Returns the not cached count of SpyCompanyRole objects. This will hit always the databases.
     * If you have attached new SpyCompanyRole object to this object you need to call `save` first to get
     * the correct return value. Use getCompanyRoleIdCompanyRoleToPermissions() to get the current internal state.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return int
     */
    public function countCompanyRoles($idCompanyRoleToPermission = null, ?Criteria $criteria = null, ?ConnectionInterface $con = null): int
    {
        return $this->createCompanyRolesQuery($idCompanyRoleToPermission, $criteria)->count($con);
    }

    /**
     * Associate a SpyCompanyRole to this object
     * through the spy_company_role_to_permission cross reference table.
     *
     * @param SpyCompanyRole $companyRole,
     * @param int $idCompanyRoleToPermission
     * @return ChildSpyPermission The current object (for fluent API support)
     */
    public function addCompanyRole(SpyCompanyRole $companyRole, $idCompanyRoleToPermission)
    {
        if ($this->combinationCollCompanyRoleIdCompanyRoleToPermissions === null) {
            $this->initCompanyRoleIdCompanyRoleToPermissions();
        }

        if (!$this->getCompanyRoleIdCompanyRoleToPermissions()->contains($companyRole, $idCompanyRoleToPermission)) {
            // only add it if the **same** object is not already associated
            $this->combinationCollCompanyRoleIdCompanyRoleToPermissions->push($companyRole, $idCompanyRoleToPermission);
            $this->doAddCompanyRoleIdCompanyRoleToPermission($companyRole, $idCompanyRoleToPermission);
        }

        return $this;
    }

    /**
     *
     * @param SpyCompanyRole $companyRole,
     * @param int $idCompanyRoleToPermission
     */
    protected function doAddCompanyRoleIdCompanyRoleToPermission(SpyCompanyRole $companyRole, $idCompanyRoleToPermission)
    {
        $spyCompanyRoleToPermission = new SpyCompanyRoleToPermission();

        $spyCompanyRoleToPermission->setCompanyRole($companyRole);
        $spyCompanyRoleToPermission->setIdCompanyRoleToPermission($idCompanyRoleToPermission);


        $spyCompanyRoleToPermission->setPermission($this);

        $this->addSpyCompanyRoleToPermission($spyCompanyRoleToPermission);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if ($companyRole->isPermissionIdCompanyRoleToPermissionsLoaded()) {
            $companyRole->initPermissionIdCompanyRoleToPermissions();
            $companyRole->getPermissionIdCompanyRoleToPermissions()->push($this, $idCompanyRoleToPermission);
        } elseif (!$companyRole->getPermissionIdCompanyRoleToPermissions()->contains($this, $idCompanyRoleToPermission)) {
            $companyRole->getPermissionIdCompanyRoleToPermissions()->push($this, $idCompanyRoleToPermission);
        }

    }

    /**
     * Remove companyRole, idCompanyRoleToPermission of this object
     * through the spy_company_role_to_permission cross reference table.
     *
     * @param SpyCompanyRole $companyRole,
     * @param int $idCompanyRoleToPermission
     * @return ChildSpyPermission The current object (for fluent API support)
     */
    public function removeCompanyRoleIdCompanyRoleToPermission(SpyCompanyRole $companyRole, $idCompanyRoleToPermission)
    {
        if ($this->getCompanyRoleIdCompanyRoleToPermissions()->contains($companyRole, $idCompanyRoleToPermission)) {
            $spyCompanyRoleToPermission = new SpyCompanyRoleToPermission();
            $spyCompanyRoleToPermission->setCompanyRole($companyRole);
            if ($companyRole->isPermissionIdCompanyRoleToPermissionsLoaded()) {
                //remove the back reference if available
                $companyRole->getPermissionIdCompanyRoleToPermissions()->removeObject($this, $idCompanyRoleToPermission);
            }

            $spyCompanyRoleToPermission->setIdCompanyRoleToPermission($idCompanyRoleToPermission);
            $spyCompanyRoleToPermission->setPermission($this);
            $this->removeSpyCompanyRoleToPermission(clone $spyCompanyRoleToPermission);
            $spyCompanyRoleToPermission->clear();

            $this->combinationCollCompanyRoleIdCompanyRoleToPermissions->remove($this->combinationCollCompanyRoleIdCompanyRoleToPermissions->search($companyRole, $idCompanyRoleToPermission));

            if (null === $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion) {
                $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion = clone $this->combinationCollCompanyRoleIdCompanyRoleToPermissions;
                $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion->clear();
            }

            $this->combinationCollCompanyRoleIdCompanyRoleToPermissionsScheduledForDeletion->push($companyRole, $idCompanyRoleToPermission);
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
        $this->id_permission = null;
        $this->key = null;
        $this->configuration_signature = null;
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
            if ($this->collSpyCompanyRoleToPermissions) {
                foreach ($this->collSpyCompanyRoleToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuotePermissionGroupToPermissions) {
                foreach ($this->collSpyQuotePermissionGroupToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListPermissionGroupToPermissions) {
                foreach ($this->collSpyShoppingListPermissionGroupToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->combinationCollCompanyRoleIdCompanyRoleToPermissions) {
                foreach ($this->combinationCollCompanyRoleIdCompanyRoleToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyRoleToPermissions = null;
        $this->collSpyQuotePermissionGroupToPermissions = null;
        $this->collSpyShoppingListPermissionGroupToPermissions = null;
        $this->combinationCollCompanyRoleIdCompanyRoleToPermissions = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyPermissionTableMap::DEFAULT_STRING_FORMAT);
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
