<?php

namespace Orm\Zed\ProductOffer\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer;
use Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery;
use Orm\Zed\PriceProductOffer\Persistence\Base\SpyPriceProductOffer as BaseSpyPriceProductOffer;
use Orm\Zed\PriceProductOffer\Persistence\Map\SpyPriceProductOfferTableMap;
use Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService;
use Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery;
use Orm\Zed\ProductOfferServicePoint\Persistence\Base\SpyProductOfferService as BaseSpyProductOfferService;
use Orm\Zed\ProductOfferServicePoint\Persistence\Map\SpyProductOfferServiceTableMap;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery;
use Orm\Zed\ProductOfferShipmentType\Persistence\Base\SpyProductOfferShipmentType as BaseSpyProductOfferShipmentType;
use Orm\Zed\ProductOfferShipmentType\Persistence\Map\SpyProductOfferShipmentTypeTableMap;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery;
use Orm\Zed\ProductOfferStock\Persistence\Base\SpyProductOfferStock as BaseSpyProductOfferStock;
use Orm\Zed\ProductOfferStock\Persistence\Map\SpyProductOfferStockTableMap;
use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity;
use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery;
use Orm\Zed\ProductOfferValidity\Persistence\Base\SpyProductOfferValidity as BaseSpyProductOfferValidity;
use Orm\Zed\ProductOfferValidity\Persistence\Map\SpyProductOfferValidityTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer as ChildSpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery as ChildSpyProductOfferQuery;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore as ChildSpyProductOfferStore;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery as ChildSpyProductOfferStoreQuery;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferStoreTableMap;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferTableMap;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
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
 * Base class that represents a row from the 'spy_product_offer' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductOffer.Persistence.Base
 */
abstract class SpyProductOffer implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductOffer\\Persistence\\Map\\SpyProductOfferTableMap';


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
     * The value for the id_product_offer field.
     *
     * @var        int
     */
    protected $id_product_offer;

    /**
     * The value for the approval_status field.
     * The current approval status of an entity, e.g., a product or offer.
     * @var        string
     */
    protected $approval_status;

    /**
     * The value for the concrete_sku field.
     * The SKU for a concrete product variant.
     * @var        string
     */
    protected $concrete_sku;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the merchant_reference field.
     * A unique reference identifier for a merchant.
     * @var        string|null
     */
    protected $merchant_reference;

    /**
     * The value for the merchant_sku field.
     * A merchant-specific Stock Keeping Unit (SKU) for a product offer.
     * @var        string|null
     */
    protected $merchant_sku;

    /**
     * The value for the product_offer_reference field.
     * A unique reference identifier for a specific product offer from a merchant.
     * @var        string
     */
    protected $product_offer_reference;

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
     * @var        SpyMerchant
     */
    protected $aMerchant;

    /**
     * @var        ObjectCollection|SpyPriceProductOffer[] Collection to store aggregation of SpyPriceProductOffer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductOffer> Collection to store aggregation of SpyPriceProductOffer objects.
     */
    protected $collSpyPriceProductOffers;
    protected $collSpyPriceProductOffersPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductOfferStore[] Collection to store aggregation of ChildSpyProductOfferStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOfferStore> Collection to store aggregation of ChildSpyProductOfferStore objects.
     */
    protected $collSpyProductOfferStores;
    protected $collSpyProductOfferStoresPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferService[] Collection to store aggregation of SpyProductOfferService objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferService> Collection to store aggregation of SpyProductOfferService objects.
     */
    protected $collProductOfferServices;
    protected $collProductOfferServicesPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferShipmentType[] Collection to store aggregation of SpyProductOfferShipmentType objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferShipmentType> Collection to store aggregation of SpyProductOfferShipmentType objects.
     */
    protected $collProductOfferShipmentTypes;
    protected $collProductOfferShipmentTypesPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferStock[] Collection to store aggregation of SpyProductOfferStock objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStock> Collection to store aggregation of SpyProductOfferStock objects.
     */
    protected $collProductOfferStocks;
    protected $collProductOfferStocksPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferValidity[] Collection to store aggregation of SpyProductOfferValidity objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferValidity> Collection to store aggregation of SpyProductOfferValidity objects.
     */
    protected $collSpyProductOfferValidities;
    protected $collSpyProductOfferValiditiesPartial;

    /**
     * @var        ObjectCollection|SpyStore[] Cross Collection to store aggregation of SpyStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStore> Cross Collection to store aggregation of SpyStore objects.
     */
    protected $collSpyStores;

    /**
     * @var bool
     */
    protected $collSpyStoresPartial;

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
        'spy_product_offer.merchant_reference' => 'merchant_reference',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStore>
     */
    protected $spyStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProductOffer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductOffer>
     */
    protected $spyPriceProductOffersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductOfferStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOfferStore>
     */
    protected $spyProductOfferStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferService[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferService>
     */
    protected $productOfferServicesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferShipmentType[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferShipmentType>
     */
    protected $productOfferShipmentTypesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferStock[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStock>
     */
    protected $productOfferStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferValidity[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferValidity>
     */
    protected $spyProductOfferValiditiesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
    }

    /**
     * Initializes internal state of Orm\Zed\ProductOffer\Persistence\Base\SpyProductOffer object.
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
     * Compares this with another <code>SpyProductOffer</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductOffer</code>, delegates to
     * <code>equals(SpyProductOffer)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_offer] column value.
     *
     * @return int
     */
    public function getIdProductOffer()
    {
        return $this->id_product_offer;
    }

    /**
     * Get the [approval_status] column value.
     * The current approval status of an entity, e.g., a product or offer.
     * @return string
     */
    public function getApprovalStatus()
    {
        return $this->approval_status;
    }

    /**
     * Get the [concrete_sku] column value.
     * The SKU for a concrete product variant.
     * @return string
     */
    public function getConcreteSku()
    {
        return $this->concrete_sku;
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
     * Get the [merchant_reference] column value.
     * A unique reference identifier for a merchant.
     * @return string|null
     */
    public function getMerchantReference()
    {
        return $this->merchant_reference;
    }

    /**
     * Get the [merchant_sku] column value.
     * A merchant-specific Stock Keeping Unit (SKU) for a product offer.
     * @return string|null
     */
    public function getMerchantSku()
    {
        return $this->merchant_sku;
    }

    /**
     * Get the [product_offer_reference] column value.
     * A unique reference identifier for a specific product offer from a merchant.
     * @return string
     */
    public function getProductOfferReference()
    {
        return $this->product_offer_reference;
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
     * Set the value of [id_product_offer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductOffer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_offer !== $v) {
            $this->id_product_offer = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [approval_status] column.
     * The current approval status of an entity, e.g., a product or offer.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApprovalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->approval_status !== $v) {
            $this->approval_status = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_APPROVAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [concrete_sku] column.
     * The SKU for a concrete product variant.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setConcreteSku($v)
    {
        $this->_initialValues[SpyProductOfferTableMap::COL_CONCRETE_SKU] = $this->concrete_sku;

        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->concrete_sku !== $v) {
            $this->concrete_sku = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_CONCRETE_SKU] = true;
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
            $this->modifiedColumns[SpyProductOfferTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_reference] column.
     * A unique reference identifier for a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_reference !== $v) {
            $this->merchant_reference = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_MERCHANT_REFERENCE] = true;
        }

        if ($this->aMerchant !== null && $this->aMerchant->getMerchantReference() !== $v) {
            $this->aMerchant = null;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_sku] column.
     * A merchant-specific Stock Keeping Unit (SKU) for a product offer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_sku !== $v) {
            $this->merchant_sku = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_MERCHANT_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_offer_reference] column.
     * A unique reference identifier for a specific product offer from a merchant.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferReference($v)
    {
        $this->_initialValues[SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE] = $this->product_offer_reference;

        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_offer_reference !== $v) {
            $this->product_offer_reference = $v;
            $this->modifiedColumns[SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE] = true;
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
                $this->modifiedColumns[SpyProductOfferTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductOfferTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductOfferTableMap::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_offer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductOfferTableMap::translateFieldName('ApprovalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approval_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductOfferTableMap::translateFieldName('ConcreteSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->concrete_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductOfferTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductOfferTableMap::translateFieldName('MerchantReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductOfferTableMap::translateFieldName('MerchantSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductOfferTableMap::translateFieldName('ProductOfferReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_offer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductOfferTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductOfferTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpyProductOfferTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer'), 0, $e);
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
        if ($this->aMerchant !== null && $this->merchant_reference !== $this->aMerchant->getMerchantReference()) {
            $this->aMerchant = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductOfferQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMerchant = null;
            $this->collSpyPriceProductOffers = null;

            $this->collSpyProductOfferStores = null;

            $this->collProductOfferServices = null;

            $this->collProductOfferShipmentTypes = null;

            $this->collProductOfferStocks = null;

            $this->collSpyProductOfferValidities = null;

            $this->collSpyStores = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductOffer::setDeleted()
     * @see SpyProductOffer::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductOfferQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductOfferTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductOfferTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductOfferTableMap::COL_UPDATED_AT)) {
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

                SpyProductOfferTableMap::addInstanceToPool($this);
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

            if ($this->aMerchant !== null) {
                if ($this->aMerchant->isModified() || $this->aMerchant->isNew()) {
                    $affectedRows += $this->aMerchant->save($con);
                }
                $this->setMerchant($this->aMerchant);
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

            if ($this->spyStoresScheduledForDeletion !== null) {
                if (!$this->spyStoresScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyStoresScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdProductOffer();
                        $entryPk[1] = $entry->getIdStore();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyStoresScheduledForDeletion = null;
                }

            }

            if ($this->collSpyStores) {
                foreach ($this->collSpyStores as $spyStore) {
                    if (!$spyStore->isDeleted() && ($spyStore->isNew() || $spyStore->isModified())) {
                        $spyStore->save($con);
                    }
                }
            }


            if ($this->spyPriceProductOffersScheduledForDeletion !== null) {
                if (!$this->spyPriceProductOffersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery::create()
                        ->filterByPrimaryKeys($this->spyPriceProductOffersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyPriceProductOffersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyPriceProductOffers !== null) {
                foreach ($this->collSpyPriceProductOffers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductOfferStoresScheduledForDeletion !== null) {
                if (!$this->spyProductOfferStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyProductOfferStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductOfferStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductOfferStores !== null) {
                foreach ($this->collSpyProductOfferStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productOfferServicesScheduledForDeletion !== null) {
                if (!$this->productOfferServicesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery::create()
                        ->filterByPrimaryKeys($this->productOfferServicesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productOfferServicesScheduledForDeletion = null;
                }
            }

            if ($this->collProductOfferServices !== null) {
                foreach ($this->collProductOfferServices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productOfferShipmentTypesScheduledForDeletion !== null) {
                if (!$this->productOfferShipmentTypesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery::create()
                        ->filterByPrimaryKeys($this->productOfferShipmentTypesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productOfferShipmentTypesScheduledForDeletion = null;
                }
            }

            if ($this->collProductOfferShipmentTypes !== null) {
                foreach ($this->collProductOfferShipmentTypes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productOfferStocksScheduledForDeletion !== null) {
                if (!$this->productOfferStocksScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery::create()
                        ->filterByPrimaryKeys($this->productOfferStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productOfferStocksScheduledForDeletion = null;
                }
            }

            if ($this->collProductOfferStocks !== null) {
                foreach ($this->collProductOfferStocks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductOfferValiditiesScheduledForDeletion !== null) {
                if (!$this->spyProductOfferValiditiesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery::create()
                        ->filterByPrimaryKeys($this->spyProductOfferValiditiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductOfferValiditiesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductOfferValidities !== null) {
                foreach ($this->collSpyProductOfferValidities as $referrerFK) {
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

        $this->modifiedColumns[SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER] = true;
        if (null !== $this->id_product_offer) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_offer';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_APPROVAL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'approval_status';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_CONCRETE_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'concrete_sku';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_reference';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_MERCHANT_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_sku';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'product_offer_reference';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_offer (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_offer':
                        $stmt->bindValue($identifier, $this->id_product_offer, PDO::PARAM_INT);

                        break;
                    case 'approval_status':
                        $stmt->bindValue($identifier, $this->approval_status, PDO::PARAM_STR);

                        break;
                    case 'concrete_sku':
                        $stmt->bindValue($identifier, $this->concrete_sku, PDO::PARAM_STR);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'merchant_reference':
                        $stmt->bindValue($identifier, $this->merchant_reference, PDO::PARAM_STR);

                        break;
                    case 'merchant_sku':
                        $stmt->bindValue($identifier, $this->merchant_sku, PDO::PARAM_STR);

                        break;
                    case 'product_offer_reference':
                        $stmt->bindValue($identifier, $this->product_offer_reference, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_offer_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdProductOffer($pk);

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
        $pos = SpyProductOfferTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductOffer();

            case 1:
                return $this->getApprovalStatus();

            case 2:
                return $this->getConcreteSku();

            case 3:
                return $this->getIsActive();

            case 4:
                return $this->getMerchantReference();

            case 5:
                return $this->getMerchantSku();

            case 6:
                return $this->getProductOfferReference();

            case 7:
                return $this->getCreatedAt();

            case 8:
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
        if (isset($alreadyDumpedObjects['SpyProductOffer'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductOffer'][$this->hashCode()] = true;
        $keys = SpyProductOfferTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductOffer(),
            $keys[1] => $this->getApprovalStatus(),
            $keys[2] => $this->getConcreteSku(),
            $keys[3] => $this->getIsActive(),
            $keys[4] => $this->getMerchantReference(),
            $keys[5] => $this->getMerchantSku(),
            $keys[6] => $this->getProductOfferReference(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMerchant) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchant';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant';
                        break;
                    default:
                        $key = 'Merchant';
                }

                $result[$key] = $this->aMerchant->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyPriceProductOffers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductOffers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_offers';
                        break;
                    default:
                        $key = 'SpyPriceProductOffers';
                }

                $result[$key] = $this->collSpyPriceProductOffers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductOfferStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_stores';
                        break;
                    default:
                        $key = 'SpyProductOfferStores';
                }

                $result[$key] = $this->collSpyProductOfferStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductOfferServices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferServices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_services';
                        break;
                    default:
                        $key = 'ProductOfferServices';
                }

                $result[$key] = $this->collProductOfferServices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductOfferShipmentTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferShipmentTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_shipment_types';
                        break;
                    default:
                        $key = 'ProductOfferShipmentTypes';
                }

                $result[$key] = $this->collProductOfferShipmentTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductOfferStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_stocks';
                        break;
                    default:
                        $key = 'ProductOfferStocks';
                }

                $result[$key] = $this->collProductOfferStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductOfferValidities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferValidities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_validities';
                        break;
                    default:
                        $key = 'SpyProductOfferValidities';
                }

                $result[$key] = $this->collSpyProductOfferValidities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductOfferTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductOffer($value);
                break;
            case 1:
                $this->setApprovalStatus($value);
                break;
            case 2:
                $this->setConcreteSku($value);
                break;
            case 3:
                $this->setIsActive($value);
                break;
            case 4:
                $this->setMerchantReference($value);
                break;
            case 5:
                $this->setMerchantSku($value);
                break;
            case 6:
                $this->setProductOfferReference($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = SpyProductOfferTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductOffer($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setApprovalStatus($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setConcreteSku($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsActive($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMerchantReference($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMerchantSku($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setProductOfferReference($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyProductOfferTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER)) {
            $criteria->add(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $this->id_product_offer);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_APPROVAL_STATUS)) {
            $criteria->add(SpyProductOfferTableMap::COL_APPROVAL_STATUS, $this->approval_status);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_CONCRETE_SKU)) {
            $criteria->add(SpyProductOfferTableMap::COL_CONCRETE_SKU, $this->concrete_sku);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyProductOfferTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE)) {
            $criteria->add(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE, $this->merchant_reference);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_MERCHANT_SKU)) {
            $criteria->add(SpyProductOfferTableMap::COL_MERCHANT_SKU, $this->merchant_sku);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $criteria->add(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE, $this->product_offer_reference);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductOfferTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductOfferTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductOfferTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductOfferQuery::create();
        $criteria->add(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $this->id_product_offer);

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
        $validPk = null !== $this->getIdProductOffer();

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
        return $this->getIdProductOffer();
    }

    /**
     * Generic method to set the primary key (id_product_offer column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductOffer($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductOffer();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductOffer\Persistence\SpyProductOffer (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setApprovalStatus($this->getApprovalStatus());
        $copyObj->setConcreteSku($this->getConcreteSku());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setMerchantReference($this->getMerchantReference());
        $copyObj->setMerchantSku($this->getMerchantSku());
        $copyObj->setProductOfferReference($this->getProductOfferReference());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyPriceProductOffers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyPriceProductOffer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductOfferStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductOfferStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOfferServices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOfferService($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOfferShipmentTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOfferShipmentType($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOfferStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOfferStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductOfferValidities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductOfferValidity($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductOffer(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOffer Clone of current object.
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
     * Declares an association between this object and a SpyMerchant object.
     *
     * @param SpyMerchant|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMerchant(SpyMerchant $v = null)
    {
        if ($v === null) {
            $this->setMerchantReference(NULL);
        } else {
            $this->setMerchantReference($v->getMerchantReference());
        }

        $this->aMerchant = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyMerchant object, it will not be re-added.
        if ($v !== null) {
            $v->addProductOffer($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyMerchant object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyMerchant|null The associated SpyMerchant object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchant(?ConnectionInterface $con = null)
    {
        if ($this->aMerchant === null && (($this->merchant_reference !== "" && $this->merchant_reference !== null))) {
            $this->aMerchant = SpyMerchantQuery::create()
                ->filterByProductOffer($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMerchant->addProductOffers($this);
             */
        }

        return $this->aMerchant;
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
        if ('SpyPriceProductOffer' === $relationName) {
            $this->initSpyPriceProductOffers();
            return;
        }
        if ('SpyProductOfferStore' === $relationName) {
            $this->initSpyProductOfferStores();
            return;
        }
        if ('ProductOfferService' === $relationName) {
            $this->initProductOfferServices();
            return;
        }
        if ('ProductOfferShipmentType' === $relationName) {
            $this->initProductOfferShipmentTypes();
            return;
        }
        if ('ProductOfferStock' === $relationName) {
            $this->initProductOfferStocks();
            return;
        }
        if ('SpyProductOfferValidity' === $relationName) {
            $this->initSpyProductOfferValidities();
            return;
        }
    }

    /**
     * Clears out the collSpyPriceProductOffers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyPriceProductOffers()
     */
    public function clearSpyPriceProductOffers()
    {
        $this->collSpyPriceProductOffers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyPriceProductOffers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyPriceProductOffers($v = true): void
    {
        $this->collSpyPriceProductOffersPartial = $v;
    }

    /**
     * Initializes the collSpyPriceProductOffers collection.
     *
     * By default this just sets the collSpyPriceProductOffers collection to an empty array (like clearcollSpyPriceProductOffers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyPriceProductOffers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyPriceProductOffers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductOfferTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyPriceProductOffers = new $collectionClassName;
        $this->collSpyPriceProductOffers->setModel('\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer');
    }

    /**
     * Gets an array of SpyPriceProductOffer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProductOffer[] List of SpyPriceProductOffer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductOffer> List of SpyPriceProductOffer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyPriceProductOffers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyPriceProductOffersPartial && !$this->isNew();
        if (null === $this->collSpyPriceProductOffers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyPriceProductOffers) {
                    $this->initSpyPriceProductOffers();
                } else {
                    $collectionClassName = SpyPriceProductOfferTableMap::getTableMap()->getCollectionClassName();

                    $collSpyPriceProductOffers = new $collectionClassName;
                    $collSpyPriceProductOffers->setModel('\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer');

                    return $collSpyPriceProductOffers;
                }
            } else {
                $collSpyPriceProductOffers = SpyPriceProductOfferQuery::create(null, $criteria)
                    ->filterBySpyProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyPriceProductOffersPartial && count($collSpyPriceProductOffers)) {
                        $this->initSpyPriceProductOffers(false);

                        foreach ($collSpyPriceProductOffers as $obj) {
                            if (false == $this->collSpyPriceProductOffers->contains($obj)) {
                                $this->collSpyPriceProductOffers->append($obj);
                            }
                        }

                        $this->collSpyPriceProductOffersPartial = true;
                    }

                    return $collSpyPriceProductOffers;
                }

                if ($partial && $this->collSpyPriceProductOffers) {
                    foreach ($this->collSpyPriceProductOffers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyPriceProductOffers[] = $obj;
                        }
                    }
                }

                $this->collSpyPriceProductOffers = $collSpyPriceProductOffers;
                $this->collSpyPriceProductOffersPartial = false;
            }
        }

        return $this->collSpyPriceProductOffers;
    }

    /**
     * Sets a collection of SpyPriceProductOffer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyPriceProductOffers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyPriceProductOffers(Collection $spyPriceProductOffers, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProductOffer[] $spyPriceProductOffersToDelete */
        $spyPriceProductOffersToDelete = $this->getSpyPriceProductOffers(new Criteria(), $con)->diff($spyPriceProductOffers);


        $this->spyPriceProductOffersScheduledForDeletion = $spyPriceProductOffersToDelete;

        foreach ($spyPriceProductOffersToDelete as $spyPriceProductOfferRemoved) {
            $spyPriceProductOfferRemoved->setSpyProductOffer(null);
        }

        $this->collSpyPriceProductOffers = null;
        foreach ($spyPriceProductOffers as $spyPriceProductOffer) {
            $this->addSpyPriceProductOffer($spyPriceProductOffer);
        }

        $this->collSpyPriceProductOffers = $spyPriceProductOffers;
        $this->collSpyPriceProductOffersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProductOffer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProductOffer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyPriceProductOffers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyPriceProductOffersPartial && !$this->isNew();
        if (null === $this->collSpyPriceProductOffers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyPriceProductOffers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyPriceProductOffers());
            }

            $query = SpyPriceProductOfferQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOffer($this)
                ->count($con);
        }

        return count($this->collSpyPriceProductOffers);
    }

    /**
     * Method called to associate a SpyPriceProductOffer object to this object
     * through the SpyPriceProductOffer foreign key attribute.
     *
     * @param SpyPriceProductOffer $l SpyPriceProductOffer
     * @return $this The current object (for fluent API support)
     */
    public function addSpyPriceProductOffer(SpyPriceProductOffer $l)
    {
        if ($this->collSpyPriceProductOffers === null) {
            $this->initSpyPriceProductOffers();
            $this->collSpyPriceProductOffersPartial = true;
        }

        if (!$this->collSpyPriceProductOffers->contains($l)) {
            $this->doAddSpyPriceProductOffer($l);

            if ($this->spyPriceProductOffersScheduledForDeletion and $this->spyPriceProductOffersScheduledForDeletion->contains($l)) {
                $this->spyPriceProductOffersScheduledForDeletion->remove($this->spyPriceProductOffersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProductOffer $spyPriceProductOffer The SpyPriceProductOffer object to add.
     */
    protected function doAddSpyPriceProductOffer(SpyPriceProductOffer $spyPriceProductOffer): void
    {
        $this->collSpyPriceProductOffers[]= $spyPriceProductOffer;
        $spyPriceProductOffer->setSpyProductOffer($this);
    }

    /**
     * @param SpyPriceProductOffer $spyPriceProductOffer The SpyPriceProductOffer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyPriceProductOffer(SpyPriceProductOffer $spyPriceProductOffer)
    {
        if ($this->getSpyPriceProductOffers()->contains($spyPriceProductOffer)) {
            $pos = $this->collSpyPriceProductOffers->search($spyPriceProductOffer);
            $this->collSpyPriceProductOffers->remove($pos);
            if (null === $this->spyPriceProductOffersScheduledForDeletion) {
                $this->spyPriceProductOffersScheduledForDeletion = clone $this->collSpyPriceProductOffers;
                $this->spyPriceProductOffersScheduledForDeletion->clear();
            }
            $this->spyPriceProductOffersScheduledForDeletion[]= clone $spyPriceProductOffer;
            $spyPriceProductOffer->setSpyProductOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOffer is new, it will return
     * an empty collection; or if this SpyProductOffer has previously
     * been saved, it will retrieve related SpyPriceProductOffers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOffer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductOffer[] List of SpyPriceProductOffer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductOffer}> List of SpyPriceProductOffer objects
     */
    public function getSpyPriceProductOffersJoinSpyPriceProductStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductOfferQuery::create(null, $criteria);
        $query->joinWith('SpyPriceProductStore', $joinBehavior);

        return $this->getSpyPriceProductOffers($query, $con);
    }

    /**
     * Clears out the collSpyProductOfferStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductOfferStores()
     */
    public function clearSpyProductOfferStores()
    {
        $this->collSpyProductOfferStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductOfferStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductOfferStores($v = true): void
    {
        $this->collSpyProductOfferStoresPartial = $v;
    }

    /**
     * Initializes the collSpyProductOfferStores collection.
     *
     * By default this just sets the collSpyProductOfferStores collection to an empty array (like clearcollSpyProductOfferStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductOfferStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductOfferStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOfferStores = new $collectionClassName;
        $this->collSpyProductOfferStores->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore');
    }

    /**
     * Gets an array of ChildSpyProductOfferStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductOfferStore[] List of ChildSpyProductOfferStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOfferStore> List of ChildSpyProductOfferStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductOfferStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOfferStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOfferStores) {
                    $this->initSpyProductOfferStores();
                } else {
                    $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductOfferStores = new $collectionClassName;
                    $collSpyProductOfferStores->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore');

                    return $collSpyProductOfferStores;
                }
            } else {
                $collSpyProductOfferStores = ChildSpyProductOfferStoreQuery::create(null, $criteria)
                    ->filterBySpyProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductOfferStoresPartial && count($collSpyProductOfferStores)) {
                        $this->initSpyProductOfferStores(false);

                        foreach ($collSpyProductOfferStores as $obj) {
                            if (false == $this->collSpyProductOfferStores->contains($obj)) {
                                $this->collSpyProductOfferStores->append($obj);
                            }
                        }

                        $this->collSpyProductOfferStoresPartial = true;
                    }

                    return $collSpyProductOfferStores;
                }

                if ($partial && $this->collSpyProductOfferStores) {
                    foreach ($this->collSpyProductOfferStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductOfferStores[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOfferStores = $collSpyProductOfferStores;
                $this->collSpyProductOfferStoresPartial = false;
            }
        }

        return $this->collSpyProductOfferStores;
    }

    /**
     * Sets a collection of ChildSpyProductOfferStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOfferStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOfferStores(Collection $spyProductOfferStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductOfferStore[] $spyProductOfferStoresToDelete */
        $spyProductOfferStoresToDelete = $this->getSpyProductOfferStores(new Criteria(), $con)->diff($spyProductOfferStores);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductOfferStoresScheduledForDeletion = clone $spyProductOfferStoresToDelete;

        foreach ($spyProductOfferStoresToDelete as $spyProductOfferStoreRemoved) {
            $spyProductOfferStoreRemoved->setSpyProductOffer(null);
        }

        $this->collSpyProductOfferStores = null;
        foreach ($spyProductOfferStores as $spyProductOfferStore) {
            $this->addSpyProductOfferStore($spyProductOfferStore);
        }

        $this->collSpyProductOfferStores = $spyProductOfferStores;
        $this->collSpyProductOfferStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductOfferStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductOfferStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductOfferStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOfferStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOfferStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductOfferStores());
            }

            $query = ChildSpyProductOfferStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOffer($this)
                ->count($con);
        }

        return count($this->collSpyProductOfferStores);
    }

    /**
     * Method called to associate a ChildSpyProductOfferStore object to this object
     * through the ChildSpyProductOfferStore foreign key attribute.
     *
     * @param ChildSpyProductOfferStore $l ChildSpyProductOfferStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductOfferStore(ChildSpyProductOfferStore $l)
    {
        if ($this->collSpyProductOfferStores === null) {
            $this->initSpyProductOfferStores();
            $this->collSpyProductOfferStoresPartial = true;
        }

        if (!$this->collSpyProductOfferStores->contains($l)) {
            $this->doAddSpyProductOfferStore($l);

            if ($this->spyProductOfferStoresScheduledForDeletion and $this->spyProductOfferStoresScheduledForDeletion->contains($l)) {
                $this->spyProductOfferStoresScheduledForDeletion->remove($this->spyProductOfferStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductOfferStore $spyProductOfferStore The ChildSpyProductOfferStore object to add.
     */
    protected function doAddSpyProductOfferStore(ChildSpyProductOfferStore $spyProductOfferStore): void
    {
        $this->collSpyProductOfferStores[]= $spyProductOfferStore;
        $spyProductOfferStore->setSpyProductOffer($this);
    }

    /**
     * @param ChildSpyProductOfferStore $spyProductOfferStore The ChildSpyProductOfferStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductOfferStore(ChildSpyProductOfferStore $spyProductOfferStore)
    {
        if ($this->getSpyProductOfferStores()->contains($spyProductOfferStore)) {
            $pos = $this->collSpyProductOfferStores->search($spyProductOfferStore);
            $this->collSpyProductOfferStores->remove($pos);
            if (null === $this->spyProductOfferStoresScheduledForDeletion) {
                $this->spyProductOfferStoresScheduledForDeletion = clone $this->collSpyProductOfferStores;
                $this->spyProductOfferStoresScheduledForDeletion->clear();
            }
            $this->spyProductOfferStoresScheduledForDeletion[]= clone $spyProductOfferStore;
            $spyProductOfferStore->setSpyProductOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOffer is new, it will return
     * an empty collection; or if this SpyProductOffer has previously
     * been saved, it will retrieve related SpyProductOfferStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOffer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductOfferStore[] List of ChildSpyProductOfferStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOfferStore}> List of ChildSpyProductOfferStore objects
     */
    public function getSpyProductOfferStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductOfferStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyProductOfferStores($query, $con);
    }

    /**
     * Clears out the collProductOfferServices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOfferServices()
     */
    public function clearProductOfferServices()
    {
        $this->collProductOfferServices = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOfferServices collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOfferServices($v = true): void
    {
        $this->collProductOfferServicesPartial = $v;
    }

    /**
     * Initializes the collProductOfferServices collection.
     *
     * By default this just sets the collProductOfferServices collection to an empty array (like clearcollProductOfferServices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOfferServices(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOfferServices && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferServiceTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOfferServices = new $collectionClassName;
        $this->collProductOfferServices->setModel('\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService');
    }

    /**
     * Gets an array of SpyProductOfferService objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOfferService[] List of SpyProductOfferService objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferService> List of SpyProductOfferService objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOfferServices(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOfferServicesPartial && !$this->isNew();
        if (null === $this->collProductOfferServices || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOfferServices) {
                    $this->initProductOfferServices();
                } else {
                    $collectionClassName = SpyProductOfferServiceTableMap::getTableMap()->getCollectionClassName();

                    $collProductOfferServices = new $collectionClassName;
                    $collProductOfferServices->setModel('\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService');

                    return $collProductOfferServices;
                }
            } else {
                $collProductOfferServices = SpyProductOfferServiceQuery::create(null, $criteria)
                    ->filterByProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOfferServicesPartial && count($collProductOfferServices)) {
                        $this->initProductOfferServices(false);

                        foreach ($collProductOfferServices as $obj) {
                            if (false == $this->collProductOfferServices->contains($obj)) {
                                $this->collProductOfferServices->append($obj);
                            }
                        }

                        $this->collProductOfferServicesPartial = true;
                    }

                    return $collProductOfferServices;
                }

                if ($partial && $this->collProductOfferServices) {
                    foreach ($this->collProductOfferServices as $obj) {
                        if ($obj->isNew()) {
                            $collProductOfferServices[] = $obj;
                        }
                    }
                }

                $this->collProductOfferServices = $collProductOfferServices;
                $this->collProductOfferServicesPartial = false;
            }
        }

        return $this->collProductOfferServices;
    }

    /**
     * Sets a collection of SpyProductOfferService objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOfferServices A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferServices(Collection $productOfferServices, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOfferService[] $productOfferServicesToDelete */
        $productOfferServicesToDelete = $this->getProductOfferServices(new Criteria(), $con)->diff($productOfferServices);


        $this->productOfferServicesScheduledForDeletion = $productOfferServicesToDelete;

        foreach ($productOfferServicesToDelete as $productOfferServiceRemoved) {
            $productOfferServiceRemoved->setProductOffer(null);
        }

        $this->collProductOfferServices = null;
        foreach ($productOfferServices as $productOfferService) {
            $this->addProductOfferService($productOfferService);
        }

        $this->collProductOfferServices = $productOfferServices;
        $this->collProductOfferServicesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOfferService objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOfferService objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOfferServices(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOfferServicesPartial && !$this->isNew();
        if (null === $this->collProductOfferServices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOfferServices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOfferServices());
            }

            $query = SpyProductOfferServiceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductOffer($this)
                ->count($con);
        }

        return count($this->collProductOfferServices);
    }

    /**
     * Method called to associate a SpyProductOfferService object to this object
     * through the SpyProductOfferService foreign key attribute.
     *
     * @param SpyProductOfferService $l SpyProductOfferService
     * @return $this The current object (for fluent API support)
     */
    public function addProductOfferService(SpyProductOfferService $l)
    {
        if ($this->collProductOfferServices === null) {
            $this->initProductOfferServices();
            $this->collProductOfferServicesPartial = true;
        }

        if (!$this->collProductOfferServices->contains($l)) {
            $this->doAddProductOfferService($l);

            if ($this->productOfferServicesScheduledForDeletion and $this->productOfferServicesScheduledForDeletion->contains($l)) {
                $this->productOfferServicesScheduledForDeletion->remove($this->productOfferServicesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOfferService $productOfferService The SpyProductOfferService object to add.
     */
    protected function doAddProductOfferService(SpyProductOfferService $productOfferService): void
    {
        $this->collProductOfferServices[]= $productOfferService;
        $productOfferService->setProductOffer($this);
    }

    /**
     * @param SpyProductOfferService $productOfferService The SpyProductOfferService object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOfferService(SpyProductOfferService $productOfferService)
    {
        if ($this->getProductOfferServices()->contains($productOfferService)) {
            $pos = $this->collProductOfferServices->search($productOfferService);
            $this->collProductOfferServices->remove($pos);
            if (null === $this->productOfferServicesScheduledForDeletion) {
                $this->productOfferServicesScheduledForDeletion = clone $this->collProductOfferServices;
                $this->productOfferServicesScheduledForDeletion->clear();
            }
            $this->productOfferServicesScheduledForDeletion[]= clone $productOfferService;
            $productOfferService->setProductOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOffer is new, it will return
     * an empty collection; or if this SpyProductOffer has previously
     * been saved, it will retrieve related ProductOfferServices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOffer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferService[] List of SpyProductOfferService objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferService}> List of SpyProductOfferService objects
     */
    public function getProductOfferServicesJoinService(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferServiceQuery::create(null, $criteria);
        $query->joinWith('Service', $joinBehavior);

        return $this->getProductOfferServices($query, $con);
    }

    /**
     * Clears out the collProductOfferShipmentTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOfferShipmentTypes()
     */
    public function clearProductOfferShipmentTypes()
    {
        $this->collProductOfferShipmentTypes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOfferShipmentTypes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOfferShipmentTypes($v = true): void
    {
        $this->collProductOfferShipmentTypesPartial = $v;
    }

    /**
     * Initializes the collProductOfferShipmentTypes collection.
     *
     * By default this just sets the collProductOfferShipmentTypes collection to an empty array (like clearcollProductOfferShipmentTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOfferShipmentTypes(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOfferShipmentTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferShipmentTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOfferShipmentTypes = new $collectionClassName;
        $this->collProductOfferShipmentTypes->setModel('\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType');
    }

    /**
     * Gets an array of SpyProductOfferShipmentType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOfferShipmentType[] List of SpyProductOfferShipmentType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferShipmentType> List of SpyProductOfferShipmentType objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOfferShipmentTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOfferShipmentTypesPartial && !$this->isNew();
        if (null === $this->collProductOfferShipmentTypes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOfferShipmentTypes) {
                    $this->initProductOfferShipmentTypes();
                } else {
                    $collectionClassName = SpyProductOfferShipmentTypeTableMap::getTableMap()->getCollectionClassName();

                    $collProductOfferShipmentTypes = new $collectionClassName;
                    $collProductOfferShipmentTypes->setModel('\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType');

                    return $collProductOfferShipmentTypes;
                }
            } else {
                $collProductOfferShipmentTypes = SpyProductOfferShipmentTypeQuery::create(null, $criteria)
                    ->filterByProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOfferShipmentTypesPartial && count($collProductOfferShipmentTypes)) {
                        $this->initProductOfferShipmentTypes(false);

                        foreach ($collProductOfferShipmentTypes as $obj) {
                            if (false == $this->collProductOfferShipmentTypes->contains($obj)) {
                                $this->collProductOfferShipmentTypes->append($obj);
                            }
                        }

                        $this->collProductOfferShipmentTypesPartial = true;
                    }

                    return $collProductOfferShipmentTypes;
                }

                if ($partial && $this->collProductOfferShipmentTypes) {
                    foreach ($this->collProductOfferShipmentTypes as $obj) {
                        if ($obj->isNew()) {
                            $collProductOfferShipmentTypes[] = $obj;
                        }
                    }
                }

                $this->collProductOfferShipmentTypes = $collProductOfferShipmentTypes;
                $this->collProductOfferShipmentTypesPartial = false;
            }
        }

        return $this->collProductOfferShipmentTypes;
    }

    /**
     * Sets a collection of SpyProductOfferShipmentType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOfferShipmentTypes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferShipmentTypes(Collection $productOfferShipmentTypes, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOfferShipmentType[] $productOfferShipmentTypesToDelete */
        $productOfferShipmentTypesToDelete = $this->getProductOfferShipmentTypes(new Criteria(), $con)->diff($productOfferShipmentTypes);


        $this->productOfferShipmentTypesScheduledForDeletion = $productOfferShipmentTypesToDelete;

        foreach ($productOfferShipmentTypesToDelete as $productOfferShipmentTypeRemoved) {
            $productOfferShipmentTypeRemoved->setProductOffer(null);
        }

        $this->collProductOfferShipmentTypes = null;
        foreach ($productOfferShipmentTypes as $productOfferShipmentType) {
            $this->addProductOfferShipmentType($productOfferShipmentType);
        }

        $this->collProductOfferShipmentTypes = $productOfferShipmentTypes;
        $this->collProductOfferShipmentTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOfferShipmentType objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOfferShipmentType objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOfferShipmentTypes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOfferShipmentTypesPartial && !$this->isNew();
        if (null === $this->collProductOfferShipmentTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOfferShipmentTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOfferShipmentTypes());
            }

            $query = SpyProductOfferShipmentTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductOffer($this)
                ->count($con);
        }

        return count($this->collProductOfferShipmentTypes);
    }

    /**
     * Method called to associate a SpyProductOfferShipmentType object to this object
     * through the SpyProductOfferShipmentType foreign key attribute.
     *
     * @param SpyProductOfferShipmentType $l SpyProductOfferShipmentType
     * @return $this The current object (for fluent API support)
     */
    public function addProductOfferShipmentType(SpyProductOfferShipmentType $l)
    {
        if ($this->collProductOfferShipmentTypes === null) {
            $this->initProductOfferShipmentTypes();
            $this->collProductOfferShipmentTypesPartial = true;
        }

        if (!$this->collProductOfferShipmentTypes->contains($l)) {
            $this->doAddProductOfferShipmentType($l);

            if ($this->productOfferShipmentTypesScheduledForDeletion and $this->productOfferShipmentTypesScheduledForDeletion->contains($l)) {
                $this->productOfferShipmentTypesScheduledForDeletion->remove($this->productOfferShipmentTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOfferShipmentType $productOfferShipmentType The SpyProductOfferShipmentType object to add.
     */
    protected function doAddProductOfferShipmentType(SpyProductOfferShipmentType $productOfferShipmentType): void
    {
        $this->collProductOfferShipmentTypes[]= $productOfferShipmentType;
        $productOfferShipmentType->setProductOffer($this);
    }

    /**
     * @param SpyProductOfferShipmentType $productOfferShipmentType The SpyProductOfferShipmentType object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOfferShipmentType(SpyProductOfferShipmentType $productOfferShipmentType)
    {
        if ($this->getProductOfferShipmentTypes()->contains($productOfferShipmentType)) {
            $pos = $this->collProductOfferShipmentTypes->search($productOfferShipmentType);
            $this->collProductOfferShipmentTypes->remove($pos);
            if (null === $this->productOfferShipmentTypesScheduledForDeletion) {
                $this->productOfferShipmentTypesScheduledForDeletion = clone $this->collProductOfferShipmentTypes;
                $this->productOfferShipmentTypesScheduledForDeletion->clear();
            }
            $this->productOfferShipmentTypesScheduledForDeletion[]= clone $productOfferShipmentType;
            $productOfferShipmentType->setProductOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOffer is new, it will return
     * an empty collection; or if this SpyProductOffer has previously
     * been saved, it will retrieve related ProductOfferShipmentTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOffer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferShipmentType[] List of SpyProductOfferShipmentType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferShipmentType}> List of SpyProductOfferShipmentType objects
     */
    public function getProductOfferShipmentTypesJoinShipmentType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferShipmentTypeQuery::create(null, $criteria);
        $query->joinWith('ShipmentType', $joinBehavior);

        return $this->getProductOfferShipmentTypes($query, $con);
    }

    /**
     * Clears out the collProductOfferStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOfferStocks()
     */
    public function clearProductOfferStocks()
    {
        $this->collProductOfferStocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOfferStocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOfferStocks($v = true): void
    {
        $this->collProductOfferStocksPartial = $v;
    }

    /**
     * Initializes the collProductOfferStocks collection.
     *
     * By default this just sets the collProductOfferStocks collection to an empty array (like clearcollProductOfferStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOfferStocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOfferStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferStockTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOfferStocks = new $collectionClassName;
        $this->collProductOfferStocks->setModel('\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock');
    }

    /**
     * Gets an array of SpyProductOfferStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOfferStock[] List of SpyProductOfferStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferStock> List of SpyProductOfferStock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOfferStocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOfferStocksPartial && !$this->isNew();
        if (null === $this->collProductOfferStocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOfferStocks) {
                    $this->initProductOfferStocks();
                } else {
                    $collectionClassName = SpyProductOfferStockTableMap::getTableMap()->getCollectionClassName();

                    $collProductOfferStocks = new $collectionClassName;
                    $collProductOfferStocks->setModel('\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock');

                    return $collProductOfferStocks;
                }
            } else {
                $collProductOfferStocks = SpyProductOfferStockQuery::create(null, $criteria)
                    ->filterBySpyProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOfferStocksPartial && count($collProductOfferStocks)) {
                        $this->initProductOfferStocks(false);

                        foreach ($collProductOfferStocks as $obj) {
                            if (false == $this->collProductOfferStocks->contains($obj)) {
                                $this->collProductOfferStocks->append($obj);
                            }
                        }

                        $this->collProductOfferStocksPartial = true;
                    }

                    return $collProductOfferStocks;
                }

                if ($partial && $this->collProductOfferStocks) {
                    foreach ($this->collProductOfferStocks as $obj) {
                        if ($obj->isNew()) {
                            $collProductOfferStocks[] = $obj;
                        }
                    }
                }

                $this->collProductOfferStocks = $collProductOfferStocks;
                $this->collProductOfferStocksPartial = false;
            }
        }

        return $this->collProductOfferStocks;
    }

    /**
     * Sets a collection of SpyProductOfferStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOfferStocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferStocks(Collection $productOfferStocks, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOfferStock[] $productOfferStocksToDelete */
        $productOfferStocksToDelete = $this->getProductOfferStocks(new Criteria(), $con)->diff($productOfferStocks);


        $this->productOfferStocksScheduledForDeletion = $productOfferStocksToDelete;

        foreach ($productOfferStocksToDelete as $productOfferStockRemoved) {
            $productOfferStockRemoved->setSpyProductOffer(null);
        }

        $this->collProductOfferStocks = null;
        foreach ($productOfferStocks as $productOfferStock) {
            $this->addProductOfferStock($productOfferStock);
        }

        $this->collProductOfferStocks = $productOfferStocks;
        $this->collProductOfferStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOfferStock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOfferStock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOfferStocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOfferStocksPartial && !$this->isNew();
        if (null === $this->collProductOfferStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOfferStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOfferStocks());
            }

            $query = SpyProductOfferStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOffer($this)
                ->count($con);
        }

        return count($this->collProductOfferStocks);
    }

    /**
     * Method called to associate a SpyProductOfferStock object to this object
     * through the SpyProductOfferStock foreign key attribute.
     *
     * @param SpyProductOfferStock $l SpyProductOfferStock
     * @return $this The current object (for fluent API support)
     */
    public function addProductOfferStock(SpyProductOfferStock $l)
    {
        if ($this->collProductOfferStocks === null) {
            $this->initProductOfferStocks();
            $this->collProductOfferStocksPartial = true;
        }

        if (!$this->collProductOfferStocks->contains($l)) {
            $this->doAddProductOfferStock($l);

            if ($this->productOfferStocksScheduledForDeletion and $this->productOfferStocksScheduledForDeletion->contains($l)) {
                $this->productOfferStocksScheduledForDeletion->remove($this->productOfferStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOfferStock $productOfferStock The SpyProductOfferStock object to add.
     */
    protected function doAddProductOfferStock(SpyProductOfferStock $productOfferStock): void
    {
        $this->collProductOfferStocks[]= $productOfferStock;
        $productOfferStock->setSpyProductOffer($this);
    }

    /**
     * @param SpyProductOfferStock $productOfferStock The SpyProductOfferStock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOfferStock(SpyProductOfferStock $productOfferStock)
    {
        if ($this->getProductOfferStocks()->contains($productOfferStock)) {
            $pos = $this->collProductOfferStocks->search($productOfferStock);
            $this->collProductOfferStocks->remove($pos);
            if (null === $this->productOfferStocksScheduledForDeletion) {
                $this->productOfferStocksScheduledForDeletion = clone $this->collProductOfferStocks;
                $this->productOfferStocksScheduledForDeletion->clear();
            }
            $this->productOfferStocksScheduledForDeletion[]= clone $productOfferStock;
            $productOfferStock->setSpyProductOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOffer is new, it will return
     * an empty collection; or if this SpyProductOffer has previously
     * been saved, it will retrieve related ProductOfferStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOffer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferStock[] List of SpyProductOfferStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferStock}> List of SpyProductOfferStock objects
     */
    public function getProductOfferStocksJoinStock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferStockQuery::create(null, $criteria);
        $query->joinWith('Stock', $joinBehavior);

        return $this->getProductOfferStocks($query, $con);
    }

    /**
     * Clears out the collSpyProductOfferValidities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductOfferValidities()
     */
    public function clearSpyProductOfferValidities()
    {
        $this->collSpyProductOfferValidities = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductOfferValidities collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductOfferValidities($v = true): void
    {
        $this->collSpyProductOfferValiditiesPartial = $v;
    }

    /**
     * Initializes the collSpyProductOfferValidities collection.
     *
     * By default this just sets the collSpyProductOfferValidities collection to an empty array (like clearcollSpyProductOfferValidities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductOfferValidities(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductOfferValidities && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferValidityTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOfferValidities = new $collectionClassName;
        $this->collSpyProductOfferValidities->setModel('\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity');
    }

    /**
     * Gets an array of SpyProductOfferValidity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOfferValidity[] List of SpyProductOfferValidity objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferValidity> List of SpyProductOfferValidity objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductOfferValidities(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOfferValiditiesPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferValidities || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOfferValidities) {
                    $this->initSpyProductOfferValidities();
                } else {
                    $collectionClassName = SpyProductOfferValidityTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductOfferValidities = new $collectionClassName;
                    $collSpyProductOfferValidities->setModel('\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity');

                    return $collSpyProductOfferValidities;
                }
            } else {
                $collSpyProductOfferValidities = SpyProductOfferValidityQuery::create(null, $criteria)
                    ->filterBySpyProductOffer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductOfferValiditiesPartial && count($collSpyProductOfferValidities)) {
                        $this->initSpyProductOfferValidities(false);

                        foreach ($collSpyProductOfferValidities as $obj) {
                            if (false == $this->collSpyProductOfferValidities->contains($obj)) {
                                $this->collSpyProductOfferValidities->append($obj);
                            }
                        }

                        $this->collSpyProductOfferValiditiesPartial = true;
                    }

                    return $collSpyProductOfferValidities;
                }

                if ($partial && $this->collSpyProductOfferValidities) {
                    foreach ($this->collSpyProductOfferValidities as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductOfferValidities[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOfferValidities = $collSpyProductOfferValidities;
                $this->collSpyProductOfferValiditiesPartial = false;
            }
        }

        return $this->collSpyProductOfferValidities;
    }

    /**
     * Sets a collection of SpyProductOfferValidity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOfferValidities A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOfferValidities(Collection $spyProductOfferValidities, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOfferValidity[] $spyProductOfferValiditiesToDelete */
        $spyProductOfferValiditiesToDelete = $this->getSpyProductOfferValidities(new Criteria(), $con)->diff($spyProductOfferValidities);


        $this->spyProductOfferValiditiesScheduledForDeletion = $spyProductOfferValiditiesToDelete;

        foreach ($spyProductOfferValiditiesToDelete as $spyProductOfferValidityRemoved) {
            $spyProductOfferValidityRemoved->setSpyProductOffer(null);
        }

        $this->collSpyProductOfferValidities = null;
        foreach ($spyProductOfferValidities as $spyProductOfferValidity) {
            $this->addSpyProductOfferValidity($spyProductOfferValidity);
        }

        $this->collSpyProductOfferValidities = $spyProductOfferValidities;
        $this->collSpyProductOfferValiditiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOfferValidity objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOfferValidity objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductOfferValidities(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOfferValiditiesPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferValidities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOfferValidities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductOfferValidities());
            }

            $query = SpyProductOfferValidityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOffer($this)
                ->count($con);
        }

        return count($this->collSpyProductOfferValidities);
    }

    /**
     * Method called to associate a SpyProductOfferValidity object to this object
     * through the SpyProductOfferValidity foreign key attribute.
     *
     * @param SpyProductOfferValidity $l SpyProductOfferValidity
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductOfferValidity(SpyProductOfferValidity $l)
    {
        if ($this->collSpyProductOfferValidities === null) {
            $this->initSpyProductOfferValidities();
            $this->collSpyProductOfferValiditiesPartial = true;
        }

        if (!$this->collSpyProductOfferValidities->contains($l)) {
            $this->doAddSpyProductOfferValidity($l);

            if ($this->spyProductOfferValiditiesScheduledForDeletion and $this->spyProductOfferValiditiesScheduledForDeletion->contains($l)) {
                $this->spyProductOfferValiditiesScheduledForDeletion->remove($this->spyProductOfferValiditiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOfferValidity $spyProductOfferValidity The SpyProductOfferValidity object to add.
     */
    protected function doAddSpyProductOfferValidity(SpyProductOfferValidity $spyProductOfferValidity): void
    {
        $this->collSpyProductOfferValidities[]= $spyProductOfferValidity;
        $spyProductOfferValidity->setSpyProductOffer($this);
    }

    /**
     * @param SpyProductOfferValidity $spyProductOfferValidity The SpyProductOfferValidity object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductOfferValidity(SpyProductOfferValidity $spyProductOfferValidity)
    {
        if ($this->getSpyProductOfferValidities()->contains($spyProductOfferValidity)) {
            $pos = $this->collSpyProductOfferValidities->search($spyProductOfferValidity);
            $this->collSpyProductOfferValidities->remove($pos);
            if (null === $this->spyProductOfferValiditiesScheduledForDeletion) {
                $this->spyProductOfferValiditiesScheduledForDeletion = clone $this->collSpyProductOfferValidities;
                $this->spyProductOfferValiditiesScheduledForDeletion->clear();
            }
            $this->spyProductOfferValiditiesScheduledForDeletion[]= clone $spyProductOfferValidity;
            $spyProductOfferValidity->setSpyProductOffer(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyStores()
     */
    public function clearSpyStores()
    {
        $this->collSpyStores = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyStores crossRef collection.
     *
     * By default this just sets the collSpyStores collection to an empty collection (like clearSpyStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyStores()
    {
        $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyStores = new $collectionClassName;
        $this->collSpyStoresPartial = true;
        $this->collSpyStores->setModel('\Orm\Zed\Store\Persistence\SpyStore');
    }

    /**
     * Checks if the collSpyStores collection is loaded.
     *
     * @return bool
     */
    public function isSpyStoresLoaded(): bool
    {
        return null !== $this->collSpyStores;
    }

    /**
     * Gets a collection of SpyStore objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOffer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyStore[] List of SpyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStore> List of SpyStore objects
     */
    public function getSpyStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyStoresPartial && !$this->isNew();
        if (null === $this->collSpyStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyStores) {
                    $this->initSpyStores();
                }
            } else {

                $query = SpyStoreQuery::create(null, $criteria)
                    ->filterBySpyProductOffer($this);
                $collSpyStores = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyStores;
                }

                if ($partial && $this->collSpyStores) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyStores as $obj) {
                        if (!$collSpyStores->contains($obj)) {
                            $collSpyStores[] = $obj;
                        }
                    }
                }

                $this->collSpyStores = $collSpyStores;
                $this->collSpyStoresPartial = false;
            }
        }

        return $this->collSpyStores;
    }

    /**
     * Sets a collection of SpyStore objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyStores(Collection $spyStores, ?ConnectionInterface $con = null)
    {
        $this->clearSpyStores();
        $currentSpyStores = $this->getSpyStores();

        $spyStoresScheduledForDeletion = $currentSpyStores->diff($spyStores);

        foreach ($spyStoresScheduledForDeletion as $toDelete) {
            $this->removeSpyStore($toDelete);
        }

        foreach ($spyStores as $spyStore) {
            if (!$currentSpyStores->contains($spyStore)) {
                $this->doAddSpyStore($spyStore);
            }
        }

        $this->collSpyStoresPartial = false;
        $this->collSpyStores = $spyStores;

        return $this;
    }

    /**
     * Gets the number of SpyStore objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyStore objects
     */
    public function countSpyStores(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyStoresPartial && !$this->isNew();
        if (null === $this->collSpyStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyStores) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyStores());
                }

                $query = SpyStoreQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyProductOffer($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyStores);
        }
    }

    /**
     * Associate a SpyStore to this object
     * through the spy_product_offer_store cross reference table.
     *
     * @param SpyStore $spyStore
     * @return ChildSpyProductOffer The current object (for fluent API support)
     */
    public function addSpyStore(SpyStore $spyStore)
    {
        if ($this->collSpyStores === null) {
            $this->initSpyStores();
        }

        if (!$this->getSpyStores()->contains($spyStore)) {
            // only add it if the **same** object is not already associated
            $this->collSpyStores->push($spyStore);
            $this->doAddSpyStore($spyStore);
        }

        return $this;
    }

    /**
     *
     * @param SpyStore $spyStore
     */
    protected function doAddSpyStore(SpyStore $spyStore)
    {
        $spyProductOfferStore = new ChildSpyProductOfferStore();

        $spyProductOfferStore->setSpyStore($spyStore);

        $spyProductOfferStore->setSpyProductOffer($this);

        $this->addSpyProductOfferStore($spyProductOfferStore);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyStore->isSpyProductOffersLoaded()) {
            $spyStore->initSpyProductOffers();
            $spyStore->getSpyProductOffers()->push($this);
        } elseif (!$spyStore->getSpyProductOffers()->contains($this)) {
            $spyStore->getSpyProductOffers()->push($this);
        }

    }

    /**
     * Remove spyStore of this object
     * through the spy_product_offer_store cross reference table.
     *
     * @param SpyStore $spyStore
     * @return ChildSpyProductOffer The current object (for fluent API support)
     */
    public function removeSpyStore(SpyStore $spyStore)
    {
        if ($this->getSpyStores()->contains($spyStore)) {
            $spyProductOfferStore = new ChildSpyProductOfferStore();
            $spyProductOfferStore->setSpyStore($spyStore);
            if ($spyStore->isSpyProductOffersLoaded()) {
                //remove the back reference if available
                $spyStore->getSpyProductOffers()->removeObject($this);
            }

            $spyProductOfferStore->setSpyProductOffer($this);
            $this->removeSpyProductOfferStore(clone $spyProductOfferStore);
            $spyProductOfferStore->clear();

            $this->collSpyStores->remove($this->collSpyStores->search($spyStore));

            if (null === $this->spyStoresScheduledForDeletion) {
                $this->spyStoresScheduledForDeletion = clone $this->collSpyStores;
                $this->spyStoresScheduledForDeletion->clear();
            }

            $this->spyStoresScheduledForDeletion->push($spyStore);
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
        if (null !== $this->aMerchant) {
            $this->aMerchant->removeProductOffer($this);
        }
        $this->id_product_offer = null;
        $this->approval_status = null;
        $this->concrete_sku = null;
        $this->is_active = null;
        $this->merchant_reference = null;
        $this->merchant_sku = null;
        $this->product_offer_reference = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collSpyPriceProductOffers) {
                foreach ($this->collSpyPriceProductOffers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOfferStores) {
                foreach ($this->collSpyProductOfferStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOfferServices) {
                foreach ($this->collProductOfferServices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOfferShipmentTypes) {
                foreach ($this->collProductOfferShipmentTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOfferStocks) {
                foreach ($this->collProductOfferStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOfferValidities) {
                foreach ($this->collSpyProductOfferValidities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyStores) {
                foreach ($this->collSpyStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyPriceProductOffers = null;
        $this->collSpyProductOfferStores = null;
        $this->collProductOfferServices = null;
        $this->collProductOfferShipmentTypes = null;
        $this->collProductOfferStocks = null;
        $this->collSpyProductOfferValidities = null;
        $this->collSpyStores = null;
        $this->aMerchant = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductOfferTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductOfferTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_offer.create';
        } else {
            $this->_eventName = 'Entity.spy_product_offer.update';
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

        if ($this->_eventName !== 'Entity.spy_product_offer.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_offer',
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
            'name' => 'spy_product_offer',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_offer.delete',
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
            $field = str_replace('spy_product_offer.', '', $modifiedColumn);
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
                'spy_product_offer.product_offer_reference',
        'spy_product_offer.concrete_sku',
        ];
    }

    /**
     * @return array
     */
    protected function getAdditionalValues(): array
    {
        $additionalValues = [];
        foreach ($this->getAdditionalValueColumnNames() as $additionalValueColumnName) {
            $field = str_replace('spy_product_offer.', '', $additionalValueColumnName);
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
        $columnType = SpyProductOfferTableMap::getTableMap()->getColumn($column)->getType();
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
