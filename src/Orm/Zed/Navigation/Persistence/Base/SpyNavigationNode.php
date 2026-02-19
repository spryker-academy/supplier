<?php

namespace Orm\Zed\Navigation\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Navigation\Persistence\SpyNavigation as ChildSpyNavigation;
use Orm\Zed\Navigation\Persistence\SpyNavigationNode as ChildSpyNavigationNode;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes as ChildSpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery as ChildSpyNavigationNodeLocalizedAttributesQuery;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery as ChildSpyNavigationNodeQuery;
use Orm\Zed\Navigation\Persistence\SpyNavigationQuery as ChildSpyNavigationQuery;
use Orm\Zed\Navigation\Persistence\Map\SpyNavigationNodeLocalizedAttributesTableMap;
use Orm\Zed\Navigation\Persistence\Map\SpyNavigationNodeTableMap;
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
 * Base class that represents a row from the 'spy_navigation_node' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Navigation.Persistence.Base
 */
abstract class SpyNavigationNode implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Navigation\\Persistence\\Map\\SpyNavigationNodeTableMap';


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
     * The value for the id_navigation_node field.
     *
     * @var        int
     */
    protected $id_navigation_node;

    /**
     * The value for the fk_navigation field.
     *
     * @var        int
     */
    protected $fk_navigation;

    /**
     * The value for the fk_parent_navigation_node field.
     *
     * @var        int|null
     */
    protected $fk_parent_navigation_node;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the node_key field.
     *
     * @var        string|null
     */
    protected $node_key;

    /**
     * The value for the node_type field.
     * The type of a node in a navigation tree.
     * @var        string|null
     */
    protected $node_type;

    /**
     * The value for the position field.
     * The position or order of an item in a list.
     * @var        int|null
     */
    protected $position;

    /**
     * The value for the valid_from field.
     * The date and time from which an entity is valid.
     * @var        DateTime|null
     */
    protected $valid_from;

    /**
     * The value for the valid_to field.
     * The date and time until which an entity is valid.
     * @var        DateTime|null
     */
    protected $valid_to;

    /**
     * @var        ChildSpyNavigationNode
     */
    protected $aParentNavigationNode;

    /**
     * @var        ChildSpyNavigation
     */
    protected $aSpyNavigation;

    /**
     * @var        ObjectCollection|ChildSpyNavigationNode[] Collection to store aggregation of ChildSpyNavigationNode objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyNavigationNode> Collection to store aggregation of ChildSpyNavigationNode objects.
     */
    protected $collChildrenNavigationNodes;
    protected $collChildrenNavigationNodesPartial;

    /**
     * @var        ObjectCollection|ChildSpyNavigationNodeLocalizedAttributes[] Collection to store aggregation of ChildSpyNavigationNodeLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> Collection to store aggregation of ChildSpyNavigationNodeLocalizedAttributes objects.
     */
    protected $collSpyNavigationNodeLocalizedAttributess;
    protected $collSpyNavigationNodeLocalizedAttributessPartial;

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
        'spy_navigation_node.fk_parent_navigation_node' => 'fk_parent_navigation_node',
        'spy_navigation_node.fk_navigation' => 'fk_navigation',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyNavigationNode[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyNavigationNode>
     */
    protected $childrenNavigationNodesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyNavigationNodeLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes>
     */
    protected $spyNavigationNodeLocalizedAttributessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
    }

    /**
     * Initializes internal state of Orm\Zed\Navigation\Persistence\Base\SpyNavigationNode object.
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
     * Compares this with another <code>SpyNavigationNode</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyNavigationNode</code>, delegates to
     * <code>equals(SpyNavigationNode)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_navigation_node] column value.
     *
     * @return int
     */
    public function getIdNavigationNode()
    {
        return $this->id_navigation_node;
    }

    /**
     * Get the [fk_navigation] column value.
     *
     * @return int
     */
    public function getFkNavigation()
    {
        return $this->fk_navigation;
    }

    /**
     * Get the [fk_parent_navigation_node] column value.
     *
     * @return int|null
     */
    public function getFkParentNavigationNode()
    {
        return $this->fk_parent_navigation_node;
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
     * Get the [node_key] column value.
     *
     * @return string|null
     */
    public function getNodeKey()
    {
        return $this->node_key;
    }

    /**
     * Get the [node_type] column value.
     * The type of a node in a navigation tree.
     * @return string|null
     */
    public function getNodeType()
    {
        return $this->node_type;
    }

    /**
     * Get the [position] column value.
     * The position or order of an item in a list.
     * @return int|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get the [optionally formatted] temporal [valid_from] column value.
     * The date and time from which an entity is valid.
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
    public function getValidFrom($format = null)
    {
        if ($format === null) {
            return $this->valid_from;
        } else {
            return $this->valid_from instanceof \DateTimeInterface ? $this->valid_from->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [valid_to] column value.
     * The date and time until which an entity is valid.
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
    public function getValidTo($format = null)
    {
        if ($format === null) {
            return $this->valid_to;
        } else {
            return $this->valid_to instanceof \DateTimeInterface ? $this->valid_to->format($format) : null;
        }
    }

    /**
     * Set the value of [id_navigation_node] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdNavigationNode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_navigation_node !== $v) {
            $this->id_navigation_node = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_navigation] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkNavigation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_navigation !== $v) {
            $this->fk_navigation = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_FK_NAVIGATION] = true;
        }

        if ($this->aSpyNavigation !== null && $this->aSpyNavigation->getIdNavigation() !== $v) {
            $this->aSpyNavigation = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_parent_navigation_node] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkParentNavigationNode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_parent_navigation_node !== $v) {
            $this->fk_parent_navigation_node = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE] = true;
        }

        if ($this->aParentNavigationNode !== null && $this->aParentNavigationNode->getIdNavigationNode() !== $v) {
            $this->aParentNavigationNode = null;
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
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [node_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNodeKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->node_key !== $v) {
            $this->node_key = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_NODE_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [node_type] column.
     * The type of a node in a navigation tree.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNodeType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->node_type !== $v) {
            $this->node_type = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_NODE_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position] column.
     * The position or order of an item in a list.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[SpyNavigationNodeTableMap::COL_POSITION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [valid_from] column to a normalized version of the date/time value specified.
     * The date and time from which an entity is valid.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setValidFrom($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->valid_from !== null || $dt !== null) {
            if ($this->valid_from === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->valid_from->format("Y-m-d H:i:s.u")) {
                $this->valid_from = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyNavigationNodeTableMap::COL_VALID_FROM] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [valid_to] column to a normalized version of the date/time value specified.
     * The date and time until which an entity is valid.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setValidTo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->valid_to !== null || $dt !== null) {
            if ($this->valid_to === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->valid_to->format("Y-m-d H:i:s.u")) {
                $this->valid_to = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyNavigationNodeTableMap::COL_VALID_TO] = true;
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
            if ($this->is_active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyNavigationNodeTableMap::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_navigation_node = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyNavigationNodeTableMap::translateFieldName('FkNavigation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_navigation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyNavigationNodeTableMap::translateFieldName('FkParentNavigationNode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_parent_navigation_node = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyNavigationNodeTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyNavigationNodeTableMap::translateFieldName('NodeKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->node_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyNavigationNodeTableMap::translateFieldName('NodeType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->node_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyNavigationNodeTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyNavigationNodeTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyNavigationNodeTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpyNavigationNodeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode'), 0, $e);
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
        if ($this->aSpyNavigation !== null && $this->fk_navigation !== $this->aSpyNavigation->getIdNavigation()) {
            $this->aSpyNavigation = null;
        }
        if ($this->aParentNavigationNode !== null && $this->fk_parent_navigation_node !== $this->aParentNavigationNode->getIdNavigationNode()) {
            $this->aParentNavigationNode = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyNavigationNodeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aParentNavigationNode = null;
            $this->aSpyNavigation = null;
            $this->collChildrenNavigationNodes = null;

            $this->collSpyNavigationNodeLocalizedAttributess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyNavigationNode::setDeleted()
     * @see SpyNavigationNode::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyNavigationNodeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
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

                SpyNavigationNodeTableMap::addInstanceToPool($this);
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

            if ($this->aParentNavigationNode !== null) {
                if ($this->aParentNavigationNode->isModified() || $this->aParentNavigationNode->isNew()) {
                    $affectedRows += $this->aParentNavigationNode->save($con);
                }
                $this->setParentNavigationNode($this->aParentNavigationNode);
            }

            if ($this->aSpyNavigation !== null) {
                if ($this->aSpyNavigation->isModified() || $this->aSpyNavigation->isNew()) {
                    $affectedRows += $this->aSpyNavigation->save($con);
                }
                $this->setSpyNavigation($this->aSpyNavigation);
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

            if ($this->childrenNavigationNodesScheduledForDeletion !== null) {
                if (!$this->childrenNavigationNodesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery::create()
                        ->filterByPrimaryKeys($this->childrenNavigationNodesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->childrenNavigationNodesScheduledForDeletion = null;
                }
            }

            if ($this->collChildrenNavigationNodes !== null) {
                foreach ($this->collChildrenNavigationNodes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyNavigationNodeLocalizedAttributess !== null) {
                foreach ($this->collSpyNavigationNodeLocalizedAttributess as $referrerFK) {
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

        $this->modifiedColumns[SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE] = true;
        if (null !== $this->id_navigation_node) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE)) {
            $modifiedColumns[':p' . $index++]  = 'id_navigation_node';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_FK_NAVIGATION)) {
            $modifiedColumns[':p' . $index++]  = 'fk_navigation';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_parent_navigation_node';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_NODE_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'node_key';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_NODE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'node_type';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'position';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'valid_from';
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = 'valid_to';
        }

        $sql = sprintf(
            'INSERT INTO spy_navigation_node (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_navigation_node':
                        $stmt->bindValue($identifier, $this->id_navigation_node, PDO::PARAM_INT);

                        break;
                    case 'fk_navigation':
                        $stmt->bindValue($identifier, $this->fk_navigation, PDO::PARAM_INT);

                        break;
                    case 'fk_parent_navigation_node':
                        $stmt->bindValue($identifier, $this->fk_parent_navigation_node, PDO::PARAM_INT);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'node_key':
                        $stmt->bindValue($identifier, $this->node_key, PDO::PARAM_STR);

                        break;
                    case 'node_type':
                        $stmt->bindValue($identifier, $this->node_type, PDO::PARAM_STR);

                        break;
                    case 'position':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);

                        break;
                    case 'valid_from':
                        $stmt->bindValue($identifier, $this->valid_from ? $this->valid_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'valid_to':
                        $stmt->bindValue($identifier, $this->valid_to ? $this->valid_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_navigation_node_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdNavigationNode($pk);

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
        $pos = SpyNavigationNodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdNavigationNode();

            case 1:
                return $this->getFkNavigation();

            case 2:
                return $this->getFkParentNavigationNode();

            case 3:
                return $this->getIsActive();

            case 4:
                return $this->getNodeKey();

            case 5:
                return $this->getNodeType();

            case 6:
                return $this->getPosition();

            case 7:
                return $this->getValidFrom();

            case 8:
                return $this->getValidTo();

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
        if (isset($alreadyDumpedObjects['SpyNavigationNode'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyNavigationNode'][$this->hashCode()] = true;
        $keys = SpyNavigationNodeTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdNavigationNode(),
            $keys[1] => $this->getFkNavigation(),
            $keys[2] => $this->getFkParentNavigationNode(),
            $keys[3] => $this->getIsActive(),
            $keys[4] => $this->getNodeKey(),
            $keys[5] => $this->getNodeType(),
            $keys[6] => $this->getPosition(),
            $keys[7] => $this->getValidFrom(),
            $keys[8] => $this->getValidTo(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aParentNavigationNode) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNavigationNode';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_navigation_node';
                        break;
                    default:
                        $key = 'ParentNavigationNode';
                }

                $result[$key] = $this->aParentNavigationNode->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyNavigation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNavigation';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_navigation';
                        break;
                    default:
                        $key = 'SpyNavigation';
                }

                $result[$key] = $this->aSpyNavigation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collChildrenNavigationNodes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNavigationNodes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_navigation_nodes';
                        break;
                    default:
                        $key = 'ChildrenNavigationNodes';
                }

                $result[$key] = $this->collChildrenNavigationNodes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyNavigationNodeLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNavigationNodeLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_navigation_node_localized_attributess';
                        break;
                    default:
                        $key = 'SpyNavigationNodeLocalizedAttributess';
                }

                $result[$key] = $this->collSpyNavigationNodeLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyNavigationNodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdNavigationNode($value);
                break;
            case 1:
                $this->setFkNavigation($value);
                break;
            case 2:
                $this->setFkParentNavigationNode($value);
                break;
            case 3:
                $this->setIsActive($value);
                break;
            case 4:
                $this->setNodeKey($value);
                break;
            case 5:
                $this->setNodeType($value);
                break;
            case 6:
                $this->setPosition($value);
                break;
            case 7:
                $this->setValidFrom($value);
                break;
            case 8:
                $this->setValidTo($value);
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
        $keys = SpyNavigationNodeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdNavigationNode($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkNavigation($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkParentNavigationNode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsActive($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNodeKey($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNodeType($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPosition($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setValidFrom($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setValidTo($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyNavigationNodeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $this->id_navigation_node);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_FK_NAVIGATION)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $this->fk_navigation);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $this->fk_parent_navigation_node);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_NODE_KEY)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_NODE_KEY, $this->node_key);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_NODE_TYPE)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_NODE_TYPE, $this->node_type);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_POSITION)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyNavigationNodeTableMap::COL_VALID_TO)) {
            $criteria->add(SpyNavigationNodeTableMap::COL_VALID_TO, $this->valid_to);
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
        $criteria = ChildSpyNavigationNodeQuery::create();
        $criteria->add(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $this->id_navigation_node);

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
        $validPk = null !== $this->getIdNavigationNode();

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
        return $this->getIdNavigationNode();
    }

    /**
     * Generic method to set the primary key (id_navigation_node column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdNavigationNode($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdNavigationNode();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Navigation\Persistence\SpyNavigationNode (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkNavigation($this->getFkNavigation());
        $copyObj->setFkParentNavigationNode($this->getFkParentNavigationNode());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setNodeKey($this->getNodeKey());
        $copyObj->setNodeType($this->getNodeType());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getChildrenNavigationNodes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChildrenNavigationNode($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyNavigationNodeLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyNavigationNodeLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdNavigationNode(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNode Clone of current object.
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
     * Declares an association between this object and a ChildSpyNavigationNode object.
     *
     * @param ChildSpyNavigationNode|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setParentNavigationNode(ChildSpyNavigationNode $v = null)
    {
        if ($v === null) {
            $this->setFkParentNavigationNode(NULL);
        } else {
            $this->setFkParentNavigationNode($v->getIdNavigationNode());
        }

        $this->aParentNavigationNode = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyNavigationNode object, it will not be re-added.
        if ($v !== null) {
            $v->addChildrenNavigationNode($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyNavigationNode object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyNavigationNode|null The associated ChildSpyNavigationNode object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getParentNavigationNode(?ConnectionInterface $con = null)
    {
        if ($this->aParentNavigationNode === null && ($this->fk_parent_navigation_node != 0)) {
            $this->aParentNavigationNode = ChildSpyNavigationNodeQuery::create()->findPk($this->fk_parent_navigation_node, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aParentNavigationNode->addChildrenNavigationNodes($this);
             */
        }

        return $this->aParentNavigationNode;
    }

    /**
     * Declares an association between this object and a ChildSpyNavigation object.
     *
     * @param ChildSpyNavigation $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyNavigation(ChildSpyNavigation $v = null)
    {
        if ($v === null) {
            $this->setFkNavigation(NULL);
        } else {
            $this->setFkNavigation($v->getIdNavigation());
        }

        $this->aSpyNavigation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyNavigation object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyNavigationNode($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyNavigation object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyNavigation The associated ChildSpyNavigation object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyNavigation(?ConnectionInterface $con = null)
    {
        if ($this->aSpyNavigation === null && ($this->fk_navigation != 0)) {
            $this->aSpyNavigation = ChildSpyNavigationQuery::create()->findPk($this->fk_navigation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyNavigation->addSpyNavigationNodes($this);
             */
        }

        return $this->aSpyNavigation;
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
        if ('ChildrenNavigationNode' === $relationName) {
            $this->initChildrenNavigationNodes();
            return;
        }
        if ('SpyNavigationNodeLocalizedAttributes' === $relationName) {
            $this->initSpyNavigationNodeLocalizedAttributess();
            return;
        }
    }

    /**
     * Clears out the collChildrenNavigationNodes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addChildrenNavigationNodes()
     */
    public function clearChildrenNavigationNodes()
    {
        $this->collChildrenNavigationNodes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collChildrenNavigationNodes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialChildrenNavigationNodes($v = true): void
    {
        $this->collChildrenNavigationNodesPartial = $v;
    }

    /**
     * Initializes the collChildrenNavigationNodes collection.
     *
     * By default this just sets the collChildrenNavigationNodes collection to an empty array (like clearcollChildrenNavigationNodes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChildrenNavigationNodes(bool $overrideExisting = true): void
    {
        if (null !== $this->collChildrenNavigationNodes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyNavigationNodeTableMap::getTableMap()->getCollectionClassName();

        $this->collChildrenNavigationNodes = new $collectionClassName;
        $this->collChildrenNavigationNodes->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNode');
    }

    /**
     * Gets an array of ChildSpyNavigationNode objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyNavigationNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyNavigationNode[] List of ChildSpyNavigationNode objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyNavigationNode> List of ChildSpyNavigationNode objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getChildrenNavigationNodes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collChildrenNavigationNodesPartial && !$this->isNew();
        if (null === $this->collChildrenNavigationNodes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collChildrenNavigationNodes) {
                    $this->initChildrenNavigationNodes();
                } else {
                    $collectionClassName = SpyNavigationNodeTableMap::getTableMap()->getCollectionClassName();

                    $collChildrenNavigationNodes = new $collectionClassName;
                    $collChildrenNavigationNodes->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNode');

                    return $collChildrenNavigationNodes;
                }
            } else {
                $collChildrenNavigationNodes = ChildSpyNavigationNodeQuery::create(null, $criteria)
                    ->filterByParentNavigationNode($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collChildrenNavigationNodesPartial && count($collChildrenNavigationNodes)) {
                        $this->initChildrenNavigationNodes(false);

                        foreach ($collChildrenNavigationNodes as $obj) {
                            if (false == $this->collChildrenNavigationNodes->contains($obj)) {
                                $this->collChildrenNavigationNodes->append($obj);
                            }
                        }

                        $this->collChildrenNavigationNodesPartial = true;
                    }

                    return $collChildrenNavigationNodes;
                }

                if ($partial && $this->collChildrenNavigationNodes) {
                    foreach ($this->collChildrenNavigationNodes as $obj) {
                        if ($obj->isNew()) {
                            $collChildrenNavigationNodes[] = $obj;
                        }
                    }
                }

                $this->collChildrenNavigationNodes = $collChildrenNavigationNodes;
                $this->collChildrenNavigationNodesPartial = false;
            }
        }

        return $this->collChildrenNavigationNodes;
    }

    /**
     * Sets a collection of ChildSpyNavigationNode objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $childrenNavigationNodes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setChildrenNavigationNodes(Collection $childrenNavigationNodes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyNavigationNode[] $childrenNavigationNodesToDelete */
        $childrenNavigationNodesToDelete = $this->getChildrenNavigationNodes(new Criteria(), $con)->diff($childrenNavigationNodes);


        $this->childrenNavigationNodesScheduledForDeletion = $childrenNavigationNodesToDelete;

        foreach ($childrenNavigationNodesToDelete as $childrenNavigationNodeRemoved) {
            $childrenNavigationNodeRemoved->setParentNavigationNode(null);
        }

        $this->collChildrenNavigationNodes = null;
        foreach ($childrenNavigationNodes as $childrenNavigationNode) {
            $this->addChildrenNavigationNode($childrenNavigationNode);
        }

        $this->collChildrenNavigationNodes = $childrenNavigationNodes;
        $this->collChildrenNavigationNodesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyNavigationNode objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyNavigationNode objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countChildrenNavigationNodes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collChildrenNavigationNodesPartial && !$this->isNew();
        if (null === $this->collChildrenNavigationNodes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChildrenNavigationNodes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getChildrenNavigationNodes());
            }

            $query = ChildSpyNavigationNodeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByParentNavigationNode($this)
                ->count($con);
        }

        return count($this->collChildrenNavigationNodes);
    }

    /**
     * Method called to associate a ChildSpyNavigationNode object to this object
     * through the ChildSpyNavigationNode foreign key attribute.
     *
     * @param ChildSpyNavigationNode $l ChildSpyNavigationNode
     * @return $this The current object (for fluent API support)
     */
    public function addChildrenNavigationNode(ChildSpyNavigationNode $l)
    {
        if ($this->collChildrenNavigationNodes === null) {
            $this->initChildrenNavigationNodes();
            $this->collChildrenNavigationNodesPartial = true;
        }

        if (!$this->collChildrenNavigationNodes->contains($l)) {
            $this->doAddChildrenNavigationNode($l);

            if ($this->childrenNavigationNodesScheduledForDeletion and $this->childrenNavigationNodesScheduledForDeletion->contains($l)) {
                $this->childrenNavigationNodesScheduledForDeletion->remove($this->childrenNavigationNodesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyNavigationNode $childrenNavigationNode The ChildSpyNavigationNode object to add.
     */
    protected function doAddChildrenNavigationNode(ChildSpyNavigationNode $childrenNavigationNode): void
    {
        $this->collChildrenNavigationNodes[]= $childrenNavigationNode;
        $childrenNavigationNode->setParentNavigationNode($this);
    }

    /**
     * @param ChildSpyNavigationNode $childrenNavigationNode The ChildSpyNavigationNode object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeChildrenNavigationNode(ChildSpyNavigationNode $childrenNavigationNode)
    {
        if ($this->getChildrenNavigationNodes()->contains($childrenNavigationNode)) {
            $pos = $this->collChildrenNavigationNodes->search($childrenNavigationNode);
            $this->collChildrenNavigationNodes->remove($pos);
            if (null === $this->childrenNavigationNodesScheduledForDeletion) {
                $this->childrenNavigationNodesScheduledForDeletion = clone $this->collChildrenNavigationNodes;
                $this->childrenNavigationNodesScheduledForDeletion->clear();
            }
            $this->childrenNavigationNodesScheduledForDeletion[]= $childrenNavigationNode;
            $childrenNavigationNode->setParentNavigationNode(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyNavigationNode is new, it will return
     * an empty collection; or if this SpyNavigationNode has previously
     * been saved, it will retrieve related ChildrenNavigationNodes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyNavigationNode.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyNavigationNode[] List of ChildSpyNavigationNode objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyNavigationNode}> List of ChildSpyNavigationNode objects
     */
    public function getChildrenNavigationNodesJoinSpyNavigation(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyNavigationNodeQuery::create(null, $criteria);
        $query->joinWith('SpyNavigation', $joinBehavior);

        return $this->getChildrenNavigationNodes($query, $con);
    }

    /**
     * Clears out the collSpyNavigationNodeLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyNavigationNodeLocalizedAttributess()
     */
    public function clearSpyNavigationNodeLocalizedAttributess()
    {
        $this->collSpyNavigationNodeLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyNavigationNodeLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyNavigationNodeLocalizedAttributess($v = true): void
    {
        $this->collSpyNavigationNodeLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyNavigationNodeLocalizedAttributess collection.
     *
     * By default this just sets the collSpyNavigationNodeLocalizedAttributess collection to an empty array (like clearcollSpyNavigationNodeLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyNavigationNodeLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyNavigationNodeLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyNavigationNodeLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyNavigationNodeLocalizedAttributess = new $collectionClassName;
        $this->collSpyNavigationNodeLocalizedAttributess->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes');
    }

    /**
     * Gets an array of ChildSpyNavigationNodeLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyNavigationNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyNavigationNodeLocalizedAttributes[] List of ChildSpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> List of ChildSpyNavigationNodeLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyNavigationNodeLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyNavigationNodeLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyNavigationNodeLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyNavigationNodeLocalizedAttributess) {
                    $this->initSpyNavigationNodeLocalizedAttributess();
                } else {
                    $collectionClassName = SpyNavigationNodeLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyNavigationNodeLocalizedAttributess = new $collectionClassName;
                    $collSpyNavigationNodeLocalizedAttributess->setModel('\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes');

                    return $collSpyNavigationNodeLocalizedAttributess;
                }
            } else {
                $collSpyNavigationNodeLocalizedAttributess = ChildSpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyNavigationNode($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyNavigationNodeLocalizedAttributessPartial && count($collSpyNavigationNodeLocalizedAttributess)) {
                        $this->initSpyNavigationNodeLocalizedAttributess(false);

                        foreach ($collSpyNavigationNodeLocalizedAttributess as $obj) {
                            if (false == $this->collSpyNavigationNodeLocalizedAttributess->contains($obj)) {
                                $this->collSpyNavigationNodeLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyNavigationNodeLocalizedAttributessPartial = true;
                    }

                    return $collSpyNavigationNodeLocalizedAttributess;
                }

                if ($partial && $this->collSpyNavigationNodeLocalizedAttributess) {
                    foreach ($this->collSpyNavigationNodeLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyNavigationNodeLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyNavigationNodeLocalizedAttributess = $collSpyNavigationNodeLocalizedAttributess;
                $this->collSpyNavigationNodeLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyNavigationNodeLocalizedAttributess;
    }

    /**
     * Sets a collection of ChildSpyNavigationNodeLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyNavigationNodeLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyNavigationNodeLocalizedAttributess(Collection $spyNavigationNodeLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyNavigationNodeLocalizedAttributes[] $spyNavigationNodeLocalizedAttributessToDelete */
        $spyNavigationNodeLocalizedAttributessToDelete = $this->getSpyNavigationNodeLocalizedAttributess(new Criteria(), $con)->diff($spyNavigationNodeLocalizedAttributess);


        $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = $spyNavigationNodeLocalizedAttributessToDelete;

        foreach ($spyNavigationNodeLocalizedAttributessToDelete as $spyNavigationNodeLocalizedAttributesRemoved) {
            $spyNavigationNodeLocalizedAttributesRemoved->setSpyNavigationNode(null);
        }

        $this->collSpyNavigationNodeLocalizedAttributess = null;
        foreach ($spyNavigationNodeLocalizedAttributess as $spyNavigationNodeLocalizedAttributes) {
            $this->addSpyNavigationNodeLocalizedAttributes($spyNavigationNodeLocalizedAttributes);
        }

        $this->collSpyNavigationNodeLocalizedAttributess = $spyNavigationNodeLocalizedAttributess;
        $this->collSpyNavigationNodeLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyNavigationNodeLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyNavigationNodeLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyNavigationNodeLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyNavigationNodeLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyNavigationNodeLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyNavigationNodeLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyNavigationNodeLocalizedAttributess());
            }

            $query = ChildSpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyNavigationNode($this)
                ->count($con);
        }

        return count($this->collSpyNavigationNodeLocalizedAttributess);
    }

    /**
     * Method called to associate a ChildSpyNavigationNodeLocalizedAttributes object to this object
     * through the ChildSpyNavigationNodeLocalizedAttributes foreign key attribute.
     *
     * @param ChildSpyNavigationNodeLocalizedAttributes $l ChildSpyNavigationNodeLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyNavigationNodeLocalizedAttributes(ChildSpyNavigationNodeLocalizedAttributes $l)
    {
        if ($this->collSpyNavigationNodeLocalizedAttributess === null) {
            $this->initSpyNavigationNodeLocalizedAttributess();
            $this->collSpyNavigationNodeLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyNavigationNodeLocalizedAttributess->contains($l)) {
            $this->doAddSpyNavigationNodeLocalizedAttributes($l);

            if ($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion and $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->remove($this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes The ChildSpyNavigationNodeLocalizedAttributes object to add.
     */
    protected function doAddSpyNavigationNodeLocalizedAttributes(ChildSpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes): void
    {
        $this->collSpyNavigationNodeLocalizedAttributess[]= $spyNavigationNodeLocalizedAttributes;
        $spyNavigationNodeLocalizedAttributes->setSpyNavigationNode($this);
    }

    /**
     * @param ChildSpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes The ChildSpyNavigationNodeLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyNavigationNodeLocalizedAttributes(ChildSpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes)
    {
        if ($this->getSpyNavigationNodeLocalizedAttributess()->contains($spyNavigationNodeLocalizedAttributes)) {
            $pos = $this->collSpyNavigationNodeLocalizedAttributess->search($spyNavigationNodeLocalizedAttributes);
            $this->collSpyNavigationNodeLocalizedAttributess->remove($pos);
            if (null === $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion) {
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion = clone $this->collSpyNavigationNodeLocalizedAttributess;
                $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyNavigationNodeLocalizedAttributessScheduledForDeletion[]= clone $spyNavigationNodeLocalizedAttributes;
            $spyNavigationNodeLocalizedAttributes->setSpyNavigationNode(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyNavigationNode is new, it will return
     * an empty collection; or if this SpyNavigationNode has previously
     * been saved, it will retrieve related SpyNavigationNodeLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyNavigationNode.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyNavigationNodeLocalizedAttributes[] List of ChildSpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes}> List of ChildSpyNavigationNodeLocalizedAttributes objects
     */
    public function getSpyNavigationNodeLocalizedAttributessJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyNavigationNodeLocalizedAttributess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyNavigationNode is new, it will return
     * an empty collection; or if this SpyNavigationNode has previously
     * been saved, it will retrieve related SpyNavigationNodeLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyNavigationNode.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyNavigationNodeLocalizedAttributes[] List of ChildSpyNavigationNodeLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes}> List of ChildSpyNavigationNodeLocalizedAttributes objects
     */
    public function getSpyNavigationNodeLocalizedAttributessJoinSpyUrl(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyNavigationNodeLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyUrl', $joinBehavior);

        return $this->getSpyNavigationNodeLocalizedAttributess($query, $con);
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
        if (null !== $this->aParentNavigationNode) {
            $this->aParentNavigationNode->removeChildrenNavigationNode($this);
        }
        if (null !== $this->aSpyNavigation) {
            $this->aSpyNavigation->removeSpyNavigationNode($this);
        }
        $this->id_navigation_node = null;
        $this->fk_navigation = null;
        $this->fk_parent_navigation_node = null;
        $this->is_active = null;
        $this->node_key = null;
        $this->node_type = null;
        $this->position = null;
        $this->valid_from = null;
        $this->valid_to = null;
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
            if ($this->collChildrenNavigationNodes) {
                foreach ($this->collChildrenNavigationNodes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyNavigationNodeLocalizedAttributess) {
                foreach ($this->collSpyNavigationNodeLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collChildrenNavigationNodes = null;
        $this->collSpyNavigationNodeLocalizedAttributess = null;
        $this->aParentNavigationNode = null;
        $this->aSpyNavigation = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyNavigationNodeTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_navigation_node.create';
        } else {
            $this->_eventName = 'Entity.spy_navigation_node.update';
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

        if ($this->_eventName !== 'Entity.spy_navigation_node.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_navigation_node',
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
            'name' => 'spy_navigation_node',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_navigation_node.delete',
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
            $field = str_replace('spy_navigation_node.', '', $modifiedColumn);
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
            $field = str_replace('spy_navigation_node.', '', $additionalValueColumnName);
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
        $columnType = SpyNavigationNodeTableMap::getTableMap()->getColumn($column)->getType();
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
