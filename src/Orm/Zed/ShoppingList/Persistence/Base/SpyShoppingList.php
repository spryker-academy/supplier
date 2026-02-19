<?php

namespace Orm\Zed\ShoppingList\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingList as ChildSpyShoppingList;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit as ChildSpyShoppingListCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery as ChildSpyShoppingListCompanyBusinessUnitQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser as ChildSpyShoppingListCompanyUser;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery as ChildSpyShoppingListCompanyUserQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem as ChildSpyShoppingListItem;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery as ChildSpyShoppingListItemQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery as ChildSpyShoppingListQuery;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyBusinessUnitTableMap;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListCompanyUserTableMap;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListItemTableMap;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListTableMap;
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
 * Base class that represents a row from the 'spy_shopping_list' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ShoppingList.Persistence.Base
 */
abstract class SpyShoppingList implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ShoppingList\\Persistence\\Map\\SpyShoppingListTableMap';


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
     * The value for the id_shopping_list field.
     *
     * @var        int
     */
    protected $id_shopping_list;

    /**
     * The value for the customer_reference field.
     * A unique reference for a customer.
     * @var        string
     */
    protected $customer_reference;

    /**
     * The value for the description field.
     * A description of an entity.
     * @var        string|null
     */
    protected $description;

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
     * @var        ObjectCollection|ChildSpyShoppingListItem[] Collection to store aggregation of ChildSpyShoppingListItem objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListItem> Collection to store aggregation of ChildSpyShoppingListItem objects.
     */
    protected $collSpyShoppingListItems;
    protected $collSpyShoppingListItemsPartial;

    /**
     * @var        ObjectCollection|ChildSpyShoppingListCompanyUser[] Collection to store aggregation of ChildSpyShoppingListCompanyUser objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyUser> Collection to store aggregation of ChildSpyShoppingListCompanyUser objects.
     */
    protected $collSpyShoppingListCompanyUsers;
    protected $collSpyShoppingListCompanyUsersPartial;

    /**
     * @var        ObjectCollection|ChildSpyShoppingListCompanyBusinessUnit[] Collection to store aggregation of ChildSpyShoppingListCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnit> Collection to store aggregation of ChildSpyShoppingListCompanyBusinessUnit objects.
     */
    protected $collSpyShoppingListCompanyBusinessUnits;
    protected $collSpyShoppingListCompanyBusinessUnitsPartial;

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
     * @var ObjectCollection|ChildSpyShoppingListItem[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListItem>
     */
    protected $spyShoppingListItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyShoppingListCompanyUser[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyUser>
     */
    protected $spyShoppingListCompanyUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyShoppingListCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnit>
     */
    protected $spyShoppingListCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingList object.
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
     * Compares this with another <code>SpyShoppingList</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyShoppingList</code>, delegates to
     * <code>equals(SpyShoppingList)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_shopping_list] column value.
     *
     * @return int
     */
    public function getIdShoppingList()
    {
        return $this->id_shopping_list;
    }

    /**
     * Get the [customer_reference] column value.
     * A unique reference for a customer.
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * Get the [description] column value.
     * A description of an entity.
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set the value of [id_shopping_list] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdShoppingList($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_shopping_list !== $v) {
            $this->id_shopping_list = $v;
            $this->modifiedColumns[SpyShoppingListTableMap::COL_ID_SHOPPING_LIST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_reference] column.
     * A unique reference for a customer.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->customer_reference !== $v) {
            $this->customer_reference = $v;
            $this->modifiedColumns[SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     * A description of an entity.
     * @param string|null $v New value
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
            $this->modifiedColumns[SpyShoppingListTableMap::COL_DESCRIPTION] = true;
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
            $this->modifiedColumns[SpyShoppingListTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyShoppingListTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[SpyShoppingListTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyShoppingListTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyShoppingListTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyShoppingListTableMap::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shopping_list = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyShoppingListTableMap::translateFieldName('CustomerReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyShoppingListTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyShoppingListTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyShoppingListTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyShoppingListTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyShoppingListTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyShoppingListTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpyShoppingListTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingList'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyShoppingListTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyShoppingListQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyShoppingListItems = null;

            $this->collSpyShoppingListCompanyUsers = null;

            $this->collSpyShoppingListCompanyBusinessUnits = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyShoppingList::setDeleted()
     * @see SpyShoppingList::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyShoppingListQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // event behavior

            $this->prepareSaveEventName();

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyShoppingListTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyShoppingListTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyShoppingListTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
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

                SpyShoppingListTableMap::addInstanceToPool($this);
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

            if ($this->spyShoppingListItemsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListItems !== null) {
                foreach ($this->collSpyShoppingListItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListCompanyUsersScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyUsersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyShoppingListCompanyUsersScheduledForDeletion as $spyShoppingListCompanyUser) {
                        // need to save related object because we set the relation to null
                        $spyShoppingListCompanyUser->save($con);
                    }
                    $this->spyShoppingListCompanyUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyUsers !== null) {
                foreach ($this->collSpyShoppingListCompanyUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListCompanyBusinessUnits !== null) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnits as $referrerFK) {
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

        $this->modifiedColumns[SpyShoppingListTableMap::COL_ID_SHOPPING_LIST] = true;
        if (null !== $this->id_shopping_list) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyShoppingListTableMap::COL_ID_SHOPPING_LIST . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST)) {
            $modifiedColumns[':p' . $index++]  = '`id_shopping_list`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = '`customer_reference`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_shopping_list` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_shopping_list`':
                        $stmt->bindValue($identifier, $this->id_shopping_list, PDO::PARAM_INT);

                        break;
                    case '`customer_reference`':
                        $stmt->bindValue($identifier, $this->customer_reference, PDO::PARAM_STR);

                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_shopping_list_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdShoppingList($pk);

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
        $pos = SpyShoppingListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdShoppingList();

            case 1:
                return $this->getCustomerReference();

            case 2:
                return $this->getDescription();

            case 3:
                return $this->getKey();

            case 4:
                return $this->getName();

            case 5:
                return $this->getUuid();

            case 6:
                return $this->getCreatedAt();

            case 7:
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
        if (isset($alreadyDumpedObjects['SpyShoppingList'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyShoppingList'][$this->hashCode()] = true;
        $keys = SpyShoppingListTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdShoppingList(),
            $keys[1] => $this->getCustomerReference(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getUuid(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyShoppingListItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_items';
                        break;
                    default:
                        $key = 'SpyShoppingListItems';
                }

                $result[$key] = $this->collSpyShoppingListItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListCompanyUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_users';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyUsers';
                }

                $result[$key] = $this->collSpyShoppingListCompanyUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_company_business_units';
                        break;
                    default:
                        $key = 'SpyShoppingListCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyShoppingListCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyShoppingListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdShoppingList($value);
                break;
            case 1:
                $this->setCustomerReference($value);
                break;
            case 2:
                $this->setDescription($value);
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
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
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
        $keys = SpyShoppingListTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdShoppingList($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCustomerReference($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
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
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
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
        $criteria = new Criteria(SpyShoppingListTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST)) {
            $criteria->add(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST, $this->id_shopping_list);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE)) {
            $criteria->add(SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE, $this->customer_reference);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_DESCRIPTION)) {
            $criteria->add(SpyShoppingListTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_KEY)) {
            $criteria->add(SpyShoppingListTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_NAME)) {
            $criteria->add(SpyShoppingListTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_UUID)) {
            $criteria->add(SpyShoppingListTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyShoppingListTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyShoppingListTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyShoppingListTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyShoppingListQuery::create();
        $criteria->add(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST, $this->id_shopping_list);

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
        $validPk = null !== $this->getIdShoppingList();

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
        return $this->getIdShoppingList();
    }

    /**
     * Generic method to set the primary key (id_shopping_list column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdShoppingList($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdShoppingList();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ShoppingList\Persistence\SpyShoppingList (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCustomerReference($this->getCustomerReference());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyShoppingListItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListCompanyUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdShoppingList(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingList Clone of current object.
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
        if ('SpyShoppingListItem' === $relationName) {
            $this->initSpyShoppingListItems();
            return;
        }
        if ('SpyShoppingListCompanyUser' === $relationName) {
            $this->initSpyShoppingListCompanyUsers();
            return;
        }
        if ('SpyShoppingListCompanyBusinessUnit' === $relationName) {
            $this->initSpyShoppingListCompanyBusinessUnits();
            return;
        }
    }

    /**
     * Clears out the collSpyShoppingListItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListItems()
     */
    public function clearSpyShoppingListItems()
    {
        $this->collSpyShoppingListItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListItems($v = true): void
    {
        $this->collSpyShoppingListItemsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListItems collection.
     *
     * By default this just sets the collSpyShoppingListItems collection to an empty array (like clearcollSpyShoppingListItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListItems = new $collectionClassName;
        $this->collSpyShoppingListItems->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem');
    }

    /**
     * Gets an array of ChildSpyShoppingListItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyShoppingListItem[] List of ChildSpyShoppingListItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListItem> List of ChildSpyShoppingListItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListItemsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListItems) {
                    $this->initSpyShoppingListItems();
                } else {
                    $collectionClassName = SpyShoppingListItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListItems = new $collectionClassName;
                    $collSpyShoppingListItems->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem');

                    return $collSpyShoppingListItems;
                }
            } else {
                $collSpyShoppingListItems = ChildSpyShoppingListItemQuery::create(null, $criteria)
                    ->filterBySpyShoppingList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListItemsPartial && count($collSpyShoppingListItems)) {
                        $this->initSpyShoppingListItems(false);

                        foreach ($collSpyShoppingListItems as $obj) {
                            if (false == $this->collSpyShoppingListItems->contains($obj)) {
                                $this->collSpyShoppingListItems->append($obj);
                            }
                        }

                        $this->collSpyShoppingListItemsPartial = true;
                    }

                    return $collSpyShoppingListItems;
                }

                if ($partial && $this->collSpyShoppingListItems) {
                    foreach ($this->collSpyShoppingListItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListItems[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListItems = $collSpyShoppingListItems;
                $this->collSpyShoppingListItemsPartial = false;
            }
        }

        return $this->collSpyShoppingListItems;
    }

    /**
     * Sets a collection of ChildSpyShoppingListItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListItems(Collection $spyShoppingListItems, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyShoppingListItem[] $spyShoppingListItemsToDelete */
        $spyShoppingListItemsToDelete = $this->getSpyShoppingListItems(new Criteria(), $con)->diff($spyShoppingListItems);


        $this->spyShoppingListItemsScheduledForDeletion = $spyShoppingListItemsToDelete;

        foreach ($spyShoppingListItemsToDelete as $spyShoppingListItemRemoved) {
            $spyShoppingListItemRemoved->setSpyShoppingList(null);
        }

        $this->collSpyShoppingListItems = null;
        foreach ($spyShoppingListItems as $spyShoppingListItem) {
            $this->addSpyShoppingListItem($spyShoppingListItem);
        }

        $this->collSpyShoppingListItems = $spyShoppingListItems;
        $this->collSpyShoppingListItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyShoppingListItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyShoppingListItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListItemsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListItems());
            }

            $query = ChildSpyShoppingListItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingList($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListItems);
    }

    /**
     * Method called to associate a ChildSpyShoppingListItem object to this object
     * through the ChildSpyShoppingListItem foreign key attribute.
     *
     * @param ChildSpyShoppingListItem $l ChildSpyShoppingListItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListItem(ChildSpyShoppingListItem $l)
    {
        if ($this->collSpyShoppingListItems === null) {
            $this->initSpyShoppingListItems();
            $this->collSpyShoppingListItemsPartial = true;
        }

        if (!$this->collSpyShoppingListItems->contains($l)) {
            $this->doAddSpyShoppingListItem($l);

            if ($this->spyShoppingListItemsScheduledForDeletion and $this->spyShoppingListItemsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListItemsScheduledForDeletion->remove($this->spyShoppingListItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyShoppingListItem $spyShoppingListItem The ChildSpyShoppingListItem object to add.
     */
    protected function doAddSpyShoppingListItem(ChildSpyShoppingListItem $spyShoppingListItem): void
    {
        $this->collSpyShoppingListItems[]= $spyShoppingListItem;
        $spyShoppingListItem->setSpyShoppingList($this);
    }

    /**
     * @param ChildSpyShoppingListItem $spyShoppingListItem The ChildSpyShoppingListItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListItem(ChildSpyShoppingListItem $spyShoppingListItem)
    {
        if ($this->getSpyShoppingListItems()->contains($spyShoppingListItem)) {
            $pos = $this->collSpyShoppingListItems->search($spyShoppingListItem);
            $this->collSpyShoppingListItems->remove($pos);
            if (null === $this->spyShoppingListItemsScheduledForDeletion) {
                $this->spyShoppingListItemsScheduledForDeletion = clone $this->collSpyShoppingListItems;
                $this->spyShoppingListItemsScheduledForDeletion->clear();
            }
            $this->spyShoppingListItemsScheduledForDeletion[]= clone $spyShoppingListItem;
            $spyShoppingListItem->setSpyShoppingList(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyShoppingListCompanyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyUsers()
     */
    public function clearSpyShoppingListCompanyUsers()
    {
        $this->collSpyShoppingListCompanyUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyUsers($v = true): void
    {
        $this->collSpyShoppingListCompanyUsersPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyUsers collection.
     *
     * By default this just sets the collSpyShoppingListCompanyUsers collection to an empty array (like clearcollSpyShoppingListCompanyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyUsers = new $collectionClassName;
        $this->collSpyShoppingListCompanyUsers->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser');
    }

    /**
     * Gets an array of ChildSpyShoppingListCompanyUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyShoppingListCompanyUser[] List of ChildSpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyUser> List of ChildSpyShoppingListCompanyUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyUsers) {
                    $this->initSpyShoppingListCompanyUsers();
                } else {
                    $collectionClassName = SpyShoppingListCompanyUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyUsers = new $collectionClassName;
                    $collSpyShoppingListCompanyUsers->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser');

                    return $collSpyShoppingListCompanyUsers;
                }
            } else {
                $collSpyShoppingListCompanyUsers = ChildSpyShoppingListCompanyUserQuery::create(null, $criteria)
                    ->filterBySpyShoppingList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyUsersPartial && count($collSpyShoppingListCompanyUsers)) {
                        $this->initSpyShoppingListCompanyUsers(false);

                        foreach ($collSpyShoppingListCompanyUsers as $obj) {
                            if (false == $this->collSpyShoppingListCompanyUsers->contains($obj)) {
                                $this->collSpyShoppingListCompanyUsers->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyUsersPartial = true;
                    }

                    return $collSpyShoppingListCompanyUsers;
                }

                if ($partial && $this->collSpyShoppingListCompanyUsers) {
                    foreach ($this->collSpyShoppingListCompanyUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyUsers = $collSpyShoppingListCompanyUsers;
                $this->collSpyShoppingListCompanyUsersPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyUsers;
    }

    /**
     * Sets a collection of ChildSpyShoppingListCompanyUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyUsers(Collection $spyShoppingListCompanyUsers, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyShoppingListCompanyUser[] $spyShoppingListCompanyUsersToDelete */
        $spyShoppingListCompanyUsersToDelete = $this->getSpyShoppingListCompanyUsers(new Criteria(), $con)->diff($spyShoppingListCompanyUsers);


        $this->spyShoppingListCompanyUsersScheduledForDeletion = $spyShoppingListCompanyUsersToDelete;

        foreach ($spyShoppingListCompanyUsersToDelete as $spyShoppingListCompanyUserRemoved) {
            $spyShoppingListCompanyUserRemoved->setSpyShoppingList(null);
        }

        $this->collSpyShoppingListCompanyUsers = null;
        foreach ($spyShoppingListCompanyUsers as $spyShoppingListCompanyUser) {
            $this->addSpyShoppingListCompanyUser($spyShoppingListCompanyUser);
        }

        $this->collSpyShoppingListCompanyUsers = $spyShoppingListCompanyUsers;
        $this->collSpyShoppingListCompanyUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyShoppingListCompanyUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyShoppingListCompanyUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyUsersPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyUsers());
            }

            $query = ChildSpyShoppingListCompanyUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingList($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyUsers);
    }

    /**
     * Method called to associate a ChildSpyShoppingListCompanyUser object to this object
     * through the ChildSpyShoppingListCompanyUser foreign key attribute.
     *
     * @param ChildSpyShoppingListCompanyUser $l ChildSpyShoppingListCompanyUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyUser(ChildSpyShoppingListCompanyUser $l)
    {
        if ($this->collSpyShoppingListCompanyUsers === null) {
            $this->initSpyShoppingListCompanyUsers();
            $this->collSpyShoppingListCompanyUsersPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyUsers->contains($l)) {
            $this->doAddSpyShoppingListCompanyUser($l);

            if ($this->spyShoppingListCompanyUsersScheduledForDeletion and $this->spyShoppingListCompanyUsersScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyUsersScheduledForDeletion->remove($this->spyShoppingListCompanyUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyShoppingListCompanyUser $spyShoppingListCompanyUser The ChildSpyShoppingListCompanyUser object to add.
     */
    protected function doAddSpyShoppingListCompanyUser(ChildSpyShoppingListCompanyUser $spyShoppingListCompanyUser): void
    {
        $this->collSpyShoppingListCompanyUsers[]= $spyShoppingListCompanyUser;
        $spyShoppingListCompanyUser->setSpyShoppingList($this);
    }

    /**
     * @param ChildSpyShoppingListCompanyUser $spyShoppingListCompanyUser The ChildSpyShoppingListCompanyUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyUser(ChildSpyShoppingListCompanyUser $spyShoppingListCompanyUser)
    {
        if ($this->getSpyShoppingListCompanyUsers()->contains($spyShoppingListCompanyUser)) {
            $pos = $this->collSpyShoppingListCompanyUsers->search($spyShoppingListCompanyUser);
            $this->collSpyShoppingListCompanyUsers->remove($pos);
            if (null === $this->spyShoppingListCompanyUsersScheduledForDeletion) {
                $this->spyShoppingListCompanyUsersScheduledForDeletion = clone $this->collSpyShoppingListCompanyUsers;
                $this->spyShoppingListCompanyUsersScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyUsersScheduledForDeletion[]= $spyShoppingListCompanyUser;
            $spyShoppingListCompanyUser->setSpyShoppingList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingList is new, it will return
     * an empty collection; or if this SpyShoppingList has previously
     * been saved, it will retrieve related SpyShoppingListCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShoppingListCompanyUser[] List of ChildSpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyUser}> List of ChildSpyShoppingListCompanyUser objects
     */
    public function getSpyShoppingListCompanyUsersJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShoppingListCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpyShoppingListCompanyUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingList is new, it will return
     * an empty collection; or if this SpyShoppingList has previously
     * been saved, it will retrieve related SpyShoppingListCompanyUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShoppingListCompanyUser[] List of ChildSpyShoppingListCompanyUser objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyUser}> List of ChildSpyShoppingListCompanyUser objects
     */
    public function getSpyShoppingListCompanyUsersJoinSpyShoppingListPermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShoppingListCompanyUserQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListPermissionGroup', $joinBehavior);

        return $this->getSpyShoppingListCompanyUsers($query, $con);
    }

    /**
     * Clears out the collSpyShoppingListCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListCompanyBusinessUnits()
     */
    public function clearSpyShoppingListCompanyBusinessUnits()
    {
        $this->collSpyShoppingListCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListCompanyBusinessUnits($v = true): void
    {
        $this->collSpyShoppingListCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyShoppingListCompanyBusinessUnits collection to an empty array (like clearcollSpyShoppingListCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyShoppingListCompanyBusinessUnits->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit');
    }

    /**
     * Gets an array of ChildSpyShoppingListCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyShoppingListCompanyBusinessUnit[] List of ChildSpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnit> List of ChildSpyShoppingListCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListCompanyBusinessUnits) {
                    $this->initSpyShoppingListCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyShoppingListCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListCompanyBusinessUnits = new $collectionClassName;
                    $collSpyShoppingListCompanyBusinessUnits->setModel('\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit');

                    return $collSpyShoppingListCompanyBusinessUnits;
                }
            } else {
                $collSpyShoppingListCompanyBusinessUnits = ChildSpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterBySpyShoppingList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListCompanyBusinessUnitsPartial && count($collSpyShoppingListCompanyBusinessUnits)) {
                        $this->initSpyShoppingListCompanyBusinessUnits(false);

                        foreach ($collSpyShoppingListCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyShoppingListCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyShoppingListCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyShoppingListCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyShoppingListCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyShoppingListCompanyBusinessUnits) {
                    foreach ($this->collSpyShoppingListCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListCompanyBusinessUnits = $collSpyShoppingListCompanyBusinessUnits;
                $this->collSpyShoppingListCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyShoppingListCompanyBusinessUnits;
    }

    /**
     * Sets a collection of ChildSpyShoppingListCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListCompanyBusinessUnits(Collection $spyShoppingListCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyShoppingListCompanyBusinessUnit[] $spyShoppingListCompanyBusinessUnitsToDelete */
        $spyShoppingListCompanyBusinessUnitsToDelete = $this->getSpyShoppingListCompanyBusinessUnits(new Criteria(), $con)->diff($spyShoppingListCompanyBusinessUnits);


        $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = $spyShoppingListCompanyBusinessUnitsToDelete;

        foreach ($spyShoppingListCompanyBusinessUnitsToDelete as $spyShoppingListCompanyBusinessUnitRemoved) {
            $spyShoppingListCompanyBusinessUnitRemoved->setSpyShoppingList(null);
        }

        $this->collSpyShoppingListCompanyBusinessUnits = null;
        foreach ($spyShoppingListCompanyBusinessUnits as $spyShoppingListCompanyBusinessUnit) {
            $this->addSpyShoppingListCompanyBusinessUnit($spyShoppingListCompanyBusinessUnit);
        }

        $this->collSpyShoppingListCompanyBusinessUnits = $spyShoppingListCompanyBusinessUnits;
        $this->collSpyShoppingListCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyShoppingListCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyShoppingListCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListCompanyBusinessUnits());
            }

            $query = ChildSpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingList($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListCompanyBusinessUnits);
    }

    /**
     * Method called to associate a ChildSpyShoppingListCompanyBusinessUnit object to this object
     * through the ChildSpyShoppingListCompanyBusinessUnit foreign key attribute.
     *
     * @param ChildSpyShoppingListCompanyBusinessUnit $l ChildSpyShoppingListCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListCompanyBusinessUnit(ChildSpyShoppingListCompanyBusinessUnit $l)
    {
        if ($this->collSpyShoppingListCompanyBusinessUnits === null) {
            $this->initSpyShoppingListCompanyBusinessUnits();
            $this->collSpyShoppingListCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyShoppingListCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyShoppingListCompanyBusinessUnit($l);

            if ($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion and $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->remove($this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit The ChildSpyShoppingListCompanyBusinessUnit object to add.
     */
    protected function doAddSpyShoppingListCompanyBusinessUnit(ChildSpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit): void
    {
        $this->collSpyShoppingListCompanyBusinessUnits[]= $spyShoppingListCompanyBusinessUnit;
        $spyShoppingListCompanyBusinessUnit->setSpyShoppingList($this);
    }

    /**
     * @param ChildSpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit The ChildSpyShoppingListCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListCompanyBusinessUnit(ChildSpyShoppingListCompanyBusinessUnit $spyShoppingListCompanyBusinessUnit)
    {
        if ($this->getSpyShoppingListCompanyBusinessUnits()->contains($spyShoppingListCompanyBusinessUnit)) {
            $pos = $this->collSpyShoppingListCompanyBusinessUnits->search($spyShoppingListCompanyBusinessUnit);
            $this->collSpyShoppingListCompanyBusinessUnits->remove($pos);
            if (null === $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyShoppingListCompanyBusinessUnits;
                $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyShoppingListCompanyBusinessUnitsScheduledForDeletion[]= clone $spyShoppingListCompanyBusinessUnit;
            $spyShoppingListCompanyBusinessUnit->setSpyShoppingList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingList is new, it will return
     * an empty collection; or if this SpyShoppingList has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShoppingListCompanyBusinessUnit[] List of ChildSpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnit}> List of ChildSpyShoppingListCompanyBusinessUnit objects
     */
    public function getSpyShoppingListCompanyBusinessUnitsJoinSpyCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyBusinessUnit', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingList is new, it will return
     * an empty collection; or if this SpyShoppingList has previously
     * been saved, it will retrieve related SpyShoppingListCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShoppingListCompanyBusinessUnit[] List of ChildSpyShoppingListCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShoppingListCompanyBusinessUnit}> List of ChildSpyShoppingListCompanyBusinessUnit objects
     */
    public function getSpyShoppingListCompanyBusinessUnitsJoinSpyShoppingListPermissionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShoppingListCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListPermissionGroup', $joinBehavior);

        return $this->getSpyShoppingListCompanyBusinessUnits($query, $con);
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
        $this->id_shopping_list = null;
        $this->customer_reference = null;
        $this->description = null;
        $this->key = null;
        $this->name = null;
        $this->uuid = null;
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
            if ($this->collSpyShoppingListItems) {
                foreach ($this->collSpyShoppingListItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListCompanyUsers) {
                foreach ($this->collSpyShoppingListCompanyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListCompanyBusinessUnits) {
                foreach ($this->collSpyShoppingListCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyShoppingListItems = null;
        $this->collSpyShoppingListCompanyUsers = null;
        $this->collSpyShoppingListCompanyBusinessUnits = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyShoppingListTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyShoppingListTableMap::COL_UPDATED_AT] = true;

        return $this;
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
        $name = 'spy_shopping_list' . '.' . $this->getIdShoppingList() . '.' . $this->getCustomerReference();
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
            $this->_eventName = 'Entity.spy_shopping_list.create';
        } else {
            $this->_eventName = 'Entity.spy_shopping_list.update';
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

        if ($this->_eventName !== 'Entity.spy_shopping_list.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_shopping_list',
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
            'name' => 'spy_shopping_list',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_shopping_list.delete',
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
            $field = str_replace('spy_shopping_list.', '', $modifiedColumn);
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
            $field = str_replace('spy_shopping_list.', '', $additionalValueColumnName);
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
        $columnType = SpyShoppingListTableMap::getTableMap()->getColumn($column)->getType();
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
