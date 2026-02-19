<?php

namespace Orm\Zed\ShoppingList\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingList as ChildSpyShoppingList;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit as ChildSpyShoppingListCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist as ChildSpyShoppingListCompanyBusinessUnitBlacklist;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery as ChildSpyShoppingListCompanyBusinessUnitBlacklistQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery as ChildSpyShoppingListCompanyBusinessUnitQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroup as ChildSpyShoppingListPermissionGroup;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListPermissionGroupQuery as ChildSpyShoppingListPermissionGroupQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery as ChildSpyShoppingListQuery;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyBusinessUnitBlacklistTableMap;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyBusinessUnitTableMap;
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
 * Base class that represents a row from the 'spy_shopping_list_company_business_unit' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ShoppingList.Persistence.Base
 */
abstract class SpyShoppingListCompanyBusinessUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ShoppingList\\Persistence\\Map\\SpyShoppingListCompanyBusinessUnitTableMap';


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
     * The value for the id_shopping_list_company_business_unit field.
     *
     * @var        int
     */
    protected $id_shopping_list_company_business_unit;

    /**
     * The value for the fk_company_business_unit field.
     *
     * @var        int
     */
    protected $fk_company_business_unit;

    /**
     * The value for the fk_shopping_list field.
     *
     * @var        int
     */
    protected $fk_shopping_list;

    /**
     * The value for the fk_shopping_list_permission_group field.
     *
     * @var        int
     */
    protected $fk_shopping_list_permission_group;

    /**
     * @var        SpyCompanyBusinessUnit
     */
    protected $aSpyCompanyBusinessUnit;

    /**
     * @var        ChildSpyShoppingList
     */
    protected $aSpyShoppingList;

    /**
     * @var        ChildSpyShoppingListPermissionGroup
     */
    protected $aSpyShoppingListPermissionGroup;

    /**
     * @var        ObjectCollection|ChildSpyShoppingListCompanyBusinessUnitBlacklist[] Collection to store aggregation of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnitBlacklist> Collection to store aggregation of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects.
     */
    protected $collSpyShoppingListCompanyBusinessUnitBlacklists;
    protected $collSpyShoppingListCompanyBusinessUnitBlacklistsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // event behavior

    /**
     * @var string
     */
    private $_eventName;

    /**
     * @var bool
     */
    private $_isModified;

    /**
     * @var array
     */
    private $_modifiedColumns;

    /**
     * @var array
     */
    private $_initialValues;

    /**
     * @var bool
     */
    private $_isEventDisabled;

    /**
     * @var array
     */
    private $_foreignKeys = [
        'spy_shopping_list_company_business_unit.fk_company_business_unit' => 'fk_company_business_unit',
        'spy_shopping_list_company_business_unit.fk_shopping_list' => 'fk_shopping_list',
        'spy_shopping_list_company_business_unit.fk_shopping_list_permission_group' => 'fk_shopping_list_permission_group',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyShoppingListCompanyBusinessUnitBlacklist[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnitBlacklist>
     */
    protected $spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListCompanyBusinessUnit object.
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
     * Compares this with another <code>SpyShoppingListCompanyBusinessUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyShoppingListCompanyBusinessUnit</code>, delegates to
     * <code>equals(SpyShoppingListCompanyBusinessUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_shopping_list_company_business_unit] column value.
     *
     * @return int
     */
    public function getIdShoppingListCompanyBusinessUnit()
    {
        return $this->id_shopping_list_company_business_unit;
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
     * Get the [fk_shopping_list] column value.
     *
     * @return int
     */
    public function getFkShoppingList()
    {
        return $this->fk_shopping_list;
    }

    /**
     * Get the [fk_shopping_list_permission_group] column value.
     *
     * @return int
     */
    public function getFkShoppingListPermissionGroup()
    {
        return $this->fk_shopping_list_permission_group;
    }

    /**
     * Set the value of [id_shopping_list_company_business_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdShoppingListCompanyBusinessUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_shopping_list_company_business_unit !== $v) {
            $this->id_shopping_list_company_business_unit = $v;
            $this->modifiedColumns[SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT] = true;
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
            $this->modifiedColumns[SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT] = true;
        }

        if ($this->aSpyCompanyBusinessUnit !== null && $this->aSpyCompanyBusinessUnit->getIdCompanyBusinessUnit() !== $v) {
            $this->aSpyCompanyBusinessUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_shopping_list] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkShoppingList($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_shopping_list !== $v) {
            $this->fk_shopping_list = $v;
            $this->modifiedColumns[SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST] = true;
        }

        if ($this->aSpyShoppingList !== null && $this->aSpyShoppingList->getIdShoppingList() !== $v) {
            $this->aSpyShoppingList = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_shopping_list_permission_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkShoppingListPermissionGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_shopping_list_permission_group !== $v) {
            $this->fk_shopping_list_permission_group = $v;
            $this->modifiedColumns[SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP] = true;
        }

        if ($this->aSpyShoppingListPermissionGroup !== null && $this->aSpyShoppingListPermissionGroup->getIdShoppingListPermissionGroup() !== $v) {
            $this->aSpyShoppingListPermissionGroup = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shopping_list_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName('FkCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company_business_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName('FkShoppingList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_shopping_list = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName('FkShoppingListPermissionGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_shopping_list_permission_group = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = SpyShoppingListCompanyBusinessUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit'), 0, $e);
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
        if ($this->aSpyCompanyBusinessUnit !== null && $this->fk_company_business_unit !== $this->aSpyCompanyBusinessUnit->getIdCompanyBusinessUnit()) {
            $this->aSpyCompanyBusinessUnit = null;
        }
        if ($this->aSpyShoppingList !== null && $this->fk_shopping_list !== $this->aSpyShoppingList->getIdShoppingList()) {
            $this->aSpyShoppingList = null;
        }
        if ($this->aSpyShoppingListPermissionGroup !== null && $this->fk_shopping_list_permission_group !== $this->aSpyShoppingListPermissionGroup->getIdShoppingListPermissionGroup()) {
            $this->aSpyShoppingListPermissionGroup = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyShoppingListCompanyBusinessUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyCompanyBusinessUnit = null;
            $this->aSpyShoppingList = null;
            $this->aSpyShoppingListPermissionGroup = null;
            $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyShoppingListCompanyBusinessUnit::setDeleted()
     * @see SpyShoppingListCompanyBusinessUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyShoppingListCompanyBusinessUnitQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // event behavior

                $this->addDeleteEventToMemory();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // event behavior

            $this->prepareSaveEventName();

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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyShoppingListCompanyBusinessUnitTableMap::addInstanceToPool($this);
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

            if ($this->aSpyCompanyBusinessUnit !== null) {
                if ($this->aSpyCompanyBusinessUnit->isModified() || $this->aSpyCompanyBusinessUnit->isNew()) {
                    $affectedRows += $this->aSpyCompanyBusinessUnit->save($con);
                }
                $this->setSpyCompanyBusinessUnit($this->aSpyCompanyBusinessUnit);
            }

            if ($this->aSpyShoppingList !== null) {
                if ($this->aSpyShoppingList->isModified() || $this->aSpyShoppingList->isNew()) {
                    $affectedRows += $this->aSpyShoppingList->save($con);
                }
                $this->setSpyShoppingList($this->aSpyShoppingList);
            }

            if ($this->aSpyShoppingListPermissionGroup !== null) {
                if ($this->aSpyShoppingListPermissionGroup->isModified() || $this->aSpyShoppingListPermissionGroup->isNew()) {
                    $affectedRows += $this->aSpyShoppingListPermissionGroup->save($con);
                }
                $this->setSpyShoppingListPermissionGroup($this->aSpyShoppingListPermissionGroup);
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

            if ($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists !== null) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $referrerFK) {
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

        $this->modifiedColumns[SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT] = true;
        if (null !== $this->id_shopping_list_company_business_unit) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'id_shopping_list_company_business_unit';
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_company_business_unit';
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST)) {
            $modifiedColumns[':p' . $index++]  = 'fk_shopping_list';
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP)) {
            $modifiedColumns[':p' . $index++]  = 'fk_shopping_list_permission_group';
        }

        $sql = sprintf(
            'INSERT INTO spy_shopping_list_company_business_unit (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_shopping_list_company_business_unit':
                        $stmt->bindValue($identifier, $this->id_shopping_list_company_business_unit, PDO::PARAM_INT);

                        break;
                    case 'fk_company_business_unit':
                        $stmt->bindValue($identifier, $this->fk_company_business_unit, PDO::PARAM_INT);

                        break;
                    case 'fk_shopping_list':
                        $stmt->bindValue($identifier, $this->fk_shopping_list, PDO::PARAM_INT);

                        break;
                    case 'fk_shopping_list_permission_group':
                        $stmt->bindValue($identifier, $this->fk_shopping_list_permission_group, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_shopping_list_company_business_unit_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdShoppingListCompanyBusinessUnit($pk);

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
        $pos = SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdShoppingListCompanyBusinessUnit();

            case 1:
                return $this->getFkCompanyBusinessUnit();

            case 2:
                return $this->getFkShoppingList();

            case 3:
                return $this->getFkShoppingListPermissionGroup();

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
        if (isset($alreadyDumpedObjects['SpyShoppingListCompanyBusinessUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyShoppingListCompanyBusinessUnit'][$this->hashCode()] = true;
        $keys = SpyShoppingListCompanyBusinessUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdShoppingListCompanyBusinessUnit(),
            $keys[1] => $this->getFkCompanyBusinessUnit(),
            $keys[2] => $this->getFkShoppingList(),
            $keys[3] => $this->getFkShoppingListPermissionGroup(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyCompanyBusinessUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_unit';
                        break;
                    default:
                        $key = 'SpyCompanyBusinessUnit';
                }

                $result[$key] = $this->aSpyCompanyBusinessUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyShoppingList) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingList';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list';
                        break;
                    default:
                        $key = 'SpyShoppingList';
                }

                $result[$key] = $this->aSpyShoppingList->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyShoppingListPermissionGroup) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListPermissionGroup';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_permission_group';
                        break;
                    default:
                        $key = 'SpyShoppingListPermissionGroup';
                }

                $result[$key] = $this->aSpyShoppingListPermissionGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyBusinessUnitBlacklists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_business_unit_blacklists';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyBusinessUnitBlacklists';
                }

                $result[$key] = $this->collSpyShoppingListCompanyBusinessUnitBlacklists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyShoppingListCompanyBusinessUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdShoppingListCompanyBusinessUnit($value);
                break;
            case 1:
                $this->setFkCompanyBusinessUnit($value);
                break;
            case 2:
                $this->setFkShoppingList($value);
                break;
            case 3:
                $this->setFkShoppingListPermissionGroup($value);
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
        $keys = SpyShoppingListCompanyBusinessUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdShoppingListCompanyBusinessUnit($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompanyBusinessUnit($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkShoppingList($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkShoppingListPermissionGroup($arr[$keys[3]]);
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
        $criteria = new Criteria(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT, $this->id_shopping_list_company_business_unit);
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT)) {
            $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $this->fk_company_business_unit);
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST)) {
            $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST, $this->fk_shopping_list);
        }
        if ($this->isColumnModified(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP)) {
            $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP, $this->fk_shopping_list_permission_group);
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
        $criteria = ChildSpyShoppingListCompanyBusinessUnitQuery::create();
        $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT, $this->id_shopping_list_company_business_unit);

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
        $validPk = null !== $this->getIdShoppingListCompanyBusinessUnit();

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
        return $this->getIdShoppingListCompanyBusinessUnit();
    }

    /**
     * Generic method to set the primary key (id_shopping_list_company_business_unit column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdShoppingListCompanyBusinessUnit($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdShoppingListCompanyBusinessUnit();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompanyBusinessUnit($this->getFkCompanyBusinessUnit());
        $copyObj->setFkShoppingList($this->getFkShoppingList());
        $copyObj->setFkShoppingListPermissionGroup($this->getFkShoppingListPermissionGroup());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyShoppingListCompanyBusinessUnitBlacklists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyBusinessUnitBlacklist($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdShoppingListCompanyBusinessUnit(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit Clone of current object.
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
     * Declares an association between this object and a SpyCompanyBusinessUnit object.
     *
     * @param SpyCompanyBusinessUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyCompanyBusinessUnit(SpyCompanyBusinessUnit $v = null)
    {
        if ($v === null) {
            $this->setFkCompanyBusinessUnit(NULL);
        } else {
            $this->setFkCompanyBusinessUnit($v->getIdCompanyBusinessUnit());
        }

        $this->aSpyCompanyBusinessUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompanyBusinessUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyShoppingListCompanyBusinessUnit($this);
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
    public function getSpyCompanyBusinessUnit(?ConnectionInterface $con = null)
    {
        if ($this->aSpyCompanyBusinessUnit === null && ($this->fk_company_business_unit != 0)) {
            $this->aSpyCompanyBusinessUnit = SpyCompanyBusinessUnitQuery::create()->findPk($this->fk_company_business_unit, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyCompanyBusinessUnit->addSpyShoppingListCompanyBusinessUnits($this);
             */
        }

        return $this->aSpyCompanyBusinessUnit;
    }

    /**
     * Declares an association between this object and a ChildSpyShoppingList object.
     *
     * @param ChildSpyShoppingList $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyShoppingList(ChildSpyShoppingList $v = null)
    {
        if ($v === null) {
            $this->setFkShoppingList(NULL);
        } else {
            $this->setFkShoppingList($v->getIdShoppingList());
        }

        $this->aSpyShoppingList = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyShoppingList object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyShoppingListCompanyBusinessUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyShoppingList object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyShoppingList The associated ChildSpyShoppingList object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingList(?ConnectionInterface $con = null)
    {
        if ($this->aSpyShoppingList === null && ($this->fk_shopping_list != 0)) {
            $this->aSpyShoppingList = ChildSpyShoppingListQuery::create()->findPk($this->fk_shopping_list, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyShoppingList->addSpyShoppingListCompanyBusinessUnits($this);
             */
        }

        return $this->aSpyShoppingList;
    }

    /**
     * Declares an association between this object and a ChildSpyShoppingListPermissionGroup object.
     *
     * @param ChildSpyShoppingListPermissionGroup $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyShoppingListPermissionGroup(ChildSpyShoppingListPermissionGroup $v = null)
    {
        if ($v === null) {
            $this->setFkShoppingListPermissionGroup(NULL);
        } else {
            $this->setFkShoppingListPermissionGroup($v->getIdShoppingListPermissionGroup());
        }

        $this->aSpyShoppingListPermissionGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyShoppingListPermissionGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyShoppingListCompanyBusinessUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyShoppingListPermissionGroup object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyShoppingListPermissionGroup The associated ChildSpyShoppingListPermissionGroup object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListPermissionGroup(?ConnectionInterface $con = null)
    {
        if ($this->aSpyShoppingListPermissionGroup === null && ($this->fk_shopping_list_permission_group != 0)) {
            $this->aSpyShoppingListPermissionGroup = ChildSpyShoppingListPermissionGroupQuery::create()->findPk($this->fk_shopping_list_permission_group, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyShoppingListPermissionGroup->addSpyShoppingListCompanyBusinessUnits($this);
             */
        }

        return $this->aSpyShoppingListPermissionGroup;
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
        if ('SpyShoppingListCompanyBusinessUnitBlacklist' === $relationName) {
            $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
            return;
        }
    }

    /**
     * Clears out the collSpyShoppingListCompanyBusinessUnitBlacklists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyBusinessUnitBlacklists()
     */
    public function clearSpyShoppingListCompanyBusinessUnitBlacklists()
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyBusinessUnitBlacklists collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyBusinessUnitBlacklists($v = true): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyBusinessUnitBlacklists collection.
     *
     * By default this just sets the collSpyShoppingListCompanyBusinessUnitBlacklists collection to an empty array (like clearcollSpyShoppingListCompanyBusinessUnitBlacklists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyBusinessUnitBlacklists(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyBusinessUnitBlacklists && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = new $collectionClassName;
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist');
    }

    /**
     * Gets an array of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingListCompanyBusinessUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyShoppingListCompanyBusinessUnitBlacklist[] List of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnitBlacklist> List of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyBusinessUnitBlacklists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                    $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
                } else {
                    $collectionClassName = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyBusinessUnitBlacklists = new $collectionClassName;
                    $collSpyShoppingListCompanyBusinessUnitBlacklists->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist');

                    return $collSpyShoppingListCompanyBusinessUnitBlacklists;
                }
            } else {
                $collSpyShoppingListCompanyBusinessUnitBlacklists = ChildSpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria)
                    ->filterBySpyShoppingListCompanyBusinessUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && count($collSpyShoppingListCompanyBusinessUnitBlacklists)) {
                        $this->initSpyShoppingListCompanyBusinessUnitBlacklists(false);

                        foreach ($collSpyShoppingListCompanyBusinessUnitBlacklists as $obj) {
                            if (false == $this->collSpyShoppingListCompanyBusinessUnitBlacklists->contains($obj)) {
                                $this->collSpyShoppingListCompanyBusinessUnitBlacklists->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = true;
                    }

                    return $collSpyShoppingListCompanyBusinessUnitBlacklists;
                }

                if ($partial && $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                    foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyBusinessUnitBlacklists[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyBusinessUnitBlacklists = $collSpyShoppingListCompanyBusinessUnitBlacklists;
                $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyBusinessUnitBlacklists;
    }

    /**
     * Sets a collection of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyBusinessUnitBlacklists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyBusinessUnitBlacklists(Collection $spyShoppingListCompanyBusinessUnitBlacklists, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyShoppingListCompanyBusinessUnitBlacklist[] $spyShoppingListCompanyBusinessUnitBlacklistsToDelete */
        $spyShoppingListCompanyBusinessUnitBlacklistsToDelete = $this->getSpyShoppingListCompanyBusinessUnitBlacklists(new Criteria(), $con)->diff($spyShoppingListCompanyBusinessUnitBlacklists);


        $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = $spyShoppingListCompanyBusinessUnitBlacklistsToDelete;

        foreach ($spyShoppingListCompanyBusinessUnitBlacklistsToDelete as $spyShoppingListCompanyBusinessUnitBlacklistRemoved) {
            $spyShoppingListCompanyBusinessUnitBlacklistRemoved->setSpyShoppingListCompanyBusinessUnit(null);
        }

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;
        foreach ($spyShoppingListCompanyBusinessUnitBlacklists as $spyShoppingListCompanyBusinessUnitBlacklist) {
            $this->addSpyShoppingListCompanyBusinessUnitBlacklist($spyShoppingListCompanyBusinessUnitBlacklist);
        }

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = $spyShoppingListCompanyBusinessUnitBlacklists;
        $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyShoppingListCompanyBusinessUnitBlacklist objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyShoppingListCompanyBusinessUnitBlacklist objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyBusinessUnitBlacklists(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyBusinessUnitBlacklists());
            }

            $query = ChildSpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingListCompanyBusinessUnit($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyBusinessUnitBlacklists);
    }

    /**
     * Method called to associate a ChildSpyShoppingListCompanyBusinessUnitBlacklist object to this object
     * through the ChildSpyShoppingListCompanyBusinessUnitBlacklist foreign key attribute.
     *
     * @param ChildSpyShoppingListCompanyBusinessUnitBlacklist $l ChildSpyShoppingListCompanyBusinessUnitBlacklist
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyBusinessUnitBlacklist(ChildSpyShoppingListCompanyBusinessUnitBlacklist $l)
    {
        if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists === null) {
            $this->initSpyShoppingListCompanyBusinessUnitBlacklists();
            $this->collSpyShoppingListCompanyBusinessUnitBlacklistsPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyBusinessUnitBlacklists->contains($l)) {
            $this->doAddSpyShoppingListCompanyBusinessUnitBlacklist($l);

            if ($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion and $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->remove($this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist The ChildSpyShoppingListCompanyBusinessUnitBlacklist object to add.
     */
    protected function doAddSpyShoppingListCompanyBusinessUnitBlacklist(ChildSpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitBlacklists[]= $spyShoppingListCompanyBusinessUnitBlacklist;
        $spyShoppingListCompanyBusinessUnitBlacklist->setSpyShoppingListCompanyBusinessUnit($this);
    }

    /**
     * @param ChildSpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist The ChildSpyShoppingListCompanyBusinessUnitBlacklist object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyBusinessUnitBlacklist(ChildSpyShoppingListCompanyBusinessUnitBlacklist $spyShoppingListCompanyBusinessUnitBlacklist)
    {
        if ($this->getSpyShoppingListCompanyBusinessUnitBlacklists()->contains($spyShoppingListCompanyBusinessUnitBlacklist)) {
            $pos = $this->collSpyShoppingListCompanyBusinessUnitBlacklists->search($spyShoppingListCompanyBusinessUnitBlacklist);
            $this->collSpyShoppingListCompanyBusinessUnitBlacklists->remove($pos);
            if (null === $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion) {
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion = clone $this->collSpyShoppingListCompanyBusinessUnitBlacklists;
                $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyBusinessUnitBlacklistsScheduledForDeletion[]= clone $spyShoppingListCompanyBusinessUnitBlacklist;
            $spyShoppingListCompanyBusinessUnitBlacklist->setSpyShoppingListCompanyBusinessUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingListCompanyBusinessUnit is new, it will return
     * an empty collection; or if this SpyShoppingListCompanyBusinessUnit has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnitBlacklists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingListCompanyBusinessUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShoppingListCompanyBusinessUnitBlacklist[] List of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnitBlacklist}> List of ChildSpyShoppingListCompanyBusinessUnitBlacklist objects
     */
    public function getSpyShoppingListCompanyBusinessUnitBlacklistsJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShoppingListCompanyBusinessUnitBlacklistQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnitBlacklists($query, $con);
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
        if (null !== $this->aSpyCompanyBusinessUnit) {
            $this->aSpyCompanyBusinessUnit->removeSpyShoppingListCompanyBusinessUnit($this);
        }
        if (null !== $this->aSpyShoppingList) {
            $this->aSpyShoppingList->removeSpyShoppingListCompanyBusinessUnit($this);
        }
        if (null !== $this->aSpyShoppingListPermissionGroup) {
            $this->aSpyShoppingListPermissionGroup->removeSpyShoppingListCompanyBusinessUnit($this);
        }
        $this->id_shopping_list_company_business_unit = null;
        $this->fk_company_business_unit = null;
        $this->fk_shopping_list = null;
        $this->fk_shopping_list_permission_group = null;
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
            if ($this->collSpyShoppingListCompanyBusinessUnitBlacklists) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnitBlacklists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyShoppingListCompanyBusinessUnitBlacklists = null;
        $this->aSpyCompanyBusinessUnit = null;
        $this->aSpyShoppingList = null;
        $this->aSpyShoppingListPermissionGroup = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyShoppingListCompanyBusinessUnitTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_shopping_list_company_business_unit.create';
        } else {
            $this->_eventName = 'Entity.spy_shopping_list_company_business_unit.update';
        }

        $this->_modifiedColumns = $this->getModifiedColumns();
        $this->_isModified = $this->isModified();
    }

    /**
     * @return void
     */
    public function disableEvent()
    {
        $this->_isEventDisabled = true;
    }

    /**
     * @return void
     */
    public function enableEvent()
    {
        $this->_isEventDisabled = false;
    }

    /**
     * @return void
     */
    protected function addSaveEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        if ($this->_eventName !== 'Entity.spy_shopping_list_company_business_unit.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_shopping_list_company_business_unit',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => $this->_eventName,
            'foreignKeys' => $this->getForeignKeys(),
            'modifiedColumns' => $this->_modifiedColumns,
            'originalValues' => $this->getOriginalValues(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);

        unset($this->_eventName);
        unset($this->_modifiedColumns);
        unset($this->_isModified);
    }

    /**
     * @return void
     */
    protected function addDeleteEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        $data = [
            'name' => 'spy_shopping_list_company_business_unit',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_shopping_list_company_business_unit.delete',
            'foreignKeys' => $this->getForeignKeys(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);
    }

    /**
     * @return array
     */
    protected function getForeignKeys()
    {
        $foreignKeysWithValue = [];
        foreach ($this->_foreignKeys as $key => $value) {
            $foreignKeysWithValue[$key] = $this->getByName($value);
        }

        return $foreignKeysWithValue;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    protected function saveEventBehaviorEntityChange(array $data)
    {
        $encodedData = json_encode($data);
        $dataLength = strlen($encodedData);

        if ($dataLength > 256 * 1024) {
            $warningMessage = sprintf(
                '%s event message data size (%d KB) exceeds the allowable limit of %d KB. Please reduce the event message size or it might disrupt P&S process.',
                ($data['event'] ?? ''),
                $dataLength / 1024,
                256,
            );

            $this->log($warningMessage, \Propel\Runtime\Propel::LOG_WARNING);
        }

        $isInstancePoolingDisabledSuccessfully = \Propel\Runtime\Propel::disableInstancePooling();

        $spyEventBehaviorEntityChange = new \Orm\Zed\EventBehavior\Persistence\SpyEventBehaviorEntityChange();
        $spyEventBehaviorEntityChange->setData($encodedData);
        $spyEventBehaviorEntityChange->setProcessId(\Spryker\Zed\Kernel\RequestIdentifier::getRequestId());
        $spyEventBehaviorEntityChange->save();

        if ($isInstancePoolingDisabledSuccessfully) {
            \Propel\Runtime\Propel::enableInstancePooling();
        }
    }

    /**
     * @return bool
     */
    protected function isEventColumnsModified()
    {
        /* There is a wildcard(*) property for this event */
        return true;
    }

    /**
     * @return array
     */
    protected function getOriginalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getOriginalValues(): array
    {
        if ($this->isNew()) {
            return [];
        }

        $originalValues = [];
        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (!in_array($modifiedColumn, $this->getOriginalValueColumnNames())) {
                continue;
            }

            $before = $this->_initialValues[$modifiedColumn];
            $field = str_replace('spy_shopping_list_company_business_unit.', '', $modifiedColumn);
            $after = $this->$field;

            if ($before !== $after) {
                $originalValues[$modifiedColumn] = $before;
            }
        }

        return $originalValues;
    }

    /**
     * @return array
     */
    protected function getAdditionalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getAdditionalValues(): array
    {
        $additionalValues = [];
        foreach ($this->getAdditionalValueColumnNames() as $additionalValueColumnName) {
            $field = str_replace('spy_shopping_list_company_business_unit.', '', $additionalValueColumnName);
            $additionalValues[$additionalValueColumnName] = $this->$field;
        }

        return $additionalValues;
    }

    /**
     * @param string $xmlValue
     * @param string $column
     *
     * @return array|bool|\DateTime|float|int|object
     */
    protected function getPhpType($xmlValue, $column)
    {
        $columnType = SpyShoppingListCompanyBusinessUnitTableMap::getTableMap()->getColumn($column)->getType();
        if (in_array(strtoupper($columnType), ['INTEGER', 'TINYINT', 'SMALLINT'])) {
            $xmlValue = (int) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['REAL', 'FLOAT', 'DOUBLE', 'BINARY', 'VARBINARY', 'LONGVARBINARY'])) {
            $xmlValue = (double) $xmlValue;
        } else if (strtoupper($columnType) === 'ARRAY') {
            $xmlValue = (array) $xmlValue;
        } else if (strtoupper($columnType) === 'BOOLEAN') {
            $xmlValue = filter_var($xmlValue,  FILTER_VALIDATE_BOOLEAN);
        } else if (strtoupper($columnType) === 'OBJECT') {
            $xmlValue = (object) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['DATE', 'TIME', 'TIMESTAMP', 'BU_DATE', 'BU_TIMESTAMP'])) {
            $xmlValue = \DateTime::createFromFormat('Y-m-d H:i:s', $xmlValue);
        }

        return $xmlValue;
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
