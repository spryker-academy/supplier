<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetSearchQuery as ChildSpySspAssetSearchQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetSearchTableMap;
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
 * Base class that represents a row from the 'spy_ssp_asset_search' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.SelfServicePortal.Persistence.Base
 */
abstract class SpySspAssetSearch implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\Map\\SpySspAssetSearchTableMap';


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
     * The value for the id_ssp_asset_search field.
     *
     * @var        string
     */
    protected $id_ssp_asset_search;

    /**
     * The value for the fk_ssp_asset field.
     *
     * @var        int
     */
    protected $fk_ssp_asset;

    /**
     * The value for the structured_data field.
     * A JSON-encoded string containing structured data for an SSP asset, used for search indexing.
     * @var        string
     */
    protected $structured_data;

    /**
     * The value for the data field.
     *
     * @var        string|null
     */
    protected $data;

    /**
     * The value for the alias_keys field.
     *
     * @var        string|null
     */
    protected $alias_keys;

    /**
     * The value for the key field.
     *
     * @var        string|null
     */
    protected $key;

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
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // synchronization behavior

    /**
     * @var array
     */
    private $_dataTemp;

    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @var bool
     */
    private $_isSendingToQueue = true;

    /**
     * @var \Spryker\Zed\Kernel\Locator
     */
    private $_locator;

    /**
     * Initializes internal state of Orm\Zed\SelfServicePortal\Persistence\Base\SpySspAssetSearch object.
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
     * Compares this with another <code>SpySspAssetSearch</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySspAssetSearch</code>, delegates to
     * <code>equals(SpySspAssetSearch)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_ssp_asset_search] column value.
     *
     * @return string
     */
    public function getIdSspAssetSearch()
    {
        return $this->id_ssp_asset_search;
    }

    /**
     * Get the [fk_ssp_asset] column value.
     *
     * @return int
     */
    public function getFkSspAsset()
    {
        return $this->fk_ssp_asset;
    }

    /**
     * Get the [structured_data] column value.
     * A JSON-encoded string containing structured data for an SSP asset, used for search indexing.
     * @return string
     */
    public function getStructuredData()
    {
        return $this->structured_data;
    }
    /**
     * Get the [data] column value.
     *
     * @return array
     */
    public function getData()
    {
        return json_decode($this->data, true);
    }

    /**
     * Get the [alias_keys] column value.
     *
     * @return string|null
     */
    public function getAliasKeys()
    {
        return $this->alias_keys;
    }

    /**
     * Get the [key] column value.
     *
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
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
     * Set the value of [id_ssp_asset_search] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSspAssetSearch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_ssp_asset_search !== $v) {
            $this->id_ssp_asset_search = $v;
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_ssp_asset] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSspAsset($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_ssp_asset !== $v) {
            $this->fk_ssp_asset = $v;
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_FK_SSP_ASSET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [structured_data] column.
     * A JSON-encoded string containing structured data for an SSP asset, used for search indexing.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStructuredData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->structured_data !== $v) {
            $this->structured_data = $v;
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_STRUCTURED_DATA] = true;
        }

        return $this;
    }
    /**
     * Set the value of [data] column.
     *
     * @param array $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setData($v)
    {
        if (is_array($v)) {
            $this->_dataTemp = $v;
            $v = json_encode($v);
        }

        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->data !== $v) {
            $this->data = $v;
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_DATA] = true;
        }

        return $this;
    }


    /**
     * Set the value of [alias_keys] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAliasKeys($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->alias_keys !== $v) {
            $this->alias_keys = $v;
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_ALIAS_KEYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     *
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
            $this->modifiedColumns[SpySspAssetSearchTableMap::COL_KEY] = true;
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
                $this->modifiedColumns[SpySspAssetSearchTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySspAssetSearchTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySspAssetSearchTableMap::translateFieldName('IdSspAssetSearch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_ssp_asset_search = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySspAssetSearchTableMap::translateFieldName('FkSspAsset', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_ssp_asset = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySspAssetSearchTableMap::translateFieldName('StructuredData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->structured_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySspAssetSearchTableMap::translateFieldName('Data', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySspAssetSearchTableMap::translateFieldName('AliasKeys', TableMap::TYPE_PHPNAME, $indexType)];
            $this->alias_keys = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySspAssetSearchTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySspAssetSearchTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySspAssetSearchTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpySspAssetSearchTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetSearch'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySspAssetSearchTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySspAssetSearchQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySspAssetSearch::setDeleted()
     * @see SpySspAssetSearch::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspAssetSearchTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySspAssetSearchQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // synchronization behavior
                $this->postDeleteSynchronizationBehavior();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspAssetSearchTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // synchronization behavior
            $this->preSaveSynchronizationBehavior();

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpySspAssetSearchTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySspAssetSearchTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpySspAssetSearchTableMap::COL_UPDATED_AT)) {
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
                // synchronization behavior
                if ($affectedRows) {
                    $this->postSaveSynchronizationBehavior();
                }
                SpySspAssetSearchTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH] = true;
        if (null !== $this->id_ssp_asset_search) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH)) {
            $modifiedColumns[':p' . $index++]  = '`id_ssp_asset_search`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_FK_SSP_ASSET)) {
            $modifiedColumns[':p' . $index++]  = '`fk_ssp_asset`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_STRUCTURED_DATA)) {
            $modifiedColumns[':p' . $index++]  = '`structured_data`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_DATA)) {
            $modifiedColumns[':p' . $index++]  = '`data`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_ALIAS_KEYS)) {
            $modifiedColumns[':p' . $index++]  = '`alias_keys`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_ssp_asset_search` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_ssp_asset_search`':
                        $stmt->bindValue($identifier, $this->id_ssp_asset_search, PDO::PARAM_INT);

                        break;
                    case '`fk_ssp_asset`':
                        $stmt->bindValue($identifier, $this->fk_ssp_asset, PDO::PARAM_INT);

                        break;
                    case '`structured_data`':
                        $stmt->bindValue($identifier, $this->structured_data, PDO::PARAM_STR);

                        break;
                    case '`data`':
                        $stmt->bindValue($identifier, $this->data, PDO::PARAM_STR);

                        break;
                    case '`alias_keys`':
                        $stmt->bindValue($identifier, $this->alias_keys, PDO::PARAM_STR);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_ssp_asset_search_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdSspAssetSearch($pk);

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
        $pos = SpySspAssetSearchTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSspAssetSearch();

            case 1:
                return $this->getFkSspAsset();

            case 2:
                return $this->getStructuredData();

            case 3:
                return $this->getData();

            case 4:
                return $this->getAliasKeys();

            case 5:
                return $this->getKey();

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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_FIELDNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['SpySspAssetSearch'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySspAssetSearch'][$this->hashCode()] = true;
        $keys = SpySspAssetSearchTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSspAssetSearch(),
            $keys[1] => $this->getFkSspAsset(),
            $keys[2] => $this->getStructuredData(),
            $keys[3] => $this->getData(),
            $keys[4] => $this->getAliasKeys(),
            $keys[5] => $this->getKey(),
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
        $pos = SpySspAssetSearchTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSspAssetSearch($value);
                break;
            case 1:
                $this->setFkSspAsset($value);
                break;
            case 2:
                $this->setStructuredData($value);
                break;
            case 3:
                $this->setData($value);
                break;
            case 4:
                $this->setAliasKeys($value);
                break;
            case 5:
                $this->setKey($value);
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
        $keys = SpySspAssetSearchTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSspAssetSearch($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkSspAsset($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStructuredData($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setData($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAliasKeys($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setKey($arr[$keys[5]]);
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
        $criteria = new Criteria(SpySspAssetSearchTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH, $this->id_ssp_asset_search);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_FK_SSP_ASSET)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_FK_SSP_ASSET, $this->fk_ssp_asset);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_STRUCTURED_DATA)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_STRUCTURED_DATA, $this->structured_data);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_DATA)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_DATA, $this->data);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_ALIAS_KEYS)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_ALIAS_KEYS, $this->alias_keys);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_KEY)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySspAssetSearchTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySspAssetSearchTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySspAssetSearchQuery::create();
        $criteria->add(SpySspAssetSearchTableMap::COL_ID_SSP_ASSET_SEARCH, $this->id_ssp_asset_search);

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
        $validPk = null !== $this->getIdSspAssetSearch();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getIdSspAssetSearch();
    }

    /**
     * Generic method to set the primary key (id_ssp_asset_search column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setIdSspAssetSearch($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSspAssetSearch();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetSearch (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkSspAsset($this->getFkSspAsset());
        $copyObj->setStructuredData($this->getStructuredData());
        $copyObj->setData($this->getData());
        $copyObj->setAliasKeys($this->getAliasKeys());
        $copyObj->setKey($this->getKey());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSspAssetSearch(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetSearch Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->id_ssp_asset_search = null;
        $this->fk_ssp_asset = null;
        $this->structured_data = null;
        $this->data = null;
        $this->alias_keys = null;
        $this->key = null;
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
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySspAssetSearchTableMap::DEFAULT_STRING_FORMAT);
    }

    // synchronization behavior

    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @return bool
     */
    public function isSendingToQueue()
    {
        return $this->_isSendingToQueue;
    }

    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @param bool $_isSendingToQueue
     *
     * @return $this
     */
    public function setIsSendingToQueue($_isSendingToQueue)
    {
        $this->_isSendingToQueue = $_isSendingToQueue;

        return $this;
    }

    /**
     * @param string $resource
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected function getStorageKeyBuilder($resource)
    {
        if ($this->_locator === null) {
            $this->_locator = \Spryker\Zed\Kernel\Locator::getInstance();
        }

        /** @var \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService */
        $synchronizationService = $this->_locator->synchronization()->service();

        return $synchronizationService->getStorageKeyBuilder($resource);
    }

    /**
     * @return void
     */
    protected function setGeneratedKey()
    {
        $syncTransferData = new \Generated\Shared\Transfer\SynchronizationDataTransfer();
        $syncTransferData->setReference($this->getFkSspAsset());


        $keyBuilder = $this->getStorageKeyBuilder('ssp_asset');

        $key = $keyBuilder->generateKey($syncTransferData);
        $this->setKey($key);
    }
            /**
     * @return void
     */
    protected function setGeneratedKeyForMappingResource()
    {
    }
    /**
     * @param string $source
     * @param string $sourceIdentifier

     * @return string
     */
    protected function generateMappingKey($source, $sourceIdentifier)
    {
        $syncTransferData = new \Generated\Shared\Transfer\SynchronizationDataTransfer();
        $syncTransferData->setReference($source . ':' . $sourceIdentifier);


        $keyBuilder = $this->getStorageKeyBuilder('ssp_asset');

        return $keyBuilder->generateKey($syncTransferData);
    }
            /**
     * @return void
     */
    protected function setGeneratedAliasKeys()
    {
    }
    /**
     * @param array $message
     *
     * @return void
     */
    protected function sendToQueue(array $message)
    {
        if ($this->_locator === null) {
            $this->_locator = \Spryker\Zed\Kernel\Locator::getInstance();
        }

        $queueSendTransfer = new \Generated\Shared\Transfer\QueueSendMessageTransfer();
        $queueSendTransfer->setBody(json_encode($message));



        $queueClient = $this->_locator->queue()->client();
        $queueClient->sendMessage($this->getQueueName(), $queueSendTransfer);
    }

    /**
     * @throws PropelException
     *
     * @return void
     */
    public function syncPublishedMessage()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }

        // Kept for BC reasons, will be removed in next major.
        if (!$this->_isSendingToQueue) {
            return;
        }

        if (empty($this->getKey())) {
            throw new PropelException("Synchronization failed, the column 'key' is null or empty");
        }

        if ($this->_dataTemp !== null) {
            $data = $this->_dataTemp;
        } else {
            $data = $this->getData();
        }

        /* The value for `$params` has been loaded from schema file */
        $params = '{"type":"ssp_asset"}';
        $decodedParams = [];
        if (!empty($params)) {
            $decodedParams = json_decode($params, true);
        }

        $data['_timestamp'] = microtime(true);
        $message = [
            'write' => [
                'key' => $this->getKey(),
                'value' => $data,
                'resource' => 'ssp_asset',
                'store' => '',
                'params' => $decodedParams,
            ]
        ];
        $this->sendMessage($message);
    }

    /**
     * @return void
     */
    public function syncUnpublishedMessage()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }

        // Kept for BC reasons, will be removed in next major.
        if (!$this->_isSendingToQueue) {
            return;
        }

        /* The value for `$params` has been loaded from schema file */
        $params = '{"type":"ssp_asset"}';
        $decodedParams = [];
        if (!empty($params)) {
            $decodedParams = json_decode($params, true);
        }

        $data['_timestamp'] = microtime(true);
        $message = [
            'delete' => [
                'key' => $this->getKey(),
                'value' => $data,
                'resource' => 'ssp_asset',
                'store' => '',
                'params' => $decodedParams,
            ]
        ];

        $this->sendMessage($message);
    }

    /**
     * @return void
     */
    public function syncPublishedMessageForMappingResource()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }

        ;
    }

    /**
     * @return void
     */
    public function syncUnpublishedMessageForMappingResource()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }

        ;
    }

    /**
     * @return void
     */
    public function syncPublishedMessageForMappings()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }


    }

    /**
     * @return void
     */
    public function syncUnpublishedMessageForMappings()
    {
        if (!$this->isSynchronizationEnabled()) {
            return;
        }


    }

    /**
     * @return bool
     */
    public function isSynchronizationEnabled(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    protected function getQueueName(): string
    {
        return 'sync.search.ssp_asset';
    }

    /**
     * @return bool
     */
    protected function isDirectSyncEnabled(): bool
    {
        return false;
    }

    /**
     * @param array $message
     *
     * @return void
     */
    protected function sendToBuffer(array $message): void
    {
        $queueSendTransfer = new \Generated\Shared\Transfer\QueueSendMessageTransfer();
        $queueSendTransfer->setBody(json_encode($message));


        $operationKey = array_key_first($message);
        $synchronizationMessageTransfer = new \Generated\Shared\Transfer\SynchronizationMessageTransfer();
        $synchronizationMessageTransfer->setData($message[$operationKey] ?? []);
        $synchronizationMessageTransfer->setFallbackQueueMessage($queueSendTransfer);
        $synchronizationMessageTransfer->setFallbackQueueName($this->getQueueName());
        $synchronizationMessageTransfer->setSyncDestinationType('search');
        $synchronizationMessageTransfer->setOperationType($operationKey);
        $synchronizationMessageTransfer->setResource('ssp_asset');


        if ($this->_locator === null) {
            $this->_locator = \Spryker\Zed\Kernel\Locator::getInstance();
        }

        $synchronizationFacade = $this->_locator->synchronization()->facade();
        $synchronizationFacade->addSynchronizationMessageToBuffer($synchronizationMessageTransfer);
    }

    /**
     * @param array $message
     *
     * @return void
     */
    protected function sendMessage(array $message): void
    {
        if ($this->_locator === null) {
            $this->_locator = \Spryker\Zed\Kernel\Locator::getInstance();
        }

        $synchronizationFacade = $this->_locator->synchronization()->facade();
        if ($this->isDirectSyncEnabled() && method_exists($synchronizationFacade, 'addSynchronizationMessageToBuffer')) {
            $this->sendToBuffer($message);

            return;
        }

        $this->sendToQueue($message);
    }

    /**
     * @return void
     */
    public function preSaveSynchronizationBehavior(): void
    {
        $this->setGeneratedKey();
        $this->setGeneratedKeyForMappingResource();
        $this->setGeneratedAliasKeys();
    }

    /**
     * @return void
     */
    public function postSaveSynchronizationBehavior(): void
    {
        $this->syncPublishedMessage();
        $this->syncPublishedMessageForMappingResource();
        $this->syncPublishedMessageForMappings();
    }

    /**
     * @return void
     */
    public function postDeleteSynchronizationBehavior(): void
    {
        $this->syncUnpublishedMessage();
        $this->syncUnpublishedMessageForMappingResource();
        $this->syncUnpublishedMessageForMappings();
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySspAssetSearchTableMap::COL_UPDATED_AT] = true;

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
