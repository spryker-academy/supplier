<?php

namespace Orm\Zed\StateMachine\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItem;
use Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItemQuery;
use Orm\Zed\ExampleStateMachine\Persistence\Base\PyzExampleStateMachineItem as BasePyzExampleStateMachineItem;
use Orm\Zed\ExampleStateMachine\Persistence\Map\PyzExampleStateMachineItemTableMap;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrderItem as BaseSpyMerchantSalesOrderItem;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderItemTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquiry as BaseSpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryTableMap;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout as ChildSpyStateMachineEventTimeout;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery as ChildSpyStateMachineEventTimeoutQuery;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState as ChildSpyStateMachineItemState;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateHistory as ChildSpyStateMachineItemStateHistory;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateHistoryQuery as ChildSpyStateMachineItemStateHistoryQuery;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery as ChildSpyStateMachineItemStateQuery;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess as ChildSpyStateMachineProcess;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery as ChildSpyStateMachineProcessQuery;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineEventTimeoutTableMap;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineItemStateHistoryTableMap;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineItemStateTableMap;
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
 * Base class that represents a row from the 'spy_state_machine_item_state' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.StateMachine.Persistence.Base
 */
abstract class SpyStateMachineItemState implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\StateMachine\\Persistence\\Map\\SpyStateMachineItemStateTableMap';


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
     * The value for the id_state_machine_item_state field.
     *
     * @var        int
     */
    protected $id_state_machine_item_state;

    /**
     * The value for the fk_state_machine_process field.
     *
     * @var        int
     */
    protected $fk_state_machine_process;

    /**
     * The value for the description field.
     * A description of an entity.
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * @var        ChildSpyStateMachineProcess
     */
    protected $aProcess;

    /**
     * @var        ObjectCollection|PyzExampleStateMachineItem[] Collection to store aggregation of PyzExampleStateMachineItem objects.
     * @phpstan-var ObjectCollection&\Traversable<PyzExampleStateMachineItem> Collection to store aggregation of PyzExampleStateMachineItem objects.
     */
    protected $collStateMachineItemStates;
    protected $collStateMachineItemStatesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantSalesOrderItem[] Collection to store aggregation of SpyMerchantSalesOrderItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrderItem> Collection to store aggregation of SpyMerchantSalesOrderItem objects.
     */
    protected $collSpyMerchantSalesOrderItems;
    protected $collSpyMerchantSalesOrderItemsPartial;

    /**
     * @var        ObjectCollection|SpySspInquiry[] Collection to store aggregation of SpySspInquiry objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiry> Collection to store aggregation of SpySspInquiry objects.
     */
    protected $collSpySspInquiries;
    protected $collSpySspInquiriesPartial;

    /**
     * @var        ObjectCollection|ChildSpyStateMachineItemStateHistory[] Collection to store aggregation of ChildSpyStateMachineItemStateHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStateMachineItemStateHistory> Collection to store aggregation of ChildSpyStateMachineItemStateHistory objects.
     */
    protected $collStateHistories;
    protected $collStateHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildSpyStateMachineEventTimeout[] Collection to store aggregation of ChildSpyStateMachineEventTimeout objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStateMachineEventTimeout> Collection to store aggregation of ChildSpyStateMachineEventTimeout objects.
     */
    protected $collEventTimeouts;
    protected $collEventTimeoutsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|PyzExampleStateMachineItem[]
     * @phpstan-var ObjectCollection&\Traversable<PyzExampleStateMachineItem>
     */
    protected $stateMachineItemStatesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantSalesOrderItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrderItem>
     */
    protected $spyMerchantSalesOrderItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspInquiry[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiry>
     */
    protected $spySspInquiriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyStateMachineItemStateHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStateMachineItemStateHistory>
     */
    protected $stateHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyStateMachineEventTimeout[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStateMachineEventTimeout>
     */
    protected $eventTimeoutsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\StateMachine\Persistence\Base\SpyStateMachineItemState object.
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
     * Compares this with another <code>SpyStateMachineItemState</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyStateMachineItemState</code>, delegates to
     * <code>equals(SpyStateMachineItemState)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_state_machine_item_state] column value.
     *
     * @return int
     */
    public function getIdStateMachineItemState()
    {
        return $this->id_state_machine_item_state;
    }

    /**
     * Get the [fk_state_machine_process] column value.
     *
     * @return int
     */
    public function getFkStateMachineProcess()
    {
        return $this->fk_state_machine_process;
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
     * Get the [name] column value.
     * The name of an entity (e.g., user, category, product, role).
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of [id_state_machine_item_state] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdStateMachineItemState($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_state_machine_item_state !== $v) {
            $this->id_state_machine_item_state = $v;
            $this->modifiedColumns[SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_state_machine_process] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkStateMachineProcess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_state_machine_process !== $v) {
            $this->fk_state_machine_process = $v;
            $this->modifiedColumns[SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS] = true;
        }

        if ($this->aProcess !== null && $this->aProcess->getIdStateMachineProcess() !== $v) {
            $this->aProcess = null;
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
            $this->modifiedColumns[SpyStateMachineItemStateTableMap::COL_DESCRIPTION] = true;
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
            $this->modifiedColumns[SpyStateMachineItemStateTableMap::COL_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyStateMachineItemStateTableMap::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_state_machine_item_state = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyStateMachineItemStateTableMap::translateFieldName('FkStateMachineProcess', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_state_machine_process = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyStateMachineItemStateTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyStateMachineItemStateTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = SpyStateMachineItemStateTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemState'), 0, $e);
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
        if ($this->aProcess !== null && $this->fk_state_machine_process !== $this->aProcess->getIdStateMachineProcess()) {
            $this->aProcess = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyStateMachineItemStateTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyStateMachineItemStateQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProcess = null;
            $this->collStateMachineItemStates = null;

            $this->collSpyMerchantSalesOrderItems = null;

            $this->collSpySspInquiries = null;

            $this->collStateHistories = null;

            $this->collEventTimeouts = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyStateMachineItemState::setDeleted()
     * @see SpyStateMachineItemState::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineItemStateTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyStateMachineItemStateQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineItemStateTableMap::DATABASE_NAME);
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
                SpyStateMachineItemStateTableMap::addInstanceToPool($this);
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

            if ($this->stateMachineItemStatesScheduledForDeletion !== null) {
                if (!$this->stateMachineItemStatesScheduledForDeletion->isEmpty()) {
                    foreach ($this->stateMachineItemStatesScheduledForDeletion as $stateMachineItemState) {
                        // need to save related object because we set the relation to null
                        $stateMachineItemState->save($con);
                    }
                    $this->stateMachineItemStatesScheduledForDeletion = null;
                }
            }

            if ($this->collStateMachineItemStates !== null) {
                foreach ($this->collStateMachineItemStates as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantSalesOrderItemsScheduledForDeletion !== null) {
                if (!$this->spyMerchantSalesOrderItemsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyMerchantSalesOrderItemsScheduledForDeletion as $spyMerchantSalesOrderItem) {
                        // need to save related object because we set the relation to null
                        $spyMerchantSalesOrderItem->save($con);
                    }
                    $this->spyMerchantSalesOrderItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantSalesOrderItems !== null) {
                foreach ($this->collSpyMerchantSalesOrderItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquiriesScheduledForDeletion !== null) {
                if (!$this->spySspInquiriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySspInquiriesScheduledForDeletion as $spySspInquiry) {
                        // need to save related object because we set the relation to null
                        $spySspInquiry->save($con);
                    }
                    $this->spySspInquiriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquiries !== null) {
                foreach ($this->collSpySspInquiries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stateHistoriesScheduledForDeletion !== null) {
                if (!$this->stateHistoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateHistoryQuery::create()
                        ->filterByPrimaryKeys($this->stateHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stateHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collStateHistories !== null) {
                foreach ($this->collStateHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventTimeoutsScheduledForDeletion !== null) {
                if (!$this->eventTimeoutsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery::create()
                        ->filterByPrimaryKeys($this->eventTimeoutsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->eventTimeoutsScheduledForDeletion = null;
                }
            }

            if ($this->collEventTimeouts !== null) {
                foreach ($this->collEventTimeouts as $referrerFK) {
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

        $this->modifiedColumns[SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE] = true;
        if (null !== $this->id_state_machine_item_state) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE)) {
            $modifiedColumns[':p' . $index++]  = '`id_state_machine_item_state`';
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS)) {
            $modifiedColumns[':p' . $index++]  = '`fk_state_machine_process`';
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_state_machine_item_state` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_state_machine_item_state`':
                        $stmt->bindValue($identifier, $this->id_state_machine_item_state, PDO::PARAM_INT);

                        break;
                    case '`fk_state_machine_process`':
                        $stmt->bindValue($identifier, $this->fk_state_machine_process, PDO::PARAM_INT);

                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case '`name`':
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
            $pk = $con->lastInsertId('spy_state_machine_item_state_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdStateMachineItemState($pk);

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
        $pos = SpyStateMachineItemStateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdStateMachineItemState();

            case 1:
                return $this->getFkStateMachineProcess();

            case 2:
                return $this->getDescription();

            case 3:
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
        if (isset($alreadyDumpedObjects['SpyStateMachineItemState'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyStateMachineItemState'][$this->hashCode()] = true;
        $keys = SpyStateMachineItemStateTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdStateMachineItemState(),
            $keys[1] => $this->getFkStateMachineProcess(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProcess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStateMachineProcess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_state_machine_process';
                        break;
                    default:
                        $key = 'Process';
                }

                $result[$key] = $this->aProcess->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collStateMachineItemStates) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pyzExampleStateMachineItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pyz_example_state_machine_items';
                        break;
                    default:
                        $key = 'StateMachineItemStates';
                }

                $result[$key] = $this->collStateMachineItemStates->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantSalesOrderItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantSalesOrderItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_sales_order_items';
                        break;
                    default:
                        $key = 'SpyMerchantSalesOrderItems';
                }

                $result[$key] = $this->collSpyMerchantSalesOrderItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquiries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquiries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiries';
                        break;
                    default:
                        $key = 'SpySspInquiries';
                }

                $result[$key] = $this->collSpySspInquiries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStateHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStateMachineItemStateHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_state_machine_item_state_histories';
                        break;
                    default:
                        $key = 'StateHistories';
                }

                $result[$key] = $this->collStateHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventTimeouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStateMachineEventTimeouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_state_machine_event_timeouts';
                        break;
                    default:
                        $key = 'EventTimeouts';
                }

                $result[$key] = $this->collEventTimeouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyStateMachineItemStateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdStateMachineItemState($value);
                break;
            case 1:
                $this->setFkStateMachineProcess($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
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
        $keys = SpyStateMachineItemStateTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdStateMachineItemState($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkStateMachineProcess($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
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
        $criteria = new Criteria(SpyStateMachineItemStateTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE)) {
            $criteria->add(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE, $this->id_state_machine_item_state);
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS)) {
            $criteria->add(SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS, $this->fk_state_machine_process);
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_DESCRIPTION)) {
            $criteria->add(SpyStateMachineItemStateTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SpyStateMachineItemStateTableMap::COL_NAME)) {
            $criteria->add(SpyStateMachineItemStateTableMap::COL_NAME, $this->name);
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
        $criteria = ChildSpyStateMachineItemStateQuery::create();
        $criteria->add(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE, $this->id_state_machine_item_state);

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
        $validPk = null !== $this->getIdStateMachineItemState();

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
        return $this->getIdStateMachineItemState();
    }

    /**
     * Generic method to set the primary key (id_state_machine_item_state column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdStateMachineItemState($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdStateMachineItemState();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkStateMachineProcess($this->getFkStateMachineProcess());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setName($this->getName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStateMachineItemStates() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStateMachineItemState($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantSalesOrderItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantSalesOrderItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquiries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquiry($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStateHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStateHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventTimeouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventTimeout($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdStateMachineItemState(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState Clone of current object.
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
     * Declares an association between this object and a ChildSpyStateMachineProcess object.
     *
     * @param ChildSpyStateMachineProcess $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProcess(ChildSpyStateMachineProcess $v = null)
    {
        if ($v === null) {
            $this->setFkStateMachineProcess(NULL);
        } else {
            $this->setFkStateMachineProcess($v->getIdStateMachineProcess());
        }

        $this->aProcess = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyStateMachineProcess object, it will not be re-added.
        if ($v !== null) {
            $v->addStateMachineProcess($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyStateMachineProcess object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyStateMachineProcess The associated ChildSpyStateMachineProcess object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProcess(?ConnectionInterface $con = null)
    {
        if ($this->aProcess === null && ($this->fk_state_machine_process != 0)) {
            $this->aProcess = ChildSpyStateMachineProcessQuery::create()->findPk($this->fk_state_machine_process, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProcess->addStateMachineProcesses($this);
             */
        }

        return $this->aProcess;
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
        if ('StateMachineItemState' === $relationName) {
            $this->initStateMachineItemStates();
            return;
        }
        if ('SpyMerchantSalesOrderItem' === $relationName) {
            $this->initSpyMerchantSalesOrderItems();
            return;
        }
        if ('SpySspInquiry' === $relationName) {
            $this->initSpySspInquiries();
            return;
        }
        if ('StateHistory' === $relationName) {
            $this->initStateHistories();
            return;
        }
        if ('EventTimeout' === $relationName) {
            $this->initEventTimeouts();
            return;
        }
    }

    /**
     * Clears out the collStateMachineItemStates collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStateMachineItemStates()
     */
    public function clearStateMachineItemStates()
    {
        $this->collStateMachineItemStates = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStateMachineItemStates collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStateMachineItemStates($v = true): void
    {
        $this->collStateMachineItemStatesPartial = $v;
    }

    /**
     * Initializes the collStateMachineItemStates collection.
     *
     * By default this just sets the collStateMachineItemStates collection to an empty array (like clearcollStateMachineItemStates());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStateMachineItemStates(bool $overrideExisting = true): void
    {
        if (null !== $this->collStateMachineItemStates && !$overrideExisting) {
            return;
        }

        $collectionClassName = PyzExampleStateMachineItemTableMap::getTableMap()->getCollectionClassName();

        $this->collStateMachineItemStates = new $collectionClassName;
        $this->collStateMachineItemStates->setModel('\Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItem');
    }

    /**
     * Gets an array of PyzExampleStateMachineItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStateMachineItemState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|PyzExampleStateMachineItem[] List of PyzExampleStateMachineItem objects
     * @phpstan-return ObjectCollection&\Traversable<PyzExampleStateMachineItem> List of PyzExampleStateMachineItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStateMachineItemStates(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStateMachineItemStatesPartial && !$this->isNew();
        if (null === $this->collStateMachineItemStates || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStateMachineItemStates) {
                    $this->initStateMachineItemStates();
                } else {
                    $collectionClassName = PyzExampleStateMachineItemTableMap::getTableMap()->getCollectionClassName();

                    $collStateMachineItemStates = new $collectionClassName;
                    $collStateMachineItemStates->setModel('\Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItem');

                    return $collStateMachineItemStates;
                }
            } else {
                $collStateMachineItemStates = PyzExampleStateMachineItemQuery::create(null, $criteria)
                    ->filterByState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStateMachineItemStatesPartial && count($collStateMachineItemStates)) {
                        $this->initStateMachineItemStates(false);

                        foreach ($collStateMachineItemStates as $obj) {
                            if (false == $this->collStateMachineItemStates->contains($obj)) {
                                $this->collStateMachineItemStates->append($obj);
                            }
                        }

                        $this->collStateMachineItemStatesPartial = true;
                    }

                    return $collStateMachineItemStates;
                }

                if ($partial && $this->collStateMachineItemStates) {
                    foreach ($this->collStateMachineItemStates as $obj) {
                        if ($obj->isNew()) {
                            $collStateMachineItemStates[] = $obj;
                        }
                    }
                }

                $this->collStateMachineItemStates = $collStateMachineItemStates;
                $this->collStateMachineItemStatesPartial = false;
            }
        }

        return $this->collStateMachineItemStates;
    }

    /**
     * Sets a collection of PyzExampleStateMachineItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stateMachineItemStates A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStateMachineItemStates(Collection $stateMachineItemStates, ?ConnectionInterface $con = null)
    {
        /** @var PyzExampleStateMachineItem[] $stateMachineItemStatesToDelete */
        $stateMachineItemStatesToDelete = $this->getStateMachineItemStates(new Criteria(), $con)->diff($stateMachineItemStates);


        $this->stateMachineItemStatesScheduledForDeletion = $stateMachineItemStatesToDelete;

        foreach ($stateMachineItemStatesToDelete as $stateMachineItemStateRemoved) {
            $stateMachineItemStateRemoved->setState(null);
        }

        $this->collStateMachineItemStates = null;
        foreach ($stateMachineItemStates as $stateMachineItemState) {
            $this->addStateMachineItemState($stateMachineItemState);
        }

        $this->collStateMachineItemStates = $stateMachineItemStates;
        $this->collStateMachineItemStatesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BasePyzExampleStateMachineItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BasePyzExampleStateMachineItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStateMachineItemStates(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStateMachineItemStatesPartial && !$this->isNew();
        if (null === $this->collStateMachineItemStates || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStateMachineItemStates) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStateMachineItemStates());
            }

            $query = PyzExampleStateMachineItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByState($this)
                ->count($con);
        }

        return count($this->collStateMachineItemStates);
    }

    /**
     * Method called to associate a PyzExampleStateMachineItem object to this object
     * through the PyzExampleStateMachineItem foreign key attribute.
     *
     * @param PyzExampleStateMachineItem $l PyzExampleStateMachineItem
     * @return $this The current object (for fluent API support)
     */
    public function addStateMachineItemState(PyzExampleStateMachineItem $l)
    {
        if ($this->collStateMachineItemStates === null) {
            $this->initStateMachineItemStates();
            $this->collStateMachineItemStatesPartial = true;
        }

        if (!$this->collStateMachineItemStates->contains($l)) {
            $this->doAddStateMachineItemState($l);

            if ($this->stateMachineItemStatesScheduledForDeletion and $this->stateMachineItemStatesScheduledForDeletion->contains($l)) {
                $this->stateMachineItemStatesScheduledForDeletion->remove($this->stateMachineItemStatesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param PyzExampleStateMachineItem $stateMachineItemState The PyzExampleStateMachineItem object to add.
     */
    protected function doAddStateMachineItemState(PyzExampleStateMachineItem $stateMachineItemState): void
    {
        $this->collStateMachineItemStates[]= $stateMachineItemState;
        $stateMachineItemState->setState($this);
    }

    /**
     * @param PyzExampleStateMachineItem $stateMachineItemState The PyzExampleStateMachineItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStateMachineItemState(PyzExampleStateMachineItem $stateMachineItemState)
    {
        if ($this->getStateMachineItemStates()->contains($stateMachineItemState)) {
            $pos = $this->collStateMachineItemStates->search($stateMachineItemState);
            $this->collStateMachineItemStates->remove($pos);
            if (null === $this->stateMachineItemStatesScheduledForDeletion) {
                $this->stateMachineItemStatesScheduledForDeletion = clone $this->collStateMachineItemStates;
                $this->stateMachineItemStatesScheduledForDeletion->clear();
            }
            $this->stateMachineItemStatesScheduledForDeletion[]= $stateMachineItemState;
            $stateMachineItemState->setState(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyMerchantSalesOrderItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantSalesOrderItems()
     */
    public function clearSpyMerchantSalesOrderItems()
    {
        $this->collSpyMerchantSalesOrderItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantSalesOrderItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantSalesOrderItems($v = true): void
    {
        $this->collSpyMerchantSalesOrderItemsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantSalesOrderItems collection.
     *
     * By default this just sets the collSpyMerchantSalesOrderItems collection to an empty array (like clearcollSpyMerchantSalesOrderItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantSalesOrderItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantSalesOrderItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantSalesOrderItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantSalesOrderItems = new $collectionClassName;
        $this->collSpyMerchantSalesOrderItems->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem');
    }

    /**
     * Gets an array of SpyMerchantSalesOrderItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStateMachineItemState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem> List of SpyMerchantSalesOrderItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantSalesOrderItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantSalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantSalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantSalesOrderItems) {
                    $this->initSpyMerchantSalesOrderItems();
                } else {
                    $collectionClassName = SpyMerchantSalesOrderItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantSalesOrderItems = new $collectionClassName;
                    $collSpyMerchantSalesOrderItems->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem');

                    return $collSpyMerchantSalesOrderItems;
                }
            } else {
                $collSpyMerchantSalesOrderItems = SpyMerchantSalesOrderItemQuery::create(null, $criteria)
                    ->filterByStateMachineItemState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantSalesOrderItemsPartial && count($collSpyMerchantSalesOrderItems)) {
                        $this->initSpyMerchantSalesOrderItems(false);

                        foreach ($collSpyMerchantSalesOrderItems as $obj) {
                            if (false == $this->collSpyMerchantSalesOrderItems->contains($obj)) {
                                $this->collSpyMerchantSalesOrderItems->append($obj);
                            }
                        }

                        $this->collSpyMerchantSalesOrderItemsPartial = true;
                    }

                    return $collSpyMerchantSalesOrderItems;
                }

                if ($partial && $this->collSpyMerchantSalesOrderItems) {
                    foreach ($this->collSpyMerchantSalesOrderItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantSalesOrderItems[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantSalesOrderItems = $collSpyMerchantSalesOrderItems;
                $this->collSpyMerchantSalesOrderItemsPartial = false;
            }
        }

        return $this->collSpyMerchantSalesOrderItems;
    }

    /**
     * Sets a collection of SpyMerchantSalesOrderItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantSalesOrderItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantSalesOrderItems(Collection $spyMerchantSalesOrderItems, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantSalesOrderItem[] $spyMerchantSalesOrderItemsToDelete */
        $spyMerchantSalesOrderItemsToDelete = $this->getSpyMerchantSalesOrderItems(new Criteria(), $con)->diff($spyMerchantSalesOrderItems);


        $this->spyMerchantSalesOrderItemsScheduledForDeletion = $spyMerchantSalesOrderItemsToDelete;

        foreach ($spyMerchantSalesOrderItemsToDelete as $spyMerchantSalesOrderItemRemoved) {
            $spyMerchantSalesOrderItemRemoved->setStateMachineItemState(null);
        }

        $this->collSpyMerchantSalesOrderItems = null;
        foreach ($spyMerchantSalesOrderItems as $spyMerchantSalesOrderItem) {
            $this->addSpyMerchantSalesOrderItem($spyMerchantSalesOrderItem);
        }

        $this->collSpyMerchantSalesOrderItems = $spyMerchantSalesOrderItems;
        $this->collSpyMerchantSalesOrderItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantSalesOrderItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantSalesOrderItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantSalesOrderItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantSalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantSalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantSalesOrderItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantSalesOrderItems());
            }

            $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStateMachineItemState($this)
                ->count($con);
        }

        return count($this->collSpyMerchantSalesOrderItems);
    }

    /**
     * Method called to associate a SpyMerchantSalesOrderItem object to this object
     * through the SpyMerchantSalesOrderItem foreign key attribute.
     *
     * @param SpyMerchantSalesOrderItem $l SpyMerchantSalesOrderItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantSalesOrderItem(SpyMerchantSalesOrderItem $l)
    {
        if ($this->collSpyMerchantSalesOrderItems === null) {
            $this->initSpyMerchantSalesOrderItems();
            $this->collSpyMerchantSalesOrderItemsPartial = true;
        }

        if (!$this->collSpyMerchantSalesOrderItems->contains($l)) {
            $this->doAddSpyMerchantSalesOrderItem($l);

            if ($this->spyMerchantSalesOrderItemsScheduledForDeletion and $this->spyMerchantSalesOrderItemsScheduledForDeletion->contains($l)) {
                $this->spyMerchantSalesOrderItemsScheduledForDeletion->remove($this->spyMerchantSalesOrderItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantSalesOrderItem $spyMerchantSalesOrderItem The SpyMerchantSalesOrderItem object to add.
     */
    protected function doAddSpyMerchantSalesOrderItem(SpyMerchantSalesOrderItem $spyMerchantSalesOrderItem): void
    {
        $this->collSpyMerchantSalesOrderItems[]= $spyMerchantSalesOrderItem;
        $spyMerchantSalesOrderItem->setStateMachineItemState($this);
    }

    /**
     * @param SpyMerchantSalesOrderItem $spyMerchantSalesOrderItem The SpyMerchantSalesOrderItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantSalesOrderItem(SpyMerchantSalesOrderItem $spyMerchantSalesOrderItem)
    {
        if ($this->getSpyMerchantSalesOrderItems()->contains($spyMerchantSalesOrderItem)) {
            $pos = $this->collSpyMerchantSalesOrderItems->search($spyMerchantSalesOrderItem);
            $this->collSpyMerchantSalesOrderItems->remove($pos);
            if (null === $this->spyMerchantSalesOrderItemsScheduledForDeletion) {
                $this->spyMerchantSalesOrderItemsScheduledForDeletion = clone $this->collSpyMerchantSalesOrderItems;
                $this->spyMerchantSalesOrderItemsScheduledForDeletion->clear();
            }
            $this->spyMerchantSalesOrderItemsScheduledForDeletion[]= $spyMerchantSalesOrderItem;
            $spyMerchantSalesOrderItem->setStateMachineItemState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStateMachineItemState is new, it will return
     * an empty collection; or if this SpyStateMachineItemState has previously
     * been saved, it will retrieve related SpyMerchantSalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStateMachineItemState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem}> List of SpyMerchantSalesOrderItem objects
     */
    public function getSpyMerchantSalesOrderItemsJoinSalesOrderItem(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('SalesOrderItem', $joinBehavior);

        return $this->getSpyMerchantSalesOrderItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStateMachineItemState is new, it will return
     * an empty collection; or if this SpyStateMachineItemState has previously
     * been saved, it will retrieve related SpyMerchantSalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStateMachineItemState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem}> List of SpyMerchantSalesOrderItem objects
     */
    public function getSpyMerchantSalesOrderItemsJoinMerchantSalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('MerchantSalesOrder', $joinBehavior);

        return $this->getSpyMerchantSalesOrderItems($query, $con);
    }

    /**
     * Clears out the collSpySspInquiries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquiries()
     */
    public function clearSpySspInquiries()
    {
        $this->collSpySspInquiries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquiries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquiries($v = true): void
    {
        $this->collSpySspInquiriesPartial = $v;
    }

    /**
     * Initializes the collSpySspInquiries collection.
     *
     * By default this just sets the collSpySspInquiries collection to an empty array (like clearcollSpySspInquiries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquiries(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquiries && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquiryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquiries = new $collectionClassName;
        $this->collSpySspInquiries->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry');
    }

    /**
     * Gets an array of SpySspInquiry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStateMachineItemState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspInquiry[] List of SpySspInquiry objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiry> List of SpySspInquiry objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquiries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquiriesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquiries) {
                    $this->initSpySspInquiries();
                } else {
                    $collectionClassName = SpySspInquiryTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquiries = new $collectionClassName;
                    $collSpySspInquiries->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry');

                    return $collSpySspInquiries;
                }
            } else {
                $collSpySspInquiries = SpySspInquiryQuery::create(null, $criteria)
                    ->filterByStateMachineItemState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquiriesPartial && count($collSpySspInquiries)) {
                        $this->initSpySspInquiries(false);

                        foreach ($collSpySspInquiries as $obj) {
                            if (false == $this->collSpySspInquiries->contains($obj)) {
                                $this->collSpySspInquiries->append($obj);
                            }
                        }

                        $this->collSpySspInquiriesPartial = true;
                    }

                    return $collSpySspInquiries;
                }

                if ($partial && $this->collSpySspInquiries) {
                    foreach ($this->collSpySspInquiries as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquiries[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquiries = $collSpySspInquiries;
                $this->collSpySspInquiriesPartial = false;
            }
        }

        return $this->collSpySspInquiries;
    }

    /**
     * Sets a collection of SpySspInquiry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquiries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquiries(Collection $spySspInquiries, ?ConnectionInterface $con = null)
    {
        /** @var SpySspInquiry[] $spySspInquiriesToDelete */
        $spySspInquiriesToDelete = $this->getSpySspInquiries(new Criteria(), $con)->diff($spySspInquiries);


        $this->spySspInquiriesScheduledForDeletion = $spySspInquiriesToDelete;

        foreach ($spySspInquiriesToDelete as $spySspInquiryRemoved) {
            $spySspInquiryRemoved->setStateMachineItemState(null);
        }

        $this->collSpySspInquiries = null;
        foreach ($spySspInquiries as $spySspInquiry) {
            $this->addSpySspInquiry($spySspInquiry);
        }

        $this->collSpySspInquiries = $spySspInquiries;
        $this->collSpySspInquiriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspInquiry objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspInquiry objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquiries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquiriesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquiries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquiries());
            }

            $query = SpySspInquiryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStateMachineItemState($this)
                ->count($con);
        }

        return count($this->collSpySspInquiries);
    }

    /**
     * Method called to associate a SpySspInquiry object to this object
     * through the SpySspInquiry foreign key attribute.
     *
     * @param SpySspInquiry $l SpySspInquiry
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquiry(SpySspInquiry $l)
    {
        if ($this->collSpySspInquiries === null) {
            $this->initSpySspInquiries();
            $this->collSpySspInquiriesPartial = true;
        }

        if (!$this->collSpySspInquiries->contains($l)) {
            $this->doAddSpySspInquiry($l);

            if ($this->spySspInquiriesScheduledForDeletion and $this->spySspInquiriesScheduledForDeletion->contains($l)) {
                $this->spySspInquiriesScheduledForDeletion->remove($this->spySspInquiriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspInquiry $spySspInquiry The SpySspInquiry object to add.
     */
    protected function doAddSpySspInquiry(SpySspInquiry $spySspInquiry): void
    {
        $this->collSpySspInquiries[]= $spySspInquiry;
        $spySspInquiry->setStateMachineItemState($this);
    }

    /**
     * @param SpySspInquiry $spySspInquiry The SpySspInquiry object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquiry(SpySspInquiry $spySspInquiry)
    {
        if ($this->getSpySspInquiries()->contains($spySspInquiry)) {
            $pos = $this->collSpySspInquiries->search($spySspInquiry);
            $this->collSpySspInquiries->remove($pos);
            if (null === $this->spySspInquiriesScheduledForDeletion) {
                $this->spySspInquiriesScheduledForDeletion = clone $this->collSpySspInquiries;
                $this->spySspInquiriesScheduledForDeletion->clear();
            }
            $this->spySspInquiriesScheduledForDeletion[]= $spySspInquiry;
            $spySspInquiry->setStateMachineItemState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStateMachineItemState is new, it will return
     * an empty collection; or if this SpyStateMachineItemState has previously
     * been saved, it will retrieve related SpySspInquiries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStateMachineItemState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspInquiry[] List of SpySspInquiry objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiry}> List of SpySspInquiry objects
     */
    public function getSpySspInquiriesJoinSpyCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspInquiryQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyUser', $joinBehavior);

        return $this->getSpySspInquiries($query, $con);
    }

    /**
     * Clears out the collStateHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStateHistories()
     */
    public function clearStateHistories()
    {
        $this->collStateHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStateHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStateHistories($v = true): void
    {
        $this->collStateHistoriesPartial = $v;
    }

    /**
     * Initializes the collStateHistories collection.
     *
     * By default this just sets the collStateHistories collection to an empty array (like clearcollStateHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStateHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collStateHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStateMachineItemStateHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collStateHistories = new $collectionClassName;
        $this->collStateHistories->setModel('\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateHistory');
    }

    /**
     * Gets an array of ChildSpyStateMachineItemStateHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStateMachineItemState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyStateMachineItemStateHistory[] List of ChildSpyStateMachineItemStateHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStateMachineItemStateHistory> List of ChildSpyStateMachineItemStateHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStateHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStateHistoriesPartial && !$this->isNew();
        if (null === $this->collStateHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStateHistories) {
                    $this->initStateHistories();
                } else {
                    $collectionClassName = SpyStateMachineItemStateHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collStateHistories = new $collectionClassName;
                    $collStateHistories->setModel('\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateHistory');

                    return $collStateHistories;
                }
            } else {
                $collStateHistories = ChildSpyStateMachineItemStateHistoryQuery::create(null, $criteria)
                    ->filterByState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStateHistoriesPartial && count($collStateHistories)) {
                        $this->initStateHistories(false);

                        foreach ($collStateHistories as $obj) {
                            if (false == $this->collStateHistories->contains($obj)) {
                                $this->collStateHistories->append($obj);
                            }
                        }

                        $this->collStateHistoriesPartial = true;
                    }

                    return $collStateHistories;
                }

                if ($partial && $this->collStateHistories) {
                    foreach ($this->collStateHistories as $obj) {
                        if ($obj->isNew()) {
                            $collStateHistories[] = $obj;
                        }
                    }
                }

                $this->collStateHistories = $collStateHistories;
                $this->collStateHistoriesPartial = false;
            }
        }

        return $this->collStateHistories;
    }

    /**
     * Sets a collection of ChildSpyStateMachineItemStateHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stateHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStateHistories(Collection $stateHistories, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyStateMachineItemStateHistory[] $stateHistoriesToDelete */
        $stateHistoriesToDelete = $this->getStateHistories(new Criteria(), $con)->diff($stateHistories);


        $this->stateHistoriesScheduledForDeletion = $stateHistoriesToDelete;

        foreach ($stateHistoriesToDelete as $stateHistoryRemoved) {
            $stateHistoryRemoved->setState(null);
        }

        $this->collStateHistories = null;
        foreach ($stateHistories as $stateHistory) {
            $this->addStateHistory($stateHistory);
        }

        $this->collStateHistories = $stateHistories;
        $this->collStateHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyStateMachineItemStateHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyStateMachineItemStateHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStateHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStateHistoriesPartial && !$this->isNew();
        if (null === $this->collStateHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStateHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStateHistories());
            }

            $query = ChildSpyStateMachineItemStateHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByState($this)
                ->count($con);
        }

        return count($this->collStateHistories);
    }

    /**
     * Method called to associate a ChildSpyStateMachineItemStateHistory object to this object
     * through the ChildSpyStateMachineItemStateHistory foreign key attribute.
     *
     * @param ChildSpyStateMachineItemStateHistory $l ChildSpyStateMachineItemStateHistory
     * @return $this The current object (for fluent API support)
     */
    public function addStateHistory(ChildSpyStateMachineItemStateHistory $l)
    {
        if ($this->collStateHistories === null) {
            $this->initStateHistories();
            $this->collStateHistoriesPartial = true;
        }

        if (!$this->collStateHistories->contains($l)) {
            $this->doAddStateHistory($l);

            if ($this->stateHistoriesScheduledForDeletion and $this->stateHistoriesScheduledForDeletion->contains($l)) {
                $this->stateHistoriesScheduledForDeletion->remove($this->stateHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyStateMachineItemStateHistory $stateHistory The ChildSpyStateMachineItemStateHistory object to add.
     */
    protected function doAddStateHistory(ChildSpyStateMachineItemStateHistory $stateHistory): void
    {
        $this->collStateHistories[]= $stateHistory;
        $stateHistory->setState($this);
    }

    /**
     * @param ChildSpyStateMachineItemStateHistory $stateHistory The ChildSpyStateMachineItemStateHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStateHistory(ChildSpyStateMachineItemStateHistory $stateHistory)
    {
        if ($this->getStateHistories()->contains($stateHistory)) {
            $pos = $this->collStateHistories->search($stateHistory);
            $this->collStateHistories->remove($pos);
            if (null === $this->stateHistoriesScheduledForDeletion) {
                $this->stateHistoriesScheduledForDeletion = clone $this->collStateHistories;
                $this->stateHistoriesScheduledForDeletion->clear();
            }
            $this->stateHistoriesScheduledForDeletion[]= clone $stateHistory;
            $stateHistory->setState(null);
        }

        return $this;
    }

    /**
     * Clears out the collEventTimeouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEventTimeouts()
     */
    public function clearEventTimeouts()
    {
        $this->collEventTimeouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEventTimeouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEventTimeouts($v = true): void
    {
        $this->collEventTimeoutsPartial = $v;
    }

    /**
     * Initializes the collEventTimeouts collection.
     *
     * By default this just sets the collEventTimeouts collection to an empty array (like clearcollEventTimeouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventTimeouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collEventTimeouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStateMachineEventTimeoutTableMap::getTableMap()->getCollectionClassName();

        $this->collEventTimeouts = new $collectionClassName;
        $this->collEventTimeouts->setModel('\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout');
    }

    /**
     * Gets an array of ChildSpyStateMachineEventTimeout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStateMachineItemState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyStateMachineEventTimeout[] List of ChildSpyStateMachineEventTimeout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStateMachineEventTimeout> List of ChildSpyStateMachineEventTimeout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEventTimeouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEventTimeoutsPartial && !$this->isNew();
        if (null === $this->collEventTimeouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEventTimeouts) {
                    $this->initEventTimeouts();
                } else {
                    $collectionClassName = SpyStateMachineEventTimeoutTableMap::getTableMap()->getCollectionClassName();

                    $collEventTimeouts = new $collectionClassName;
                    $collEventTimeouts->setModel('\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout');

                    return $collEventTimeouts;
                }
            } else {
                $collEventTimeouts = ChildSpyStateMachineEventTimeoutQuery::create(null, $criteria)
                    ->filterByState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventTimeoutsPartial && count($collEventTimeouts)) {
                        $this->initEventTimeouts(false);

                        foreach ($collEventTimeouts as $obj) {
                            if (false == $this->collEventTimeouts->contains($obj)) {
                                $this->collEventTimeouts->append($obj);
                            }
                        }

                        $this->collEventTimeoutsPartial = true;
                    }

                    return $collEventTimeouts;
                }

                if ($partial && $this->collEventTimeouts) {
                    foreach ($this->collEventTimeouts as $obj) {
                        if ($obj->isNew()) {
                            $collEventTimeouts[] = $obj;
                        }
                    }
                }

                $this->collEventTimeouts = $collEventTimeouts;
                $this->collEventTimeoutsPartial = false;
            }
        }

        return $this->collEventTimeouts;
    }

    /**
     * Sets a collection of ChildSpyStateMachineEventTimeout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $eventTimeouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEventTimeouts(Collection $eventTimeouts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyStateMachineEventTimeout[] $eventTimeoutsToDelete */
        $eventTimeoutsToDelete = $this->getEventTimeouts(new Criteria(), $con)->diff($eventTimeouts);


        $this->eventTimeoutsScheduledForDeletion = $eventTimeoutsToDelete;

        foreach ($eventTimeoutsToDelete as $eventTimeoutRemoved) {
            $eventTimeoutRemoved->setState(null);
        }

        $this->collEventTimeouts = null;
        foreach ($eventTimeouts as $eventTimeout) {
            $this->addEventTimeout($eventTimeout);
        }

        $this->collEventTimeouts = $eventTimeouts;
        $this->collEventTimeoutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyStateMachineEventTimeout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyStateMachineEventTimeout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEventTimeouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEventTimeoutsPartial && !$this->isNew();
        if (null === $this->collEventTimeouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventTimeouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventTimeouts());
            }

            $query = ChildSpyStateMachineEventTimeoutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByState($this)
                ->count($con);
        }

        return count($this->collEventTimeouts);
    }

    /**
     * Method called to associate a ChildSpyStateMachineEventTimeout object to this object
     * through the ChildSpyStateMachineEventTimeout foreign key attribute.
     *
     * @param ChildSpyStateMachineEventTimeout $l ChildSpyStateMachineEventTimeout
     * @return $this The current object (for fluent API support)
     */
    public function addEventTimeout(ChildSpyStateMachineEventTimeout $l)
    {
        if ($this->collEventTimeouts === null) {
            $this->initEventTimeouts();
            $this->collEventTimeoutsPartial = true;
        }

        if (!$this->collEventTimeouts->contains($l)) {
            $this->doAddEventTimeout($l);

            if ($this->eventTimeoutsScheduledForDeletion and $this->eventTimeoutsScheduledForDeletion->contains($l)) {
                $this->eventTimeoutsScheduledForDeletion->remove($this->eventTimeoutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyStateMachineEventTimeout $eventTimeout The ChildSpyStateMachineEventTimeout object to add.
     */
    protected function doAddEventTimeout(ChildSpyStateMachineEventTimeout $eventTimeout): void
    {
        $this->collEventTimeouts[]= $eventTimeout;
        $eventTimeout->setState($this);
    }

    /**
     * @param ChildSpyStateMachineEventTimeout $eventTimeout The ChildSpyStateMachineEventTimeout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEventTimeout(ChildSpyStateMachineEventTimeout $eventTimeout)
    {
        if ($this->getEventTimeouts()->contains($eventTimeout)) {
            $pos = $this->collEventTimeouts->search($eventTimeout);
            $this->collEventTimeouts->remove($pos);
            if (null === $this->eventTimeoutsScheduledForDeletion) {
                $this->eventTimeoutsScheduledForDeletion = clone $this->collEventTimeouts;
                $this->eventTimeoutsScheduledForDeletion->clear();
            }
            $this->eventTimeoutsScheduledForDeletion[]= clone $eventTimeout;
            $eventTimeout->setState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStateMachineItemState is new, it will return
     * an empty collection; or if this SpyStateMachineItemState has previously
     * been saved, it will retrieve related EventTimeouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStateMachineItemState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyStateMachineEventTimeout[] List of ChildSpyStateMachineEventTimeout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStateMachineEventTimeout}> List of ChildSpyStateMachineEventTimeout objects
     */
    public function getEventTimeoutsJoinProcess(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyStateMachineEventTimeoutQuery::create(null, $criteria);
        $query->joinWith('Process', $joinBehavior);

        return $this->getEventTimeouts($query, $con);
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
        if (null !== $this->aProcess) {
            $this->aProcess->removeStateMachineProcess($this);
        }
        $this->id_state_machine_item_state = null;
        $this->fk_state_machine_process = null;
        $this->description = null;
        $this->name = null;
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
            if ($this->collStateMachineItemStates) {
                foreach ($this->collStateMachineItemStates as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantSalesOrderItems) {
                foreach ($this->collSpyMerchantSalesOrderItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquiries) {
                foreach ($this->collSpySspInquiries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStateHistories) {
                foreach ($this->collStateHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventTimeouts) {
                foreach ($this->collEventTimeouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStateMachineItemStates = null;
        $this->collSpyMerchantSalesOrderItems = null;
        $this->collSpySspInquiries = null;
        $this->collStateHistories = null;
        $this->collEventTimeouts = null;
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
        return (string) $this->exportTo(SpyStateMachineItemStateTableMap::DEFAULT_STRING_FORMAT);
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
