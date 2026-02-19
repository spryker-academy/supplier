<?php

namespace Orm\Zed\FileManager\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\FileManager\Persistence\SpyFile as ChildSpyFile;
use Orm\Zed\FileManager\Persistence\SpyFileDirectory as ChildSpyFileDirectory;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery as ChildSpyFileDirectoryQuery;
use Orm\Zed\FileManager\Persistence\SpyFileInfo as ChildSpyFileInfo;
use Orm\Zed\FileManager\Persistence\SpyFileInfoQuery as ChildSpyFileInfoQuery;
use Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes as ChildSpyFileLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery as ChildSpyFileLocalizedAttributesQuery;
use Orm\Zed\FileManager\Persistence\SpyFileQuery as ChildSpyFileQuery;
use Orm\Zed\FileManager\Persistence\Map\SpyFileInfoTableMap;
use Orm\Zed\FileManager\Persistence\Map\SpyFileLocalizedAttributesTableMap;
use Orm\Zed\FileManager\Persistence\Map\SpyFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpyCompanyBusinessUnitFile as BaseSpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpyCompanyUserFile as BaseSpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspAsset as BaseSpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspAssetFile as BaseSpySspAssetFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquiryFile as BaseSpySspInquiryFile;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspModel as BaseSpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspModelToFile as BaseSpySspModelToFile;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpyCompanyBusinessUnitFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpyCompanyUserFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspAssetTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelToFileTableMap;
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
 * Base class that represents a row from the 'spy_file' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.FileManager.Persistence.Base
 */
abstract class SpyFile implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\FileManager\\Persistence\\Map\\SpyFileTableMap';


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
     * The value for the id_file field.
     *
     * @var        int
     */
    protected $id_file;

    /**
     * The value for the fk_file_directory field.
     *
     * @var        int|null
     */
    protected $fk_file_directory;

    /**
     * The value for the file_name field.
     * The name of a file.
     * @var        string
     */
    protected $file_name;

    /**
     * The value for the file_reference field.
     *
     * @var        string|null
     */
    protected $file_reference;

    /**
     * The value for the uuid field.
     *
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        ChildSpyFileDirectory
     */
    protected $aFileDirectory;

    /**
     * @var        ObjectCollection|SpyCompanyUserFile[] Collection to store aggregation of SpyCompanyUserFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserFile> Collection to store aggregation of SpyCompanyUserFile objects.
     */
    protected $collSpyCompanyUserFiles;
    protected $collSpyCompanyUserFilesPartial;

    /**
     * @var        ObjectCollection|SpyCompanyBusinessUnitFile[] Collection to store aggregation of SpyCompanyBusinessUnitFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile> Collection to store aggregation of SpyCompanyBusinessUnitFile objects.
     */
    protected $collSpyCompanyBusinessUnitFiles;
    protected $collSpyCompanyBusinessUnitFilesPartial;

    /**
     * @var        ObjectCollection|ChildSpyFileInfo[] Collection to store aggregation of ChildSpyFileInfo objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyFileInfo> Collection to store aggregation of ChildSpyFileInfo objects.
     */
    protected $collSpyFileInfos;
    protected $collSpyFileInfosPartial;

    /**
     * @var        ObjectCollection|ChildSpyFileLocalizedAttributes[] Collection to store aggregation of ChildSpyFileLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyFileLocalizedAttributes> Collection to store aggregation of ChildSpyFileLocalizedAttributes objects.
     */
    protected $collSpyFileLocalizedAttributess;
    protected $collSpyFileLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|SpySspInquiryFile[] Collection to store aggregation of SpySspInquiryFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiryFile> Collection to store aggregation of SpySspInquiryFile objects.
     */
    protected $collSpySspInquiryFiles;
    protected $collSpySspInquiryFilesPartial;

    /**
     * @var        ObjectCollection|SpySspAssetFile[] Collection to store aggregation of SpySspAssetFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspAssetFile> Collection to store aggregation of SpySspAssetFile objects.
     */
    protected $collSpySspAssetFiles;
    protected $collSpySspAssetFilesPartial;

    /**
     * @var        ObjectCollection|SpySspAsset[] Collection to store aggregation of SpySspAsset objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspAsset> Collection to store aggregation of SpySspAsset objects.
     */
    protected $collSpySspAssets;
    protected $collSpySspAssetsPartial;

    /**
     * @var        ObjectCollection|SpySspModel[] Collection to store aggregation of SpySspModel objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspModel> Collection to store aggregation of SpySspModel objects.
     */
    protected $collSpySspModels;
    protected $collSpySspModelsPartial;

    /**
     * @var        ObjectCollection|SpySspModelToFile[] Collection to store aggregation of SpySspModelToFile objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspModelToFile> Collection to store aggregation of SpySspModelToFile objects.
     */
    protected $collSpySspModelToFiles;
    protected $collSpySspModelToFilesPartial;

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
        'spy_file.fk_file_directory' => 'fk_file_directory',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUserFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUserFile>
     */
    protected $spyCompanyUserFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyBusinessUnitFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile>
     */
    protected $spyCompanyBusinessUnitFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyFileInfo[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyFileInfo>
     */
    protected $spyFileInfosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyFileLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyFileLocalizedAttributes>
     */
    protected $spyFileLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspInquiryFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquiryFile>
     */
    protected $spySspInquiryFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspAssetFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspAssetFile>
     */
    protected $spySspAssetFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspAsset[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspAsset>
     */
    protected $spySspAssetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspModel[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspModel>
     */
    protected $spySspModelsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspModelToFile[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspModelToFile>
     */
    protected $spySspModelToFilesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\FileManager\Persistence\Base\SpyFile object.
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
     * Compares this with another <code>SpyFile</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyFile</code>, delegates to
     * <code>equals(SpyFile)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_file] column value.
     *
     * @return int
     */
    public function getIdFile()
    {
        return $this->id_file;
    }

    /**
     * Get the [fk_file_directory] column value.
     *
     * @return int|null
     */
    public function getFkFileDirectory()
    {
        return $this->fk_file_directory;
    }

    /**
     * Get the [file_name] column value.
     * The name of a file.
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Get the [file_reference] column value.
     *
     * @return string|null
     */
    public function getFileReference()
    {
        return $this->file_reference;
    }

    /**
     * Get the [uuid] column value.
     *
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of [id_file] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdFile($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_file !== $v) {
            $this->id_file = $v;
            $this->modifiedColumns[SpyFileTableMap::COL_ID_FILE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_file_directory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkFileDirectory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_file_directory !== $v) {
            $this->fk_file_directory = $v;
            $this->modifiedColumns[SpyFileTableMap::COL_FK_FILE_DIRECTORY] = true;
        }

        if ($this->aFileDirectory !== null && $this->aFileDirectory->getIdFileDirectory() !== $v) {
            $this->aFileDirectory = null;
        }

        return $this;
    }

    /**
     * Set the value of [file_name] column.
     * The name of a file.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFileName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->file_name !== $v) {
            $this->file_name = $v;
            $this->modifiedColumns[SpyFileTableMap::COL_FILE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [file_reference] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFileReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->file_reference !== $v) {
            $this->file_reference = $v;
            $this->modifiedColumns[SpyFileTableMap::COL_FILE_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [uuid] column.
     *
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
            $this->modifiedColumns[SpyFileTableMap::COL_UUID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyFileTableMap::translateFieldName('IdFile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_file = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyFileTableMap::translateFieldName('FkFileDirectory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_file_directory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyFileTableMap::translateFieldName('FileName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyFileTableMap::translateFieldName('FileReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyFileTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyFileTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile'), 0, $e);
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
        if ($this->aFileDirectory !== null && $this->fk_file_directory !== $this->aFileDirectory->getIdFileDirectory()) {
            $this->aFileDirectory = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyFileTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyFileQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFileDirectory = null;
            $this->collSpyCompanyUserFiles = null;

            $this->collSpyCompanyBusinessUnitFiles = null;

            $this->collSpyFileInfos = null;

            $this->collSpyFileLocalizedAttributess = null;

            $this->collSpySspInquiryFiles = null;

            $this->collSpySspAssetFiles = null;

            $this->collSpySspAssets = null;

            $this->collSpySspModels = null;

            $this->collSpySspModelToFiles = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyFile::setDeleted()
     * @see SpyFile::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyFileQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileTableMap::DATABASE_NAME);
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

                SpyFileTableMap::addInstanceToPool($this);
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

            if ($this->aFileDirectory !== null) {
                if ($this->aFileDirectory->isModified() || $this->aFileDirectory->isNew()) {
                    $affectedRows += $this->aFileDirectory->save($con);
                }
                $this->setFileDirectory($this->aFileDirectory);
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

            if ($this->spyCompanyUserFilesScheduledForDeletion !== null) {
                if (!$this->spyCompanyUserFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUserFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUserFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUserFiles !== null) {
                foreach ($this->collSpyCompanyUserFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyBusinessUnitFilesScheduledForDeletion !== null) {
                if (!$this->spyCompanyBusinessUnitFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyBusinessUnitFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyBusinessUnitFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyBusinessUnitFiles !== null) {
                foreach ($this->collSpyCompanyBusinessUnitFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyFileInfosScheduledForDeletion !== null) {
                if (!$this->spyFileInfosScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery::create()
                        ->filterByPrimaryKeys($this->spyFileInfosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyFileInfosScheduledForDeletion = null;
                }
            }

            if ($this->collSpyFileInfos !== null) {
                foreach ($this->collSpyFileInfos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyFileLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyFileLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyFileLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyFileLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyFileLocalizedAttributess !== null) {
                foreach ($this->collSpyFileLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquiryFilesScheduledForDeletion !== null) {
                if (!$this->spySspInquiryFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquiryFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquiryFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquiryFiles !== null) {
                foreach ($this->collSpySspInquiryFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspAssetFilesScheduledForDeletion !== null) {
                if (!$this->spySspAssetFilesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery::create()
                        ->filterByPrimaryKeys($this->spySspAssetFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspAssetFilesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspAssetFiles !== null) {
                foreach ($this->collSpySspAssetFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspAssetsScheduledForDeletion !== null) {
                if (!$this->spySspAssetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySspAssetsScheduledForDeletion as $spySspAsset) {
                        // need to save related object because we set the relation to null
                        $spySspAsset->save($con);
                    }
                    $this->spySspAssetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspAssets !== null) {
                foreach ($this->collSpySspAssets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspModelsScheduledForDeletion !== null) {
                if (!$this->spySspModelsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySspModelsScheduledForDeletion as $spySspModel) {
                        // need to save related object because we set the relation to null
                        $spySspModel->save($con);
                    }
                    $this->spySspModelsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspModels !== null) {
                foreach ($this->collSpySspModels as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[SpyFileTableMap::COL_ID_FILE] = true;
        if (null !== $this->id_file) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyFileTableMap::COL_ID_FILE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyFileTableMap::COL_ID_FILE)) {
            $modifiedColumns[':p' . $index++]  = 'id_file';
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FK_FILE_DIRECTORY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_file_directory';
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FILE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'file_name';
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FILE_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'file_reference';
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'uuid';
        }

        $sql = sprintf(
            'INSERT INTO spy_file (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_file':
                        $stmt->bindValue($identifier, $this->id_file, PDO::PARAM_INT);

                        break;
                    case 'fk_file_directory':
                        $stmt->bindValue($identifier, $this->fk_file_directory, PDO::PARAM_INT);

                        break;
                    case 'file_name':
                        $stmt->bindValue($identifier, $this->file_name, PDO::PARAM_STR);

                        break;
                    case 'file_reference':
                        $stmt->bindValue($identifier, $this->file_reference, PDO::PARAM_STR);

                        break;
                    case 'uuid':
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
            $pk = $con->lastInsertId('spy_file_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdFile($pk);

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
        $pos = SpyFileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdFile();

            case 1:
                return $this->getFkFileDirectory();

            case 2:
                return $this->getFileName();

            case 3:
                return $this->getFileReference();

            case 4:
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
        if (isset($alreadyDumpedObjects['SpyFile'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyFile'][$this->hashCode()] = true;
        $keys = SpyFileTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdFile(),
            $keys[1] => $this->getFkFileDirectory(),
            $keys[2] => $this->getFileName(),
            $keys[3] => $this->getFileReference(),
            $keys[4] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFileDirectory) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFileDirectory';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file_directory';
                        break;
                    default:
                        $key = 'FileDirectory';
                }

                $result[$key] = $this->aFileDirectory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCompanyUserFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUserFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_user_files';
                        break;
                    default:
                        $key = 'SpyCompanyUserFiles';
                }

                $result[$key] = $this->collSpyCompanyUserFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyBusinessUnitFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnitFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_unit_files';
                        break;
                    default:
                        $key = 'SpyCompanyBusinessUnitFiles';
                }

                $result[$key] = $this->collSpyCompanyBusinessUnitFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyFileInfos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFileInfos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file_infos';
                        break;
                    default:
                        $key = 'SpyFileInfos';
                }

                $result[$key] = $this->collSpyFileInfos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyFileLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyFileLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_file_localized_attributess';
                        break;
                    default:
                        $key = 'SpyFileLocalizedAttributess';
                }

                $result[$key] = $this->collSpyFileLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquiryFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquiryFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_files';
                        break;
                    default:
                        $key = 'SpySspInquiryFiles';
                }

                $result[$key] = $this->collSpySspInquiryFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspAssetFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspAssetFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_asset_files';
                        break;
                    default:
                        $key = 'SpySspAssetFiles';
                }

                $result[$key] = $this->collSpySspAssetFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspAssets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspAssets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_assets';
                        break;
                    default:
                        $key = 'SpySspAssets';
                }

                $result[$key] = $this->collSpySspAssets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspModels) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspModels';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_models';
                        break;
                    default:
                        $key = 'SpySspModels';
                }

                $result[$key] = $this->collSpySspModels->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyFileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdFile($value);
                break;
            case 1:
                $this->setFkFileDirectory($value);
                break;
            case 2:
                $this->setFileName($value);
                break;
            case 3:
                $this->setFileReference($value);
                break;
            case 4:
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
        $keys = SpyFileTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdFile($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkFileDirectory($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFileName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFileReference($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUuid($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyFileTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyFileTableMap::COL_ID_FILE)) {
            $criteria->add(SpyFileTableMap::COL_ID_FILE, $this->id_file);
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FK_FILE_DIRECTORY)) {
            $criteria->add(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $this->fk_file_directory);
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FILE_NAME)) {
            $criteria->add(SpyFileTableMap::COL_FILE_NAME, $this->file_name);
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_FILE_REFERENCE)) {
            $criteria->add(SpyFileTableMap::COL_FILE_REFERENCE, $this->file_reference);
        }
        if ($this->isColumnModified(SpyFileTableMap::COL_UUID)) {
            $criteria->add(SpyFileTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyFileQuery::create();
        $criteria->add(SpyFileTableMap::COL_ID_FILE, $this->id_file);

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
        $validPk = null !== $this->getIdFile();

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
        return $this->getIdFile();
    }

    /**
     * Generic method to set the primary key (id_file column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdFile($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdFile();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\FileManager\Persistence\SpyFile (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkFileDirectory($this->getFkFileDirectory());
        $copyObj->setFileName($this->getFileName());
        $copyObj->setFileReference($this->getFileReference());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyUserFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUserFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyBusinessUnitFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyBusinessUnitFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyFileInfos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyFileInfo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyFileLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyFileLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquiryFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquiryFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspAssetFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspAssetFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspAssets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspAsset($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspModels() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspModel($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspModelToFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspModelToFile($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdFile(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\FileManager\Persistence\SpyFile Clone of current object.
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
     * Declares an association between this object and a ChildSpyFileDirectory object.
     *
     * @param ChildSpyFileDirectory|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setFileDirectory(ChildSpyFileDirectory $v = null)
    {
        if ($v === null) {
            $this->setFkFileDirectory(NULL);
        } else {
            $this->setFkFileDirectory($v->getIdFileDirectory());
        }

        $this->aFileDirectory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyFileDirectory object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyFile($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyFileDirectory object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyFileDirectory|null The associated ChildSpyFileDirectory object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getFileDirectory(?ConnectionInterface $con = null)
    {
        if ($this->aFileDirectory === null && ($this->fk_file_directory != 0)) {
            $this->aFileDirectory = ChildSpyFileDirectoryQuery::create()->findPk($this->fk_file_directory, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFileDirectory->addSpyFiles($this);
             */
        }

        return $this->aFileDirectory;
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
        if ('SpyCompanyUserFile' === $relationName) {
            $this->initSpyCompanyUserFiles();
            return;
        }
        if ('SpyCompanyBusinessUnitFile' === $relationName) {
            $this->initSpyCompanyBusinessUnitFiles();
            return;
        }
        if ('SpyFileInfo' === $relationName) {
            $this->initSpyFileInfos();
            return;
        }
        if ('SpyFileLocalizedAttributes' === $relationName) {
            $this->initSpyFileLocalizedAttributess();
            return;
        }
        if ('SpySspInquiryFile' === $relationName) {
            $this->initSpySspInquiryFiles();
            return;
        }
        if ('SpySspAssetFile' === $relationName) {
            $this->initSpySspAssetFiles();
            return;
        }
        if ('SpySspAsset' === $relationName) {
            $this->initSpySspAssets();
            return;
        }
        if ('SpySspModel' === $relationName) {
            $this->initSpySspModels();
            return;
        }
        if ('SpySspModelToFile' === $relationName) {
            $this->initSpySspModelToFiles();
            return;
        }
    }

    /**
     * Clears out the collSpyCompanyUserFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUserFiles()
     */
    public function clearSpyCompanyUserFiles()
    {
        $this->collSpyCompanyUserFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUserFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUserFiles($v = true): void
    {
        $this->collSpyCompanyUserFilesPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUserFiles collection.
     *
     * By default this just sets the collSpyCompanyUserFiles collection to an empty array (like clearcollSpyCompanyUserFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUserFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUserFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUserFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUserFiles = new $collectionClassName;
        $this->collSpyCompanyUserFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile');
    }

    /**
     * Gets an array of SpyCompanyUserFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUserFile[] List of SpyCompanyUserFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserFile> List of SpyCompanyUserFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUserFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUserFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUserFiles) {
                    $this->initSpyCompanyUserFiles();
                } else {
                    $collectionClassName = SpyCompanyUserFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUserFiles = new $collectionClassName;
                    $collSpyCompanyUserFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile');

                    return $collSpyCompanyUserFiles;
                }
            } else {
                $collSpyCompanyUserFiles = SpyCompanyUserFileQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUserFilesPartial && count($collSpyCompanyUserFiles)) {
                        $this->initSpyCompanyUserFiles(false);

                        foreach ($collSpyCompanyUserFiles as $obj) {
                            if (false == $this->collSpyCompanyUserFiles->contains($obj)) {
                                $this->collSpyCompanyUserFiles->append($obj);
                            }
                        }

                        $this->collSpyCompanyUserFilesPartial = true;
                    }

                    return $collSpyCompanyUserFiles;
                }

                if ($partial && $this->collSpyCompanyUserFiles) {
                    foreach ($this->collSpyCompanyUserFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUserFiles[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUserFiles = $collSpyCompanyUserFiles;
                $this->collSpyCompanyUserFilesPartial = false;
            }
        }

        return $this->collSpyCompanyUserFiles;
    }

    /**
     * Sets a collection of SpyCompanyUserFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUserFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUserFiles(Collection $spyCompanyUserFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUserFile[] $spyCompanyUserFilesToDelete */
        $spyCompanyUserFilesToDelete = $this->getSpyCompanyUserFiles(new Criteria(), $con)->diff($spyCompanyUserFiles);


        $this->spyCompanyUserFilesScheduledForDeletion = $spyCompanyUserFilesToDelete;

        foreach ($spyCompanyUserFilesToDelete as $spyCompanyUserFileRemoved) {
            $spyCompanyUserFileRemoved->setFile(null);
        }

        $this->collSpyCompanyUserFiles = null;
        foreach ($spyCompanyUserFiles as $spyCompanyUserFile) {
            $this->addSpyCompanyUserFile($spyCompanyUserFile);
        }

        $this->collSpyCompanyUserFiles = $spyCompanyUserFiles;
        $this->collSpyCompanyUserFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUserFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUserFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUserFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUserFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUserFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUserFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUserFiles());
            }

            $query = SpyCompanyUserFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUserFiles);
    }

    /**
     * Method called to associate a SpyCompanyUserFile object to this object
     * through the SpyCompanyUserFile foreign key attribute.
     *
     * @param SpyCompanyUserFile $l SpyCompanyUserFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUserFile(SpyCompanyUserFile $l)
    {
        if ($this->collSpyCompanyUserFiles === null) {
            $this->initSpyCompanyUserFiles();
            $this->collSpyCompanyUserFilesPartial = true;
        }

        if (!$this->collSpyCompanyUserFiles->contains($l)) {
            $this->doAddSpyCompanyUserFile($l);

            if ($this->spyCompanyUserFilesScheduledForDeletion and $this->spyCompanyUserFilesScheduledForDeletion->contains($l)) {
                $this->spyCompanyUserFilesScheduledForDeletion->remove($this->spyCompanyUserFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUserFile $spyCompanyUserFile The SpyCompanyUserFile object to add.
     */
    protected function doAddSpyCompanyUserFile(SpyCompanyUserFile $spyCompanyUserFile): void
    {
        $this->collSpyCompanyUserFiles[]= $spyCompanyUserFile;
        $spyCompanyUserFile->setFile($this);
    }

    /**
     * @param SpyCompanyUserFile $spyCompanyUserFile The SpyCompanyUserFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUserFile(SpyCompanyUserFile $spyCompanyUserFile)
    {
        if ($this->getSpyCompanyUserFiles()->contains($spyCompanyUserFile)) {
            $pos = $this->collSpyCompanyUserFiles->search($spyCompanyUserFile);
            $this->collSpyCompanyUserFiles->remove($pos);
            if (null === $this->spyCompanyUserFilesScheduledForDeletion) {
                $this->spyCompanyUserFilesScheduledForDeletion = clone $this->collSpyCompanyUserFiles;
                $this->spyCompanyUserFilesScheduledForDeletion->clear();
            }
            $this->spyCompanyUserFilesScheduledForDeletion[]= clone $spyCompanyUserFile;
            $spyCompanyUserFile->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpyCompanyUserFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUserFile[] List of SpyCompanyUserFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUserFile}> List of SpyCompanyUserFile objects
     */
    public function getSpyCompanyUserFilesJoinCompanyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUserFileQuery::create(null, $criteria);
        $query->joinWith('CompanyUser', $joinBehavior);

        return $this->getSpyCompanyUserFiles($query, $con);
    }

    /**
     * Clears out the collSpyCompanyBusinessUnitFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyBusinessUnitFiles()
     */
    public function clearSpyCompanyBusinessUnitFiles()
    {
        $this->collSpyCompanyBusinessUnitFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyBusinessUnitFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyBusinessUnitFiles($v = true): void
    {
        $this->collSpyCompanyBusinessUnitFilesPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyBusinessUnitFiles collection.
     *
     * By default this just sets the collSpyCompanyBusinessUnitFiles collection to an empty array (like clearcollSpyCompanyBusinessUnitFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyBusinessUnitFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyBusinessUnitFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyBusinessUnitFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyBusinessUnitFiles = new $collectionClassName;
        $this->collSpyCompanyBusinessUnitFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile');
    }

    /**
     * Gets an array of SpyCompanyBusinessUnitFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyBusinessUnitFile[] List of SpyCompanyBusinessUnitFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile> List of SpyCompanyBusinessUnitFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyBusinessUnitFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyBusinessUnitFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnitFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyBusinessUnitFiles) {
                    $this->initSpyCompanyBusinessUnitFiles();
                } else {
                    $collectionClassName = SpyCompanyBusinessUnitFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyBusinessUnitFiles = new $collectionClassName;
                    $collSpyCompanyBusinessUnitFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile');

                    return $collSpyCompanyBusinessUnitFiles;
                }
            } else {
                $collSpyCompanyBusinessUnitFiles = SpyCompanyBusinessUnitFileQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyBusinessUnitFilesPartial && count($collSpyCompanyBusinessUnitFiles)) {
                        $this->initSpyCompanyBusinessUnitFiles(false);

                        foreach ($collSpyCompanyBusinessUnitFiles as $obj) {
                            if (false == $this->collSpyCompanyBusinessUnitFiles->contains($obj)) {
                                $this->collSpyCompanyBusinessUnitFiles->append($obj);
                            }
                        }

                        $this->collSpyCompanyBusinessUnitFilesPartial = true;
                    }

                    return $collSpyCompanyBusinessUnitFiles;
                }

                if ($partial && $this->collSpyCompanyBusinessUnitFiles) {
                    foreach ($this->collSpyCompanyBusinessUnitFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyBusinessUnitFiles[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyBusinessUnitFiles = $collSpyCompanyBusinessUnitFiles;
                $this->collSpyCompanyBusinessUnitFilesPartial = false;
            }
        }

        return $this->collSpyCompanyBusinessUnitFiles;
    }

    /**
     * Sets a collection of SpyCompanyBusinessUnitFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyBusinessUnitFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyBusinessUnitFiles(Collection $spyCompanyBusinessUnitFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyBusinessUnitFile[] $spyCompanyBusinessUnitFilesToDelete */
        $spyCompanyBusinessUnitFilesToDelete = $this->getSpyCompanyBusinessUnitFiles(new Criteria(), $con)->diff($spyCompanyBusinessUnitFiles);


        $this->spyCompanyBusinessUnitFilesScheduledForDeletion = $spyCompanyBusinessUnitFilesToDelete;

        foreach ($spyCompanyBusinessUnitFilesToDelete as $spyCompanyBusinessUnitFileRemoved) {
            $spyCompanyBusinessUnitFileRemoved->setFile(null);
        }

        $this->collSpyCompanyBusinessUnitFiles = null;
        foreach ($spyCompanyBusinessUnitFiles as $spyCompanyBusinessUnitFile) {
            $this->addSpyCompanyBusinessUnitFile($spyCompanyBusinessUnitFile);
        }

        $this->collSpyCompanyBusinessUnitFiles = $spyCompanyBusinessUnitFiles;
        $this->collSpyCompanyBusinessUnitFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyBusinessUnitFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyBusinessUnitFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyBusinessUnitFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyBusinessUnitFilesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnitFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyBusinessUnitFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyBusinessUnitFiles());
            }

            $query = SpyCompanyBusinessUnitFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpyCompanyBusinessUnitFiles);
    }

    /**
     * Method called to associate a SpyCompanyBusinessUnitFile object to this object
     * through the SpyCompanyBusinessUnitFile foreign key attribute.
     *
     * @param SpyCompanyBusinessUnitFile $l SpyCompanyBusinessUnitFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $l)
    {
        if ($this->collSpyCompanyBusinessUnitFiles === null) {
            $this->initSpyCompanyBusinessUnitFiles();
            $this->collSpyCompanyBusinessUnitFilesPartial = true;
        }

        if (!$this->collSpyCompanyBusinessUnitFiles->contains($l)) {
            $this->doAddSpyCompanyBusinessUnitFile($l);

            if ($this->spyCompanyBusinessUnitFilesScheduledForDeletion and $this->spyCompanyBusinessUnitFilesScheduledForDeletion->contains($l)) {
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion->remove($this->spyCompanyBusinessUnitFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile The SpyCompanyBusinessUnitFile object to add.
     */
    protected function doAddSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile): void
    {
        $this->collSpyCompanyBusinessUnitFiles[]= $spyCompanyBusinessUnitFile;
        $spyCompanyBusinessUnitFile->setFile($this);
    }

    /**
     * @param SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile The SpyCompanyBusinessUnitFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyBusinessUnitFile(SpyCompanyBusinessUnitFile $spyCompanyBusinessUnitFile)
    {
        if ($this->getSpyCompanyBusinessUnitFiles()->contains($spyCompanyBusinessUnitFile)) {
            $pos = $this->collSpyCompanyBusinessUnitFiles->search($spyCompanyBusinessUnitFile);
            $this->collSpyCompanyBusinessUnitFiles->remove($pos);
            if (null === $this->spyCompanyBusinessUnitFilesScheduledForDeletion) {
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion = clone $this->collSpyCompanyBusinessUnitFiles;
                $this->spyCompanyBusinessUnitFilesScheduledForDeletion->clear();
            }
            $this->spyCompanyBusinessUnitFilesScheduledForDeletion[]= clone $spyCompanyBusinessUnitFile;
            $spyCompanyBusinessUnitFile->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpyCompanyBusinessUnitFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnitFile[] List of SpyCompanyBusinessUnitFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnitFile}> List of SpyCompanyBusinessUnitFile objects
     */
    public function getSpyCompanyBusinessUnitFilesJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitFileQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getSpyCompanyBusinessUnitFiles($query, $con);
    }

    /**
     * Clears out the collSpyFileInfos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyFileInfos()
     */
    public function clearSpyFileInfos()
    {
        $this->collSpyFileInfos = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyFileInfos collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyFileInfos($v = true): void
    {
        $this->collSpyFileInfosPartial = $v;
    }

    /**
     * Initializes the collSpyFileInfos collection.
     *
     * By default this just sets the collSpyFileInfos collection to an empty array (like clearcollSpyFileInfos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyFileInfos(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyFileInfos && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyFileInfoTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyFileInfos = new $collectionClassName;
        $this->collSpyFileInfos->setModel('\Orm\Zed\FileManager\Persistence\SpyFileInfo');
    }

    /**
     * Gets an array of ChildSpyFileInfo objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyFileInfo[] List of ChildSpyFileInfo objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyFileInfo> List of ChildSpyFileInfo objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyFileInfos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyFileInfosPartial && !$this->isNew();
        if (null === $this->collSpyFileInfos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyFileInfos) {
                    $this->initSpyFileInfos();
                } else {
                    $collectionClassName = SpyFileInfoTableMap::getTableMap()->getCollectionClassName();

                    $collSpyFileInfos = new $collectionClassName;
                    $collSpyFileInfos->setModel('\Orm\Zed\FileManager\Persistence\SpyFileInfo');

                    return $collSpyFileInfos;
                }
            } else {
                $collSpyFileInfos = ChildSpyFileInfoQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyFileInfosPartial && count($collSpyFileInfos)) {
                        $this->initSpyFileInfos(false);

                        foreach ($collSpyFileInfos as $obj) {
                            if (false == $this->collSpyFileInfos->contains($obj)) {
                                $this->collSpyFileInfos->append($obj);
                            }
                        }

                        $this->collSpyFileInfosPartial = true;
                    }

                    return $collSpyFileInfos;
                }

                if ($partial && $this->collSpyFileInfos) {
                    foreach ($this->collSpyFileInfos as $obj) {
                        if ($obj->isNew()) {
                            $collSpyFileInfos[] = $obj;
                        }
                    }
                }

                $this->collSpyFileInfos = $collSpyFileInfos;
                $this->collSpyFileInfosPartial = false;
            }
        }

        return $this->collSpyFileInfos;
    }

    /**
     * Sets a collection of ChildSpyFileInfo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyFileInfos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyFileInfos(Collection $spyFileInfos, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyFileInfo[] $spyFileInfosToDelete */
        $spyFileInfosToDelete = $this->getSpyFileInfos(new Criteria(), $con)->diff($spyFileInfos);


        $this->spyFileInfosScheduledForDeletion = $spyFileInfosToDelete;

        foreach ($spyFileInfosToDelete as $spyFileInfoRemoved) {
            $spyFileInfoRemoved->setFile(null);
        }

        $this->collSpyFileInfos = null;
        foreach ($spyFileInfos as $spyFileInfo) {
            $this->addSpyFileInfo($spyFileInfo);
        }

        $this->collSpyFileInfos = $spyFileInfos;
        $this->collSpyFileInfosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyFileInfo objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyFileInfo objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyFileInfos(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyFileInfosPartial && !$this->isNew();
        if (null === $this->collSpyFileInfos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyFileInfos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyFileInfos());
            }

            $query = ChildSpyFileInfoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpyFileInfos);
    }

    /**
     * Method called to associate a ChildSpyFileInfo object to this object
     * through the ChildSpyFileInfo foreign key attribute.
     *
     * @param ChildSpyFileInfo $l ChildSpyFileInfo
     * @return $this The current object (for fluent API support)
     */
    public function addSpyFileInfo(ChildSpyFileInfo $l)
    {
        if ($this->collSpyFileInfos === null) {
            $this->initSpyFileInfos();
            $this->collSpyFileInfosPartial = true;
        }

        if (!$this->collSpyFileInfos->contains($l)) {
            $this->doAddSpyFileInfo($l);

            if ($this->spyFileInfosScheduledForDeletion and $this->spyFileInfosScheduledForDeletion->contains($l)) {
                $this->spyFileInfosScheduledForDeletion->remove($this->spyFileInfosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyFileInfo $spyFileInfo The ChildSpyFileInfo object to add.
     */
    protected function doAddSpyFileInfo(ChildSpyFileInfo $spyFileInfo): void
    {
        $this->collSpyFileInfos[]= $spyFileInfo;
        $spyFileInfo->setFile($this);
    }

    /**
     * @param ChildSpyFileInfo $spyFileInfo The ChildSpyFileInfo object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyFileInfo(ChildSpyFileInfo $spyFileInfo)
    {
        if ($this->getSpyFileInfos()->contains($spyFileInfo)) {
            $pos = $this->collSpyFileInfos->search($spyFileInfo);
            $this->collSpyFileInfos->remove($pos);
            if (null === $this->spyFileInfosScheduledForDeletion) {
                $this->spyFileInfosScheduledForDeletion = clone $this->collSpyFileInfos;
                $this->spyFileInfosScheduledForDeletion->clear();
            }
            $this->spyFileInfosScheduledForDeletion[]= clone $spyFileInfo;
            $spyFileInfo->setFile(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyFileLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyFileLocalizedAttributess()
     */
    public function clearSpyFileLocalizedAttributess()
    {
        $this->collSpyFileLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyFileLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyFileLocalizedAttributess($v = true): void
    {
        $this->collSpyFileLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyFileLocalizedAttributess collection.
     *
     * By default this just sets the collSpyFileLocalizedAttributess collection to an empty array (like clearcollSpyFileLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyFileLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyFileLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyFileLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyFileLocalizedAttributess = new $collectionClassName;
        $this->collSpyFileLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes');
    }

    /**
     * Gets an array of ChildSpyFileLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyFileLocalizedAttributes[] List of ChildSpyFileLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyFileLocalizedAttributes> List of ChildSpyFileLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyFileLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyFileLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyFileLocalizedAttributess) {
                    $this->initSpyFileLocalizedAttributess();
                } else {
                    $collectionClassName = SpyFileLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyFileLocalizedAttributess = new $collectionClassName;
                    $collSpyFileLocalizedAttributess->setModel('\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes');

                    return $collSpyFileLocalizedAttributess;
                }
            } else {
                $collSpyFileLocalizedAttributess = ChildSpyFileLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyFileLocalizedAttributessPartial && count($collSpyFileLocalizedAttributess)) {
                        $this->initSpyFileLocalizedAttributess(false);

                        foreach ($collSpyFileLocalizedAttributess as $obj) {
                            if (false == $this->collSpyFileLocalizedAttributess->contains($obj)) {
                                $this->collSpyFileLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyFileLocalizedAttributessPartial = true;
                    }

                    return $collSpyFileLocalizedAttributess;
                }

                if ($partial && $this->collSpyFileLocalizedAttributess) {
                    foreach ($this->collSpyFileLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyFileLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyFileLocalizedAttributess = $collSpyFileLocalizedAttributess;
                $this->collSpyFileLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyFileLocalizedAttributess;
    }

    /**
     * Sets a collection of ChildSpyFileLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyFileLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyFileLocalizedAttributess(Collection $spyFileLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyFileLocalizedAttributes[] $spyFileLocalizedAttributessToDelete */
        $spyFileLocalizedAttributessToDelete = $this->getSpyFileLocalizedAttributess(new Criteria(), $con)->diff($spyFileLocalizedAttributess);


        $this->spyFileLocalizedAttributessScheduledForDeletion = $spyFileLocalizedAttributessToDelete;

        foreach ($spyFileLocalizedAttributessToDelete as $spyFileLocalizedAttributesRemoved) {
            $spyFileLocalizedAttributesRemoved->setSpyFile(null);
        }

        $this->collSpyFileLocalizedAttributess = null;
        foreach ($spyFileLocalizedAttributess as $spyFileLocalizedAttributes) {
            $this->addSpyFileLocalizedAttributes($spyFileLocalizedAttributes);
        }

        $this->collSpyFileLocalizedAttributess = $spyFileLocalizedAttributess;
        $this->collSpyFileLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyFileLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyFileLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyFileLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyFileLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyFileLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyFileLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyFileLocalizedAttributess());
            }

            $query = ChildSpyFileLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyFile($this)
                ->count($con);
        }

        return count($this->collSpyFileLocalizedAttributess);
    }

    /**
     * Method called to associate a ChildSpyFileLocalizedAttributes object to this object
     * through the ChildSpyFileLocalizedAttributes foreign key attribute.
     *
     * @param ChildSpyFileLocalizedAttributes $l ChildSpyFileLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyFileLocalizedAttributes(ChildSpyFileLocalizedAttributes $l)
    {
        if ($this->collSpyFileLocalizedAttributess === null) {
            $this->initSpyFileLocalizedAttributess();
            $this->collSpyFileLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyFileLocalizedAttributess->contains($l)) {
            $this->doAddSpyFileLocalizedAttributes($l);

            if ($this->spyFileLocalizedAttributessScheduledForDeletion and $this->spyFileLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyFileLocalizedAttributessScheduledForDeletion->remove($this->spyFileLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyFileLocalizedAttributes $spyFileLocalizedAttributes The ChildSpyFileLocalizedAttributes object to add.
     */
    protected function doAddSpyFileLocalizedAttributes(ChildSpyFileLocalizedAttributes $spyFileLocalizedAttributes): void
    {
        $this->collSpyFileLocalizedAttributess[]= $spyFileLocalizedAttributes;
        $spyFileLocalizedAttributes->setSpyFile($this);
    }

    /**
     * @param ChildSpyFileLocalizedAttributes $spyFileLocalizedAttributes The ChildSpyFileLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyFileLocalizedAttributes(ChildSpyFileLocalizedAttributes $spyFileLocalizedAttributes)
    {
        if ($this->getSpyFileLocalizedAttributess()->contains($spyFileLocalizedAttributes)) {
            $pos = $this->collSpyFileLocalizedAttributess->search($spyFileLocalizedAttributes);
            $this->collSpyFileLocalizedAttributess->remove($pos);
            if (null === $this->spyFileLocalizedAttributessScheduledForDeletion) {
                $this->spyFileLocalizedAttributessScheduledForDeletion = clone $this->collSpyFileLocalizedAttributess;
                $this->spyFileLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyFileLocalizedAttributessScheduledForDeletion[]= clone $spyFileLocalizedAttributes;
            $spyFileLocalizedAttributes->setSpyFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpyFileLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyFileLocalizedAttributes[] List of ChildSpyFileLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyFileLocalizedAttributes}> List of ChildSpyFileLocalizedAttributes objects
     */
    public function getSpyFileLocalizedAttributessJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyFileLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getSpyFileLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpySspInquiryFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquiryFiles()
     */
    public function clearSpySspInquiryFiles()
    {
        $this->collSpySspInquiryFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquiryFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquiryFiles($v = true): void
    {
        $this->collSpySspInquiryFilesPartial = $v;
    }

    /**
     * Initializes the collSpySspInquiryFiles collection.
     *
     * By default this just sets the collSpySspInquiryFiles collection to an empty array (like clearcollSpySspInquiryFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquiryFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquiryFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquiryFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquiryFiles = new $collectionClassName;
        $this->collSpySspInquiryFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile');
    }

    /**
     * Gets an array of SpySspInquiryFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspInquiryFile[] List of SpySspInquiryFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiryFile> List of SpySspInquiryFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquiryFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquiryFilesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiryFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquiryFiles) {
                    $this->initSpySspInquiryFiles();
                } else {
                    $collectionClassName = SpySspInquiryFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquiryFiles = new $collectionClassName;
                    $collSpySspInquiryFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile');

                    return $collSpySspInquiryFiles;
                }
            } else {
                $collSpySspInquiryFiles = SpySspInquiryFileQuery::create(null, $criteria)
                    ->filterBySpyFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquiryFilesPartial && count($collSpySspInquiryFiles)) {
                        $this->initSpySspInquiryFiles(false);

                        foreach ($collSpySspInquiryFiles as $obj) {
                            if (false == $this->collSpySspInquiryFiles->contains($obj)) {
                                $this->collSpySspInquiryFiles->append($obj);
                            }
                        }

                        $this->collSpySspInquiryFilesPartial = true;
                    }

                    return $collSpySspInquiryFiles;
                }

                if ($partial && $this->collSpySspInquiryFiles) {
                    foreach ($this->collSpySspInquiryFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquiryFiles[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquiryFiles = $collSpySspInquiryFiles;
                $this->collSpySspInquiryFilesPartial = false;
            }
        }

        return $this->collSpySspInquiryFiles;
    }

    /**
     * Sets a collection of SpySspInquiryFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquiryFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquiryFiles(Collection $spySspInquiryFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpySspInquiryFile[] $spySspInquiryFilesToDelete */
        $spySspInquiryFilesToDelete = $this->getSpySspInquiryFiles(new Criteria(), $con)->diff($spySspInquiryFiles);


        $this->spySspInquiryFilesScheduledForDeletion = $spySspInquiryFilesToDelete;

        foreach ($spySspInquiryFilesToDelete as $spySspInquiryFileRemoved) {
            $spySspInquiryFileRemoved->setSpyFile(null);
        }

        $this->collSpySspInquiryFiles = null;
        foreach ($spySspInquiryFiles as $spySspInquiryFile) {
            $this->addSpySspInquiryFile($spySspInquiryFile);
        }

        $this->collSpySspInquiryFiles = $spySspInquiryFiles;
        $this->collSpySspInquiryFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspInquiryFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspInquiryFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquiryFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquiryFilesPartial && !$this->isNew();
        if (null === $this->collSpySspInquiryFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquiryFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquiryFiles());
            }

            $query = SpySspInquiryFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyFile($this)
                ->count($con);
        }

        return count($this->collSpySspInquiryFiles);
    }

    /**
     * Method called to associate a SpySspInquiryFile object to this object
     * through the SpySspInquiryFile foreign key attribute.
     *
     * @param SpySspInquiryFile $l SpySspInquiryFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquiryFile(SpySspInquiryFile $l)
    {
        if ($this->collSpySspInquiryFiles === null) {
            $this->initSpySspInquiryFiles();
            $this->collSpySspInquiryFilesPartial = true;
        }

        if (!$this->collSpySspInquiryFiles->contains($l)) {
            $this->doAddSpySspInquiryFile($l);

            if ($this->spySspInquiryFilesScheduledForDeletion and $this->spySspInquiryFilesScheduledForDeletion->contains($l)) {
                $this->spySspInquiryFilesScheduledForDeletion->remove($this->spySspInquiryFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspInquiryFile $spySspInquiryFile The SpySspInquiryFile object to add.
     */
    protected function doAddSpySspInquiryFile(SpySspInquiryFile $spySspInquiryFile): void
    {
        $this->collSpySspInquiryFiles[]= $spySspInquiryFile;
        $spySspInquiryFile->setSpyFile($this);
    }

    /**
     * @param SpySspInquiryFile $spySspInquiryFile The SpySspInquiryFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquiryFile(SpySspInquiryFile $spySspInquiryFile)
    {
        if ($this->getSpySspInquiryFiles()->contains($spySspInquiryFile)) {
            $pos = $this->collSpySspInquiryFiles->search($spySspInquiryFile);
            $this->collSpySspInquiryFiles->remove($pos);
            if (null === $this->spySspInquiryFilesScheduledForDeletion) {
                $this->spySspInquiryFilesScheduledForDeletion = clone $this->collSpySspInquiryFiles;
                $this->spySspInquiryFilesScheduledForDeletion->clear();
            }
            $this->spySspInquiryFilesScheduledForDeletion[]= clone $spySspInquiryFile;
            $spySspInquiryFile->setSpyFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpySspInquiryFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspInquiryFile[] List of SpySspInquiryFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquiryFile}> List of SpySspInquiryFile objects
     */
    public function getSpySspInquiryFilesJoinSpySspInquiry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspInquiryFileQuery::create(null, $criteria);
        $query->joinWith('SpySspInquiry', $joinBehavior);

        return $this->getSpySspInquiryFiles($query, $con);
    }

    /**
     * Clears out the collSpySspAssetFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspAssetFiles()
     */
    public function clearSpySspAssetFiles()
    {
        $this->collSpySspAssetFiles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspAssetFiles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspAssetFiles($v = true): void
    {
        $this->collSpySspAssetFilesPartial = $v;
    }

    /**
     * Initializes the collSpySspAssetFiles collection.
     *
     * By default this just sets the collSpySspAssetFiles collection to an empty array (like clearcollSpySspAssetFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspAssetFiles(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspAssetFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspAssetFileTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspAssetFiles = new $collectionClassName;
        $this->collSpySspAssetFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile');
    }

    /**
     * Gets an array of SpySspAssetFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspAssetFile[] List of SpySspAssetFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAssetFile> List of SpySspAssetFile objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspAssetFiles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspAssetFilesPartial && !$this->isNew();
        if (null === $this->collSpySspAssetFiles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspAssetFiles) {
                    $this->initSpySspAssetFiles();
                } else {
                    $collectionClassName = SpySspAssetFileTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspAssetFiles = new $collectionClassName;
                    $collSpySspAssetFiles->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile');

                    return $collSpySspAssetFiles;
                }
            } else {
                $collSpySspAssetFiles = SpySspAssetFileQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspAssetFilesPartial && count($collSpySspAssetFiles)) {
                        $this->initSpySspAssetFiles(false);

                        foreach ($collSpySspAssetFiles as $obj) {
                            if (false == $this->collSpySspAssetFiles->contains($obj)) {
                                $this->collSpySspAssetFiles->append($obj);
                            }
                        }

                        $this->collSpySspAssetFilesPartial = true;
                    }

                    return $collSpySspAssetFiles;
                }

                if ($partial && $this->collSpySspAssetFiles) {
                    foreach ($this->collSpySspAssetFiles as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspAssetFiles[] = $obj;
                        }
                    }
                }

                $this->collSpySspAssetFiles = $collSpySspAssetFiles;
                $this->collSpySspAssetFilesPartial = false;
            }
        }

        return $this->collSpySspAssetFiles;
    }

    /**
     * Sets a collection of SpySspAssetFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspAssetFiles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspAssetFiles(Collection $spySspAssetFiles, ?ConnectionInterface $con = null)
    {
        /** @var SpySspAssetFile[] $spySspAssetFilesToDelete */
        $spySspAssetFilesToDelete = $this->getSpySspAssetFiles(new Criteria(), $con)->diff($spySspAssetFiles);


        $this->spySspAssetFilesScheduledForDeletion = $spySspAssetFilesToDelete;

        foreach ($spySspAssetFilesToDelete as $spySspAssetFileRemoved) {
            $spySspAssetFileRemoved->setFile(null);
        }

        $this->collSpySspAssetFiles = null;
        foreach ($spySspAssetFiles as $spySspAssetFile) {
            $this->addSpySspAssetFile($spySspAssetFile);
        }

        $this->collSpySspAssetFiles = $spySspAssetFiles;
        $this->collSpySspAssetFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspAssetFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspAssetFile objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspAssetFiles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspAssetFilesPartial && !$this->isNew();
        if (null === $this->collSpySspAssetFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspAssetFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspAssetFiles());
            }

            $query = SpySspAssetFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpySspAssetFiles);
    }

    /**
     * Method called to associate a SpySspAssetFile object to this object
     * through the SpySspAssetFile foreign key attribute.
     *
     * @param SpySspAssetFile $l SpySspAssetFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspAssetFile(SpySspAssetFile $l)
    {
        if ($this->collSpySspAssetFiles === null) {
            $this->initSpySspAssetFiles();
            $this->collSpySspAssetFilesPartial = true;
        }

        if (!$this->collSpySspAssetFiles->contains($l)) {
            $this->doAddSpySspAssetFile($l);

            if ($this->spySspAssetFilesScheduledForDeletion and $this->spySspAssetFilesScheduledForDeletion->contains($l)) {
                $this->spySspAssetFilesScheduledForDeletion->remove($this->spySspAssetFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspAssetFile $spySspAssetFile The SpySspAssetFile object to add.
     */
    protected function doAddSpySspAssetFile(SpySspAssetFile $spySspAssetFile): void
    {
        $this->collSpySspAssetFiles[]= $spySspAssetFile;
        $spySspAssetFile->setFile($this);
    }

    /**
     * @param SpySspAssetFile $spySspAssetFile The SpySspAssetFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspAssetFile(SpySspAssetFile $spySspAssetFile)
    {
        if ($this->getSpySspAssetFiles()->contains($spySspAssetFile)) {
            $pos = $this->collSpySspAssetFiles->search($spySspAssetFile);
            $this->collSpySspAssetFiles->remove($pos);
            if (null === $this->spySspAssetFilesScheduledForDeletion) {
                $this->spySspAssetFilesScheduledForDeletion = clone $this->collSpySspAssetFiles;
                $this->spySspAssetFilesScheduledForDeletion->clear();
            }
            $this->spySspAssetFilesScheduledForDeletion[]= clone $spySspAssetFile;
            $spySspAssetFile->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpySspAssetFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspAssetFile[] List of SpySspAssetFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAssetFile}> List of SpySspAssetFile objects
     */
    public function getSpySspAssetFilesJoinSspAsset(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspAssetFileQuery::create(null, $criteria);
        $query->joinWith('SspAsset', $joinBehavior);

        return $this->getSpySspAssetFiles($query, $con);
    }

    /**
     * Clears out the collSpySspAssets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspAssets()
     */
    public function clearSpySspAssets()
    {
        $this->collSpySspAssets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspAssets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspAssets($v = true): void
    {
        $this->collSpySspAssetsPartial = $v;
    }

    /**
     * Initializes the collSpySspAssets collection.
     *
     * By default this just sets the collSpySspAssets collection to an empty array (like clearcollSpySspAssets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspAssets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspAssets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspAssetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspAssets = new $collectionClassName;
        $this->collSpySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAsset');
    }

    /**
     * Gets an array of SpySspAsset objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspAsset[] List of SpySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAsset> List of SpySspAsset objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspAssets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspAssets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspAssets) {
                    $this->initSpySspAssets();
                } else {
                    $collectionClassName = SpySspAssetTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspAssets = new $collectionClassName;
                    $collSpySspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspAsset');

                    return $collSpySspAssets;
                }
            } else {
                $collSpySspAssets = SpySspAssetQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspAssetsPartial && count($collSpySspAssets)) {
                        $this->initSpySspAssets(false);

                        foreach ($collSpySspAssets as $obj) {
                            if (false == $this->collSpySspAssets->contains($obj)) {
                                $this->collSpySspAssets->append($obj);
                            }
                        }

                        $this->collSpySspAssetsPartial = true;
                    }

                    return $collSpySspAssets;
                }

                if ($partial && $this->collSpySspAssets) {
                    foreach ($this->collSpySspAssets as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspAssets[] = $obj;
                        }
                    }
                }

                $this->collSpySspAssets = $collSpySspAssets;
                $this->collSpySspAssetsPartial = false;
            }
        }

        return $this->collSpySspAssets;
    }

    /**
     * Sets a collection of SpySspAsset objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspAssets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspAssets(Collection $spySspAssets, ?ConnectionInterface $con = null)
    {
        /** @var SpySspAsset[] $spySspAssetsToDelete */
        $spySspAssetsToDelete = $this->getSpySspAssets(new Criteria(), $con)->diff($spySspAssets);


        $this->spySspAssetsScheduledForDeletion = $spySspAssetsToDelete;

        foreach ($spySspAssetsToDelete as $spySspAssetRemoved) {
            $spySspAssetRemoved->setFile(null);
        }

        $this->collSpySspAssets = null;
        foreach ($spySspAssets as $spySspAsset) {
            $this->addSpySspAsset($spySspAsset);
        }

        $this->collSpySspAssets = $spySspAssets;
        $this->collSpySspAssetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspAsset objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspAsset objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspAssets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspAssetsPartial && !$this->isNew();
        if (null === $this->collSpySspAssets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspAssets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspAssets());
            }

            $query = SpySspAssetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpySspAssets);
    }

    /**
     * Method called to associate a SpySspAsset object to this object
     * through the SpySspAsset foreign key attribute.
     *
     * @param SpySspAsset $l SpySspAsset
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspAsset(SpySspAsset $l)
    {
        if ($this->collSpySspAssets === null) {
            $this->initSpySspAssets();
            $this->collSpySspAssetsPartial = true;
        }

        if (!$this->collSpySspAssets->contains($l)) {
            $this->doAddSpySspAsset($l);

            if ($this->spySspAssetsScheduledForDeletion and $this->spySspAssetsScheduledForDeletion->contains($l)) {
                $this->spySspAssetsScheduledForDeletion->remove($this->spySspAssetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspAsset $spySspAsset The SpySspAsset object to add.
     */
    protected function doAddSpySspAsset(SpySspAsset $spySspAsset): void
    {
        $this->collSpySspAssets[]= $spySspAsset;
        $spySspAsset->setFile($this);
    }

    /**
     * @param SpySspAsset $spySspAsset The SpySspAsset object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspAsset(SpySspAsset $spySspAsset)
    {
        if ($this->getSpySspAssets()->contains($spySspAsset)) {
            $pos = $this->collSpySspAssets->search($spySspAsset);
            $this->collSpySspAssets->remove($pos);
            if (null === $this->spySspAssetsScheduledForDeletion) {
                $this->spySspAssetsScheduledForDeletion = clone $this->collSpySspAssets;
                $this->spySspAssetsScheduledForDeletion->clear();
            }
            $this->spySspAssetsScheduledForDeletion[]= $spySspAsset;
            $spySspAsset->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpySspAssets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspAsset[] List of SpySspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspAsset}> List of SpySspAsset objects
     */
    public function getSpySspAssetsJoinSpyCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspAssetQuery::create(null, $criteria);
        $query->joinWith('SpyCompanyBusinessUnit', $joinBehavior);

        return $this->getSpySspAssets($query, $con);
    }

    /**
     * Clears out the collSpySspModels collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspModels()
     */
    public function clearSpySspModels()
    {
        $this->collSpySspModels = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspModels collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspModels($v = true): void
    {
        $this->collSpySspModelsPartial = $v;
    }

    /**
     * Initializes the collSpySspModels collection.
     *
     * By default this just sets the collSpySspModels collection to an empty array (like clearcollSpySspModels());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspModels(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspModels && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspModelTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspModels = new $collectionClassName;
        $this->collSpySspModels->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModel');
    }

    /**
     * Gets an array of SpySspModel objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspModel[] List of SpySspModel objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspModel> List of SpySspModel objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspModels(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspModelsPartial && !$this->isNew();
        if (null === $this->collSpySspModels || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspModels) {
                    $this->initSpySspModels();
                } else {
                    $collectionClassName = SpySspModelTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspModels = new $collectionClassName;
                    $collSpySspModels->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspModel');

                    return $collSpySspModels;
                }
            } else {
                $collSpySspModels = SpySspModelQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspModelsPartial && count($collSpySspModels)) {
                        $this->initSpySspModels(false);

                        foreach ($collSpySspModels as $obj) {
                            if (false == $this->collSpySspModels->contains($obj)) {
                                $this->collSpySspModels->append($obj);
                            }
                        }

                        $this->collSpySspModelsPartial = true;
                    }

                    return $collSpySspModels;
                }

                if ($partial && $this->collSpySspModels) {
                    foreach ($this->collSpySspModels as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspModels[] = $obj;
                        }
                    }
                }

                $this->collSpySspModels = $collSpySspModels;
                $this->collSpySspModelsPartial = false;
            }
        }

        return $this->collSpySspModels;
    }

    /**
     * Sets a collection of SpySspModel objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspModels A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspModels(Collection $spySspModels, ?ConnectionInterface $con = null)
    {
        /** @var SpySspModel[] $spySspModelsToDelete */
        $spySspModelsToDelete = $this->getSpySspModels(new Criteria(), $con)->diff($spySspModels);


        $this->spySspModelsScheduledForDeletion = $spySspModelsToDelete;

        foreach ($spySspModelsToDelete as $spySspModelRemoved) {
            $spySspModelRemoved->setFile(null);
        }

        $this->collSpySspModels = null;
        foreach ($spySspModels as $spySspModel) {
            $this->addSpySspModel($spySspModel);
        }

        $this->collSpySspModels = $spySspModels;
        $this->collSpySspModelsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspModel objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspModel objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspModels(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspModelsPartial && !$this->isNew();
        if (null === $this->collSpySspModels || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspModels) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspModels());
            }

            $query = SpySspModelQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpySspModels);
    }

    /**
     * Method called to associate a SpySspModel object to this object
     * through the SpySspModel foreign key attribute.
     *
     * @param SpySspModel $l SpySspModel
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspModel(SpySspModel $l)
    {
        if ($this->collSpySspModels === null) {
            $this->initSpySspModels();
            $this->collSpySspModelsPartial = true;
        }

        if (!$this->collSpySspModels->contains($l)) {
            $this->doAddSpySspModel($l);

            if ($this->spySspModelsScheduledForDeletion and $this->spySspModelsScheduledForDeletion->contains($l)) {
                $this->spySspModelsScheduledForDeletion->remove($this->spySspModelsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspModel $spySspModel The SpySspModel object to add.
     */
    protected function doAddSpySspModel(SpySspModel $spySspModel): void
    {
        $this->collSpySspModels[]= $spySspModel;
        $spySspModel->setFile($this);
    }

    /**
     * @param SpySspModel $spySspModel The SpySspModel object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspModel(SpySspModel $spySspModel)
    {
        if ($this->getSpySspModels()->contains($spySspModel)) {
            $pos = $this->collSpySspModels->search($spySspModel);
            $this->collSpySspModels->remove($pos);
            if (null === $this->spySspModelsScheduledForDeletion) {
                $this->spySspModelsScheduledForDeletion = clone $this->collSpySspModels;
                $this->spySspModelsScheduledForDeletion->clear();
            }
            $this->spySspModelsScheduledForDeletion[]= $spySspModel;
            $spySspModel->setFile(null);
        }

        return $this;
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
     * Gets an array of SpySspModelToFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspModelToFile[] List of SpySspModelToFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspModelToFile> List of SpySspModelToFile objects
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
                $collSpySspModelToFiles = SpySspModelToFileQuery::create(null, $criteria)
                    ->filterByFile($this)
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
     * Sets a collection of SpySspModelToFile objects related by a one-to-many relationship
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
        /** @var SpySspModelToFile[] $spySspModelToFilesToDelete */
        $spySspModelToFilesToDelete = $this->getSpySspModelToFiles(new Criteria(), $con)->diff($spySspModelToFiles);


        $this->spySspModelToFilesScheduledForDeletion = $spySspModelToFilesToDelete;

        foreach ($spySspModelToFilesToDelete as $spySspModelToFileRemoved) {
            $spySspModelToFileRemoved->setFile(null);
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
     * Returns the number of related BaseSpySspModelToFile objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspModelToFile objects.
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

            $query = SpySspModelToFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collSpySspModelToFiles);
    }

    /**
     * Method called to associate a SpySspModelToFile object to this object
     * through the SpySspModelToFile foreign key attribute.
     *
     * @param SpySspModelToFile $l SpySspModelToFile
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspModelToFile(SpySspModelToFile $l)
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
     * @param SpySspModelToFile $spySspModelToFile The SpySspModelToFile object to add.
     */
    protected function doAddSpySspModelToFile(SpySspModelToFile $spySspModelToFile): void
    {
        $this->collSpySspModelToFiles[]= $spySspModelToFile;
        $spySspModelToFile->setFile($this);
    }

    /**
     * @param SpySspModelToFile $spySspModelToFile The SpySspModelToFile object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspModelToFile(SpySspModelToFile $spySspModelToFile)
    {
        if ($this->getSpySspModelToFiles()->contains($spySspModelToFile)) {
            $pos = $this->collSpySspModelToFiles->search($spySspModelToFile);
            $this->collSpySspModelToFiles->remove($pos);
            if (null === $this->spySspModelToFilesScheduledForDeletion) {
                $this->spySspModelToFilesScheduledForDeletion = clone $this->collSpySspModelToFiles;
                $this->spySspModelToFilesScheduledForDeletion->clear();
            }
            $this->spySspModelToFilesScheduledForDeletion[]= clone $spySspModelToFile;
            $spySspModelToFile->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyFile is new, it will return
     * an empty collection; or if this SpyFile has previously
     * been saved, it will retrieve related SpySspModelToFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyFile.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspModelToFile[] List of SpySspModelToFile objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspModelToFile}> List of SpySspModelToFile objects
     */
    public function getSpySspModelToFilesJoinSspModel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspModelToFileQuery::create(null, $criteria);
        $query->joinWith('SspModel', $joinBehavior);

        return $this->getSpySspModelToFiles($query, $con);
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
        if (null !== $this->aFileDirectory) {
            $this->aFileDirectory->removeSpyFile($this);
        }
        $this->id_file = null;
        $this->fk_file_directory = null;
        $this->file_name = null;
        $this->file_reference = null;
        $this->uuid = null;
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
            if ($this->collSpyCompanyUserFiles) {
                foreach ($this->collSpyCompanyUserFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyBusinessUnitFiles) {
                foreach ($this->collSpyCompanyBusinessUnitFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyFileInfos) {
                foreach ($this->collSpyFileInfos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyFileLocalizedAttributess) {
                foreach ($this->collSpyFileLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquiryFiles) {
                foreach ($this->collSpySspInquiryFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspAssetFiles) {
                foreach ($this->collSpySspAssetFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspAssets) {
                foreach ($this->collSpySspAssets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspModels) {
                foreach ($this->collSpySspModels as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspModelToFiles) {
                foreach ($this->collSpySspModelToFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyUserFiles = null;
        $this->collSpyCompanyBusinessUnitFiles = null;
        $this->collSpyFileInfos = null;
        $this->collSpyFileLocalizedAttributess = null;
        $this->collSpySspInquiryFiles = null;
        $this->collSpySspAssetFiles = null;
        $this->collSpySspAssets = null;
        $this->collSpySspModels = null;
        $this->collSpySspModelToFiles = null;
        $this->aFileDirectory = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyFileTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_file' . '.' . $this->getIdFile();
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
            $this->_eventName = 'Entity.spy_file.create';
        } else {
            $this->_eventName = 'Entity.spy_file.update';
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

        if ($this->_eventName !== 'Entity.spy_file.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_file',
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
            'name' => 'spy_file',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_file.delete',
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
            $field = str_replace('spy_file.', '', $modifiedColumn);
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
            $field = str_replace('spy_file.', '', $additionalValueColumnName);
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
        $columnType = SpyFileTableMap::getTableMap()->getColumn($column)->getType();
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
