<?php

namespace Orm\Zed\Stock\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStock;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery;
use Orm\Zed\MerchantStock\Persistence\Base\SpyMerchantStock as BaseSpyMerchantStock;
use Orm\Zed\MerchantStock\Persistence\Map\SpyMerchantStockTableMap;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery;
use Orm\Zed\ProductOfferStock\Persistence\Base\SpyProductOfferStock as BaseSpyProductOfferStock;
use Orm\Zed\ProductOfferStock\Persistence\Map\SpyProductOfferStockTableMap;
use Orm\Zed\StockAddress\Persistence\SpyStockAddress;
use Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery;
use Orm\Zed\StockAddress\Persistence\Base\SpyStockAddress as BaseSpyStockAddress;
use Orm\Zed\StockAddress\Persistence\Map\SpyStockAddressTableMap;
use Orm\Zed\Stock\Persistence\SpyStock as ChildSpyStock;
use Orm\Zed\Stock\Persistence\SpyStockProduct as ChildSpyStockProduct;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery as ChildSpyStockProductQuery;
use Orm\Zed\Stock\Persistence\SpyStockQuery as ChildSpyStockQuery;
use Orm\Zed\Stock\Persistence\SpyStockStore as ChildSpyStockStore;
use Orm\Zed\Stock\Persistence\SpyStockStoreQuery as ChildSpyStockStoreQuery;
use Orm\Zed\Stock\Persistence\Map\SpyStockProductTableMap;
use Orm\Zed\Stock\Persistence\Map\SpyStockStoreTableMap;
use Orm\Zed\Stock\Persistence\Map\SpyStockTableMap;
use Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocation;
use Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocationQuery;
use Orm\Zed\WarehouseAllocation\Persistence\Base\SpyWarehouseAllocation as BaseSpyWarehouseAllocation;
use Orm\Zed\WarehouseAllocation\Persistence\Map\SpyWarehouseAllocationTableMap;
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
 * Base class that represents a row from the 'spy_stock' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Stock.Persistence.Base
 */
abstract class SpyStock implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Stock\\Persistence\\Map\\SpyStockTableMap';


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
     * The value for the id_stock field.
     *
     * @var        int
     */
    protected $id_stock;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * @var        ObjectCollection|SpyMerchantStock[] Collection to store aggregation of SpyMerchantStock objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStock> Collection to store aggregation of SpyMerchantStock objects.
     */
    protected $collSpyMerchantStocks;
    protected $collSpyMerchantStocksPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferStock[] Collection to store aggregation of SpyProductOfferStock objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStock> Collection to store aggregation of SpyProductOfferStock objects.
     */
    protected $collProductOfferStocks;
    protected $collProductOfferStocksPartial;

    /**
     * @var        ObjectCollection|ChildSpyStockProduct[] Collection to store aggregation of ChildSpyStockProduct objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStockProduct> Collection to store aggregation of ChildSpyStockProduct objects.
     */
    protected $collStockProducts;
    protected $collStockProductsPartial;

    /**
     * @var        ObjectCollection|ChildSpyStockStore[] Collection to store aggregation of ChildSpyStockStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStockStore> Collection to store aggregation of ChildSpyStockStore objects.
     */
    protected $collStockStores;
    protected $collStockStoresPartial;

    /**
     * @var        ObjectCollection|SpyStockAddress[] Collection to store aggregation of SpyStockAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStockAddress> Collection to store aggregation of SpyStockAddress objects.
     */
    protected $collStockAddresses;
    protected $collStockAddressesPartial;

    /**
     * @var        ObjectCollection|SpyWarehouseAllocation[] Collection to store aggregation of SpyWarehouseAllocation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyWarehouseAllocation> Collection to store aggregation of SpyWarehouseAllocation objects.
     */
    protected $collWarehouseAllocations;
    protected $collWarehouseAllocationsPartial;

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
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantStock[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStock>
     */
    protected $spyMerchantStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferStock[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStock>
     */
    protected $productOfferStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyStockProduct[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStockProduct>
     */
    protected $stockProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyStockStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyStockStore>
     */
    protected $stockStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStockAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStockAddress>
     */
    protected $stockAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyWarehouseAllocation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyWarehouseAllocation>
     */
    protected $warehouseAllocationsScheduledForDeletion = null;

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
     * Initializes internal state of Orm\Zed\Stock\Persistence\Base\SpyStock object.
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
     * Compares this with another <code>SpyStock</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyStock</code>, delegates to
     * <code>equals(SpyStock)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_stock] column value.
     *
     * @return int
     */
    public function getIdStock()
    {
        return $this->id_stock;
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
     * Get the [name] column value.
     * The name of an entity (e.g., user, category, product, role).
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of [id_stock] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdStock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_stock !== $v) {
            $this->id_stock = $v;
            $this->modifiedColumns[SpyStockTableMap::COL_ID_STOCK] = true;
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
        $this->_initialValues[SpyStockTableMap::COL_IS_ACTIVE] = $this->is_active;

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
            $this->modifiedColumns[SpyStockTableMap::COL_IS_ACTIVE] = true;
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
            $this->modifiedColumns[SpyStockTableMap::COL_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyStockTableMap::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_stock = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyStockTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyStockTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyStockTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Stock\\Persistence\\SpyStock'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyStockTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyStockQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyMerchantStocks = null;

            $this->collProductOfferStocks = null;

            $this->collStockProducts = null;

            $this->collStockStores = null;

            $this->collStockAddresses = null;

            $this->collWarehouseAllocations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyStock::setDeleted()
     * @see SpyStock::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyStockQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockTableMap::DATABASE_NAME);
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

                SpyStockTableMap::addInstanceToPool($this);
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

            if ($this->spyMerchantStocksScheduledForDeletion !== null) {
                if (!$this->spyMerchantStocksScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantStocksScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantStocks !== null) {
                foreach ($this->collSpyMerchantStocks as $referrerFK) {
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

            if ($this->stockProductsScheduledForDeletion !== null) {
                if (!$this->stockProductsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Stock\Persistence\SpyStockProductQuery::create()
                        ->filterByPrimaryKeys($this->stockProductsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockProductsScheduledForDeletion = null;
                }
            }

            if ($this->collStockProducts !== null) {
                foreach ($this->collStockProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockStoresScheduledForDeletion !== null) {
                if (!$this->stockStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Stock\Persistence\SpyStockStoreQuery::create()
                        ->filterByPrimaryKeys($this->stockStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockStoresScheduledForDeletion = null;
                }
            }

            if ($this->collStockStores !== null) {
                foreach ($this->collStockStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockAddressesScheduledForDeletion !== null) {
                if (!$this->stockAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery::create()
                        ->filterByPrimaryKeys($this->stockAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collStockAddresses !== null) {
                foreach ($this->collStockAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->warehouseAllocationsScheduledForDeletion !== null) {
                if (!$this->warehouseAllocationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocationQuery::create()
                        ->filterByPrimaryKeys($this->warehouseAllocationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->warehouseAllocationsScheduledForDeletion = null;
                }
            }

            if ($this->collWarehouseAllocations !== null) {
                foreach ($this->collWarehouseAllocations as $referrerFK) {
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

        $this->modifiedColumns[SpyStockTableMap::COL_ID_STOCK] = true;
        if (null !== $this->id_stock) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyStockTableMap::COL_ID_STOCK . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyStockTableMap::COL_ID_STOCK)) {
            $modifiedColumns[':p' . $index++]  = 'id_stock';
        }
        if ($this->isColumnModified(SpyStockTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyStockTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }

        $sql = sprintf(
            'INSERT INTO spy_stock (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_stock':
                        $stmt->bindValue($identifier, $this->id_stock, PDO::PARAM_INT);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_stock_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdStock($pk);

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
        $pos = SpyStockTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdStock();

            case 1:
                return $this->getIsActive();

            case 2:
                return $this->getName();

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
        if (isset($alreadyDumpedObjects['SpyStock'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyStock'][$this->hashCode()] = true;
        $keys = SpyStockTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdStock(),
            $keys[1] => $this->getIsActive(),
            $keys[2] => $this->getName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyMerchantStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_stocks';
                        break;
                    default:
                        $key = 'SpyMerchantStocks';
                }

                $result[$key] = $this->collSpyMerchantStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collStockProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStockProducts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stock_products';
                        break;
                    default:
                        $key = 'StockProducts';
                }

                $result[$key] = $this->collStockProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStockStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stock_stores';
                        break;
                    default:
                        $key = 'StockStores';
                }

                $result[$key] = $this->collStockStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStockAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stock_addresses';
                        break;
                    default:
                        $key = 'StockAddresses';
                }

                $result[$key] = $this->collStockAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWarehouseAllocations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyWarehouseAllocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_warehouse_allocations';
                        break;
                    default:
                        $key = 'WarehouseAllocations';
                }

                $result[$key] = $this->collWarehouseAllocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyStockTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdStock($value);
                break;
            case 1:
                $this->setIsActive($value);
                break;
            case 2:
                $this->setName($value);
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
        $keys = SpyStockTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdStock($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyStockTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyStockTableMap::COL_ID_STOCK)) {
            $criteria->add(SpyStockTableMap::COL_ID_STOCK, $this->id_stock);
        }
        if ($this->isColumnModified(SpyStockTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyStockTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyStockTableMap::COL_NAME)) {
            $criteria->add(SpyStockTableMap::COL_NAME, $this->name);
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
        $criteria = ChildSpyStockQuery::create();
        $criteria->add(SpyStockTableMap::COL_ID_STOCK, $this->id_stock);

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
        $validPk = null !== $this->getIdStock();

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
        return $this->getIdStock();
    }

    /**
     * Generic method to set the primary key (id_stock column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdStock($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdStock();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Stock\Persistence\SpyStock (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setName($this->getName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOfferStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOfferStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWarehouseAllocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWarehouseAllocation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdStock(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Stock\Persistence\SpyStock Clone of current object.
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
        if ('SpyMerchantStock' === $relationName) {
            $this->initSpyMerchantStocks();
            return;
        }
        if ('ProductOfferStock' === $relationName) {
            $this->initProductOfferStocks();
            return;
        }
        if ('StockProduct' === $relationName) {
            $this->initStockProducts();
            return;
        }
        if ('StockStore' === $relationName) {
            $this->initStockStores();
            return;
        }
        if ('StockAddress' === $relationName) {
            $this->initStockAddresses();
            return;
        }
        if ('WarehouseAllocation' === $relationName) {
            $this->initWarehouseAllocations();
            return;
        }
    }

    /**
     * Clears out the collSpyMerchantStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantStocks()
     */
    public function clearSpyMerchantStocks()
    {
        $this->collSpyMerchantStocks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantStocks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantStocks($v = true): void
    {
        $this->collSpyMerchantStocksPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantStocks collection.
     *
     * By default this just sets the collSpyMerchantStocks collection to an empty array (like clearcollSpyMerchantStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantStocks(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantStockTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantStocks = new $collectionClassName;
        $this->collSpyMerchantStocks->setModel('\Orm\Zed\MerchantStock\Persistence\SpyMerchantStock');
    }

    /**
     * Gets an array of SpyMerchantStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantStock[] List of SpyMerchantStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStock> List of SpyMerchantStock objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantStocks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantStocksPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStocks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantStocks) {
                    $this->initSpyMerchantStocks();
                } else {
                    $collectionClassName = SpyMerchantStockTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantStocks = new $collectionClassName;
                    $collSpyMerchantStocks->setModel('\Orm\Zed\MerchantStock\Persistence\SpyMerchantStock');

                    return $collSpyMerchantStocks;
                }
            } else {
                $collSpyMerchantStocks = SpyMerchantStockQuery::create(null, $criteria)
                    ->filterBySpyStock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantStocksPartial && count($collSpyMerchantStocks)) {
                        $this->initSpyMerchantStocks(false);

                        foreach ($collSpyMerchantStocks as $obj) {
                            if (false == $this->collSpyMerchantStocks->contains($obj)) {
                                $this->collSpyMerchantStocks->append($obj);
                            }
                        }

                        $this->collSpyMerchantStocksPartial = true;
                    }

                    return $collSpyMerchantStocks;
                }

                if ($partial && $this->collSpyMerchantStocks) {
                    foreach ($this->collSpyMerchantStocks as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantStocks[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantStocks = $collSpyMerchantStocks;
                $this->collSpyMerchantStocksPartial = false;
            }
        }

        return $this->collSpyMerchantStocks;
    }

    /**
     * Sets a collection of SpyMerchantStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantStocks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantStocks(Collection $spyMerchantStocks, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantStock[] $spyMerchantStocksToDelete */
        $spyMerchantStocksToDelete = $this->getSpyMerchantStocks(new Criteria(), $con)->diff($spyMerchantStocks);


        $this->spyMerchantStocksScheduledForDeletion = $spyMerchantStocksToDelete;

        foreach ($spyMerchantStocksToDelete as $spyMerchantStockRemoved) {
            $spyMerchantStockRemoved->setSpyStock(null);
        }

        $this->collSpyMerchantStocks = null;
        foreach ($spyMerchantStocks as $spyMerchantStock) {
            $this->addSpyMerchantStock($spyMerchantStock);
        }

        $this->collSpyMerchantStocks = $spyMerchantStocks;
        $this->collSpyMerchantStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantStock objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantStock objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantStocks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantStocksPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantStocks());
            }

            $query = SpyMerchantStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStock($this)
                ->count($con);
        }

        return count($this->collSpyMerchantStocks);
    }

    /**
     * Method called to associate a SpyMerchantStock object to this object
     * through the SpyMerchantStock foreign key attribute.
     *
     * @param SpyMerchantStock $l SpyMerchantStock
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantStock(SpyMerchantStock $l)
    {
        if ($this->collSpyMerchantStocks === null) {
            $this->initSpyMerchantStocks();
            $this->collSpyMerchantStocksPartial = true;
        }

        if (!$this->collSpyMerchantStocks->contains($l)) {
            $this->doAddSpyMerchantStock($l);

            if ($this->spyMerchantStocksScheduledForDeletion and $this->spyMerchantStocksScheduledForDeletion->contains($l)) {
                $this->spyMerchantStocksScheduledForDeletion->remove($this->spyMerchantStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantStock $spyMerchantStock The SpyMerchantStock object to add.
     */
    protected function doAddSpyMerchantStock(SpyMerchantStock $spyMerchantStock): void
    {
        $this->collSpyMerchantStocks[]= $spyMerchantStock;
        $spyMerchantStock->setSpyStock($this);
    }

    /**
     * @param SpyMerchantStock $spyMerchantStock The SpyMerchantStock object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantStock(SpyMerchantStock $spyMerchantStock)
    {
        if ($this->getSpyMerchantStocks()->contains($spyMerchantStock)) {
            $pos = $this->collSpyMerchantStocks->search($spyMerchantStock);
            $this->collSpyMerchantStocks->remove($pos);
            if (null === $this->spyMerchantStocksScheduledForDeletion) {
                $this->spyMerchantStocksScheduledForDeletion = clone $this->collSpyMerchantStocks;
                $this->spyMerchantStocksScheduledForDeletion->clear();
            }
            $this->spyMerchantStocksScheduledForDeletion[]= clone $spyMerchantStock;
            $spyMerchantStock->setSpyStock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related SpyMerchantStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantStock[] List of SpyMerchantStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStock}> List of SpyMerchantStock objects
     */
    public function getSpyMerchantStocksJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantStockQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyMerchantStocks($query, $con);
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
     * If this ChildSpyStock is new, it will return
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
                    ->filterByStock($this)
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
            $productOfferStockRemoved->setStock(null);
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
                ->filterByStock($this)
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
        $productOfferStock->setStock($this);
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
            $productOfferStock->setStock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related ProductOfferStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferStock[] List of SpyProductOfferStock objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferStock}> List of SpyProductOfferStock objects
     */
    public function getProductOfferStocksJoinSpyProductOffer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferStockQuery::create(null, $criteria);
        $query->joinWith('SpyProductOffer', $joinBehavior);

        return $this->getProductOfferStocks($query, $con);
    }

    /**
     * Clears out the collStockProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockProducts()
     */
    public function clearStockProducts()
    {
        $this->collStockProducts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockProducts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockProducts($v = true): void
    {
        $this->collStockProductsPartial = $v;
    }

    /**
     * Initializes the collStockProducts collection.
     *
     * By default this just sets the collStockProducts collection to an empty array (like clearcollStockProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockProducts(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStockProductTableMap::getTableMap()->getCollectionClassName();

        $this->collStockProducts = new $collectionClassName;
        $this->collStockProducts->setModel('\Orm\Zed\Stock\Persistence\SpyStockProduct');
    }

    /**
     * Gets an array of ChildSpyStockProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyStockProduct[] List of ChildSpyStockProduct objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStockProduct> List of ChildSpyStockProduct objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockProductsPartial && !$this->isNew();
        if (null === $this->collStockProducts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockProducts) {
                    $this->initStockProducts();
                } else {
                    $collectionClassName = SpyStockProductTableMap::getTableMap()->getCollectionClassName();

                    $collStockProducts = new $collectionClassName;
                    $collStockProducts->setModel('\Orm\Zed\Stock\Persistence\SpyStockProduct');

                    return $collStockProducts;
                }
            } else {
                $collStockProducts = ChildSpyStockProductQuery::create(null, $criteria)
                    ->filterByStock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockProductsPartial && count($collStockProducts)) {
                        $this->initStockProducts(false);

                        foreach ($collStockProducts as $obj) {
                            if (false == $this->collStockProducts->contains($obj)) {
                                $this->collStockProducts->append($obj);
                            }
                        }

                        $this->collStockProductsPartial = true;
                    }

                    return $collStockProducts;
                }

                if ($partial && $this->collStockProducts) {
                    foreach ($this->collStockProducts as $obj) {
                        if ($obj->isNew()) {
                            $collStockProducts[] = $obj;
                        }
                    }
                }

                $this->collStockProducts = $collStockProducts;
                $this->collStockProductsPartial = false;
            }
        }

        return $this->collStockProducts;
    }

    /**
     * Sets a collection of ChildSpyStockProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockProducts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockProducts(Collection $stockProducts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyStockProduct[] $stockProductsToDelete */
        $stockProductsToDelete = $this->getStockProducts(new Criteria(), $con)->diff($stockProducts);


        $this->stockProductsScheduledForDeletion = $stockProductsToDelete;

        foreach ($stockProductsToDelete as $stockProductRemoved) {
            $stockProductRemoved->setStock(null);
        }

        $this->collStockProducts = null;
        foreach ($stockProducts as $stockProduct) {
            $this->addStockProduct($stockProduct);
        }

        $this->collStockProducts = $stockProducts;
        $this->collStockProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyStockProduct objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyStockProduct objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockProducts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockProductsPartial && !$this->isNew();
        if (null === $this->collStockProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockProducts());
            }

            $query = ChildSpyStockProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStock($this)
                ->count($con);
        }

        return count($this->collStockProducts);
    }

    /**
     * Method called to associate a ChildSpyStockProduct object to this object
     * through the ChildSpyStockProduct foreign key attribute.
     *
     * @param ChildSpyStockProduct $l ChildSpyStockProduct
     * @return $this The current object (for fluent API support)
     */
    public function addStockProduct(ChildSpyStockProduct $l)
    {
        if ($this->collStockProducts === null) {
            $this->initStockProducts();
            $this->collStockProductsPartial = true;
        }

        if (!$this->collStockProducts->contains($l)) {
            $this->doAddStockProduct($l);

            if ($this->stockProductsScheduledForDeletion and $this->stockProductsScheduledForDeletion->contains($l)) {
                $this->stockProductsScheduledForDeletion->remove($this->stockProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyStockProduct $stockProduct The ChildSpyStockProduct object to add.
     */
    protected function doAddStockProduct(ChildSpyStockProduct $stockProduct): void
    {
        $this->collStockProducts[]= $stockProduct;
        $stockProduct->setStock($this);
    }

    /**
     * @param ChildSpyStockProduct $stockProduct The ChildSpyStockProduct object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockProduct(ChildSpyStockProduct $stockProduct)
    {
        if ($this->getStockProducts()->contains($stockProduct)) {
            $pos = $this->collStockProducts->search($stockProduct);
            $this->collStockProducts->remove($pos);
            if (null === $this->stockProductsScheduledForDeletion) {
                $this->stockProductsScheduledForDeletion = clone $this->collStockProducts;
                $this->stockProductsScheduledForDeletion->clear();
            }
            $this->stockProductsScheduledForDeletion[]= clone $stockProduct;
            $stockProduct->setStock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related StockProducts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyStockProduct[] List of ChildSpyStockProduct objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStockProduct}> List of ChildSpyStockProduct objects
     */
    public function getStockProductsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyStockProductQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getStockProducts($query, $con);
    }

    /**
     * Clears out the collStockStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockStores()
     */
    public function clearStockStores()
    {
        $this->collStockStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockStores($v = true): void
    {
        $this->collStockStoresPartial = $v;
    }

    /**
     * Initializes the collStockStores collection.
     *
     * By default this just sets the collStockStores collection to an empty array (like clearcollStockStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStockStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collStockStores = new $collectionClassName;
        $this->collStockStores->setModel('\Orm\Zed\Stock\Persistence\SpyStockStore');
    }

    /**
     * Gets an array of ChildSpyStockStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyStockStore[] List of ChildSpyStockStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStockStore> List of ChildSpyStockStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockStoresPartial && !$this->isNew();
        if (null === $this->collStockStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockStores) {
                    $this->initStockStores();
                } else {
                    $collectionClassName = SpyStockStoreTableMap::getTableMap()->getCollectionClassName();

                    $collStockStores = new $collectionClassName;
                    $collStockStores->setModel('\Orm\Zed\Stock\Persistence\SpyStockStore');

                    return $collStockStores;
                }
            } else {
                $collStockStores = ChildSpyStockStoreQuery::create(null, $criteria)
                    ->filterByStock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockStoresPartial && count($collStockStores)) {
                        $this->initStockStores(false);

                        foreach ($collStockStores as $obj) {
                            if (false == $this->collStockStores->contains($obj)) {
                                $this->collStockStores->append($obj);
                            }
                        }

                        $this->collStockStoresPartial = true;
                    }

                    return $collStockStores;
                }

                if ($partial && $this->collStockStores) {
                    foreach ($this->collStockStores as $obj) {
                        if ($obj->isNew()) {
                            $collStockStores[] = $obj;
                        }
                    }
                }

                $this->collStockStores = $collStockStores;
                $this->collStockStoresPartial = false;
            }
        }

        return $this->collStockStores;
    }

    /**
     * Sets a collection of ChildSpyStockStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockStores(Collection $stockStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyStockStore[] $stockStoresToDelete */
        $stockStoresToDelete = $this->getStockStores(new Criteria(), $con)->diff($stockStores);


        $this->stockStoresScheduledForDeletion = $stockStoresToDelete;

        foreach ($stockStoresToDelete as $stockStoreRemoved) {
            $stockStoreRemoved->setStock(null);
        }

        $this->collStockStores = null;
        foreach ($stockStores as $stockStore) {
            $this->addStockStore($stockStore);
        }

        $this->collStockStores = $stockStores;
        $this->collStockStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyStockStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyStockStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockStoresPartial && !$this->isNew();
        if (null === $this->collStockStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockStores());
            }

            $query = ChildSpyStockStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStock($this)
                ->count($con);
        }

        return count($this->collStockStores);
    }

    /**
     * Method called to associate a ChildSpyStockStore object to this object
     * through the ChildSpyStockStore foreign key attribute.
     *
     * @param ChildSpyStockStore $l ChildSpyStockStore
     * @return $this The current object (for fluent API support)
     */
    public function addStockStore(ChildSpyStockStore $l)
    {
        if ($this->collStockStores === null) {
            $this->initStockStores();
            $this->collStockStoresPartial = true;
        }

        if (!$this->collStockStores->contains($l)) {
            $this->doAddStockStore($l);

            if ($this->stockStoresScheduledForDeletion and $this->stockStoresScheduledForDeletion->contains($l)) {
                $this->stockStoresScheduledForDeletion->remove($this->stockStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyStockStore $stockStore The ChildSpyStockStore object to add.
     */
    protected function doAddStockStore(ChildSpyStockStore $stockStore): void
    {
        $this->collStockStores[]= $stockStore;
        $stockStore->setStock($this);
    }

    /**
     * @param ChildSpyStockStore $stockStore The ChildSpyStockStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockStore(ChildSpyStockStore $stockStore)
    {
        if ($this->getStockStores()->contains($stockStore)) {
            $pos = $this->collStockStores->search($stockStore);
            $this->collStockStores->remove($pos);
            if (null === $this->stockStoresScheduledForDeletion) {
                $this->stockStoresScheduledForDeletion = clone $this->collStockStores;
                $this->stockStoresScheduledForDeletion->clear();
            }
            $this->stockStoresScheduledForDeletion[]= clone $stockStore;
            $stockStore->setStock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related StockStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyStockStore[] List of ChildSpyStockStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyStockStore}> List of ChildSpyStockStore objects
     */
    public function getStockStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyStockStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getStockStores($query, $con);
    }

    /**
     * Clears out the collStockAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockAddresses()
     */
    public function clearStockAddresses()
    {
        $this->collStockAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockAddresses($v = true): void
    {
        $this->collStockAddressesPartial = $v;
    }

    /**
     * Initializes the collStockAddresses collection.
     *
     * By default this just sets the collStockAddresses collection to an empty array (like clearcollStockAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStockAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collStockAddresses = new $collectionClassName;
        $this->collStockAddresses->setModel('\Orm\Zed\StockAddress\Persistence\SpyStockAddress');
    }

    /**
     * Gets an array of SpyStockAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress> List of SpyStockAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockAddressesPartial && !$this->isNew();
        if (null === $this->collStockAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockAddresses) {
                    $this->initStockAddresses();
                } else {
                    $collectionClassName = SpyStockAddressTableMap::getTableMap()->getCollectionClassName();

                    $collStockAddresses = new $collectionClassName;
                    $collStockAddresses->setModel('\Orm\Zed\StockAddress\Persistence\SpyStockAddress');

                    return $collStockAddresses;
                }
            } else {
                $collStockAddresses = SpyStockAddressQuery::create(null, $criteria)
                    ->filterByStock($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockAddressesPartial && count($collStockAddresses)) {
                        $this->initStockAddresses(false);

                        foreach ($collStockAddresses as $obj) {
                            if (false == $this->collStockAddresses->contains($obj)) {
                                $this->collStockAddresses->append($obj);
                            }
                        }

                        $this->collStockAddressesPartial = true;
                    }

                    return $collStockAddresses;
                }

                if ($partial && $this->collStockAddresses) {
                    foreach ($this->collStockAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collStockAddresses[] = $obj;
                        }
                    }
                }

                $this->collStockAddresses = $collStockAddresses;
                $this->collStockAddressesPartial = false;
            }
        }

        return $this->collStockAddresses;
    }

    /**
     * Sets a collection of SpyStockAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockAddresses(Collection $stockAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyStockAddress[] $stockAddressesToDelete */
        $stockAddressesToDelete = $this->getStockAddresses(new Criteria(), $con)->diff($stockAddresses);


        $this->stockAddressesScheduledForDeletion = $stockAddressesToDelete;

        foreach ($stockAddressesToDelete as $stockAddressRemoved) {
            $stockAddressRemoved->setStock(null);
        }

        $this->collStockAddresses = null;
        foreach ($stockAddresses as $stockAddress) {
            $this->addStockAddress($stockAddress);
        }

        $this->collStockAddresses = $stockAddresses;
        $this->collStockAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyStockAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyStockAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockAddressesPartial && !$this->isNew();
        if (null === $this->collStockAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockAddresses());
            }

            $query = SpyStockAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStock($this)
                ->count($con);
        }

        return count($this->collStockAddresses);
    }

    /**
     * Method called to associate a SpyStockAddress object to this object
     * through the SpyStockAddress foreign key attribute.
     *
     * @param SpyStockAddress $l SpyStockAddress
     * @return $this The current object (for fluent API support)
     */
    public function addStockAddress(SpyStockAddress $l)
    {
        if ($this->collStockAddresses === null) {
            $this->initStockAddresses();
            $this->collStockAddressesPartial = true;
        }

        if (!$this->collStockAddresses->contains($l)) {
            $this->doAddStockAddress($l);

            if ($this->stockAddressesScheduledForDeletion and $this->stockAddressesScheduledForDeletion->contains($l)) {
                $this->stockAddressesScheduledForDeletion->remove($this->stockAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyStockAddress $stockAddress The SpyStockAddress object to add.
     */
    protected function doAddStockAddress(SpyStockAddress $stockAddress): void
    {
        $this->collStockAddresses[]= $stockAddress;
        $stockAddress->setStock($this);
    }

    /**
     * @param SpyStockAddress $stockAddress The SpyStockAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockAddress(SpyStockAddress $stockAddress)
    {
        if ($this->getStockAddresses()->contains($stockAddress)) {
            $pos = $this->collStockAddresses->search($stockAddress);
            $this->collStockAddresses->remove($pos);
            if (null === $this->stockAddressesScheduledForDeletion) {
                $this->stockAddressesScheduledForDeletion = clone $this->collStockAddresses;
                $this->stockAddressesScheduledForDeletion->clear();
            }
            $this->stockAddressesScheduledForDeletion[]= clone $stockAddress;
            $stockAddress->setStock(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related StockAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress}> List of SpyStockAddress objects
     */
    public function getStockAddressesJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStockAddressQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getStockAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStock is new, it will return
     * an empty collection; or if this SpyStock has previously
     * been saved, it will retrieve related StockAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStock.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress}> List of SpyStockAddress objects
     */
    public function getStockAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStockAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getStockAddresses($query, $con);
    }

    /**
     * Clears out the collWarehouseAllocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWarehouseAllocations()
     */
    public function clearWarehouseAllocations()
    {
        $this->collWarehouseAllocations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWarehouseAllocations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWarehouseAllocations($v = true): void
    {
        $this->collWarehouseAllocationsPartial = $v;
    }

    /**
     * Initializes the collWarehouseAllocations collection.
     *
     * By default this just sets the collWarehouseAllocations collection to an empty array (like clearcollWarehouseAllocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWarehouseAllocations(bool $overrideExisting = true): void
    {
        if (null !== $this->collWarehouseAllocations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyWarehouseAllocationTableMap::getTableMap()->getCollectionClassName();

        $this->collWarehouseAllocations = new $collectionClassName;
        $this->collWarehouseAllocations->setModel('\Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocation');
    }

    /**
     * Gets an array of SpyWarehouseAllocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStock is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyWarehouseAllocation[] List of SpyWarehouseAllocation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyWarehouseAllocation> List of SpyWarehouseAllocation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWarehouseAllocations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWarehouseAllocationsPartial && !$this->isNew();
        if (null === $this->collWarehouseAllocations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWarehouseAllocations) {
                    $this->initWarehouseAllocations();
                } else {
                    $collectionClassName = SpyWarehouseAllocationTableMap::getTableMap()->getCollectionClassName();

                    $collWarehouseAllocations = new $collectionClassName;
                    $collWarehouseAllocations->setModel('\Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocation');

                    return $collWarehouseAllocations;
                }
            } else {
                $collWarehouseAllocations = SpyWarehouseAllocationQuery::create(null, $criteria)
                    ->filterByWarehouse($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWarehouseAllocationsPartial && count($collWarehouseAllocations)) {
                        $this->initWarehouseAllocations(false);

                        foreach ($collWarehouseAllocations as $obj) {
                            if (false == $this->collWarehouseAllocations->contains($obj)) {
                                $this->collWarehouseAllocations->append($obj);
                            }
                        }

                        $this->collWarehouseAllocationsPartial = true;
                    }

                    return $collWarehouseAllocations;
                }

                if ($partial && $this->collWarehouseAllocations) {
                    foreach ($this->collWarehouseAllocations as $obj) {
                        if ($obj->isNew()) {
                            $collWarehouseAllocations[] = $obj;
                        }
                    }
                }

                $this->collWarehouseAllocations = $collWarehouseAllocations;
                $this->collWarehouseAllocationsPartial = false;
            }
        }

        return $this->collWarehouseAllocations;
    }

    /**
     * Sets a collection of SpyWarehouseAllocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $warehouseAllocations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWarehouseAllocations(Collection $warehouseAllocations, ?ConnectionInterface $con = null)
    {
        /** @var SpyWarehouseAllocation[] $warehouseAllocationsToDelete */
        $warehouseAllocationsToDelete = $this->getWarehouseAllocations(new Criteria(), $con)->diff($warehouseAllocations);


        $this->warehouseAllocationsScheduledForDeletion = $warehouseAllocationsToDelete;

        foreach ($warehouseAllocationsToDelete as $warehouseAllocationRemoved) {
            $warehouseAllocationRemoved->setWarehouse(null);
        }

        $this->collWarehouseAllocations = null;
        foreach ($warehouseAllocations as $warehouseAllocation) {
            $this->addWarehouseAllocation($warehouseAllocation);
        }

        $this->collWarehouseAllocations = $warehouseAllocations;
        $this->collWarehouseAllocationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyWarehouseAllocation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyWarehouseAllocation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWarehouseAllocations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWarehouseAllocationsPartial && !$this->isNew();
        if (null === $this->collWarehouseAllocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWarehouseAllocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWarehouseAllocations());
            }

            $query = SpyWarehouseAllocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWarehouse($this)
                ->count($con);
        }

        return count($this->collWarehouseAllocations);
    }

    /**
     * Method called to associate a SpyWarehouseAllocation object to this object
     * through the SpyWarehouseAllocation foreign key attribute.
     *
     * @param SpyWarehouseAllocation $l SpyWarehouseAllocation
     * @return $this The current object (for fluent API support)
     */
    public function addWarehouseAllocation(SpyWarehouseAllocation $l)
    {
        if ($this->collWarehouseAllocations === null) {
            $this->initWarehouseAllocations();
            $this->collWarehouseAllocationsPartial = true;
        }

        if (!$this->collWarehouseAllocations->contains($l)) {
            $this->doAddWarehouseAllocation($l);

            if ($this->warehouseAllocationsScheduledForDeletion and $this->warehouseAllocationsScheduledForDeletion->contains($l)) {
                $this->warehouseAllocationsScheduledForDeletion->remove($this->warehouseAllocationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyWarehouseAllocation $warehouseAllocation The SpyWarehouseAllocation object to add.
     */
    protected function doAddWarehouseAllocation(SpyWarehouseAllocation $warehouseAllocation): void
    {
        $this->collWarehouseAllocations[]= $warehouseAllocation;
        $warehouseAllocation->setWarehouse($this);
    }

    /**
     * @param SpyWarehouseAllocation $warehouseAllocation The SpyWarehouseAllocation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWarehouseAllocation(SpyWarehouseAllocation $warehouseAllocation)
    {
        if ($this->getWarehouseAllocations()->contains($warehouseAllocation)) {
            $pos = $this->collWarehouseAllocations->search($warehouseAllocation);
            $this->collWarehouseAllocations->remove($pos);
            if (null === $this->warehouseAllocationsScheduledForDeletion) {
                $this->warehouseAllocationsScheduledForDeletion = clone $this->collWarehouseAllocations;
                $this->warehouseAllocationsScheduledForDeletion->clear();
            }
            $this->warehouseAllocationsScheduledForDeletion[]= clone $warehouseAllocation;
            $warehouseAllocation->setWarehouse(null);
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
        $this->id_stock = null;
        $this->is_active = null;
        $this->name = null;
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
            if ($this->collSpyMerchantStocks) {
                foreach ($this->collSpyMerchantStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOfferStocks) {
                foreach ($this->collProductOfferStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockProducts) {
                foreach ($this->collStockProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockStores) {
                foreach ($this->collStockStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockAddresses) {
                foreach ($this->collStockAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWarehouseAllocations) {
                foreach ($this->collWarehouseAllocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantStocks = null;
        $this->collProductOfferStocks = null;
        $this->collStockProducts = null;
        $this->collStockStores = null;
        $this->collStockAddresses = null;
        $this->collWarehouseAllocations = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyStockTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_stock.create';
        } else {
            $this->_eventName = 'Entity.spy_stock.update';
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

        if ($this->_eventName !== 'Entity.spy_stock.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_stock',
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
            'name' => 'spy_stock',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_stock.delete',
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
        $eventColumns = [
                'spy_stock.is_active' => [
                    'column' => 'is_active',
                ],
        ];

        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (isset($eventColumns[$modifiedColumn])) {

                if (!isset($eventColumns[$modifiedColumn]['value'])) {
                    return true;
                }

                $xmlValue = $eventColumns[$modifiedColumn]['value'];
                $xmlValue = $this->getPhpType($xmlValue, $modifiedColumn);
                $xmlOperator = '';
                if (isset($eventColumns[$modifiedColumn]['operator'])) {
                    $xmlOperator = $eventColumns[$modifiedColumn]['operator'];
                }
                $before = $this->_initialValues[$modifiedColumn];
                $field = str_replace('spy_stock.', '', $modifiedColumn);
                $after = $this->$field;

                if ($before === null && $after !== null) {
                    return true;
                }

                if ($before !== null && $after === null) {
                    return true;
                }

                switch ($xmlOperator) {
                    case '<':
                        $result = ($before < $xmlValue xor $after < $xmlValue);
                        break;
                    case '>':
                        $result = ($before > $xmlValue xor $after > $xmlValue);
                        break;
                    case '<=':
                        $result = ($before <= $xmlValue xor $after <= $xmlValue);
                        break;
                    case '>=':
                        $result = ($before >= $xmlValue xor $after >= $xmlValue);
                        break;
                    case '<>':
                        $result = ($before <> $xmlValue xor $after <> $xmlValue);
                        break;
                    case '!=':
                        $result = ($before != $xmlValue xor $after != $xmlValue);
                        break;
                    case '==':
                        $result = ($before == $xmlValue xor $after == $xmlValue);
                        break;
                    case '!==':
                        $result = ($before !== $xmlValue xor $after !== $xmlValue);
                        break;
                    default:
                        $result = ($before === $xmlValue xor $after === $xmlValue);
                }

                if ($result) {
                    return true;
                }
            }
        }

        return false;
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
            $field = str_replace('spy_stock.', '', $modifiedColumn);
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
            $field = str_replace('spy_stock.', '', $additionalValueColumnName);
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
        $columnType = SpyStockTableMap::getTableMap()->getColumn($column)->getType();
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
