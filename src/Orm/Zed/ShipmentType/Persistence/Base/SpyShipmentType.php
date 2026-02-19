<?php

namespace Orm\Zed\ShipmentType\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery;
use Orm\Zed\ProductOfferShipmentType\Persistence\Base\SpyProductOfferShipmentType as BaseSpyProductOfferShipmentType;
use Orm\Zed\ProductOfferShipmentType\Persistence\Map\SpyProductOfferShipmentTypeTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType;
use Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpyProductShipmentType as BaseSpyProductShipmentType;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpyProductShipmentTypeTableMap;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\Base\SpyShipmentTypeServiceType as BaseSpyShipmentTypeServiceType;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\Map\SpyShipmentTypeServiceTypeTableMap;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentType as ChildSpyShipmentType;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery as ChildSpyShipmentTypeQuery;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore as ChildSpyShipmentTypeStore;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery as ChildSpyShipmentTypeStoreQuery;
use Orm\Zed\ShipmentType\Persistence\Map\SpyShipmentTypeStoreTableMap;
use Orm\Zed\ShipmentType\Persistence\Map\SpyShipmentTypeTableMap;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethod;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery;
use Orm\Zed\Shipment\Persistence\Base\SpyShipmentMethod as BaseSpyShipmentMethod;
use Orm\Zed\Shipment\Persistence\Map\SpyShipmentMethodTableMap;
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
 * Base class that represents a row from the 'spy_shipment_type' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ShipmentType.Persistence.Base
 */
abstract class SpyShipmentType implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ShipmentType\\Persistence\\Map\\SpyShipmentTypeTableMap';


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
     * The value for the id_shipment_type field.
     *
     * @var        int
     */
    protected $id_shipment_type;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
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
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * @var        ObjectCollection|SpyProductOfferShipmentType[] Collection to store aggregation of SpyProductOfferShipmentType objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferShipmentType> Collection to store aggregation of SpyProductOfferShipmentType objects.
     */
    protected $collProductOfferShipmentTypes;
    protected $collProductOfferShipmentTypesPartial;

    /**
     * @var        ObjectCollection|SpyProductShipmentType[] Collection to store aggregation of SpyProductShipmentType objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductShipmentType> Collection to store aggregation of SpyProductShipmentType objects.
     */
    protected $collSpyProductShipmentTypes;
    protected $collSpyProductShipmentTypesPartial;

    /**
     * @var        ObjectCollection|SpyShipmentMethod[] Collection to store aggregation of SpyShipmentMethod objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethod> Collection to store aggregation of SpyShipmentMethod objects.
     */
    protected $collShipmentMethods;
    protected $collShipmentMethodsPartial;

    /**
     * @var        ObjectCollection|ChildSpyShipmentTypeStore[] Collection to store aggregation of ChildSpyShipmentTypeStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShipmentTypeStore> Collection to store aggregation of ChildSpyShipmentTypeStore objects.
     */
    protected $collShipmentTypeStores;
    protected $collShipmentTypeStoresPartial;

    /**
     * @var        ObjectCollection|SpyShipmentTypeServiceType[] Collection to store aggregation of SpyShipmentTypeServiceType objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentTypeServiceType> Collection to store aggregation of SpyShipmentTypeServiceType objects.
     */
    protected $collSpyShipmentTypeServiceTypes;
    protected $collSpyShipmentTypeServiceTypesPartial;

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
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProduct[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProduct>
     */
    protected $spyProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferShipmentType[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferShipmentType>
     */
    protected $productOfferShipmentTypesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductShipmentType[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductShipmentType>
     */
    protected $spyProductShipmentTypesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShipmentMethod[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethod>
     */
    protected $shipmentMethodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyShipmentTypeStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyShipmentTypeStore>
     */
    protected $shipmentTypeStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShipmentTypeServiceType[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentTypeServiceType>
     */
    protected $spyShipmentTypeServiceTypesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ShipmentType\Persistence\Base\SpyShipmentType object.
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
     * Compares this with another <code>SpyShipmentType</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyShipmentType</code>, delegates to
     * <code>equals(SpyShipmentType)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_shipment_type] column value.
     *
     * @return int
     */
    public function getIdShipmentType()
    {
        return $this->id_shipment_type;
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
     * A unique key used to identify an entity or a piece of data.
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
     * Get the [uuid] column value.
     * A Universally Unique Identifier for an entity.
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of [id_shipment_type] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdShipmentType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_shipment_type !== $v) {
            $this->id_shipment_type = $v;
            $this->modifiedColumns[SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE] = true;
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
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyShipmentTypeTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * A unique key used to identify an entity or a piece of data.
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
            $this->modifiedColumns[SpyShipmentTypeTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyShipmentTypeTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[SpyShipmentTypeTableMap::COL_UUID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyShipmentTypeTableMap::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shipment_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyShipmentTypeTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyShipmentTypeTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyShipmentTypeTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyShipmentTypeTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyShipmentTypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyShipmentTypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collProductOfferShipmentTypes = null;

            $this->collSpyProductShipmentTypes = null;

            $this->collShipmentMethods = null;

            $this->collShipmentTypeStores = null;

            $this->collSpyShipmentTypeServiceTypes = null;

            $this->collSpyProducts = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyShipmentType::setDeleted()
     * @see SpyShipmentType::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyShipmentTypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
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

                SpyShipmentTypeTableMap::addInstanceToPool($this);
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

            if ($this->spyProductsScheduledForDeletion !== null) {
                if (!$this->spyProductsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdShipmentType();
                        $entryPk[0] = $entry->getIdProduct();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery::create()
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

            if ($this->spyProductShipmentTypesScheduledForDeletion !== null) {
                if (!$this->spyProductShipmentTypesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery::create()
                        ->filterByPrimaryKeys($this->spyProductShipmentTypesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductShipmentTypesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductShipmentTypes !== null) {
                foreach ($this->collSpyProductShipmentTypes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shipmentMethodsScheduledForDeletion !== null) {
                if (!$this->shipmentMethodsScheduledForDeletion->isEmpty()) {
                    foreach ($this->shipmentMethodsScheduledForDeletion as $shipmentMethod) {
                        // need to save related object because we set the relation to null
                        $shipmentMethod->save($con);
                    }
                    $this->shipmentMethodsScheduledForDeletion = null;
                }
            }

            if ($this->collShipmentMethods !== null) {
                foreach ($this->collShipmentMethods as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shipmentTypeStoresScheduledForDeletion !== null) {
                if (!$this->shipmentTypeStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery::create()
                        ->filterByPrimaryKeys($this->shipmentTypeStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shipmentTypeStoresScheduledForDeletion = null;
                }
            }

            if ($this->collShipmentTypeStores !== null) {
                foreach ($this->collShipmentTypeStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShipmentTypeServiceTypesScheduledForDeletion !== null) {
                if (!$this->spyShipmentTypeServiceTypesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery::create()
                        ->filterByPrimaryKeys($this->spyShipmentTypeServiceTypesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShipmentTypeServiceTypesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShipmentTypeServiceTypes !== null) {
                foreach ($this->collSpyShipmentTypeServiceTypes as $referrerFK) {
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

        $this->modifiedColumns[SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`id_shipment_type`';
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_shipment_type` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_shipment_type`':
                        $stmt->bindValue($identifier, $this->id_shipment_type, PDO::PARAM_INT);

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
                    case '`uuid`':
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
            $pk = $con->lastInsertId('spy_shipment_type_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdShipmentType($pk);
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
        $pos = SpyShipmentTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdShipmentType();

            case 1:
                return $this->getIsActive();

            case 2:
                return $this->getKey();

            case 3:
                return $this->getName();

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
        if (isset($alreadyDumpedObjects['SpyShipmentType'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyShipmentType'][$this->hashCode()] = true;
        $keys = SpyShipmentTypeTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdShipmentType(),
            $keys[1] => $this->getIsActive(),
            $keys[2] => $this->getKey(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getUuid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collSpyProductShipmentTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductShipmentTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_shipment_types';
                        break;
                    default:
                        $key = 'SpyProductShipmentTypes';
                }

                $result[$key] = $this->collSpyProductShipmentTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShipmentMethods) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentMethods';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_methods';
                        break;
                    default:
                        $key = 'ShipmentMethods';
                }

                $result[$key] = $this->collShipmentMethods->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShipmentTypeStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentTypeStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_type_stores';
                        break;
                    default:
                        $key = 'ShipmentTypeStores';
                }

                $result[$key] = $this->collShipmentTypeStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShipmentTypeServiceTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentTypeServiceTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_type_service_types';
                        break;
                    default:
                        $key = 'SpyShipmentTypeServiceTypes';
                }

                $result[$key] = $this->collSpyShipmentTypeServiceTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyShipmentTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdShipmentType($value);
                break;
            case 1:
                $this->setIsActive($value);
                break;
            case 2:
                $this->setKey($value);
                break;
            case 3:
                $this->setName($value);
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
        $keys = SpyShipmentTypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdShipmentType($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
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
        $criteria = new Criteria(SpyShipmentTypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE)) {
            $criteria->add(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $this->id_shipment_type);
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyShipmentTypeTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_KEY)) {
            $criteria->add(SpyShipmentTypeTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_NAME)) {
            $criteria->add(SpyShipmentTypeTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyShipmentTypeTableMap::COL_UUID)) {
            $criteria->add(SpyShipmentTypeTableMap::COL_UUID, $this->uuid);
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
        $criteria = ChildSpyShipmentTypeQuery::create();
        $criteria->add(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $this->id_shipment_type);

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
        $validPk = null !== $this->getIdShipmentType();

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
        return $this->getIdShipmentType();
    }

    /**
     * Generic method to set the primary key (id_shipment_type column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdShipmentType($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdShipmentType();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ShipmentType\Persistence\SpyShipmentType (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setUuid($this->getUuid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductOfferShipmentTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOfferShipmentType($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductShipmentTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductShipmentType($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShipmentMethods() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShipmentMethod($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShipmentTypeStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShipmentTypeStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShipmentTypeServiceTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShipmentTypeServiceType($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdShipmentType(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentType Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('ProductOfferShipmentType' === $relationName) {
            $this->initProductOfferShipmentTypes();
            return;
        }
        if ('SpyProductShipmentType' === $relationName) {
            $this->initSpyProductShipmentTypes();
            return;
        }
        if ('ShipmentMethod' === $relationName) {
            $this->initShipmentMethods();
            return;
        }
        if ('ShipmentTypeStore' === $relationName) {
            $this->initShipmentTypeStores();
            return;
        }
        if ('SpyShipmentTypeServiceType' === $relationName) {
            $this->initSpyShipmentTypeServiceTypes();
            return;
        }
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
     * If this ChildSpyShipmentType is new, it will return
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
                    ->filterByShipmentType($this)
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
            $productOfferShipmentTypeRemoved->setShipmentType(null);
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
                ->filterByShipmentType($this)
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
        $productOfferShipmentType->setShipmentType($this);
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
            $productOfferShipmentType->setShipmentType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related ProductOfferShipmentTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferShipmentType[] List of SpyProductOfferShipmentType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferShipmentType}> List of SpyProductOfferShipmentType objects
     */
    public function getProductOfferShipmentTypesJoinProductOffer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferShipmentTypeQuery::create(null, $criteria);
        $query->joinWith('ProductOffer', $joinBehavior);

        return $this->getProductOfferShipmentTypes($query, $con);
    }

    /**
     * Clears out the collSpyProductShipmentTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductShipmentTypes()
     */
    public function clearSpyProductShipmentTypes()
    {
        $this->collSpyProductShipmentTypes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductShipmentTypes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductShipmentTypes($v = true): void
    {
        $this->collSpyProductShipmentTypesPartial = $v;
    }

    /**
     * Initializes the collSpyProductShipmentTypes collection.
     *
     * By default this just sets the collSpyProductShipmentTypes collection to an empty array (like clearcollSpyProductShipmentTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductShipmentTypes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductShipmentTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductShipmentTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductShipmentTypes = new $collectionClassName;
        $this->collSpyProductShipmentTypes->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType');
    }

    /**
     * Gets an array of SpyProductShipmentType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShipmentType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductShipmentType[] List of SpyProductShipmentType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductShipmentType> List of SpyProductShipmentType objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductShipmentTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductShipmentTypesPartial && !$this->isNew();
        if (null === $this->collSpyProductShipmentTypes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductShipmentTypes) {
                    $this->initSpyProductShipmentTypes();
                } else {
                    $collectionClassName = SpyProductShipmentTypeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductShipmentTypes = new $collectionClassName;
                    $collSpyProductShipmentTypes->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType');

                    return $collSpyProductShipmentTypes;
                }
            } else {
                $collSpyProductShipmentTypes = SpyProductShipmentTypeQuery::create(null, $criteria)
                    ->filterBySpyShipmentType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductShipmentTypesPartial && count($collSpyProductShipmentTypes)) {
                        $this->initSpyProductShipmentTypes(false);

                        foreach ($collSpyProductShipmentTypes as $obj) {
                            if (false == $this->collSpyProductShipmentTypes->contains($obj)) {
                                $this->collSpyProductShipmentTypes->append($obj);
                            }
                        }

                        $this->collSpyProductShipmentTypesPartial = true;
                    }

                    return $collSpyProductShipmentTypes;
                }

                if ($partial && $this->collSpyProductShipmentTypes) {
                    foreach ($this->collSpyProductShipmentTypes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductShipmentTypes[] = $obj;
                        }
                    }
                }

                $this->collSpyProductShipmentTypes = $collSpyProductShipmentTypes;
                $this->collSpyProductShipmentTypesPartial = false;
            }
        }

        return $this->collSpyProductShipmentTypes;
    }

    /**
     * Sets a collection of SpyProductShipmentType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductShipmentTypes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductShipmentTypes(Collection $spyProductShipmentTypes, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductShipmentType[] $spyProductShipmentTypesToDelete */
        $spyProductShipmentTypesToDelete = $this->getSpyProductShipmentTypes(new Criteria(), $con)->diff($spyProductShipmentTypes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductShipmentTypesScheduledForDeletion = clone $spyProductShipmentTypesToDelete;

        foreach ($spyProductShipmentTypesToDelete as $spyProductShipmentTypeRemoved) {
            $spyProductShipmentTypeRemoved->setSpyShipmentType(null);
        }

        $this->collSpyProductShipmentTypes = null;
        foreach ($spyProductShipmentTypes as $spyProductShipmentType) {
            $this->addSpyProductShipmentType($spyProductShipmentType);
        }

        $this->collSpyProductShipmentTypes = $spyProductShipmentTypes;
        $this->collSpyProductShipmentTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductShipmentType objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductShipmentType objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductShipmentTypes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductShipmentTypesPartial && !$this->isNew();
        if (null === $this->collSpyProductShipmentTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductShipmentTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductShipmentTypes());
            }

            $query = SpyProductShipmentTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShipmentType($this)
                ->count($con);
        }

        return count($this->collSpyProductShipmentTypes);
    }

    /**
     * Method called to associate a SpyProductShipmentType object to this object
     * through the SpyProductShipmentType foreign key attribute.
     *
     * @param SpyProductShipmentType $l SpyProductShipmentType
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductShipmentType(SpyProductShipmentType $l)
    {
        if ($this->collSpyProductShipmentTypes === null) {
            $this->initSpyProductShipmentTypes();
            $this->collSpyProductShipmentTypesPartial = true;
        }

        if (!$this->collSpyProductShipmentTypes->contains($l)) {
            $this->doAddSpyProductShipmentType($l);

            if ($this->spyProductShipmentTypesScheduledForDeletion and $this->spyProductShipmentTypesScheduledForDeletion->contains($l)) {
                $this->spyProductShipmentTypesScheduledForDeletion->remove($this->spyProductShipmentTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductShipmentType $spyProductShipmentType The SpyProductShipmentType object to add.
     */
    protected function doAddSpyProductShipmentType(SpyProductShipmentType $spyProductShipmentType): void
    {
        $this->collSpyProductShipmentTypes[]= $spyProductShipmentType;
        $spyProductShipmentType->setSpyShipmentType($this);
    }

    /**
     * @param SpyProductShipmentType $spyProductShipmentType The SpyProductShipmentType object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductShipmentType(SpyProductShipmentType $spyProductShipmentType)
    {
        if ($this->getSpyProductShipmentTypes()->contains($spyProductShipmentType)) {
            $pos = $this->collSpyProductShipmentTypes->search($spyProductShipmentType);
            $this->collSpyProductShipmentTypes->remove($pos);
            if (null === $this->spyProductShipmentTypesScheduledForDeletion) {
                $this->spyProductShipmentTypesScheduledForDeletion = clone $this->collSpyProductShipmentTypes;
                $this->spyProductShipmentTypesScheduledForDeletion->clear();
            }
            $this->spyProductShipmentTypesScheduledForDeletion[]= clone $spyProductShipmentType;
            $spyProductShipmentType->setSpyShipmentType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related SpyProductShipmentTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductShipmentType[] List of SpyProductShipmentType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductShipmentType}> List of SpyProductShipmentType objects
     */
    public function getSpyProductShipmentTypesJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductShipmentTypeQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductShipmentTypes($query, $con);
    }

    /**
     * Clears out the collShipmentMethods collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShipmentMethods()
     */
    public function clearShipmentMethods()
    {
        $this->collShipmentMethods = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShipmentMethods collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShipmentMethods($v = true): void
    {
        $this->collShipmentMethodsPartial = $v;
    }

    /**
     * Initializes the collShipmentMethods collection.
     *
     * By default this just sets the collShipmentMethods collection to an empty array (like clearcollShipmentMethods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShipmentMethods(bool $overrideExisting = true): void
    {
        if (null !== $this->collShipmentMethods && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentMethodTableMap::getTableMap()->getCollectionClassName();

        $this->collShipmentMethods = new $collectionClassName;
        $this->collShipmentMethods->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethod');
    }

    /**
     * Gets an array of SpyShipmentMethod objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShipmentType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShipmentMethod[] List of SpyShipmentMethod objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethod> List of SpyShipmentMethod objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShipmentMethods(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShipmentMethodsPartial && !$this->isNew();
        if (null === $this->collShipmentMethods || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShipmentMethods) {
                    $this->initShipmentMethods();
                } else {
                    $collectionClassName = SpyShipmentMethodTableMap::getTableMap()->getCollectionClassName();

                    $collShipmentMethods = new $collectionClassName;
                    $collShipmentMethods->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethod');

                    return $collShipmentMethods;
                }
            } else {
                $collShipmentMethods = SpyShipmentMethodQuery::create(null, $criteria)
                    ->filterByShipmentType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShipmentMethodsPartial && count($collShipmentMethods)) {
                        $this->initShipmentMethods(false);

                        foreach ($collShipmentMethods as $obj) {
                            if (false == $this->collShipmentMethods->contains($obj)) {
                                $this->collShipmentMethods->append($obj);
                            }
                        }

                        $this->collShipmentMethodsPartial = true;
                    }

                    return $collShipmentMethods;
                }

                if ($partial && $this->collShipmentMethods) {
                    foreach ($this->collShipmentMethods as $obj) {
                        if ($obj->isNew()) {
                            $collShipmentMethods[] = $obj;
                        }
                    }
                }

                $this->collShipmentMethods = $collShipmentMethods;
                $this->collShipmentMethodsPartial = false;
            }
        }

        return $this->collShipmentMethods;
    }

    /**
     * Sets a collection of SpyShipmentMethod objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shipmentMethods A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShipmentMethods(Collection $shipmentMethods, ?ConnectionInterface $con = null)
    {
        /** @var SpyShipmentMethod[] $shipmentMethodsToDelete */
        $shipmentMethodsToDelete = $this->getShipmentMethods(new Criteria(), $con)->diff($shipmentMethods);


        $this->shipmentMethodsScheduledForDeletion = $shipmentMethodsToDelete;

        foreach ($shipmentMethodsToDelete as $shipmentMethodRemoved) {
            $shipmentMethodRemoved->setShipmentType(null);
        }

        $this->collShipmentMethods = null;
        foreach ($shipmentMethods as $shipmentMethod) {
            $this->addShipmentMethod($shipmentMethod);
        }

        $this->collShipmentMethods = $shipmentMethods;
        $this->collShipmentMethodsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShipmentMethod objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShipmentMethod objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShipmentMethods(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShipmentMethodsPartial && !$this->isNew();
        if (null === $this->collShipmentMethods || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShipmentMethods) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShipmentMethods());
            }

            $query = SpyShipmentMethodQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByShipmentType($this)
                ->count($con);
        }

        return count($this->collShipmentMethods);
    }

    /**
     * Method called to associate a SpyShipmentMethod object to this object
     * through the SpyShipmentMethod foreign key attribute.
     *
     * @param SpyShipmentMethod $l SpyShipmentMethod
     * @return $this The current object (for fluent API support)
     */
    public function addShipmentMethod(SpyShipmentMethod $l)
    {
        if ($this->collShipmentMethods === null) {
            $this->initShipmentMethods();
            $this->collShipmentMethodsPartial = true;
        }

        if (!$this->collShipmentMethods->contains($l)) {
            $this->doAddShipmentMethod($l);

            if ($this->shipmentMethodsScheduledForDeletion and $this->shipmentMethodsScheduledForDeletion->contains($l)) {
                $this->shipmentMethodsScheduledForDeletion->remove($this->shipmentMethodsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShipmentMethod $shipmentMethod The SpyShipmentMethod object to add.
     */
    protected function doAddShipmentMethod(SpyShipmentMethod $shipmentMethod): void
    {
        $this->collShipmentMethods[]= $shipmentMethod;
        $shipmentMethod->setShipmentType($this);
    }

    /**
     * @param SpyShipmentMethod $shipmentMethod The SpyShipmentMethod object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShipmentMethod(SpyShipmentMethod $shipmentMethod)
    {
        if ($this->getShipmentMethods()->contains($shipmentMethod)) {
            $pos = $this->collShipmentMethods->search($shipmentMethod);
            $this->collShipmentMethods->remove($pos);
            if (null === $this->shipmentMethodsScheduledForDeletion) {
                $this->shipmentMethodsScheduledForDeletion = clone $this->collShipmentMethods;
                $this->shipmentMethodsScheduledForDeletion->clear();
            }
            $this->shipmentMethodsScheduledForDeletion[]= $shipmentMethod;
            $shipmentMethod->setShipmentType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related ShipmentMethods from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentMethod[] List of SpyShipmentMethod objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethod}> List of SpyShipmentMethod objects
     */
    public function getShipmentMethodsJoinShipmentCarrier(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentMethodQuery::create(null, $criteria);
        $query->joinWith('ShipmentCarrier', $joinBehavior);

        return $this->getShipmentMethods($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related ShipmentMethods from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentMethod[] List of SpyShipmentMethod objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethod}> List of SpyShipmentMethod objects
     */
    public function getShipmentMethodsJoinTaxSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentMethodQuery::create(null, $criteria);
        $query->joinWith('TaxSet', $joinBehavior);

        return $this->getShipmentMethods($query, $con);
    }

    /**
     * Clears out the collShipmentTypeStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShipmentTypeStores()
     */
    public function clearShipmentTypeStores()
    {
        $this->collShipmentTypeStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShipmentTypeStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShipmentTypeStores($v = true): void
    {
        $this->collShipmentTypeStoresPartial = $v;
    }

    /**
     * Initializes the collShipmentTypeStores collection.
     *
     * By default this just sets the collShipmentTypeStores collection to an empty array (like clearcollShipmentTypeStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShipmentTypeStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collShipmentTypeStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentTypeStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collShipmentTypeStores = new $collectionClassName;
        $this->collShipmentTypeStores->setModel('\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore');
    }

    /**
     * Gets an array of ChildSpyShipmentTypeStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShipmentType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyShipmentTypeStore[] List of ChildSpyShipmentTypeStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShipmentTypeStore> List of ChildSpyShipmentTypeStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShipmentTypeStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShipmentTypeStoresPartial && !$this->isNew();
        if (null === $this->collShipmentTypeStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShipmentTypeStores) {
                    $this->initShipmentTypeStores();
                } else {
                    $collectionClassName = SpyShipmentTypeStoreTableMap::getTableMap()->getCollectionClassName();

                    $collShipmentTypeStores = new $collectionClassName;
                    $collShipmentTypeStores->setModel('\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore');

                    return $collShipmentTypeStores;
                }
            } else {
                $collShipmentTypeStores = ChildSpyShipmentTypeStoreQuery::create(null, $criteria)
                    ->filterByShipmentType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShipmentTypeStoresPartial && count($collShipmentTypeStores)) {
                        $this->initShipmentTypeStores(false);

                        foreach ($collShipmentTypeStores as $obj) {
                            if (false == $this->collShipmentTypeStores->contains($obj)) {
                                $this->collShipmentTypeStores->append($obj);
                            }
                        }

                        $this->collShipmentTypeStoresPartial = true;
                    }

                    return $collShipmentTypeStores;
                }

                if ($partial && $this->collShipmentTypeStores) {
                    foreach ($this->collShipmentTypeStores as $obj) {
                        if ($obj->isNew()) {
                            $collShipmentTypeStores[] = $obj;
                        }
                    }
                }

                $this->collShipmentTypeStores = $collShipmentTypeStores;
                $this->collShipmentTypeStoresPartial = false;
            }
        }

        return $this->collShipmentTypeStores;
    }

    /**
     * Sets a collection of ChildSpyShipmentTypeStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shipmentTypeStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShipmentTypeStores(Collection $shipmentTypeStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyShipmentTypeStore[] $shipmentTypeStoresToDelete */
        $shipmentTypeStoresToDelete = $this->getShipmentTypeStores(new Criteria(), $con)->diff($shipmentTypeStores);


        $this->shipmentTypeStoresScheduledForDeletion = $shipmentTypeStoresToDelete;

        foreach ($shipmentTypeStoresToDelete as $shipmentTypeStoreRemoved) {
            $shipmentTypeStoreRemoved->setShipmentType(null);
        }

        $this->collShipmentTypeStores = null;
        foreach ($shipmentTypeStores as $shipmentTypeStore) {
            $this->addShipmentTypeStore($shipmentTypeStore);
        }

        $this->collShipmentTypeStores = $shipmentTypeStores;
        $this->collShipmentTypeStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyShipmentTypeStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyShipmentTypeStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShipmentTypeStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShipmentTypeStoresPartial && !$this->isNew();
        if (null === $this->collShipmentTypeStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShipmentTypeStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShipmentTypeStores());
            }

            $query = ChildSpyShipmentTypeStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByShipmentType($this)
                ->count($con);
        }

        return count($this->collShipmentTypeStores);
    }

    /**
     * Method called to associate a ChildSpyShipmentTypeStore object to this object
     * through the ChildSpyShipmentTypeStore foreign key attribute.
     *
     * @param ChildSpyShipmentTypeStore $l ChildSpyShipmentTypeStore
     * @return $this The current object (for fluent API support)
     */
    public function addShipmentTypeStore(ChildSpyShipmentTypeStore $l)
    {
        if ($this->collShipmentTypeStores === null) {
            $this->initShipmentTypeStores();
            $this->collShipmentTypeStoresPartial = true;
        }

        if (!$this->collShipmentTypeStores->contains($l)) {
            $this->doAddShipmentTypeStore($l);

            if ($this->shipmentTypeStoresScheduledForDeletion and $this->shipmentTypeStoresScheduledForDeletion->contains($l)) {
                $this->shipmentTypeStoresScheduledForDeletion->remove($this->shipmentTypeStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyShipmentTypeStore $shipmentTypeStore The ChildSpyShipmentTypeStore object to add.
     */
    protected function doAddShipmentTypeStore(ChildSpyShipmentTypeStore $shipmentTypeStore): void
    {
        $this->collShipmentTypeStores[]= $shipmentTypeStore;
        $shipmentTypeStore->setShipmentType($this);
    }

    /**
     * @param ChildSpyShipmentTypeStore $shipmentTypeStore The ChildSpyShipmentTypeStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShipmentTypeStore(ChildSpyShipmentTypeStore $shipmentTypeStore)
    {
        if ($this->getShipmentTypeStores()->contains($shipmentTypeStore)) {
            $pos = $this->collShipmentTypeStores->search($shipmentTypeStore);
            $this->collShipmentTypeStores->remove($pos);
            if (null === $this->shipmentTypeStoresScheduledForDeletion) {
                $this->shipmentTypeStoresScheduledForDeletion = clone $this->collShipmentTypeStores;
                $this->shipmentTypeStoresScheduledForDeletion->clear();
            }
            $this->shipmentTypeStoresScheduledForDeletion[]= clone $shipmentTypeStore;
            $shipmentTypeStore->setShipmentType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related ShipmentTypeStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyShipmentTypeStore[] List of ChildSpyShipmentTypeStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyShipmentTypeStore}> List of ChildSpyShipmentTypeStore objects
     */
    public function getShipmentTypeStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyShipmentTypeStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getShipmentTypeStores($query, $con);
    }

    /**
     * Clears out the collSpyShipmentTypeServiceTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShipmentTypeServiceTypes()
     */
    public function clearSpyShipmentTypeServiceTypes()
    {
        $this->collSpyShipmentTypeServiceTypes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShipmentTypeServiceTypes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShipmentTypeServiceTypes($v = true): void
    {
        $this->collSpyShipmentTypeServiceTypesPartial = $v;
    }

    /**
     * Initializes the collSpyShipmentTypeServiceTypes collection.
     *
     * By default this just sets the collSpyShipmentTypeServiceTypes collection to an empty array (like clearcollSpyShipmentTypeServiceTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShipmentTypeServiceTypes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShipmentTypeServiceTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentTypeServiceTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShipmentTypeServiceTypes = new $collectionClassName;
        $this->collSpyShipmentTypeServiceTypes->setModel('\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType');
    }

    /**
     * Gets an array of SpyShipmentTypeServiceType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShipmentType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShipmentTypeServiceType[] List of SpyShipmentTypeServiceType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentTypeServiceType> List of SpyShipmentTypeServiceType objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShipmentTypeServiceTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShipmentTypeServiceTypesPartial && !$this->isNew();
        if (null === $this->collSpyShipmentTypeServiceTypes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShipmentTypeServiceTypes) {
                    $this->initSpyShipmentTypeServiceTypes();
                } else {
                    $collectionClassName = SpyShipmentTypeServiceTypeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShipmentTypeServiceTypes = new $collectionClassName;
                    $collSpyShipmentTypeServiceTypes->setModel('\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType');

                    return $collSpyShipmentTypeServiceTypes;
                }
            } else {
                $collSpyShipmentTypeServiceTypes = SpyShipmentTypeServiceTypeQuery::create(null, $criteria)
                    ->filterBySpyShipmentType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShipmentTypeServiceTypesPartial && count($collSpyShipmentTypeServiceTypes)) {
                        $this->initSpyShipmentTypeServiceTypes(false);

                        foreach ($collSpyShipmentTypeServiceTypes as $obj) {
                            if (false == $this->collSpyShipmentTypeServiceTypes->contains($obj)) {
                                $this->collSpyShipmentTypeServiceTypes->append($obj);
                            }
                        }

                        $this->collSpyShipmentTypeServiceTypesPartial = true;
                    }

                    return $collSpyShipmentTypeServiceTypes;
                }

                if ($partial && $this->collSpyShipmentTypeServiceTypes) {
                    foreach ($this->collSpyShipmentTypeServiceTypes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShipmentTypeServiceTypes[] = $obj;
                        }
                    }
                }

                $this->collSpyShipmentTypeServiceTypes = $collSpyShipmentTypeServiceTypes;
                $this->collSpyShipmentTypeServiceTypesPartial = false;
            }
        }

        return $this->collSpyShipmentTypeServiceTypes;
    }

    /**
     * Sets a collection of SpyShipmentTypeServiceType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShipmentTypeServiceTypes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShipmentTypeServiceTypes(Collection $spyShipmentTypeServiceTypes, ?ConnectionInterface $con = null)
    {
        /** @var SpyShipmentTypeServiceType[] $spyShipmentTypeServiceTypesToDelete */
        $spyShipmentTypeServiceTypesToDelete = $this->getSpyShipmentTypeServiceTypes(new Criteria(), $con)->diff($spyShipmentTypeServiceTypes);


        $this->spyShipmentTypeServiceTypesScheduledForDeletion = $spyShipmentTypeServiceTypesToDelete;

        foreach ($spyShipmentTypeServiceTypesToDelete as $spyShipmentTypeServiceTypeRemoved) {
            $spyShipmentTypeServiceTypeRemoved->setSpyShipmentType(null);
        }

        $this->collSpyShipmentTypeServiceTypes = null;
        foreach ($spyShipmentTypeServiceTypes as $spyShipmentTypeServiceType) {
            $this->addSpyShipmentTypeServiceType($spyShipmentTypeServiceType);
        }

        $this->collSpyShipmentTypeServiceTypes = $spyShipmentTypeServiceTypes;
        $this->collSpyShipmentTypeServiceTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShipmentTypeServiceType objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShipmentTypeServiceType objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShipmentTypeServiceTypes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShipmentTypeServiceTypesPartial && !$this->isNew();
        if (null === $this->collSpyShipmentTypeServiceTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShipmentTypeServiceTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShipmentTypeServiceTypes());
            }

            $query = SpyShipmentTypeServiceTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShipmentType($this)
                ->count($con);
        }

        return count($this->collSpyShipmentTypeServiceTypes);
    }

    /**
     * Method called to associate a SpyShipmentTypeServiceType object to this object
     * through the SpyShipmentTypeServiceType foreign key attribute.
     *
     * @param SpyShipmentTypeServiceType $l SpyShipmentTypeServiceType
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShipmentTypeServiceType(SpyShipmentTypeServiceType $l)
    {
        if ($this->collSpyShipmentTypeServiceTypes === null) {
            $this->initSpyShipmentTypeServiceTypes();
            $this->collSpyShipmentTypeServiceTypesPartial = true;
        }

        if (!$this->collSpyShipmentTypeServiceTypes->contains($l)) {
            $this->doAddSpyShipmentTypeServiceType($l);

            if ($this->spyShipmentTypeServiceTypesScheduledForDeletion and $this->spyShipmentTypeServiceTypesScheduledForDeletion->contains($l)) {
                $this->spyShipmentTypeServiceTypesScheduledForDeletion->remove($this->spyShipmentTypeServiceTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShipmentTypeServiceType $spyShipmentTypeServiceType The SpyShipmentTypeServiceType object to add.
     */
    protected function doAddSpyShipmentTypeServiceType(SpyShipmentTypeServiceType $spyShipmentTypeServiceType): void
    {
        $this->collSpyShipmentTypeServiceTypes[]= $spyShipmentTypeServiceType;
        $spyShipmentTypeServiceType->setSpyShipmentType($this);
    }

    /**
     * @param SpyShipmentTypeServiceType $spyShipmentTypeServiceType The SpyShipmentTypeServiceType object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShipmentTypeServiceType(SpyShipmentTypeServiceType $spyShipmentTypeServiceType)
    {
        if ($this->getSpyShipmentTypeServiceTypes()->contains($spyShipmentTypeServiceType)) {
            $pos = $this->collSpyShipmentTypeServiceTypes->search($spyShipmentTypeServiceType);
            $this->collSpyShipmentTypeServiceTypes->remove($pos);
            if (null === $this->spyShipmentTypeServiceTypesScheduledForDeletion) {
                $this->spyShipmentTypeServiceTypesScheduledForDeletion = clone $this->collSpyShipmentTypeServiceTypes;
                $this->spyShipmentTypeServiceTypesScheduledForDeletion->clear();
            }
            $this->spyShipmentTypeServiceTypesScheduledForDeletion[]= clone $spyShipmentTypeServiceType;
            $spyShipmentTypeServiceType->setSpyShipmentType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShipmentType is new, it will return
     * an empty collection; or if this SpyShipmentType has previously
     * been saved, it will retrieve related SpyShipmentTypeServiceTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShipmentType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentTypeServiceType[] List of SpyShipmentTypeServiceType objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentTypeServiceType}> List of SpyShipmentTypeServiceType objects
     */
    public function getSpyShipmentTypeServiceTypesJoinSpyServiceType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentTypeServiceTypeQuery::create(null, $criteria);
        $query->joinWith('SpyServiceType', $joinBehavior);

        return $this->getSpyShipmentTypeServiceTypes($query, $con);
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
        $collectionClassName = SpyProductShipmentTypeTableMap::getTableMap()->getCollectionClassName();

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
     * to the current object by way of the spy_product_shipment_type cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShipmentType is new, it will return
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
                    ->filterBySpyShipmentType($this);
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
     * to the current object by way of the spy_product_shipment_type cross-reference table.
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
     * to the current object by way of the spy_product_shipment_type cross-reference table.
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
                    ->filterBySpyShipmentType($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProducts);
        }
    }

    /**
     * Associate a SpyProduct to this object
     * through the spy_product_shipment_type cross reference table.
     *
     * @param SpyProduct $spyProduct
     * @return ChildSpyShipmentType The current object (for fluent API support)
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
        $spyProductShipmentType = new SpyProductShipmentType();

        $spyProductShipmentType->setSpyProduct($spyProduct);

        $spyProductShipmentType->setSpyShipmentType($this);

        $this->addSpyProductShipmentType($spyProductShipmentType);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProduct->isSpyShipmentTypesLoaded()) {
            $spyProduct->initSpyShipmentTypes();
            $spyProduct->getSpyShipmentTypes()->push($this);
        } elseif (!$spyProduct->getSpyShipmentTypes()->contains($this)) {
            $spyProduct->getSpyShipmentTypes()->push($this);
        }

    }

    /**
     * Remove spyProduct of this object
     * through the spy_product_shipment_type cross reference table.
     *
     * @param SpyProduct $spyProduct
     * @return ChildSpyShipmentType The current object (for fluent API support)
     */
    public function removeSpyProduct(SpyProduct $spyProduct)
    {
        if ($this->getSpyProducts()->contains($spyProduct)) {
            $spyProductShipmentType = new SpyProductShipmentType();
            $spyProductShipmentType->setSpyProduct($spyProduct);
            if ($spyProduct->isSpyShipmentTypesLoaded()) {
                //remove the back reference if available
                $spyProduct->getSpyShipmentTypes()->removeObject($this);
            }

            $spyProductShipmentType->setSpyShipmentType($this);
            $this->removeSpyProductShipmentType(clone $spyProductShipmentType);
            $spyProductShipmentType->clear();

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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->id_shipment_type = null;
        $this->is_active = null;
        $this->key = null;
        $this->name = null;
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
            if ($this->collProductOfferShipmentTypes) {
                foreach ($this->collProductOfferShipmentTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductShipmentTypes) {
                foreach ($this->collSpyProductShipmentTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShipmentMethods) {
                foreach ($this->collShipmentMethods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShipmentTypeStores) {
                foreach ($this->collShipmentTypeStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShipmentTypeServiceTypes) {
                foreach ($this->collSpyShipmentTypeServiceTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProducts) {
                foreach ($this->collSpyProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductOfferShipmentTypes = null;
        $this->collSpyProductShipmentTypes = null;
        $this->collShipmentMethods = null;
        $this->collShipmentTypeStores = null;
        $this->collSpyShipmentTypeServiceTypes = null;
        $this->collSpyProducts = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyShipmentTypeTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_shipment_type' . '.' . $this->getIdShipmentType();
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
            $this->_eventName = 'Entity.spy_shipment_type.create';
        } else {
            $this->_eventName = 'Entity.spy_shipment_type.update';
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

        if ($this->_eventName !== 'Entity.spy_shipment_type.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_shipment_type',
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
            'name' => 'spy_shipment_type',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_shipment_type.delete',
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
            $field = str_replace('spy_shipment_type.', '', $modifiedColumn);
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
            $field = str_replace('spy_shipment_type.', '', $additionalValueColumnName);
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
        $columnType = SpyShipmentTypeTableMap::getTableMap()->getColumn($column)->getType();
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
