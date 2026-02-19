<?php

namespace Orm\Zed\CmsBlock\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Base\SpyCmsBlockCategoryConnector as BaseSpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Map\SpyCmsBlockCategoryConnectorTableMap;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery;
use Orm\Zed\CmsBlockProductConnector\Persistence\Base\SpyCmsBlockProductConnector as BaseSpyCmsBlockProductConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\Map\SpyCmsBlockProductConnectorTableMap;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlock as ChildSpyCmsBlock;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping as ChildSpyCmsBlockGlossaryKeyMapping;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery as ChildSpyCmsBlockGlossaryKeyMappingQuery;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery as ChildSpyCmsBlockQuery;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore as ChildSpyCmsBlockStore;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery as ChildSpyCmsBlockStoreQuery;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate as ChildSpyCmsBlockTemplate;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery as ChildSpyCmsBlockTemplateQuery;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockGlossaryKeyMappingTableMap;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockStoreTableMap;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockTableMap;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery;
use Orm\Zed\CmsSlotBlock\Persistence\Base\SpyCmsSlotBlock as BaseSpyCmsSlotBlock;
use Orm\Zed\CmsSlotBlock\Persistence\Map\SpyCmsSlotBlockTableMap;
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
 * Base class that represents a row from the 'spy_cms_block' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CmsBlock.Persistence.Base
 */
abstract class SpyCmsBlock implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CmsBlock\\Persistence\\Map\\SpyCmsBlockTableMap';


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
     * The value for the id_cms_block field.
     *
     * @var        int
     */
    protected $id_cms_block;

    /**
     * The value for the fk_template field.
     *
     * @var        int|null
     */
    protected $fk_template;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the key field.
     * Identifier for existing entities. It should never be changed.
     * @var        string
     */
    protected $key;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

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
     * @var        ChildSpyCmsBlockTemplate
     */
    protected $aCmsBlockTemplate;

    /**
     * @var        ObjectCollection|ChildSpyCmsBlockGlossaryKeyMapping[] Collection to store aggregation of ChildSpyCmsBlockGlossaryKeyMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> Collection to store aggregation of ChildSpyCmsBlockGlossaryKeyMapping objects.
     */
    protected $collSpyCmsBlockGlossaryKeyMappings;
    protected $collSpyCmsBlockGlossaryKeyMappingsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCmsBlockStore[] Collection to store aggregation of ChildSpyCmsBlockStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsBlockStore> Collection to store aggregation of ChildSpyCmsBlockStore objects.
     */
    protected $collSpyCmsBlockStores;
    protected $collSpyCmsBlockStoresPartial;

    /**
     * @var        ObjectCollection|SpyCmsBlockCategoryConnector[] Collection to store aggregation of SpyCmsBlockCategoryConnector objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector> Collection to store aggregation of SpyCmsBlockCategoryConnector objects.
     */
    protected $collSpyCmsBlockCategoryConnectors;
    protected $collSpyCmsBlockCategoryConnectorsPartial;

    /**
     * @var        ObjectCollection|SpyCmsBlockProductConnector[] Collection to store aggregation of SpyCmsBlockProductConnector objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockProductConnector> Collection to store aggregation of SpyCmsBlockProductConnector objects.
     */
    protected $collSpyCmsBlockProductConnectors;
    protected $collSpyCmsBlockProductConnectorsPartial;

    /**
     * @var        ObjectCollection|SpyCmsSlotBlock[] Collection to store aggregation of SpyCmsSlotBlock objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsSlotBlock> Collection to store aggregation of SpyCmsSlotBlock objects.
     */
    protected $collSpyCmsSlotBlocks;
    protected $collSpyCmsSlotBlocksPartial;

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
        'spy_cms_block.fk_template' => 'fk_template',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsBlockGlossaryKeyMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping>
     */
    protected $spyCmsBlockGlossaryKeyMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsBlockStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsBlockStore>
     */
    protected $spyCmsBlockStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsBlockCategoryConnector[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector>
     */
    protected $spyCmsBlockCategoryConnectorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsBlockProductConnector[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockProductConnector>
     */
    protected $spyCmsBlockProductConnectorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsSlotBlock[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsSlotBlock>
     */
    protected $spyCmsSlotBlocksScheduledForDeletion = null;

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
     * Initializes internal state of Orm\Zed\CmsBlock\Persistence\Base\SpyCmsBlock object.
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
     * Compares this with another <code>SpyCmsBlock</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCmsBlock</code>, delegates to
     * <code>equals(SpyCmsBlock)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_cms_block] column value.
     *
     * @return int
     */
    public function getIdCmsBlock()
    {
        return $this->id_cms_block;
    }

    /**
     * Get the [fk_template] column value.
     *
     * @return int|null
     */
    public function getFkTemplate()
    {
        return $this->fk_template;
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
     * Get the [key] column value.
     * Identifier for existing entities. It should never be changed.
     * @return string
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
     * Set the value of [id_cms_block] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCmsBlock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_cms_block !== $v) {
            $this->id_cms_block = $v;
            $this->modifiedColumns[SpyCmsBlockTableMap::COL_ID_CMS_BLOCK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_template] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkTemplate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_template !== $v) {
            $this->fk_template = $v;
            $this->modifiedColumns[SpyCmsBlockTableMap::COL_FK_TEMPLATE] = true;
        }

        if ($this->aCmsBlockTemplate !== null && $this->aCmsBlockTemplate->getIdCmsBlockTemplate() !== $v) {
            $this->aCmsBlockTemplate = null;
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
            $this->modifiedColumns[SpyCmsBlockTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Identifier for existing entities. It should never be changed.
     * @param string $v New value
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
            $this->modifiedColumns[SpyCmsBlockTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyCmsBlockTableMap::COL_NAME] = true;
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
                $this->modifiedColumns[SpyCmsBlockTableMap::COL_VALID_FROM] = true;
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
                $this->modifiedColumns[SpyCmsBlockTableMap::COL_VALID_TO] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCmsBlockTableMap::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_cms_block = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCmsBlockTableMap::translateFieldName('FkTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_template = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCmsBlockTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCmsBlockTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCmsBlockTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCmsBlockTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCmsBlockTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SpyCmsBlockTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock'), 0, $e);
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
        if ($this->aCmsBlockTemplate !== null && $this->fk_template !== $this->aCmsBlockTemplate->getIdCmsBlockTemplate()) {
            $this->aCmsBlockTemplate = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCmsBlockQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCmsBlockTemplate = null;
            $this->collSpyCmsBlockGlossaryKeyMappings = null;

            $this->collSpyCmsBlockStores = null;

            $this->collSpyCmsBlockCategoryConnectors = null;

            $this->collSpyCmsBlockProductConnectors = null;

            $this->collSpyCmsSlotBlocks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCmsBlock::setDeleted()
     * @see SpyCmsBlock::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCmsBlockQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
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

                SpyCmsBlockTableMap::addInstanceToPool($this);
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

            if ($this->aCmsBlockTemplate !== null) {
                if ($this->aCmsBlockTemplate->isModified() || $this->aCmsBlockTemplate->isNew()) {
                    $affectedRows += $this->aCmsBlockTemplate->save($con);
                }
                $this->setCmsBlockTemplate($this->aCmsBlockTemplate);
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

            if ($this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockGlossaryKeyMappings !== null) {
                foreach ($this->collSpyCmsBlockGlossaryKeyMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsBlockStoresScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockStores !== null) {
                foreach ($this->collSpyCmsBlockStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsBlockCategoryConnectorsScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockCategoryConnectorsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockCategoryConnectorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockCategoryConnectorsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockCategoryConnectors !== null) {
                foreach ($this->collSpyCmsBlockCategoryConnectors as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsBlockProductConnectorsScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockProductConnectorsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockProductConnectorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockProductConnectorsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockProductConnectors !== null) {
                foreach ($this->collSpyCmsBlockProductConnectors as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsSlotBlocksScheduledForDeletion !== null) {
                if (!$this->spyCmsSlotBlocksScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsSlotBlocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsSlotBlocksScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsSlotBlocks !== null) {
                foreach ($this->collSpyCmsSlotBlocks as $referrerFK) {
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

        $this->modifiedColumns[SpyCmsBlockTableMap::COL_ID_CMS_BLOCK] = true;
        if (null !== $this->id_cms_block) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCmsBlockTableMap::COL_ID_CMS_BLOCK . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK)) {
            $modifiedColumns[':p' . $index++]  = '`id_cms_block`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_FK_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = '`fk_template`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = '`valid_from`';
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = '`valid_to`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_cms_block` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_cms_block`':
                        $stmt->bindValue($identifier, $this->id_cms_block, PDO::PARAM_INT);

                        break;
                    case '`fk_template`':
                        $stmt->bindValue($identifier, $this->fk_template, PDO::PARAM_INT);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`valid_from`':
                        $stmt->bindValue($identifier, $this->valid_from ? $this->valid_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`valid_to`':
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
            $pk = $con->lastInsertId('spy_cms_block_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCmsBlock($pk);

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
        $pos = SpyCmsBlockTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCmsBlock();

            case 1:
                return $this->getFkTemplate();

            case 2:
                return $this->getIsActive();

            case 3:
                return $this->getKey();

            case 4:
                return $this->getName();

            case 5:
                return $this->getValidFrom();

            case 6:
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
        if (isset($alreadyDumpedObjects['SpyCmsBlock'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCmsBlock'][$this->hashCode()] = true;
        $keys = SpyCmsBlockTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCmsBlock(),
            $keys[1] => $this->getFkTemplate(),
            $keys[2] => $this->getIsActive(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getValidFrom(),
            $keys[6] => $this->getValidTo(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCmsBlockTemplate) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockTemplate';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_template';
                        break;
                    default:
                        $key = 'CmsBlockTemplate';
                }

                $result[$key] = $this->aCmsBlockTemplate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCmsBlockGlossaryKeyMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockGlossaryKeyMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_glossary_key_mappings';
                        break;
                    default:
                        $key = 'SpyCmsBlockGlossaryKeyMappings';
                }

                $result[$key] = $this->collSpyCmsBlockGlossaryKeyMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsBlockStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_stores';
                        break;
                    default:
                        $key = 'SpyCmsBlockStores';
                }

                $result[$key] = $this->collSpyCmsBlockStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsBlockCategoryConnectors) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockCategoryConnectors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_category_connectors';
                        break;
                    default:
                        $key = 'SpyCmsBlockCategoryConnectors';
                }

                $result[$key] = $this->collSpyCmsBlockCategoryConnectors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsBlockProductConnectors) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockProductConnectors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_product_connectors';
                        break;
                    default:
                        $key = 'SpyCmsBlockProductConnectors';
                }

                $result[$key] = $this->collSpyCmsBlockProductConnectors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsSlotBlocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsSlotBlocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_slot_blocks';
                        break;
                    default:
                        $key = 'SpyCmsSlotBlocks';
                }

                $result[$key] = $this->collSpyCmsSlotBlocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCmsBlockTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCmsBlock($value);
                break;
            case 1:
                $this->setFkTemplate($value);
                break;
            case 2:
                $this->setIsActive($value);
                break;
            case 3:
                $this->setKey($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setValidFrom($value);
                break;
            case 6:
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
        $keys = SpyCmsBlockTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCmsBlock($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkTemplate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsActive($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setKey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setValidFrom($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setValidTo($arr[$keys[6]]);
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
        $criteria = new Criteria(SpyCmsBlockTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK)) {
            $criteria->add(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $this->id_cms_block);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_FK_TEMPLATE)) {
            $criteria->add(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $this->fk_template);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyCmsBlockTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_KEY)) {
            $criteria->add(SpyCmsBlockTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_NAME)) {
            $criteria->add(SpyCmsBlockTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyCmsBlockTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyCmsBlockTableMap::COL_VALID_TO)) {
            $criteria->add(SpyCmsBlockTableMap::COL_VALID_TO, $this->valid_to);
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
        $criteria = ChildSpyCmsBlockQuery::create();
        $criteria->add(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $this->id_cms_block);

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
        $validPk = null !== $this->getIdCmsBlock();

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
        return $this->getIdCmsBlock();
    }

    /**
     * Generic method to set the primary key (id_cms_block column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCmsBlock($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCmsBlock();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkTemplate($this->getFkTemplate());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCmsBlockGlossaryKeyMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockGlossaryKeyMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsBlockStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsBlockCategoryConnectors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockCategoryConnector($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsBlockProductConnectors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockProductConnector($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsSlotBlocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsSlotBlock($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCmsBlock(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock Clone of current object.
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
     * Declares an association between this object and a ChildSpyCmsBlockTemplate object.
     *
     * @param ChildSpyCmsBlockTemplate|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCmsBlockTemplate(ChildSpyCmsBlockTemplate $v = null)
    {
        if ($v === null) {
            $this->setFkTemplate(NULL);
        } else {
            $this->setFkTemplate($v->getIdCmsBlockTemplate());
        }

        $this->aCmsBlockTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCmsBlockTemplate object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsBlock($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCmsBlockTemplate object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCmsBlockTemplate|null The associated ChildSpyCmsBlockTemplate object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCmsBlockTemplate(?ConnectionInterface $con = null)
    {
        if ($this->aCmsBlockTemplate === null && ($this->fk_template != 0)) {
            $this->aCmsBlockTemplate = ChildSpyCmsBlockTemplateQuery::create()->findPk($this->fk_template, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCmsBlockTemplate->addSpyCmsBlocks($this);
             */
        }

        return $this->aCmsBlockTemplate;
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
        if ('SpyCmsBlockGlossaryKeyMapping' === $relationName) {
            $this->initSpyCmsBlockGlossaryKeyMappings();
            return;
        }
        if ('SpyCmsBlockStore' === $relationName) {
            $this->initSpyCmsBlockStores();
            return;
        }
        if ('SpyCmsBlockCategoryConnector' === $relationName) {
            $this->initSpyCmsBlockCategoryConnectors();
            return;
        }
        if ('SpyCmsBlockProductConnector' === $relationName) {
            $this->initSpyCmsBlockProductConnectors();
            return;
        }
        if ('SpyCmsSlotBlock' === $relationName) {
            $this->initSpyCmsSlotBlocks();
            return;
        }
    }

    /**
     * Clears out the collSpyCmsBlockGlossaryKeyMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockGlossaryKeyMappings()
     */
    public function clearSpyCmsBlockGlossaryKeyMappings()
    {
        $this->collSpyCmsBlockGlossaryKeyMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockGlossaryKeyMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockGlossaryKeyMappings($v = true): void
    {
        $this->collSpyCmsBlockGlossaryKeyMappingsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockGlossaryKeyMappings collection.
     *
     * By default this just sets the collSpyCmsBlockGlossaryKeyMappings collection to an empty array (like clearcollSpyCmsBlockGlossaryKeyMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockGlossaryKeyMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockGlossaryKeyMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockGlossaryKeyMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockGlossaryKeyMappings = new $collectionClassName;
        $this->collSpyCmsBlockGlossaryKeyMappings->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping');
    }

    /**
     * Gets an array of ChildSpyCmsBlockGlossaryKeyMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsBlock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsBlockGlossaryKeyMapping[] List of ChildSpyCmsBlockGlossaryKeyMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> List of ChildSpyCmsBlockGlossaryKeyMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockGlossaryKeyMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockGlossaryKeyMappingsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockGlossaryKeyMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockGlossaryKeyMappings) {
                    $this->initSpyCmsBlockGlossaryKeyMappings();
                } else {
                    $collectionClassName = SpyCmsBlockGlossaryKeyMappingTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockGlossaryKeyMappings = new $collectionClassName;
                    $collSpyCmsBlockGlossaryKeyMappings->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping');

                    return $collSpyCmsBlockGlossaryKeyMappings;
                }
            } else {
                $collSpyCmsBlockGlossaryKeyMappings = ChildSpyCmsBlockGlossaryKeyMappingQuery::create(null, $criteria)
                    ->filterByCmsBlock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockGlossaryKeyMappingsPartial && count($collSpyCmsBlockGlossaryKeyMappings)) {
                        $this->initSpyCmsBlockGlossaryKeyMappings(false);

                        foreach ($collSpyCmsBlockGlossaryKeyMappings as $obj) {
                            if (false == $this->collSpyCmsBlockGlossaryKeyMappings->contains($obj)) {
                                $this->collSpyCmsBlockGlossaryKeyMappings->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockGlossaryKeyMappingsPartial = true;
                    }

                    return $collSpyCmsBlockGlossaryKeyMappings;
                }

                if ($partial && $this->collSpyCmsBlockGlossaryKeyMappings) {
                    foreach ($this->collSpyCmsBlockGlossaryKeyMappings as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockGlossaryKeyMappings[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockGlossaryKeyMappings = $collSpyCmsBlockGlossaryKeyMappings;
                $this->collSpyCmsBlockGlossaryKeyMappingsPartial = false;
            }
        }

        return $this->collSpyCmsBlockGlossaryKeyMappings;
    }

    /**
     * Sets a collection of ChildSpyCmsBlockGlossaryKeyMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockGlossaryKeyMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockGlossaryKeyMappings(Collection $spyCmsBlockGlossaryKeyMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsBlockGlossaryKeyMapping[] $spyCmsBlockGlossaryKeyMappingsToDelete */
        $spyCmsBlockGlossaryKeyMappingsToDelete = $this->getSpyCmsBlockGlossaryKeyMappings(new Criteria(), $con)->diff($spyCmsBlockGlossaryKeyMappings);


        $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion = $spyCmsBlockGlossaryKeyMappingsToDelete;

        foreach ($spyCmsBlockGlossaryKeyMappingsToDelete as $spyCmsBlockGlossaryKeyMappingRemoved) {
            $spyCmsBlockGlossaryKeyMappingRemoved->setCmsBlock(null);
        }

        $this->collSpyCmsBlockGlossaryKeyMappings = null;
        foreach ($spyCmsBlockGlossaryKeyMappings as $spyCmsBlockGlossaryKeyMapping) {
            $this->addSpyCmsBlockGlossaryKeyMapping($spyCmsBlockGlossaryKeyMapping);
        }

        $this->collSpyCmsBlockGlossaryKeyMappings = $spyCmsBlockGlossaryKeyMappings;
        $this->collSpyCmsBlockGlossaryKeyMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsBlockGlossaryKeyMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsBlockGlossaryKeyMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockGlossaryKeyMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockGlossaryKeyMappingsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockGlossaryKeyMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockGlossaryKeyMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockGlossaryKeyMappings());
            }

            $query = ChildSpyCmsBlockGlossaryKeyMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsBlock($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockGlossaryKeyMappings);
    }

    /**
     * Method called to associate a ChildSpyCmsBlockGlossaryKeyMapping object to this object
     * through the ChildSpyCmsBlockGlossaryKeyMapping foreign key attribute.
     *
     * @param ChildSpyCmsBlockGlossaryKeyMapping $l ChildSpyCmsBlockGlossaryKeyMapping
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockGlossaryKeyMapping(ChildSpyCmsBlockGlossaryKeyMapping $l)
    {
        if ($this->collSpyCmsBlockGlossaryKeyMappings === null) {
            $this->initSpyCmsBlockGlossaryKeyMappings();
            $this->collSpyCmsBlockGlossaryKeyMappingsPartial = true;
        }

        if (!$this->collSpyCmsBlockGlossaryKeyMappings->contains($l)) {
            $this->doAddSpyCmsBlockGlossaryKeyMapping($l);

            if ($this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion and $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->remove($this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsBlockGlossaryKeyMapping $spyCmsBlockGlossaryKeyMapping The ChildSpyCmsBlockGlossaryKeyMapping object to add.
     */
    protected function doAddSpyCmsBlockGlossaryKeyMapping(ChildSpyCmsBlockGlossaryKeyMapping $spyCmsBlockGlossaryKeyMapping): void
    {
        $this->collSpyCmsBlockGlossaryKeyMappings[]= $spyCmsBlockGlossaryKeyMapping;
        $spyCmsBlockGlossaryKeyMapping->setCmsBlock($this);
    }

    /**
     * @param ChildSpyCmsBlockGlossaryKeyMapping $spyCmsBlockGlossaryKeyMapping The ChildSpyCmsBlockGlossaryKeyMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockGlossaryKeyMapping(ChildSpyCmsBlockGlossaryKeyMapping $spyCmsBlockGlossaryKeyMapping)
    {
        if ($this->getSpyCmsBlockGlossaryKeyMappings()->contains($spyCmsBlockGlossaryKeyMapping)) {
            $pos = $this->collSpyCmsBlockGlossaryKeyMappings->search($spyCmsBlockGlossaryKeyMapping);
            $this->collSpyCmsBlockGlossaryKeyMappings->remove($pos);
            if (null === $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion) {
                $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion = clone $this->collSpyCmsBlockGlossaryKeyMappings;
                $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion->clear();
            }
            $this->spyCmsBlockGlossaryKeyMappingsScheduledForDeletion[]= clone $spyCmsBlockGlossaryKeyMapping;
            $spyCmsBlockGlossaryKeyMapping->setCmsBlock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockGlossaryKeyMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsBlockGlossaryKeyMapping[] List of ChildSpyCmsBlockGlossaryKeyMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping}> List of ChildSpyCmsBlockGlossaryKeyMapping objects
     */
    public function getSpyCmsBlockGlossaryKeyMappingsJoinGlossaryKey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsBlockGlossaryKeyMappingQuery::create(null, $criteria);
        $query->joinWith('GlossaryKey', $joinBehavior);

        return $this->getSpyCmsBlockGlossaryKeyMappings($query, $con);
    }

    /**
     * Clears out the collSpyCmsBlockStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockStores()
     */
    public function clearSpyCmsBlockStores()
    {
        $this->collSpyCmsBlockStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockStores($v = true): void
    {
        $this->collSpyCmsBlockStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockStores collection.
     *
     * By default this just sets the collSpyCmsBlockStores collection to an empty array (like clearcollSpyCmsBlockStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockStores = new $collectionClassName;
        $this->collSpyCmsBlockStores->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore');
    }

    /**
     * Gets an array of ChildSpyCmsBlockStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsBlock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsBlockStore[] List of ChildSpyCmsBlockStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsBlockStore> List of ChildSpyCmsBlockStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockStores) {
                    $this->initSpyCmsBlockStores();
                } else {
                    $collectionClassName = SpyCmsBlockStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockStores = new $collectionClassName;
                    $collSpyCmsBlockStores->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore');

                    return $collSpyCmsBlockStores;
                }
            } else {
                $collSpyCmsBlockStores = ChildSpyCmsBlockStoreQuery::create(null, $criteria)
                    ->filterBySpyCmsBlock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockStoresPartial && count($collSpyCmsBlockStores)) {
                        $this->initSpyCmsBlockStores(false);

                        foreach ($collSpyCmsBlockStores as $obj) {
                            if (false == $this->collSpyCmsBlockStores->contains($obj)) {
                                $this->collSpyCmsBlockStores->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockStoresPartial = true;
                    }

                    return $collSpyCmsBlockStores;
                }

                if ($partial && $this->collSpyCmsBlockStores) {
                    foreach ($this->collSpyCmsBlockStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockStores = $collSpyCmsBlockStores;
                $this->collSpyCmsBlockStoresPartial = false;
            }
        }

        return $this->collSpyCmsBlockStores;
    }

    /**
     * Sets a collection of ChildSpyCmsBlockStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockStores(Collection $spyCmsBlockStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsBlockStore[] $spyCmsBlockStoresToDelete */
        $spyCmsBlockStoresToDelete = $this->getSpyCmsBlockStores(new Criteria(), $con)->diff($spyCmsBlockStores);


        $this->spyCmsBlockStoresScheduledForDeletion = $spyCmsBlockStoresToDelete;

        foreach ($spyCmsBlockStoresToDelete as $spyCmsBlockStoreRemoved) {
            $spyCmsBlockStoreRemoved->setSpyCmsBlock(null);
        }

        $this->collSpyCmsBlockStores = null;
        foreach ($spyCmsBlockStores as $spyCmsBlockStore) {
            $this->addSpyCmsBlockStore($spyCmsBlockStore);
        }

        $this->collSpyCmsBlockStores = $spyCmsBlockStores;
        $this->collSpyCmsBlockStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsBlockStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsBlockStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockStores());
            }

            $query = ChildSpyCmsBlockStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCmsBlock($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockStores);
    }

    /**
     * Method called to associate a ChildSpyCmsBlockStore object to this object
     * through the ChildSpyCmsBlockStore foreign key attribute.
     *
     * @param ChildSpyCmsBlockStore $l ChildSpyCmsBlockStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockStore(ChildSpyCmsBlockStore $l)
    {
        if ($this->collSpyCmsBlockStores === null) {
            $this->initSpyCmsBlockStores();
            $this->collSpyCmsBlockStoresPartial = true;
        }

        if (!$this->collSpyCmsBlockStores->contains($l)) {
            $this->doAddSpyCmsBlockStore($l);

            if ($this->spyCmsBlockStoresScheduledForDeletion and $this->spyCmsBlockStoresScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockStoresScheduledForDeletion->remove($this->spyCmsBlockStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsBlockStore $spyCmsBlockStore The ChildSpyCmsBlockStore object to add.
     */
    protected function doAddSpyCmsBlockStore(ChildSpyCmsBlockStore $spyCmsBlockStore): void
    {
        $this->collSpyCmsBlockStores[]= $spyCmsBlockStore;
        $spyCmsBlockStore->setSpyCmsBlock($this);
    }

    /**
     * @param ChildSpyCmsBlockStore $spyCmsBlockStore The ChildSpyCmsBlockStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockStore(ChildSpyCmsBlockStore $spyCmsBlockStore)
    {
        if ($this->getSpyCmsBlockStores()->contains($spyCmsBlockStore)) {
            $pos = $this->collSpyCmsBlockStores->search($spyCmsBlockStore);
            $this->collSpyCmsBlockStores->remove($pos);
            if (null === $this->spyCmsBlockStoresScheduledForDeletion) {
                $this->spyCmsBlockStoresScheduledForDeletion = clone $this->collSpyCmsBlockStores;
                $this->spyCmsBlockStoresScheduledForDeletion->clear();
            }
            $this->spyCmsBlockStoresScheduledForDeletion[]= clone $spyCmsBlockStore;
            $spyCmsBlockStore->setSpyCmsBlock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsBlockStore[] List of ChildSpyCmsBlockStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsBlockStore}> List of ChildSpyCmsBlockStore objects
     */
    public function getSpyCmsBlockStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsBlockStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyCmsBlockStores($query, $con);
    }

    /**
     * Clears out the collSpyCmsBlockCategoryConnectors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockCategoryConnectors()
     */
    public function clearSpyCmsBlockCategoryConnectors()
    {
        $this->collSpyCmsBlockCategoryConnectors = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockCategoryConnectors collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockCategoryConnectors($v = true): void
    {
        $this->collSpyCmsBlockCategoryConnectorsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockCategoryConnectors collection.
     *
     * By default this just sets the collSpyCmsBlockCategoryConnectors collection to an empty array (like clearcollSpyCmsBlockCategoryConnectors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockCategoryConnectors(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockCategoryConnectors && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockCategoryConnectorTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockCategoryConnectors = new $collectionClassName;
        $this->collSpyCmsBlockCategoryConnectors->setModel('\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector');
    }

    /**
     * Gets an array of SpyCmsBlockCategoryConnector objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsBlock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsBlockCategoryConnector[] List of SpyCmsBlockCategoryConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector> List of SpyCmsBlockCategoryConnector objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockCategoryConnectors(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockCategoryConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockCategoryConnectors || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockCategoryConnectors) {
                    $this->initSpyCmsBlockCategoryConnectors();
                } else {
                    $collectionClassName = SpyCmsBlockCategoryConnectorTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockCategoryConnectors = new $collectionClassName;
                    $collSpyCmsBlockCategoryConnectors->setModel('\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector');

                    return $collSpyCmsBlockCategoryConnectors;
                }
            } else {
                $collSpyCmsBlockCategoryConnectors = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria)
                    ->filterByCmsBlock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockCategoryConnectorsPartial && count($collSpyCmsBlockCategoryConnectors)) {
                        $this->initSpyCmsBlockCategoryConnectors(false);

                        foreach ($collSpyCmsBlockCategoryConnectors as $obj) {
                            if (false == $this->collSpyCmsBlockCategoryConnectors->contains($obj)) {
                                $this->collSpyCmsBlockCategoryConnectors->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockCategoryConnectorsPartial = true;
                    }

                    return $collSpyCmsBlockCategoryConnectors;
                }

                if ($partial && $this->collSpyCmsBlockCategoryConnectors) {
                    foreach ($this->collSpyCmsBlockCategoryConnectors as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockCategoryConnectors[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockCategoryConnectors = $collSpyCmsBlockCategoryConnectors;
                $this->collSpyCmsBlockCategoryConnectorsPartial = false;
            }
        }

        return $this->collSpyCmsBlockCategoryConnectors;
    }

    /**
     * Sets a collection of SpyCmsBlockCategoryConnector objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockCategoryConnectors A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockCategoryConnectors(Collection $spyCmsBlockCategoryConnectors, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsBlockCategoryConnector[] $spyCmsBlockCategoryConnectorsToDelete */
        $spyCmsBlockCategoryConnectorsToDelete = $this->getSpyCmsBlockCategoryConnectors(new Criteria(), $con)->diff($spyCmsBlockCategoryConnectors);


        $this->spyCmsBlockCategoryConnectorsScheduledForDeletion = $spyCmsBlockCategoryConnectorsToDelete;

        foreach ($spyCmsBlockCategoryConnectorsToDelete as $spyCmsBlockCategoryConnectorRemoved) {
            $spyCmsBlockCategoryConnectorRemoved->setCmsBlock(null);
        }

        $this->collSpyCmsBlockCategoryConnectors = null;
        foreach ($spyCmsBlockCategoryConnectors as $spyCmsBlockCategoryConnector) {
            $this->addSpyCmsBlockCategoryConnector($spyCmsBlockCategoryConnector);
        }

        $this->collSpyCmsBlockCategoryConnectors = $spyCmsBlockCategoryConnectors;
        $this->collSpyCmsBlockCategoryConnectorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsBlockCategoryConnector objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsBlockCategoryConnector objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockCategoryConnectors(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockCategoryConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockCategoryConnectors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockCategoryConnectors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockCategoryConnectors());
            }

            $query = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsBlock($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockCategoryConnectors);
    }

    /**
     * Method called to associate a SpyCmsBlockCategoryConnector object to this object
     * through the SpyCmsBlockCategoryConnector foreign key attribute.
     *
     * @param SpyCmsBlockCategoryConnector $l SpyCmsBlockCategoryConnector
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockCategoryConnector(SpyCmsBlockCategoryConnector $l)
    {
        if ($this->collSpyCmsBlockCategoryConnectors === null) {
            $this->initSpyCmsBlockCategoryConnectors();
            $this->collSpyCmsBlockCategoryConnectorsPartial = true;
        }

        if (!$this->collSpyCmsBlockCategoryConnectors->contains($l)) {
            $this->doAddSpyCmsBlockCategoryConnector($l);

            if ($this->spyCmsBlockCategoryConnectorsScheduledForDeletion and $this->spyCmsBlockCategoryConnectorsScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockCategoryConnectorsScheduledForDeletion->remove($this->spyCmsBlockCategoryConnectorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsBlockCategoryConnector $spyCmsBlockCategoryConnector The SpyCmsBlockCategoryConnector object to add.
     */
    protected function doAddSpyCmsBlockCategoryConnector(SpyCmsBlockCategoryConnector $spyCmsBlockCategoryConnector): void
    {
        $this->collSpyCmsBlockCategoryConnectors[]= $spyCmsBlockCategoryConnector;
        $spyCmsBlockCategoryConnector->setCmsBlock($this);
    }

    /**
     * @param SpyCmsBlockCategoryConnector $spyCmsBlockCategoryConnector The SpyCmsBlockCategoryConnector object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockCategoryConnector(SpyCmsBlockCategoryConnector $spyCmsBlockCategoryConnector)
    {
        if ($this->getSpyCmsBlockCategoryConnectors()->contains($spyCmsBlockCategoryConnector)) {
            $pos = $this->collSpyCmsBlockCategoryConnectors->search($spyCmsBlockCategoryConnector);
            $this->collSpyCmsBlockCategoryConnectors->remove($pos);
            if (null === $this->spyCmsBlockCategoryConnectorsScheduledForDeletion) {
                $this->spyCmsBlockCategoryConnectorsScheduledForDeletion = clone $this->collSpyCmsBlockCategoryConnectors;
                $this->spyCmsBlockCategoryConnectorsScheduledForDeletion->clear();
            }
            $this->spyCmsBlockCategoryConnectorsScheduledForDeletion[]= clone $spyCmsBlockCategoryConnector;
            $spyCmsBlockCategoryConnector->setCmsBlock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockCategoryConnector[] List of SpyCmsBlockCategoryConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector}> List of SpyCmsBlockCategoryConnector objects
     */
    public function getSpyCmsBlockCategoryConnectorsJoinCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria);
        $query->joinWith('Category', $joinBehavior);

        return $this->getSpyCmsBlockCategoryConnectors($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockCategoryConnector[] List of SpyCmsBlockCategoryConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector}> List of SpyCmsBlockCategoryConnector objects
     */
    public function getSpyCmsBlockCategoryConnectorsJoinCategoryTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria);
        $query->joinWith('CategoryTemplate', $joinBehavior);

        return $this->getSpyCmsBlockCategoryConnectors($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockCategoryConnector[] List of SpyCmsBlockCategoryConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector}> List of SpyCmsBlockCategoryConnector objects
     */
    public function getSpyCmsBlockCategoryConnectorsJoinCmsBlockCategoryPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria);
        $query->joinWith('CmsBlockCategoryPosition', $joinBehavior);

        return $this->getSpyCmsBlockCategoryConnectors($query, $con);
    }

    /**
     * Clears out the collSpyCmsBlockProductConnectors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockProductConnectors()
     */
    public function clearSpyCmsBlockProductConnectors()
    {
        $this->collSpyCmsBlockProductConnectors = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockProductConnectors collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockProductConnectors($v = true): void
    {
        $this->collSpyCmsBlockProductConnectorsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockProductConnectors collection.
     *
     * By default this just sets the collSpyCmsBlockProductConnectors collection to an empty array (like clearcollSpyCmsBlockProductConnectors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockProductConnectors(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockProductConnectors && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockProductConnectorTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockProductConnectors = new $collectionClassName;
        $this->collSpyCmsBlockProductConnectors->setModel('\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector');
    }

    /**
     * Gets an array of SpyCmsBlockProductConnector objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsBlock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsBlockProductConnector[] List of SpyCmsBlockProductConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockProductConnector> List of SpyCmsBlockProductConnector objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockProductConnectors(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockProductConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockProductConnectors || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockProductConnectors) {
                    $this->initSpyCmsBlockProductConnectors();
                } else {
                    $collectionClassName = SpyCmsBlockProductConnectorTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockProductConnectors = new $collectionClassName;
                    $collSpyCmsBlockProductConnectors->setModel('\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector');

                    return $collSpyCmsBlockProductConnectors;
                }
            } else {
                $collSpyCmsBlockProductConnectors = SpyCmsBlockProductConnectorQuery::create(null, $criteria)
                    ->filterByCmsBlock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockProductConnectorsPartial && count($collSpyCmsBlockProductConnectors)) {
                        $this->initSpyCmsBlockProductConnectors(false);

                        foreach ($collSpyCmsBlockProductConnectors as $obj) {
                            if (false == $this->collSpyCmsBlockProductConnectors->contains($obj)) {
                                $this->collSpyCmsBlockProductConnectors->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockProductConnectorsPartial = true;
                    }

                    return $collSpyCmsBlockProductConnectors;
                }

                if ($partial && $this->collSpyCmsBlockProductConnectors) {
                    foreach ($this->collSpyCmsBlockProductConnectors as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockProductConnectors[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockProductConnectors = $collSpyCmsBlockProductConnectors;
                $this->collSpyCmsBlockProductConnectorsPartial = false;
            }
        }

        return $this->collSpyCmsBlockProductConnectors;
    }

    /**
     * Sets a collection of SpyCmsBlockProductConnector objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockProductConnectors A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockProductConnectors(Collection $spyCmsBlockProductConnectors, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsBlockProductConnector[] $spyCmsBlockProductConnectorsToDelete */
        $spyCmsBlockProductConnectorsToDelete = $this->getSpyCmsBlockProductConnectors(new Criteria(), $con)->diff($spyCmsBlockProductConnectors);


        $this->spyCmsBlockProductConnectorsScheduledForDeletion = $spyCmsBlockProductConnectorsToDelete;

        foreach ($spyCmsBlockProductConnectorsToDelete as $spyCmsBlockProductConnectorRemoved) {
            $spyCmsBlockProductConnectorRemoved->setCmsBlock(null);
        }

        $this->collSpyCmsBlockProductConnectors = null;
        foreach ($spyCmsBlockProductConnectors as $spyCmsBlockProductConnector) {
            $this->addSpyCmsBlockProductConnector($spyCmsBlockProductConnector);
        }

        $this->collSpyCmsBlockProductConnectors = $spyCmsBlockProductConnectors;
        $this->collSpyCmsBlockProductConnectorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsBlockProductConnector objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsBlockProductConnector objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockProductConnectors(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockProductConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockProductConnectors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockProductConnectors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockProductConnectors());
            }

            $query = SpyCmsBlockProductConnectorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsBlock($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockProductConnectors);
    }

    /**
     * Method called to associate a SpyCmsBlockProductConnector object to this object
     * through the SpyCmsBlockProductConnector foreign key attribute.
     *
     * @param SpyCmsBlockProductConnector $l SpyCmsBlockProductConnector
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $l)
    {
        if ($this->collSpyCmsBlockProductConnectors === null) {
            $this->initSpyCmsBlockProductConnectors();
            $this->collSpyCmsBlockProductConnectorsPartial = true;
        }

        if (!$this->collSpyCmsBlockProductConnectors->contains($l)) {
            $this->doAddSpyCmsBlockProductConnector($l);

            if ($this->spyCmsBlockProductConnectorsScheduledForDeletion and $this->spyCmsBlockProductConnectorsScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockProductConnectorsScheduledForDeletion->remove($this->spyCmsBlockProductConnectorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsBlockProductConnector $spyCmsBlockProductConnector The SpyCmsBlockProductConnector object to add.
     */
    protected function doAddSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $spyCmsBlockProductConnector): void
    {
        $this->collSpyCmsBlockProductConnectors[]= $spyCmsBlockProductConnector;
        $spyCmsBlockProductConnector->setCmsBlock($this);
    }

    /**
     * @param SpyCmsBlockProductConnector $spyCmsBlockProductConnector The SpyCmsBlockProductConnector object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $spyCmsBlockProductConnector)
    {
        if ($this->getSpyCmsBlockProductConnectors()->contains($spyCmsBlockProductConnector)) {
            $pos = $this->collSpyCmsBlockProductConnectors->search($spyCmsBlockProductConnector);
            $this->collSpyCmsBlockProductConnectors->remove($pos);
            if (null === $this->spyCmsBlockProductConnectorsScheduledForDeletion) {
                $this->spyCmsBlockProductConnectorsScheduledForDeletion = clone $this->collSpyCmsBlockProductConnectors;
                $this->spyCmsBlockProductConnectorsScheduledForDeletion->clear();
            }
            $this->spyCmsBlockProductConnectorsScheduledForDeletion[]= clone $spyCmsBlockProductConnector;
            $spyCmsBlockProductConnector->setCmsBlock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsBlockProductConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockProductConnector[] List of SpyCmsBlockProductConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockProductConnector}> List of SpyCmsBlockProductConnector objects
     */
    public function getSpyCmsBlockProductConnectorsJoinProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockProductConnectorQuery::create(null, $criteria);
        $query->joinWith('ProductAbstract', $joinBehavior);

        return $this->getSpyCmsBlockProductConnectors($query, $con);
    }

    /**
     * Clears out the collSpyCmsSlotBlocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsSlotBlocks()
     */
    public function clearSpyCmsSlotBlocks()
    {
        $this->collSpyCmsSlotBlocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsSlotBlocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsSlotBlocks($v = true): void
    {
        $this->collSpyCmsSlotBlocksPartial = $v;
    }

    /**
     * Initializes the collSpyCmsSlotBlocks collection.
     *
     * By default this just sets the collSpyCmsSlotBlocks collection to an empty array (like clearcollSpyCmsSlotBlocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsSlotBlocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsSlotBlocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsSlotBlockTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsSlotBlocks = new $collectionClassName;
        $this->collSpyCmsSlotBlocks->setModel('\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock');
    }

    /**
     * Gets an array of SpyCmsSlotBlock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsBlock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsSlotBlock[] List of SpyCmsSlotBlock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsSlotBlock> List of SpyCmsSlotBlock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsSlotBlocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsSlotBlocksPartial && !$this->isNew();
        if (null === $this->collSpyCmsSlotBlocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsSlotBlocks) {
                    $this->initSpyCmsSlotBlocks();
                } else {
                    $collectionClassName = SpyCmsSlotBlockTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsSlotBlocks = new $collectionClassName;
                    $collSpyCmsSlotBlocks->setModel('\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock');

                    return $collSpyCmsSlotBlocks;
                }
            } else {
                $collSpyCmsSlotBlocks = SpyCmsSlotBlockQuery::create(null, $criteria)
                    ->filterByCmsBlock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsSlotBlocksPartial && count($collSpyCmsSlotBlocks)) {
                        $this->initSpyCmsSlotBlocks(false);

                        foreach ($collSpyCmsSlotBlocks as $obj) {
                            if (false == $this->collSpyCmsSlotBlocks->contains($obj)) {
                                $this->collSpyCmsSlotBlocks->append($obj);
                            }
                        }

                        $this->collSpyCmsSlotBlocksPartial = true;
                    }

                    return $collSpyCmsSlotBlocks;
                }

                if ($partial && $this->collSpyCmsSlotBlocks) {
                    foreach ($this->collSpyCmsSlotBlocks as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsSlotBlocks[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsSlotBlocks = $collSpyCmsSlotBlocks;
                $this->collSpyCmsSlotBlocksPartial = false;
            }
        }

        return $this->collSpyCmsSlotBlocks;
    }

    /**
     * Sets a collection of SpyCmsSlotBlock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsSlotBlocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsSlotBlocks(Collection $spyCmsSlotBlocks, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsSlotBlock[] $spyCmsSlotBlocksToDelete */
        $spyCmsSlotBlocksToDelete = $this->getSpyCmsSlotBlocks(new Criteria(), $con)->diff($spyCmsSlotBlocks);


        $this->spyCmsSlotBlocksScheduledForDeletion = $spyCmsSlotBlocksToDelete;

        foreach ($spyCmsSlotBlocksToDelete as $spyCmsSlotBlockRemoved) {
            $spyCmsSlotBlockRemoved->setCmsBlock(null);
        }

        $this->collSpyCmsSlotBlocks = null;
        foreach ($spyCmsSlotBlocks as $spyCmsSlotBlock) {
            $this->addSpyCmsSlotBlock($spyCmsSlotBlock);
        }

        $this->collSpyCmsSlotBlocks = $spyCmsSlotBlocks;
        $this->collSpyCmsSlotBlocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsSlotBlock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsSlotBlock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsSlotBlocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsSlotBlocksPartial && !$this->isNew();
        if (null === $this->collSpyCmsSlotBlocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsSlotBlocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsSlotBlocks());
            }

            $query = SpyCmsSlotBlockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsBlock($this)
                ->count($con);
        }

        return count($this->collSpyCmsSlotBlocks);
    }

    /**
     * Method called to associate a SpyCmsSlotBlock object to this object
     * through the SpyCmsSlotBlock foreign key attribute.
     *
     * @param SpyCmsSlotBlock $l SpyCmsSlotBlock
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsSlotBlock(SpyCmsSlotBlock $l)
    {
        if ($this->collSpyCmsSlotBlocks === null) {
            $this->initSpyCmsSlotBlocks();
            $this->collSpyCmsSlotBlocksPartial = true;
        }

        if (!$this->collSpyCmsSlotBlocks->contains($l)) {
            $this->doAddSpyCmsSlotBlock($l);

            if ($this->spyCmsSlotBlocksScheduledForDeletion and $this->spyCmsSlotBlocksScheduledForDeletion->contains($l)) {
                $this->spyCmsSlotBlocksScheduledForDeletion->remove($this->spyCmsSlotBlocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsSlotBlock $spyCmsSlotBlock The SpyCmsSlotBlock object to add.
     */
    protected function doAddSpyCmsSlotBlock(SpyCmsSlotBlock $spyCmsSlotBlock): void
    {
        $this->collSpyCmsSlotBlocks[]= $spyCmsSlotBlock;
        $spyCmsSlotBlock->setCmsBlock($this);
    }

    /**
     * @param SpyCmsSlotBlock $spyCmsSlotBlock The SpyCmsSlotBlock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsSlotBlock(SpyCmsSlotBlock $spyCmsSlotBlock)
    {
        if ($this->getSpyCmsSlotBlocks()->contains($spyCmsSlotBlock)) {
            $pos = $this->collSpyCmsSlotBlocks->search($spyCmsSlotBlock);
            $this->collSpyCmsSlotBlocks->remove($pos);
            if (null === $this->spyCmsSlotBlocksScheduledForDeletion) {
                $this->spyCmsSlotBlocksScheduledForDeletion = clone $this->collSpyCmsSlotBlocks;
                $this->spyCmsSlotBlocksScheduledForDeletion->clear();
            }
            $this->spyCmsSlotBlocksScheduledForDeletion[]= clone $spyCmsSlotBlock;
            $spyCmsSlotBlock->setCmsBlock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsSlotBlocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsSlotBlock[] List of SpyCmsSlotBlock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsSlotBlock}> List of SpyCmsSlotBlock objects
     */
    public function getSpyCmsSlotBlocksJoinCmsSlotTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsSlotBlockQuery::create(null, $criteria);
        $query->joinWith('CmsSlotTemplate', $joinBehavior);

        return $this->getSpyCmsSlotBlocks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsBlock is new, it will return
     * an empty collection; or if this SpyCmsBlock has previously
     * been saved, it will retrieve related SpyCmsSlotBlocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsBlock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsSlotBlock[] List of SpyCmsSlotBlock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsSlotBlock}> List of SpyCmsSlotBlock objects
     */
    public function getSpyCmsSlotBlocksJoinCmsSlot(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsSlotBlockQuery::create(null, $criteria);
        $query->joinWith('CmsSlot', $joinBehavior);

        return $this->getSpyCmsSlotBlocks($query, $con);
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
        if (null !== $this->aCmsBlockTemplate) {
            $this->aCmsBlockTemplate->removeSpyCmsBlock($this);
        }
        $this->id_cms_block = null;
        $this->fk_template = null;
        $this->is_active = null;
        $this->key = null;
        $this->name = null;
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
            if ($this->collSpyCmsBlockGlossaryKeyMappings) {
                foreach ($this->collSpyCmsBlockGlossaryKeyMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsBlockStores) {
                foreach ($this->collSpyCmsBlockStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsBlockCategoryConnectors) {
                foreach ($this->collSpyCmsBlockCategoryConnectors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsBlockProductConnectors) {
                foreach ($this->collSpyCmsBlockProductConnectors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsSlotBlocks) {
                foreach ($this->collSpyCmsSlotBlocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCmsBlockGlossaryKeyMappings = null;
        $this->collSpyCmsBlockStores = null;
        $this->collSpyCmsBlockCategoryConnectors = null;
        $this->collSpyCmsBlockProductConnectors = null;
        $this->collSpyCmsSlotBlocks = null;
        $this->aCmsBlockTemplate = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCmsBlockTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_cms_block.create';
        } else {
            $this->_eventName = 'Entity.spy_cms_block.update';
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

        if ($this->_eventName !== 'Entity.spy_cms_block.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_cms_block',
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
            'name' => 'spy_cms_block',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_cms_block.delete',
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
            $field = str_replace('spy_cms_block.', '', $modifiedColumn);
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
            $field = str_replace('spy_cms_block.', '', $additionalValueColumnName);
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
        $columnType = SpyCmsBlockTableMap::getTableMap()->getColumn($column)->getType();
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
