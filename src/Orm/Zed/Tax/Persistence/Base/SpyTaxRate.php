<?php

namespace Orm\Zed\Tax\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\Tax\Persistence\SpyTaxRate as ChildSpyTaxRate;
use Orm\Zed\Tax\Persistence\SpyTaxRateQuery as ChildSpyTaxRateQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSet as ChildSpyTaxSet;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery as ChildSpyTaxSetQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSetTax as ChildSpyTaxSetTax;
use Orm\Zed\Tax\Persistence\SpyTaxSetTaxQuery as ChildSpyTaxSetTaxQuery;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxSetTaxTableMap;
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
 * Base class that represents a row from the 'spy_tax_rate' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Tax.Persistence.Base
 */
abstract class SpyTaxRate implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Tax\\Persistence\\Map\\SpyTaxRateTableMap';


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
     * The value for the id_tax_rate field.
     *
     * @var        int
     */
    protected $id_tax_rate;

    /**
     * The value for the fk_country field.
     *
     * @var        int|null
     */
    protected $fk_country;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the rate field.
     * The tax rate percentage.
     * @var        string
     */
    protected $rate;

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
     * @var        SpyCountry
     */
    protected $aCountry;

    /**
     * @var        ObjectCollection|ChildSpyTaxSetTax[] Collection to store aggregation of ChildSpyTaxSetTax objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyTaxSetTax> Collection to store aggregation of ChildSpyTaxSetTax objects.
     */
    protected $collSpyTaxSetTaxes;
    protected $collSpyTaxSetTaxesPartial;

    /**
     * @var        ObjectCollection|ChildSpyTaxSet[] Cross Collection to store aggregation of ChildSpyTaxSet objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyTaxSet> Cross Collection to store aggregation of ChildSpyTaxSet objects.
     */
    protected $collSpyTaxSets;

    /**
     * @var bool
     */
    protected $collSpyTaxSetsPartial;

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
        'spy_tax_rate.fk_country' => 'fk_country',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyTaxSet[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyTaxSet>
     */
    protected $spyTaxSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyTaxSetTax[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyTaxSetTax>
     */
    protected $spyTaxSetTaxesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Tax\Persistence\Base\SpyTaxRate object.
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
     * Compares this with another <code>SpyTaxRate</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyTaxRate</code>, delegates to
     * <code>equals(SpyTaxRate)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_tax_rate] column value.
     *
     * @return int
     */
    public function getIdTaxRate()
    {
        return $this->id_tax_rate;
    }

    /**
     * Get the [fk_country] column value.
     *
     * @return int|null
     */
    public function getFkCountry()
    {
        return $this->fk_country;
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
     * Get the [rate] column value.
     * The tax rate percentage.
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
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
     * Set the value of [id_tax_rate] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdTaxRate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_tax_rate !== $v) {
            $this->id_tax_rate = $v;
            $this->modifiedColumns[SpyTaxRateTableMap::COL_ID_TAX_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_country] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCountry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_country !== $v) {
            $this->fk_country = $v;
            $this->modifiedColumns[SpyTaxRateTableMap::COL_FK_COUNTRY] = true;
        }

        if ($this->aCountry !== null && $this->aCountry->getIdCountry() !== $v) {
            $this->aCountry = null;
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
            $this->modifiedColumns[SpyTaxRateTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rate] column.
     * The tax rate percentage.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[SpyTaxRateTableMap::COL_RATE] = true;
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
                $this->modifiedColumns[SpyTaxRateTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyTaxRateTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyTaxRateTableMap::translateFieldName('IdTaxRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tax_rate = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyTaxRateTableMap::translateFieldName('FkCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_country = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyTaxRateTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyTaxRateTableMap::translateFieldName('Rate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyTaxRateTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyTaxRateTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyTaxRateTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Tax\\Persistence\\SpyTaxRate'), 0, $e);
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
        if ($this->aCountry !== null && $this->fk_country !== $this->aCountry->getIdCountry()) {
            $this->aCountry = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyTaxRateTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyTaxRateQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->collSpyTaxSetTaxes = null;

            $this->collSpyTaxSets = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyTaxRate::setDeleted()
     * @see SpyTaxRate::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxRateTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyTaxRateQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxRateTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyTaxRateTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyTaxRateTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyTaxRateTableMap::COL_UPDATED_AT)) {
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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyTaxRateTableMap::addInstanceToPool($this);
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

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
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

            if ($this->spyTaxSetsScheduledForDeletion !== null) {
                if (!$this->spyTaxSetsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyTaxSetsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdTaxRate();
                        $entryPk[1] = $entry->getIdTaxSet();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\Tax\Persistence\SpyTaxSetTaxQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyTaxSetsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyTaxSets) {
                foreach ($this->collSpyTaxSets as $spyTaxSet) {
                    if (!$spyTaxSet->isDeleted() && ($spyTaxSet->isNew() || $spyTaxSet->isModified())) {
                        $spyTaxSet->save($con);
                    }
                }
            }


            if ($this->spyTaxSetTaxesScheduledForDeletion !== null) {
                if (!$this->spyTaxSetTaxesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Tax\Persistence\SpyTaxSetTaxQuery::create()
                        ->filterByPrimaryKeys($this->spyTaxSetTaxesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyTaxSetTaxesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyTaxSetTaxes !== null) {
                foreach ($this->collSpyTaxSetTaxes as $referrerFK) {
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

        $this->modifiedColumns[SpyTaxRateTableMap::COL_ID_TAX_RATE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_ID_TAX_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'id_tax_rate';
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_FK_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_country';
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'rate';
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_tax_rate (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_tax_rate':
                        $stmt->bindValue($identifier, $this->id_tax_rate, PDO::PARAM_INT);

                        break;
                    case 'fk_country':
                        $stmt->bindValue($identifier, $this->fk_country, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'rate':
                        $stmt->bindValue($identifier, $this->rate, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_tax_rate_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdTaxRate($pk);
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
        $pos = SpyTaxRateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdTaxRate();

            case 1:
                return $this->getFkCountry();

            case 2:
                return $this->getName();

            case 3:
                return $this->getRate();

            case 4:
                return $this->getCreatedAt();

            case 5:
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
        if (isset($alreadyDumpedObjects['SpyTaxRate'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyTaxRate'][$this->hashCode()] = true;
        $keys = SpyTaxRateTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdTaxRate(),
            $keys[1] => $this->getFkCountry(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getRate(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCountry';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_country';
                        break;
                    default:
                        $key = 'Country';
                }

                $result[$key] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyTaxSetTaxes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTaxSetTaxes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_tax_set_taxes';
                        break;
                    default:
                        $key = 'SpyTaxSetTaxes';
                }

                $result[$key] = $this->collSpyTaxSetTaxes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyTaxRateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdTaxRate($value);
                break;
            case 1:
                $this->setFkCountry($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setRate($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
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
        $keys = SpyTaxRateTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdTaxRate($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCountry($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedAt($arr[$keys[5]]);
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
        $criteria = new Criteria(SpyTaxRateTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyTaxRateTableMap::COL_ID_TAX_RATE)) {
            $criteria->add(SpyTaxRateTableMap::COL_ID_TAX_RATE, $this->id_tax_rate);
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_FK_COUNTRY)) {
            $criteria->add(SpyTaxRateTableMap::COL_FK_COUNTRY, $this->fk_country);
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_NAME)) {
            $criteria->add(SpyTaxRateTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_RATE)) {
            $criteria->add(SpyTaxRateTableMap::COL_RATE, $this->rate);
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyTaxRateTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyTaxRateTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyTaxRateTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyTaxRateQuery::create();
        $criteria->add(SpyTaxRateTableMap::COL_ID_TAX_RATE, $this->id_tax_rate);

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
        $validPk = null !== $this->getIdTaxRate();

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
        return $this->getIdTaxRate();
    }

    /**
     * Generic method to set the primary key (id_tax_rate column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdTaxRate($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdTaxRate();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Tax\Persistence\SpyTaxRate (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCountry($this->getFkCountry());
        $copyObj->setName($this->getName());
        $copyObj->setRate($this->getRate());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyTaxSetTaxes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyTaxSetTax($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdTaxRate(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRate Clone of current object.
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
     * Declares an association between this object and a SpyCountry object.
     *
     * @param SpyCountry|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCountry(SpyCountry $v = null)
    {
        if ($v === null) {
            $this->setFkCountry(NULL);
        } else {
            $this->setFkCountry($v->getIdCountry());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyTaxRate($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCountry object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCountry|null The associated SpyCountry object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCountry(?ConnectionInterface $con = null)
    {
        if ($this->aCountry === null && ($this->fk_country != 0)) {
            $this->aCountry = SpyCountryQuery::create()->findPk($this->fk_country, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addSpyTaxRates($this);
             */
        }

        return $this->aCountry;
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
        if ('SpyTaxSetTax' === $relationName) {
            $this->initSpyTaxSetTaxes();
            return;
        }
    }

    /**
     * Clears out the collSpyTaxSetTaxes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyTaxSetTaxes()
     */
    public function clearSpyTaxSetTaxes()
    {
        $this->collSpyTaxSetTaxes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyTaxSetTaxes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyTaxSetTaxes($v = true): void
    {
        $this->collSpyTaxSetTaxesPartial = $v;
    }

    /**
     * Initializes the collSpyTaxSetTaxes collection.
     *
     * By default this just sets the collSpyTaxSetTaxes collection to an empty array (like clearcollSpyTaxSetTaxes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyTaxSetTaxes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyTaxSetTaxes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTaxSetTaxTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyTaxSetTaxes = new $collectionClassName;
        $this->collSpyTaxSetTaxes->setModel('\Orm\Zed\Tax\Persistence\SpyTaxSetTax');
    }

    /**
     * Gets an array of ChildSpyTaxSetTax objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyTaxRate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyTaxSetTax[] List of ChildSpyTaxSetTax objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyTaxSetTax> List of ChildSpyTaxSetTax objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyTaxSetTaxes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyTaxSetTaxesPartial && !$this->isNew();
        if (null === $this->collSpyTaxSetTaxes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyTaxSetTaxes) {
                    $this->initSpyTaxSetTaxes();
                } else {
                    $collectionClassName = SpyTaxSetTaxTableMap::getTableMap()->getCollectionClassName();

                    $collSpyTaxSetTaxes = new $collectionClassName;
                    $collSpyTaxSetTaxes->setModel('\Orm\Zed\Tax\Persistence\SpyTaxSetTax');

                    return $collSpyTaxSetTaxes;
                }
            } else {
                $collSpyTaxSetTaxes = ChildSpyTaxSetTaxQuery::create(null, $criteria)
                    ->filterBySpyTaxRate($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyTaxSetTaxesPartial && count($collSpyTaxSetTaxes)) {
                        $this->initSpyTaxSetTaxes(false);

                        foreach ($collSpyTaxSetTaxes as $obj) {
                            if (false == $this->collSpyTaxSetTaxes->contains($obj)) {
                                $this->collSpyTaxSetTaxes->append($obj);
                            }
                        }

                        $this->collSpyTaxSetTaxesPartial = true;
                    }

                    return $collSpyTaxSetTaxes;
                }

                if ($partial && $this->collSpyTaxSetTaxes) {
                    foreach ($this->collSpyTaxSetTaxes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyTaxSetTaxes[] = $obj;
                        }
                    }
                }

                $this->collSpyTaxSetTaxes = $collSpyTaxSetTaxes;
                $this->collSpyTaxSetTaxesPartial = false;
            }
        }

        return $this->collSpyTaxSetTaxes;
    }

    /**
     * Sets a collection of ChildSpyTaxSetTax objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyTaxSetTaxes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyTaxSetTaxes(Collection $spyTaxSetTaxes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyTaxSetTax[] $spyTaxSetTaxesToDelete */
        $spyTaxSetTaxesToDelete = $this->getSpyTaxSetTaxes(new Criteria(), $con)->diff($spyTaxSetTaxes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyTaxSetTaxesScheduledForDeletion = clone $spyTaxSetTaxesToDelete;

        foreach ($spyTaxSetTaxesToDelete as $spyTaxSetTaxRemoved) {
            $spyTaxSetTaxRemoved->setSpyTaxRate(null);
        }

        $this->collSpyTaxSetTaxes = null;
        foreach ($spyTaxSetTaxes as $spyTaxSetTax) {
            $this->addSpyTaxSetTax($spyTaxSetTax);
        }

        $this->collSpyTaxSetTaxes = $spyTaxSetTaxes;
        $this->collSpyTaxSetTaxesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyTaxSetTax objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyTaxSetTax objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyTaxSetTaxes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyTaxSetTaxesPartial && !$this->isNew();
        if (null === $this->collSpyTaxSetTaxes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyTaxSetTaxes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyTaxSetTaxes());
            }

            $query = ChildSpyTaxSetTaxQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyTaxRate($this)
                ->count($con);
        }

        return count($this->collSpyTaxSetTaxes);
    }

    /**
     * Method called to associate a ChildSpyTaxSetTax object to this object
     * through the ChildSpyTaxSetTax foreign key attribute.
     *
     * @param ChildSpyTaxSetTax $l ChildSpyTaxSetTax
     * @return $this The current object (for fluent API support)
     */
    public function addSpyTaxSetTax(ChildSpyTaxSetTax $l)
    {
        if ($this->collSpyTaxSetTaxes === null) {
            $this->initSpyTaxSetTaxes();
            $this->collSpyTaxSetTaxesPartial = true;
        }

        if (!$this->collSpyTaxSetTaxes->contains($l)) {
            $this->doAddSpyTaxSetTax($l);

            if ($this->spyTaxSetTaxesScheduledForDeletion and $this->spyTaxSetTaxesScheduledForDeletion->contains($l)) {
                $this->spyTaxSetTaxesScheduledForDeletion->remove($this->spyTaxSetTaxesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyTaxSetTax $spyTaxSetTax The ChildSpyTaxSetTax object to add.
     */
    protected function doAddSpyTaxSetTax(ChildSpyTaxSetTax $spyTaxSetTax): void
    {
        $this->collSpyTaxSetTaxes[]= $spyTaxSetTax;
        $spyTaxSetTax->setSpyTaxRate($this);
    }

    /**
     * @param ChildSpyTaxSetTax $spyTaxSetTax The ChildSpyTaxSetTax object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyTaxSetTax(ChildSpyTaxSetTax $spyTaxSetTax)
    {
        if ($this->getSpyTaxSetTaxes()->contains($spyTaxSetTax)) {
            $pos = $this->collSpyTaxSetTaxes->search($spyTaxSetTax);
            $this->collSpyTaxSetTaxes->remove($pos);
            if (null === $this->spyTaxSetTaxesScheduledForDeletion) {
                $this->spyTaxSetTaxesScheduledForDeletion = clone $this->collSpyTaxSetTaxes;
                $this->spyTaxSetTaxesScheduledForDeletion->clear();
            }
            $this->spyTaxSetTaxesScheduledForDeletion[]= clone $spyTaxSetTax;
            $spyTaxSetTax->setSpyTaxRate(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyTaxRate is new, it will return
     * an empty collection; or if this SpyTaxRate has previously
     * been saved, it will retrieve related SpyTaxSetTaxes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyTaxRate.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyTaxSetTax[] List of ChildSpyTaxSetTax objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyTaxSetTax}> List of ChildSpyTaxSetTax objects
     */
    public function getSpyTaxSetTaxesJoinSpyTaxSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyTaxSetTaxQuery::create(null, $criteria);
        $query->joinWith('SpyTaxSet', $joinBehavior);

        return $this->getSpyTaxSetTaxes($query, $con);
    }

    /**
     * Clears out the collSpyTaxSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyTaxSets()
     */
    public function clearSpyTaxSets()
    {
        $this->collSpyTaxSets = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyTaxSets crossRef collection.
     *
     * By default this just sets the collSpyTaxSets collection to an empty collection (like clearSpyTaxSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyTaxSets()
    {
        $collectionClassName = SpyTaxSetTaxTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyTaxSets = new $collectionClassName;
        $this->collSpyTaxSetsPartial = true;
        $this->collSpyTaxSets->setModel('\Orm\Zed\Tax\Persistence\SpyTaxSet');
    }

    /**
     * Checks if the collSpyTaxSets collection is loaded.
     *
     * @return bool
     */
    public function isSpyTaxSetsLoaded(): bool
    {
        return null !== $this->collSpyTaxSets;
    }

    /**
     * Gets a collection of ChildSpyTaxSet objects related by a many-to-many relationship
     * to the current object by way of the spy_tax_set_tax cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyTaxRate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSpyTaxSet[] List of ChildSpyTaxSet objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyTaxSet> List of ChildSpyTaxSet objects
     */
    public function getSpyTaxSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyTaxSetsPartial && !$this->isNew();
        if (null === $this->collSpyTaxSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyTaxSets) {
                    $this->initSpyTaxSets();
                }
            } else {

                $query = ChildSpyTaxSetQuery::create(null, $criteria)
                    ->filterBySpyTaxRate($this);
                $collSpyTaxSets = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyTaxSets;
                }

                if ($partial && $this->collSpyTaxSets) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyTaxSets as $obj) {
                        if (!$collSpyTaxSets->contains($obj)) {
                            $collSpyTaxSets[] = $obj;
                        }
                    }
                }

                $this->collSpyTaxSets = $collSpyTaxSets;
                $this->collSpyTaxSetsPartial = false;
            }
        }

        return $this->collSpyTaxSets;
    }

    /**
     * Sets a collection of SpyTaxSet objects related by a many-to-many relationship
     * to the current object by way of the spy_tax_set_tax cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyTaxSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyTaxSets(Collection $spyTaxSets, ?ConnectionInterface $con = null)
    {
        $this->clearSpyTaxSets();
        $currentSpyTaxSets = $this->getSpyTaxSets();

        $spyTaxSetsScheduledForDeletion = $currentSpyTaxSets->diff($spyTaxSets);

        foreach ($spyTaxSetsScheduledForDeletion as $toDelete) {
            $this->removeSpyTaxSet($toDelete);
        }

        foreach ($spyTaxSets as $spyTaxSet) {
            if (!$currentSpyTaxSets->contains($spyTaxSet)) {
                $this->doAddSpyTaxSet($spyTaxSet);
            }
        }

        $this->collSpyTaxSetsPartial = false;
        $this->collSpyTaxSets = $spyTaxSets;

        return $this;
    }

    /**
     * Gets the number of SpyTaxSet objects related by a many-to-many relationship
     * to the current object by way of the spy_tax_set_tax cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyTaxSet objects
     */
    public function countSpyTaxSets(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyTaxSetsPartial && !$this->isNew();
        if (null === $this->collSpyTaxSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyTaxSets) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyTaxSets());
                }

                $query = ChildSpyTaxSetQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyTaxRate($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyTaxSets);
        }
    }

    /**
     * Associate a ChildSpyTaxSet to this object
     * through the spy_tax_set_tax cross reference table.
     *
     * @param ChildSpyTaxSet $spyTaxSet
     * @return ChildSpyTaxRate The current object (for fluent API support)
     */
    public function addSpyTaxSet(ChildSpyTaxSet $spyTaxSet)
    {
        if ($this->collSpyTaxSets === null) {
            $this->initSpyTaxSets();
        }

        if (!$this->getSpyTaxSets()->contains($spyTaxSet)) {
            // only add it if the **same** object is not already associated
            $this->collSpyTaxSets->push($spyTaxSet);
            $this->doAddSpyTaxSet($spyTaxSet);
        }

        return $this;
    }

    /**
     *
     * @param ChildSpyTaxSet $spyTaxSet
     */
    protected function doAddSpyTaxSet(ChildSpyTaxSet $spyTaxSet)
    {
        $spyTaxSetTax = new ChildSpyTaxSetTax();

        $spyTaxSetTax->setSpyTaxSet($spyTaxSet);

        $spyTaxSetTax->setSpyTaxRate($this);

        $this->addSpyTaxSetTax($spyTaxSetTax);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyTaxSet->isSpyTaxRatesLoaded()) {
            $spyTaxSet->initSpyTaxRates();
            $spyTaxSet->getSpyTaxRates()->push($this);
        } elseif (!$spyTaxSet->getSpyTaxRates()->contains($this)) {
            $spyTaxSet->getSpyTaxRates()->push($this);
        }

    }

    /**
     * Remove spyTaxSet of this object
     * through the spy_tax_set_tax cross reference table.
     *
     * @param ChildSpyTaxSet $spyTaxSet
     * @return ChildSpyTaxRate The current object (for fluent API support)
     */
    public function removeSpyTaxSet(ChildSpyTaxSet $spyTaxSet)
    {
        if ($this->getSpyTaxSets()->contains($spyTaxSet)) {
            $spyTaxSetTax = new ChildSpyTaxSetTax();
            $spyTaxSetTax->setSpyTaxSet($spyTaxSet);
            if ($spyTaxSet->isSpyTaxRatesLoaded()) {
                //remove the back reference if available
                $spyTaxSet->getSpyTaxRates()->removeObject($this);
            }

            $spyTaxSetTax->setSpyTaxRate($this);
            $this->removeSpyTaxSetTax(clone $spyTaxSetTax);
            $spyTaxSetTax->clear();

            $this->collSpyTaxSets->remove($this->collSpyTaxSets->search($spyTaxSet));

            if (null === $this->spyTaxSetsScheduledForDeletion) {
                $this->spyTaxSetsScheduledForDeletion = clone $this->collSpyTaxSets;
                $this->spyTaxSetsScheduledForDeletion->clear();
            }

            $this->spyTaxSetsScheduledForDeletion->push($spyTaxSet);
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
        if (null !== $this->aCountry) {
            $this->aCountry->removeSpyTaxRate($this);
        }
        $this->id_tax_rate = null;
        $this->fk_country = null;
        $this->name = null;
        $this->rate = null;
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
            if ($this->collSpyTaxSetTaxes) {
                foreach ($this->collSpyTaxSetTaxes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyTaxSets) {
                foreach ($this->collSpyTaxSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyTaxSetTaxes = null;
        $this->collSpyTaxSets = null;
        $this->aCountry = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyTaxRateTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyTaxRateTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_tax_rate.create';
        } else {
            $this->_eventName = 'Entity.spy_tax_rate.update';
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

        if ($this->_eventName !== 'Entity.spy_tax_rate.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_tax_rate',
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
            'name' => 'spy_tax_rate',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_tax_rate.delete',
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
            $field = str_replace('spy_tax_rate.', '', $modifiedColumn);
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
            $field = str_replace('spy_tax_rate.', '', $additionalValueColumnName);
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
        $columnType = SpyTaxRateTableMap::getTableMap()->getColumn($column)->getType();
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
