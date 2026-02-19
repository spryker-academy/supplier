<?php

namespace Orm\Zed\DynamicEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration as ChildSpyDynamicEntityConfiguration;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery as ChildSpyDynamicEntityConfigurationQuery;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation as ChildSpyDynamicEntityConfigurationRelation;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping as ChildSpyDynamicEntityConfigurationRelationFieldMapping;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery as ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery as ChildSpyDynamicEntityConfigurationRelationQuery;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationRelationFieldMappingTableMap;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationRelationTableMap;
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
 * Base class that represents a row from the 'spy_dynamic_entity_configuration_relation' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.DynamicEntity.Persistence.Base
 */
abstract class SpyDynamicEntityConfigurationRelation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\DynamicEntity\\Persistence\\Map\\SpyDynamicEntityConfigurationRelationTableMap';


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
     * The value for the id_dynamic_entity_configuration_relation field.
     *
     * @var        int
     */
    protected $id_dynamic_entity_configuration_relation;

    /**
     * The value for the fk_parent_dynamic_entity_configuration field.
     *
     * @var        int
     */
    protected $fk_parent_dynamic_entity_configuration;

    /**
     * The value for the fk_child_dynamic_entity_configuration field.
     *
     * @var        int
     */
    protected $fk_child_dynamic_entity_configuration;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the is_editable field.
     * A flag indicating if a field or entity is editable.
     * @var        boolean
     */
    protected $is_editable;

    /**
     * @var        ChildSpyDynamicEntityConfiguration
     */
    protected $aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration;

    /**
     * @var        ChildSpyDynamicEntityConfiguration
     */
    protected $aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration;

    /**
     * @var        ObjectCollection|ChildSpyDynamicEntityConfigurationRelationFieldMapping[] Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> Collection to store aggregation of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects.
     */
    protected $collSpyDynamicEntityConfigurationRelationFieldMappings;
    protected $collSpyDynamicEntityConfigurationRelationFieldMappingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyDynamicEntityConfigurationRelationFieldMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping>
     */
    protected $spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\DynamicEntity\Persistence\Base\SpyDynamicEntityConfigurationRelation object.
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
     * Compares this with another <code>SpyDynamicEntityConfigurationRelation</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyDynamicEntityConfigurationRelation</code>, delegates to
     * <code>equals(SpyDynamicEntityConfigurationRelation)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_dynamic_entity_configuration_relation] column value.
     *
     * @return int
     */
    public function getIdDynamicEntityConfigurationRelation()
    {
        return $this->id_dynamic_entity_configuration_relation;
    }

    /**
     * Get the [fk_parent_dynamic_entity_configuration] column value.
     *
     * @return int
     */
    public function getFkParentDynamicEntityConfiguration()
    {
        return $this->fk_parent_dynamic_entity_configuration;
    }

    /**
     * Get the [fk_child_dynamic_entity_configuration] column value.
     *
     * @return int
     */
    public function getFkChildDynamicEntityConfiguration()
    {
        return $this->fk_child_dynamic_entity_configuration;
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
     * Get the [is_editable] column value.
     * A flag indicating if a field or entity is editable.
     * @return boolean
     */
    public function getIsEditable()
    {
        return $this->is_editable;
    }

    /**
     * Get the [is_editable] column value.
     * A flag indicating if a field or entity is editable.
     * @return boolean
     */
    public function isEditable()
    {
        return $this->getIsEditable();
    }

    /**
     * Set the value of [id_dynamic_entity_configuration_relation] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdDynamicEntityConfigurationRelation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_dynamic_entity_configuration_relation !== $v) {
            $this->id_dynamic_entity_configuration_relation = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_parent_dynamic_entity_configuration] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkParentDynamicEntityConfiguration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_parent_dynamic_entity_configuration !== $v) {
            $this->fk_parent_dynamic_entity_configuration = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION] = true;
        }

        if ($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration !== null && $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->getIdDynamicEntityConfiguration() !== $v) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_child_dynamic_entity_configuration] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkChildDynamicEntityConfiguration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_child_dynamic_entity_configuration !== $v) {
            $this->fk_child_dynamic_entity_configuration = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION] = true;
        }

        if ($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration !== null && $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->getIdDynamicEntityConfiguration() !== $v) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = null;
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
            $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_editable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a field or entity is editable.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsEditable($v)
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
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->is_editable !== $v) {
            $this->is_editable = $v;
            $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyDynamicEntityConfigurationRelationTableMap::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_dynamic_entity_configuration_relation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyDynamicEntityConfigurationRelationTableMap::translateFieldName('FkParentDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_parent_dynamic_entity_configuration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyDynamicEntityConfigurationRelationTableMap::translateFieldName('FkChildDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_child_dynamic_entity_configuration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyDynamicEntityConfigurationRelationTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyDynamicEntityConfigurationRelationTableMap::translateFieldName('IsEditable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_editable = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyDynamicEntityConfigurationRelationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation'), 0, $e);
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
        if ($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration !== null && $this->fk_parent_dynamic_entity_configuration !== $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->getIdDynamicEntityConfiguration()) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = null;
        }
        if ($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration !== null && $this->fk_child_dynamic_entity_configuration !== $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->getIdDynamicEntityConfiguration()) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyDynamicEntityConfigurationRelationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = null;
            $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = null;
            $this->collSpyDynamicEntityConfigurationRelationFieldMappings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyDynamicEntityConfigurationRelation::setDeleted()
     * @see SpyDynamicEntityConfigurationRelation::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyDynamicEntityConfigurationRelationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
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
                SpyDynamicEntityConfigurationRelationTableMap::addInstanceToPool($this);
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

            if ($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration !== null) {
                if ($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->isModified() || $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->isNew()) {
                    $affectedRows += $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->save($con);
                }
                $this->setSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration);
            }

            if ($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration !== null) {
                if ($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->isModified() || $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->isNew()) {
                    $affectedRows += $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->save($con);
                }
                $this->setSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration);
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

            if ($this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion !== null) {
                if (!$this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery::create()
                        ->filterByPrimaryKeys($this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyDynamicEntityConfigurationRelationFieldMappings !== null) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationFieldMappings as $referrerFK) {
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

        $this->modifiedColumns[SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION] = true;
        if (null !== $this->id_dynamic_entity_configuration_relation) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION)) {
            $modifiedColumns[':p' . $index++]  = 'id_dynamic_entity_configuration_relation';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'fk_parent_dynamic_entity_configuration';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'fk_child_dynamic_entity_configuration';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_editable';
        }

        $sql = sprintf(
            'INSERT INTO spy_dynamic_entity_configuration_relation (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_dynamic_entity_configuration_relation':
                        $stmt->bindValue($identifier, $this->id_dynamic_entity_configuration_relation, PDO::PARAM_INT);

                        break;
                    case 'fk_parent_dynamic_entity_configuration':
                        $stmt->bindValue($identifier, $this->fk_parent_dynamic_entity_configuration, PDO::PARAM_INT);

                        break;
                    case 'fk_child_dynamic_entity_configuration':
                        $stmt->bindValue($identifier, $this->fk_child_dynamic_entity_configuration, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'is_editable':
                        $stmt->bindValue($identifier, (int) $this->is_editable, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_dynamic_entity_configuration_relation_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdDynamicEntityConfigurationRelation($pk);

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
        $pos = SpyDynamicEntityConfigurationRelationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdDynamicEntityConfigurationRelation();

            case 1:
                return $this->getFkParentDynamicEntityConfiguration();

            case 2:
                return $this->getFkChildDynamicEntityConfiguration();

            case 3:
                return $this->getName();

            case 4:
                return $this->getIsEditable();

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
        if (isset($alreadyDumpedObjects['SpyDynamicEntityConfigurationRelation'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyDynamicEntityConfigurationRelation'][$this->hashCode()] = true;
        $keys = SpyDynamicEntityConfigurationRelationTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdDynamicEntityConfigurationRelation(),
            $keys[1] => $this->getFkParentDynamicEntityConfiguration(),
            $keys[2] => $this->getFkChildDynamicEntityConfiguration(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getIsEditable(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDynamicEntityConfiguration';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_dynamic_entity_configuration';
                        break;
                    default:
                        $key = 'SpyDynamicEntityConfiguration';
                }

                $result[$key] = $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDynamicEntityConfiguration';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_dynamic_entity_configuration';
                        break;
                    default:
                        $key = 'SpyDynamicEntityConfiguration';
                }

                $result[$key] = $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyDynamicEntityConfigurationRelationFieldMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDynamicEntityConfigurationRelationFieldMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_dynamic_entity_configuration_relation_field_mappings';
                        break;
                    default:
                        $key = 'SpyDynamicEntityConfigurationRelationFieldMappings';
                }

                $result[$key] = $this->collSpyDynamicEntityConfigurationRelationFieldMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyDynamicEntityConfigurationRelationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdDynamicEntityConfigurationRelation($value);
                break;
            case 1:
                $this->setFkParentDynamicEntityConfiguration($value);
                break;
            case 2:
                $this->setFkChildDynamicEntityConfiguration($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setIsEditable($value);
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
        $keys = SpyDynamicEntityConfigurationRelationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdDynamicEntityConfigurationRelation($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkParentDynamicEntityConfiguration($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkChildDynamicEntityConfiguration($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsEditable($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION)) {
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $this->id_dynamic_entity_configuration_relation);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION)) {
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $this->fk_parent_dynamic_entity_configuration);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION)) {
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $this->fk_child_dynamic_entity_configuration);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME)) {
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE)) {
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE, $this->is_editable);
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
        $criteria = ChildSpyDynamicEntityConfigurationRelationQuery::create();
        $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $this->id_dynamic_entity_configuration_relation);

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
        $validPk = null !== $this->getIdDynamicEntityConfigurationRelation();

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
        return $this->getIdDynamicEntityConfigurationRelation();
    }

    /**
     * Generic method to set the primary key (id_dynamic_entity_configuration_relation column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdDynamicEntityConfigurationRelation($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdDynamicEntityConfigurationRelation();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkParentDynamicEntityConfiguration($this->getFkParentDynamicEntityConfiguration());
        $copyObj->setFkChildDynamicEntityConfiguration($this->getFkChildDynamicEntityConfiguration());
        $copyObj->setName($this->getName());
        $copyObj->setIsEditable($this->getIsEditable());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyDynamicEntityConfigurationRelationFieldMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyDynamicEntityConfigurationRelationFieldMapping($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdDynamicEntityConfigurationRelation(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation Clone of current object.
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
     * Declares an association between this object and a ChildSpyDynamicEntityConfiguration object.
     *
     * @param ChildSpyDynamicEntityConfiguration $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration(ChildSpyDynamicEntityConfiguration $v = null)
    {
        if ($v === null) {
            $this->setFkParentDynamicEntityConfiguration(NULL);
        } else {
            $this->setFkParentDynamicEntityConfiguration($v->getIdDynamicEntityConfiguration());
        }

        $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyDynamicEntityConfiguration object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyDynamicEntityConfiguration object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyDynamicEntityConfiguration The associated ChildSpyDynamicEntityConfiguration object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration(?ConnectionInterface $con = null)
    {
        if ($this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration === null && ($this->fk_parent_dynamic_entity_configuration != 0)) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = ChildSpyDynamicEntityConfigurationQuery::create()->findPk($this->fk_parent_dynamic_entity_configuration, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->addSpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration($this);
             */
        }

        return $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration;
    }

    /**
     * Declares an association between this object and a ChildSpyDynamicEntityConfiguration object.
     *
     * @param ChildSpyDynamicEntityConfiguration $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration(ChildSpyDynamicEntityConfiguration $v = null)
    {
        if ($v === null) {
            $this->setFkChildDynamicEntityConfiguration(NULL);
        } else {
            $this->setFkChildDynamicEntityConfiguration($v->getIdDynamicEntityConfiguration());
        }

        $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyDynamicEntityConfiguration object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyDynamicEntityConfiguration object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyDynamicEntityConfiguration The associated ChildSpyDynamicEntityConfiguration object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration(?ConnectionInterface $con = null)
    {
        if ($this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration === null && ($this->fk_child_dynamic_entity_configuration != 0)) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = ChildSpyDynamicEntityConfigurationQuery::create()->findPk($this->fk_child_dynamic_entity_configuration, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->addSpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration($this);
             */
        }

        return $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration;
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
        if ('SpyDynamicEntityConfigurationRelationFieldMapping' === $relationName) {
            $this->initSpyDynamicEntityConfigurationRelationFieldMappings();
            return;
        }
    }

    /**
     * Clears out the collSpyDynamicEntityConfigurationRelationFieldMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyDynamicEntityConfigurationRelationFieldMappings()
     */
    public function clearSpyDynamicEntityConfigurationRelationFieldMappings()
    {
        $this->collSpyDynamicEntityConfigurationRelationFieldMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyDynamicEntityConfigurationRelationFieldMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyDynamicEntityConfigurationRelationFieldMappings($v = true): void
    {
        $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial = $v;
    }

    /**
     * Initializes the collSpyDynamicEntityConfigurationRelationFieldMappings collection.
     *
     * By default this just sets the collSpyDynamicEntityConfigurationRelationFieldMappings collection to an empty array (like clearcollSpyDynamicEntityConfigurationRelationFieldMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyDynamicEntityConfigurationRelationFieldMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyDynamicEntityConfigurationRelationFieldMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyDynamicEntityConfigurationRelationFieldMappings = new $collectionClassName;
        $this->collSpyDynamicEntityConfigurationRelationFieldMappings->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping');
    }

    /**
     * Gets an array of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDynamicEntityConfigurationRelation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyDynamicEntityConfigurationRelationFieldMapping[] List of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> List of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDynamicEntityConfigurationRelationFieldMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationFieldMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyDynamicEntityConfigurationRelationFieldMappings) {
                    $this->initSpyDynamicEntityConfigurationRelationFieldMappings();
                } else {
                    $collectionClassName = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getTableMap()->getCollectionClassName();

                    $collSpyDynamicEntityConfigurationRelationFieldMappings = new $collectionClassName;
                    $collSpyDynamicEntityConfigurationRelationFieldMappings->setModel('\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping');

                    return $collSpyDynamicEntityConfigurationRelationFieldMappings;
                }
            } else {
                $collSpyDynamicEntityConfigurationRelationFieldMappings = ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery::create(null, $criteria)
                    ->filterBySpyDynamicEntityConfigurationRelation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial && count($collSpyDynamicEntityConfigurationRelationFieldMappings)) {
                        $this->initSpyDynamicEntityConfigurationRelationFieldMappings(false);

                        foreach ($collSpyDynamicEntityConfigurationRelationFieldMappings as $obj) {
                            if (false == $this->collSpyDynamicEntityConfigurationRelationFieldMappings->contains($obj)) {
                                $this->collSpyDynamicEntityConfigurationRelationFieldMappings->append($obj);
                            }
                        }

                        $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial = true;
                    }

                    return $collSpyDynamicEntityConfigurationRelationFieldMappings;
                }

                if ($partial && $this->collSpyDynamicEntityConfigurationRelationFieldMappings) {
                    foreach ($this->collSpyDynamicEntityConfigurationRelationFieldMappings as $obj) {
                        if ($obj->isNew()) {
                            $collSpyDynamicEntityConfigurationRelationFieldMappings[] = $obj;
                        }
                    }
                }

                $this->collSpyDynamicEntityConfigurationRelationFieldMappings = $collSpyDynamicEntityConfigurationRelationFieldMappings;
                $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial = false;
            }
        }

        return $this->collSpyDynamicEntityConfigurationRelationFieldMappings;
    }

    /**
     * Sets a collection of ChildSpyDynamicEntityConfigurationRelationFieldMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyDynamicEntityConfigurationRelationFieldMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyDynamicEntityConfigurationRelationFieldMappings(Collection $spyDynamicEntityConfigurationRelationFieldMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyDynamicEntityConfigurationRelationFieldMapping[] $spyDynamicEntityConfigurationRelationFieldMappingsToDelete */
        $spyDynamicEntityConfigurationRelationFieldMappingsToDelete = $this->getSpyDynamicEntityConfigurationRelationFieldMappings(new Criteria(), $con)->diff($spyDynamicEntityConfigurationRelationFieldMappings);


        $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion = $spyDynamicEntityConfigurationRelationFieldMappingsToDelete;

        foreach ($spyDynamicEntityConfigurationRelationFieldMappingsToDelete as $spyDynamicEntityConfigurationRelationFieldMappingRemoved) {
            $spyDynamicEntityConfigurationRelationFieldMappingRemoved->setSpyDynamicEntityConfigurationRelation(null);
        }

        $this->collSpyDynamicEntityConfigurationRelationFieldMappings = null;
        foreach ($spyDynamicEntityConfigurationRelationFieldMappings as $spyDynamicEntityConfigurationRelationFieldMapping) {
            $this->addSpyDynamicEntityConfigurationRelationFieldMapping($spyDynamicEntityConfigurationRelationFieldMapping);
        }

        $this->collSpyDynamicEntityConfigurationRelationFieldMappings = $spyDynamicEntityConfigurationRelationFieldMappings;
        $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyDynamicEntityConfigurationRelationFieldMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyDynamicEntityConfigurationRelationFieldMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyDynamicEntityConfigurationRelationFieldMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial && !$this->isNew();
        if (null === $this->collSpyDynamicEntityConfigurationRelationFieldMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyDynamicEntityConfigurationRelationFieldMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyDynamicEntityConfigurationRelationFieldMappings());
            }

            $query = ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyDynamicEntityConfigurationRelation($this)
                ->count($con);
        }

        return count($this->collSpyDynamicEntityConfigurationRelationFieldMappings);
    }

    /**
     * Method called to associate a ChildSpyDynamicEntityConfigurationRelationFieldMapping object to this object
     * through the ChildSpyDynamicEntityConfigurationRelationFieldMapping foreign key attribute.
     *
     * @param ChildSpyDynamicEntityConfigurationRelationFieldMapping $l ChildSpyDynamicEntityConfigurationRelationFieldMapping
     * @return $this The current object (for fluent API support)
     */
    public function addSpyDynamicEntityConfigurationRelationFieldMapping(ChildSpyDynamicEntityConfigurationRelationFieldMapping $l)
    {
        if ($this->collSpyDynamicEntityConfigurationRelationFieldMappings === null) {
            $this->initSpyDynamicEntityConfigurationRelationFieldMappings();
            $this->collSpyDynamicEntityConfigurationRelationFieldMappingsPartial = true;
        }

        if (!$this->collSpyDynamicEntityConfigurationRelationFieldMappings->contains($l)) {
            $this->doAddSpyDynamicEntityConfigurationRelationFieldMapping($l);

            if ($this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion and $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->contains($l)) {
                $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->remove($this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelationFieldMapping $spyDynamicEntityConfigurationRelationFieldMapping The ChildSpyDynamicEntityConfigurationRelationFieldMapping object to add.
     */
    protected function doAddSpyDynamicEntityConfigurationRelationFieldMapping(ChildSpyDynamicEntityConfigurationRelationFieldMapping $spyDynamicEntityConfigurationRelationFieldMapping): void
    {
        $this->collSpyDynamicEntityConfigurationRelationFieldMappings[]= $spyDynamicEntityConfigurationRelationFieldMapping;
        $spyDynamicEntityConfigurationRelationFieldMapping->setSpyDynamicEntityConfigurationRelation($this);
    }

    /**
     * @param ChildSpyDynamicEntityConfigurationRelationFieldMapping $spyDynamicEntityConfigurationRelationFieldMapping The ChildSpyDynamicEntityConfigurationRelationFieldMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyDynamicEntityConfigurationRelationFieldMapping(ChildSpyDynamicEntityConfigurationRelationFieldMapping $spyDynamicEntityConfigurationRelationFieldMapping)
    {
        if ($this->getSpyDynamicEntityConfigurationRelationFieldMappings()->contains($spyDynamicEntityConfigurationRelationFieldMapping)) {
            $pos = $this->collSpyDynamicEntityConfigurationRelationFieldMappings->search($spyDynamicEntityConfigurationRelationFieldMapping);
            $this->collSpyDynamicEntityConfigurationRelationFieldMappings->remove($pos);
            if (null === $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion) {
                $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion = clone $this->collSpyDynamicEntityConfigurationRelationFieldMappings;
                $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion->clear();
            }
            $this->spyDynamicEntityConfigurationRelationFieldMappingsScheduledForDeletion[]= clone $spyDynamicEntityConfigurationRelationFieldMapping;
            $spyDynamicEntityConfigurationRelationFieldMapping->setSpyDynamicEntityConfigurationRelation(null);
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
        if (null !== $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration->removeSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($this);
        }
        if (null !== $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration) {
            $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration->removeSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($this);
        }
        $this->id_dynamic_entity_configuration_relation = null;
        $this->fk_parent_dynamic_entity_configuration = null;
        $this->fk_child_dynamic_entity_configuration = null;
        $this->name = null;
        $this->is_editable = null;
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
            if ($this->collSpyDynamicEntityConfigurationRelationFieldMappings) {
                foreach ($this->collSpyDynamicEntityConfigurationRelationFieldMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyDynamicEntityConfigurationRelationFieldMappings = null;
        $this->aSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration = null;
        $this->aSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyDynamicEntityConfigurationRelationTableMap::DEFAULT_STRING_FORMAT);
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
