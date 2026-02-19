<?php

namespace Orm\Zed\ProductImage\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet as ChildSpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery as ChildSpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage as ChildSpyProductImageSetToProductImage;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery as ChildSpyProductImageSetToProductImageQuery;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetTableMap;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetToProductImageTableMap;
use Orm\Zed\ProductSet\Persistence\SpyProductSet;
use Orm\Zed\ProductSet\Persistence\SpyProductSetQuery;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
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
 * Base class that represents a row from the 'spy_product_image_set' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductImage.Persistence.Base
 */
abstract class SpyProductImageSet implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductImage\\Persistence\\Map\\SpyProductImageSetTableMap';


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
     * The value for the id_product_image_set field.
     *
     * @var        int
     */
    protected $id_product_image_set;

    /**
     * The value for the fk_locale field.
     *
     * @var        int|null
     */
    protected $fk_locale;

    /**
     * The value for the fk_product field.
     *
     * @var        int|null
     */
    protected $fk_product;

    /**
     * The value for the fk_product_abstract field.
     *
     * @var        int|null
     */
    protected $fk_product_abstract;

    /**
     * The value for the fk_resource_configurable_bundle_template field.
     *
     * @var        int|null
     */
    protected $fk_resource_configurable_bundle_template;

    /**
     * The value for the fk_resource_product_set field.
     *
     * @var        int|null
     */
    protected $fk_resource_product_set;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the product_image_set_key field.
     * A unique key to identify a specific product image set.
     * @var        string|null
     */
    protected $product_image_set_key;

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
     * @var        SpyConfigurableBundleTemplate
     */
    protected $aSpyConfigurableBundleTemplate;

    /**
     * @var        SpyLocale
     */
    protected $aSpyLocale;

    /**
     * @var        SpyProduct
     */
    protected $aSpyProduct;

    /**
     * @var        SpyProductAbstract
     */
    protected $aSpyProductAbstract;

    /**
     * @var        SpyProductSet
     */
    protected $aSpyProductSet;

    /**
     * @var        ObjectCollection|ChildSpyProductImageSetToProductImage[] Collection to store aggregation of ChildSpyProductImageSetToProductImage objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductImageSetToProductImage> Collection to store aggregation of ChildSpyProductImageSetToProductImage objects.
     */
    protected $collSpyProductImageSetToProductImages;
    protected $collSpyProductImageSetToProductImagesPartial;

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
        'spy_product_image_set.fk_resource_configurable_bundle_template' => 'fk_resource_configurable_bundle_template',
        'spy_product_image_set.fk_locale' => 'fk_locale',
        'spy_product_image_set.fk_product' => 'fk_product',
        'spy_product_image_set.fk_product_abstract' => 'fk_product_abstract',
        'spy_product_image_set.fk_resource_product_set' => 'fk_resource_product_set',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductImageSetToProductImage[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductImageSetToProductImage>
     */
    protected $spyProductImageSetToProductImagesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ProductImage\Persistence\Base\SpyProductImageSet object.
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
     * Compares this with another <code>SpyProductImageSet</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductImageSet</code>, delegates to
     * <code>equals(SpyProductImageSet)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_image_set] column value.
     *
     * @return int
     */
    public function getIdProductImageSet()
    {
        return $this->id_product_image_set;
    }

    /**
     * Get the [fk_locale] column value.
     *
     * @return int|null
     */
    public function getFkLocale()
    {
        return $this->fk_locale;
    }

    /**
     * Get the [fk_product] column value.
     *
     * @return int|null
     */
    public function getFkProduct()
    {
        return $this->fk_product;
    }

    /**
     * Get the [fk_product_abstract] column value.
     *
     * @return int|null
     */
    public function getFkProductAbstract()
    {
        return $this->fk_product_abstract;
    }

    /**
     * Get the [fk_resource_configurable_bundle_template] column value.
     *
     * @return int|null
     */
    public function getFkResourceConfigurableBundleTemplate()
    {
        return $this->fk_resource_configurable_bundle_template;
    }

    /**
     * Get the [fk_resource_product_set] column value.
     *
     * @return int|null
     */
    public function getFkResourceProductSet()
    {
        return $this->fk_resource_product_set;
    }

    /**
     * Get the [name] column value.
     * The name of an entity (e.g., user, category, product, role).
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [product_image_set_key] column value.
     * A unique key to identify a specific product image set.
     * @return string|null
     */
    public function getProductImageSetKey()
    {
        return $this->product_image_set_key;
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
     * Set the value of [id_product_image_set] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductImageSet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_image_set !== $v) {
            $this->id_product_image_set = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_locale] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkLocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_locale !== $v) {
            $this->fk_locale = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_FK_LOCALE] = true;
        }

        if ($this->aSpyLocale !== null && $this->aSpyLocale->getIdLocale() !== $v) {
            $this->aSpyLocale = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProduct($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product !== $v) {
            $this->fk_product = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_FK_PRODUCT] = true;
        }

        if ($this->aSpyProduct !== null && $this->aSpyProduct->getIdProduct() !== $v) {
            $this->aSpyProduct = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_abstract] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductAbstract($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_abstract !== $v) {
            $this->fk_product_abstract = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT] = true;
        }

        if ($this->aSpyProductAbstract !== null && $this->aSpyProductAbstract->getIdProductAbstract() !== $v) {
            $this->aSpyProductAbstract = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_resource_configurable_bundle_template] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkResourceConfigurableBundleTemplate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_resource_configurable_bundle_template !== $v) {
            $this->fk_resource_configurable_bundle_template = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE] = true;
        }

        if ($this->aSpyConfigurableBundleTemplate !== null && $this->aSpyConfigurableBundleTemplate->getIdConfigurableBundleTemplate() !== $v) {
            $this->aSpyConfigurableBundleTemplate = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_resource_product_set] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkResourceProductSet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_resource_product_set !== $v) {
            $this->fk_resource_product_set = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET] = true;
        }

        if ($this->aSpyProductSet !== null && $this->aSpyProductSet->getIdProductSet() !== $v) {
            $this->aSpyProductSet = null;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     * The name of an entity (e.g., user, category, product, role).
     * @param string|null $v New value
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
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_image_set_key] column.
     * A unique key to identify a specific product image set.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductImageSetKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_image_set_key !== $v) {
            $this->product_image_set_key = $v;
            $this->modifiedColumns[SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY] = true;
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
                $this->modifiedColumns[SpyProductImageSetTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductImageSetTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductImageSetTableMap::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_image_set = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductImageSetTableMap::translateFieldName('FkLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductImageSetTableMap::translateFieldName('FkProduct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductImageSetTableMap::translateFieldName('FkProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_abstract = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductImageSetTableMap::translateFieldName('FkResourceConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_resource_configurable_bundle_template = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductImageSetTableMap::translateFieldName('FkResourceProductSet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_resource_product_set = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductImageSetTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductImageSetTableMap::translateFieldName('ProductImageSetKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_image_set_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductImageSetTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyProductImageSetTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SpyProductImageSetTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet'), 0, $e);
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
        if ($this->aSpyLocale !== null && $this->fk_locale !== $this->aSpyLocale->getIdLocale()) {
            $this->aSpyLocale = null;
        }
        if ($this->aSpyProduct !== null && $this->fk_product !== $this->aSpyProduct->getIdProduct()) {
            $this->aSpyProduct = null;
        }
        if ($this->aSpyProductAbstract !== null && $this->fk_product_abstract !== $this->aSpyProductAbstract->getIdProductAbstract()) {
            $this->aSpyProductAbstract = null;
        }
        if ($this->aSpyConfigurableBundleTemplate !== null && $this->fk_resource_configurable_bundle_template !== $this->aSpyConfigurableBundleTemplate->getIdConfigurableBundleTemplate()) {
            $this->aSpyConfigurableBundleTemplate = null;
        }
        if ($this->aSpyProductSet !== null && $this->fk_resource_product_set !== $this->aSpyProductSet->getIdProductSet()) {
            $this->aSpyProductSet = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductImageSetTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductImageSetQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyConfigurableBundleTemplate = null;
            $this->aSpyLocale = null;
            $this->aSpyProduct = null;
            $this->aSpyProductAbstract = null;
            $this->aSpyProductSet = null;
            $this->collSpyProductImageSetToProductImages = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductImageSet::setDeleted()
     * @see SpyProductImageSet::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageSetTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductImageSetQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageSetTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductImageSetTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductImageSetTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductImageSetTableMap::COL_UPDATED_AT)) {
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

                SpyProductImageSetTableMap::addInstanceToPool($this);
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

            if ($this->aSpyConfigurableBundleTemplate !== null) {
                if ($this->aSpyConfigurableBundleTemplate->isModified() || $this->aSpyConfigurableBundleTemplate->isNew()) {
                    $affectedRows += $this->aSpyConfigurableBundleTemplate->save($con);
                }
                $this->setSpyConfigurableBundleTemplate($this->aSpyConfigurableBundleTemplate);
            }

            if ($this->aSpyLocale !== null) {
                if ($this->aSpyLocale->isModified() || $this->aSpyLocale->isNew()) {
                    $affectedRows += $this->aSpyLocale->save($con);
                }
                $this->setSpyLocale($this->aSpyLocale);
            }

            if ($this->aSpyProduct !== null) {
                if ($this->aSpyProduct->isModified() || $this->aSpyProduct->isNew()) {
                    $affectedRows += $this->aSpyProduct->save($con);
                }
                $this->setSpyProduct($this->aSpyProduct);
            }

            if ($this->aSpyProductAbstract !== null) {
                if ($this->aSpyProductAbstract->isModified() || $this->aSpyProductAbstract->isNew()) {
                    $affectedRows += $this->aSpyProductAbstract->save($con);
                }
                $this->setSpyProductAbstract($this->aSpyProductAbstract);
            }

            if ($this->aSpyProductSet !== null) {
                if ($this->aSpyProductSet->isModified() || $this->aSpyProductSet->isNew()) {
                    $affectedRows += $this->aSpyProductSet->save($con);
                }
                $this->setSpyProductSet($this->aSpyProductSet);
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

            if ($this->spyProductImageSetToProductImagesScheduledForDeletion !== null) {
                if (!$this->spyProductImageSetToProductImagesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery::create()
                        ->filterByPrimaryKeys($this->spyProductImageSetToProductImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductImageSetToProductImagesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductImageSetToProductImages !== null) {
                foreach ($this->collSpyProductImageSetToProductImages as $referrerFK) {
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

        $this->modifiedColumns[SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_image_set';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_locale';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product_abstract';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_resource_configurable_bundle_template';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET)) {
            $modifiedColumns[':p' . $index++]  = 'fk_resource_product_set';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'product_image_set_key';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_image_set (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_image_set':
                        $stmt->bindValue($identifier, $this->id_product_image_set, PDO::PARAM_INT);

                        break;
                    case 'fk_locale':
                        $stmt->bindValue($identifier, $this->fk_locale, PDO::PARAM_INT);

                        break;
                    case 'fk_product':
                        $stmt->bindValue($identifier, $this->fk_product, PDO::PARAM_INT);

                        break;
                    case 'fk_product_abstract':
                        $stmt->bindValue($identifier, $this->fk_product_abstract, PDO::PARAM_INT);

                        break;
                    case 'fk_resource_configurable_bundle_template':
                        $stmt->bindValue($identifier, $this->fk_resource_configurable_bundle_template, PDO::PARAM_INT);

                        break;
                    case 'fk_resource_product_set':
                        $stmt->bindValue($identifier, $this->fk_resource_product_set, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'product_image_set_key':
                        $stmt->bindValue($identifier, $this->product_image_set_key, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_image_set_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductImageSet($pk);
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
        $pos = SpyProductImageSetTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductImageSet();

            case 1:
                return $this->getFkLocale();

            case 2:
                return $this->getFkProduct();

            case 3:
                return $this->getFkProductAbstract();

            case 4:
                return $this->getFkResourceConfigurableBundleTemplate();

            case 5:
                return $this->getFkResourceProductSet();

            case 6:
                return $this->getName();

            case 7:
                return $this->getProductImageSetKey();

            case 8:
                return $this->getCreatedAt();

            case 9:
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
        if (isset($alreadyDumpedObjects['SpyProductImageSet'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductImageSet'][$this->hashCode()] = true;
        $keys = SpyProductImageSetTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductImageSet(),
            $keys[1] => $this->getFkLocale(),
            $keys[2] => $this->getFkProduct(),
            $keys[3] => $this->getFkProductAbstract(),
            $keys[4] => $this->getFkResourceConfigurableBundleTemplate(),
            $keys[5] => $this->getFkResourceProductSet(),
            $keys[6] => $this->getName(),
            $keys[7] => $this->getProductImageSetKey(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyConfigurableBundleTemplate) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyConfigurableBundleTemplate';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_configurable_bundle_template';
                        break;
                    default:
                        $key = 'SpyConfigurableBundleTemplate';
                }

                $result[$key] = $this->aSpyConfigurableBundleTemplate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyLocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyLocale';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_locale';
                        break;
                    default:
                        $key = 'SpyLocale';
                }

                $result[$key] = $this->aSpyLocale->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyProduct) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProduct';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product';
                        break;
                    default:
                        $key = 'SpyProduct';
                }

                $result[$key] = $this->aSpyProduct->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyProductAbstract) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstract';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract';
                        break;
                    default:
                        $key = 'SpyProductAbstract';
                }

                $result[$key] = $this->aSpyProductAbstract->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyProductSet) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSet';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_set';
                        break;
                    default:
                        $key = 'SpyProductSet';
                }

                $result[$key] = $this->aSpyProductSet->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyProductImageSetToProductImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductImageSetToProductImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_image_set_to_product_images';
                        break;
                    default:
                        $key = 'SpyProductImageSetToProductImages';
                }

                $result[$key] = $this->collSpyProductImageSetToProductImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductImageSetTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductImageSet($value);
                break;
            case 1:
                $this->setFkLocale($value);
                break;
            case 2:
                $this->setFkProduct($value);
                break;
            case 3:
                $this->setFkProductAbstract($value);
                break;
            case 4:
                $this->setFkResourceConfigurableBundleTemplate($value);
                break;
            case 5:
                $this->setFkResourceProductSet($value);
                break;
            case 6:
                $this->setName($value);
                break;
            case 7:
                $this->setProductImageSetKey($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
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
        $keys = SpyProductImageSetTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductImageSet($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkLocale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkProduct($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkProductAbstract($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkResourceConfigurableBundleTemplate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFkResourceProductSet($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setProductImageSetKey($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
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
        $criteria = new Criteria(SpyProductImageSetTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET)) {
            $criteria->add(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET, $this->id_product_image_set);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_LOCALE)) {
            $criteria->add(SpyProductImageSetTableMap::COL_FK_LOCALE, $this->fk_locale);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_PRODUCT)) {
            $criteria->add(SpyProductImageSetTableMap::COL_FK_PRODUCT, $this->fk_product);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $criteria->add(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, $this->fk_product_abstract);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE)) {
            $criteria->add(SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE, $this->fk_resource_configurable_bundle_template);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET)) {
            $criteria->add(SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET, $this->fk_resource_product_set);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_NAME)) {
            $criteria->add(SpyProductImageSetTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY)) {
            $criteria->add(SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY, $this->product_image_set_key);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductImageSetTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductImageSetTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductImageSetTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductImageSetQuery::create();
        $criteria->add(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET, $this->id_product_image_set);

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
        $validPk = null !== $this->getIdProductImageSet();

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
        return $this->getIdProductImageSet();
    }

    /**
     * Generic method to set the primary key (id_product_image_set column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductImageSet($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductImageSet();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductImage\Persistence\SpyProductImageSet (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkLocale($this->getFkLocale());
        $copyObj->setFkProduct($this->getFkProduct());
        $copyObj->setFkProductAbstract($this->getFkProductAbstract());
        $copyObj->setFkResourceConfigurableBundleTemplate($this->getFkResourceConfigurableBundleTemplate());
        $copyObj->setFkResourceProductSet($this->getFkResourceProductSet());
        $copyObj->setName($this->getName());
        $copyObj->setProductImageSetKey($this->getProductImageSetKey());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductImageSetToProductImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductImageSetToProductImage($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductImageSet(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSet Clone of current object.
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
     * Declares an association between this object and a SpyConfigurableBundleTemplate object.
     *
     * @param SpyConfigurableBundleTemplate|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyConfigurableBundleTemplate(SpyConfigurableBundleTemplate $v = null)
    {
        if ($v === null) {
            $this->setFkResourceConfigurableBundleTemplate(NULL);
        } else {
            $this->setFkResourceConfigurableBundleTemplate($v->getIdConfigurableBundleTemplate());
        }

        $this->aSpyConfigurableBundleTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyConfigurableBundleTemplate object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductImageSet($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyConfigurableBundleTemplate object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyConfigurableBundleTemplate|null The associated SpyConfigurableBundleTemplate object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyConfigurableBundleTemplate(?ConnectionInterface $con = null)
    {
        if ($this->aSpyConfigurableBundleTemplate === null && ($this->fk_resource_configurable_bundle_template != 0)) {
            $this->aSpyConfigurableBundleTemplate = SpyConfigurableBundleTemplateQuery::create()->findPk($this->fk_resource_configurable_bundle_template, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyConfigurableBundleTemplate->addSpyProductImageSets($this);
             */
        }

        return $this->aSpyConfigurableBundleTemplate;
    }

    /**
     * Declares an association between this object and a SpyLocale object.
     *
     * @param SpyLocale|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyLocale(SpyLocale $v = null)
    {
        if ($v === null) {
            $this->setFkLocale(NULL);
        } else {
            $this->setFkLocale($v->getIdLocale());
        }

        $this->aSpyLocale = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyLocale object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductImageSet($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyLocale object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyLocale|null The associated SpyLocale object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyLocale(?ConnectionInterface $con = null)
    {
        if ($this->aSpyLocale === null && ($this->fk_locale != 0)) {
            $this->aSpyLocale = SpyLocaleQuery::create()->findPk($this->fk_locale, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyLocale->addSpyProductImageSets($this);
             */
        }

        return $this->aSpyLocale;
    }

    /**
     * Declares an association between this object and a SpyProduct object.
     *
     * @param SpyProduct|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProduct(SpyProduct $v = null)
    {
        if ($v === null) {
            $this->setFkProduct(NULL);
        } else {
            $this->setFkProduct($v->getIdProduct());
        }

        $this->aSpyProduct = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductImageSet($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProduct object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProduct|null The associated SpyProduct object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProduct(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProduct === null && ($this->fk_product != 0)) {
            $this->aSpyProduct = SpyProductQuery::create()->findPk($this->fk_product, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProduct->addSpyProductImageSets($this);
             */
        }

        return $this->aSpyProduct;
    }

    /**
     * Declares an association between this object and a SpyProductAbstract object.
     *
     * @param SpyProductAbstract|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProductAbstract(SpyProductAbstract $v = null)
    {
        if ($v === null) {
            $this->setFkProductAbstract(NULL);
        } else {
            $this->setFkProductAbstract($v->getIdProductAbstract());
        }

        $this->aSpyProductAbstract = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProductAbstract object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductImageSet($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProductAbstract object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProductAbstract|null The associated SpyProductAbstract object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstract(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProductAbstract === null && ($this->fk_product_abstract != 0)) {
            $this->aSpyProductAbstract = SpyProductAbstractQuery::create()->findPk($this->fk_product_abstract, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProductAbstract->addSpyProductImageSets($this);
             */
        }

        return $this->aSpyProductAbstract;
    }

    /**
     * Declares an association between this object and a SpyProductSet object.
     *
     * @param SpyProductSet|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProductSet(SpyProductSet $v = null)
    {
        if ($v === null) {
            $this->setFkResourceProductSet(NULL);
        } else {
            $this->setFkResourceProductSet($v->getIdProductSet());
        }

        $this->aSpyProductSet = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProductSet object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductImageSet($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProductSet object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProductSet|null The associated SpyProductSet object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSet(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProductSet === null && ($this->fk_resource_product_set != 0)) {
            $this->aSpyProductSet = SpyProductSetQuery::create()->findPk($this->fk_resource_product_set, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProductSet->addSpyProductImageSets($this);
             */
        }

        return $this->aSpyProductSet;
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
        if ('SpyProductImageSetToProductImage' === $relationName) {
            $this->initSpyProductImageSetToProductImages();
            return;
        }
    }

    /**
     * Clears out the collSpyProductImageSetToProductImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductImageSetToProductImages()
     */
    public function clearSpyProductImageSetToProductImages()
    {
        $this->collSpyProductImageSetToProductImages = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductImageSetToProductImages collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductImageSetToProductImages($v = true): void
    {
        $this->collSpyProductImageSetToProductImagesPartial = $v;
    }

    /**
     * Initializes the collSpyProductImageSetToProductImages collection.
     *
     * By default this just sets the collSpyProductImageSetToProductImages collection to an empty array (like clearcollSpyProductImageSetToProductImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductImageSetToProductImages(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductImageSetToProductImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductImageSetToProductImageTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductImageSetToProductImages = new $collectionClassName;
        $this->collSpyProductImageSetToProductImages->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage');
    }

    /**
     * Gets an array of ChildSpyProductImageSetToProductImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductImageSet is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductImageSetToProductImage[] List of ChildSpyProductImageSetToProductImage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductImageSetToProductImage> List of ChildSpyProductImageSetToProductImage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductImageSetToProductImages(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductImageSetToProductImagesPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSetToProductImages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductImageSetToProductImages) {
                    $this->initSpyProductImageSetToProductImages();
                } else {
                    $collectionClassName = SpyProductImageSetToProductImageTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductImageSetToProductImages = new $collectionClassName;
                    $collSpyProductImageSetToProductImages->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage');

                    return $collSpyProductImageSetToProductImages;
                }
            } else {
                $collSpyProductImageSetToProductImages = ChildSpyProductImageSetToProductImageQuery::create(null, $criteria)
                    ->filterBySpyProductImageSet($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductImageSetToProductImagesPartial && count($collSpyProductImageSetToProductImages)) {
                        $this->initSpyProductImageSetToProductImages(false);

                        foreach ($collSpyProductImageSetToProductImages as $obj) {
                            if (false == $this->collSpyProductImageSetToProductImages->contains($obj)) {
                                $this->collSpyProductImageSetToProductImages->append($obj);
                            }
                        }

                        $this->collSpyProductImageSetToProductImagesPartial = true;
                    }

                    return $collSpyProductImageSetToProductImages;
                }

                if ($partial && $this->collSpyProductImageSetToProductImages) {
                    foreach ($this->collSpyProductImageSetToProductImages as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductImageSetToProductImages[] = $obj;
                        }
                    }
                }

                $this->collSpyProductImageSetToProductImages = $collSpyProductImageSetToProductImages;
                $this->collSpyProductImageSetToProductImagesPartial = false;
            }
        }

        return $this->collSpyProductImageSetToProductImages;
    }

    /**
     * Sets a collection of ChildSpyProductImageSetToProductImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductImageSetToProductImages A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductImageSetToProductImages(Collection $spyProductImageSetToProductImages, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductImageSetToProductImage[] $spyProductImageSetToProductImagesToDelete */
        $spyProductImageSetToProductImagesToDelete = $this->getSpyProductImageSetToProductImages(new Criteria(), $con)->diff($spyProductImageSetToProductImages);


        $this->spyProductImageSetToProductImagesScheduledForDeletion = $spyProductImageSetToProductImagesToDelete;

        foreach ($spyProductImageSetToProductImagesToDelete as $spyProductImageSetToProductImageRemoved) {
            $spyProductImageSetToProductImageRemoved->setSpyProductImageSet(null);
        }

        $this->collSpyProductImageSetToProductImages = null;
        foreach ($spyProductImageSetToProductImages as $spyProductImageSetToProductImage) {
            $this->addSpyProductImageSetToProductImage($spyProductImageSetToProductImage);
        }

        $this->collSpyProductImageSetToProductImages = $spyProductImageSetToProductImages;
        $this->collSpyProductImageSetToProductImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductImageSetToProductImage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductImageSetToProductImage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductImageSetToProductImages(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductImageSetToProductImagesPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSetToProductImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductImageSetToProductImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductImageSetToProductImages());
            }

            $query = ChildSpyProductImageSetToProductImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductImageSet($this)
                ->count($con);
        }

        return count($this->collSpyProductImageSetToProductImages);
    }

    /**
     * Method called to associate a ChildSpyProductImageSetToProductImage object to this object
     * through the ChildSpyProductImageSetToProductImage foreign key attribute.
     *
     * @param ChildSpyProductImageSetToProductImage $l ChildSpyProductImageSetToProductImage
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductImageSetToProductImage(ChildSpyProductImageSetToProductImage $l)
    {
        if ($this->collSpyProductImageSetToProductImages === null) {
            $this->initSpyProductImageSetToProductImages();
            $this->collSpyProductImageSetToProductImagesPartial = true;
        }

        if (!$this->collSpyProductImageSetToProductImages->contains($l)) {
            $this->doAddSpyProductImageSetToProductImage($l);

            if ($this->spyProductImageSetToProductImagesScheduledForDeletion and $this->spyProductImageSetToProductImagesScheduledForDeletion->contains($l)) {
                $this->spyProductImageSetToProductImagesScheduledForDeletion->remove($this->spyProductImageSetToProductImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductImageSetToProductImage $spyProductImageSetToProductImage The ChildSpyProductImageSetToProductImage object to add.
     */
    protected function doAddSpyProductImageSetToProductImage(ChildSpyProductImageSetToProductImage $spyProductImageSetToProductImage): void
    {
        $this->collSpyProductImageSetToProductImages[]= $spyProductImageSetToProductImage;
        $spyProductImageSetToProductImage->setSpyProductImageSet($this);
    }

    /**
     * @param ChildSpyProductImageSetToProductImage $spyProductImageSetToProductImage The ChildSpyProductImageSetToProductImage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductImageSetToProductImage(ChildSpyProductImageSetToProductImage $spyProductImageSetToProductImage)
    {
        if ($this->getSpyProductImageSetToProductImages()->contains($spyProductImageSetToProductImage)) {
            $pos = $this->collSpyProductImageSetToProductImages->search($spyProductImageSetToProductImage);
            $this->collSpyProductImageSetToProductImages->remove($pos);
            if (null === $this->spyProductImageSetToProductImagesScheduledForDeletion) {
                $this->spyProductImageSetToProductImagesScheduledForDeletion = clone $this->collSpyProductImageSetToProductImages;
                $this->spyProductImageSetToProductImagesScheduledForDeletion->clear();
            }
            $this->spyProductImageSetToProductImagesScheduledForDeletion[]= clone $spyProductImageSetToProductImage;
            $spyProductImageSetToProductImage->setSpyProductImageSet(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductImageSet is new, it will return
     * an empty collection; or if this SpyProductImageSet has previously
     * been saved, it will retrieve related SpyProductImageSetToProductImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductImageSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductImageSetToProductImage[] List of ChildSpyProductImageSetToProductImage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductImageSetToProductImage}> List of ChildSpyProductImageSetToProductImage objects
     */
    public function getSpyProductImageSetToProductImagesJoinSpyProductImage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductImageSetToProductImageQuery::create(null, $criteria);
        $query->joinWith('SpyProductImage', $joinBehavior);

        return $this->getSpyProductImageSetToProductImages($query, $con);
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
        if (null !== $this->aSpyConfigurableBundleTemplate) {
            $this->aSpyConfigurableBundleTemplate->removeSpyProductImageSet($this);
        }
        if (null !== $this->aSpyLocale) {
            $this->aSpyLocale->removeSpyProductImageSet($this);
        }
        if (null !== $this->aSpyProduct) {
            $this->aSpyProduct->removeSpyProductImageSet($this);
        }
        if (null !== $this->aSpyProductAbstract) {
            $this->aSpyProductAbstract->removeSpyProductImageSet($this);
        }
        if (null !== $this->aSpyProductSet) {
            $this->aSpyProductSet->removeSpyProductImageSet($this);
        }
        $this->id_product_image_set = null;
        $this->fk_locale = null;
        $this->fk_product = null;
        $this->fk_product_abstract = null;
        $this->fk_resource_configurable_bundle_template = null;
        $this->fk_resource_product_set = null;
        $this->name = null;
        $this->product_image_set_key = null;
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
            if ($this->collSpyProductImageSetToProductImages) {
                foreach ($this->collSpyProductImageSetToProductImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductImageSetToProductImages = null;
        $this->aSpyConfigurableBundleTemplate = null;
        $this->aSpyLocale = null;
        $this->aSpyProduct = null;
        $this->aSpyProductAbstract = null;
        $this->aSpyProductSet = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductImageSetTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductImageSetTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_image_set.create';
        } else {
            $this->_eventName = 'Entity.spy_product_image_set.update';
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

        if ($this->_eventName !== 'Entity.spy_product_image_set.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_image_set',
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
            'name' => 'spy_product_image_set',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_image_set.delete',
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
            $field = str_replace('spy_product_image_set.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_image_set.', '', $additionalValueColumnName);
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
        $columnType = SpyProductImageSetTableMap::getTableMap()->getColumn($column)->getType();
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
