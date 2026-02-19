<?php

namespace Orm\Zed\CompanyRole\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole as ChildSpyCompanyRole;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery as ChildSpyCompanyRoleQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser as ChildSpyCompanyRoleToCompanyUser;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery as ChildSpyCompanyRoleToCompanyUserQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission as ChildSpyCompanyRoleToPermission;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery as ChildSpyCompanyRoleToPermissionQuery;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToCompanyUserTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToPermissionTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Permission\Persistence\SpyPermission;
use Orm\Zed\Permission\Persistence\SpyPermissionQuery;
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
 * Base class that represents a row from the 'spy_company_role' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CompanyRole.Persistence.Base
 */
abstract class SpyCompanyRole implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CompanyRole\\Persistence\\Map\\SpyCompanyRoleTableMap';


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
     * The value for the id_company_role field.
     *
     * @var        int
     */
    protected $id_company_role;

    /**
     * The value for the fk_company field.
     *
     * @var        int
     */
    protected $fk_company;

    /**
     * The value for the is_default field.
     * A flag indicating if an entity is the default one.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_default;

    /**
     * The value for the key field.
     * Key is an identifier for existing entities. This should never be changed.
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
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        SpyCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildSpyCompanyRoleToPermission[] Collection to store aggregation of ChildSpyCompanyRoleToPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyRoleToPermission> Collection to store aggregation of ChildSpyCompanyRoleToPermission objects.
     */
    protected $collSpyCompanyRoleToPermissions;
    protected $collSpyCompanyRoleToPermissionsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCompanyRoleToCompanyUser[] Collection to store aggregation of ChildSpyCompanyRoleToCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyRoleToCompanyUser> Collection to store aggregation of ChildSpyCompanyRoleToCompanyUser objects.
     */
    protected $collSpyCompanyRoleToCompanyUsers;
    protected $collSpyCompanyRoleToCompanyUsersPartial;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildSpyPermission combinations.
     */
    protected $combinationCollPermissionIdCompanyRoleToPermissions;

    /**
     * @var bool
     */
    protected $combinationCollPermissionIdCompanyRoleToPermissionsPartial;

    /**
     * @var        ObjectCollection|SpyPermission[] Cross Collection to store aggregation of SpyPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPermission> Cross Collection to store aggregation of SpyPermission objects.
     */
    protected $collPermissions;

    /**
     * @var bool
     */
    protected $collPermissionsPartial;

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
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildSpyPermission combinations.
     */
    protected $combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCompanyRoleToPermission[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyRoleToPermission>
     */
    protected $spyCompanyRoleToPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCompanyRoleToCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyRoleToCompanyUser>
     */
    protected $spyCompanyRoleToCompanyUsersScheduledForDeletion = null;

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
     * Initializes internal state of Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRole object.
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
     * Compares this with another <code>SpyCompanyRole</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCompanyRole</code>, delegates to
     * <code>equals(SpyCompanyRole)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_company_role] column value.
     *
     * @return int
     */
    public function getIdCompanyRole()
    {
        return $this->id_company_role;
    }

    /**
     * Get the [fk_company] column value.
     *
     * @return int
     */
    public function getFkCompany()
    {
        return $this->fk_company;
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
     * Get the [key] column value.
     * Key is an identifier for existing entities. This should never be changed.
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
     * Get the [uuid] column value.
     * A Universally Unique Identifier for an entity.
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of [id_company_role] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCompanyRole($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_company_role !== $v) {
            $this->id_company_role = $v;
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCompany($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_company !== $v) {
            $this->fk_company = $v;
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_FK_COMPANY] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getIdCompany() !== $v) {
            $this->aCompany = null;
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
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_IS_DEFAULT] = true;
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
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[SpyCompanyRoleTableMap::COL_UUID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCompanyRoleTableMap::translateFieldName('IdCompanyRole', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company_role = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCompanyRoleTableMap::translateFieldName('FkCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCompanyRoleTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCompanyRoleTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCompanyRoleTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCompanyRoleTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyCompanyRoleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRole'), 0, $e);
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
        if ($this->aCompany !== null && $this->fk_company !== $this->aCompany->getIdCompany()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCompanyRoleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCompanyRoleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collSpyCompanyRoleToPermissions = null;

            $this->collSpyCompanyRoleToCompanyUsers = null;

            $this->collPermissionIdCompanyRoleToPermissions = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCompanyRole::setDeleted()
     * @see SpyCompanyRole::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCompanyRoleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleTableMap::DATABASE_NAME);
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
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
                SpyCompanyRoleTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
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

            if ($this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion !== null) {
                if (!$this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion as $combination) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdCompanyRole();
                        $entryPk[2] = $combination[0]->getIdPermission();
                        //$combination[1] = IdCompanyRoleToPermission;
                        $entryPk[0] = $combination[1];

                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion = null;
                }

            }

            if (null !== $this->combinationCollPermissionIdCompanyRoleToPermissions) {
                foreach ($this->combinationCollPermissionIdCompanyRoleToPermissions as $combination) {

                    //$combination[0] = SpyPermission (spy_company_role_to_permission-fk_permission)
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

            if ($this->spyCompanyRoleToCompanyUsersScheduledForDeletion !== null) {
                if (!$this->spyCompanyRoleToCompanyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyRoleToCompanyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyRoleToCompanyUsers !== null) {
                foreach ($this->collSpyCompanyRoleToCompanyUsers as $referrerFK) {
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

        $this->modifiedColumns[SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`id_company_role`';
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_FK_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_company`';
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`is_default`';
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_company_role` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_company_role`':
                        $stmt->bindValue($identifier, $this->id_company_role, PDO::PARAM_INT);

                        break;
                    case '`fk_company`':
                        $stmt->bindValue($identifier, $this->fk_company, PDO::PARAM_INT);

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
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_company_role_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdCompanyRole($pk);
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
        $pos = SpyCompanyRoleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCompanyRole();

            case 1:
                return $this->getFkCompany();

            case 2:
                return $this->getIsDefault();

            case 3:
                return $this->getKey();

            case 4:
                return $this->getName();

            case 5:
                return $this->getUuid();

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
        if (isset($alreadyDumpedObjects['SpyCompanyRole'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCompanyRole'][$this->hashCode()] = true;
        $keys = SpyCompanyRoleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCompanyRole(),
            $keys[1] => $this->getFkCompany(),
            $keys[2] => $this->getIsDefault(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompany';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->collSpyCompanyRoleToCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyRoleToCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_role_to_company_users';
                        break;
                    default:
                        $key = 'SpyCompanyRoleToCompanyUsers';
                }

                $result[$key] = $this->collSpyCompanyRoleToCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCompanyRoleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCompanyRole($value);
                break;
            case 1:
                $this->setFkCompany($value);
                break;
            case 2:
                $this->setIsDefault($value);
                break;
            case 3:
                $this->setKey($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setUuid($value);
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
        $keys = SpyCompanyRoleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCompanyRole($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompany($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsDefault($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setKey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUuid($arr[$keys[5]]);
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
        $criteria = new Criteria(SpyCompanyRoleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $this->id_company_role);
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_FK_COMPANY)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_FK_COMPANY, $this->fk_company);
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_KEY)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_NAME)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCompanyRoleTableMap::COL_UUID)) {
            $criteria->add(SpyCompanyRoleTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyCompanyRoleQuery::create();
        $criteria->add(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $this->id_company_role);

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
        $validPk = null !== $this->getIdCompanyRole();

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
        return $this->getIdCompanyRole();
    }

    /**
     * Generic method to set the primary key (id_company_role column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCompanyRole($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCompanyRole();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompany($this->getFkCompany());
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyRoleToPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyRoleToPermission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyRoleToCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyRoleToCompanyUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCompanyRole(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole Clone of current object.
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
     * Declares an association between this object and a SpyCompany object.
     *
     * @param SpyCompany $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(SpyCompany $v = null)
    {
        if ($v === null) {
            $this->setFkCompany(NULL);
        } else {
            $this->setFkCompany($v->getIdCompany());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyRole($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompany The associated SpyCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->fk_company != 0)) {
            $this->aCompany = SpyCompanyQuery::create()->findPk($this->fk_company, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addCompanyRoles($this);
             */
        }

        return $this->aCompany;
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
        if ('SpyCompanyRoleToCompanyUser' === $relationName) {
            $this->initSpyCompanyRoleToCompanyUsers();
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
     * Gets an array of ChildSpyCompanyRoleToPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCompanyRoleToPermission[] List of ChildSpyCompanyRoleToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyRoleToPermission> List of ChildSpyCompanyRoleToPermission objects
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
                $collSpyCompanyRoleToPermissions = ChildSpyCompanyRoleToPermissionQuery::create(null, $criteria)
                    ->filterByCompanyRole($this)
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
     * Sets a collection of ChildSpyCompanyRoleToPermission objects related by a one-to-many relationship
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
        /** @var ChildSpyCompanyRoleToPermission[] $spyCompanyRoleToPermissionsToDelete */
        $spyCompanyRoleToPermissionsToDelete = $this->getSpyCompanyRoleToPermissions(new Criteria(), $con)->diff($spyCompanyRoleToPermissions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyCompanyRoleToPermissionsScheduledForDeletion = clone $spyCompanyRoleToPermissionsToDelete;

        foreach ($spyCompanyRoleToPermissionsToDelete as $spyCompanyRoleToPermissionRemoved) {
            $spyCompanyRoleToPermissionRemoved->setCompanyRole(null);
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
     * Returns the number of related SpyCompanyRoleToPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCompanyRoleToPermission objects.
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

            $query = ChildSpyCompanyRoleToPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyRole($this)
                ->count($con);
        }

        return count($this->collSpyCompanyRoleToPermissions);
    }

    /**
     * Method called to associate a ChildSpyCompanyRoleToPermission object to this object
     * through the ChildSpyCompanyRoleToPermission foreign key attribute.
     *
     * @param ChildSpyCompanyRoleToPermission $l ChildSpyCompanyRoleToPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyRoleToPermission(ChildSpyCompanyRoleToPermission $l)
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
     * @param ChildSpyCompanyRoleToPermission $spyCompanyRoleToPermission The ChildSpyCompanyRoleToPermission object to add.
     */
    protected function doAddSpyCompanyRoleToPermission(ChildSpyCompanyRoleToPermission $spyCompanyRoleToPermission): void
    {
        $this->collSpyCompanyRoleToPermissions[]= $spyCompanyRoleToPermission;
        $spyCompanyRoleToPermission->setCompanyRole($this);
    }

    /**
     * @param ChildSpyCompanyRoleToPermission $spyCompanyRoleToPermission The ChildSpyCompanyRoleToPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyRoleToPermission(ChildSpyCompanyRoleToPermission $spyCompanyRoleToPermission)
    {
        if ($this->getSpyCompanyRoleToPermissions()->contains($spyCompanyRoleToPermission)) {
            $pos = $this->collSpyCompanyRoleToPermissions->search($spyCompanyRoleToPermission);
            $this->collSpyCompanyRoleToPermissions->remove($pos);
            if (null === $this->spyCompanyRoleToPermissionsScheduledForDeletion) {
                $this->spyCompanyRoleToPermissionsScheduledForDeletion = clone $this->collSpyCompanyRoleToPermissions;
                $this->spyCompanyRoleToPermissionsScheduledForDeletion->clear();
            }
            $this->spyCompanyRoleToPermissionsScheduledForDeletion[]= clone $spyCompanyRoleToPermission;
            $spyCompanyRoleToPermission->setCompanyRole(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyRole is new, it will return
     * an empty collection; or if this SpyCompanyRole has previously
     * been saved, it will retrieve related SpyCompanyRoleToPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyRole.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyRoleToPermission[] List of ChildSpyCompanyRoleToPermission objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyRoleToPermission}> List of ChildSpyCompanyRoleToPermission objects
     */
    public function getSpyCompanyRoleToPermissionsJoinPermission(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyRoleToPermissionQuery::create(null, $criteria);
        $query->joinWith('Permission', $joinBehavior);

        return $this->getSpyCompanyRoleToPermissions($query, $con);
    }

    /**
     * Clears out the collSpyCompanyRoleToCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyRoleToCompanyUsers()
     */
    public function clearSpyCompanyRoleToCompanyUsers()
    {
        $this->collSpyCompanyRoleToCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyRoleToCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyRoleToCompanyUsers($v = true): void
    {
        $this->collSpyCompanyRoleToCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyRoleToCompanyUsers collection.
     *
     * By default this just sets the collSpyCompanyRoleToCompanyUsers collection to an empty array (like clearcollSpyCompanyRoleToCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyRoleToCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyRoleToCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyRoleToCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyRoleToCompanyUsers = new $collectionClassName;
        $this->collSpyCompanyRoleToCompanyUsers->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser');
    }

    /**
     * Gets an array of ChildSpyCompanyRoleToCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCompanyRoleToCompanyUser[] List of ChildSpyCompanyRoleToCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyRoleToCompanyUser> List of ChildSpyCompanyRoleToCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyRoleToCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyRoleToCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyRoleToCompanyUsers) {
                    $this->initSpyCompanyRoleToCompanyUsers();
                } else {
                    $collectionClassName = SpyCompanyRoleToCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyRoleToCompanyUsers = new $collectionClassName;
                    $collSpyCompanyRoleToCompanyUsers->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser');

                    return $collSpyCompanyRoleToCompanyUsers;
                }
            } else {
                $collSpyCompanyRoleToCompanyUsers = ChildSpyCompanyRoleToCompanyUserQuery::create(null, $criteria)
                    ->filterByCompanyRole($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyRoleToCompanyUsersPartial && count($collSpyCompanyRoleToCompanyUsers)) {
                        $this->initSpyCompanyRoleToCompanyUsers(false);

                        foreach ($collSpyCompanyRoleToCompanyUsers as $obj) {
                            if (false == $this->collSpyCompanyRoleToCompanyUsers->contains($obj)) {
                                $this->collSpyCompanyRoleToCompanyUsers->append($obj);
                            }
                        }

                        $this->collSpyCompanyRoleToCompanyUsersPartial = true;
                    }

                    return $collSpyCompanyRoleToCompanyUsers;
                }

                if ($partial && $this->collSpyCompanyRoleToCompanyUsers) {
                    foreach ($this->collSpyCompanyRoleToCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyRoleToCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyRoleToCompanyUsers = $collSpyCompanyRoleToCompanyUsers;
                $this->collSpyCompanyRoleToCompanyUsersPartial = false;
            }
        }

        return $this->collSpyCompanyRoleToCompanyUsers;
    }

    /**
     * Sets a collection of ChildSpyCompanyRoleToCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyRoleToCompanyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyRoleToCompanyUsers(Collection $spyCompanyRoleToCompanyUsers, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCompanyRoleToCompanyUser[] $spyCompanyRoleToCompanyUsersToDelete */
        $spyCompanyRoleToCompanyUsersToDelete = $this->getSpyCompanyRoleToCompanyUsers(new Criteria(), $con)->diff($spyCompanyRoleToCompanyUsers);


        $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = $spyCompanyRoleToCompanyUsersToDelete;

        foreach ($spyCompanyRoleToCompanyUsersToDelete as $spyCompanyRoleToCompanyUserRemoved) {
            $spyCompanyRoleToCompanyUserRemoved->setCompanyRole(null);
        }

        $this->collSpyCompanyRoleToCompanyUsers = null;
        foreach ($spyCompanyRoleToCompanyUsers as $spyCompanyRoleToCompanyUser) {
            $this->addSpyCompanyRoleToCompanyUser($spyCompanyRoleToCompanyUser);
        }

        $this->collSpyCompanyRoleToCompanyUsers = $spyCompanyRoleToCompanyUsers;
        $this->collSpyCompanyRoleToCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCompanyRoleToCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCompanyRoleToCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyRoleToCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyRoleToCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyCompanyRoleToCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyRoleToCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyRoleToCompanyUsers());
            }

            $query = ChildSpyCompanyRoleToCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyRole($this)
                ->count($con);
        }

        return count($this->collSpyCompanyRoleToCompanyUsers);
    }

    /**
     * Method called to associate a ChildSpyCompanyRoleToCompanyUser object to this object
     * through the ChildSpyCompanyRoleToCompanyUser foreign key attribute.
     *
     * @param ChildSpyCompanyRoleToCompanyUser $l ChildSpyCompanyRoleToCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyRoleToCompanyUser(ChildSpyCompanyRoleToCompanyUser $l)
    {
        if ($this->collSpyCompanyRoleToCompanyUsers === null) {
            $this->initSpyCompanyRoleToCompanyUsers();
            $this->collSpyCompanyRoleToCompanyUsersPartial = true;
        }

        if (!$this->collSpyCompanyRoleToCompanyUsers->contains($l)) {
            $this->doAddSpyCompanyRoleToCompanyUser($l);

            if ($this->spyCompanyRoleToCompanyUsersScheduledForDeletion and $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->contains($l)) {
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->remove($this->spyCompanyRoleToCompanyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser The ChildSpyCompanyRoleToCompanyUser object to add.
     */
    protected function doAddSpyCompanyRoleToCompanyUser(ChildSpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser): void
    {
        $this->collSpyCompanyRoleToCompanyUsers[]= $spyCompanyRoleToCompanyUser;
        $spyCompanyRoleToCompanyUser->setCompanyRole($this);
    }

    /**
     * @param ChildSpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser The ChildSpyCompanyRoleToCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyRoleToCompanyUser(ChildSpyCompanyRoleToCompanyUser $spyCompanyRoleToCompanyUser)
    {
        if ($this->getSpyCompanyRoleToCompanyUsers()->contains($spyCompanyRoleToCompanyUser)) {
            $pos = $this->collSpyCompanyRoleToCompanyUsers->search($spyCompanyRoleToCompanyUser);
            $this->collSpyCompanyRoleToCompanyUsers->remove($pos);
            if (null === $this->spyCompanyRoleToCompanyUsersScheduledForDeletion) {
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion = clone $this->collSpyCompanyRoleToCompanyUsers;
                $this->spyCompanyRoleToCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyCompanyRoleToCompanyUsersScheduledForDeletion[]= clone $spyCompanyRoleToCompanyUser;
            $spyCompanyRoleToCompanyUser->setCompanyRole(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyRole is new, it will return
     * an empty collection; or if this SpyCompanyRole has previously
     * been saved, it will retrieve related SpyCompanyRoleToCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyRole.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyRoleToCompanyUser[] List of ChildSpyCompanyRoleToCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyRoleToCompanyUser}> List of ChildSpyCompanyRoleToCompanyUser objects
     */
    public function getSpyCompanyRoleToCompanyUsersJoinCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyRoleToCompanyUserQuery::create(null, $criteria);
        $query->joinWith('CompanyUser', $joinBehavior);

        return $this->getSpyCompanyRoleToCompanyUsers($query, $con);
    }

    /**
     * Clears out the collPermissionIdCompanyRoleToPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPermissionIdCompanyRoleToPermissions()
     */
    public function clearPermissionIdCompanyRoleToPermissions()
    {
        $this->collPermissionIdCompanyRoleToPermissions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the combinationCollPermissionIdCompanyRoleToPermissions crossRef collection.
     *
     * By default this just sets the combinationCollPermissionIdCompanyRoleToPermissions collection to an empty collection (like clearPermissionIdCompanyRoleToPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPermissionIdCompanyRoleToPermissions()
    {
        $this->combinationCollPermissionIdCompanyRoleToPermissions = new ObjectCombinationCollection;
        $this->combinationCollPermissionIdCompanyRoleToPermissionsPartial = true;
    }

    /**
     * Checks if the combinationCollPermissionIdCompanyRoleToPermissions collection is loaded.
     *
     * @return bool
     */
    public function isPermissionIdCompanyRoleToPermissionsLoaded(): bool
    {
        return null !== $this->combinationCollPermissionIdCompanyRoleToPermissions;
    }

    /**
     * Returns a new query object pre configured with filters from current object and given arguments to query the database.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     *
     * @return SpyPermissionQuery
     */
    public function createPermissionsQuery($idCompanyRoleToPermission = null, ?Criteria $criteria = null)
    {
        $criteria = SpyPermissionQuery::create($criteria)
            ->filterByCompanyRole($this);

        $spyCompanyRoleToPermissionQuery = $criteria->useSpyCompanyRoleToPermissionQuery();

        if (null !== $idCompanyRoleToPermission) {
            $spyCompanyRoleToPermissionQuery->filterByIdCompanyRoleToPermission($idCompanyRoleToPermission);
        }

        $spyCompanyRoleToPermissionQuery->endUse();

        return $criteria;
    }

    /**
     * Gets a combined collection of SpyPermission objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyRole is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCombinationCollection Combination list of SpyPermission objects
     */
    public function getPermissionIdCompanyRoleToPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollPermissionIdCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->combinationCollPermissionIdCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->combinationCollPermissionIdCompanyRoleToPermissions) {
                    $this->initPermissionIdCompanyRoleToPermissions();
                }
            } else {

                $query = ChildSpyCompanyRoleToPermissionQuery::create(null, $criteria)
                    ->filterByCompanyRole($this)
                    ->joinPermission()
                ;

                $items = $query->find($con);
                $combinationCollPermissionIdCompanyRoleToPermissions = new ObjectCombinationCollection();
                foreach ($items as $item) {
                    $combination = [];

                    $combination[] = $item->getPermission();
                    $combination[] = $item->getIdCompanyRoleToPermission();
                    $combinationCollPermissionIdCompanyRoleToPermissions[] = $combination;
                }

                if (null !== $criteria) {
                    return $combinationCollPermissionIdCompanyRoleToPermissions;
                }

                if ($partial && $this->combinationCollPermissionIdCompanyRoleToPermissions) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->combinationCollPermissionIdCompanyRoleToPermissions as $obj) {
                        if (!$combinationCollPermissionIdCompanyRoleToPermissions->contains(...$obj)) {
                            $combinationCollPermissionIdCompanyRoleToPermissions[] = $obj;
                        }
                    }
                }

                $this->combinationCollPermissionIdCompanyRoleToPermissions = $combinationCollPermissionIdCompanyRoleToPermissions;
                $this->combinationCollPermissionIdCompanyRoleToPermissionsPartial = false;
            }
        }

        return $this->combinationCollPermissionIdCompanyRoleToPermissions;
    }

    /**
     * Returns a not cached ObjectCollection of SpyPermission objects. This will hit always the databases.
     * If you have attached new SpyPermission object to this object you need to call `save` first to get
     * the correct return value. Use getPermissionIdCompanyRoleToPermissions() to get the current internal state.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return SpyPermission[]|ObjectCollection
     * @phpstan-return ObjectCollection&\Traversable<SpyPermission>
     */
    public function getPermissions($idCompanyRoleToPermission = null, ?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        return $this->createPermissionsQuery($idCompanyRoleToPermission, $criteria)->find($con);
    }

    /**
     * Sets a collection of ChildSpyPermission objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $permissionIdCompanyRoleToPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPermissionIdCompanyRoleToPermissions(Collection $permissionIdCompanyRoleToPermissions, ?ConnectionInterface $con = null)
    {
        $this->clearPermissionIdCompanyRoleToPermissions();
        $currentPermissionIdCompanyRoleToPermissions = $this->getPermissionIdCompanyRoleToPermissions();

        $combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion = $currentPermissionIdCompanyRoleToPermissions->diff($permissionIdCompanyRoleToPermissions);

        foreach ($combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion as $toDelete) {
            $this->removePermissionIdCompanyRoleToPermission(...$toDelete);
        }

        foreach ($permissionIdCompanyRoleToPermissions as $permissionIdCompanyRoleToPermission) {
            if (!$currentPermissionIdCompanyRoleToPermissions->contains(...$permissionIdCompanyRoleToPermission)) {
                $this->doAddPermissionIdCompanyRoleToPermission(...$permissionIdCompanyRoleToPermission);
            }
        }

        $this->combinationCollPermissionIdCompanyRoleToPermissionsPartial = false;
        $this->combinationCollPermissionIdCompanyRoleToPermissions = $permissionIdCompanyRoleToPermissions;

        return $this;
    }

    /**
     * Gets the number of ChildSpyPermission objects related by a many-to-many relationship
     * to the current object by way of the spy_company_role_to_permission cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related ChildSpyPermission objects
     */
    public function countPermissionIdCompanyRoleToPermissions(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->combinationCollPermissionIdCompanyRoleToPermissionsPartial && !$this->isNew();
        if (null === $this->combinationCollPermissionIdCompanyRoleToPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->combinationCollPermissionIdCompanyRoleToPermissions) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getPermissionIdCompanyRoleToPermissions());
                }

                $query = ChildSpyCompanyRoleToPermissionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCompanyRole($this)
                    ->count($con);
            }
        } else {
            return count($this->combinationCollPermissionIdCompanyRoleToPermissions);
        }
    }

    /**
     * Returns the not cached count of SpyPermission objects. This will hit always the databases.
     * If you have attached new SpyPermission object to this object you need to call `save` first to get
     * the correct return value. Use getPermissionIdCompanyRoleToPermissions() to get the current internal state.
     *
     * @param int $idCompanyRoleToPermission
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return int
     */
    public function countPermissions($idCompanyRoleToPermission = null, ?Criteria $criteria = null, ?ConnectionInterface $con = null): int
    {
        return $this->createPermissionsQuery($idCompanyRoleToPermission, $criteria)->count($con);
    }

    /**
     * Associate a SpyPermission to this object
     * through the spy_company_role_to_permission cross reference table.
     *
     * @param SpyPermission $permission,
     * @param int $idCompanyRoleToPermission
     * @return ChildSpyCompanyRole The current object (for fluent API support)
     */
    public function addPermission(SpyPermission $permission, $idCompanyRoleToPermission)
    {
        if ($this->combinationCollPermissionIdCompanyRoleToPermissions === null) {
            $this->initPermissionIdCompanyRoleToPermissions();
        }

        if (!$this->getPermissionIdCompanyRoleToPermissions()->contains($permission, $idCompanyRoleToPermission)) {
            // only add it if the **same** object is not already associated
            $this->combinationCollPermissionIdCompanyRoleToPermissions->push($permission, $idCompanyRoleToPermission);
            $this->doAddPermissionIdCompanyRoleToPermission($permission, $idCompanyRoleToPermission);
        }

        return $this;
    }

    /**
     *
     * @param SpyPermission $permission,
     * @param int $idCompanyRoleToPermission
     */
    protected function doAddPermissionIdCompanyRoleToPermission(SpyPermission $permission, $idCompanyRoleToPermission)
    {
        $spyCompanyRoleToPermission = new ChildSpyCompanyRoleToPermission();

        $spyCompanyRoleToPermission->setPermission($permission);
        $spyCompanyRoleToPermission->setIdCompanyRoleToPermission($idCompanyRoleToPermission);


        $spyCompanyRoleToPermission->setCompanyRole($this);

        $this->addSpyCompanyRoleToPermission($spyCompanyRoleToPermission);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if ($permission->isCompanyRoleIdCompanyRoleToPermissionsLoaded()) {
            $permission->initCompanyRoleIdCompanyRoleToPermissions();
            $permission->getCompanyRoleIdCompanyRoleToPermissions()->push($this, $idCompanyRoleToPermission);
        } elseif (!$permission->getCompanyRoleIdCompanyRoleToPermissions()->contains($this, $idCompanyRoleToPermission)) {
            $permission->getCompanyRoleIdCompanyRoleToPermissions()->push($this, $idCompanyRoleToPermission);
        }

    }

    /**
     * Remove permission, idCompanyRoleToPermission of this object
     * through the spy_company_role_to_permission cross reference table.
     *
     * @param SpyPermission $permission,
     * @param int $idCompanyRoleToPermission
     * @return ChildSpyCompanyRole The current object (for fluent API support)
     */
    public function removePermissionIdCompanyRoleToPermission(SpyPermission $permission, $idCompanyRoleToPermission)
    {
        if ($this->getPermissionIdCompanyRoleToPermissions()->contains($permission, $idCompanyRoleToPermission)) {
            $spyCompanyRoleToPermission = new ChildSpyCompanyRoleToPermission();
            $spyCompanyRoleToPermission->setPermission($permission);
            if ($permission->isCompanyRoleIdCompanyRoleToPermissionsLoaded()) {
                //remove the back reference if available
                $permission->getCompanyRoleIdCompanyRoleToPermissions()->removeObject($this, $idCompanyRoleToPermission);
            }

            $spyCompanyRoleToPermission->setIdCompanyRoleToPermission($idCompanyRoleToPermission);
            $spyCompanyRoleToPermission->setCompanyRole($this);
            $this->removeSpyCompanyRoleToPermission(clone $spyCompanyRoleToPermission);
            $spyCompanyRoleToPermission->clear();

            $this->combinationCollPermissionIdCompanyRoleToPermissions->remove($this->combinationCollPermissionIdCompanyRoleToPermissions->search($permission, $idCompanyRoleToPermission));

            if (null === $this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion) {
                $this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion = clone $this->combinationCollPermissionIdCompanyRoleToPermissions;
                $this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion->clear();
            }

            $this->combinationCollPermissionIdCompanyRoleToPermissionsScheduledForDeletion->push($permission, $idCompanyRoleToPermission);
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
        if (null !== $this->aCompany) {
            $this->aCompany->removeCompanyRole($this);
        }
        $this->id_company_role = null;
        $this->fk_company = null;
        $this->is_default = null;
        $this->key = null;
        $this->name = null;
        $this->uuid = null;
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
            if ($this->collSpyCompanyRoleToPermissions) {
                foreach ($this->collSpyCompanyRoleToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyRoleToCompanyUsers) {
                foreach ($this->collSpyCompanyRoleToCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->combinationCollPermissionIdCompanyRoleToPermissions) {
                foreach ($this->combinationCollPermissionIdCompanyRoleToPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyRoleToPermissions = null;
        $this->collSpyCompanyRoleToCompanyUsers = null;
        $this->combinationCollPermissionIdCompanyRoleToPermissions = null;
        $this->aCompany = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCompanyRoleTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_company_role' . '.' . $this->getIdCompanyRole() . '.' . $this->getFkCompany();
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
