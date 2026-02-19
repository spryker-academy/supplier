<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\FileManager\Persistence\SpyFile;
use Orm\Zed\FileManager\Persistence\SpyFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel as ChildSpySspAssetToSspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery as ChildSpySspAssetToSspModelQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModel as ChildSpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery as ChildSpySspModelQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile as ChildSpySspModelToFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery as ChildSpySspModelToFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList as ChildSpySspModelToProductList;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery as ChildSpySspModelToProductListQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetToSspModelTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelToFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelToProductListTableMap;
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
 * Base class that represents a row from the 'spy_ssp_model' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.SelfServicePortal.Persistence.Base
 */
abstract class SpySspModel implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\Map\\SpySspModelTableMap';


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
     * The value for the id_ssp_model field.
     *
     * @var        int
     */
    protected $id_ssp_model;

    /**
     * The value for the fk_image_file field.
     *
     * @var        int|null
     */
    protected $fk_image_file;

    /**
     * The value for the code field.
     *
     * @var        string|null
     */
    protected $code;

    /**
     * The value for the image_url field.
     *
     * @var        string|null
     */
    protected $image_url;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the reference field.
     *
     * @var        string
     */
    protected $reference;

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
     * @var        SpyFile
     */
    protected $aFile;

    /**
     * @var        ObjectCollection|ChildSpySspModelToFile[] Collection to store aggregation of ChildSpySspModelToFile objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspModelToFile> Collection to store aggregation of ChildSpySspModelToFile objects.
     */
    protected $collSpySspModelToFiles;
    protected $collSpySspModelToFilesPartial;

    /**
     * @var        ObjectCollection|ChildSpySspModelToProductList[] Collection to store aggregation of ChildSpySspModelToProductList objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspModelToProductList> Collection to store aggregation of ChildSpySspModelToProductList objects.
     */
    protected $collSpySspModelToProductLists;
    protected $collSpySspModelToProductListsPartial;

    /**
     * @var        ObjectCollection|ChildSpySspAssetToSspModel[] Collection to store aggregation of ChildSpySspAssetToSspModel objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspAssetToSspModel> Collection to store aggregation of ChildSpySspAssetToSspModel objects.
     */
    protected $collSpySspAssetToSspModels;
    protected $collSpySspAssetToSspModelsPartial;

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
        'spy_ssp_model.fk_image_file' => 'fk_image_file',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspModelToFile[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspModelToFile>
     */
    protected $spySspModelToFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspModelToProductList[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspModelToProductList>
     */
    protected $spySspModelToProductListsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySspAssetToSspModel[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySspAssetToSspModel>
     */
    protected $spySspAssetToSspModelsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\SelfServicePortal\Persistence\Base\SpySspModel object.
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
     * Compares this with another <code>SpySspModel</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySspModel</code>, delegates to
     * <code>equals(SpySspModel)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_ssp_model] column value.
     *
     * @return int
     */
    public function getIdSspModel()
    {
        return $this->id_ssp_model;
    }

    /**
     * Get the [fk_image_file] column value.
     *
     * @return int|null
     */
    public function getFkImageFile()
    {
        return $this->fk_image_file;
    }

    /**
     * Get the [code] column value.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the [image_url] column value.
     *
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [reference] column value.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
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
     * Set the value of [id_ssp_model] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSspModel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_ssp_model !== $v) {
            $this->id_ssp_model = $v;
            $this->modifiedColumns[SpySspModelTableMap::COL_ID_SSP_MODEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_image_file] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkImageFile($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_image_file !== $v) {
            $this->fk_image_file = $v;
            $this->modifiedColumns[SpySspModelTableMap::COL_FK_IMAGE_FILE] = true;
        }

        if ($this->aFile !== null && $this->aFile->getIdFile() !== $v) {
            $this->aFile = null;
        }

        return $this;
    }

    /**
     * Set the value of [code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[SpySspModelTableMap::COL_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [image_url] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImageUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->image_url !== $v) {
            $this->image_url = $v;
            $this->modifiedColumns[SpySspModelTableMap::COL_IMAGE_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
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
            $this->modifiedColumns[SpySspModelTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reference] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->reference !== $v) {
            $this->reference = $v;
            $this->modifiedColumns[SpySspModelTableMap::COL_REFERENCE] = true;
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
                $this->modifiedColumns[SpySspModelTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySspModelTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySspModelTableMap::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_ssp_model = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySspModelTableMap::translateFieldName('FkImageFile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_image_file = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySspModelTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySspModelTableMap::translateFieldName('ImageUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySspModelTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySspModelTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySspModelTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySspModelTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpySspModelTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModel'), 0, $e);
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
        if ($this->aFile !== null && $this->fk_image_file !== $this->aFile->getIdFile()) {
            $this->aFile = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySspModelQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFile = null;
            $this->collSpySspModelToFiles = null;

            $this->collSpySspModelToProductLists = null;

            $this->collSpySspAssetToSspModels = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySspModel::setDeleted()
     * @see SpySspModel::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySspModelQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpySspModelTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySspModelTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpySspModelTableMap::COL_UPDATED_AT)) {
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

                SpySspModelTableMap::addInstanceToPool($this);
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

            if ($this->aFile !== null) {
                if ($this->aFile->isModified() || $this->aFile->isNew()) {
                    $affectedRows += $this->aFile->save($con);
                }
                $this->setFile($this->aFile);
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

            if ($this->spySspModelToFilesScheduledForDeletion !== null) {
                if (!$this->spySspModelToFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery::create()
                        ->filterByPrimaryKeys($this->spySspModelToFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspModelToFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspModelToFiles !== null) {
                foreach ($this->collSpySspModelToFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspModelToProductListsScheduledForDeletion !== null) {
                if (!$this->spySspModelToProductListsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery::create()
                        ->filterByPrimaryKeys($this->spySspModelToProductListsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspModelToProductListsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspModelToProductLists !== null) {
                foreach ($this->collSpySspModelToProductLists as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspAssetToSspModelsScheduledForDeletion !== null) {
                if (!$this->spySspAssetToSspModelsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery::create()
                        ->filterByPrimaryKeys($this->spySspAssetToSspModelsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspAssetToSspModelsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspAssetToSspModels !== null) {
                foreach ($this->collSpySspAssetToSspModels as $referrerFK) {
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

        $this->modifiedColumns[SpySspModelTableMap::COL_ID_SSP_MODEL] = true;
        if (null !== $this->id_ssp_model) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpySspModelTableMap::COL_ID_SSP_MODEL . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySspModelTableMap::COL_ID_SSP_MODEL)) {
            $modifiedColumns[':p' . $index++]  = 'id_ssp_model';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_FK_IMAGE_FILE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_image_file';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'code';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_IMAGE_URL)) {
            $modifiedColumns[':p' . $index++]  = 'image_url';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_ssp_model (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_ssp_model':
                        $stmt->bindValue($identifier, $this->id_ssp_model, PDO::PARAM_INT);

                        break;
                    case 'fk_image_file':
                        $stmt->bindValue($identifier, $this->fk_image_file, PDO::PARAM_INT);

                        break;
                    case 'code':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);

                        break;
                    case 'image_url':
                        $stmt->bindValue($identifier, $this->image_url, PDO::PARAM_STR);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'reference':
                        $stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_ssp_model_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdSspModel($pk);

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
        $pos = SpySspModelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSspModel();

            case 1:
                return $this->getFkImageFile();

            case 2:
                return $this->getCode();

            case 3:
                return $this->getImageUrl();

            case 4:
                return $this->getName();

            case 5:
                return $this->getReference();

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
        if (isset($alreadyDumpedObjects['SpySspModel'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySspModel'][$this->hashCode()] = true;
        $keys = SpySspModelTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSspModel(),
            $keys[1] => $this->getFkImageFile(),
            $keys[2] => $this->getCode(),
            $keys[3] => $this->getImageUrl(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getReference(),
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
            if (null !== $this->aFile) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFile';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file';
                        break;
                    default:
                        $key = 'File';
                }

                $result[$key] = $this->aFile->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpySspModelToFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspModelToFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_model_to_files';
                        break;
                    default:
                        $key = 'SpySspModelToFiles';
                }

                $result[$key] = $this->collSpySspModelToFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspModelToProductLists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspModelToProductLists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_model_to_product_lists';
                        break;
                    default:
                        $key = 'SpySspModelToProductLists';
                }

                $result[$key] = $this->collSpySspModelToProductLists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspAssetToSspModels) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspAssetToSspModels';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_asset_to_ssp_models';
                        break;
                    default:
                        $key = 'SpySspAssetToSspModels';
                }

                $result[$key] = $this->collSpySspAssetToSspModels->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpySspModelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSspModel($value);
                break;
            case 1:
                $this->setFkImageFile($value);
                break;
            case 2:
                $this->setCode($value);
                break;
            case 3:
                $this->setImageUrl($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setReference($value);
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
        $keys = SpySspModelTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSspModel($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkImageFile($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setImageUrl($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setReference($arr[$keys[5]]);
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
        $criteria = new Criteria(SpySspModelTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySspModelTableMap::COL_ID_SSP_MODEL)) {
            $criteria->add(SpySspModelTableMap::COL_ID_SSP_MODEL, $this->id_ssp_model);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_FK_IMAGE_FILE)) {
            $criteria->add(SpySspModelTableMap::COL_FK_IMAGE_FILE, $this->fk_image_file);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_CODE)) {
            $criteria->add(SpySspModelTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_IMAGE_URL)) {
            $criteria->add(SpySspModelTableMap::COL_IMAGE_URL, $this->image_url);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_NAME)) {
            $criteria->add(SpySspModelTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_REFERENCE)) {
            $criteria->add(SpySspModelTableMap::COL_REFERENCE, $this->reference);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySspModelTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySspModelTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySspModelTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySspModelQuery::create();
        $criteria->add(SpySspModelTableMap::COL_ID_SSP_MODEL, $this->id_ssp_model);

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
        $validPk = null !== $this->getIdSspModel();

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
        return $this->getIdSspModel();
    }

    /**
     * Generic method to set the primary key (id_ssp_model column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdSspModel($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSspModel();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\SelfServicePortal\Persistence\SpySspModel (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkImageFile($this->getFkImageFile());
        $copyObj->setCode($this->getCode());
        $copyObj->setImageUrl($this->getImageUrl());
        $copyObj->setName($this->getName());
        $copyObj->setReference($this->getReference());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpySspModelToFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspModelToFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspModelToProductLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspModelToProductList($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspAssetToSspModels() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspAssetToSspModel($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSspModel(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModel Clone of current object.
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
     * Declares an association between this object and a SpyFile object.
     *
     * @param SpyFile|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setFile(SpyFile $v = null)
    {
        if ($v === null) {
            $this->setFkImageFile(NULL);
        } else {
            $this->setFkImageFile($v->getIdFile());
        }

        $this->aFile = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyFile object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySspModel($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyFile object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyFile|null The associated SpyFile object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getFile(?ConnectionInterface $con = null)
    {
        if ($this->aFile === null && ($this->fk_image_file != 0)) {
            $this->aFile = SpyFileQuery::create()->findPk($this->fk_image_file, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFile->addSpySspModels($this);
             */
        }

        return $this->aFile;
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
        if ('SpySspModelToFile' === $relationName) {
            $this->initSpySspModelToFiles();
            return;
        }
        if ('SpySspModelToProductList' === $relationName) {
            $this->initSpySspModelToProductLists();
            return;
        }
        if ('SpySspAssetToSspModel' === $relationName) {
            $this->initSpySspAssetToSspModels();
            return;
        }
    }

    /**
     * Clears out the collSpySspModelToFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspModelToFiles()
     */
    public function clearSpySspModelToFiles()
    {
        $this->collSpySspModelToFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspModelToFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspModelToFiles($v = true): void
    {
        $this->collSpySspModelToFilesPartial = $v;
    }

    /**
     * Initializes the collSpySspModelToFiles collection.
     *
     * By default this just sets the collSpySspModelToFiles collection to an empty array (like clearcollSpySspModelToFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspModelToFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspModelToFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspModelToFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspModelToFiles = new $collectionClassName;
        $this->collSpySspModelToFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile');
    }

    /**
     * Gets an array of ChildSpySspModelToFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspModel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspModelToFile[] List of ChildSpySspModelToFile objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspModelToFile> List of ChildSpySspModelToFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspModelToFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspModelToFilesPartial && !$this->isNew();
        if (null === $this->collSpySspModelToFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspModelToFiles) {
                    $this->initSpySspModelToFiles();
                } else {
                    $collectionClassName = SpySspModelToFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspModelToFiles = new $collectionClassName;
                    $collSpySspModelToFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile');

                    return $collSpySspModelToFiles;
                }
            } else {
                $collSpySspModelToFiles = ChildSpySspModelToFileQuery::create(null, $criteria)
                    ->filterBySspModel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspModelToFilesPartial && count($collSpySspModelToFiles)) {
                        $this->initSpySspModelToFiles(false);

                        foreach ($collSpySspModelToFiles as $obj) {
                            if (false == $this->collSpySspModelToFiles->contains($obj)) {
                                $this->collSpySspModelToFiles->append($obj);
                            }
                        }

                        $this->collSpySspModelToFilesPartial = true;
                    }

                    return $collSpySspModelToFiles;
                }

                if ($partial && $this->collSpySspModelToFiles) {
                    foreach ($this->collSpySspModelToFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspModelToFiles[] = $obj;
                        }
                    }
                }

                $this->collSpySspModelToFiles = $collSpySspModelToFiles;
                $this->collSpySspModelToFilesPartial = false;
            }
        }

        return $this->collSpySspModelToFiles;
    }

    /**
     * Sets a collection of ChildSpySspModelToFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspModelToFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspModelToFiles(Collection $spySspModelToFiles, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspModelToFile[] $spySspModelToFilesToDelete */
        $spySspModelToFilesToDelete = $this->getSpySspModelToFiles(new Criteria(), $con)->diff($spySspModelToFiles);


        $this->spySspModelToFilesScheduledForDeletion = $spySspModelToFilesToDelete;

        foreach ($spySspModelToFilesToDelete as $spySspModelToFileRemoved) {
            $spySspModelToFileRemoved->setSspModel(null);
        }

        $this->collSpySspModelToFiles = null;
        foreach ($spySspModelToFiles as $spySspModelToFile) {
            $this->addSpySspModelToFile($spySspModelToFile);
        }

        $this->collSpySspModelToFiles = $spySspModelToFiles;
        $this->collSpySspModelToFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspModelToFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspModelToFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspModelToFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspModelToFilesPartial && !$this->isNew();
        if (null === $this->collSpySspModelToFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspModelToFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspModelToFiles());
            }

            $query = ChildSpySspModelToFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySspModel($this)
                ->count($con);
        }

        return count($this->collSpySspModelToFiles);
    }

    /**
     * Method called to associate a ChildSpySspModelToFile object to this object
     * through the ChildSpySspModelToFile foreign key attribute.
     *
     * @param ChildSpySspModelToFile $l ChildSpySspModelToFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspModelToFile(ChildSpySspModelToFile $l)
    {
        if ($this->collSpySspModelToFiles === null) {
            $this->initSpySspModelToFiles();
            $this->collSpySspModelToFilesPartial = true;
        }

        if (!$this->collSpySspModelToFiles->contains($l)) {
            $this->doAddSpySspModelToFile($l);

            if ($this->spySspModelToFilesScheduledForDeletion and $this->spySspModelToFilesScheduledForDeletion->contains($l)) {
                $this->spySspModelToFilesScheduledForDeletion->remove($this->spySspModelToFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspModelToFile $spySspModelToFile The ChildSpySspModelToFile object to add.
     */
    protected function doAddSpySspModelToFile(ChildSpySspModelToFile $spySspModelToFile): void
    {
        $this->collSpySspModelToFiles[]= $spySspModelToFile;
        $spySspModelToFile->setSspModel($this);
    }

    /**
     * @param ChildSpySspModelToFile $spySspModelToFile The ChildSpySspModelToFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspModelToFile(ChildSpySspModelToFile $spySspModelToFile)
    {
        if ($this->getSpySspModelToFiles()->contains($spySspModelToFile)) {
            $pos = $this->collSpySspModelToFiles->search($spySspModelToFile);
            $this->collSpySspModelToFiles->remove($pos);
            if (null === $this->spySspModelToFilesScheduledForDeletion) {
                $this->spySspModelToFilesScheduledForDeletion = clone $this->collSpySspModelToFiles;
                $this->spySspModelToFilesScheduledForDeletion->clear();
            }
            $this->spySspModelToFilesScheduledForDeletion[]= clone $spySspModelToFile;
            $spySspModelToFile->setSspModel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspModel is new, it will return
     * an empty collection; or if this SpySspModel has previously
     * been saved, it will retrieve related SpySspModelToFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspModel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspModelToFile[] List of ChildSpySspModelToFile objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspModelToFile}> List of ChildSpySspModelToFile objects
     */
    public function getSpySspModelToFilesJoinFile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspModelToFileQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getSpySspModelToFiles($query, $con);
    }

    /**
     * Clears out the collSpySspModelToProductLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspModelToProductLists()
     */
    public function clearSpySspModelToProductLists()
    {
        $this->collSpySspModelToProductLists = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspModelToProductLists collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspModelToProductLists($v = true): void
    {
        $this->collSpySspModelToProductListsPartial = $v;
    }

    /**
     * Initializes the collSpySspModelToProductLists collection.
     *
     * By default this just sets the collSpySspModelToProductLists collection to an empty array (like clearcollSpySspModelToProductLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspModelToProductLists(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspModelToProductLists && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspModelToProductListTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspModelToProductLists = new $collectionClassName;
        $this->collSpySspModelToProductLists->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList');
    }

    /**
     * Gets an array of ChildSpySspModelToProductList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspModel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspModelToProductList[] List of ChildSpySspModelToProductList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspModelToProductList> List of ChildSpySspModelToProductList objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspModelToProductLists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspModelToProductListsPartial && !$this->isNew();
        if (null === $this->collSpySspModelToProductLists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspModelToProductLists) {
                    $this->initSpySspModelToProductLists();
                } else {
                    $collectionClassName = SpySspModelToProductListTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspModelToProductLists = new $collectionClassName;
                    $collSpySspModelToProductLists->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList');

                    return $collSpySspModelToProductLists;
                }
            } else {
                $collSpySspModelToProductLists = ChildSpySspModelToProductListQuery::create(null, $criteria)
                    ->filterBySpySspModel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspModelToProductListsPartial && count($collSpySspModelToProductLists)) {
                        $this->initSpySspModelToProductLists(false);

                        foreach ($collSpySspModelToProductLists as $obj) {
                            if (false == $this->collSpySspModelToProductLists->contains($obj)) {
                                $this->collSpySspModelToProductLists->append($obj);
                            }
                        }

                        $this->collSpySspModelToProductListsPartial = true;
                    }

                    return $collSpySspModelToProductLists;
                }

                if ($partial && $this->collSpySspModelToProductLists) {
                    foreach ($this->collSpySspModelToProductLists as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspModelToProductLists[] = $obj;
                        }
                    }
                }

                $this->collSpySspModelToProductLists = $collSpySspModelToProductLists;
                $this->collSpySspModelToProductListsPartial = false;
            }
        }

        return $this->collSpySspModelToProductLists;
    }

    /**
     * Sets a collection of ChildSpySspModelToProductList objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspModelToProductLists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspModelToProductLists(Collection $spySspModelToProductLists, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspModelToProductList[] $spySspModelToProductListsToDelete */
        $spySspModelToProductListsToDelete = $this->getSpySspModelToProductLists(new Criteria(), $con)->diff($spySspModelToProductLists);


        $this->spySspModelToProductListsScheduledForDeletion = $spySspModelToProductListsToDelete;

        foreach ($spySspModelToProductListsToDelete as $spySspModelToProductListRemoved) {
            $spySspModelToProductListRemoved->setSpySspModel(null);
        }

        $this->collSpySspModelToProductLists = null;
        foreach ($spySspModelToProductLists as $spySspModelToProductList) {
            $this->addSpySspModelToProductList($spySspModelToProductList);
        }

        $this->collSpySspModelToProductLists = $spySspModelToProductLists;
        $this->collSpySspModelToProductListsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspModelToProductList objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspModelToProductList objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspModelToProductLists(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspModelToProductListsPartial && !$this->isNew();
        if (null === $this->collSpySspModelToProductLists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspModelToProductLists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspModelToProductLists());
            }

            $query = ChildSpySspModelToProductListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySspModel($this)
                ->count($con);
        }

        return count($this->collSpySspModelToProductLists);
    }

    /**
     * Method called to associate a ChildSpySspModelToProductList object to this object
     * through the ChildSpySspModelToProductList foreign key attribute.
     *
     * @param ChildSpySspModelToProductList $l ChildSpySspModelToProductList
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspModelToProductList(ChildSpySspModelToProductList $l)
    {
        if ($this->collSpySspModelToProductLists === null) {
            $this->initSpySspModelToProductLists();
            $this->collSpySspModelToProductListsPartial = true;
        }

        if (!$this->collSpySspModelToProductLists->contains($l)) {
            $this->doAddSpySspModelToProductList($l);

            if ($this->spySspModelToProductListsScheduledForDeletion and $this->spySspModelToProductListsScheduledForDeletion->contains($l)) {
                $this->spySspModelToProductListsScheduledForDeletion->remove($this->spySspModelToProductListsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspModelToProductList $spySspModelToProductList The ChildSpySspModelToProductList object to add.
     */
    protected function doAddSpySspModelToProductList(ChildSpySspModelToProductList $spySspModelToProductList): void
    {
        $this->collSpySspModelToProductLists[]= $spySspModelToProductList;
        $spySspModelToProductList->setSpySspModel($this);
    }

    /**
     * @param ChildSpySspModelToProductList $spySspModelToProductList The ChildSpySspModelToProductList object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspModelToProductList(ChildSpySspModelToProductList $spySspModelToProductList)
    {
        if ($this->getSpySspModelToProductLists()->contains($spySspModelToProductList)) {
            $pos = $this->collSpySspModelToProductLists->search($spySspModelToProductList);
            $this->collSpySspModelToProductLists->remove($pos);
            if (null === $this->spySspModelToProductListsScheduledForDeletion) {
                $this->spySspModelToProductListsScheduledForDeletion = clone $this->collSpySspModelToProductLists;
                $this->spySspModelToProductListsScheduledForDeletion->clear();
            }
            $this->spySspModelToProductListsScheduledForDeletion[]= clone $spySspModelToProductList;
            $spySspModelToProductList->setSpySspModel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspModel is new, it will return
     * an empty collection; or if this SpySspModel has previously
     * been saved, it will retrieve related SpySspModelToProductLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspModel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspModelToProductList[] List of ChildSpySspModelToProductList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspModelToProductList}> List of ChildSpySspModelToProductList objects
     */
    public function getSpySspModelToProductListsJoinSpyProductList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspModelToProductListQuery::create(null, $criteria);
        $query->joinWith('SpyProductList', $joinBehavior);

        return $this->getSpySspModelToProductLists($query, $con);
    }

    /**
     * Clears out the collSpySspAssetToSspModels collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspAssetToSspModels()
     */
    public function clearSpySspAssetToSspModels()
    {
        $this->collSpySspAssetToSspModels = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspAssetToSspModels collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspAssetToSspModels($v = true): void
    {
        $this->collSpySspAssetToSspModelsPartial = $v;
    }

    /**
     * Initializes the collSpySspAssetToSspModels collection.
     *
     * By default this just sets the collSpySspAssetToSspModels collection to an empty array (like clearcollSpySspAssetToSspModels());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspAssetToSspModels(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspAssetToSspModels && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspAssetToSspModelTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspAssetToSspModels = new $collectionClassName;
        $this->collSpySspAssetToSspModels->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel');
    }

    /**
     * Gets an array of ChildSpySspAssetToSspModel objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySspModel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySspAssetToSspModel[] List of ChildSpySspAssetToSspModel objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspAssetToSspModel> List of ChildSpySspAssetToSspModel objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspAssetToSspModels(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspAssetToSspModelsPartial && !$this->isNew();
        if (null === $this->collSpySspAssetToSspModels || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspAssetToSspModels) {
                    $this->initSpySspAssetToSspModels();
                } else {
                    $collectionClassName = SpySspAssetToSspModelTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspAssetToSspModels = new $collectionClassName;
                    $collSpySspAssetToSspModels->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel');

                    return $collSpySspAssetToSspModels;
                }
            } else {
                $collSpySspAssetToSspModels = ChildSpySspAssetToSspModelQuery::create(null, $criteria)
                    ->filterBySpySspModel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspAssetToSspModelsPartial && count($collSpySspAssetToSspModels)) {
                        $this->initSpySspAssetToSspModels(false);

                        foreach ($collSpySspAssetToSspModels as $obj) {
                            if (false == $this->collSpySspAssetToSspModels->contains($obj)) {
                                $this->collSpySspAssetToSspModels->append($obj);
                            }
                        }

                        $this->collSpySspAssetToSspModelsPartial = true;
                    }

                    return $collSpySspAssetToSspModels;
                }

                if ($partial && $this->collSpySspAssetToSspModels) {
                    foreach ($this->collSpySspAssetToSspModels as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspAssetToSspModels[] = $obj;
                        }
                    }
                }

                $this->collSpySspAssetToSspModels = $collSpySspAssetToSspModels;
                $this->collSpySspAssetToSspModelsPartial = false;
            }
        }

        return $this->collSpySspAssetToSspModels;
    }

    /**
     * Sets a collection of ChildSpySspAssetToSspModel objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspAssetToSspModels A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspAssetToSspModels(Collection $spySspAssetToSspModels, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySspAssetToSspModel[] $spySspAssetToSspModelsToDelete */
        $spySspAssetToSspModelsToDelete = $this->getSpySspAssetToSspModels(new Criteria(), $con)->diff($spySspAssetToSspModels);


        $this->spySspAssetToSspModelsScheduledForDeletion = $spySspAssetToSspModelsToDelete;

        foreach ($spySspAssetToSspModelsToDelete as $spySspAssetToSspModelRemoved) {
            $spySspAssetToSspModelRemoved->setSpySspModel(null);
        }

        $this->collSpySspAssetToSspModels = null;
        foreach ($spySspAssetToSspModels as $spySspAssetToSspModel) {
            $this->addSpySspAssetToSspModel($spySspAssetToSspModel);
        }

        $this->collSpySspAssetToSspModels = $spySspAssetToSspModels;
        $this->collSpySspAssetToSspModelsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySspAssetToSspModel objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySspAssetToSspModel objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspAssetToSspModels(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspAssetToSspModelsPartial && !$this->isNew();
        if (null === $this->collSpySspAssetToSspModels || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspAssetToSspModels) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspAssetToSspModels());
            }

            $query = ChildSpySspAssetToSspModelQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySspModel($this)
                ->count($con);
        }

        return count($this->collSpySspAssetToSspModels);
    }

    /**
     * Method called to associate a ChildSpySspAssetToSspModel object to this object
     * through the ChildSpySspAssetToSspModel foreign key attribute.
     *
     * @param ChildSpySspAssetToSspModel $l ChildSpySspAssetToSspModel
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspAssetToSspModel(ChildSpySspAssetToSspModel $l)
    {
        if ($this->collSpySspAssetToSspModels === null) {
            $this->initSpySspAssetToSspModels();
            $this->collSpySspAssetToSspModelsPartial = true;
        }

        if (!$this->collSpySspAssetToSspModels->contains($l)) {
            $this->doAddSpySspAssetToSspModel($l);

            if ($this->spySspAssetToSspModelsScheduledForDeletion and $this->spySspAssetToSspModelsScheduledForDeletion->contains($l)) {
                $this->spySspAssetToSspModelsScheduledForDeletion->remove($this->spySspAssetToSspModelsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySspAssetToSspModel $spySspAssetToSspModel The ChildSpySspAssetToSspModel object to add.
     */
    protected function doAddSpySspAssetToSspModel(ChildSpySspAssetToSspModel $spySspAssetToSspModel): void
    {
        $this->collSpySspAssetToSspModels[]= $spySspAssetToSspModel;
        $spySspAssetToSspModel->setSpySspModel($this);
    }

    /**
     * @param ChildSpySspAssetToSspModel $spySspAssetToSspModel The ChildSpySspAssetToSspModel object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspAssetToSspModel(ChildSpySspAssetToSspModel $spySspAssetToSspModel)
    {
        if ($this->getSpySspAssetToSspModels()->contains($spySspAssetToSspModel)) {
            $pos = $this->collSpySspAssetToSspModels->search($spySspAssetToSspModel);
            $this->collSpySspAssetToSspModels->remove($pos);
            if (null === $this->spySspAssetToSspModelsScheduledForDeletion) {
                $this->spySspAssetToSspModelsScheduledForDeletion = clone $this->collSpySspAssetToSspModels;
                $this->spySspAssetToSspModelsScheduledForDeletion->clear();
            }
            $this->spySspAssetToSspModelsScheduledForDeletion[]= clone $spySspAssetToSspModel;
            $spySspAssetToSspModel->setSpySspModel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySspModel is new, it will return
     * an empty collection; or if this SpySspModel has previously
     * been saved, it will retrieve related SpySspAssetToSspModels from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySspModel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySspAssetToSspModel[] List of ChildSpySspAssetToSspModel objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySspAssetToSspModel}> List of ChildSpySspAssetToSspModel objects
     */
    public function getSpySspAssetToSspModelsJoinSpySspAsset(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySspAssetToSspModelQuery::create(null, $criteria);
        $query->joinWith('SpySspAsset', $joinBehavior);

        return $this->getSpySspAssetToSspModels($query, $con);
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
        if (null !== $this->aFile) {
            $this->aFile->removeSpySspModel($this);
        }
        $this->id_ssp_model = null;
        $this->fk_image_file = null;
        $this->code = null;
        $this->image_url = null;
        $this->name = null;
        $this->reference = null;
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
            if ($this->collSpySspModelToFiles) {
                foreach ($this->collSpySspModelToFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspModelToProductLists) {
                foreach ($this->collSpySspModelToProductLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspAssetToSspModels) {
                foreach ($this->collSpySspAssetToSspModels as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpySspModelToFiles = null;
        $this->collSpySspModelToProductLists = null;
        $this->collSpySspAssetToSspModels = null;
        $this->aFile = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySspModelTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySspModelTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_ssp_model.create';
        } else {
            $this->_eventName = 'Entity.spy_ssp_model.update';
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

        if ($this->_eventName !== 'Entity.spy_ssp_model.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_ssp_model',
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
            'name' => 'spy_ssp_model',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_ssp_model.delete',
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
            $field = str_replace('spy_ssp_model.', '', $modifiedColumn);
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
            $field = str_replace('spy_ssp_model.', '', $additionalValueColumnName);
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
        $columnType = SpySspModelTableMap::getTableMap()->getColumn($column)->getType();
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
