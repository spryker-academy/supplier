<?php

namespace Orm\Zed\ProductList\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Category\Persistence\SpyCategory;
use Orm\Zed\Category\Persistence\SpyCategoryQuery;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery;
use Orm\Zed\ConfigurableBundle\Persistence\Base\SpyConfigurableBundleTemplateSlot as BaseSpyConfigurableBundleTemplateSlot;
use Orm\Zed\ConfigurableBundle\Persistence\Map\SpyConfigurableBundleTemplateSlotTableMap;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery;
use Orm\Zed\ProductList\Persistence\SpyProductList as ChildSpyProductList;
use Orm\Zed\ProductList\Persistence\SpyProductListCategory as ChildSpyProductListCategory;
use Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery as ChildSpyProductListCategoryQuery;
use Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete as ChildSpyProductListProductConcrete;
use Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery as ChildSpyProductListProductConcreteQuery;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery as ChildSpyProductListQuery;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCategoryTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListProductConcreteTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspModelToProductList as BaseSpySspModelToProductList;
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
 * Base class that represents a row from the 'spy_product_list' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductList.Persistence.Base
 */
abstract class SpyProductList implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductList\\Persistence\\Map\\SpyProductListTableMap';


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
     * The value for the id_product_list field.
     *
     * @var        int
     */
    protected $id_product_list;

    /**
     * The value for the fk_merchant_relationship field.
     *
     * @var        int|null
     */
    protected $fk_merchant_relationship;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the title field.
     * The title of an entity or page.
     * @var        string|null
     */
    protected $title;

    /**
     * The value for the type field.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @var        int
     */
    protected $type;

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
     * @var        SpyMerchantRelationship
     */
    protected $aSpyMerchantRelationship;

    /**
     * @var        ObjectCollection|SpyConfigurableBundleTemplateSlot[] Collection to store aggregation of SpyConfigurableBundleTemplateSlot objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyConfigurableBundleTemplateSlot> Collection to store aggregation of SpyConfigurableBundleTemplateSlot objects.
     */
    protected $collSpyConfigurableBundleTemplateSlots;
    protected $collSpyConfigurableBundleTemplateSlotsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductListProductConcrete[] Collection to store aggregation of ChildSpyProductListProductConcrete objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductListProductConcrete> Collection to store aggregation of ChildSpyProductListProductConcrete objects.
     */
    protected $collSpyProductListProductConcretes;
    protected $collSpyProductListProductConcretesPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductListCategory[] Collection to store aggregation of ChildSpyProductListCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductListCategory> Collection to store aggregation of ChildSpyProductListCategory objects.
     */
    protected $collSpyProductListCategories;
    protected $collSpyProductListCategoriesPartial;

    /**
     * @var        ObjectCollection|SpySspModelToProductList[] Collection to store aggregation of SpySspModelToProductList objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspModelToProductList> Collection to store aggregation of SpySspModelToProductList objects.
     */
    protected $collSpySspModelToProductLists;
    protected $collSpySspModelToProductListsPartial;

    /**
     * @var        ObjectCollection|SpyProduct[] Cross Collection to store aggregation of SpyProduct objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProduct> Cross Collection to store aggregation of SpyProduct objects.
     */
    protected $collSpyProducts;

    /**
     * @var bool
     */
    protected $collSpyProductsPartial;

    /**
     * @var        ObjectCollection|SpyCategory[] Cross Collection to store aggregation of SpyCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCategory> Cross Collection to store aggregation of SpyCategory objects.
     */
    protected $collSpyCategories;

    /**
     * @var bool
     */
    protected $collSpyCategoriesPartial;

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
        'spy_product_list.fk_merchant_relationship' => 'fk_merchant_relationship',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProduct[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProduct>
     */
    protected $spyProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCategory>
     */
    protected $spyCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyConfigurableBundleTemplateSlot[]
     * @phpstan-var ObjectCollection&\Traversable<SpyConfigurableBundleTemplateSlot>
     */
    protected $spyConfigurableBundleTemplateSlotsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductListProductConcrete[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductListProductConcrete>
     */
    protected $spyProductListProductConcretesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductListCategory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductListCategory>
     */
    protected $spyProductListCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspModelToProductList[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspModelToProductList>
     */
    protected $spySspModelToProductListsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ProductList\Persistence\Base\SpyProductList object.
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
     * Compares this with another <code>SpyProductList</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductList</code>, delegates to
     * <code>equals(SpyProductList)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_list] column value.
     *
     * @return int
     */
    public function getIdProductList()
    {
        return $this->id_product_list;
    }

    /**
     * Get the [fk_merchant_relationship] column value.
     *
     * @return int|null
     */
    public function getFkMerchantRelationship()
    {
        return $this->fk_merchant_relationship;
    }

    /**
     * Get the [key] column value.
     * A unique key used to identify an entity or a piece of data.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the [title] column value.
     * The title of an entity or page.
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [type] column value.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getType()
    {
        if (null === $this->type) {
            return null;
        }
        $valueSet = SpyProductListTableMap::getValueSet(SpyProductListTableMap::COL_TYPE);
        if (!isset($valueSet[$this->type])) {
            throw new PropelException('Unknown stored enum key: ' . $this->type);
        }

        return $valueSet[$this->type];
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
     * Set the value of [id_product_list] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductList($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_list !== $v) {
            $this->id_product_list = $v;
            $this->modifiedColumns[SpyProductListTableMap::COL_ID_PRODUCT_LIST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_merchant_relationship] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkMerchantRelationship($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_merchant_relationship !== $v) {
            $this->fk_merchant_relationship = $v;
            $this->modifiedColumns[SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP] = true;
        }

        if ($this->aSpyMerchantRelationship !== null && $this->aSpyMerchantRelationship->getIdMerchantRelationship() !== $v) {
            $this->aSpyMerchantRelationship = null;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * A unique key used to identify an entity or a piece of data.
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
            $this->modifiedColumns[SpyProductListTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [title] column.
     * The title of an entity or page.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[SpyProductListTableMap::COL_TITLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     * The type or category of an entity (e.g., 'allow', 'deny', 'page').
     * @param string $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setType($v)
    {
        if ($v !== null) {
            $valueSet = SpyProductListTableMap::getValueSet(SpyProductListTableMap::COL_TYPE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[SpyProductListTableMap::COL_TYPE] = true;
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
                $this->modifiedColumns[SpyProductListTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductListTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductListTableMap::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_list = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductListTableMap::translateFieldName('FkMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant_relationship = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductListTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductListTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductListTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductListTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductListTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SpyProductListTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList'), 0, $e);
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
        if ($this->aSpyMerchantRelationship !== null && $this->fk_merchant_relationship !== $this->aSpyMerchantRelationship->getIdMerchantRelationship()) {
            $this->aSpyMerchantRelationship = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductListQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyMerchantRelationship = null;
            $this->collSpyConfigurableBundleTemplateSlots = null;

            $this->collSpyProductListProductConcretes = null;

            $this->collSpyProductListCategories = null;

            $this->collSpySspModelToProductLists = null;

            $this->collSpyProducts = null;
            $this->collSpyCategories = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductList::setDeleted()
     * @see SpyProductList::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductListQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductListTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductListTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductListTableMap::COL_UPDATED_AT)) {
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

                SpyProductListTableMap::addInstanceToPool($this);
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

            if ($this->aSpyMerchantRelationship !== null) {
                if ($this->aSpyMerchantRelationship->isModified() || $this->aSpyMerchantRelationship->isNew()) {
                    $affectedRows += $this->aSpyMerchantRelationship->save($con);
                }
                $this->setSpyMerchantRelationship($this->aSpyMerchantRelationship);
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

            if ($this->spyProductsScheduledForDeletion !== null) {
                if (!$this->spyProductsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdProductList();
                        $entryPk[0] = $entry->getIdProduct();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyProductsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyProducts) {
                foreach ($this->collSpyProducts as $spyProduct) {
                    if (!$spyProduct->isDeleted() && ($spyProduct->isNew() || $spyProduct->isModified())) {
                        $spyProduct->save($con);
                    }
                }
            }


            if ($this->spyCategoriesScheduledForDeletion !== null) {
                if (!$this->spyCategoriesScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyCategoriesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdProductList();
                        $entryPk[0] = $entry->getIdCategory();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyCategoriesScheduledForDeletion = null;
                }

            }

            if ($this->collSpyCategories) {
                foreach ($this->collSpyCategories as $spyCategory) {
                    if (!$spyCategory->isDeleted() && ($spyCategory->isNew() || $spyCategory->isModified())) {
                        $spyCategory->save($con);
                    }
                }
            }


            if ($this->spyConfigurableBundleTemplateSlotsScheduledForDeletion !== null) {
                if (!$this->spyConfigurableBundleTemplateSlotsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyConfigurableBundleTemplateSlotsScheduledForDeletion as $spyConfigurableBundleTemplateSlot) {
                        // need to save related object because we set the relation to null
                        $spyConfigurableBundleTemplateSlot->save($con);
                    }
                    $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyConfigurableBundleTemplateSlots !== null) {
                foreach ($this->collSpyConfigurableBundleTemplateSlots as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductListProductConcretesScheduledForDeletion !== null) {
                if (!$this->spyProductListProductConcretesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery::create()
                        ->filterByPrimaryKeys($this->spyProductListProductConcretesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductListProductConcretesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductListProductConcretes !== null) {
                foreach ($this->collSpyProductListProductConcretes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductListCategoriesScheduledForDeletion !== null) {
                if (!$this->spyProductListCategoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery::create()
                        ->filterByPrimaryKeys($this->spyProductListCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductListCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductListCategories !== null) {
                foreach ($this->collSpyProductListCategories as $referrerFK) {
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

        $this->modifiedColumns[SpyProductListTableMap::COL_ID_PRODUCT_LIST] = true;
        if (null !== $this->id_product_list) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyProductListTableMap::COL_ID_PRODUCT_LIST . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductListTableMap::COL_ID_PRODUCT_LIST)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_list`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP)) {
            $modifiedColumns[':p' . $index++]  = '`fk_merchant_relationship`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_list` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_list`':
                        $stmt->bindValue($identifier, $this->id_product_list, PDO::PARAM_INT);

                        break;
                    case '`fk_merchant_relationship`':
                        $stmt->bindValue($identifier, $this->fk_merchant_relationship, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);

                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_product_list_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdProductList($pk);

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
        $pos = SpyProductListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductList();

            case 1:
                return $this->getFkMerchantRelationship();

            case 2:
                return $this->getKey();

            case 3:
                return $this->getTitle();

            case 4:
                return $this->getType();

            case 5:
                return $this->getCreatedAt();

            case 6:
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
        if (isset($alreadyDumpedObjects['SpyProductList'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductList'][$this->hashCode()] = true;
        $keys = SpyProductListTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductList(),
            $keys[1] => $this->getFkMerchantRelationship(),
            $keys[2] => $this->getKey(),
            $keys[3] => $this->getTitle(),
            $keys[4] => $this->getType(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
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
            if (null !== $this->aSpyMerchantRelationship) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationship';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relationship';
                        break;
                    default:
                        $key = 'SpyMerchantRelationship';
                }

                $result[$key] = $this->aSpyMerchantRelationship->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyConfigurableBundleTemplateSlots) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyConfigurableBundleTemplateSlots';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_configurable_bundle_template_slots';
                        break;
                    default:
                        $key = 'SpyConfigurableBundleTemplateSlots';
                }

                $result[$key] = $this->collSpyConfigurableBundleTemplateSlots->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductListProductConcretes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductListProductConcretes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_list_product_concretes';
                        break;
                    default:
                        $key = 'SpyProductListProductConcretes';
                }

                $result[$key] = $this->collSpyProductListProductConcretes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductListCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductListCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_list_categories';
                        break;
                    default:
                        $key = 'SpyProductListCategories';
                }

                $result[$key] = $this->collSpyProductListCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductList($value);
                break;
            case 1:
                $this->setFkMerchantRelationship($value);
                break;
            case 2:
                $this->setKey($value);
                break;
            case 3:
                $this->setTitle($value);
                break;
            case 4:
                $valueSet = SpyProductListTableMap::getValueSet(SpyProductListTableMap::COL_TYPE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setType($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
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
        $keys = SpyProductListTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductList($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkMerchantRelationship($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTitle($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setType($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdatedAt($arr[$keys[6]]);
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
        $criteria = new Criteria(SpyProductListTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductListTableMap::COL_ID_PRODUCT_LIST)) {
            $criteria->add(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $this->id_product_list);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP)) {
            $criteria->add(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $this->fk_merchant_relationship);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_KEY)) {
            $criteria->add(SpyProductListTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_TITLE)) {
            $criteria->add(SpyProductListTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_TYPE)) {
            $criteria->add(SpyProductListTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductListTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductListTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductListTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductListQuery::create();
        $criteria->add(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $this->id_product_list);

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
        $validPk = null !== $this->getIdProductList();

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
        return $this->getIdProductList();
    }

    /**
     * Generic method to set the primary key (id_product_list column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductList($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductList();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductList\Persistence\SpyProductList (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkMerchantRelationship($this->getFkMerchantRelationship());
        $copyObj->setKey($this->getKey());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setType($this->getType());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyConfigurableBundleTemplateSlots() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyConfigurableBundleTemplateSlot($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductListProductConcretes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductListProductConcrete($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductListCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductListCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspModelToProductLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspModelToProductList($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductList(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductList\Persistence\SpyProductList Clone of current object.
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
     * Declares an association between this object and a SpyMerchantRelationship object.
     *
     * @param SpyMerchantRelationship|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyMerchantRelationship(SpyMerchantRelationship $v = null)
    {
        if ($v === null) {
            $this->setFkMerchantRelationship(NULL);
        } else {
            $this->setFkMerchantRelationship($v->getIdMerchantRelationship());
        }

        $this->aSpyMerchantRelationship = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyMerchantRelationship object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductList($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyMerchantRelationship object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyMerchantRelationship|null The associated SpyMerchantRelationship object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationship(?ConnectionInterface $con = null)
    {
        if ($this->aSpyMerchantRelationship === null && ($this->fk_merchant_relationship != 0)) {
            $this->aSpyMerchantRelationship = SpyMerchantRelationshipQuery::create()->findPk($this->fk_merchant_relationship, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyMerchantRelationship->addSpyProductLists($this);
             */
        }

        return $this->aSpyMerchantRelationship;
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
        if ('SpyConfigurableBundleTemplateSlot' === $relationName) {
            $this->initSpyConfigurableBundleTemplateSlots();
            return;
        }
        if ('SpyProductListProductConcrete' === $relationName) {
            $this->initSpyProductListProductConcretes();
            return;
        }
        if ('SpyProductListCategory' === $relationName) {
            $this->initSpyProductListCategories();
            return;
        }
        if ('SpySspModelToProductList' === $relationName) {
            $this->initSpySspModelToProductLists();
            return;
        }
    }

    /**
     * Clears out the collSpyConfigurableBundleTemplateSlots collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyConfigurableBundleTemplateSlots()
     */
    public function clearSpyConfigurableBundleTemplateSlots()
    {
        $this->collSpyConfigurableBundleTemplateSlots = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyConfigurableBundleTemplateSlots collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyConfigurableBundleTemplateSlots($v = true): void
    {
        $this->collSpyConfigurableBundleTemplateSlotsPartial = $v;
    }

    /**
     * Initializes the collSpyConfigurableBundleTemplateSlots collection.
     *
     * By default this just sets the collSpyConfigurableBundleTemplateSlots collection to an empty array (like clearcollSpyConfigurableBundleTemplateSlots());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyConfigurableBundleTemplateSlots(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyConfigurableBundleTemplateSlots && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyConfigurableBundleTemplateSlotTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyConfigurableBundleTemplateSlots = new $collectionClassName;
        $this->collSpyConfigurableBundleTemplateSlots->setModel('\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot');
    }

    /**
     * Gets an array of SpyConfigurableBundleTemplateSlot objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyConfigurableBundleTemplateSlot[] List of SpyConfigurableBundleTemplateSlot objects
     * @phpstan-return ObjectCollection&\Traversable<SpyConfigurableBundleTemplateSlot> List of SpyConfigurableBundleTemplateSlot objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyConfigurableBundleTemplateSlots(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyConfigurableBundleTemplateSlotsPartial && !$this->isNew();
        if (null === $this->collSpyConfigurableBundleTemplateSlots || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyConfigurableBundleTemplateSlots) {
                    $this->initSpyConfigurableBundleTemplateSlots();
                } else {
                    $collectionClassName = SpyConfigurableBundleTemplateSlotTableMap::getTableMap()->getCollectionClassName();

                    $collSpyConfigurableBundleTemplateSlots = new $collectionClassName;
                    $collSpyConfigurableBundleTemplateSlots->setModel('\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot');

                    return $collSpyConfigurableBundleTemplateSlots;
                }
            } else {
                $collSpyConfigurableBundleTemplateSlots = SpyConfigurableBundleTemplateSlotQuery::create(null, $criteria)
                    ->filterBySpyProductList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyConfigurableBundleTemplateSlotsPartial && count($collSpyConfigurableBundleTemplateSlots)) {
                        $this->initSpyConfigurableBundleTemplateSlots(false);

                        foreach ($collSpyConfigurableBundleTemplateSlots as $obj) {
                            if (false == $this->collSpyConfigurableBundleTemplateSlots->contains($obj)) {
                                $this->collSpyConfigurableBundleTemplateSlots->append($obj);
                            }
                        }

                        $this->collSpyConfigurableBundleTemplateSlotsPartial = true;
                    }

                    return $collSpyConfigurableBundleTemplateSlots;
                }

                if ($partial && $this->collSpyConfigurableBundleTemplateSlots) {
                    foreach ($this->collSpyConfigurableBundleTemplateSlots as $obj) {
                        if ($obj->isNew()) {
                            $collSpyConfigurableBundleTemplateSlots[] = $obj;
                        }
                    }
                }

                $this->collSpyConfigurableBundleTemplateSlots = $collSpyConfigurableBundleTemplateSlots;
                $this->collSpyConfigurableBundleTemplateSlotsPartial = false;
            }
        }

        return $this->collSpyConfigurableBundleTemplateSlots;
    }

    /**
     * Sets a collection of SpyConfigurableBundleTemplateSlot objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyConfigurableBundleTemplateSlots A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyConfigurableBundleTemplateSlots(Collection $spyConfigurableBundleTemplateSlots, ?ConnectionInterface $con = null)
    {
        /** @var SpyConfigurableBundleTemplateSlot[] $spyConfigurableBundleTemplateSlotsToDelete */
        $spyConfigurableBundleTemplateSlotsToDelete = $this->getSpyConfigurableBundleTemplateSlots(new Criteria(), $con)->diff($spyConfigurableBundleTemplateSlots);


        $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion = $spyConfigurableBundleTemplateSlotsToDelete;

        foreach ($spyConfigurableBundleTemplateSlotsToDelete as $spyConfigurableBundleTemplateSlotRemoved) {
            $spyConfigurableBundleTemplateSlotRemoved->setSpyProductList(null);
        }

        $this->collSpyConfigurableBundleTemplateSlots = null;
        foreach ($spyConfigurableBundleTemplateSlots as $spyConfigurableBundleTemplateSlot) {
            $this->addSpyConfigurableBundleTemplateSlot($spyConfigurableBundleTemplateSlot);
        }

        $this->collSpyConfigurableBundleTemplateSlots = $spyConfigurableBundleTemplateSlots;
        $this->collSpyConfigurableBundleTemplateSlotsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyConfigurableBundleTemplateSlot objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyConfigurableBundleTemplateSlot objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyConfigurableBundleTemplateSlots(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyConfigurableBundleTemplateSlotsPartial && !$this->isNew();
        if (null === $this->collSpyConfigurableBundleTemplateSlots || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyConfigurableBundleTemplateSlots) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyConfigurableBundleTemplateSlots());
            }

            $query = SpyConfigurableBundleTemplateSlotQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductList($this)
                ->count($con);
        }

        return count($this->collSpyConfigurableBundleTemplateSlots);
    }

    /**
     * Method called to associate a SpyConfigurableBundleTemplateSlot object to this object
     * through the SpyConfigurableBundleTemplateSlot foreign key attribute.
     *
     * @param SpyConfigurableBundleTemplateSlot $l SpyConfigurableBundleTemplateSlot
     * @return $this The current object (for fluent API support)
     */
    public function addSpyConfigurableBundleTemplateSlot(SpyConfigurableBundleTemplateSlot $l)
    {
        if ($this->collSpyConfigurableBundleTemplateSlots === null) {
            $this->initSpyConfigurableBundleTemplateSlots();
            $this->collSpyConfigurableBundleTemplateSlotsPartial = true;
        }

        if (!$this->collSpyConfigurableBundleTemplateSlots->contains($l)) {
            $this->doAddSpyConfigurableBundleTemplateSlot($l);

            if ($this->spyConfigurableBundleTemplateSlotsScheduledForDeletion and $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion->contains($l)) {
                $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion->remove($this->spyConfigurableBundleTemplateSlotsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyConfigurableBundleTemplateSlot $spyConfigurableBundleTemplateSlot The SpyConfigurableBundleTemplateSlot object to add.
     */
    protected function doAddSpyConfigurableBundleTemplateSlot(SpyConfigurableBundleTemplateSlot $spyConfigurableBundleTemplateSlot): void
    {
        $this->collSpyConfigurableBundleTemplateSlots[]= $spyConfigurableBundleTemplateSlot;
        $spyConfigurableBundleTemplateSlot->setSpyProductList($this);
    }

    /**
     * @param SpyConfigurableBundleTemplateSlot $spyConfigurableBundleTemplateSlot The SpyConfigurableBundleTemplateSlot object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyConfigurableBundleTemplateSlot(SpyConfigurableBundleTemplateSlot $spyConfigurableBundleTemplateSlot)
    {
        if ($this->getSpyConfigurableBundleTemplateSlots()->contains($spyConfigurableBundleTemplateSlot)) {
            $pos = $this->collSpyConfigurableBundleTemplateSlots->search($spyConfigurableBundleTemplateSlot);
            $this->collSpyConfigurableBundleTemplateSlots->remove($pos);
            if (null === $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion) {
                $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion = clone $this->collSpyConfigurableBundleTemplateSlots;
                $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion->clear();
            }
            $this->spyConfigurableBundleTemplateSlotsScheduledForDeletion[]= $spyConfigurableBundleTemplateSlot;
            $spyConfigurableBundleTemplateSlot->setSpyProductList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductList is new, it will return
     * an empty collection; or if this SpyProductList has previously
     * been saved, it will retrieve related SpyConfigurableBundleTemplateSlots from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyConfigurableBundleTemplateSlot[] List of SpyConfigurableBundleTemplateSlot objects
     * @phpstan-return ObjectCollection&\Traversable<SpyConfigurableBundleTemplateSlot}> List of SpyConfigurableBundleTemplateSlot objects
     */
    public function getSpyConfigurableBundleTemplateSlotsJoinSpyConfigurableBundleTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyConfigurableBundleTemplateSlotQuery::create(null, $criteria);
        $query->joinWith('SpyConfigurableBundleTemplate', $joinBehavior);

        return $this->getSpyConfigurableBundleTemplateSlots($query, $con);
    }

    /**
     * Clears out the collSpyProductListProductConcretes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductListProductConcretes()
     */
    public function clearSpyProductListProductConcretes()
    {
        $this->collSpyProductListProductConcretes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductListProductConcretes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductListProductConcretes($v = true): void
    {
        $this->collSpyProductListProductConcretesPartial = $v;
    }

    /**
     * Initializes the collSpyProductListProductConcretes collection.
     *
     * By default this just sets the collSpyProductListProductConcretes collection to an empty array (like clearcollSpyProductListProductConcretes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductListProductConcretes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductListProductConcretes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductListProductConcreteTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductListProductConcretes = new $collectionClassName;
        $this->collSpyProductListProductConcretes->setModel('\Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete');
    }

    /**
     * Gets an array of ChildSpyProductListProductConcrete objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductListProductConcrete[] List of ChildSpyProductListProductConcrete objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductListProductConcrete> List of ChildSpyProductListProductConcrete objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductListProductConcretes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductListProductConcretesPartial && !$this->isNew();
        if (null === $this->collSpyProductListProductConcretes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductListProductConcretes) {
                    $this->initSpyProductListProductConcretes();
                } else {
                    $collectionClassName = SpyProductListProductConcreteTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductListProductConcretes = new $collectionClassName;
                    $collSpyProductListProductConcretes->setModel('\Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete');

                    return $collSpyProductListProductConcretes;
                }
            } else {
                $collSpyProductListProductConcretes = ChildSpyProductListProductConcreteQuery::create(null, $criteria)
                    ->filterBySpyProductList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductListProductConcretesPartial && count($collSpyProductListProductConcretes)) {
                        $this->initSpyProductListProductConcretes(false);

                        foreach ($collSpyProductListProductConcretes as $obj) {
                            if (false == $this->collSpyProductListProductConcretes->contains($obj)) {
                                $this->collSpyProductListProductConcretes->append($obj);
                            }
                        }

                        $this->collSpyProductListProductConcretesPartial = true;
                    }

                    return $collSpyProductListProductConcretes;
                }

                if ($partial && $this->collSpyProductListProductConcretes) {
                    foreach ($this->collSpyProductListProductConcretes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductListProductConcretes[] = $obj;
                        }
                    }
                }

                $this->collSpyProductListProductConcretes = $collSpyProductListProductConcretes;
                $this->collSpyProductListProductConcretesPartial = false;
            }
        }

        return $this->collSpyProductListProductConcretes;
    }

    /**
     * Sets a collection of ChildSpyProductListProductConcrete objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductListProductConcretes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductListProductConcretes(Collection $spyProductListProductConcretes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductListProductConcrete[] $spyProductListProductConcretesToDelete */
        $spyProductListProductConcretesToDelete = $this->getSpyProductListProductConcretes(new Criteria(), $con)->diff($spyProductListProductConcretes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductListProductConcretesScheduledForDeletion = clone $spyProductListProductConcretesToDelete;

        foreach ($spyProductListProductConcretesToDelete as $spyProductListProductConcreteRemoved) {
            $spyProductListProductConcreteRemoved->setSpyProductList(null);
        }

        $this->collSpyProductListProductConcretes = null;
        foreach ($spyProductListProductConcretes as $spyProductListProductConcrete) {
            $this->addSpyProductListProductConcrete($spyProductListProductConcrete);
        }

        $this->collSpyProductListProductConcretes = $spyProductListProductConcretes;
        $this->collSpyProductListProductConcretesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductListProductConcrete objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductListProductConcrete objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductListProductConcretes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductListProductConcretesPartial && !$this->isNew();
        if (null === $this->collSpyProductListProductConcretes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductListProductConcretes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductListProductConcretes());
            }

            $query = ChildSpyProductListProductConcreteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductList($this)
                ->count($con);
        }

        return count($this->collSpyProductListProductConcretes);
    }

    /**
     * Method called to associate a ChildSpyProductListProductConcrete object to this object
     * through the ChildSpyProductListProductConcrete foreign key attribute.
     *
     * @param ChildSpyProductListProductConcrete $l ChildSpyProductListProductConcrete
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductListProductConcrete(ChildSpyProductListProductConcrete $l)
    {
        if ($this->collSpyProductListProductConcretes === null) {
            $this->initSpyProductListProductConcretes();
            $this->collSpyProductListProductConcretesPartial = true;
        }

        if (!$this->collSpyProductListProductConcretes->contains($l)) {
            $this->doAddSpyProductListProductConcrete($l);

            if ($this->spyProductListProductConcretesScheduledForDeletion and $this->spyProductListProductConcretesScheduledForDeletion->contains($l)) {
                $this->spyProductListProductConcretesScheduledForDeletion->remove($this->spyProductListProductConcretesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductListProductConcrete $spyProductListProductConcrete The ChildSpyProductListProductConcrete object to add.
     */
    protected function doAddSpyProductListProductConcrete(ChildSpyProductListProductConcrete $spyProductListProductConcrete): void
    {
        $this->collSpyProductListProductConcretes[]= $spyProductListProductConcrete;
        $spyProductListProductConcrete->setSpyProductList($this);
    }

    /**
     * @param ChildSpyProductListProductConcrete $spyProductListProductConcrete The ChildSpyProductListProductConcrete object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductListProductConcrete(ChildSpyProductListProductConcrete $spyProductListProductConcrete)
    {
        if ($this->getSpyProductListProductConcretes()->contains($spyProductListProductConcrete)) {
            $pos = $this->collSpyProductListProductConcretes->search($spyProductListProductConcrete);
            $this->collSpyProductListProductConcretes->remove($pos);
            if (null === $this->spyProductListProductConcretesScheduledForDeletion) {
                $this->spyProductListProductConcretesScheduledForDeletion = clone $this->collSpyProductListProductConcretes;
                $this->spyProductListProductConcretesScheduledForDeletion->clear();
            }
            $this->spyProductListProductConcretesScheduledForDeletion[]= clone $spyProductListProductConcrete;
            $spyProductListProductConcrete->setSpyProductList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductList is new, it will return
     * an empty collection; or if this SpyProductList has previously
     * been saved, it will retrieve related SpyProductListProductConcretes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductListProductConcrete[] List of ChildSpyProductListProductConcrete objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductListProductConcrete}> List of ChildSpyProductListProductConcrete objects
     */
    public function getSpyProductListProductConcretesJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductListProductConcreteQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductListProductConcretes($query, $con);
    }

    /**
     * Clears out the collSpyProductListCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductListCategories()
     */
    public function clearSpyProductListCategories()
    {
        $this->collSpyProductListCategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductListCategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductListCategories($v = true): void
    {
        $this->collSpyProductListCategoriesPartial = $v;
    }

    /**
     * Initializes the collSpyProductListCategories collection.
     *
     * By default this just sets the collSpyProductListCategories collection to an empty array (like clearcollSpyProductListCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductListCategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductListCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductListCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductListCategories = new $collectionClassName;
        $this->collSpyProductListCategories->setModel('\Orm\Zed\ProductList\Persistence\SpyProductListCategory');
    }

    /**
     * Gets an array of ChildSpyProductListCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductListCategory[] List of ChildSpyProductListCategory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductListCategory> List of ChildSpyProductListCategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductListCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductListCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductListCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductListCategories) {
                    $this->initSpyProductListCategories();
                } else {
                    $collectionClassName = SpyProductListCategoryTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductListCategories = new $collectionClassName;
                    $collSpyProductListCategories->setModel('\Orm\Zed\ProductList\Persistence\SpyProductListCategory');

                    return $collSpyProductListCategories;
                }
            } else {
                $collSpyProductListCategories = ChildSpyProductListCategoryQuery::create(null, $criteria)
                    ->filterBySpyProductList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductListCategoriesPartial && count($collSpyProductListCategories)) {
                        $this->initSpyProductListCategories(false);

                        foreach ($collSpyProductListCategories as $obj) {
                            if (false == $this->collSpyProductListCategories->contains($obj)) {
                                $this->collSpyProductListCategories->append($obj);
                            }
                        }

                        $this->collSpyProductListCategoriesPartial = true;
                    }

                    return $collSpyProductListCategories;
                }

                if ($partial && $this->collSpyProductListCategories) {
                    foreach ($this->collSpyProductListCategories as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductListCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyProductListCategories = $collSpyProductListCategories;
                $this->collSpyProductListCategoriesPartial = false;
            }
        }

        return $this->collSpyProductListCategories;
    }

    /**
     * Sets a collection of ChildSpyProductListCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductListCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductListCategories(Collection $spyProductListCategories, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductListCategory[] $spyProductListCategoriesToDelete */
        $spyProductListCategoriesToDelete = $this->getSpyProductListCategories(new Criteria(), $con)->diff($spyProductListCategories);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductListCategoriesScheduledForDeletion = clone $spyProductListCategoriesToDelete;

        foreach ($spyProductListCategoriesToDelete as $spyProductListCategoryRemoved) {
            $spyProductListCategoryRemoved->setSpyProductList(null);
        }

        $this->collSpyProductListCategories = null;
        foreach ($spyProductListCategories as $spyProductListCategory) {
            $this->addSpyProductListCategory($spyProductListCategory);
        }

        $this->collSpyProductListCategories = $spyProductListCategories;
        $this->collSpyProductListCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductListCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductListCategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductListCategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductListCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductListCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductListCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductListCategories());
            }

            $query = ChildSpyProductListCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductList($this)
                ->count($con);
        }

        return count($this->collSpyProductListCategories);
    }

    /**
     * Method called to associate a ChildSpyProductListCategory object to this object
     * through the ChildSpyProductListCategory foreign key attribute.
     *
     * @param ChildSpyProductListCategory $l ChildSpyProductListCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductListCategory(ChildSpyProductListCategory $l)
    {
        if ($this->collSpyProductListCategories === null) {
            $this->initSpyProductListCategories();
            $this->collSpyProductListCategoriesPartial = true;
        }

        if (!$this->collSpyProductListCategories->contains($l)) {
            $this->doAddSpyProductListCategory($l);

            if ($this->spyProductListCategoriesScheduledForDeletion and $this->spyProductListCategoriesScheduledForDeletion->contains($l)) {
                $this->spyProductListCategoriesScheduledForDeletion->remove($this->spyProductListCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductListCategory $spyProductListCategory The ChildSpyProductListCategory object to add.
     */
    protected function doAddSpyProductListCategory(ChildSpyProductListCategory $spyProductListCategory): void
    {
        $this->collSpyProductListCategories[]= $spyProductListCategory;
        $spyProductListCategory->setSpyProductList($this);
    }

    /**
     * @param ChildSpyProductListCategory $spyProductListCategory The ChildSpyProductListCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductListCategory(ChildSpyProductListCategory $spyProductListCategory)
    {
        if ($this->getSpyProductListCategories()->contains($spyProductListCategory)) {
            $pos = $this->collSpyProductListCategories->search($spyProductListCategory);
            $this->collSpyProductListCategories->remove($pos);
            if (null === $this->spyProductListCategoriesScheduledForDeletion) {
                $this->spyProductListCategoriesScheduledForDeletion = clone $this->collSpyProductListCategories;
                $this->spyProductListCategoriesScheduledForDeletion->clear();
            }
            $this->spyProductListCategoriesScheduledForDeletion[]= clone $spyProductListCategory;
            $spyProductListCategory->setSpyProductList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductList is new, it will return
     * an empty collection; or if this SpyProductList has previously
     * been saved, it will retrieve related SpyProductListCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductListCategory[] List of ChildSpyProductListCategory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductListCategory}> List of ChildSpyProductListCategory objects
     */
    public function getSpyProductListCategoriesJoinSpyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductListCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyCategory', $joinBehavior);

        return $this->getSpyProductListCategories($query, $con);
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
     * Gets an array of SpySspModelToProductList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspModelToProductList[] List of SpySspModelToProductList objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspModelToProductList> List of SpySspModelToProductList objects
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
                $collSpySspModelToProductLists = SpySspModelToProductListQuery::create(null, $criteria)
                    ->filterBySpyProductList($this)
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
     * Sets a collection of SpySspModelToProductList objects related by a one-to-many relationship
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
        /** @var SpySspModelToProductList[] $spySspModelToProductListsToDelete */
        $spySspModelToProductListsToDelete = $this->getSpySspModelToProductLists(new Criteria(), $con)->diff($spySspModelToProductLists);


        $this->spySspModelToProductListsScheduledForDeletion = $spySspModelToProductListsToDelete;

        foreach ($spySspModelToProductListsToDelete as $spySspModelToProductListRemoved) {
            $spySspModelToProductListRemoved->setSpyProductList(null);
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
     * Returns the number of related BaseSpySspModelToProductList objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspModelToProductList objects.
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

            $query = SpySspModelToProductListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductList($this)
                ->count($con);
        }

        return count($this->collSpySspModelToProductLists);
    }

    /**
     * Method called to associate a SpySspModelToProductList object to this object
     * through the SpySspModelToProductList foreign key attribute.
     *
     * @param SpySspModelToProductList $l SpySspModelToProductList
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspModelToProductList(SpySspModelToProductList $l)
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
     * @param SpySspModelToProductList $spySspModelToProductList The SpySspModelToProductList object to add.
     */
    protected function doAddSpySspModelToProductList(SpySspModelToProductList $spySspModelToProductList): void
    {
        $this->collSpySspModelToProductLists[]= $spySspModelToProductList;
        $spySspModelToProductList->setSpyProductList($this);
    }

    /**
     * @param SpySspModelToProductList $spySspModelToProductList The SpySspModelToProductList object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspModelToProductList(SpySspModelToProductList $spySspModelToProductList)
    {
        if ($this->getSpySspModelToProductLists()->contains($spySspModelToProductList)) {
            $pos = $this->collSpySspModelToProductLists->search($spySspModelToProductList);
            $this->collSpySspModelToProductLists->remove($pos);
            if (null === $this->spySspModelToProductListsScheduledForDeletion) {
                $this->spySspModelToProductListsScheduledForDeletion = clone $this->collSpySspModelToProductLists;
                $this->spySspModelToProductListsScheduledForDeletion->clear();
            }
            $this->spySspModelToProductListsScheduledForDeletion[]= clone $spySspModelToProductList;
            $spySspModelToProductList->setSpyProductList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductList is new, it will return
     * an empty collection; or if this SpyProductList has previously
     * been saved, it will retrieve related SpySspModelToProductLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductList.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspModelToProductList[] List of SpySspModelToProductList objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspModelToProductList}> List of SpySspModelToProductList objects
     */
    public function getSpySspModelToProductListsJoinSpySspModel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspModelToProductListQuery::create(null, $criteria);
        $query->joinWith('SpySspModel', $joinBehavior);

        return $this->getSpySspModelToProductLists($query, $con);
    }

    /**
     * Clears out the collSpyProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProducts()
     */
    public function clearSpyProducts()
    {
        $this->collSpyProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyProducts crossRef collection.
     *
     * By default this just sets the collSpyProducts collection to an empty collection (like clearSpyProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyProducts()
    {
        $collectionClassName = SpyProductListProductConcreteTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProducts = new $collectionClassName;
        $this->collSpyProductsPartial = true;
        $this->collSpyProducts->setModel('\Orm\Zed\Product\Persistence\SpyProduct');
    }

    /**
     * Checks if the collSpyProducts collection is loaded.
     *
     * @return bool
     */
    public function isSpyProductsLoaded(): bool
    {
        return null !== $this->collSpyProducts;
    }

    /**
     * Gets a collection of SpyProduct objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_product_concrete cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyProduct[] List of SpyProduct objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProduct> List of SpyProduct objects
     */
    public function getSpyProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductsPartial && !$this->isNew();
        if (null === $this->collSpyProducts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProducts) {
                    $this->initSpyProducts();
                }
            } else {

                $query = SpyProductQuery::create(null, $criteria)
                    ->filterBySpyProductList($this);
                $collSpyProducts = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyProducts;
                }

                if ($partial && $this->collSpyProducts) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyProducts as $obj) {
                        if (!$collSpyProducts->contains($obj)) {
                            $collSpyProducts[] = $obj;
                        }
                    }
                }

                $this->collSpyProducts = $collSpyProducts;
                $this->collSpyProductsPartial = false;
            }
        }

        return $this->collSpyProducts;
    }

    /**
     * Sets a collection of SpyProduct objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_product_concrete cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProducts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProducts(Collection $spyProducts, ?ConnectionInterface $con = null)
    {
        $this->clearSpyProducts();
        $currentSpyProducts = $this->getSpyProducts();

        $spyProductsScheduledForDeletion = $currentSpyProducts->diff($spyProducts);

        foreach ($spyProductsScheduledForDeletion as $toDelete) {
            $this->removeSpyProduct($toDelete);
        }

        foreach ($spyProducts as $spyProduct) {
            if (!$currentSpyProducts->contains($spyProduct)) {
                $this->doAddSpyProduct($spyProduct);
            }
        }

        $this->collSpyProductsPartial = false;
        $this->collSpyProducts = $spyProducts;

        return $this;
    }

    /**
     * Gets the number of SpyProduct objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_product_concrete cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyProduct objects
     */
    public function countSpyProducts(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductsPartial && !$this->isNew();
        if (null === $this->collSpyProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProducts) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyProducts());
                }

                $query = SpyProductQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyProductList($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProducts);
        }
    }

    /**
     * Associate a SpyProduct to this object
     * through the spy_product_list_product_concrete cross reference table.
     *
     * @param SpyProduct $spyProduct
     * @return ChildSpyProductList The current object (for fluent API support)
     */
    public function addSpyProduct(SpyProduct $spyProduct)
    {
        if ($this->collSpyProducts === null) {
            $this->initSpyProducts();
        }

        if (!$this->getSpyProducts()->contains($spyProduct)) {
            // only add it if the **same** object is not already associated
            $this->collSpyProducts->push($spyProduct);
            $this->doAddSpyProduct($spyProduct);
        }

        return $this;
    }

    /**
     *
     * @param SpyProduct $spyProduct
     */
    protected function doAddSpyProduct(SpyProduct $spyProduct)
    {
        $spyProductListProductConcrete = new ChildSpyProductListProductConcrete();

        $spyProductListProductConcrete->setSpyProduct($spyProduct);

        $spyProductListProductConcrete->setSpyProductList($this);

        $this->addSpyProductListProductConcrete($spyProductListProductConcrete);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProduct->isSpyProductListsLoaded()) {
            $spyProduct->initSpyProductLists();
            $spyProduct->getSpyProductLists()->push($this);
        } elseif (!$spyProduct->getSpyProductLists()->contains($this)) {
            $spyProduct->getSpyProductLists()->push($this);
        }

    }

    /**
     * Remove spyProduct of this object
     * through the spy_product_list_product_concrete cross reference table.
     *
     * @param SpyProduct $spyProduct
     * @return ChildSpyProductList The current object (for fluent API support)
     */
    public function removeSpyProduct(SpyProduct $spyProduct)
    {
        if ($this->getSpyProducts()->contains($spyProduct)) {
            $spyProductListProductConcrete = new ChildSpyProductListProductConcrete();
            $spyProductListProductConcrete->setSpyProduct($spyProduct);
            if ($spyProduct->isSpyProductListsLoaded()) {
                //remove the back reference if available
                $spyProduct->getSpyProductLists()->removeObject($this);
            }

            $spyProductListProductConcrete->setSpyProductList($this);
            $this->removeSpyProductListProductConcrete(clone $spyProductListProductConcrete);
            $spyProductListProductConcrete->clear();

            $this->collSpyProducts->remove($this->collSpyProducts->search($spyProduct));

            if (null === $this->spyProductsScheduledForDeletion) {
                $this->spyProductsScheduledForDeletion = clone $this->collSpyProducts;
                $this->spyProductsScheduledForDeletion->clear();
            }

            $this->spyProductsScheduledForDeletion->push($spyProduct);
        }


        return $this;
    }

    /**
     * Clears out the collSpyCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyCategories()
     */
    public function clearSpyCategories()
    {
        $this->collSpyCategories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyCategories crossRef collection.
     *
     * By default this just sets the collSpyCategories collection to an empty collection (like clearSpyCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyCategories()
    {
        $collectionClassName = SpyProductListCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategories = new $collectionClassName;
        $this->collSpyCategoriesPartial = true;
        $this->collSpyCategories->setModel('\Orm\Zed\Category\Persistence\SpyCategory');
    }

    /**
     * Checks if the collSpyCategories collection is loaded.
     *
     * @return bool
     */
    public function isSpyCategoriesLoaded(): bool
    {
        return null !== $this->collSpyCategories;
    }

    /**
     * Gets a collection of SpyCategory objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyCategory[] List of SpyCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategory> List of SpyCategory objects
     */
    public function getSpyCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategories) {
                    $this->initSpyCategories();
                }
            } else {

                $query = SpyCategoryQuery::create(null, $criteria)
                    ->filterBySpyProductList($this);
                $collSpyCategories = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyCategories;
                }

                if ($partial && $this->collSpyCategories) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyCategories as $obj) {
                        if (!$collSpyCategories->contains($obj)) {
                            $collSpyCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyCategories = $collSpyCategories;
                $this->collSpyCategoriesPartial = false;
            }
        }

        return $this->collSpyCategories;
    }

    /**
     * Sets a collection of SpyCategory objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategories(Collection $spyCategories, ?ConnectionInterface $con = null)
    {
        $this->clearSpyCategories();
        $currentSpyCategories = $this->getSpyCategories();

        $spyCategoriesScheduledForDeletion = $currentSpyCategories->diff($spyCategories);

        foreach ($spyCategoriesScheduledForDeletion as $toDelete) {
            $this->removeSpyCategory($toDelete);
        }

        foreach ($spyCategories as $spyCategory) {
            if (!$currentSpyCategories->contains($spyCategory)) {
                $this->doAddSpyCategory($spyCategory);
            }
        }

        $this->collSpyCategoriesPartial = false;
        $this->collSpyCategories = $spyCategories;

        return $this;
    }

    /**
     * Gets the number of SpyCategory objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyCategory objects
     */
    public function countSpyCategories(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategories) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyCategories());
                }

                $query = SpyCategoryQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyProductList($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyCategories);
        }
    }

    /**
     * Associate a SpyCategory to this object
     * through the spy_product_list_category cross reference table.
     *
     * @param SpyCategory $spyCategory
     * @return ChildSpyProductList The current object (for fluent API support)
     */
    public function addSpyCategory(SpyCategory $spyCategory)
    {
        if ($this->collSpyCategories === null) {
            $this->initSpyCategories();
        }

        if (!$this->getSpyCategories()->contains($spyCategory)) {
            // only add it if the **same** object is not already associated
            $this->collSpyCategories->push($spyCategory);
            $this->doAddSpyCategory($spyCategory);
        }

        return $this;
    }

    /**
     *
     * @param SpyCategory $spyCategory
     */
    protected function doAddSpyCategory(SpyCategory $spyCategory)
    {
        $spyProductListCategory = new ChildSpyProductListCategory();

        $spyProductListCategory->setSpyCategory($spyCategory);

        $spyProductListCategory->setSpyProductList($this);

        $this->addSpyProductListCategory($spyProductListCategory);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyCategory->isSpyProductListsLoaded()) {
            $spyCategory->initSpyProductLists();
            $spyCategory->getSpyProductLists()->push($this);
        } elseif (!$spyCategory->getSpyProductLists()->contains($this)) {
            $spyCategory->getSpyProductLists()->push($this);
        }

    }

    /**
     * Remove spyCategory of this object
     * through the spy_product_list_category cross reference table.
     *
     * @param SpyCategory $spyCategory
     * @return ChildSpyProductList The current object (for fluent API support)
     */
    public function removeSpyCategory(SpyCategory $spyCategory)
    {
        if ($this->getSpyCategories()->contains($spyCategory)) {
            $spyProductListCategory = new ChildSpyProductListCategory();
            $spyProductListCategory->setSpyCategory($spyCategory);
            if ($spyCategory->isSpyProductListsLoaded()) {
                //remove the back reference if available
                $spyCategory->getSpyProductLists()->removeObject($this);
            }

            $spyProductListCategory->setSpyProductList($this);
            $this->removeSpyProductListCategory(clone $spyProductListCategory);
            $spyProductListCategory->clear();

            $this->collSpyCategories->remove($this->collSpyCategories->search($spyCategory));

            if (null === $this->spyCategoriesScheduledForDeletion) {
                $this->spyCategoriesScheduledForDeletion = clone $this->collSpyCategories;
                $this->spyCategoriesScheduledForDeletion->clear();
            }

            $this->spyCategoriesScheduledForDeletion->push($spyCategory);
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
        if (null !== $this->aSpyMerchantRelationship) {
            $this->aSpyMerchantRelationship->removeSpyProductList($this);
        }
        $this->id_product_list = null;
        $this->fk_merchant_relationship = null;
        $this->key = null;
        $this->title = null;
        $this->type = null;
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
            if ($this->collSpyConfigurableBundleTemplateSlots) {
                foreach ($this->collSpyConfigurableBundleTemplateSlots as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductListProductConcretes) {
                foreach ($this->collSpyProductListProductConcretes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductListCategories) {
                foreach ($this->collSpyProductListCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspModelToProductLists) {
                foreach ($this->collSpySspModelToProductLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProducts) {
                foreach ($this->collSpyProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategories) {
                foreach ($this->collSpyCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyConfigurableBundleTemplateSlots = null;
        $this->collSpyProductListProductConcretes = null;
        $this->collSpyProductListCategories = null;
        $this->collSpySspModelToProductLists = null;
        $this->collSpyProducts = null;
        $this->collSpyCategories = null;
        $this->aSpyMerchantRelationship = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductListTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductListTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_list.create';
        } else {
            $this->_eventName = 'Entity.spy_product_list.update';
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

        if ($this->_eventName !== 'Entity.spy_product_list.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_list',
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
            'name' => 'spy_product_list',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_list.delete',
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
            $field = str_replace('spy_product_list.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_list.', '', $additionalValueColumnName);
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
        $columnType = SpyProductListTableMap::getTableMap()->getColumn($column)->getType();
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
