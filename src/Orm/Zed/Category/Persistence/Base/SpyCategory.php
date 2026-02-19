<?php

namespace Orm\Zed\Category\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery;
use Orm\Zed\CategoryImage\Persistence\Base\SpyCategoryImageSet as BaseSpyCategoryImageSet;
use Orm\Zed\CategoryImage\Persistence\Map\SpyCategoryImageSetTableMap;
use Orm\Zed\Category\Persistence\SpyCategory as ChildSpyCategory;
use Orm\Zed\Category\Persistence\SpyCategoryAttribute as ChildSpyCategoryAttribute;
use Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery as ChildSpyCategoryAttributeQuery;
use Orm\Zed\Category\Persistence\SpyCategoryNode as ChildSpyCategoryNode;
use Orm\Zed\Category\Persistence\SpyCategoryNodeQuery as ChildSpyCategoryNodeQuery;
use Orm\Zed\Category\Persistence\SpyCategoryQuery as ChildSpyCategoryQuery;
use Orm\Zed\Category\Persistence\SpyCategoryStore as ChildSpyCategoryStore;
use Orm\Zed\Category\Persistence\SpyCategoryStoreQuery as ChildSpyCategoryStoreQuery;
use Orm\Zed\Category\Persistence\SpyCategoryTemplate as ChildSpyCategoryTemplate;
use Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery as ChildSpyCategoryTemplateQuery;
use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryNodeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryStoreTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryTableMap;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Base\SpyCmsBlockCategoryConnector as BaseSpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Map\SpyCmsBlockCategoryConnectorTableMap;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery;
use Orm\Zed\MerchantCategory\Persistence\Base\SpyMerchantCategory as BaseSpyMerchantCategory;
use Orm\Zed\MerchantCategory\Persistence\Map\SpyMerchantCategoryTableMap;
use Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter;
use Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery;
use Orm\Zed\ProductCategoryFilter\Persistence\Base\SpyProductCategoryFilter as BaseSpyProductCategoryFilter;
use Orm\Zed\ProductCategoryFilter\Persistence\Map\SpyProductCategoryFilterTableMap;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategory;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Orm\Zed\ProductCategory\Persistence\Base\SpyProductCategory as BaseSpyProductCategory;
use Orm\Zed\ProductCategory\Persistence\Map\SpyProductCategoryTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductList;
use Orm\Zed\ProductList\Persistence\SpyProductListCategory;
use Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListCategory as BaseSpyProductListCategory;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCategoryTableMap;
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
 * Base class that represents a row from the 'spy_category' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Category.Persistence.Base
 */
abstract class SpyCategory implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Category\\Persistence\\Map\\SpyCategoryTableMap';


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
     * The value for the id_category field.
     *
     * @var        int
     */
    protected $id_category;

    /**
     * The value for the fk_category_template field.
     *
     * @var        int
     */
    protected $fk_category_template;

    /**
     * The value for the category_key field.
     * A unique key for a category.
     * @var        string
     */
    protected $category_key;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the is_clickable field.
     * A flag indicating if a category is clickable in the navigation.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_clickable;

    /**
     * The value for the is_in_menu field.
     * A flag indicating if a category should appear in the menu.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_in_menu;

    /**
     * The value for the is_searchable field.
     * A flag indicating if a product or page is searchable.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_searchable;

    /**
     * @var        ChildSpyCategoryTemplate
     */
    protected $aCategoryTemplate;

    /**
     * @var        ObjectCollection|ChildSpyCategoryAttribute[] Collection to store aggregation of ChildSpyCategoryAttribute objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryAttribute> Collection to store aggregation of ChildSpyCategoryAttribute objects.
     */
    protected $collAttributes;
    protected $collAttributesPartial;

    /**
     * @var        ObjectCollection|ChildSpyCategoryNode[] Collection to store aggregation of ChildSpyCategoryNode objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryNode> Collection to store aggregation of ChildSpyCategoryNode objects.
     */
    protected $collNodes;
    protected $collNodesPartial;

    /**
     * @var        ObjectCollection|ChildSpyCategoryStore[] Collection to store aggregation of ChildSpyCategoryStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryStore> Collection to store aggregation of ChildSpyCategoryStore objects.
     */
    protected $collSpyCategoryStores;
    protected $collSpyCategoryStoresPartial;

    /**
     * @var        ObjectCollection|SpyCategoryImageSet[] Collection to store aggregation of SpyCategoryImageSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryImageSet> Collection to store aggregation of SpyCategoryImageSet objects.
     */
    protected $collSpyCategoryImageSets;
    protected $collSpyCategoryImageSetsPartial;

    /**
     * @var        ObjectCollection|SpyCmsBlockCategoryConnector[] Collection to store aggregation of SpyCmsBlockCategoryConnector objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector> Collection to store aggregation of SpyCmsBlockCategoryConnector objects.
     */
    protected $collSpyCmsBlockCategoryConnectors;
    protected $collSpyCmsBlockCategoryConnectorsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantCategory[] Collection to store aggregation of SpyMerchantCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCategory> Collection to store aggregation of SpyMerchantCategory objects.
     */
    protected $collSpyMerchantCategories;
    protected $collSpyMerchantCategoriesPartial;

    /**
     * @var        ObjectCollection|SpyProductCategory[] Collection to store aggregation of SpyProductCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategory> Collection to store aggregation of SpyProductCategory objects.
     */
    protected $collSpyProductCategories;
    protected $collSpyProductCategoriesPartial;

    /**
     * @var        ObjectCollection|SpyProductCategoryFilter[] Collection to store aggregation of SpyProductCategoryFilter objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategoryFilter> Collection to store aggregation of SpyProductCategoryFilter objects.
     */
    protected $collSpyProductCategoryFilters;
    protected $collSpyProductCategoryFiltersPartial;

    /**
     * @var        ObjectCollection|SpyProductListCategory[] Collection to store aggregation of SpyProductListCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductListCategory> Collection to store aggregation of SpyProductListCategory objects.
     */
    protected $collSpyProductListCategories;
    protected $collSpyProductListCategoriesPartial;

    /**
     * @var        ObjectCollection|SpyProductList[] Cross Collection to store aggregation of SpyProductList objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductList> Cross Collection to store aggregation of SpyProductList objects.
     */
    protected $collSpyProductLists;

    /**
     * @var bool
     */
    protected $collSpyProductListsPartial;

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
        'spy_category.fk_category_template' => 'fk_category_template',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductList[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductList>
     */
    protected $spyProductListsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCategoryAttribute[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryAttribute>
     */
    protected $attributesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCategoryNode[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryNode>
     */
    protected $nodesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCategoryStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCategoryStore>
     */
    protected $spyCategoryStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCategoryImageSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryImageSet>
     */
    protected $spyCategoryImageSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsBlockCategoryConnector[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector>
     */
    protected $spyCmsBlockCategoryConnectorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCategory>
     */
    protected $spyMerchantCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategory>
     */
    protected $spyProductCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductCategoryFilter[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategoryFilter>
     */
    protected $spyProductCategoryFiltersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductListCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductListCategory>
     */
    protected $spyProductListCategoriesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
        $this->is_clickable = true;
        $this->is_in_menu = true;
        $this->is_searchable = true;
    }

    /**
     * Initializes internal state of Orm\Zed\Category\Persistence\Base\SpyCategory object.
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
     * Compares this with another <code>SpyCategory</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCategory</code>, delegates to
     * <code>equals(SpyCategory)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_category] column value.
     *
     * @return int
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * Get the [fk_category_template] column value.
     *
     * @return int
     */
    public function getFkCategoryTemplate()
    {
        return $this->fk_category_template;
    }

    /**
     * Get the [category_key] column value.
     * A unique key for a category.
     * @return string
     */
    public function getCategoryKey()
    {
        return $this->category_key;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [is_clickable] column value.
     * A flag indicating if a category is clickable in the navigation.
     * @return boolean|null
     */
    public function getIsClickable()
    {
        return $this->is_clickable;
    }

    /**
     * Get the [is_clickable] column value.
     * A flag indicating if a category is clickable in the navigation.
     * @return boolean|null
     */
    public function isClickable()
    {
        return $this->getIsClickable();
    }

    /**
     * Get the [is_in_menu] column value.
     * A flag indicating if a category should appear in the menu.
     * @return boolean|null
     */
    public function getIsInMenu()
    {
        return $this->is_in_menu;
    }

    /**
     * Get the [is_in_menu] column value.
     * A flag indicating if a category should appear in the menu.
     * @return boolean|null
     */
    public function isInMenu()
    {
        return $this->getIsInMenu();
    }

    /**
     * Get the [is_searchable] column value.
     * A flag indicating if a product or page is searchable.
     * @return boolean|null
     */
    public function getIsSearchable()
    {
        return $this->is_searchable;
    }

    /**
     * Get the [is_searchable] column value.
     * A flag indicating if a product or page is searchable.
     * @return boolean|null
     */
    public function isSearchable()
    {
        return $this->getIsSearchable();
    }

    /**
     * Set the value of [id_category] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCategory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_category !== $v) {
            $this->id_category = $v;
            $this->modifiedColumns[SpyCategoryTableMap::COL_ID_CATEGORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_category_template] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCategoryTemplate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_category_template !== $v) {
            $this->fk_category_template = $v;
            $this->modifiedColumns[SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE] = true;
        }

        if ($this->aCategoryTemplate !== null && $this->aCategoryTemplate->getIdCategoryTemplate() !== $v) {
            $this->aCategoryTemplate = null;
        }

        return $this;
    }

    /**
     * Set the value of [category_key] column.
     * A unique key for a category.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->category_key !== $v) {
            $this->category_key = $v;
            $this->modifiedColumns[SpyCategoryTableMap::COL_CATEGORY_KEY] = true;
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
     * @param bool|integer|string|null $v The new value
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
            $this->modifiedColumns[SpyCategoryTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_clickable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a category is clickable in the navigation.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsClickable($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_clickable !== $v) {
            $this->is_clickable = $v;
            $this->modifiedColumns[SpyCategoryTableMap::COL_IS_CLICKABLE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_in_menu] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a category should appear in the menu.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsInMenu($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_in_menu !== $v) {
            $this->is_in_menu = $v;
            $this->modifiedColumns[SpyCategoryTableMap::COL_IS_IN_MENU] = true;
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
     * @param bool|integer|string|null $v The new value
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
            $this->modifiedColumns[SpyCategoryTableMap::COL_IS_SEARCHABLE] = true;
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
            if ($this->is_active !== true) {
                return false;
            }

            if ($this->is_clickable !== true) {
                return false;
            }

            if ($this->is_in_menu !== true) {
                return false;
            }

            if ($this->is_searchable !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCategoryTableMap::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_category = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCategoryTableMap::translateFieldName('FkCategoryTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_category_template = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCategoryTableMap::translateFieldName('CategoryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCategoryTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCategoryTableMap::translateFieldName('IsClickable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_clickable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCategoryTableMap::translateFieldName('IsInMenu', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_in_menu = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCategoryTableMap::translateFieldName('IsSearchable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_searchable = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SpyCategoryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Category\\Persistence\\SpyCategory'), 0, $e);
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
        if ($this->aCategoryTemplate !== null && $this->fk_category_template !== $this->aCategoryTemplate->getIdCategoryTemplate()) {
            $this->aCategoryTemplate = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCategoryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategoryTemplate = null;
            $this->collAttributes = null;

            $this->collNodes = null;

            $this->collSpyCategoryStores = null;

            $this->collSpyCategoryImageSets = null;

            $this->collSpyCmsBlockCategoryConnectors = null;

            $this->collSpyMerchantCategories = null;

            $this->collSpyProductCategories = null;

            $this->collSpyProductCategoryFilters = null;

            $this->collSpyProductListCategories = null;

            $this->collSpyProductLists = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCategory::setDeleted()
     * @see SpyCategory::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCategoryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
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

                SpyCategoryTableMap::addInstanceToPool($this);
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

            if ($this->aCategoryTemplate !== null) {
                if ($this->aCategoryTemplate->isModified() || $this->aCategoryTemplate->isNew()) {
                    $affectedRows += $this->aCategoryTemplate->save($con);
                }
                $this->setCategoryTemplate($this->aCategoryTemplate);
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

            if ($this->spyProductListsScheduledForDeletion !== null) {
                if (!$this->spyProductListsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductListsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdCategory();
                        $entryPk[1] = $entry->getIdProductList();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyProductListsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyProductLists) {
                foreach ($this->collSpyProductLists as $spyProductList) {
                    if (!$spyProductList->isDeleted() && ($spyProductList->isNew() || $spyProductList->isModified())) {
                        $spyProductList->save($con);
                    }
                }
            }


            if ($this->attributesScheduledForDeletion !== null) {
                if (!$this->attributesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery::create()
                        ->filterByPrimaryKeys($this->attributesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->attributesScheduledForDeletion = null;
                }
            }

            if ($this->collAttributes !== null) {
                foreach ($this->collAttributes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nodesScheduledForDeletion !== null) {
                if (!$this->nodesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery::create()
                        ->filterByPrimaryKeys($this->nodesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->nodesScheduledForDeletion = null;
                }
            }

            if ($this->collNodes !== null) {
                foreach ($this->collNodes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCategoryStoresScheduledForDeletion !== null) {
                if (!$this->spyCategoryStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCategoryStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCategoryStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCategoryStores !== null) {
                foreach ($this->collSpyCategoryStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCategoryImageSetsScheduledForDeletion !== null) {
                if (!$this->spyCategoryImageSetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCategoryImageSetsScheduledForDeletion as $spyCategoryImageSet) {
                        // need to save related object because we set the relation to null
                        $spyCategoryImageSet->save($con);
                    }
                    $this->spyCategoryImageSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCategoryImageSets !== null) {
                foreach ($this->collSpyCategoryImageSets as $referrerFK) {
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

            if ($this->spyMerchantCategoriesScheduledForDeletion !== null) {
                if (!$this->spyMerchantCategoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantCategories !== null) {
                foreach ($this->collSpyMerchantCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductCategoriesScheduledForDeletion !== null) {
                if (!$this->spyProductCategoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery::create()
                        ->filterByPrimaryKeys($this->spyProductCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductCategories !== null) {
                foreach ($this->collSpyProductCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductCategoryFiltersScheduledForDeletion !== null) {
                if (!$this->spyProductCategoryFiltersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductCategoryFiltersScheduledForDeletion as $spyProductCategoryFilter) {
                        // need to save related object because we set the relation to null
                        $spyProductCategoryFilter->save($con);
                    }
                    $this->spyProductCategoryFiltersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductCategoryFilters !== null) {
                foreach ($this->collSpyProductCategoryFilters as $referrerFK) {
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

        $this->modifiedColumns[SpyCategoryTableMap::COL_ID_CATEGORY] = true;
        if (null !== $this->id_category) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCategoryTableMap::COL_ID_CATEGORY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCategoryTableMap::COL_ID_CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = 'id_category';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_category_template';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_CATEGORY_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'category_key';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_CLICKABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_clickable';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_IN_MENU)) {
            $modifiedColumns[':p' . $index++]  = 'is_in_menu';
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_SEARCHABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_searchable';
        }

        $sql = sprintf(
            'INSERT INTO spy_category (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_category':
                        $stmt->bindValue($identifier, $this->id_category, PDO::PARAM_INT);

                        break;
                    case 'fk_category_template':
                        $stmt->bindValue($identifier, $this->fk_category_template, PDO::PARAM_INT);

                        break;
                    case 'category_key':
                        $stmt->bindValue($identifier, $this->category_key, PDO::PARAM_STR);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'is_clickable':
                        $stmt->bindValue($identifier, (int) $this->is_clickable, PDO::PARAM_INT);

                        break;
                    case 'is_in_menu':
                        $stmt->bindValue($identifier, (int) $this->is_in_menu, PDO::PARAM_INT);

                        break;
                    case 'is_searchable':
                        $stmt->bindValue($identifier, (int) $this->is_searchable, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_category_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCategory($pk);

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
        $pos = SpyCategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCategory();

            case 1:
                return $this->getFkCategoryTemplate();

            case 2:
                return $this->getCategoryKey();

            case 3:
                return $this->getIsActive();

            case 4:
                return $this->getIsClickable();

            case 5:
                return $this->getIsInMenu();

            case 6:
                return $this->getIsSearchable();

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
        if (isset($alreadyDumpedObjects['SpyCategory'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCategory'][$this->hashCode()] = true;
        $keys = SpyCategoryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCategory(),
            $keys[1] => $this->getFkCategoryTemplate(),
            $keys[2] => $this->getCategoryKey(),
            $keys[3] => $this->getIsActive(),
            $keys[4] => $this->getIsClickable(),
            $keys[5] => $this->getIsInMenu(),
            $keys[6] => $this->getIsSearchable(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCategoryTemplate) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryTemplate';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_template';
                        break;
                    default:
                        $key = 'CategoryTemplate';
                }

                $result[$key] = $this->aCategoryTemplate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAttributes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryAttributes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_attributes';
                        break;
                    default:
                        $key = 'Attributes';
                }

                $result[$key] = $this->collAttributes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryNodes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_nodes';
                        break;
                    default:
                        $key = 'Nodes';
                }

                $result[$key] = $this->collNodes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCategoryStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_stores';
                        break;
                    default:
                        $key = 'SpyCategoryStores';
                }

                $result[$key] = $this->collSpyCategoryStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCategoryImageSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryImageSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_image_sets';
                        break;
                    default:
                        $key = 'SpyCategoryImageSets';
                }

                $result[$key] = $this->collSpyCategoryImageSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpyMerchantCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_categories';
                        break;
                    default:
                        $key = 'SpyMerchantCategories';
                }

                $result[$key] = $this->collSpyMerchantCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_categories';
                        break;
                    default:
                        $key = 'SpyProductCategories';
                }

                $result[$key] = $this->collSpyProductCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductCategoryFilters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductCategoryFilters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_category_filters';
                        break;
                    default:
                        $key = 'SpyProductCategoryFilters';
                }

                $result[$key] = $this->collSpyProductCategoryFilters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCategory($value);
                break;
            case 1:
                $this->setFkCategoryTemplate($value);
                break;
            case 2:
                $this->setCategoryKey($value);
                break;
            case 3:
                $this->setIsActive($value);
                break;
            case 4:
                $this->setIsClickable($value);
                break;
            case 5:
                $this->setIsInMenu($value);
                break;
            case 6:
                $this->setIsSearchable($value);
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
        $keys = SpyCategoryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCategory($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCategoryTemplate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCategoryKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsActive($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsClickable($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsInMenu($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIsSearchable($arr[$keys[6]]);
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
        $criteria = new Criteria(SpyCategoryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCategoryTableMap::COL_ID_CATEGORY)) {
            $criteria->add(SpyCategoryTableMap::COL_ID_CATEGORY, $this->id_category);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE)) {
            $criteria->add(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $this->fk_category_template);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_CATEGORY_KEY)) {
            $criteria->add(SpyCategoryTableMap::COL_CATEGORY_KEY, $this->category_key);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyCategoryTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_CLICKABLE)) {
            $criteria->add(SpyCategoryTableMap::COL_IS_CLICKABLE, $this->is_clickable);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_IN_MENU)) {
            $criteria->add(SpyCategoryTableMap::COL_IS_IN_MENU, $this->is_in_menu);
        }
        if ($this->isColumnModified(SpyCategoryTableMap::COL_IS_SEARCHABLE)) {
            $criteria->add(SpyCategoryTableMap::COL_IS_SEARCHABLE, $this->is_searchable);
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
        $criteria = ChildSpyCategoryQuery::create();
        $criteria->add(SpyCategoryTableMap::COL_ID_CATEGORY, $this->id_category);

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
        $validPk = null !== $this->getIdCategory();

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
        return $this->getIdCategory();
    }

    /**
     * Generic method to set the primary key (id_category column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCategory($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCategory();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Category\Persistence\SpyCategory (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCategoryTemplate($this->getFkCategoryTemplate());
        $copyObj->setCategoryKey($this->getCategoryKey());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsClickable($this->getIsClickable());
        $copyObj->setIsInMenu($this->getIsInMenu());
        $copyObj->setIsSearchable($this->getIsSearchable());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAttributes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttribute($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNode($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCategoryStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCategoryStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCategoryImageSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCategoryImageSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsBlockCategoryConnectors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockCategoryConnector($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductCategoryFilters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductCategoryFilter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductListCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductListCategory($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCategory(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Category\Persistence\SpyCategory Clone of current object.
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
     * Declares an association between this object and a ChildSpyCategoryTemplate object.
     *
     * @param ChildSpyCategoryTemplate $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCategoryTemplate(ChildSpyCategoryTemplate $v = null)
    {
        if ($v === null) {
            $this->setFkCategoryTemplate(NULL);
        } else {
            $this->setFkCategoryTemplate($v->getIdCategoryTemplate());
        }

        $this->aCategoryTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCategoryTemplate object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCategory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCategoryTemplate object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCategoryTemplate The associated ChildSpyCategoryTemplate object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCategoryTemplate(?ConnectionInterface $con = null)
    {
        if ($this->aCategoryTemplate === null && ($this->fk_category_template != 0)) {
            $this->aCategoryTemplate = ChildSpyCategoryTemplateQuery::create()->findPk($this->fk_category_template, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoryTemplate->addSpyCategories($this);
             */
        }

        return $this->aCategoryTemplate;
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
        if ('Attribute' === $relationName) {
            $this->initAttributes();
            return;
        }
        if ('Node' === $relationName) {
            $this->initNodes();
            return;
        }
        if ('SpyCategoryStore' === $relationName) {
            $this->initSpyCategoryStores();
            return;
        }
        if ('SpyCategoryImageSet' === $relationName) {
            $this->initSpyCategoryImageSets();
            return;
        }
        if ('SpyCmsBlockCategoryConnector' === $relationName) {
            $this->initSpyCmsBlockCategoryConnectors();
            return;
        }
        if ('SpyMerchantCategory' === $relationName) {
            $this->initSpyMerchantCategories();
            return;
        }
        if ('SpyProductCategory' === $relationName) {
            $this->initSpyProductCategories();
            return;
        }
        if ('SpyProductCategoryFilter' === $relationName) {
            $this->initSpyProductCategoryFilters();
            return;
        }
        if ('SpyProductListCategory' === $relationName) {
            $this->initSpyProductListCategories();
            return;
        }
    }

    /**
     * Clears out the collAttributes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAttributes()
     */
    public function clearAttributes()
    {
        $this->collAttributes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAttributes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAttributes($v = true): void
    {
        $this->collAttributesPartial = $v;
    }

    /**
     * Initializes the collAttributes collection.
     *
     * By default this just sets the collAttributes collection to an empty array (like clearcollAttributes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttributes(bool $overrideExisting = true): void
    {
        if (null !== $this->collAttributes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryAttributeTableMap::getTableMap()->getCollectionClassName();

        $this->collAttributes = new $collectionClassName;
        $this->collAttributes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryAttribute');
    }

    /**
     * Gets an array of ChildSpyCategoryAttribute objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCategoryAttribute[] List of ChildSpyCategoryAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryAttribute> List of ChildSpyCategoryAttribute objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAttributes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAttributesPartial && !$this->isNew();
        if (null === $this->collAttributes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAttributes) {
                    $this->initAttributes();
                } else {
                    $collectionClassName = SpyCategoryAttributeTableMap::getTableMap()->getCollectionClassName();

                    $collAttributes = new $collectionClassName;
                    $collAttributes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryAttribute');

                    return $collAttributes;
                }
            } else {
                $collAttributes = ChildSpyCategoryAttributeQuery::create(null, $criteria)
                    ->filterByCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttributesPartial && count($collAttributes)) {
                        $this->initAttributes(false);

                        foreach ($collAttributes as $obj) {
                            if (false == $this->collAttributes->contains($obj)) {
                                $this->collAttributes->append($obj);
                            }
                        }

                        $this->collAttributesPartial = true;
                    }

                    return $collAttributes;
                }

                if ($partial && $this->collAttributes) {
                    foreach ($this->collAttributes as $obj) {
                        if ($obj->isNew()) {
                            $collAttributes[] = $obj;
                        }
                    }
                }

                $this->collAttributes = $collAttributes;
                $this->collAttributesPartial = false;
            }
        }

        return $this->collAttributes;
    }

    /**
     * Sets a collection of ChildSpyCategoryAttribute objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $attributes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAttributes(Collection $attributes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCategoryAttribute[] $attributesToDelete */
        $attributesToDelete = $this->getAttributes(new Criteria(), $con)->diff($attributes);


        $this->attributesScheduledForDeletion = $attributesToDelete;

        foreach ($attributesToDelete as $attributeRemoved) {
            $attributeRemoved->setCategory(null);
        }

        $this->collAttributes = null;
        foreach ($attributes as $attribute) {
            $this->addAttribute($attribute);
        }

        $this->collAttributes = $attributes;
        $this->collAttributesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCategoryAttribute objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCategoryAttribute objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAttributes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAttributesPartial && !$this->isNew();
        if (null === $this->collAttributes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttributes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttributes());
            }

            $query = ChildSpyCategoryAttributeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategory($this)
                ->count($con);
        }

        return count($this->collAttributes);
    }

    /**
     * Method called to associate a ChildSpyCategoryAttribute object to this object
     * through the ChildSpyCategoryAttribute foreign key attribute.
     *
     * @param ChildSpyCategoryAttribute $l ChildSpyCategoryAttribute
     * @return $this The current object (for fluent API support)
     */
    public function addAttribute(ChildSpyCategoryAttribute $l)
    {
        if ($this->collAttributes === null) {
            $this->initAttributes();
            $this->collAttributesPartial = true;
        }

        if (!$this->collAttributes->contains($l)) {
            $this->doAddAttribute($l);

            if ($this->attributesScheduledForDeletion and $this->attributesScheduledForDeletion->contains($l)) {
                $this->attributesScheduledForDeletion->remove($this->attributesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCategoryAttribute $attribute The ChildSpyCategoryAttribute object to add.
     */
    protected function doAddAttribute(ChildSpyCategoryAttribute $attribute): void
    {
        $this->collAttributes[]= $attribute;
        $attribute->setCategory($this);
    }

    /**
     * @param ChildSpyCategoryAttribute $attribute The ChildSpyCategoryAttribute object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAttribute(ChildSpyCategoryAttribute $attribute)
    {
        if ($this->getAttributes()->contains($attribute)) {
            $pos = $this->collAttributes->search($attribute);
            $this->collAttributes->remove($pos);
            if (null === $this->attributesScheduledForDeletion) {
                $this->attributesScheduledForDeletion = clone $this->collAttributes;
                $this->attributesScheduledForDeletion->clear();
            }
            $this->attributesScheduledForDeletion[]= clone $attribute;
            $attribute->setCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related Attributes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCategoryAttribute[] List of ChildSpyCategoryAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryAttribute}> List of ChildSpyCategoryAttribute objects
     */
    public function getAttributesJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCategoryAttributeQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getAttributes($query, $con);
    }

    /**
     * Clears out the collNodes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addNodes()
     */
    public function clearNodes()
    {
        $this->collNodes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collNodes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialNodes($v = true): void
    {
        $this->collNodesPartial = $v;
    }

    /**
     * Initializes the collNodes collection.
     *
     * By default this just sets the collNodes collection to an empty array (like clearcollNodes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodes(bool $overrideExisting = true): void
    {
        if (null !== $this->collNodes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryNodeTableMap::getTableMap()->getCollectionClassName();

        $this->collNodes = new $collectionClassName;
        $this->collNodes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryNode');
    }

    /**
     * Gets an array of ChildSpyCategoryNode objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCategoryNode[] List of ChildSpyCategoryNode objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryNode> List of ChildSpyCategoryNode objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getNodes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collNodesPartial && !$this->isNew();
        if (null === $this->collNodes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collNodes) {
                    $this->initNodes();
                } else {
                    $collectionClassName = SpyCategoryNodeTableMap::getTableMap()->getCollectionClassName();

                    $collNodes = new $collectionClassName;
                    $collNodes->setModel('\Orm\Zed\Category\Persistence\SpyCategoryNode');

                    return $collNodes;
                }
            } else {
                $collNodes = ChildSpyCategoryNodeQuery::create(null, $criteria)
                    ->filterByCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNodesPartial && count($collNodes)) {
                        $this->initNodes(false);

                        foreach ($collNodes as $obj) {
                            if (false == $this->collNodes->contains($obj)) {
                                $this->collNodes->append($obj);
                            }
                        }

                        $this->collNodesPartial = true;
                    }

                    return $collNodes;
                }

                if ($partial && $this->collNodes) {
                    foreach ($this->collNodes as $obj) {
                        if ($obj->isNew()) {
                            $collNodes[] = $obj;
                        }
                    }
                }

                $this->collNodes = $collNodes;
                $this->collNodesPartial = false;
            }
        }

        return $this->collNodes;
    }

    /**
     * Sets a collection of ChildSpyCategoryNode objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $nodes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setNodes(Collection $nodes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCategoryNode[] $nodesToDelete */
        $nodesToDelete = $this->getNodes(new Criteria(), $con)->diff($nodes);


        $this->nodesScheduledForDeletion = $nodesToDelete;

        foreach ($nodesToDelete as $nodeRemoved) {
            $nodeRemoved->setCategory(null);
        }

        $this->collNodes = null;
        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        $this->collNodes = $nodes;
        $this->collNodesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCategoryNode objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCategoryNode objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countNodes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collNodesPartial && !$this->isNew();
        if (null === $this->collNodes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNodes());
            }

            $query = ChildSpyCategoryNodeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategory($this)
                ->count($con);
        }

        return count($this->collNodes);
    }

    /**
     * Method called to associate a ChildSpyCategoryNode object to this object
     * through the ChildSpyCategoryNode foreign key attribute.
     *
     * @param ChildSpyCategoryNode $l ChildSpyCategoryNode
     * @return $this The current object (for fluent API support)
     */
    public function addNode(ChildSpyCategoryNode $l)
    {
        if ($this->collNodes === null) {
            $this->initNodes();
            $this->collNodesPartial = true;
        }

        if (!$this->collNodes->contains($l)) {
            $this->doAddNode($l);

            if ($this->nodesScheduledForDeletion and $this->nodesScheduledForDeletion->contains($l)) {
                $this->nodesScheduledForDeletion->remove($this->nodesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCategoryNode $node The ChildSpyCategoryNode object to add.
     */
    protected function doAddNode(ChildSpyCategoryNode $node): void
    {
        $this->collNodes[]= $node;
        $node->setCategory($this);
    }

    /**
     * @param ChildSpyCategoryNode $node The ChildSpyCategoryNode object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeNode(ChildSpyCategoryNode $node)
    {
        if ($this->getNodes()->contains($node)) {
            $pos = $this->collNodes->search($node);
            $this->collNodes->remove($pos);
            if (null === $this->nodesScheduledForDeletion) {
                $this->nodesScheduledForDeletion = clone $this->collNodes;
                $this->nodesScheduledForDeletion->clear();
            }
            $this->nodesScheduledForDeletion[]= clone $node;
            $node->setCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related Nodes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCategoryNode[] List of ChildSpyCategoryNode objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryNode}> List of ChildSpyCategoryNode objects
     */
    public function getNodesJoinParentCategoryNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCategoryNodeQuery::create(null, $criteria);
        $query->joinWith('ParentCategoryNode', $joinBehavior);

        return $this->getNodes($query, $con);
    }

    /**
     * Clears out the collSpyCategoryStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCategoryStores()
     */
    public function clearSpyCategoryStores()
    {
        $this->collSpyCategoryStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCategoryStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCategoryStores($v = true): void
    {
        $this->collSpyCategoryStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCategoryStores collection.
     *
     * By default this just sets the collSpyCategoryStores collection to an empty array (like clearcollSpyCategoryStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCategoryStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCategoryStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategoryStores = new $collectionClassName;
        $this->collSpyCategoryStores->setModel('\Orm\Zed\Category\Persistence\SpyCategoryStore');
    }

    /**
     * Gets an array of ChildSpyCategoryStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCategoryStore[] List of ChildSpyCategoryStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryStore> List of ChildSpyCategoryStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCategoryStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoryStoresPartial && !$this->isNew();
        if (null === $this->collSpyCategoryStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategoryStores) {
                    $this->initSpyCategoryStores();
                } else {
                    $collectionClassName = SpyCategoryStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCategoryStores = new $collectionClassName;
                    $collSpyCategoryStores->setModel('\Orm\Zed\Category\Persistence\SpyCategoryStore');

                    return $collSpyCategoryStores;
                }
            } else {
                $collSpyCategoryStores = ChildSpyCategoryStoreQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCategoryStoresPartial && count($collSpyCategoryStores)) {
                        $this->initSpyCategoryStores(false);

                        foreach ($collSpyCategoryStores as $obj) {
                            if (false == $this->collSpyCategoryStores->contains($obj)) {
                                $this->collSpyCategoryStores->append($obj);
                            }
                        }

                        $this->collSpyCategoryStoresPartial = true;
                    }

                    return $collSpyCategoryStores;
                }

                if ($partial && $this->collSpyCategoryStores) {
                    foreach ($this->collSpyCategoryStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCategoryStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCategoryStores = $collSpyCategoryStores;
                $this->collSpyCategoryStoresPartial = false;
            }
        }

        return $this->collSpyCategoryStores;
    }

    /**
     * Sets a collection of ChildSpyCategoryStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategoryStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategoryStores(Collection $spyCategoryStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCategoryStore[] $spyCategoryStoresToDelete */
        $spyCategoryStoresToDelete = $this->getSpyCategoryStores(new Criteria(), $con)->diff($spyCategoryStores);


        $this->spyCategoryStoresScheduledForDeletion = $spyCategoryStoresToDelete;

        foreach ($spyCategoryStoresToDelete as $spyCategoryStoreRemoved) {
            $spyCategoryStoreRemoved->setSpyCategory(null);
        }

        $this->collSpyCategoryStores = null;
        foreach ($spyCategoryStores as $spyCategoryStore) {
            $this->addSpyCategoryStore($spyCategoryStore);
        }

        $this->collSpyCategoryStores = $spyCategoryStores;
        $this->collSpyCategoryStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCategoryStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCategoryStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCategoryStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoryStoresPartial && !$this->isNew();
        if (null === $this->collSpyCategoryStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategoryStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCategoryStores());
            }

            $query = ChildSpyCategoryStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyCategoryStores);
    }

    /**
     * Method called to associate a ChildSpyCategoryStore object to this object
     * through the ChildSpyCategoryStore foreign key attribute.
     *
     * @param ChildSpyCategoryStore $l ChildSpyCategoryStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCategoryStore(ChildSpyCategoryStore $l)
    {
        if ($this->collSpyCategoryStores === null) {
            $this->initSpyCategoryStores();
            $this->collSpyCategoryStoresPartial = true;
        }

        if (!$this->collSpyCategoryStores->contains($l)) {
            $this->doAddSpyCategoryStore($l);

            if ($this->spyCategoryStoresScheduledForDeletion and $this->spyCategoryStoresScheduledForDeletion->contains($l)) {
                $this->spyCategoryStoresScheduledForDeletion->remove($this->spyCategoryStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCategoryStore $spyCategoryStore The ChildSpyCategoryStore object to add.
     */
    protected function doAddSpyCategoryStore(ChildSpyCategoryStore $spyCategoryStore): void
    {
        $this->collSpyCategoryStores[]= $spyCategoryStore;
        $spyCategoryStore->setSpyCategory($this);
    }

    /**
     * @param ChildSpyCategoryStore $spyCategoryStore The ChildSpyCategoryStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCategoryStore(ChildSpyCategoryStore $spyCategoryStore)
    {
        if ($this->getSpyCategoryStores()->contains($spyCategoryStore)) {
            $pos = $this->collSpyCategoryStores->search($spyCategoryStore);
            $this->collSpyCategoryStores->remove($pos);
            if (null === $this->spyCategoryStoresScheduledForDeletion) {
                $this->spyCategoryStoresScheduledForDeletion = clone $this->collSpyCategoryStores;
                $this->spyCategoryStoresScheduledForDeletion->clear();
            }
            $this->spyCategoryStoresScheduledForDeletion[]= clone $spyCategoryStore;
            $spyCategoryStore->setSpyCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyCategoryStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCategoryStore[] List of ChildSpyCategoryStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCategoryStore}> List of ChildSpyCategoryStore objects
     */
    public function getSpyCategoryStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCategoryStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyCategoryStores($query, $con);
    }

    /**
     * Clears out the collSpyCategoryImageSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCategoryImageSets()
     */
    public function clearSpyCategoryImageSets()
    {
        $this->collSpyCategoryImageSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCategoryImageSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCategoryImageSets($v = true): void
    {
        $this->collSpyCategoryImageSetsPartial = $v;
    }

    /**
     * Initializes the collSpyCategoryImageSets collection.
     *
     * By default this just sets the collSpyCategoryImageSets collection to an empty array (like clearcollSpyCategoryImageSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCategoryImageSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCategoryImageSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryImageSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategoryImageSets = new $collectionClassName;
        $this->collSpyCategoryImageSets->setModel('\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet');
    }

    /**
     * Gets an array of SpyCategoryImageSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCategoryImageSet[] List of SpyCategoryImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryImageSet> List of SpyCategoryImageSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCategoryImageSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoryImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyCategoryImageSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategoryImageSets) {
                    $this->initSpyCategoryImageSets();
                } else {
                    $collectionClassName = SpyCategoryImageSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCategoryImageSets = new $collectionClassName;
                    $collSpyCategoryImageSets->setModel('\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet');

                    return $collSpyCategoryImageSets;
                }
            } else {
                $collSpyCategoryImageSets = SpyCategoryImageSetQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCategoryImageSetsPartial && count($collSpyCategoryImageSets)) {
                        $this->initSpyCategoryImageSets(false);

                        foreach ($collSpyCategoryImageSets as $obj) {
                            if (false == $this->collSpyCategoryImageSets->contains($obj)) {
                                $this->collSpyCategoryImageSets->append($obj);
                            }
                        }

                        $this->collSpyCategoryImageSetsPartial = true;
                    }

                    return $collSpyCategoryImageSets;
                }

                if ($partial && $this->collSpyCategoryImageSets) {
                    foreach ($this->collSpyCategoryImageSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCategoryImageSets[] = $obj;
                        }
                    }
                }

                $this->collSpyCategoryImageSets = $collSpyCategoryImageSets;
                $this->collSpyCategoryImageSetsPartial = false;
            }
        }

        return $this->collSpyCategoryImageSets;
    }

    /**
     * Sets a collection of SpyCategoryImageSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategoryImageSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategoryImageSets(Collection $spyCategoryImageSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyCategoryImageSet[] $spyCategoryImageSetsToDelete */
        $spyCategoryImageSetsToDelete = $this->getSpyCategoryImageSets(new Criteria(), $con)->diff($spyCategoryImageSets);


        $this->spyCategoryImageSetsScheduledForDeletion = $spyCategoryImageSetsToDelete;

        foreach ($spyCategoryImageSetsToDelete as $spyCategoryImageSetRemoved) {
            $spyCategoryImageSetRemoved->setSpyCategory(null);
        }

        $this->collSpyCategoryImageSets = null;
        foreach ($spyCategoryImageSets as $spyCategoryImageSet) {
            $this->addSpyCategoryImageSet($spyCategoryImageSet);
        }

        $this->collSpyCategoryImageSets = $spyCategoryImageSets;
        $this->collSpyCategoryImageSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCategoryImageSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCategoryImageSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCategoryImageSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoryImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyCategoryImageSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategoryImageSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCategoryImageSets());
            }

            $query = SpyCategoryImageSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyCategoryImageSets);
    }

    /**
     * Method called to associate a SpyCategoryImageSet object to this object
     * through the SpyCategoryImageSet foreign key attribute.
     *
     * @param SpyCategoryImageSet $l SpyCategoryImageSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCategoryImageSet(SpyCategoryImageSet $l)
    {
        if ($this->collSpyCategoryImageSets === null) {
            $this->initSpyCategoryImageSets();
            $this->collSpyCategoryImageSetsPartial = true;
        }

        if (!$this->collSpyCategoryImageSets->contains($l)) {
            $this->doAddSpyCategoryImageSet($l);

            if ($this->spyCategoryImageSetsScheduledForDeletion and $this->spyCategoryImageSetsScheduledForDeletion->contains($l)) {
                $this->spyCategoryImageSetsScheduledForDeletion->remove($this->spyCategoryImageSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCategoryImageSet $spyCategoryImageSet The SpyCategoryImageSet object to add.
     */
    protected function doAddSpyCategoryImageSet(SpyCategoryImageSet $spyCategoryImageSet): void
    {
        $this->collSpyCategoryImageSets[]= $spyCategoryImageSet;
        $spyCategoryImageSet->setSpyCategory($this);
    }

    /**
     * @param SpyCategoryImageSet $spyCategoryImageSet The SpyCategoryImageSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCategoryImageSet(SpyCategoryImageSet $spyCategoryImageSet)
    {
        if ($this->getSpyCategoryImageSets()->contains($spyCategoryImageSet)) {
            $pos = $this->collSpyCategoryImageSets->search($spyCategoryImageSet);
            $this->collSpyCategoryImageSets->remove($pos);
            if (null === $this->spyCategoryImageSetsScheduledForDeletion) {
                $this->spyCategoryImageSetsScheduledForDeletion = clone $this->collSpyCategoryImageSets;
                $this->spyCategoryImageSetsScheduledForDeletion->clear();
            }
            $this->spyCategoryImageSetsScheduledForDeletion[]= $spyCategoryImageSet;
            $spyCategoryImageSet->setSpyCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyCategoryImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCategoryImageSet[] List of SpyCategoryImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryImageSet}> List of SpyCategoryImageSet objects
     */
    public function getSpyCategoryImageSetsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCategoryImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyCategoryImageSets($query, $con);
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
     * If this ChildSpyCategory is new, it will return
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
                    ->filterByCategory($this)
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
            $spyCmsBlockCategoryConnectorRemoved->setCategory(null);
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
                ->filterByCategory($this)
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
        $spyCmsBlockCategoryConnector->setCategory($this);
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
            $spyCmsBlockCategoryConnector->setCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockCategoryConnector[] List of SpyCmsBlockCategoryConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockCategoryConnector}> List of SpyCmsBlockCategoryConnector objects
     */
    public function getSpyCmsBlockCategoryConnectorsJoinCmsBlock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockCategoryConnectorQuery::create(null, $criteria);
        $query->joinWith('CmsBlock', $joinBehavior);

        return $this->getSpyCmsBlockCategoryConnectors($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
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
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyCmsBlockCategoryConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
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
     * Clears out the collSpyMerchantCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantCategories()
     */
    public function clearSpyMerchantCategories()
    {
        $this->collSpyMerchantCategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantCategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantCategories($v = true): void
    {
        $this->collSpyMerchantCategoriesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantCategories collection.
     *
     * By default this just sets the collSpyMerchantCategories collection to an empty array (like clearcollSpyMerchantCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantCategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantCategories = new $collectionClassName;
        $this->collSpyMerchantCategories->setModel('\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory');
    }

    /**
     * Gets an array of SpyMerchantCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantCategory[] List of SpyMerchantCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCategory> List of SpyMerchantCategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantCategories) {
                    $this->initSpyMerchantCategories();
                } else {
                    $collectionClassName = SpyMerchantCategoryTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantCategories = new $collectionClassName;
                    $collSpyMerchantCategories->setModel('\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory');

                    return $collSpyMerchantCategories;
                }
            } else {
                $collSpyMerchantCategories = SpyMerchantCategoryQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantCategoriesPartial && count($collSpyMerchantCategories)) {
                        $this->initSpyMerchantCategories(false);

                        foreach ($collSpyMerchantCategories as $obj) {
                            if (false == $this->collSpyMerchantCategories->contains($obj)) {
                                $this->collSpyMerchantCategories->append($obj);
                            }
                        }

                        $this->collSpyMerchantCategoriesPartial = true;
                    }

                    return $collSpyMerchantCategories;
                }

                if ($partial && $this->collSpyMerchantCategories) {
                    foreach ($this->collSpyMerchantCategories as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantCategories = $collSpyMerchantCategories;
                $this->collSpyMerchantCategoriesPartial = false;
            }
        }

        return $this->collSpyMerchantCategories;
    }

    /**
     * Sets a collection of SpyMerchantCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantCategories(Collection $spyMerchantCategories, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantCategory[] $spyMerchantCategoriesToDelete */
        $spyMerchantCategoriesToDelete = $this->getSpyMerchantCategories(new Criteria(), $con)->diff($spyMerchantCategories);


        $this->spyMerchantCategoriesScheduledForDeletion = $spyMerchantCategoriesToDelete;

        foreach ($spyMerchantCategoriesToDelete as $spyMerchantCategoryRemoved) {
            $spyMerchantCategoryRemoved->setSpyCategory(null);
        }

        $this->collSpyMerchantCategories = null;
        foreach ($spyMerchantCategories as $spyMerchantCategory) {
            $this->addSpyMerchantCategory($spyMerchantCategory);
        }

        $this->collSpyMerchantCategories = $spyMerchantCategories;
        $this->collSpyMerchantCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantCategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantCategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantCategories());
            }

            $query = SpyMerchantCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyMerchantCategories);
    }

    /**
     * Method called to associate a SpyMerchantCategory object to this object
     * through the SpyMerchantCategory foreign key attribute.
     *
     * @param SpyMerchantCategory $l SpyMerchantCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantCategory(SpyMerchantCategory $l)
    {
        if ($this->collSpyMerchantCategories === null) {
            $this->initSpyMerchantCategories();
            $this->collSpyMerchantCategoriesPartial = true;
        }

        if (!$this->collSpyMerchantCategories->contains($l)) {
            $this->doAddSpyMerchantCategory($l);

            if ($this->spyMerchantCategoriesScheduledForDeletion and $this->spyMerchantCategoriesScheduledForDeletion->contains($l)) {
                $this->spyMerchantCategoriesScheduledForDeletion->remove($this->spyMerchantCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantCategory $spyMerchantCategory The SpyMerchantCategory object to add.
     */
    protected function doAddSpyMerchantCategory(SpyMerchantCategory $spyMerchantCategory): void
    {
        $this->collSpyMerchantCategories[]= $spyMerchantCategory;
        $spyMerchantCategory->setSpyCategory($this);
    }

    /**
     * @param SpyMerchantCategory $spyMerchantCategory The SpyMerchantCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantCategory(SpyMerchantCategory $spyMerchantCategory)
    {
        if ($this->getSpyMerchantCategories()->contains($spyMerchantCategory)) {
            $pos = $this->collSpyMerchantCategories->search($spyMerchantCategory);
            $this->collSpyMerchantCategories->remove($pos);
            if (null === $this->spyMerchantCategoriesScheduledForDeletion) {
                $this->spyMerchantCategoriesScheduledForDeletion = clone $this->collSpyMerchantCategories;
                $this->spyMerchantCategoriesScheduledForDeletion->clear();
            }
            $this->spyMerchantCategoriesScheduledForDeletion[]= clone $spyMerchantCategory;
            $spyMerchantCategory->setSpyCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyMerchantCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantCategory[] List of SpyMerchantCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCategory}> List of SpyMerchantCategory objects
     */
    public function getSpyMerchantCategoriesJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyMerchantCategories($query, $con);
    }

    /**
     * Clears out the collSpyProductCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductCategories()
     */
    public function clearSpyProductCategories()
    {
        $this->collSpyProductCategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductCategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductCategories($v = true): void
    {
        $this->collSpyProductCategoriesPartial = $v;
    }

    /**
     * Initializes the collSpyProductCategories collection.
     *
     * By default this just sets the collSpyProductCategories collection to an empty array (like clearcollSpyProductCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductCategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductCategories = new $collectionClassName;
        $this->collSpyProductCategories->setModel('\Orm\Zed\ProductCategory\Persistence\SpyProductCategory');
    }

    /**
     * Gets an array of SpyProductCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductCategory[] List of SpyProductCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCategory> List of SpyProductCategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductCategories) {
                    $this->initSpyProductCategories();
                } else {
                    $collectionClassName = SpyProductCategoryTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductCategories = new $collectionClassName;
                    $collSpyProductCategories->setModel('\Orm\Zed\ProductCategory\Persistence\SpyProductCategory');

                    return $collSpyProductCategories;
                }
            } else {
                $collSpyProductCategories = SpyProductCategoryQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductCategoriesPartial && count($collSpyProductCategories)) {
                        $this->initSpyProductCategories(false);

                        foreach ($collSpyProductCategories as $obj) {
                            if (false == $this->collSpyProductCategories->contains($obj)) {
                                $this->collSpyProductCategories->append($obj);
                            }
                        }

                        $this->collSpyProductCategoriesPartial = true;
                    }

                    return $collSpyProductCategories;
                }

                if ($partial && $this->collSpyProductCategories) {
                    foreach ($this->collSpyProductCategories as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyProductCategories = $collSpyProductCategories;
                $this->collSpyProductCategoriesPartial = false;
            }
        }

        return $this->collSpyProductCategories;
    }

    /**
     * Sets a collection of SpyProductCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductCategories(Collection $spyProductCategories, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductCategory[] $spyProductCategoriesToDelete */
        $spyProductCategoriesToDelete = $this->getSpyProductCategories(new Criteria(), $con)->diff($spyProductCategories);


        $this->spyProductCategoriesScheduledForDeletion = $spyProductCategoriesToDelete;

        foreach ($spyProductCategoriesToDelete as $spyProductCategoryRemoved) {
            $spyProductCategoryRemoved->setSpyCategory(null);
        }

        $this->collSpyProductCategories = null;
        foreach ($spyProductCategories as $spyProductCategory) {
            $this->addSpyProductCategory($spyProductCategory);
        }

        $this->collSpyProductCategories = $spyProductCategories;
        $this->collSpyProductCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductCategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductCategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductCategories());
            }

            $query = SpyProductCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyProductCategories);
    }

    /**
     * Method called to associate a SpyProductCategory object to this object
     * through the SpyProductCategory foreign key attribute.
     *
     * @param SpyProductCategory $l SpyProductCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductCategory(SpyProductCategory $l)
    {
        if ($this->collSpyProductCategories === null) {
            $this->initSpyProductCategories();
            $this->collSpyProductCategoriesPartial = true;
        }

        if (!$this->collSpyProductCategories->contains($l)) {
            $this->doAddSpyProductCategory($l);

            if ($this->spyProductCategoriesScheduledForDeletion and $this->spyProductCategoriesScheduledForDeletion->contains($l)) {
                $this->spyProductCategoriesScheduledForDeletion->remove($this->spyProductCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductCategory $spyProductCategory The SpyProductCategory object to add.
     */
    protected function doAddSpyProductCategory(SpyProductCategory $spyProductCategory): void
    {
        $this->collSpyProductCategories[]= $spyProductCategory;
        $spyProductCategory->setSpyCategory($this);
    }

    /**
     * @param SpyProductCategory $spyProductCategory The SpyProductCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductCategory(SpyProductCategory $spyProductCategory)
    {
        if ($this->getSpyProductCategories()->contains($spyProductCategory)) {
            $pos = $this->collSpyProductCategories->search($spyProductCategory);
            $this->collSpyProductCategories->remove($pos);
            if (null === $this->spyProductCategoriesScheduledForDeletion) {
                $this->spyProductCategoriesScheduledForDeletion = clone $this->collSpyProductCategories;
                $this->spyProductCategoriesScheduledForDeletion->clear();
            }
            $this->spyProductCategoriesScheduledForDeletion[]= clone $spyProductCategory;
            $spyProductCategory->setSpyCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyProductCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductCategory[] List of SpyProductCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCategory}> List of SpyProductCategory objects
     */
    public function getSpyProductCategoriesJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductCategories($query, $con);
    }

    /**
     * Clears out the collSpyProductCategoryFilters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductCategoryFilters()
     */
    public function clearSpyProductCategoryFilters()
    {
        $this->collSpyProductCategoryFilters = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductCategoryFilters collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductCategoryFilters($v = true): void
    {
        $this->collSpyProductCategoryFiltersPartial = $v;
    }

    /**
     * Initializes the collSpyProductCategoryFilters collection.
     *
     * By default this just sets the collSpyProductCategoryFilters collection to an empty array (like clearcollSpyProductCategoryFilters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductCategoryFilters(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductCategoryFilters && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductCategoryFilterTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductCategoryFilters = new $collectionClassName;
        $this->collSpyProductCategoryFilters->setModel('\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter');
    }

    /**
     * Gets an array of SpyProductCategoryFilter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductCategoryFilter[] List of SpyProductCategoryFilter objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCategoryFilter> List of SpyProductCategoryFilter objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductCategoryFilters(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductCategoryFiltersPartial && !$this->isNew();
        if (null === $this->collSpyProductCategoryFilters || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductCategoryFilters) {
                    $this->initSpyProductCategoryFilters();
                } else {
                    $collectionClassName = SpyProductCategoryFilterTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductCategoryFilters = new $collectionClassName;
                    $collSpyProductCategoryFilters->setModel('\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter');

                    return $collSpyProductCategoryFilters;
                }
            } else {
                $collSpyProductCategoryFilters = SpyProductCategoryFilterQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductCategoryFiltersPartial && count($collSpyProductCategoryFilters)) {
                        $this->initSpyProductCategoryFilters(false);

                        foreach ($collSpyProductCategoryFilters as $obj) {
                            if (false == $this->collSpyProductCategoryFilters->contains($obj)) {
                                $this->collSpyProductCategoryFilters->append($obj);
                            }
                        }

                        $this->collSpyProductCategoryFiltersPartial = true;
                    }

                    return $collSpyProductCategoryFilters;
                }

                if ($partial && $this->collSpyProductCategoryFilters) {
                    foreach ($this->collSpyProductCategoryFilters as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductCategoryFilters[] = $obj;
                        }
                    }
                }

                $this->collSpyProductCategoryFilters = $collSpyProductCategoryFilters;
                $this->collSpyProductCategoryFiltersPartial = false;
            }
        }

        return $this->collSpyProductCategoryFilters;
    }

    /**
     * Sets a collection of SpyProductCategoryFilter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductCategoryFilters A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductCategoryFilters(Collection $spyProductCategoryFilters, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductCategoryFilter[] $spyProductCategoryFiltersToDelete */
        $spyProductCategoryFiltersToDelete = $this->getSpyProductCategoryFilters(new Criteria(), $con)->diff($spyProductCategoryFilters);


        $this->spyProductCategoryFiltersScheduledForDeletion = $spyProductCategoryFiltersToDelete;

        foreach ($spyProductCategoryFiltersToDelete as $spyProductCategoryFilterRemoved) {
            $spyProductCategoryFilterRemoved->setSpyCategory(null);
        }

        $this->collSpyProductCategoryFilters = null;
        foreach ($spyProductCategoryFilters as $spyProductCategoryFilter) {
            $this->addSpyProductCategoryFilter($spyProductCategoryFilter);
        }

        $this->collSpyProductCategoryFilters = $spyProductCategoryFilters;
        $this->collSpyProductCategoryFiltersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductCategoryFilter objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductCategoryFilter objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductCategoryFilters(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductCategoryFiltersPartial && !$this->isNew();
        if (null === $this->collSpyProductCategoryFilters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductCategoryFilters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductCategoryFilters());
            }

            $query = SpyProductCategoryFilterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyProductCategoryFilters);
    }

    /**
     * Method called to associate a SpyProductCategoryFilter object to this object
     * through the SpyProductCategoryFilter foreign key attribute.
     *
     * @param SpyProductCategoryFilter $l SpyProductCategoryFilter
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductCategoryFilter(SpyProductCategoryFilter $l)
    {
        if ($this->collSpyProductCategoryFilters === null) {
            $this->initSpyProductCategoryFilters();
            $this->collSpyProductCategoryFiltersPartial = true;
        }

        if (!$this->collSpyProductCategoryFilters->contains($l)) {
            $this->doAddSpyProductCategoryFilter($l);

            if ($this->spyProductCategoryFiltersScheduledForDeletion and $this->spyProductCategoryFiltersScheduledForDeletion->contains($l)) {
                $this->spyProductCategoryFiltersScheduledForDeletion->remove($this->spyProductCategoryFiltersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductCategoryFilter $spyProductCategoryFilter The SpyProductCategoryFilter object to add.
     */
    protected function doAddSpyProductCategoryFilter(SpyProductCategoryFilter $spyProductCategoryFilter): void
    {
        $this->collSpyProductCategoryFilters[]= $spyProductCategoryFilter;
        $spyProductCategoryFilter->setSpyCategory($this);
    }

    /**
     * @param SpyProductCategoryFilter $spyProductCategoryFilter The SpyProductCategoryFilter object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductCategoryFilter(SpyProductCategoryFilter $spyProductCategoryFilter)
    {
        if ($this->getSpyProductCategoryFilters()->contains($spyProductCategoryFilter)) {
            $pos = $this->collSpyProductCategoryFilters->search($spyProductCategoryFilter);
            $this->collSpyProductCategoryFilters->remove($pos);
            if (null === $this->spyProductCategoryFiltersScheduledForDeletion) {
                $this->spyProductCategoryFiltersScheduledForDeletion = clone $this->collSpyProductCategoryFilters;
                $this->spyProductCategoryFiltersScheduledForDeletion->clear();
            }
            $this->spyProductCategoryFiltersScheduledForDeletion[]= $spyProductCategoryFilter;
            $spyProductCategoryFilter->setSpyCategory(null);
        }

        return $this;
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
     * Gets an array of SpyProductListCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductListCategory[] List of SpyProductListCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductListCategory> List of SpyProductListCategory objects
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
                $collSpyProductListCategories = SpyProductListCategoryQuery::create(null, $criteria)
                    ->filterBySpyCategory($this)
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
     * Sets a collection of SpyProductListCategory objects related by a one-to-many relationship
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
        /** @var SpyProductListCategory[] $spyProductListCategoriesToDelete */
        $spyProductListCategoriesToDelete = $this->getSpyProductListCategories(new Criteria(), $con)->diff($spyProductListCategories);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductListCategoriesScheduledForDeletion = clone $spyProductListCategoriesToDelete;

        foreach ($spyProductListCategoriesToDelete as $spyProductListCategoryRemoved) {
            $spyProductListCategoryRemoved->setSpyCategory(null);
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
     * Returns the number of related BaseSpyProductListCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductListCategory objects.
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

            $query = SpyProductListCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCategory($this)
                ->count($con);
        }

        return count($this->collSpyProductListCategories);
    }

    /**
     * Method called to associate a SpyProductListCategory object to this object
     * through the SpyProductListCategory foreign key attribute.
     *
     * @param SpyProductListCategory $l SpyProductListCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductListCategory(SpyProductListCategory $l)
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
     * @param SpyProductListCategory $spyProductListCategory The SpyProductListCategory object to add.
     */
    protected function doAddSpyProductListCategory(SpyProductListCategory $spyProductListCategory): void
    {
        $this->collSpyProductListCategories[]= $spyProductListCategory;
        $spyProductListCategory->setSpyCategory($this);
    }

    /**
     * @param SpyProductListCategory $spyProductListCategory The SpyProductListCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductListCategory(SpyProductListCategory $spyProductListCategory)
    {
        if ($this->getSpyProductListCategories()->contains($spyProductListCategory)) {
            $pos = $this->collSpyProductListCategories->search($spyProductListCategory);
            $this->collSpyProductListCategories->remove($pos);
            if (null === $this->spyProductListCategoriesScheduledForDeletion) {
                $this->spyProductListCategoriesScheduledForDeletion = clone $this->collSpyProductListCategories;
                $this->spyProductListCategoriesScheduledForDeletion->clear();
            }
            $this->spyProductListCategoriesScheduledForDeletion[]= clone $spyProductListCategory;
            $spyProductListCategory->setSpyCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCategory is new, it will return
     * an empty collection; or if this SpyCategory has previously
     * been saved, it will retrieve related SpyProductListCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCategory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductListCategory[] List of SpyProductListCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductListCategory}> List of SpyProductListCategory objects
     */
    public function getSpyProductListCategoriesJoinSpyProductList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductListCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyProductList', $joinBehavior);

        return $this->getSpyProductListCategories($query, $con);
    }

    /**
     * Clears out the collSpyProductLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProductLists()
     */
    public function clearSpyProductLists()
    {
        $this->collSpyProductLists = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyProductLists crossRef collection.
     *
     * By default this just sets the collSpyProductLists collection to an empty collection (like clearSpyProductLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyProductLists()
    {
        $collectionClassName = SpyProductListCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLists = new $collectionClassName;
        $this->collSpyProductListsPartial = true;
        $this->collSpyProductLists->setModel('\Orm\Zed\ProductList\Persistence\SpyProductList');
    }

    /**
     * Checks if the collSpyProductLists collection is loaded.
     *
     * @return bool
     */
    public function isSpyProductListsLoaded(): bool
    {
        return null !== $this->collSpyProductLists;
    }

    /**
     * Gets a collection of SpyProductList objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyProductList[] List of SpyProductList objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductList> List of SpyProductList objects
     */
    public function getSpyProductLists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductListsPartial && !$this->isNew();
        if (null === $this->collSpyProductLists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLists) {
                    $this->initSpyProductLists();
                }
            } else {

                $query = SpyProductListQuery::create(null, $criteria)
                    ->filterBySpyCategory($this);
                $collSpyProductLists = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyProductLists;
                }

                if ($partial && $this->collSpyProductLists) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyProductLists as $obj) {
                        if (!$collSpyProductLists->contains($obj)) {
                            $collSpyProductLists[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLists = $collSpyProductLists;
                $this->collSpyProductListsPartial = false;
            }
        }

        return $this->collSpyProductLists;
    }

    /**
     * Sets a collection of SpyProductList objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLists(Collection $spyProductLists, ?ConnectionInterface $con = null)
    {
        $this->clearSpyProductLists();
        $currentSpyProductLists = $this->getSpyProductLists();

        $spyProductListsScheduledForDeletion = $currentSpyProductLists->diff($spyProductLists);

        foreach ($spyProductListsScheduledForDeletion as $toDelete) {
            $this->removeSpyProductList($toDelete);
        }

        foreach ($spyProductLists as $spyProductList) {
            if (!$currentSpyProductLists->contains($spyProductList)) {
                $this->doAddSpyProductList($spyProductList);
            }
        }

        $this->collSpyProductListsPartial = false;
        $this->collSpyProductLists = $spyProductLists;

        return $this;
    }

    /**
     * Gets the number of SpyProductList objects related by a many-to-many relationship
     * to the current object by way of the spy_product_list_category cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyProductList objects
     */
    public function countSpyProductLists(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductListsPartial && !$this->isNew();
        if (null === $this->collSpyProductLists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLists) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyProductLists());
                }

                $query = SpyProductListQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyCategory($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProductLists);
        }
    }

    /**
     * Associate a SpyProductList to this object
     * through the spy_product_list_category cross reference table.
     *
     * @param SpyProductList $spyProductList
     * @return ChildSpyCategory The current object (for fluent API support)
     */
    public function addSpyProductList(SpyProductList $spyProductList)
    {
        if ($this->collSpyProductLists === null) {
            $this->initSpyProductLists();
        }

        if (!$this->getSpyProductLists()->contains($spyProductList)) {
            // only add it if the **same** object is not already associated
            $this->collSpyProductLists->push($spyProductList);
            $this->doAddSpyProductList($spyProductList);
        }

        return $this;
    }

    /**
     *
     * @param SpyProductList $spyProductList
     */
    protected function doAddSpyProductList(SpyProductList $spyProductList)
    {
        $spyProductListCategory = new SpyProductListCategory();

        $spyProductListCategory->setSpyProductList($spyProductList);

        $spyProductListCategory->setSpyCategory($this);

        $this->addSpyProductListCategory($spyProductListCategory);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProductList->isSpyCategoriesLoaded()) {
            $spyProductList->initSpyCategories();
            $spyProductList->getSpyCategories()->push($this);
        } elseif (!$spyProductList->getSpyCategories()->contains($this)) {
            $spyProductList->getSpyCategories()->push($this);
        }

    }

    /**
     * Remove spyProductList of this object
     * through the spy_product_list_category cross reference table.
     *
     * @param SpyProductList $spyProductList
     * @return ChildSpyCategory The current object (for fluent API support)
     */
    public function removeSpyProductList(SpyProductList $spyProductList)
    {
        if ($this->getSpyProductLists()->contains($spyProductList)) {
            $spyProductListCategory = new SpyProductListCategory();
            $spyProductListCategory->setSpyProductList($spyProductList);
            if ($spyProductList->isSpyCategoriesLoaded()) {
                //remove the back reference if available
                $spyProductList->getSpyCategories()->removeObject($this);
            }

            $spyProductListCategory->setSpyCategory($this);
            $this->removeSpyProductListCategory(clone $spyProductListCategory);
            $spyProductListCategory->clear();

            $this->collSpyProductLists->remove($this->collSpyProductLists->search($spyProductList));

            if (null === $this->spyProductListsScheduledForDeletion) {
                $this->spyProductListsScheduledForDeletion = clone $this->collSpyProductLists;
                $this->spyProductListsScheduledForDeletion->clear();
            }

            $this->spyProductListsScheduledForDeletion->push($spyProductList);
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
        if (null !== $this->aCategoryTemplate) {
            $this->aCategoryTemplate->removeSpyCategory($this);
        }
        $this->id_category = null;
        $this->fk_category_template = null;
        $this->category_key = null;
        $this->is_active = null;
        $this->is_clickable = null;
        $this->is_in_menu = null;
        $this->is_searchable = null;
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
            if ($this->collAttributes) {
                foreach ($this->collAttributes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodes) {
                foreach ($this->collNodes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategoryStores) {
                foreach ($this->collSpyCategoryStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategoryImageSets) {
                foreach ($this->collSpyCategoryImageSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsBlockCategoryConnectors) {
                foreach ($this->collSpyCmsBlockCategoryConnectors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantCategories) {
                foreach ($this->collSpyMerchantCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductCategories) {
                foreach ($this->collSpyProductCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductCategoryFilters) {
                foreach ($this->collSpyProductCategoryFilters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductListCategories) {
                foreach ($this->collSpyProductListCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLists) {
                foreach ($this->collSpyProductLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAttributes = null;
        $this->collNodes = null;
        $this->collSpyCategoryStores = null;
        $this->collSpyCategoryImageSets = null;
        $this->collSpyCmsBlockCategoryConnectors = null;
        $this->collSpyMerchantCategories = null;
        $this->collSpyProductCategories = null;
        $this->collSpyProductCategoryFilters = null;
        $this->collSpyProductListCategories = null;
        $this->collSpyProductLists = null;
        $this->aCategoryTemplate = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCategoryTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_category.create';
        } else {
            $this->_eventName = 'Entity.spy_category.update';
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

        if ($this->_eventName !== 'Entity.spy_category.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_category',
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
            'name' => 'spy_category',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_category.delete',
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
            $field = str_replace('spy_category.', '', $modifiedColumn);
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
            $field = str_replace('spy_category.', '', $additionalValueColumnName);
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
        $columnType = SpyCategoryTableMap::getTableMap()->getColumn($column)->getType();
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
