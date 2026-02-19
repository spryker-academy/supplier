<?php

namespace Orm\Zed\Cms\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMapping as ChildSpyCmsGlossaryKeyMapping;
use Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMappingQuery as ChildSpyCmsGlossaryKeyMappingQuery;
use Orm\Zed\Cms\Persistence\SpyCmsPage as ChildSpyCmsPage;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes as ChildSpyCmsPageLocalizedAttributes;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery as ChildSpyCmsPageLocalizedAttributesQuery;
use Orm\Zed\Cms\Persistence\SpyCmsPageQuery as ChildSpyCmsPageQuery;
use Orm\Zed\Cms\Persistence\SpyCmsPageStore as ChildSpyCmsPageStore;
use Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery as ChildSpyCmsPageStoreQuery;
use Orm\Zed\Cms\Persistence\SpyCmsTemplate as ChildSpyCmsTemplate;
use Orm\Zed\Cms\Persistence\SpyCmsTemplateQuery as ChildSpyCmsTemplateQuery;
use Orm\Zed\Cms\Persistence\SpyCmsVersion as ChildSpyCmsVersion;
use Orm\Zed\Cms\Persistence\SpyCmsVersionQuery as ChildSpyCmsVersionQuery;
use Orm\Zed\Cms\Persistence\Map\SpyCmsGlossaryKeyMappingTableMap;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageLocalizedAttributesTableMap;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageStoreTableMap;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageTableMap;
use Orm\Zed\Cms\Persistence\Map\SpyCmsVersionTableMap;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\Url\Persistence\Base\SpyUrl as BaseSpyUrl;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * Base class that represents a row from the 'spy_cms_page' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Cms.Persistence.Base
 */
abstract class SpyCmsPage implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Cms\\Persistence\\Map\\SpyCmsPageTableMap';


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
     * The value for the id_cms_page field.
     *
     * @var        int
     */
    protected $id_cms_page;

    /**
     * The value for the fk_template field.
     *
     * @var        int
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
     * The value for the is_searchable field.
     * A flag indicating if a product or page is searchable.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_searchable;

    /**
     * The value for the page_key field.
     * A unique key for a CMS page.
     * @var        string|null
     */
    protected $page_key;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

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
     * @var        ChildSpyCmsTemplate
     */
    protected $aCmsTemplate;

    /**
     * @var        ObjectCollection|ChildSpyCmsVersion[] Collection to store aggregation of ChildSpyCmsVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsVersion> Collection to store aggregation of ChildSpyCmsVersion objects.
     */
    protected $collSpyCmsVersions;
    protected $collSpyCmsVersionsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCmsPageLocalizedAttributes[] Collection to store aggregation of ChildSpyCmsPageLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsPageLocalizedAttributes> Collection to store aggregation of ChildSpyCmsPageLocalizedAttributes objects.
     */
    protected $collSpyCmsPageLocalizedAttributess;
    protected $collSpyCmsPageLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|ChildSpyCmsGlossaryKeyMapping[] Collection to store aggregation of ChildSpyCmsGlossaryKeyMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsGlossaryKeyMapping> Collection to store aggregation of ChildSpyCmsGlossaryKeyMapping objects.
     */
    protected $collSpyCmsGlossaryKeyMappings;
    protected $collSpyCmsGlossaryKeyMappingsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCmsPageStore[] Collection to store aggregation of ChildSpyCmsPageStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsPageStore> Collection to store aggregation of ChildSpyCmsPageStore objects.
     */
    protected $collSpyCmsPageStores;
    protected $collSpyCmsPageStoresPartial;

    /**
     * @var        ObjectCollection|SpyUrl[] Collection to store aggregation of SpyUrl objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl> Collection to store aggregation of SpyUrl objects.
     */
    protected $collSpyUrls;
    protected $collSpyUrlsPartial;

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
        'spy_cms_page.fk_template' => 'fk_template',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsVersion>
     */
    protected $spyCmsVersionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsPageLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsPageLocalizedAttributes>
     */
    protected $spyCmsPageLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsGlossaryKeyMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsGlossaryKeyMapping>
     */
    protected $spyCmsGlossaryKeyMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCmsPageStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCmsPageStore>
     */
    protected $spyCmsPageStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUrl[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl>
     */
    protected $spyUrlsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
        $this->is_searchable = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Cms\Persistence\Base\SpyCmsPage object.
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
     * Compares this with another <code>SpyCmsPage</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCmsPage</code>, delegates to
     * <code>equals(SpyCmsPage)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_cms_page] column value.
     *
     * @return int
     */
    public function getIdCmsPage()
    {
        return $this->id_cms_page;
    }

    /**
     * Get the [fk_template] column value.
     *
     * @return int
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
     * Get the [is_searchable] column value.
     * A flag indicating if a product or page is searchable.
     * @return boolean
     */
    public function getIsSearchable()
    {
        return $this->is_searchable;
    }

    /**
     * Get the [is_searchable] column value.
     * A flag indicating if a product or page is searchable.
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->getIsSearchable();
    }

    /**
     * Get the [page_key] column value.
     * A unique key for a CMS page.
     * @return string|null
     */
    public function getPageKey()
    {
        return $this->page_key;
    }

    /**
     * Get the [uuid] column value.
     * A Universally Unique Identifier for an entity.
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
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
     * Set the value of [id_cms_page] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCmsPage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_cms_page !== $v) {
            $this->id_cms_page = $v;
            $this->modifiedColumns[SpyCmsPageTableMap::COL_ID_CMS_PAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_template] column.
     *
     * @param int $v New value
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
            $this->modifiedColumns[SpyCmsPageTableMap::COL_FK_TEMPLATE] = true;
        }

        if ($this->aCmsTemplate !== null && $this->aCmsTemplate->getIdCmsTemplate() !== $v) {
            $this->aCmsTemplate = null;
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
            $this->modifiedColumns[SpyCmsPageTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_searchable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a product or page is searchable.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsSearchable($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_searchable !== $v) {
            $this->is_searchable = $v;
            $this->modifiedColumns[SpyCmsPageTableMap::COL_IS_SEARCHABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [page_key] column.
     * A unique key for a CMS page.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPageKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->page_key !== $v) {
            $this->page_key = $v;
            $this->modifiedColumns[SpyCmsPageTableMap::COL_PAGE_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [uuid] column.
     * A Universally Unique Identifier for an entity.
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
            $this->modifiedColumns[SpyCmsPageTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyCmsPageTableMap::COL_VALID_FROM] = true;
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
                $this->modifiedColumns[SpyCmsPageTableMap::COL_VALID_TO] = true;
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

            if ($this->is_searchable !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCmsPageTableMap::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_cms_page = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCmsPageTableMap::translateFieldName('FkTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_template = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCmsPageTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCmsPageTableMap::translateFieldName('IsSearchable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_searchable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCmsPageTableMap::translateFieldName('PageKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->page_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCmsPageTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCmsPageTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCmsPageTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = SpyCmsPageTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage'), 0, $e);
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
        if ($this->aCmsTemplate !== null && $this->fk_template !== $this->aCmsTemplate->getIdCmsTemplate()) {
            $this->aCmsTemplate = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCmsPageTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCmsPageQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCmsTemplate = null;
            $this->collSpyCmsVersions = null;

            $this->collSpyCmsPageLocalizedAttributess = null;

            $this->collSpyCmsGlossaryKeyMappings = null;

            $this->collSpyCmsPageStores = null;

            $this->collSpyUrls = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCmsPage::setDeleted()
     * @see SpyCmsPage::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCmsPageQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageTableMap::DATABASE_NAME);
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

                SpyCmsPageTableMap::addInstanceToPool($this);
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

            if ($this->aCmsTemplate !== null) {
                if ($this->aCmsTemplate->isModified() || $this->aCmsTemplate->isNew()) {
                    $affectedRows += $this->aCmsTemplate->save($con);
                }
                $this->setCmsTemplate($this->aCmsTemplate);
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

            if ($this->spyCmsVersionsScheduledForDeletion !== null) {
                if (!$this->spyCmsVersionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsVersionQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsVersions !== null) {
                foreach ($this->collSpyCmsVersions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsPageLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyCmsPageLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsPageLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsPageLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsPageLocalizedAttributess !== null) {
                foreach ($this->collSpyCmsPageLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsGlossaryKeyMappingsScheduledForDeletion !== null) {
                if (!$this->spyCmsGlossaryKeyMappingsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMappingQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsGlossaryKeyMappingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsGlossaryKeyMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsGlossaryKeyMappings !== null) {
                foreach ($this->collSpyCmsGlossaryKeyMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsPageStoresScheduledForDeletion !== null) {
                if (!$this->spyCmsPageStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsPageStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsPageStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsPageStores !== null) {
                foreach ($this->collSpyCmsPageStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyUrlsScheduledForDeletion !== null) {
                if (!$this->spyUrlsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Url\Persistence\SpyUrlQuery::create()
                        ->filterByPrimaryKeys($this->spyUrlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyUrlsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyUrls !== null) {
                foreach ($this->collSpyUrls as $referrerFK) {
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

        $this->modifiedColumns[SpyCmsPageTableMap::COL_ID_CMS_PAGE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_ID_CMS_PAGE)) {
            $modifiedColumns[':p' . $index++]  = 'id_cms_page';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_FK_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_template';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_IS_SEARCHABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_searchable';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_PAGE_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'page_key';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'uuid';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'valid_from';
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = 'valid_to';
        }

        $sql = sprintf(
            'INSERT INTO spy_cms_page (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_cms_page':
                        $stmt->bindValue($identifier, $this->id_cms_page, PDO::PARAM_INT);

                        break;
                    case 'fk_template':
                        $stmt->bindValue($identifier, $this->fk_template, PDO::PARAM_INT);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'is_searchable':
                        $stmt->bindValue($identifier, (int) $this->is_searchable, PDO::PARAM_INT);

                        break;
                    case 'page_key':
                        $stmt->bindValue($identifier, $this->page_key, PDO::PARAM_STR);

                        break;
                    case 'uuid':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_cms_page_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdCmsPage($pk);
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
        $pos = SpyCmsPageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCmsPage();

            case 1:
                return $this->getFkTemplate();

            case 2:
                return $this->getIsActive();

            case 3:
                return $this->getIsSearchable();

            case 4:
                return $this->getPageKey();

            case 5:
                return $this->getUuid();

            case 6:
                return $this->getValidFrom();

            case 7:
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
        if (isset($alreadyDumpedObjects['SpyCmsPage'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCmsPage'][$this->hashCode()] = true;
        $keys = SpyCmsPageTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCmsPage(),
            $keys[1] => $this->getFkTemplate(),
            $keys[2] => $this->getIsActive(),
            $keys[3] => $this->getIsSearchable(),
            $keys[4] => $this->getPageKey(),
            $keys[5] => $this->getUuid(),
            $keys[6] => $this->getValidFrom(),
            $keys[7] => $this->getValidTo(),
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
            if (null !== $this->aCmsTemplate) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsTemplate';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_template';
                        break;
                    default:
                        $key = 'CmsTemplate';
                }

                $result[$key] = $this->aCmsTemplate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCmsVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_versions';
                        break;
                    default:
                        $key = 'SpyCmsVersions';
                }

                $result[$key] = $this->collSpyCmsVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsPageLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsPageLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_page_localized_attributess';
                        break;
                    default:
                        $key = 'SpyCmsPageLocalizedAttributess';
                }

                $result[$key] = $this->collSpyCmsPageLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsGlossaryKeyMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsGlossaryKeyMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_glossary_key_mappings';
                        break;
                    default:
                        $key = 'SpyCmsGlossaryKeyMappings';
                }

                $result[$key] = $this->collSpyCmsGlossaryKeyMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsPageStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsPageStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_page_stores';
                        break;
                    default:
                        $key = 'SpyCmsPageStores';
                }

                $result[$key] = $this->collSpyCmsPageStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyUrls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUrls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_urls';
                        break;
                    default:
                        $key = 'SpyUrls';
                }

                $result[$key] = $this->collSpyUrls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCmsPageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCmsPage($value);
                break;
            case 1:
                $this->setFkTemplate($value);
                break;
            case 2:
                $this->setIsActive($value);
                break;
            case 3:
                $this->setIsSearchable($value);
                break;
            case 4:
                $this->setPageKey($value);
                break;
            case 5:
                $this->setUuid($value);
                break;
            case 6:
                $this->setValidFrom($value);
                break;
            case 7:
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
        $keys = SpyCmsPageTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCmsPage($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkTemplate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsActive($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsSearchable($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPageKey($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUuid($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setValidFrom($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setValidTo($arr[$keys[7]]);
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
        $criteria = new Criteria(SpyCmsPageTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCmsPageTableMap::COL_ID_CMS_PAGE)) {
            $criteria->add(SpyCmsPageTableMap::COL_ID_CMS_PAGE, $this->id_cms_page);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_FK_TEMPLATE)) {
            $criteria->add(SpyCmsPageTableMap::COL_FK_TEMPLATE, $this->fk_template);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyCmsPageTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_IS_SEARCHABLE)) {
            $criteria->add(SpyCmsPageTableMap::COL_IS_SEARCHABLE, $this->is_searchable);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_PAGE_KEY)) {
            $criteria->add(SpyCmsPageTableMap::COL_PAGE_KEY, $this->page_key);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_UUID)) {
            $criteria->add(SpyCmsPageTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyCmsPageTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyCmsPageTableMap::COL_VALID_TO)) {
            $criteria->add(SpyCmsPageTableMap::COL_VALID_TO, $this->valid_to);
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
        $criteria = ChildSpyCmsPageQuery::create();
        $criteria->add(SpyCmsPageTableMap::COL_ID_CMS_PAGE, $this->id_cms_page);

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
        $validPk = null !== $this->getIdCmsPage();

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
        return $this->getIdCmsPage();
    }

    /**
     * Generic method to set the primary key (id_cms_page column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCmsPage($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCmsPage();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Cms\Persistence\SpyCmsPage (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkTemplate($this->getFkTemplate());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsSearchable($this->getIsSearchable());
        $copyObj->setPageKey($this->getPageKey());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCmsVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsVersion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsPageLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsPageLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsGlossaryKeyMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsGlossaryKeyMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsPageStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsPageStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyUrls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUrl($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCmsPage(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPage Clone of current object.
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
     * Declares an association between this object and a ChildSpyCmsTemplate object.
     *
     * @param ChildSpyCmsTemplate $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCmsTemplate(ChildSpyCmsTemplate $v = null)
    {
        if ($v === null) {
            $this->setFkTemplate(NULL);
        } else {
            $this->setFkTemplate($v->getIdCmsTemplate());
        }

        $this->aCmsTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCmsTemplate object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsPage($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCmsTemplate object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCmsTemplate The associated ChildSpyCmsTemplate object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCmsTemplate(?ConnectionInterface $con = null)
    {
        if ($this->aCmsTemplate === null && ($this->fk_template != 0)) {
            $this->aCmsTemplate = ChildSpyCmsTemplateQuery::create()->findPk($this->fk_template, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCmsTemplate->addSpyCmsPages($this);
             */
        }

        return $this->aCmsTemplate;
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
        if ('SpyCmsVersion' === $relationName) {
            $this->initSpyCmsVersions();
            return;
        }
        if ('SpyCmsPageLocalizedAttributes' === $relationName) {
            $this->initSpyCmsPageLocalizedAttributess();
            return;
        }
        if ('SpyCmsGlossaryKeyMapping' === $relationName) {
            $this->initSpyCmsGlossaryKeyMappings();
            return;
        }
        if ('SpyCmsPageStore' === $relationName) {
            $this->initSpyCmsPageStores();
            return;
        }
        if ('SpyUrl' === $relationName) {
            $this->initSpyUrls();
            return;
        }
    }

    /**
     * Clears out the collSpyCmsVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsVersions()
     */
    public function clearSpyCmsVersions()
    {
        $this->collSpyCmsVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsVersions($v = true): void
    {
        $this->collSpyCmsVersionsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsVersions collection.
     *
     * By default this just sets the collSpyCmsVersions collection to an empty array (like clearcollSpyCmsVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsVersions = new $collectionClassName;
        $this->collSpyCmsVersions->setModel('\Orm\Zed\Cms\Persistence\SpyCmsVersion');
    }

    /**
     * Gets an array of ChildSpyCmsVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsPage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsVersion[] List of ChildSpyCmsVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsVersion> List of ChildSpyCmsVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsVersionsPartial && !$this->isNew();
        if (null === $this->collSpyCmsVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsVersions) {
                    $this->initSpyCmsVersions();
                } else {
                    $collectionClassName = SpyCmsVersionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsVersions = new $collectionClassName;
                    $collSpyCmsVersions->setModel('\Orm\Zed\Cms\Persistence\SpyCmsVersion');

                    return $collSpyCmsVersions;
                }
            } else {
                $collSpyCmsVersions = ChildSpyCmsVersionQuery::create(null, $criteria)
                    ->filterBySpyCmsPage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsVersionsPartial && count($collSpyCmsVersions)) {
                        $this->initSpyCmsVersions(false);

                        foreach ($collSpyCmsVersions as $obj) {
                            if (false == $this->collSpyCmsVersions->contains($obj)) {
                                $this->collSpyCmsVersions->append($obj);
                            }
                        }

                        $this->collSpyCmsVersionsPartial = true;
                    }

                    return $collSpyCmsVersions;
                }

                if ($partial && $this->collSpyCmsVersions) {
                    foreach ($this->collSpyCmsVersions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsVersions[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsVersions = $collSpyCmsVersions;
                $this->collSpyCmsVersionsPartial = false;
            }
        }

        return $this->collSpyCmsVersions;
    }

    /**
     * Sets a collection of ChildSpyCmsVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsVersions(Collection $spyCmsVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsVersion[] $spyCmsVersionsToDelete */
        $spyCmsVersionsToDelete = $this->getSpyCmsVersions(new Criteria(), $con)->diff($spyCmsVersions);


        $this->spyCmsVersionsScheduledForDeletion = $spyCmsVersionsToDelete;

        foreach ($spyCmsVersionsToDelete as $spyCmsVersionRemoved) {
            $spyCmsVersionRemoved->setSpyCmsPage(null);
        }

        $this->collSpyCmsVersions = null;
        foreach ($spyCmsVersions as $spyCmsVersion) {
            $this->addSpyCmsVersion($spyCmsVersion);
        }

        $this->collSpyCmsVersions = $spyCmsVersions;
        $this->collSpyCmsVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsVersionsPartial && !$this->isNew();
        if (null === $this->collSpyCmsVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsVersions());
            }

            $query = ChildSpyCmsVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCmsPage($this)
                ->count($con);
        }

        return count($this->collSpyCmsVersions);
    }

    /**
     * Method called to associate a ChildSpyCmsVersion object to this object
     * through the ChildSpyCmsVersion foreign key attribute.
     *
     * @param ChildSpyCmsVersion $l ChildSpyCmsVersion
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsVersion(ChildSpyCmsVersion $l)
    {
        if ($this->collSpyCmsVersions === null) {
            $this->initSpyCmsVersions();
            $this->collSpyCmsVersionsPartial = true;
        }

        if (!$this->collSpyCmsVersions->contains($l)) {
            $this->doAddSpyCmsVersion($l);

            if ($this->spyCmsVersionsScheduledForDeletion and $this->spyCmsVersionsScheduledForDeletion->contains($l)) {
                $this->spyCmsVersionsScheduledForDeletion->remove($this->spyCmsVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsVersion $spyCmsVersion The ChildSpyCmsVersion object to add.
     */
    protected function doAddSpyCmsVersion(ChildSpyCmsVersion $spyCmsVersion): void
    {
        $this->collSpyCmsVersions[]= $spyCmsVersion;
        $spyCmsVersion->setSpyCmsPage($this);
    }

    /**
     * @param ChildSpyCmsVersion $spyCmsVersion The ChildSpyCmsVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsVersion(ChildSpyCmsVersion $spyCmsVersion)
    {
        if ($this->getSpyCmsVersions()->contains($spyCmsVersion)) {
            $pos = $this->collSpyCmsVersions->search($spyCmsVersion);
            $this->collSpyCmsVersions->remove($pos);
            if (null === $this->spyCmsVersionsScheduledForDeletion) {
                $this->spyCmsVersionsScheduledForDeletion = clone $this->collSpyCmsVersions;
                $this->spyCmsVersionsScheduledForDeletion->clear();
            }
            $this->spyCmsVersionsScheduledForDeletion[]= clone $spyCmsVersion;
            $spyCmsVersion->setSpyCmsPage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyCmsVersions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsVersion[] List of ChildSpyCmsVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsVersion}> List of ChildSpyCmsVersion objects
     */
    public function getSpyCmsVersionsJoinSpyUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsVersionQuery::create(null, $criteria);
        $query->joinWith('SpyUser', $joinBehavior);

        return $this->getSpyCmsVersions($query, $con);
    }

    /**
     * Clears out the collSpyCmsPageLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsPageLocalizedAttributess()
     */
    public function clearSpyCmsPageLocalizedAttributess()
    {
        $this->collSpyCmsPageLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsPageLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsPageLocalizedAttributess($v = true): void
    {
        $this->collSpyCmsPageLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyCmsPageLocalizedAttributess collection.
     *
     * By default this just sets the collSpyCmsPageLocalizedAttributess collection to an empty array (like clearcollSpyCmsPageLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsPageLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsPageLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsPageLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsPageLocalizedAttributess = new $collectionClassName;
        $this->collSpyCmsPageLocalizedAttributess->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes');
    }

    /**
     * Gets an array of ChildSpyCmsPageLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsPage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsPageLocalizedAttributes[] List of ChildSpyCmsPageLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsPageLocalizedAttributes> List of ChildSpyCmsPageLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsPageLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsPageLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsPageLocalizedAttributess) {
                    $this->initSpyCmsPageLocalizedAttributess();
                } else {
                    $collectionClassName = SpyCmsPageLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsPageLocalizedAttributess = new $collectionClassName;
                    $collSpyCmsPageLocalizedAttributess->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes');

                    return $collSpyCmsPageLocalizedAttributess;
                }
            } else {
                $collSpyCmsPageLocalizedAttributess = ChildSpyCmsPageLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyCmsPage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsPageLocalizedAttributessPartial && count($collSpyCmsPageLocalizedAttributess)) {
                        $this->initSpyCmsPageLocalizedAttributess(false);

                        foreach ($collSpyCmsPageLocalizedAttributess as $obj) {
                            if (false == $this->collSpyCmsPageLocalizedAttributess->contains($obj)) {
                                $this->collSpyCmsPageLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyCmsPageLocalizedAttributessPartial = true;
                    }

                    return $collSpyCmsPageLocalizedAttributess;
                }

                if ($partial && $this->collSpyCmsPageLocalizedAttributess) {
                    foreach ($this->collSpyCmsPageLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsPageLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsPageLocalizedAttributess = $collSpyCmsPageLocalizedAttributess;
                $this->collSpyCmsPageLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyCmsPageLocalizedAttributess;
    }

    /**
     * Sets a collection of ChildSpyCmsPageLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsPageLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsPageLocalizedAttributess(Collection $spyCmsPageLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsPageLocalizedAttributes[] $spyCmsPageLocalizedAttributessToDelete */
        $spyCmsPageLocalizedAttributessToDelete = $this->getSpyCmsPageLocalizedAttributess(new Criteria(), $con)->diff($spyCmsPageLocalizedAttributess);


        $this->spyCmsPageLocalizedAttributessScheduledForDeletion = $spyCmsPageLocalizedAttributessToDelete;

        foreach ($spyCmsPageLocalizedAttributessToDelete as $spyCmsPageLocalizedAttributesRemoved) {
            $spyCmsPageLocalizedAttributesRemoved->setSpyCmsPage(null);
        }

        $this->collSpyCmsPageLocalizedAttributess = null;
        foreach ($spyCmsPageLocalizedAttributess as $spyCmsPageLocalizedAttributes) {
            $this->addSpyCmsPageLocalizedAttributes($spyCmsPageLocalizedAttributes);
        }

        $this->collSpyCmsPageLocalizedAttributess = $spyCmsPageLocalizedAttributess;
        $this->collSpyCmsPageLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsPageLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsPageLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsPageLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsPageLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsPageLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsPageLocalizedAttributess());
            }

            $query = ChildSpyCmsPageLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCmsPage($this)
                ->count($con);
        }

        return count($this->collSpyCmsPageLocalizedAttributess);
    }

    /**
     * Method called to associate a ChildSpyCmsPageLocalizedAttributes object to this object
     * through the ChildSpyCmsPageLocalizedAttributes foreign key attribute.
     *
     * @param ChildSpyCmsPageLocalizedAttributes $l ChildSpyCmsPageLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsPageLocalizedAttributes(ChildSpyCmsPageLocalizedAttributes $l)
    {
        if ($this->collSpyCmsPageLocalizedAttributess === null) {
            $this->initSpyCmsPageLocalizedAttributess();
            $this->collSpyCmsPageLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyCmsPageLocalizedAttributess->contains($l)) {
            $this->doAddSpyCmsPageLocalizedAttributes($l);

            if ($this->spyCmsPageLocalizedAttributessScheduledForDeletion and $this->spyCmsPageLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion->remove($this->spyCmsPageLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes The ChildSpyCmsPageLocalizedAttributes object to add.
     */
    protected function doAddSpyCmsPageLocalizedAttributes(ChildSpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes): void
    {
        $this->collSpyCmsPageLocalizedAttributess[]= $spyCmsPageLocalizedAttributes;
        $spyCmsPageLocalizedAttributes->setSpyCmsPage($this);
    }

    /**
     * @param ChildSpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes The ChildSpyCmsPageLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsPageLocalizedAttributes(ChildSpyCmsPageLocalizedAttributes $spyCmsPageLocalizedAttributes)
    {
        if ($this->getSpyCmsPageLocalizedAttributess()->contains($spyCmsPageLocalizedAttributes)) {
            $pos = $this->collSpyCmsPageLocalizedAttributess->search($spyCmsPageLocalizedAttributes);
            $this->collSpyCmsPageLocalizedAttributess->remove($pos);
            if (null === $this->spyCmsPageLocalizedAttributessScheduledForDeletion) {
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion = clone $this->collSpyCmsPageLocalizedAttributess;
                $this->spyCmsPageLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyCmsPageLocalizedAttributessScheduledForDeletion[]= clone $spyCmsPageLocalizedAttributes;
            $spyCmsPageLocalizedAttributes->setSpyCmsPage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyCmsPageLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsPageLocalizedAttributes[] List of ChildSpyCmsPageLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsPageLocalizedAttributes}> List of ChildSpyCmsPageLocalizedAttributes objects
     */
    public function getSpyCmsPageLocalizedAttributessJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsPageLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getSpyCmsPageLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyCmsGlossaryKeyMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsGlossaryKeyMappings()
     */
    public function clearSpyCmsGlossaryKeyMappings()
    {
        $this->collSpyCmsGlossaryKeyMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsGlossaryKeyMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsGlossaryKeyMappings($v = true): void
    {
        $this->collSpyCmsGlossaryKeyMappingsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsGlossaryKeyMappings collection.
     *
     * By default this just sets the collSpyCmsGlossaryKeyMappings collection to an empty array (like clearcollSpyCmsGlossaryKeyMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsGlossaryKeyMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsGlossaryKeyMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsGlossaryKeyMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsGlossaryKeyMappings = new $collectionClassName;
        $this->collSpyCmsGlossaryKeyMappings->setModel('\Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMapping');
    }

    /**
     * Gets an array of ChildSpyCmsGlossaryKeyMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsPage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsGlossaryKeyMapping[] List of ChildSpyCmsGlossaryKeyMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsGlossaryKeyMapping> List of ChildSpyCmsGlossaryKeyMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsGlossaryKeyMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsGlossaryKeyMappingsPartial && !$this->isNew();
        if (null === $this->collSpyCmsGlossaryKeyMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsGlossaryKeyMappings) {
                    $this->initSpyCmsGlossaryKeyMappings();
                } else {
                    $collectionClassName = SpyCmsGlossaryKeyMappingTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsGlossaryKeyMappings = new $collectionClassName;
                    $collSpyCmsGlossaryKeyMappings->setModel('\Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMapping');

                    return $collSpyCmsGlossaryKeyMappings;
                }
            } else {
                $collSpyCmsGlossaryKeyMappings = ChildSpyCmsGlossaryKeyMappingQuery::create(null, $criteria)
                    ->filterByCmsPage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsGlossaryKeyMappingsPartial && count($collSpyCmsGlossaryKeyMappings)) {
                        $this->initSpyCmsGlossaryKeyMappings(false);

                        foreach ($collSpyCmsGlossaryKeyMappings as $obj) {
                            if (false == $this->collSpyCmsGlossaryKeyMappings->contains($obj)) {
                                $this->collSpyCmsGlossaryKeyMappings->append($obj);
                            }
                        }

                        $this->collSpyCmsGlossaryKeyMappingsPartial = true;
                    }

                    return $collSpyCmsGlossaryKeyMappings;
                }

                if ($partial && $this->collSpyCmsGlossaryKeyMappings) {
                    foreach ($this->collSpyCmsGlossaryKeyMappings as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsGlossaryKeyMappings[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsGlossaryKeyMappings = $collSpyCmsGlossaryKeyMappings;
                $this->collSpyCmsGlossaryKeyMappingsPartial = false;
            }
        }

        return $this->collSpyCmsGlossaryKeyMappings;
    }

    /**
     * Sets a collection of ChildSpyCmsGlossaryKeyMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsGlossaryKeyMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsGlossaryKeyMappings(Collection $spyCmsGlossaryKeyMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsGlossaryKeyMapping[] $spyCmsGlossaryKeyMappingsToDelete */
        $spyCmsGlossaryKeyMappingsToDelete = $this->getSpyCmsGlossaryKeyMappings(new Criteria(), $con)->diff($spyCmsGlossaryKeyMappings);


        $this->spyCmsGlossaryKeyMappingsScheduledForDeletion = $spyCmsGlossaryKeyMappingsToDelete;

        foreach ($spyCmsGlossaryKeyMappingsToDelete as $spyCmsGlossaryKeyMappingRemoved) {
            $spyCmsGlossaryKeyMappingRemoved->setCmsPage(null);
        }

        $this->collSpyCmsGlossaryKeyMappings = null;
        foreach ($spyCmsGlossaryKeyMappings as $spyCmsGlossaryKeyMapping) {
            $this->addSpyCmsGlossaryKeyMapping($spyCmsGlossaryKeyMapping);
        }

        $this->collSpyCmsGlossaryKeyMappings = $spyCmsGlossaryKeyMappings;
        $this->collSpyCmsGlossaryKeyMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsGlossaryKeyMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsGlossaryKeyMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsGlossaryKeyMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsGlossaryKeyMappingsPartial && !$this->isNew();
        if (null === $this->collSpyCmsGlossaryKeyMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsGlossaryKeyMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsGlossaryKeyMappings());
            }

            $query = ChildSpyCmsGlossaryKeyMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsPage($this)
                ->count($con);
        }

        return count($this->collSpyCmsGlossaryKeyMappings);
    }

    /**
     * Method called to associate a ChildSpyCmsGlossaryKeyMapping object to this object
     * through the ChildSpyCmsGlossaryKeyMapping foreign key attribute.
     *
     * @param ChildSpyCmsGlossaryKeyMapping $l ChildSpyCmsGlossaryKeyMapping
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsGlossaryKeyMapping(ChildSpyCmsGlossaryKeyMapping $l)
    {
        if ($this->collSpyCmsGlossaryKeyMappings === null) {
            $this->initSpyCmsGlossaryKeyMappings();
            $this->collSpyCmsGlossaryKeyMappingsPartial = true;
        }

        if (!$this->collSpyCmsGlossaryKeyMappings->contains($l)) {
            $this->doAddSpyCmsGlossaryKeyMapping($l);

            if ($this->spyCmsGlossaryKeyMappingsScheduledForDeletion and $this->spyCmsGlossaryKeyMappingsScheduledForDeletion->contains($l)) {
                $this->spyCmsGlossaryKeyMappingsScheduledForDeletion->remove($this->spyCmsGlossaryKeyMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsGlossaryKeyMapping $spyCmsGlossaryKeyMapping The ChildSpyCmsGlossaryKeyMapping object to add.
     */
    protected function doAddSpyCmsGlossaryKeyMapping(ChildSpyCmsGlossaryKeyMapping $spyCmsGlossaryKeyMapping): void
    {
        $this->collSpyCmsGlossaryKeyMappings[]= $spyCmsGlossaryKeyMapping;
        $spyCmsGlossaryKeyMapping->setCmsPage($this);
    }

    /**
     * @param ChildSpyCmsGlossaryKeyMapping $spyCmsGlossaryKeyMapping The ChildSpyCmsGlossaryKeyMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsGlossaryKeyMapping(ChildSpyCmsGlossaryKeyMapping $spyCmsGlossaryKeyMapping)
    {
        if ($this->getSpyCmsGlossaryKeyMappings()->contains($spyCmsGlossaryKeyMapping)) {
            $pos = $this->collSpyCmsGlossaryKeyMappings->search($spyCmsGlossaryKeyMapping);
            $this->collSpyCmsGlossaryKeyMappings->remove($pos);
            if (null === $this->spyCmsGlossaryKeyMappingsScheduledForDeletion) {
                $this->spyCmsGlossaryKeyMappingsScheduledForDeletion = clone $this->collSpyCmsGlossaryKeyMappings;
                $this->spyCmsGlossaryKeyMappingsScheduledForDeletion->clear();
            }
            $this->spyCmsGlossaryKeyMappingsScheduledForDeletion[]= clone $spyCmsGlossaryKeyMapping;
            $spyCmsGlossaryKeyMapping->setCmsPage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyCmsGlossaryKeyMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsGlossaryKeyMapping[] List of ChildSpyCmsGlossaryKeyMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsGlossaryKeyMapping}> List of ChildSpyCmsGlossaryKeyMapping objects
     */
    public function getSpyCmsGlossaryKeyMappingsJoinGlossaryKey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsGlossaryKeyMappingQuery::create(null, $criteria);
        $query->joinWith('GlossaryKey', $joinBehavior);

        return $this->getSpyCmsGlossaryKeyMappings($query, $con);
    }

    /**
     * Clears out the collSpyCmsPageStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsPageStores()
     */
    public function clearSpyCmsPageStores()
    {
        $this->collSpyCmsPageStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsPageStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsPageStores($v = true): void
    {
        $this->collSpyCmsPageStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCmsPageStores collection.
     *
     * By default this just sets the collSpyCmsPageStores collection to an empty array (like clearcollSpyCmsPageStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsPageStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsPageStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsPageStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsPageStores = new $collectionClassName;
        $this->collSpyCmsPageStores->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageStore');
    }

    /**
     * Gets an array of ChildSpyCmsPageStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsPage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCmsPageStore[] List of ChildSpyCmsPageStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsPageStore> List of ChildSpyCmsPageStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsPageStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsPageStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsPageStores) {
                    $this->initSpyCmsPageStores();
                } else {
                    $collectionClassName = SpyCmsPageStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsPageStores = new $collectionClassName;
                    $collSpyCmsPageStores->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageStore');

                    return $collSpyCmsPageStores;
                }
            } else {
                $collSpyCmsPageStores = ChildSpyCmsPageStoreQuery::create(null, $criteria)
                    ->filterBySpyCmsPage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsPageStoresPartial && count($collSpyCmsPageStores)) {
                        $this->initSpyCmsPageStores(false);

                        foreach ($collSpyCmsPageStores as $obj) {
                            if (false == $this->collSpyCmsPageStores->contains($obj)) {
                                $this->collSpyCmsPageStores->append($obj);
                            }
                        }

                        $this->collSpyCmsPageStoresPartial = true;
                    }

                    return $collSpyCmsPageStores;
                }

                if ($partial && $this->collSpyCmsPageStores) {
                    foreach ($this->collSpyCmsPageStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsPageStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsPageStores = $collSpyCmsPageStores;
                $this->collSpyCmsPageStoresPartial = false;
            }
        }

        return $this->collSpyCmsPageStores;
    }

    /**
     * Sets a collection of ChildSpyCmsPageStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsPageStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsPageStores(Collection $spyCmsPageStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCmsPageStore[] $spyCmsPageStoresToDelete */
        $spyCmsPageStoresToDelete = $this->getSpyCmsPageStores(new Criteria(), $con)->diff($spyCmsPageStores);


        $this->spyCmsPageStoresScheduledForDeletion = $spyCmsPageStoresToDelete;

        foreach ($spyCmsPageStoresToDelete as $spyCmsPageStoreRemoved) {
            $spyCmsPageStoreRemoved->setSpyCmsPage(null);
        }

        $this->collSpyCmsPageStores = null;
        foreach ($spyCmsPageStores as $spyCmsPageStore) {
            $this->addSpyCmsPageStore($spyCmsPageStore);
        }

        $this->collSpyCmsPageStores = $spyCmsPageStores;
        $this->collSpyCmsPageStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCmsPageStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCmsPageStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsPageStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsPageStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsPageStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsPageStores());
            }

            $query = ChildSpyCmsPageStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCmsPage($this)
                ->count($con);
        }

        return count($this->collSpyCmsPageStores);
    }

    /**
     * Method called to associate a ChildSpyCmsPageStore object to this object
     * through the ChildSpyCmsPageStore foreign key attribute.
     *
     * @param ChildSpyCmsPageStore $l ChildSpyCmsPageStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsPageStore(ChildSpyCmsPageStore $l)
    {
        if ($this->collSpyCmsPageStores === null) {
            $this->initSpyCmsPageStores();
            $this->collSpyCmsPageStoresPartial = true;
        }

        if (!$this->collSpyCmsPageStores->contains($l)) {
            $this->doAddSpyCmsPageStore($l);

            if ($this->spyCmsPageStoresScheduledForDeletion and $this->spyCmsPageStoresScheduledForDeletion->contains($l)) {
                $this->spyCmsPageStoresScheduledForDeletion->remove($this->spyCmsPageStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCmsPageStore $spyCmsPageStore The ChildSpyCmsPageStore object to add.
     */
    protected function doAddSpyCmsPageStore(ChildSpyCmsPageStore $spyCmsPageStore): void
    {
        $this->collSpyCmsPageStores[]= $spyCmsPageStore;
        $spyCmsPageStore->setSpyCmsPage($this);
    }

    /**
     * @param ChildSpyCmsPageStore $spyCmsPageStore The ChildSpyCmsPageStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsPageStore(ChildSpyCmsPageStore $spyCmsPageStore)
    {
        if ($this->getSpyCmsPageStores()->contains($spyCmsPageStore)) {
            $pos = $this->collSpyCmsPageStores->search($spyCmsPageStore);
            $this->collSpyCmsPageStores->remove($pos);
            if (null === $this->spyCmsPageStoresScheduledForDeletion) {
                $this->spyCmsPageStoresScheduledForDeletion = clone $this->collSpyCmsPageStores;
                $this->spyCmsPageStoresScheduledForDeletion->clear();
            }
            $this->spyCmsPageStoresScheduledForDeletion[]= clone $spyCmsPageStore;
            $spyCmsPageStore->setSpyCmsPage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyCmsPageStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCmsPageStore[] List of ChildSpyCmsPageStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCmsPageStore}> List of ChildSpyCmsPageStore objects
     */
    public function getSpyCmsPageStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCmsPageStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyCmsPageStores($query, $con);
    }

    /**
     * Clears out the collSpyUrls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyUrls()
     */
    public function clearSpyUrls()
    {
        $this->collSpyUrls = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyUrls collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyUrls($v = true): void
    {
        $this->collSpyUrlsPartial = $v;
    }

    /**
     * Initializes the collSpyUrls collection.
     *
     * By default this just sets the collSpyUrls collection to an empty array (like clearcollSpyUrls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyUrls(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyUrls && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUrls = new $collectionClassName;
        $this->collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');
    }

    /**
     * Gets an array of SpyUrl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCmsPage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl> List of SpyUrl objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUrls(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUrls) {
                    $this->initSpyUrls();
                } else {
                    $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

                    $collSpyUrls = new $collectionClassName;
                    $collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');

                    return $collSpyUrls;
                }
            } else {
                $collSpyUrls = SpyUrlQuery::create(null, $criteria)
                    ->filterByCmsPage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyUrlsPartial && count($collSpyUrls)) {
                        $this->initSpyUrls(false);

                        foreach ($collSpyUrls as $obj) {
                            if (false == $this->collSpyUrls->contains($obj)) {
                                $this->collSpyUrls->append($obj);
                            }
                        }

                        $this->collSpyUrlsPartial = true;
                    }

                    return $collSpyUrls;
                }

                if ($partial && $this->collSpyUrls) {
                    foreach ($this->collSpyUrls as $obj) {
                        if ($obj->isNew()) {
                            $collSpyUrls[] = $obj;
                        }
                    }
                }

                $this->collSpyUrls = $collSpyUrls;
                $this->collSpyUrlsPartial = false;
            }
        }

        return $this->collSpyUrls;
    }

    /**
     * Sets a collection of SpyUrl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUrls A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUrls(Collection $spyUrls, ?ConnectionInterface $con = null)
    {
        /** @var SpyUrl[] $spyUrlsToDelete */
        $spyUrlsToDelete = $this->getSpyUrls(new Criteria(), $con)->diff($spyUrls);


        $this->spyUrlsScheduledForDeletion = $spyUrlsToDelete;

        foreach ($spyUrlsToDelete as $spyUrlRemoved) {
            $spyUrlRemoved->setCmsPage(null);
        }

        $this->collSpyUrls = null;
        foreach ($spyUrls as $spyUrl) {
            $this->addSpyUrl($spyUrl);
        }

        $this->collSpyUrls = $spyUrls;
        $this->collSpyUrlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyUrl objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyUrl objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyUrls(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUrls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyUrls());
            }

            $query = SpyUrlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCmsPage($this)
                ->count($con);
        }

        return count($this->collSpyUrls);
    }

    /**
     * Method called to associate a SpyUrl object to this object
     * through the SpyUrl foreign key attribute.
     *
     * @param SpyUrl $l SpyUrl
     * @return $this The current object (for fluent API support)
     */
    public function addSpyUrl(SpyUrl $l)
    {
        if ($this->collSpyUrls === null) {
            $this->initSpyUrls();
            $this->collSpyUrlsPartial = true;
        }

        if (!$this->collSpyUrls->contains($l)) {
            $this->doAddSpyUrl($l);

            if ($this->spyUrlsScheduledForDeletion and $this->spyUrlsScheduledForDeletion->contains($l)) {
                $this->spyUrlsScheduledForDeletion->remove($this->spyUrlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to add.
     */
    protected function doAddSpyUrl(SpyUrl $spyUrl): void
    {
        $this->collSpyUrls[]= $spyUrl;
        $spyUrl->setCmsPage($this);
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyUrl(SpyUrl $spyUrl)
    {
        if ($this->getSpyUrls()->contains($spyUrl)) {
            $pos = $this->collSpyUrls->search($spyUrl);
            $this->collSpyUrls->remove($pos);
            if (null === $this->spyUrlsScheduledForDeletion) {
                $this->spyUrlsScheduledForDeletion = clone $this->collSpyUrls;
                $this->spyUrlsScheduledForDeletion->clear();
            }
            $this->spyUrlsScheduledForDeletion[]= $spyUrl;
            $spyUrl->setCmsPage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyCategoryNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyCategoryNode', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCmsPage is new, it will return
     * an empty collection; or if this SpyCmsPage has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCmsPage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyUrlRedirect(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyUrlRedirect', $joinBehavior);

        return $this->getSpyUrls($query, $con);
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
        if (null !== $this->aCmsTemplate) {
            $this->aCmsTemplate->removeSpyCmsPage($this);
        }
        $this->id_cms_page = null;
        $this->fk_template = null;
        $this->is_active = null;
        $this->is_searchable = null;
        $this->page_key = null;
        $this->uuid = null;
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
            if ($this->collSpyCmsVersions) {
                foreach ($this->collSpyCmsVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsPageLocalizedAttributess) {
                foreach ($this->collSpyCmsPageLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsGlossaryKeyMappings) {
                foreach ($this->collSpyCmsGlossaryKeyMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsPageStores) {
                foreach ($this->collSpyCmsPageStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyUrls) {
                foreach ($this->collSpyUrls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCmsVersions = null;
        $this->collSpyCmsPageLocalizedAttributess = null;
        $this->collSpyCmsGlossaryKeyMappings = null;
        $this->collSpyCmsPageStores = null;
        $this->collSpyUrls = null;
        $this->aCmsTemplate = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCmsPageTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_cms_page' . '.' . $this->getIdCmsPage();
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
            $this->_eventName = 'Entity.spy_cms_page.create';
        } else {
            $this->_eventName = 'Entity.spy_cms_page.update';
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

        if ($this->_eventName !== 'Entity.spy_cms_page.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_cms_page',
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
            'name' => 'spy_cms_page',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_cms_page.delete',
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
            $field = str_replace('spy_cms_page.', '', $modifiedColumn);
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
            $field = str_replace('spy_cms_page.', '', $additionalValueColumnName);
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
        $columnType = SpyCmsPageTableMap::getTableMap()->getColumn($column)->getType();
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
