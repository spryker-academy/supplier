<?php

namespace Orm\Zed\Company\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnit as BaseSpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRole as BaseSpyCompanyRole;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddress as BaseSpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUser as BaseSpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Company\Persistence\SpyCompany as ChildSpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery as ChildSpyCompanyQuery;
use Orm\Zed\Company\Persistence\SpyCompanyStore as ChildSpyCompanyStore;
use Orm\Zed\Company\Persistence\SpyCompanyStoreQuery as ChildSpyCompanyStoreQuery;
use Orm\Zed\Company\Persistence\Map\SpyCompanyStoreTableMap;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
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
 * Base class that represents a row from the 'spy_company' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Company.Persistence.Base
 */
abstract class SpyCompany implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Company\\Persistence\\Map\\SpyCompanyTableMap';


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
     * The value for the id_company field.
     *
     * @var        int
     */
    protected $id_company;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the key field.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
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
     * The value for the status field.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        ObjectCollection|ChildSpyCompanyStore[] Collection to store aggregation of ChildSpyCompanyStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyStore> Collection to store aggregation of ChildSpyCompanyStore objects.
     */
    protected $collSpyCompanyStores;
    protected $collSpyCompanyStoresPartial;

    /**
     * @var        ObjectCollection|SpyCompanyBusinessUnit[] Collection to store aggregation of SpyCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnit> Collection to store aggregation of SpyCompanyBusinessUnit objects.
     */
    protected $collCompanyBusinessUnits;
    protected $collCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpyCompanyRole[] Collection to store aggregation of SpyCompanyRole objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRole> Collection to store aggregation of SpyCompanyRole objects.
     */
    protected $collCompanyRoles;
    protected $collCompanyRolesPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUnitAddress[] Collection to store aggregation of SpyCompanyUnitAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddress> Collection to store aggregation of SpyCompanyUnitAddress objects.
     */
    protected $collCompanyUnitAddresses;
    protected $collCompanyUnitAddressesPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUser[] Collection to store aggregation of SpyCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser> Collection to store aggregation of SpyCompanyUser objects.
     */
    protected $collCompanyUsers;
    protected $collCompanyUsersPartial;

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
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCompanyStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyStore>
     */
    protected $spyCompanyStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnit>
     */
    protected $companyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyRole[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyRole>
     */
    protected $companyRolesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUnitAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddress>
     */
    protected $companyUnitAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUser>
     */
    protected $companyUsersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
        $this->status = 0;
    }

    /**
     * Initializes internal state of Orm\Zed\Company\Persistence\Base\SpyCompany object.
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
     * Compares this with another <code>SpyCompany</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCompany</code>, delegates to
     * <code>equals(SpyCompany)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_company] column value.
     *
     * @return int
     */
    public function getIdCompany()
    {
        return $this->id_company;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [key] column value.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
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
     * Get the [status] column value.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStatus()
    {
        if (null === $this->status) {
            return null;
        }
        $valueSet = SpyCompanyTableMap::getValueSet(SpyCompanyTableMap::COL_STATUS);
        if (!isset($valueSet[$this->status])) {
            throw new PropelException('Unknown stored enum key: ' . $this->status);
        }

        return $valueSet[$this->status];
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
     * Set the value of [id_company] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCompany($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_company !== $v) {
            $this->id_company = $v;
            $this->modifiedColumns[SpyCompanyTableMap::COL_ID_COMPANY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A boolean flag indicating if an entity is currently active.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        $this->_initialValues[SpyCompanyTableMap::COL_IS_ACTIVE] = $this->is_active;

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

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyCompanyTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
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
            $this->modifiedColumns[SpyCompanyTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyCompanyTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     * The current status of an entity (e.g., "active", "pending", "approved").
     * @param string $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStatus($v)
    {
        $this->_initialValues[SpyCompanyTableMap::COL_STATUS] = $this->status;

        if ($v !== null) {
            $valueSet = SpyCompanyTableMap::getValueSet(SpyCompanyTableMap::COL_STATUS);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[SpyCompanyTableMap::COL_STATUS] = true;
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
            $this->modifiedColumns[SpyCompanyTableMap::COL_UUID] = true;
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
            if ($this->is_active !== false) {
                return false;
            }

            if ($this->status !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCompanyTableMap::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCompanyTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCompanyTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCompanyTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCompanyTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCompanyTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyCompanyTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Company\\Persistence\\SpyCompany'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCompanyTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCompanyQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyCompanyStores = null;

            $this->collCompanyBusinessUnits = null;

            $this->collCompanyRoles = null;

            $this->collCompanyUnitAddresses = null;

            $this->collCompanyUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCompany::setDeleted()
     * @see SpyCompany::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCompanyQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyTableMap::DATABASE_NAME);
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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyCompanyTableMap::addInstanceToPool($this);
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

            if ($this->spyCompanyStoresScheduledForDeletion !== null) {
                if (!$this->spyCompanyStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyStores !== null) {
                foreach ($this->collSpyCompanyStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->companyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->companyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->companyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyBusinessUnits !== null) {
                foreach ($this->collCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyRolesScheduledForDeletion !== null) {
                if (!$this->companyRolesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery::create()
                        ->filterByPrimaryKeys($this->companyRolesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->companyRolesScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyRoles !== null) {
                foreach ($this->collCompanyRoles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyUnitAddressesScheduledForDeletion !== null) {
                if (!$this->companyUnitAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->companyUnitAddressesScheduledForDeletion as $companyUnitAddress) {
                        // need to save related object because we set the relation to null
                        $companyUnitAddress->save($con);
                    }
                    $this->companyUnitAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyUnitAddresses !== null) {
                foreach ($this->collCompanyUnitAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companyUsersScheduledForDeletion !== null) {
                if (!$this->companyUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery::create()
                        ->filterByPrimaryKeys($this->companyUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->companyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyUsers !== null) {
                foreach ($this->collCompanyUsers as $referrerFK) {
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

        $this->modifiedColumns[SpyCompanyTableMap::COL_ID_COMPANY] = true;
        if (null !== $this->id_company) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCompanyTableMap::COL_ID_COMPANY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCompanyTableMap::COL_ID_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`id_company`';
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_company` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_company`':
                        $stmt->bindValue($identifier, $this->id_company, PDO::PARAM_INT);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_company_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCompany($pk);

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
        $pos = SpyCompanyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCompany();

            case 1:
                return $this->getIsActive();

            case 2:
                return $this->getKey();

            case 3:
                return $this->getName();

            case 4:
                return $this->getStatus();

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
        if (isset($alreadyDumpedObjects['SpyCompany'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCompany'][$this->hashCode()] = true;
        $keys = SpyCompanyTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCompany(),
            $keys[1] => $this->getIsActive(),
            $keys[2] => $this->getKey(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyCompanyStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_stores';
                        break;
                    default:
                        $key = 'SpyCompanyStores';
                }

                $result[$key] = $this->collSpyCompanyStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_units';
                        break;
                    default:
                        $key = 'CompanyBusinessUnits';
                }

                $result[$key] = $this->collCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompanyRoles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyRoles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_roles';
                        break;
                    default:
                        $key = 'CompanyRoles';
                }

                $result[$key] = $this->collCompanyRoles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompanyUnitAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_addresses';
                        break;
                    default:
                        $key = 'CompanyUnitAddresses';
                }

                $result[$key] = $this->collCompanyUnitAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_users';
                        break;
                    default:
                        $key = 'CompanyUsers';
                }

                $result[$key] = $this->collCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCompanyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCompany($value);
                break;
            case 1:
                $this->setIsActive($value);
                break;
            case 2:
                $this->setKey($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $valueSet = SpyCompanyTableMap::getValueSet(SpyCompanyTableMap::COL_STATUS);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setStatus($value);
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
        $keys = SpyCompanyTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCompany($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyCompanyTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCompanyTableMap::COL_ID_COMPANY)) {
            $criteria->add(SpyCompanyTableMap::COL_ID_COMPANY, $this->id_company);
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyCompanyTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_KEY)) {
            $criteria->add(SpyCompanyTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_NAME)) {
            $criteria->add(SpyCompanyTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_STATUS)) {
            $criteria->add(SpyCompanyTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SpyCompanyTableMap::COL_UUID)) {
            $criteria->add(SpyCompanyTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyCompanyQuery::create();
        $criteria->add(SpyCompanyTableMap::COL_ID_COMPANY, $this->id_company);

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
        $validPk = null !== $this->getIdCompany();

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
        return $this->getIdCompany();
    }

    /**
     * Generic method to set the primary key (id_company column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCompany($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCompany();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Company\Persistence\SpyCompany (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyRoles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyRole($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyUnitAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyUnitAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCompany(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Company\Persistence\SpyCompany Clone of current object.
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
        if ('SpyCompanyStore' === $relationName) {
            $this->initSpyCompanyStores();
            return;
        }
        if ('CompanyBusinessUnit' === $relationName) {
            $this->initCompanyBusinessUnits();
            return;
        }
        if ('CompanyRole' === $relationName) {
            $this->initCompanyRoles();
            return;
        }
        if ('CompanyUnitAddress' === $relationName) {
            $this->initCompanyUnitAddresses();
            return;
        }
        if ('CompanyUser' === $relationName) {
            $this->initCompanyUsers();
            return;
        }
    }

    /**
     * Clears out the collSpyCompanyStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyStores()
     */
    public function clearSpyCompanyStores()
    {
        $this->collSpyCompanyStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyStores($v = true): void
    {
        $this->collSpyCompanyStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyStores collection.
     *
     * By default this just sets the collSpyCompanyStores collection to an empty array (like clearcollSpyCompanyStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyStores = new $collectionClassName;
        $this->collSpyCompanyStores->setModel('\Orm\Zed\Company\Persistence\SpyCompanyStore');
    }

    /**
     * Gets an array of ChildSpyCompanyStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompany is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCompanyStore[] List of ChildSpyCompanyStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyStore> List of ChildSpyCompanyStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyStoresPartial && !$this->isNew();
        if (null === $this->collSpyCompanyStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyStores) {
                    $this->initSpyCompanyStores();
                } else {
                    $collectionClassName = SpyCompanyStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyStores = new $collectionClassName;
                    $collSpyCompanyStores->setModel('\Orm\Zed\Company\Persistence\SpyCompanyStore');

                    return $collSpyCompanyStores;
                }
            } else {
                $collSpyCompanyStores = ChildSpyCompanyStoreQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyStoresPartial && count($collSpyCompanyStores)) {
                        $this->initSpyCompanyStores(false);

                        foreach ($collSpyCompanyStores as $obj) {
                            if (false == $this->collSpyCompanyStores->contains($obj)) {
                                $this->collSpyCompanyStores->append($obj);
                            }
                        }

                        $this->collSpyCompanyStoresPartial = true;
                    }

                    return $collSpyCompanyStores;
                }

                if ($partial && $this->collSpyCompanyStores) {
                    foreach ($this->collSpyCompanyStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyStores = $collSpyCompanyStores;
                $this->collSpyCompanyStoresPartial = false;
            }
        }

        return $this->collSpyCompanyStores;
    }

    /**
     * Sets a collection of ChildSpyCompanyStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyStores(Collection $spyCompanyStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCompanyStore[] $spyCompanyStoresToDelete */
        $spyCompanyStoresToDelete = $this->getSpyCompanyStores(new Criteria(), $con)->diff($spyCompanyStores);


        $this->spyCompanyStoresScheduledForDeletion = $spyCompanyStoresToDelete;

        foreach ($spyCompanyStoresToDelete as $spyCompanyStoreRemoved) {
            $spyCompanyStoreRemoved->setCompany(null);
        }

        $this->collSpyCompanyStores = null;
        foreach ($spyCompanyStores as $spyCompanyStore) {
            $this->addSpyCompanyStore($spyCompanyStore);
        }

        $this->collSpyCompanyStores = $spyCompanyStores;
        $this->collSpyCompanyStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCompanyStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCompanyStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyStoresPartial && !$this->isNew();
        if (null === $this->collSpyCompanyStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyStores());
            }

            $query = ChildSpyCompanyStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collSpyCompanyStores);
    }

    /**
     * Method called to associate a ChildSpyCompanyStore object to this object
     * through the ChildSpyCompanyStore foreign key attribute.
     *
     * @param ChildSpyCompanyStore $l ChildSpyCompanyStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyStore(ChildSpyCompanyStore $l)
    {
        if ($this->collSpyCompanyStores === null) {
            $this->initSpyCompanyStores();
            $this->collSpyCompanyStoresPartial = true;
        }

        if (!$this->collSpyCompanyStores->contains($l)) {
            $this->doAddSpyCompanyStore($l);

            if ($this->spyCompanyStoresScheduledForDeletion and $this->spyCompanyStoresScheduledForDeletion->contains($l)) {
                $this->spyCompanyStoresScheduledForDeletion->remove($this->spyCompanyStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCompanyStore $spyCompanyStore The ChildSpyCompanyStore object to add.
     */
    protected function doAddSpyCompanyStore(ChildSpyCompanyStore $spyCompanyStore): void
    {
        $this->collSpyCompanyStores[]= $spyCompanyStore;
        $spyCompanyStore->setCompany($this);
    }

    /**
     * @param ChildSpyCompanyStore $spyCompanyStore The ChildSpyCompanyStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyStore(ChildSpyCompanyStore $spyCompanyStore)
    {
        if ($this->getSpyCompanyStores()->contains($spyCompanyStore)) {
            $pos = $this->collSpyCompanyStores->search($spyCompanyStore);
            $this->collSpyCompanyStores->remove($pos);
            if (null === $this->spyCompanyStoresScheduledForDeletion) {
                $this->spyCompanyStoresScheduledForDeletion = clone $this->collSpyCompanyStores;
                $this->spyCompanyStoresScheduledForDeletion->clear();
            }
            $this->spyCompanyStoresScheduledForDeletion[]= clone $spyCompanyStore;
            $spyCompanyStore->setCompany(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related SpyCompanyStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyStore[] List of ChildSpyCompanyStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyStore}> List of ChildSpyCompanyStore objects
     */
    public function getSpyCompanyStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getSpyCompanyStores($query, $con);
    }

    /**
     * Clears out the collCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyBusinessUnits()
     */
    public function clearCompanyBusinessUnits()
    {
        $this->collCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyBusinessUnits($v = true): void
    {
        $this->collCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collCompanyBusinessUnits collection.
     *
     * By default this just sets the collCompanyBusinessUnits collection to an empty array (like clearcollCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyBusinessUnits = new $collectionClassName;
        $this->collCompanyBusinessUnits->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompany is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit> List of SpyCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyBusinessUnits) {
                    $this->initCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyBusinessUnits = new $collectionClassName;
                    $collCompanyBusinessUnits->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');

                    return $collCompanyBusinessUnits;
                }
            } else {
                $collCompanyBusinessUnits = SpyCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyBusinessUnitsPartial && count($collCompanyBusinessUnits)) {
                        $this->initCompanyBusinessUnits(false);

                        foreach ($collCompanyBusinessUnits as $obj) {
                            if (false == $this->collCompanyBusinessUnits->contains($obj)) {
                                $this->collCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collCompanyBusinessUnitsPartial = true;
                    }

                    return $collCompanyBusinessUnits;
                }

                if ($partial && $this->collCompanyBusinessUnits) {
                    foreach ($this->collCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collCompanyBusinessUnits = $collCompanyBusinessUnits;
                $this->collCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyBusinessUnits(Collection $companyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyBusinessUnit[] $companyBusinessUnitsToDelete */
        $companyBusinessUnitsToDelete = $this->getCompanyBusinessUnits(new Criteria(), $con)->diff($companyBusinessUnits);


        $this->companyBusinessUnitsScheduledForDeletion = $companyBusinessUnitsToDelete;

        foreach ($companyBusinessUnitsToDelete as $companyBusinessUnitRemoved) {
            $companyBusinessUnitRemoved->setCompany(null);
        }

        $this->collCompanyBusinessUnits = null;
        foreach ($companyBusinessUnits as $companyBusinessUnit) {
            $this->addCompanyBusinessUnit($companyBusinessUnit);
        }

        $this->collCompanyBusinessUnits = $companyBusinessUnits;
        $this->collCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyBusinessUnits());
            }

            $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyCompanyBusinessUnit object to this object
     * through the SpyCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyCompanyBusinessUnit $l SpyCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyBusinessUnit(SpyCompanyBusinessUnit $l)
    {
        if ($this->collCompanyBusinessUnits === null) {
            $this->initCompanyBusinessUnits();
            $this->collCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collCompanyBusinessUnits->contains($l)) {
            $this->doAddCompanyBusinessUnit($l);

            if ($this->companyBusinessUnitsScheduledForDeletion and $this->companyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->companyBusinessUnitsScheduledForDeletion->remove($this->companyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyBusinessUnit $companyBusinessUnit The SpyCompanyBusinessUnit object to add.
     */
    protected function doAddCompanyBusinessUnit(SpyCompanyBusinessUnit $companyBusinessUnit): void
    {
        $this->collCompanyBusinessUnits[]= $companyBusinessUnit;
        $companyBusinessUnit->setCompany($this);
    }

    /**
     * @param SpyCompanyBusinessUnit $companyBusinessUnit The SpyCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyBusinessUnit(SpyCompanyBusinessUnit $companyBusinessUnit)
    {
        if ($this->getCompanyBusinessUnits()->contains($companyBusinessUnit)) {
            $pos = $this->collCompanyBusinessUnits->search($companyBusinessUnit);
            $this->collCompanyBusinessUnits->remove($pos);
            if (null === $this->companyBusinessUnitsScheduledForDeletion) {
                $this->companyBusinessUnitsScheduledForDeletion = clone $this->collCompanyBusinessUnits;
                $this->companyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->companyBusinessUnitsScheduledForDeletion[]= clone $companyBusinessUnit;
            $companyBusinessUnit->setCompany(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit}> List of SpyCompanyBusinessUnit objects
     */
    public function getCompanyBusinessUnitsJoinParentCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('ParentCompanyBusinessUnit', $joinBehavior);

        return $this->getCompanyBusinessUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit}> List of SpyCompanyBusinessUnit objects
     */
    public function getCompanyBusinessUnitsJoinCompanyBusinessUnitDefaultBillingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnitDefaultBillingAddress', $joinBehavior);

        return $this->getCompanyBusinessUnits($query, $con);
    }

    /**
     * Clears out the collCompanyRoles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyRoles()
     */
    public function clearCompanyRoles()
    {
        $this->collCompanyRoles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyRoles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyRoles($v = true): void
    {
        $this->collCompanyRolesPartial = $v;
    }

    /**
     * Initializes the collCompanyRoles collection.
     *
     * By default this just sets the collCompanyRoles collection to an empty array (like clearcollCompanyRoles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyRoles(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyRoles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyRoleTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyRoles = new $collectionClassName;
        $this->collCompanyRoles->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRole');
    }

    /**
     * Gets an array of SpyCompanyRole objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompany is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyRole[] List of SpyCompanyRole objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyRole> List of SpyCompanyRole objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyRoles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyRolesPartial && !$this->isNew();
        if (null === $this->collCompanyRoles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyRoles) {
                    $this->initCompanyRoles();
                } else {
                    $collectionClassName = SpyCompanyRoleTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyRoles = new $collectionClassName;
                    $collCompanyRoles->setModel('\Orm\Zed\CompanyRole\Persistence\SpyCompanyRole');

                    return $collCompanyRoles;
                }
            } else {
                $collCompanyRoles = SpyCompanyRoleQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyRolesPartial && count($collCompanyRoles)) {
                        $this->initCompanyRoles(false);

                        foreach ($collCompanyRoles as $obj) {
                            if (false == $this->collCompanyRoles->contains($obj)) {
                                $this->collCompanyRoles->append($obj);
                            }
                        }

                        $this->collCompanyRolesPartial = true;
                    }

                    return $collCompanyRoles;
                }

                if ($partial && $this->collCompanyRoles) {
                    foreach ($this->collCompanyRoles as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyRoles[] = $obj;
                        }
                    }
                }

                $this->collCompanyRoles = $collCompanyRoles;
                $this->collCompanyRolesPartial = false;
            }
        }

        return $this->collCompanyRoles;
    }

    /**
     * Sets a collection of SpyCompanyRole objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyRoles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyRoles(Collection $companyRoles, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyRole[] $companyRolesToDelete */
        $companyRolesToDelete = $this->getCompanyRoles(new Criteria(), $con)->diff($companyRoles);


        $this->companyRolesScheduledForDeletion = $companyRolesToDelete;

        foreach ($companyRolesToDelete as $companyRoleRemoved) {
            $companyRoleRemoved->setCompany(null);
        }

        $this->collCompanyRoles = null;
        foreach ($companyRoles as $companyRole) {
            $this->addCompanyRole($companyRole);
        }

        $this->collCompanyRoles = $companyRoles;
        $this->collCompanyRolesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyRole objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyRole objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyRoles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyRolesPartial && !$this->isNew();
        if (null === $this->collCompanyRoles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyRoles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyRoles());
            }

            $query = SpyCompanyRoleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collCompanyRoles);
    }

    /**
     * Method called to associate a SpyCompanyRole object to this object
     * through the SpyCompanyRole foreign key attribute.
     *
     * @param SpyCompanyRole $l SpyCompanyRole
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyRole(SpyCompanyRole $l)
    {
        if ($this->collCompanyRoles === null) {
            $this->initCompanyRoles();
            $this->collCompanyRolesPartial = true;
        }

        if (!$this->collCompanyRoles->contains($l)) {
            $this->doAddCompanyRole($l);

            if ($this->companyRolesScheduledForDeletion and $this->companyRolesScheduledForDeletion->contains($l)) {
                $this->companyRolesScheduledForDeletion->remove($this->companyRolesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyRole $companyRole The SpyCompanyRole object to add.
     */
    protected function doAddCompanyRole(SpyCompanyRole $companyRole): void
    {
        $this->collCompanyRoles[]= $companyRole;
        $companyRole->setCompany($this);
    }

    /**
     * @param SpyCompanyRole $companyRole The SpyCompanyRole object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyRole(SpyCompanyRole $companyRole)
    {
        if ($this->getCompanyRoles()->contains($companyRole)) {
            $pos = $this->collCompanyRoles->search($companyRole);
            $this->collCompanyRoles->remove($pos);
            if (null === $this->companyRolesScheduledForDeletion) {
                $this->companyRolesScheduledForDeletion = clone $this->collCompanyRoles;
                $this->companyRolesScheduledForDeletion->clear();
            }
            $this->companyRolesScheduledForDeletion[]= clone $companyRole;
            $companyRole->setCompany(null);
        }

        return $this;
    }

    /**
     * Clears out the collCompanyUnitAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyUnitAddresses()
     */
    public function clearCompanyUnitAddresses()
    {
        $this->collCompanyUnitAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyUnitAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyUnitAddresses($v = true): void
    {
        $this->collCompanyUnitAddressesPartial = $v;
    }

    /**
     * Initializes the collCompanyUnitAddresses collection.
     *
     * By default this just sets the collCompanyUnitAddresses collection to an empty array (like clearcollCompanyUnitAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyUnitAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyUnitAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyUnitAddresses = new $collectionClassName;
        $this->collCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress');
    }

    /**
     * Gets an array of SpyCompanyUnitAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompany is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress> List of SpyCompanyUnitAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyUnitAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyUnitAddresses) {
                    $this->initCompanyUnitAddresses();
                } else {
                    $collectionClassName = SpyCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyUnitAddresses = new $collectionClassName;
                    $collCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress');

                    return $collCompanyUnitAddresses;
                }
            } else {
                $collCompanyUnitAddresses = SpyCompanyUnitAddressQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyUnitAddressesPartial && count($collCompanyUnitAddresses)) {
                        $this->initCompanyUnitAddresses(false);

                        foreach ($collCompanyUnitAddresses as $obj) {
                            if (false == $this->collCompanyUnitAddresses->contains($obj)) {
                                $this->collCompanyUnitAddresses->append($obj);
                            }
                        }

                        $this->collCompanyUnitAddressesPartial = true;
                    }

                    return $collCompanyUnitAddresses;
                }

                if ($partial && $this->collCompanyUnitAddresses) {
                    foreach ($this->collCompanyUnitAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyUnitAddresses[] = $obj;
                        }
                    }
                }

                $this->collCompanyUnitAddresses = $collCompanyUnitAddresses;
                $this->collCompanyUnitAddressesPartial = false;
            }
        }

        return $this->collCompanyUnitAddresses;
    }

    /**
     * Sets a collection of SpyCompanyUnitAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyUnitAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyUnitAddresses(Collection $companyUnitAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUnitAddress[] $companyUnitAddressesToDelete */
        $companyUnitAddressesToDelete = $this->getCompanyUnitAddresses(new Criteria(), $con)->diff($companyUnitAddresses);


        $this->companyUnitAddressesScheduledForDeletion = $companyUnitAddressesToDelete;

        foreach ($companyUnitAddressesToDelete as $companyUnitAddressRemoved) {
            $companyUnitAddressRemoved->setCompany(null);
        }

        $this->collCompanyUnitAddresses = null;
        foreach ($companyUnitAddresses as $companyUnitAddress) {
            $this->addCompanyUnitAddress($companyUnitAddress);
        }

        $this->collCompanyUnitAddresses = $companyUnitAddresses;
        $this->collCompanyUnitAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUnitAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUnitAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyUnitAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyUnitAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyUnitAddresses());
            }

            $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collCompanyUnitAddresses);
    }

    /**
     * Method called to associate a SpyCompanyUnitAddress object to this object
     * through the SpyCompanyUnitAddress foreign key attribute.
     *
     * @param SpyCompanyUnitAddress $l SpyCompanyUnitAddress
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyUnitAddress(SpyCompanyUnitAddress $l)
    {
        if ($this->collCompanyUnitAddresses === null) {
            $this->initCompanyUnitAddresses();
            $this->collCompanyUnitAddressesPartial = true;
        }

        if (!$this->collCompanyUnitAddresses->contains($l)) {
            $this->doAddCompanyUnitAddress($l);

            if ($this->companyUnitAddressesScheduledForDeletion and $this->companyUnitAddressesScheduledForDeletion->contains($l)) {
                $this->companyUnitAddressesScheduledForDeletion->remove($this->companyUnitAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUnitAddress $companyUnitAddress The SpyCompanyUnitAddress object to add.
     */
    protected function doAddCompanyUnitAddress(SpyCompanyUnitAddress $companyUnitAddress): void
    {
        $this->collCompanyUnitAddresses[]= $companyUnitAddress;
        $companyUnitAddress->setCompany($this);
    }

    /**
     * @param SpyCompanyUnitAddress $companyUnitAddress The SpyCompanyUnitAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyUnitAddress(SpyCompanyUnitAddress $companyUnitAddress)
    {
        if ($this->getCompanyUnitAddresses()->contains($companyUnitAddress)) {
            $pos = $this->collCompanyUnitAddresses->search($companyUnitAddress);
            $this->collCompanyUnitAddresses->remove($pos);
            if (null === $this->companyUnitAddressesScheduledForDeletion) {
                $this->companyUnitAddressesScheduledForDeletion = clone $this->collCompanyUnitAddresses;
                $this->companyUnitAddressesScheduledForDeletion->clear();
            }
            $this->companyUnitAddressesScheduledForDeletion[]= $companyUnitAddress;
            $companyUnitAddress->setCompany(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyUnitAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress}> List of SpyCompanyUnitAddress objects
     */
    public function getCompanyUnitAddressesJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getCompanyUnitAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyUnitAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress}> List of SpyCompanyUnitAddress objects
     */
    public function getCompanyUnitAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getCompanyUnitAddresses($query, $con);
    }

    /**
     * Clears out the collCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyUsers()
     */
    public function clearCompanyUsers()
    {
        $this->collCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyUsers($v = true): void
    {
        $this->collCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collCompanyUsers collection.
     *
     * By default this just sets the collCompanyUsers collection to an empty array (like clearcollCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyUsers = new $collectionClassName;
        $this->collCompanyUsers->setModel('\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser');
    }

    /**
     * Gets an array of SpyCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompany is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser> List of SpyCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyUsersPartial && !$this->isNew();
        if (null === $this->collCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyUsers) {
                    $this->initCompanyUsers();
                } else {
                    $collectionClassName = SpyCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyUsers = new $collectionClassName;
                    $collCompanyUsers->setModel('\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser');

                    return $collCompanyUsers;
                }
            } else {
                $collCompanyUsers = SpyCompanyUserQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyUsersPartial && count($collCompanyUsers)) {
                        $this->initCompanyUsers(false);

                        foreach ($collCompanyUsers as $obj) {
                            if (false == $this->collCompanyUsers->contains($obj)) {
                                $this->collCompanyUsers->append($obj);
                            }
                        }

                        $this->collCompanyUsersPartial = true;
                    }

                    return $collCompanyUsers;
                }

                if ($partial && $this->collCompanyUsers) {
                    foreach ($this->collCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collCompanyUsers = $collCompanyUsers;
                $this->collCompanyUsersPartial = false;
            }
        }

        return $this->collCompanyUsers;
    }

    /**
     * Sets a collection of SpyCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyUsers(Collection $companyUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUser[] $companyUsersToDelete */
        $companyUsersToDelete = $this->getCompanyUsers(new Criteria(), $con)->diff($companyUsers);


        $this->companyUsersScheduledForDeletion = $companyUsersToDelete;

        foreach ($companyUsersToDelete as $companyUserRemoved) {
            $companyUserRemoved->setCompany(null);
        }

        $this->collCompanyUsers = null;
        foreach ($companyUsers as $companyUser) {
            $this->addCompanyUser($companyUser);
        }

        $this->collCompanyUsers = $companyUsers;
        $this->collCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyUsersPartial && !$this->isNew();
        if (null === $this->collCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyUsers());
            }

            $query = SpyCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collCompanyUsers);
    }

    /**
     * Method called to associate a SpyCompanyUser object to this object
     * through the SpyCompanyUser foreign key attribute.
     *
     * @param SpyCompanyUser $l SpyCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyUser(SpyCompanyUser $l)
    {
        if ($this->collCompanyUsers === null) {
            $this->initCompanyUsers();
            $this->collCompanyUsersPartial = true;
        }

        if (!$this->collCompanyUsers->contains($l)) {
            $this->doAddCompanyUser($l);

            if ($this->companyUsersScheduledForDeletion and $this->companyUsersScheduledForDeletion->contains($l)) {
                $this->companyUsersScheduledForDeletion->remove($this->companyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUser $companyUser The SpyCompanyUser object to add.
     */
    protected function doAddCompanyUser(SpyCompanyUser $companyUser): void
    {
        $this->collCompanyUsers[]= $companyUser;
        $companyUser->setCompany($this);
    }

    /**
     * @param SpyCompanyUser $companyUser The SpyCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyUser(SpyCompanyUser $companyUser)
    {
        if ($this->getCompanyUsers()->contains($companyUser)) {
            $pos = $this->collCompanyUsers->search($companyUser);
            $this->collCompanyUsers->remove($pos);
            if (null === $this->companyUsersScheduledForDeletion) {
                $this->companyUsersScheduledForDeletion = clone $this->collCompanyUsers;
                $this->companyUsersScheduledForDeletion->clear();
            }
            $this->companyUsersScheduledForDeletion[]= clone $companyUser;
            $companyUser->setCompany(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser}> List of SpyCompanyUser objects
     */
    public function getCompanyUsersJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompany is new, it will return
     * an empty collection; or if this SpyCompany has previously
     * been saved, it will retrieve related CompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompany.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUser[] List of SpyCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUser}> List of SpyCompanyUser objects
     */
    public function getCompanyUsersJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getCompanyUsers($query, $con);
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
        $this->id_company = null;
        $this->is_active = null;
        $this->key = null;
        $this->name = null;
        $this->status = null;
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
            if ($this->collSpyCompanyStores) {
                foreach ($this->collSpyCompanyStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyBusinessUnits) {
                foreach ($this->collCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyRoles) {
                foreach ($this->collCompanyRoles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyUnitAddresses) {
                foreach ($this->collCompanyUnitAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompanyUsers) {
                foreach ($this->collCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyStores = null;
        $this->collCompanyBusinessUnits = null;
        $this->collCompanyRoles = null;
        $this->collCompanyUnitAddresses = null;
        $this->collCompanyUsers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCompanyTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_company' . '.' . $this->getIdCompany();
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

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_company.create';
        } else {
            $this->_eventName = 'Entity.spy_company.update';
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

        if ($this->_eventName !== 'Entity.spy_company.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_company',
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
            'name' => 'spy_company',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_company.delete',
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
        $eventColumns = [
                'spy_company.is_active' => [
                    'column' => 'is_active',
                ],
                'spy_company.status' => [
                    'column' => 'status',
                ],
        ];

        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (isset($eventColumns[$modifiedColumn])) {

                if (!isset($eventColumns[$modifiedColumn]['value'])) {
                    return true;
                }

                $xmlValue = $eventColumns[$modifiedColumn]['value'];
                $xmlValue = $this->getPhpType($xmlValue, $modifiedColumn);
                $xmlOperator = '';
                if (isset($eventColumns[$modifiedColumn]['operator'])) {
                    $xmlOperator = $eventColumns[$modifiedColumn]['operator'];
                }
                $before = $this->_initialValues[$modifiedColumn];
                $field = str_replace('spy_company.', '', $modifiedColumn);
                $after = $this->$field;

                if ($before === null && $after !== null) {
                    return true;
                }

                if ($before !== null && $after === null) {
                    return true;
                }

                switch ($xmlOperator) {
                    case '<':
                        $result = ($before < $xmlValue xor $after < $xmlValue);
                        break;
                    case '>':
                        $result = ($before > $xmlValue xor $after > $xmlValue);
                        break;
                    case '<=':
                        $result = ($before <= $xmlValue xor $after <= $xmlValue);
                        break;
                    case '>=':
                        $result = ($before >= $xmlValue xor $after >= $xmlValue);
                        break;
                    case '<>':
                        $result = ($before <> $xmlValue xor $after <> $xmlValue);
                        break;
                    case '!=':
                        $result = ($before != $xmlValue xor $after != $xmlValue);
                        break;
                    case '==':
                        $result = ($before == $xmlValue xor $after == $xmlValue);
                        break;
                    case '!==':
                        $result = ($before !== $xmlValue xor $after !== $xmlValue);
                        break;
                    default:
                        $result = ($before === $xmlValue xor $after === $xmlValue);
                }

                if ($result) {
                    return true;
                }
            }
        }

        return false;
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
            $field = str_replace('spy_company.', '', $modifiedColumn);
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
            $field = str_replace('spy_company.', '', $additionalValueColumnName);
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
        $columnType = SpyCompanyTableMap::getTableMap()->getColumn($column)->getType();
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
