<?php

namespace Orm\Zed\Oms\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcess as ChildSpyOmsOrderProcess;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery as ChildSpyOmsOrderProcessQuery;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery as ChildSpyOmsTransitionLogQuery;
use Orm\Zed\Oms\Persistence\Map\SpyOmsTransitionLogTableMap;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_oms_transition_log' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Oms.Persistence.Base
 */
abstract class SpyOmsTransitionLog implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Oms\\Persistence\\Map\\SpyOmsTransitionLogTableMap';


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
     * The value for the id_oms_transition_log field.
     *
     * @var        int
     */
    protected $id_oms_transition_log;

    /**
     * The value for the fk_oms_order_process field.
     *
     * @var        int|null
     */
    protected $fk_oms_order_process;

    /**
     * The value for the fk_sales_order field.
     *
     * @var        int
     */
    protected $fk_sales_order;

    /**
     * The value for the fk_sales_order_item field.
     *
     * @var        int
     */
    protected $fk_sales_order_item;

    /**
     * The value for the command field.
     * A command to be executed by the system.
     * @var        string|null
     */
    protected $command;

    /**
     * The value for the condition field.
     * A condition in a rule or query.
     * @var        string|null
     */
    protected $condition;

    /**
     * The value for the error_message field.
     * A message describing an error.
     * @var        string|null
     */
    protected $error_message;

    /**
     * The value for the event field.
     * The name of an event that has occurred.
     * @var        string|null
     */
    protected $event;

    /**
     * The value for the hostname field.
     * The hostname of the server processing a request.
     * @var        string
     */
    protected $hostname;

    /**
     * The value for the is_error field.
     * A flag indicating if an error occurred.
     * @var        boolean|null
     */
    protected $is_error;

    /**
     * The value for the locked field.
     * A flag indicating if a state machine process is locked to prevent concurrent modifications.
     * @var        boolean|null
     */
    protected $locked;

    /**
     * The value for the params field.
     * A set of parameters that can be passed to a state machine transition.
     * @var        array|null
     */
    protected $params;

    /**
     * The unserialized $params value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $params_unserialized;

    /**
     * The value for the path field.
     * The path for an API endpoint or a file.
     * @var        string|null
     */
    protected $path;

    /**
     * The value for the quantity field.
     * The number of units for an item.
     * @var        int|null
     */
    protected $quantity;

    /**
     * The value for the source_state field.
     * The state from which a state machine transition originates.
     * @var        string|null
     */
    protected $source_state;

    /**
     * The value for the target_state field.
     * The state to which a state machine transition leads.
     * @var        string|null
     */
    protected $target_state;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * @var        SpySalesOrder
     */
    protected $aOrder;

    /**
     * @var        SpySalesOrderItem
     */
    protected $aOrderItem;

    /**
     * @var        ChildSpyOmsOrderProcess
     */
    protected $aProcess;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Orm\Zed\Oms\Persistence\Base\SpyOmsTransitionLog object.
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
     * Compares this with another <code>SpyOmsTransitionLog</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyOmsTransitionLog</code>, delegates to
     * <code>equals(SpyOmsTransitionLog)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_oms_transition_log] column value.
     *
     * @return int
     */
    public function getIdOmsTransitionLog()
    {
        return $this->id_oms_transition_log;
    }

    /**
     * Get the [fk_oms_order_process] column value.
     *
     * @return int|null
     */
    public function getFkOmsOrderProcess()
    {
        return $this->fk_oms_order_process;
    }

    /**
     * Get the [fk_sales_order] column value.
     *
     * @return int
     */
    public function getFkSalesOrder()
    {
        return $this->fk_sales_order;
    }

    /**
     * Get the [fk_sales_order_item] column value.
     *
     * @return int
     */
    public function getFkSalesOrderItem()
    {
        return $this->fk_sales_order_item;
    }

    /**
     * Get the [command] column value.
     * A command to be executed by the system.
     * @return string|null
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Get the [condition] column value.
     * A condition in a rule or query.
     * @return string|null
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Get the [error_message] column value.
     * A message describing an error.
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * Get the [event] column value.
     * The name of an event that has occurred.
     * @return string|null
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get the [hostname] column value.
     * The hostname of the server processing a request.
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Get the [is_error] column value.
     * A flag indicating if an error occurred.
     * @return boolean|null
     */
    public function getIsError()
    {
        return $this->is_error;
    }

    /**
     * Get the [is_error] column value.
     * A flag indicating if an error occurred.
     * @return boolean|null
     */
    public function isError()
    {
        return $this->getIsError();
    }

    /**
     * Get the [locked] column value.
     * A flag indicating if a state machine process is locked to prevent concurrent modifications.
     * @return boolean|null
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Get the [locked] column value.
     * A flag indicating if a state machine process is locked to prevent concurrent modifications.
     * @return boolean|null
     */
    public function isLocked()
    {
        return $this->getLocked();
    }

    /**
     * Get the [params] column value.
     * A set of parameters that can be passed to a state machine transition.
     * @return array|null
     */
    public function getParams()
    {
        if (null === $this->params_unserialized) {
            $this->params_unserialized = [];
        }
        if (!$this->params_unserialized && null !== $this->params) {
            $params_unserialized = substr($this->params, 2, -2);
            $this->params_unserialized = '' !== $params_unserialized ? explode(' | ', $params_unserialized) : array();
        }

        return $this->params_unserialized;
    }

    /**
     * Test the presence of a value in the [params] array column value.
     * @param mixed $value
     * A set of parameters that can be passed to a state machine transition.
     * @return bool
     */
    public function hasParam($value): bool
    {
        return in_array($value, $this->getParams());
    }

    /**
     * Get the [path] column value.
     * The path for an API endpoint or a file.
     * @return string|null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the [quantity] column value.
     * The number of units for an item.
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the [source_state] column value.
     * The state from which a state machine transition originates.
     * @return string|null
     */
    public function getSourceState()
    {
        return $this->source_state;
    }

    /**
     * Get the [target_state] column value.
     * The state to which a state machine transition leads.
     * @return string|null
     */
    public function getTargetState()
    {
        return $this->target_state;
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
     * Set the value of [id_oms_transition_log] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdOmsTransitionLog($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_oms_transition_log !== $v) {
            $this->id_oms_transition_log = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_oms_order_process] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkOmsOrderProcess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_oms_order_process !== $v) {
            $this->fk_oms_order_process = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS] = true;
        }

        if ($this->aProcess !== null && $this->aProcess->getIdOmsOrderProcess() !== $v) {
            $this->aProcess = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order !== $v) {
            $this->fk_sales_order = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER] = true;
        }

        if ($this->aOrder !== null && $this->aOrder->getIdSalesOrder() !== $v) {
            $this->aOrder = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_item] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderItem($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_item !== $v) {
            $this->fk_sales_order_item = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM] = true;
        }

        if ($this->aOrderItem !== null && $this->aOrderItem->getIdSalesOrderItem() !== $v) {
            $this->aOrderItem = null;
        }

        return $this;
    }

    /**
     * Set the value of [command] column.
     * A command to be executed by the system.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCommand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->command !== $v) {
            $this->command = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_COMMAND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [condition] column.
     * A condition in a rule or query.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCondition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->condition !== $v) {
            $this->condition = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_CONDITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [error_message] column.
     * A message describing an error.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setErrorMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->error_message !== $v) {
            $this->error_message = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [event] column.
     * The name of an event that has occurred.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEvent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->event !== $v) {
            $this->event = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_EVENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [hostname] column.
     * The hostname of the server processing a request.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHostname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->hostname !== $v) {
            $this->hostname = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_HOSTNAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_error] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an error occurred.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsError($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (bool) $v;
            }
        }

        $allowNullValues = true;

        if ($v === null && !$allowNullValues) {
            return $this;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->is_error !== $v) {
            $this->is_error = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_IS_ERROR] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [locked] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a state machine process is locked to prevent concurrent modifications.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setLocked($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (bool) $v;
            }
        }

        $allowNullValues = true;

        if ($v === null && !$allowNullValues) {
            return $this;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->locked !== $v) {
            $this->locked = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_LOCKED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [params] column.
     * A set of parameters that can be passed to a state machine transition.
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setParams($v)
    {
        if ($this->params_unserialized !== $v) {
            $this->params_unserialized = $v;
            $this->params = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_PARAMS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [params] array column value.
     * @param mixed $value
     * A set of parameters that can be passed to a state machine transition.
     * @return $this The current object (for fluent API support)
     */
    public function addParam($value)
    {
        $currentArray = $this->getParams();
        $currentArray []= $value;
        $this->setParams($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [params] array column value.
     * @param mixed $value
     * A set of parameters that can be passed to a state machine transition.
     * @return $this The current object (for fluent API support)
     */
    public function removeParam($value)
    {
        $targetArray = [];
        foreach ($this->getParams() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setParams($targetArray);

        return $this;
    }

    /**
     * Set the value of [path] column.
     * The path for an API endpoint or a file.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->path !== $v) {
            $this->path = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_PATH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity] column.
     * The number of units for an item.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_QUANTITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [source_state] column.
     * The state from which a state machine transition originates.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSourceState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->source_state !== $v) {
            $this->source_state = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_SOURCE_STATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [target_state] column.
     * The state to which a state machine transition leads.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTargetState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->target_state !== $v) {
            $this->target_state = $v;
            $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_TARGET_STATE] = true;
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
                $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_CREATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_oms_transition_log = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('FkOmsOrderProcess', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_oms_order_process = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('FkSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_item = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Command', TableMap::TYPE_PHPNAME, $indexType)];
            $this->command = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Condition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->condition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('ErrorMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->error_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Event', TableMap::TYPE_PHPNAME, $indexType)];
            $this->event = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Hostname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hostname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('IsError', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_error = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Locked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locked = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Params', TableMap::TYPE_PHPNAME, $indexType)];
            $this->params = $col;
            $this->params_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Path', TableMap::TYPE_PHPNAME, $indexType)];
            $this->path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('Quantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('SourceState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->source_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('TargetState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->target_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyOmsTransitionLogTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = SpyOmsTransitionLogTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsTransitionLog'), 0, $e);
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
        if ($this->aProcess !== null && $this->fk_oms_order_process !== $this->aProcess->getIdOmsOrderProcess()) {
            $this->aProcess = null;
        }
        if ($this->aOrder !== null && $this->fk_sales_order !== $this->aOrder->getIdSalesOrder()) {
            $this->aOrder = null;
        }
        if ($this->aOrderItem !== null && $this->fk_sales_order_item !== $this->aOrderItem->getIdSalesOrderItem()) {
            $this->aOrderItem = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyOmsTransitionLogTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyOmsTransitionLogQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrder = null;
            $this->aOrderItem = null;
            $this->aProcess = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyOmsTransitionLog::setDeleted()
     * @see SpyOmsTransitionLog::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsTransitionLogTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyOmsTransitionLogQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsTransitionLogTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyOmsTransitionLogTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
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
                SpyOmsTransitionLogTableMap::addInstanceToPool($this);
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

            if ($this->aOrder !== null) {
                if ($this->aOrder->isModified() || $this->aOrder->isNew()) {
                    $affectedRows += $this->aOrder->save($con);
                }
                $this->setOrder($this->aOrder);
            }

            if ($this->aOrderItem !== null) {
                if ($this->aOrderItem->isModified() || $this->aOrderItem->isNew()) {
                    $affectedRows += $this->aOrderItem->save($con);
                }
                $this->setOrderItem($this->aOrderItem);
            }

            if ($this->aProcess !== null) {
                if ($this->aProcess->isModified() || $this->aProcess->isNew()) {
                    $affectedRows += $this->aProcess->save($con);
                }
                $this->setProcess($this->aProcess);
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

        $this->modifiedColumns[SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG] = true;
        if (null !== $this->id_oms_transition_log) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG)) {
            $modifiedColumns[':p' . $index++]  = '`id_oms_transition_log`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS)) {
            $modifiedColumns[':p' . $index++]  = '`fk_oms_order_process`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER)) {
            $modifiedColumns[':p' . $index++]  = '`fk_sales_order`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM)) {
            $modifiedColumns[':p' . $index++]  = '`fk_sales_order_item`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_COMMAND)) {
            $modifiedColumns[':p' . $index++]  = '`command`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_CONDITION)) {
            $modifiedColumns[':p' . $index++]  = '`condition`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = '`error_message`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_EVENT)) {
            $modifiedColumns[':p' . $index++]  = '`event`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_HOSTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`hostname`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_IS_ERROR)) {
            $modifiedColumns[':p' . $index++]  = '`is_error`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_LOCKED)) {
            $modifiedColumns[':p' . $index++]  = '`locked`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_PARAMS)) {
            $modifiedColumns[':p' . $index++]  = '`params`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`path`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = '`quantity`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_SOURCE_STATE)) {
            $modifiedColumns[':p' . $index++]  = '`source_state`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_TARGET_STATE)) {
            $modifiedColumns[':p' . $index++]  = '`target_state`';
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_oms_transition_log` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_oms_transition_log`':
                        $stmt->bindValue($identifier, $this->id_oms_transition_log, PDO::PARAM_INT);

                        break;
                    case '`fk_oms_order_process`':
                        $stmt->bindValue($identifier, $this->fk_oms_order_process, PDO::PARAM_INT);

                        break;
                    case '`fk_sales_order`':
                        $stmt->bindValue($identifier, $this->fk_sales_order, PDO::PARAM_INT);

                        break;
                    case '`fk_sales_order_item`':
                        $stmt->bindValue($identifier, $this->fk_sales_order_item, PDO::PARAM_INT);

                        break;
                    case '`command`':
                        $stmt->bindValue($identifier, $this->command, PDO::PARAM_STR);

                        break;
                    case '`condition`':
                        $stmt->bindValue($identifier, $this->condition, PDO::PARAM_STR);

                        break;
                    case '`error_message`':
                        $stmt->bindValue($identifier, $this->error_message, PDO::PARAM_STR);

                        break;
                    case '`event`':
                        $stmt->bindValue($identifier, $this->event, PDO::PARAM_STR);

                        break;
                    case '`hostname`':
                        $stmt->bindValue($identifier, $this->hostname, PDO::PARAM_STR);

                        break;
                    case '`is_error`':
                        $stmt->bindValue($identifier, (int) $this->is_error, PDO::PARAM_INT);

                        break;
                    case '`locked`':
                        $stmt->bindValue($identifier, (int) $this->locked, PDO::PARAM_INT);

                        break;
                    case '`params`':
                        $stmt->bindValue($identifier, $this->params, PDO::PARAM_STR);

                        break;
                    case '`path`':
                        $stmt->bindValue($identifier, $this->path, PDO::PARAM_STR);

                        break;
                    case '`quantity`':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_INT);

                        break;
                    case '`source_state`':
                        $stmt->bindValue($identifier, $this->source_state, PDO::PARAM_STR);

                        break;
                    case '`target_state`':
                        $stmt->bindValue($identifier, $this->target_state, PDO::PARAM_STR);

                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_oms_transition_log_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdOmsTransitionLog($pk);

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
        $pos = SpyOmsTransitionLogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdOmsTransitionLog();

            case 1:
                return $this->getFkOmsOrderProcess();

            case 2:
                return $this->getFkSalesOrder();

            case 3:
                return $this->getFkSalesOrderItem();

            case 4:
                return $this->getCommand();

            case 5:
                return $this->getCondition();

            case 6:
                return $this->getErrorMessage();

            case 7:
                return $this->getEvent();

            case 8:
                return $this->getHostname();

            case 9:
                return $this->getIsError();

            case 10:
                return $this->getLocked();

            case 11:
                return $this->getParams();

            case 12:
                return $this->getPath();

            case 13:
                return $this->getQuantity();

            case 14:
                return $this->getSourceState();

            case 15:
                return $this->getTargetState();

            case 16:
                return $this->getCreatedAt();

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
        if (isset($alreadyDumpedObjects['SpyOmsTransitionLog'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyOmsTransitionLog'][$this->hashCode()] = true;
        $keys = SpyOmsTransitionLogTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdOmsTransitionLog(),
            $keys[1] => $this->getFkOmsOrderProcess(),
            $keys[2] => $this->getFkSalesOrder(),
            $keys[3] => $this->getFkSalesOrderItem(),
            $keys[4] => $this->getCommand(),
            $keys[5] => $this->getCondition(),
            $keys[6] => $this->getErrorMessage(),
            $keys[7] => $this->getEvent(),
            $keys[8] => $this->getHostname(),
            $keys[9] => $this->getIsError(),
            $keys[10] => $this->getLocked(),
            $keys[11] => $this->getParams(),
            $keys[12] => $this->getPath(),
            $keys[13] => $this->getQuantity(),
            $keys[14] => $this->getSourceState(),
            $keys[15] => $this->getTargetState(),
            $keys[16] => $this->getCreatedAt(),
        ];
        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOrder) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrder';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order';
                        break;
                    default:
                        $key = 'Order';
                }

                $result[$key] = $this->aOrder->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOrderItem) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItem';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item';
                        break;
                    default:
                        $key = 'OrderItem';
                }

                $result[$key] = $this->aOrderItem->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProcess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsOrderProcess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_order_process';
                        break;
                    default:
                        $key = 'Process';
                }

                $result[$key] = $this->aProcess->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyOmsTransitionLogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdOmsTransitionLog($value);
                break;
            case 1:
                $this->setFkOmsOrderProcess($value);
                break;
            case 2:
                $this->setFkSalesOrder($value);
                break;
            case 3:
                $this->setFkSalesOrderItem($value);
                break;
            case 4:
                $this->setCommand($value);
                break;
            case 5:
                $this->setCondition($value);
                break;
            case 6:
                $this->setErrorMessage($value);
                break;
            case 7:
                $this->setEvent($value);
                break;
            case 8:
                $this->setHostname($value);
                break;
            case 9:
                $this->setIsError($value);
                break;
            case 10:
                $this->setLocked($value);
                break;
            case 11:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setParams($value);
                break;
            case 12:
                $this->setPath($value);
                break;
            case 13:
                $this->setQuantity($value);
                break;
            case 14:
                $this->setSourceState($value);
                break;
            case 15:
                $this->setTargetState($value);
                break;
            case 16:
                $this->setCreatedAt($value);
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
        $keys = SpyOmsTransitionLogTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdOmsTransitionLog($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkOmsOrderProcess($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkSalesOrder($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkSalesOrderItem($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCommand($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCondition($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setErrorMessage($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEvent($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setHostname($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIsError($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLocked($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setParams($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPath($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setQuantity($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setSourceState($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setTargetState($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCreatedAt($arr[$keys[16]]);
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
        $criteria = new Criteria(SpyOmsTransitionLogTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG, $this->id_oms_transition_log);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS, $this->fk_oms_order_process);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER, $this->fk_sales_order);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM, $this->fk_sales_order_item);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_COMMAND)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_COMMAND, $this->command);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_CONDITION)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_CONDITION, $this->condition);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE, $this->error_message);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_EVENT)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_EVENT, $this->event);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_HOSTNAME)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_HOSTNAME, $this->hostname);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_IS_ERROR)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_IS_ERROR, $this->is_error);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_LOCKED)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_LOCKED, $this->locked);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_PARAMS)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_PARAMS, $this->params);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_PATH)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_PATH, $this->path);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_QUANTITY)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_QUANTITY, $this->quantity);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_SOURCE_STATE)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_SOURCE_STATE, $this->source_state);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_TARGET_STATE)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_TARGET_STATE, $this->target_state);
        }
        if ($this->isColumnModified(SpyOmsTransitionLogTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyOmsTransitionLogTableMap::COL_CREATED_AT, $this->created_at);
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
        $criteria = ChildSpyOmsTransitionLogQuery::create();
        $criteria->add(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG, $this->id_oms_transition_log);

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
        $validPk = null !== $this->getIdOmsTransitionLog();

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
        return $this->getIdOmsTransitionLog();
    }

    /**
     * Generic method to set the primary key (id_oms_transition_log column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdOmsTransitionLog($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdOmsTransitionLog();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkOmsOrderProcess($this->getFkOmsOrderProcess());
        $copyObj->setFkSalesOrder($this->getFkSalesOrder());
        $copyObj->setFkSalesOrderItem($this->getFkSalesOrderItem());
        $copyObj->setCommand($this->getCommand());
        $copyObj->setCondition($this->getCondition());
        $copyObj->setErrorMessage($this->getErrorMessage());
        $copyObj->setEvent($this->getEvent());
        $copyObj->setHostname($this->getHostname());
        $copyObj->setIsError($this->getIsError());
        $copyObj->setLocked($this->getLocked());
        $copyObj->setParams($this->getParams());
        $copyObj->setPath($this->getPath());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setSourceState($this->getSourceState());
        $copyObj->setTargetState($this->getTargetState());
        $copyObj->setCreatedAt($this->getCreatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdOmsTransitionLog(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog Clone of current object.
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
     * Declares an association between this object and a SpySalesOrder object.
     *
     * @param SpySalesOrder $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrder(SpySalesOrder $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrder(NULL);
        } else {
            $this->setFkSalesOrder($v->getIdSalesOrder());
        }

        $this->aOrder = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpySalesOrder object, it will not be re-added.
        if ($v !== null) {
            $v->addTransitionLog($this);
        }


        return $this;
    }


    /**
     * Get the associated SpySalesOrder object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpySalesOrder The associated SpySalesOrder object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrder(?ConnectionInterface $con = null)
    {
        if ($this->aOrder === null && ($this->fk_sales_order != 0)) {
            $this->aOrder = SpySalesOrderQuery::create()->findPk($this->fk_sales_order, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrder->addTransitionLogs($this);
             */
        }

        return $this->aOrder;
    }

    /**
     * Declares an association between this object and a SpySalesOrderItem object.
     *
     * @param SpySalesOrderItem $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrderItem(SpySalesOrderItem $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderItem(NULL);
        } else {
            $this->setFkSalesOrderItem($v->getIdSalesOrderItem());
        }

        $this->aOrderItem = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpySalesOrderItem object, it will not be re-added.
        if ($v !== null) {
            $v->addTransitionLog($this);
        }


        return $this;
    }


    /**
     * Get the associated SpySalesOrderItem object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpySalesOrderItem The associated SpySalesOrderItem object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderItem(?ConnectionInterface $con = null)
    {
        if ($this->aOrderItem === null && ($this->fk_sales_order_item != 0)) {
            $this->aOrderItem = SpySalesOrderItemQuery::create()->findPk($this->fk_sales_order_item, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrderItem->addTransitionLogs($this);
             */
        }

        return $this->aOrderItem;
    }

    /**
     * Declares an association between this object and a ChildSpyOmsOrderProcess object.
     *
     * @param ChildSpyOmsOrderProcess|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProcess(ChildSpyOmsOrderProcess $v = null)
    {
        if ($v === null) {
            $this->setFkOmsOrderProcess(NULL);
        } else {
            $this->setFkOmsOrderProcess($v->getIdOmsOrderProcess());
        }

        $this->aProcess = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyOmsOrderProcess object, it will not be re-added.
        if ($v !== null) {
            $v->addTransitionLog($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyOmsOrderProcess object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyOmsOrderProcess|null The associated ChildSpyOmsOrderProcess object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProcess(?ConnectionInterface $con = null)
    {
        if ($this->aProcess === null && ($this->fk_oms_order_process != 0)) {
            $this->aProcess = ChildSpyOmsOrderProcessQuery::create()->findPk($this->fk_oms_order_process, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProcess->addTransitionLogs($this);
             */
        }

        return $this->aProcess;
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
        if (null !== $this->aOrder) {
            $this->aOrder->removeTransitionLog($this);
        }
        if (null !== $this->aOrderItem) {
            $this->aOrderItem->removeTransitionLog($this);
        }
        if (null !== $this->aProcess) {
            $this->aProcess->removeTransitionLog($this);
        }
        $this->id_oms_transition_log = null;
        $this->fk_oms_order_process = null;
        $this->fk_sales_order = null;
        $this->fk_sales_order_item = null;
        $this->command = null;
        $this->condition = null;
        $this->error_message = null;
        $this->event = null;
        $this->hostname = null;
        $this->is_error = null;
        $this->locked = null;
        $this->params = null;
        $this->params_unserialized = null;
        $this->path = null;
        $this->quantity = null;
        $this->source_state = null;
        $this->target_state = null;
        $this->created_at = null;
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
        } // if ($deep)

        $this->aOrder = null;
        $this->aOrderItem = null;
        $this->aProcess = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyOmsTransitionLogTableMap::DEFAULT_STRING_FORMAT);
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
