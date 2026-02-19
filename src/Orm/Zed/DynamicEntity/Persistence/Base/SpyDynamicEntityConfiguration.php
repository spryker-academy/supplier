<?php

namespace Orm\Zed\DynamicEntity\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration as ChildSpyDynamicEntityConfiguration;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery as ChildSpyDynamicEntityConfigurationQuery;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation as ChildSpyDynamicEntityConfigurationRelation;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery as ChildSpyDynamicEntityConfigurationRelationQuery;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationRelationTableMap;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationTableMap;
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
 * Base class that represents a row from the 'spy_dynamic_entity_configuration' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.DynamicEntity.Persistence.Base
 */
abstract class SpyDynamicEntityConfiguration implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\DynamicEntity\\Persistence\\Map\\SpyDynamicEntityConfigurationTableMap';


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
     * The value for the id_dynamic_entity_configuration field.
     *
     * @var        int
     */
    protected $id_dynamic_entity_configuration;

    /**
     * The value for the table_alias field.
     * An alias for a database table.
     * @var        string
     */
    protected $table_alias;

    /**
     * The value for the table_name field.
     * The name of a database table.
     * @var        string
     */
    protected $table_name;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the definition field.
     * The definition of a dynamic entity.
     * @var        string
     */
    protected $definition;

    /**
     * The value for the type field.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @var        string|null
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
     * @var        ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[] Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelation objects.
     */
    protected $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
    protected $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial;

    /**
     * @var        ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[] Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelation objects.
     */
    protected $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
    protected $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation>
     */
    protected $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation>
     */
    protected $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
    }

    /**
     * Initializes internal state of Orm\Zed\DynamicEntity\Persistence\Base\SpyDynamicEntityConfiguration object.
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
     * Compares this with another <code>SpyDynamicEntityConfiguration</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyDynamicEntityConfiguration</code>, delegates to
     * <code>equals(SpyDynamicEntityConfiguration)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_dynamic_entity_configuration] column value.
     *
     * @return int
     */
    public function getIdDynamicEntityConfiguration()
    {
        return $this->id_dynamic_entity_configuration;
    }

    /**
     * Get the [table_alias] column value.
     * An alias for a database table.
     * @return string
     */
    public function getTableAlias()
    {
        return $this->table_alias;
    }

    /**
     * Get the [table_name] column value.
     * The name of a database table.
     * @return string
     */
    public function getTableName()
    {
        return $this->table_name;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [definition] column value.
     * The definition of a dynamic entity.
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Get the [type] column value.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @return string|null
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
     * Set the value of [id_dynamic_entity_configuration] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdDynamicEntityConfiguration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_dynamic_entity_configuration !== $v) {
            $this->id_dynamic_entity_configuration = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [table_alias] column.
     * An alias for a database table.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTableAlias($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->table_alias !== $v) {
            $this->table_alias = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [table_name] column.
     * The name of a database table.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTableName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->table_name !== $v) {
            $this->table_name = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME] = true;
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
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [definition] column.
     * The definition of a dynamic entity.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefinition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->definition !== $v) {
            $this->definition = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_DEFINITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @param string|null $v New value
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
            $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_TYPE] = true;
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
                $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_active !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_dynamic_entity_configuration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('TableAlias', TableMap::TYPE_PHPNAME, $indexType)];
            $this->table_alias = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('TableName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->table_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('Definition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->definition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyDynamicEntityConfigurationTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpyDynamicEntityConfigurationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyDynamicEntityConfigurationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = null;

            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyDynamicEntityConfiguration::setDeleted()
     * @see SpyDynamicEntityConfiguration::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyDynamicEntityConfigurationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT)) {
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
                SpyDynamicEntityConfigurationTableMap::addInstanceToPool($this);
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

            if ($this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion !== null) {
                if (!$this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery::create()
                        ->filterByPrimaryKeys($this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion = null;
                }
            }

            if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration !== null) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion !== null) {
                if (!$this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery::create()
                        ->filterByPrimaryKeys($this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion = null;
                }
            }

            if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration !== null) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration as $referrerFK) {
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

        $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION] = true;
        if (null !== $this->id_dynamic_entity_configuration) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'id_dynamic_entity_configuration';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS)) {
            $modifiedColumns[':p' . $index++]  = 'table_alias';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'table_name';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION)) {
            $modifiedColumns[':p' . $index++]  = 'definition';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_dynamic_entity_configuration (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_dynamic_entity_configuration':
                        $stmt->bindValue($identifier, $this->id_dynamic_entity_configuration, PDO::PARAM_INT);

                        break;
                    case 'table_alias':
                        $stmt->bindValue($identifier, $this->table_alias, PDO::PARAM_STR);

                        break;
                    case 'table_name':
                        $stmt->bindValue($identifier, $this->table_name, PDO::PARAM_STR);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'definition':
                        $stmt->bindValue($identifier, $this->definition, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_dynamic_entity_configuration_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdDynamicEntityConfiguration($pk);

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
        $pos = SpyDynamicEntityConfigurationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdDynamicEntityConfiguration();

            case 1:
                return $this->getTableAlias();

            case 2:
                return $this->getTableName();

            case 3:
                return $this->getIsActive();

            case 4:
                return $this->getDefinition();

            case 5:
                return $this->getType();

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
        if (isset($alreadyDumpedObjects['SpyDynamicEntityConfiguration'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyDynamicEntityConfiguration'][$this->hashCode()] = true;
        $keys = SpyDynamicEntityConfigurationTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdDynamicEntityConfiguration(),
            $keys[1] => $this->getTableAlias(),
            $keys[2] => $this->getTableName(),
            $keys[3] => $this->getIsActive(),
            $keys[4] => $this->getDefinition(),
            $keys[5] => $this->getType(),
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
            if (null !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDynamicEntityConfigurationRelations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_dynamic_entity_configuration_relations';
                        break;
                    default:
                        $key = 'SpyDynamicEntityConfigurationRelations';
                }

                $result[$key] = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDynamicEntityConfigurationRelations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_dynamic_entity_configuration_relations';
                        break;
                    default:
                        $key = 'SpyDynamicEntityConfigurationRelations';
                }

                $result[$key] = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyDynamicEntityConfigurationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdDynamicEntityConfiguration($value);
                break;
            case 1:
                $this->setTableAlias($value);
                break;
            case 2:
                $this->setTableName($value);
                break;
            case 3:
                $this->setIsActive($value);
                break;
            case 4:
                $this->setDefinition($value);
                break;
            case 5:
                $this->setType($value);
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
        $keys = SpyDynamicEntityConfigurationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdDynamicEntityConfiguration($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTableAlias($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTableName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsActive($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDefinition($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setType($arr[$keys[5]]);
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
        $criteria = new Criteria(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $this->id_dynamic_entity_configuration);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS, $this->table_alias);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME, $this->table_name);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION, $this->definition);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_TYPE)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyDynamicEntityConfigurationQuery::create();
        $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $this->id_dynamic_entity_configuration);

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
        $validPk = null !== $this->getIdDynamicEntityConfiguration();

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
        return $this->getIdDynamicEntityConfiguration();
    }

    /**
     * Generic method to set the primary key (id_dynamic_entity_configuration column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdDynamicEntityConfiguration($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdDynamicEntityConfiguration();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTableAlias($this->getTableAlias());
        $copyObj->setTableName($this->getTableName());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setDefinition($this->getDefinition());
        $copyObj->setType($this->getType());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdDynamicEntityConfiguration(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration Clone of current object.
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
        if ('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration' === $relationName) {
            $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration();
            return;
        }
        if ('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration' === $relationName) {
            $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration();
            return;
        }
    }

    /**
     * Clears out the collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration()
     */
    public function clearSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration()
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration($v = true): void
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial = $v;
    }

    /**
     * Initializes the collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration collection.
     *
     * By default this just sets the collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration collection to an empty array (like clearcollSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDynamicEntityConfigurationRelationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = new $collectionClassName;
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation');
    }

    /**
     * Gets an array of ChildSpyDynamicEntityConfigurationRelation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDynamicEntityConfiguration is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[] List of ChildSpyDynamicEntityConfigurationRelation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> List of ChildSpyDynamicEntityConfigurationRelation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration) {
                    $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration();
                } else {
                    $collectionClassName = SpyDynamicEntityConfigurationRelationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = new $collectionClassName;
                    $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation');

                    return $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
                }
            } else {
                $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = ChildSpyDynamicEntityConfigurationRelationQuery::create(null, $criteria)
                    ->filterBySpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial && count($collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration)) {
                        $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(false);

                        foreach ($collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration as $obj) {
                            if (false == $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->contains($obj)) {
                                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->append($obj);
                            }
                        }

                        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial = true;
                    }

                    return $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
                }

                if ($partial && $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration) {
                    foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration as $obj) {
                        if ($obj->isNew()) {
                            $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration[] = $obj;
                        }
                    }
                }

                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = $collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial = false;
            }
        }

        return $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
    }

    /**
     * Sets a collection of ChildSpyDynamicEntityConfigurationRelation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(Collection $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyDynamicEntityConfigurationRelation[] $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationToDelete */
        $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationToDelete = $this->getSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(new Criteria(), $con)->diff($spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration);


        $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion = $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationToDelete;

        foreach ($spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationToDelete as $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationRemoved) {
            $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationRemoved->setSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration(null);
        }

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = null;
        foreach ($spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration as $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration) {
            $this->addSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration);
        }

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = $spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyDynamicEntityConfigurationRelation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyDynamicEntityConfigurationRelation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration());
            }

            $query = ChildSpyDynamicEntityConfigurationRelationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($this)
                ->count($con);
        }

        return count($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration);
    }

    /**
     * Method called to associate a ChildSpyDynamicEntityConfigurationRelation object to this object
     * through the ChildSpyDynamicEntityConfigurationRelation foreign key attribute.
     *
     * @param ChildSpyDynamicEntityConfigurationRelation $l ChildSpyDynamicEntityConfigurationRelation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $l)
    {
        if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration === null) {
            $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration();
            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationPartial = true;
        }

        if (!$this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->contains($l)) {
            $this->doAddSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($l);

            if ($this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion and $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->contains($l)) {
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->remove($this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration The ChildSpyDynamicEntityConfigurationRelation object to add.
     */
    protected function doAddSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration): void
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration[]= $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration;
        $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration->setSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($this);
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration The ChildSpyDynamicEntityConfigurationRelation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration)
    {
        if ($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration()->contains($spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration)) {
            $pos = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->search($spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration);
            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration->remove($pos);
            if (null === $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion) {
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion = clone $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration;
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion->clear();
            }
            $this->spyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfigurationScheduledForDeletion[]= clone $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration;
            $spyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration->setSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration()
     */
    public function clearSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration()
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration($v = true): void
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial = $v;
    }

    /**
     * Initializes the collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration collection.
     *
     * By default this just sets the collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration collection to an empty array (like clearcollSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDynamicEntityConfigurationRelationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = new $collectionClassName;
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation');
    }

    /**
     * Gets an array of ChildSpyDynamicEntityConfigurationRelation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDynamicEntityConfiguration is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyDynamicEntityConfigurationRelation[] List of ChildSpyDynamicEntityConfigurationRelation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> List of ChildSpyDynamicEntityConfigurationRelation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration) {
                    $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration();
                } else {
                    $collectionClassName = SpyDynamicEntityConfigurationRelationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = new $collectionClassName;
                    $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation');

                    return $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
                }
            } else {
                $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = ChildSpyDynamicEntityConfigurationRelationQuery::create(null, $criteria)
                    ->filterBySpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial && count($collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration)) {
                        $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(false);

                        foreach ($collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration as $obj) {
                            if (false == $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->contains($obj)) {
                                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->append($obj);
                            }
                        }

                        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial = true;
                    }

                    return $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
                }

                if ($partial && $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration) {
                    foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration as $obj) {
                        if ($obj->isNew()) {
                            $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration[] = $obj;
                        }
                    }
                }

                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = $collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
                $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial = false;
            }
        }

        return $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
    }

    /**
     * Sets a collection of ChildSpyDynamicEntityConfigurationRelation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(Collection $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyDynamicEntityConfigurationRelation[] $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationToDelete */
        $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationToDelete = $this->getSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(new Criteria(), $con)->diff($spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration);


        $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion = $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationToDelete;

        foreach ($spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationToDelete as $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationRemoved) {
            $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationRemoved->setSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration(null);
        }

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = null;
        foreach ($spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration as $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration) {
            $this->addSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration);
        }

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = $spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyDynamicEntityConfigurationRelation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyDynamicEntityConfigurationRelation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration());
            }

            $query = ChildSpyDynamicEntityConfigurationRelationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($this)
                ->count($con);
        }

        return count($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration);
    }

    /**
     * Method called to associate a ChildSpyDynamicEntityConfigurationRelation object to this object
     * through the ChildSpyDynamicEntityConfigurationRelation foreign key attribute.
     *
     * @param ChildSpyDynamicEntityConfigurationRelation $l ChildSpyDynamicEntityConfigurationRelation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $l)
    {
        if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration === null) {
            $this->initSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration();
            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationPartial = true;
        }

        if (!$this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->contains($l)) {
            $this->doAddSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($l);

            if ($this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion and $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->contains($l)) {
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->remove($this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration The ChildSpyDynamicEntityConfigurationRelation object to add.
     */
    protected function doAddSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration): void
    {
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration[]= $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration;
        $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration->setSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($this);
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration The ChildSpyDynamicEntityConfigurationRelation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration(ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration)
    {
        if ($this->getSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration()->contains($spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration)) {
            $pos = $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->search($spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration);
            $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration->remove($pos);
            if (null === $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion) {
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion = clone $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration;
                $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion->clear();
            }
            $this->spyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfigurationScheduledForDeletion[]= clone $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration;
            $spyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration->setSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration(null);
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
        $this->id_dynamic_entity_configuration = null;
        $this->table_alias = null;
        $this->table_name = null;
        $this->is_active = null;
        $this->definition = null;
        $this->type = null;
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
            if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration = null;
        $this->collSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyDynamicEntityConfigurationTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT] = true;

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
