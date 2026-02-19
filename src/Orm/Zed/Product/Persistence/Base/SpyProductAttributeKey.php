<?php

namespace Orm\Zed\Product\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttribute;
use Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeQuery;
use Orm\Zed\ProductAttribute\Persistence\Base\SpyProductManagementAttribute as BaseSpyProductManagementAttribute;
use Orm\Zed\ProductAttribute\Persistence\Map\SpyProductManagementAttributeTableMap;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttribute;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMap;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapQuery;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeQuery;
use Orm\Zed\ProductSearch\Persistence\Base\SpyProductSearchAttribute as BaseSpyProductSearchAttribute;
use Orm\Zed\ProductSearch\Persistence\Base\SpyProductSearchAttributeMap as BaseSpyProductSearchAttributeMap;
use Orm\Zed\ProductSearch\Persistence\Map\SpyProductSearchAttributeMapTableMap;
use Orm\Zed\ProductSearch\Persistence\Map\SpyProductSearchAttributeTableMap;
use Orm\Zed\Product\Persistence\SpyProductAttributeKey as ChildSpyProductAttributeKey;
use Orm\Zed\Product\Persistence\SpyProductAttributeKeyQuery as ChildSpyProductAttributeKeyQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAttributeKeyTableMap;
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
 * Base class that represents a row from the 'spy_product_attribute_key' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Product.Persistence.Base
 */
abstract class SpyProductAttributeKey implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Product\\Persistence\\Map\\SpyProductAttributeKeyTableMap';


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
     * The value for the id_product_attribute_key field.
     *
     * @var        int
     */
    protected $id_product_attribute_key;

    /**
     * The value for the is_super field.
     * A flag indicating if an attribute is a super attribute used for variant creation.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_super;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string
     */
    protected $key;

    /**
     * @var        ObjectCollection|SpyProductManagementAttribute[] Collection to store aggregation of SpyProductManagementAttribute objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductManagementAttribute> Collection to store aggregation of SpyProductManagementAttribute objects.
     */
    protected $collSpyProductManagementAttributes;
    protected $collSpyProductManagementAttributesPartial;

    /**
     * @var        ObjectCollection|SpyProductSearchAttributeMap[] Collection to store aggregation of SpyProductSearchAttributeMap objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearchAttributeMap> Collection to store aggregation of SpyProductSearchAttributeMap objects.
     */
    protected $collSpyProductSearchAttributeMaps;
    protected $collSpyProductSearchAttributeMapsPartial;

    /**
     * @var        ObjectCollection|SpyProductSearchAttribute[] Collection to store aggregation of SpyProductSearchAttribute objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearchAttribute> Collection to store aggregation of SpyProductSearchAttribute objects.
     */
    protected $collSpyProductSearchAttributes;
    protected $collSpyProductSearchAttributesPartial;

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
     * @var ObjectCollection|SpyProductManagementAttribute[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductManagementAttribute>
     */
    protected $spyProductManagementAttributesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductSearchAttributeMap[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearchAttributeMap>
     */
    protected $spyProductSearchAttributeMapsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductSearchAttribute[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductSearchAttribute>
     */
    protected $spyProductSearchAttributesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_super = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Product\Persistence\Base\SpyProductAttributeKey object.
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
     * Compares this with another <code>SpyProductAttributeKey</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductAttributeKey</code>, delegates to
     * <code>equals(SpyProductAttributeKey)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_attribute_key] column value.
     *
     * @return int
     */
    public function getIdProductAttributeKey()
    {
        return $this->id_product_attribute_key;
    }

    /**
     * Get the [is_super] column value.
     * A flag indicating if an attribute is a super attribute used for variant creation.
     * @return boolean
     */
    public function getIsSuper()
    {
        return $this->is_super;
    }

    /**
     * Get the [is_super] column value.
     * A flag indicating if an attribute is a super attribute used for variant creation.
     * @return boolean
     */
    public function isSuper()
    {
        return $this->getIsSuper();
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
     * Set the value of [id_product_attribute_key] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductAttributeKey($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_attribute_key !== $v) {
            $this->id_product_attribute_key = $v;
            $this->modifiedColumns[SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_super] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an attribute is a super attribute used for variant creation.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsSuper($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_super !== $v) {
            $this->is_super = $v;
            $this->modifiedColumns[SpyProductAttributeKeyTableMap::COL_IS_SUPER] = true;
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
            $this->modifiedColumns[SpyProductAttributeKeyTableMap::COL_KEY] = true;
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
            if ($this->is_super !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductAttributeKeyTableMap::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_attribute_key = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductAttributeKeyTableMap::translateFieldName('IsSuper', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_super = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductAttributeKeyTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyProductAttributeKeyTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAttributeKey'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductAttributeKeyTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductAttributeKeyQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyProductManagementAttributes = null;

            $this->collSpyProductSearchAttributeMaps = null;

            $this->collSpyProductSearchAttributes = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductAttributeKey::setDeleted()
     * @see SpyProductAttributeKey::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAttributeKeyTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductAttributeKeyQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAttributeKeyTableMap::DATABASE_NAME);
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

                SpyProductAttributeKeyTableMap::addInstanceToPool($this);
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

            if ($this->spyProductManagementAttributesScheduledForDeletion !== null) {
                if (!$this->spyProductManagementAttributesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeQuery::create()
                        ->filterByPrimaryKeys($this->spyProductManagementAttributesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductManagementAttributesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductManagementAttributes !== null) {
                foreach ($this->collSpyProductManagementAttributes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductSearchAttributeMapsScheduledForDeletion !== null) {
                if (!$this->spyProductSearchAttributeMapsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapQuery::create()
                        ->filterByPrimaryKeys($this->spyProductSearchAttributeMapsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductSearchAttributeMapsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductSearchAttributeMaps !== null) {
                foreach ($this->collSpyProductSearchAttributeMaps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductSearchAttributesScheduledForDeletion !== null) {
                if (!$this->spyProductSearchAttributesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeQuery::create()
                        ->filterByPrimaryKeys($this->spyProductSearchAttributesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductSearchAttributesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductSearchAttributes !== null) {
                foreach ($this->collSpyProductSearchAttributes as $referrerFK) {
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

        $this->modifiedColumns[SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_attribute_key`';
        }
        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_IS_SUPER)) {
            $modifiedColumns[':p' . $index++]  = '`is_super`';
        }
        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_attribute_key` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_attribute_key`':
                        $stmt->bindValue($identifier, $this->id_product_attribute_key, PDO::PARAM_INT);

                        break;
                    case '`is_super`':
                        $stmt->bindValue($identifier, (int) $this->is_super, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_product_attribute_key_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductAttributeKey($pk);
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
        $pos = SpyProductAttributeKeyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductAttributeKey();

            case 1:
                return $this->getIsSuper();

            case 2:
                return $this->getKey();

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
        if (isset($alreadyDumpedObjects['SpyProductAttributeKey'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductAttributeKey'][$this->hashCode()] = true;
        $keys = SpyProductAttributeKeyTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductAttributeKey(),
            $keys[1] => $this->getIsSuper(),
            $keys[2] => $this->getKey(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyProductManagementAttributes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductManagementAttributes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_management_attributes';
                        break;
                    default:
                        $key = 'SpyProductManagementAttributes';
                }

                $result[$key] = $this->collSpyProductManagementAttributes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductSearchAttributeMaps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSearchAttributeMaps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_search_attribute_maps';
                        break;
                    default:
                        $key = 'SpyProductSearchAttributeMaps';
                }

                $result[$key] = $this->collSpyProductSearchAttributeMaps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductSearchAttributes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSearchAttributes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_search_attributes';
                        break;
                    default:
                        $key = 'SpyProductSearchAttributes';
                }

                $result[$key] = $this->collSpyProductSearchAttributes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductAttributeKeyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductAttributeKey($value);
                break;
            case 1:
                $this->setIsSuper($value);
                break;
            case 2:
                $this->setKey($value);
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
        $keys = SpyProductAttributeKeyTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductAttributeKey($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsSuper($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setKey($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyProductAttributeKeyTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY)) {
            $criteria->add(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY, $this->id_product_attribute_key);
        }
        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_IS_SUPER)) {
            $criteria->add(SpyProductAttributeKeyTableMap::COL_IS_SUPER, $this->is_super);
        }
        if ($this->isColumnModified(SpyProductAttributeKeyTableMap::COL_KEY)) {
            $criteria->add(SpyProductAttributeKeyTableMap::COL_KEY, $this->key);
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
        $criteria = ChildSpyProductAttributeKeyQuery::create();
        $criteria->add(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY, $this->id_product_attribute_key);

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
        $validPk = null !== $this->getIdProductAttributeKey();

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
        return $this->getIdProductAttributeKey();
    }

    /**
     * Generic method to set the primary key (id_product_attribute_key column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductAttributeKey($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductAttributeKey();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Product\Persistence\SpyProductAttributeKey (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsSuper($this->getIsSuper());
        $copyObj->setKey($this->getKey());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductManagementAttributes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductManagementAttribute($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductSearchAttributeMaps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductSearchAttributeMap($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductSearchAttributes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductSearchAttribute($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductAttributeKey(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Product\Persistence\SpyProductAttributeKey Clone of current object.
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
        if ('SpyProductManagementAttribute' === $relationName) {
            $this->initSpyProductManagementAttributes();
            return;
        }
        if ('SpyProductSearchAttributeMap' === $relationName) {
            $this->initSpyProductSearchAttributeMaps();
            return;
        }
        if ('SpyProductSearchAttribute' === $relationName) {
            $this->initSpyProductSearchAttributes();
            return;
        }
    }

    /**
     * Clears out the collSpyProductManagementAttributes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductManagementAttributes()
     */
    public function clearSpyProductManagementAttributes()
    {
        $this->collSpyProductManagementAttributes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductManagementAttributes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductManagementAttributes($v = true): void
    {
        $this->collSpyProductManagementAttributesPartial = $v;
    }

    /**
     * Initializes the collSpyProductManagementAttributes collection.
     *
     * By default this just sets the collSpyProductManagementAttributes collection to an empty array (like clearcollSpyProductManagementAttributes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductManagementAttributes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductManagementAttributes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductManagementAttributeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductManagementAttributes = new $collectionClassName;
        $this->collSpyProductManagementAttributes->setModel('\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttribute');
    }

    /**
     * Gets an array of SpyProductManagementAttribute objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAttributeKey is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductManagementAttribute[] List of SpyProductManagementAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductManagementAttribute> List of SpyProductManagementAttribute objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductManagementAttributes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductManagementAttributesPartial && !$this->isNew();
        if (null === $this->collSpyProductManagementAttributes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductManagementAttributes) {
                    $this->initSpyProductManagementAttributes();
                } else {
                    $collectionClassName = SpyProductManagementAttributeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductManagementAttributes = new $collectionClassName;
                    $collSpyProductManagementAttributes->setModel('\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttribute');

                    return $collSpyProductManagementAttributes;
                }
            } else {
                $collSpyProductManagementAttributes = SpyProductManagementAttributeQuery::create(null, $criteria)
                    ->filterBySpyProductAttributeKey($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductManagementAttributesPartial && count($collSpyProductManagementAttributes)) {
                        $this->initSpyProductManagementAttributes(false);

                        foreach ($collSpyProductManagementAttributes as $obj) {
                            if (false == $this->collSpyProductManagementAttributes->contains($obj)) {
                                $this->collSpyProductManagementAttributes->append($obj);
                            }
                        }

                        $this->collSpyProductManagementAttributesPartial = true;
                    }

                    return $collSpyProductManagementAttributes;
                }

                if ($partial && $this->collSpyProductManagementAttributes) {
                    foreach ($this->collSpyProductManagementAttributes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductManagementAttributes[] = $obj;
                        }
                    }
                }

                $this->collSpyProductManagementAttributes = $collSpyProductManagementAttributes;
                $this->collSpyProductManagementAttributesPartial = false;
            }
        }

        return $this->collSpyProductManagementAttributes;
    }

    /**
     * Sets a collection of SpyProductManagementAttribute objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductManagementAttributes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductManagementAttributes(Collection $spyProductManagementAttributes, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductManagementAttribute[] $spyProductManagementAttributesToDelete */
        $spyProductManagementAttributesToDelete = $this->getSpyProductManagementAttributes(new Criteria(), $con)->diff($spyProductManagementAttributes);


        $this->spyProductManagementAttributesScheduledForDeletion = $spyProductManagementAttributesToDelete;

        foreach ($spyProductManagementAttributesToDelete as $spyProductManagementAttributeRemoved) {
            $spyProductManagementAttributeRemoved->setSpyProductAttributeKey(null);
        }

        $this->collSpyProductManagementAttributes = null;
        foreach ($spyProductManagementAttributes as $spyProductManagementAttribute) {
            $this->addSpyProductManagementAttribute($spyProductManagementAttribute);
        }

        $this->collSpyProductManagementAttributes = $spyProductManagementAttributes;
        $this->collSpyProductManagementAttributesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductManagementAttribute objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductManagementAttribute objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductManagementAttributes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductManagementAttributesPartial && !$this->isNew();
        if (null === $this->collSpyProductManagementAttributes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductManagementAttributes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductManagementAttributes());
            }

            $query = SpyProductManagementAttributeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAttributeKey($this)
                ->count($con);
        }

        return count($this->collSpyProductManagementAttributes);
    }

    /**
     * Method called to associate a SpyProductManagementAttribute object to this object
     * through the SpyProductManagementAttribute foreign key attribute.
     *
     * @param SpyProductManagementAttribute $l SpyProductManagementAttribute
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductManagementAttribute(SpyProductManagementAttribute $l)
    {
        if ($this->collSpyProductManagementAttributes === null) {
            $this->initSpyProductManagementAttributes();
            $this->collSpyProductManagementAttributesPartial = true;
        }

        if (!$this->collSpyProductManagementAttributes->contains($l)) {
            $this->doAddSpyProductManagementAttribute($l);

            if ($this->spyProductManagementAttributesScheduledForDeletion and $this->spyProductManagementAttributesScheduledForDeletion->contains($l)) {
                $this->spyProductManagementAttributesScheduledForDeletion->remove($this->spyProductManagementAttributesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductManagementAttribute $spyProductManagementAttribute The SpyProductManagementAttribute object to add.
     */
    protected function doAddSpyProductManagementAttribute(SpyProductManagementAttribute $spyProductManagementAttribute): void
    {
        $this->collSpyProductManagementAttributes[]= $spyProductManagementAttribute;
        $spyProductManagementAttribute->setSpyProductAttributeKey($this);
    }

    /**
     * @param SpyProductManagementAttribute $spyProductManagementAttribute The SpyProductManagementAttribute object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductManagementAttribute(SpyProductManagementAttribute $spyProductManagementAttribute)
    {
        if ($this->getSpyProductManagementAttributes()->contains($spyProductManagementAttribute)) {
            $pos = $this->collSpyProductManagementAttributes->search($spyProductManagementAttribute);
            $this->collSpyProductManagementAttributes->remove($pos);
            if (null === $this->spyProductManagementAttributesScheduledForDeletion) {
                $this->spyProductManagementAttributesScheduledForDeletion = clone $this->collSpyProductManagementAttributes;
                $this->spyProductManagementAttributesScheduledForDeletion->clear();
            }
            $this->spyProductManagementAttributesScheduledForDeletion[]= clone $spyProductManagementAttribute;
            $spyProductManagementAttribute->setSpyProductAttributeKey(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductSearchAttributeMaps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductSearchAttributeMaps()
     */
    public function clearSpyProductSearchAttributeMaps()
    {
        $this->collSpyProductSearchAttributeMaps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductSearchAttributeMaps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductSearchAttributeMaps($v = true): void
    {
        $this->collSpyProductSearchAttributeMapsPartial = $v;
    }

    /**
     * Initializes the collSpyProductSearchAttributeMaps collection.
     *
     * By default this just sets the collSpyProductSearchAttributeMaps collection to an empty array (like clearcollSpyProductSearchAttributeMaps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductSearchAttributeMaps(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductSearchAttributeMaps && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductSearchAttributeMapTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductSearchAttributeMaps = new $collectionClassName;
        $this->collSpyProductSearchAttributeMaps->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMap');
    }

    /**
     * Gets an array of SpyProductSearchAttributeMap objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAttributeKey is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductSearchAttributeMap[] List of SpyProductSearchAttributeMap objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSearchAttributeMap> List of SpyProductSearchAttributeMap objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSearchAttributeMaps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductSearchAttributeMapsPartial && !$this->isNew();
        if (null === $this->collSpyProductSearchAttributeMaps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductSearchAttributeMaps) {
                    $this->initSpyProductSearchAttributeMaps();
                } else {
                    $collectionClassName = SpyProductSearchAttributeMapTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductSearchAttributeMaps = new $collectionClassName;
                    $collSpyProductSearchAttributeMaps->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMap');

                    return $collSpyProductSearchAttributeMaps;
                }
            } else {
                $collSpyProductSearchAttributeMaps = SpyProductSearchAttributeMapQuery::create(null, $criteria)
                    ->filterBySpyProductAttributeKey($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductSearchAttributeMapsPartial && count($collSpyProductSearchAttributeMaps)) {
                        $this->initSpyProductSearchAttributeMaps(false);

                        foreach ($collSpyProductSearchAttributeMaps as $obj) {
                            if (false == $this->collSpyProductSearchAttributeMaps->contains($obj)) {
                                $this->collSpyProductSearchAttributeMaps->append($obj);
                            }
                        }

                        $this->collSpyProductSearchAttributeMapsPartial = true;
                    }

                    return $collSpyProductSearchAttributeMaps;
                }

                if ($partial && $this->collSpyProductSearchAttributeMaps) {
                    foreach ($this->collSpyProductSearchAttributeMaps as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductSearchAttributeMaps[] = $obj;
                        }
                    }
                }

                $this->collSpyProductSearchAttributeMaps = $collSpyProductSearchAttributeMaps;
                $this->collSpyProductSearchAttributeMapsPartial = false;
            }
        }

        return $this->collSpyProductSearchAttributeMaps;
    }

    /**
     * Sets a collection of SpyProductSearchAttributeMap objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductSearchAttributeMaps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductSearchAttributeMaps(Collection $spyProductSearchAttributeMaps, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductSearchAttributeMap[] $spyProductSearchAttributeMapsToDelete */
        $spyProductSearchAttributeMapsToDelete = $this->getSpyProductSearchAttributeMaps(new Criteria(), $con)->diff($spyProductSearchAttributeMaps);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductSearchAttributeMapsScheduledForDeletion = clone $spyProductSearchAttributeMapsToDelete;

        foreach ($spyProductSearchAttributeMapsToDelete as $spyProductSearchAttributeMapRemoved) {
            $spyProductSearchAttributeMapRemoved->setSpyProductAttributeKey(null);
        }

        $this->collSpyProductSearchAttributeMaps = null;
        foreach ($spyProductSearchAttributeMaps as $spyProductSearchAttributeMap) {
            $this->addSpyProductSearchAttributeMap($spyProductSearchAttributeMap);
        }

        $this->collSpyProductSearchAttributeMaps = $spyProductSearchAttributeMaps;
        $this->collSpyProductSearchAttributeMapsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductSearchAttributeMap objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductSearchAttributeMap objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductSearchAttributeMaps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductSearchAttributeMapsPartial && !$this->isNew();
        if (null === $this->collSpyProductSearchAttributeMaps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductSearchAttributeMaps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductSearchAttributeMaps());
            }

            $query = SpyProductSearchAttributeMapQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAttributeKey($this)
                ->count($con);
        }

        return count($this->collSpyProductSearchAttributeMaps);
    }

    /**
     * Method called to associate a SpyProductSearchAttributeMap object to this object
     * through the SpyProductSearchAttributeMap foreign key attribute.
     *
     * @param SpyProductSearchAttributeMap $l SpyProductSearchAttributeMap
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductSearchAttributeMap(SpyProductSearchAttributeMap $l)
    {
        if ($this->collSpyProductSearchAttributeMaps === null) {
            $this->initSpyProductSearchAttributeMaps();
            $this->collSpyProductSearchAttributeMapsPartial = true;
        }

        if (!$this->collSpyProductSearchAttributeMaps->contains($l)) {
            $this->doAddSpyProductSearchAttributeMap($l);

            if ($this->spyProductSearchAttributeMapsScheduledForDeletion and $this->spyProductSearchAttributeMapsScheduledForDeletion->contains($l)) {
                $this->spyProductSearchAttributeMapsScheduledForDeletion->remove($this->spyProductSearchAttributeMapsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductSearchAttributeMap $spyProductSearchAttributeMap The SpyProductSearchAttributeMap object to add.
     */
    protected function doAddSpyProductSearchAttributeMap(SpyProductSearchAttributeMap $spyProductSearchAttributeMap): void
    {
        $this->collSpyProductSearchAttributeMaps[]= $spyProductSearchAttributeMap;
        $spyProductSearchAttributeMap->setSpyProductAttributeKey($this);
    }

    /**
     * @param SpyProductSearchAttributeMap $spyProductSearchAttributeMap The SpyProductSearchAttributeMap object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductSearchAttributeMap(SpyProductSearchAttributeMap $spyProductSearchAttributeMap)
    {
        if ($this->getSpyProductSearchAttributeMaps()->contains($spyProductSearchAttributeMap)) {
            $pos = $this->collSpyProductSearchAttributeMaps->search($spyProductSearchAttributeMap);
            $this->collSpyProductSearchAttributeMaps->remove($pos);
            if (null === $this->spyProductSearchAttributeMapsScheduledForDeletion) {
                $this->spyProductSearchAttributeMapsScheduledForDeletion = clone $this->collSpyProductSearchAttributeMaps;
                $this->spyProductSearchAttributeMapsScheduledForDeletion->clear();
            }
            $this->spyProductSearchAttributeMapsScheduledForDeletion[]= clone $spyProductSearchAttributeMap;
            $spyProductSearchAttributeMap->setSpyProductAttributeKey(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductSearchAttributes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductSearchAttributes()
     */
    public function clearSpyProductSearchAttributes()
    {
        $this->collSpyProductSearchAttributes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductSearchAttributes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductSearchAttributes($v = true): void
    {
        $this->collSpyProductSearchAttributesPartial = $v;
    }

    /**
     * Initializes the collSpyProductSearchAttributes collection.
     *
     * By default this just sets the collSpyProductSearchAttributes collection to an empty array (like clearcollSpyProductSearchAttributes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductSearchAttributes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductSearchAttributes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductSearchAttributeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductSearchAttributes = new $collectionClassName;
        $this->collSpyProductSearchAttributes->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttribute');
    }

    /**
     * Gets an array of SpyProductSearchAttribute objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAttributeKey is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductSearchAttribute[] List of SpyProductSearchAttribute objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductSearchAttribute> List of SpyProductSearchAttribute objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSearchAttributes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductSearchAttributesPartial && !$this->isNew();
        if (null === $this->collSpyProductSearchAttributes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductSearchAttributes) {
                    $this->initSpyProductSearchAttributes();
                } else {
                    $collectionClassName = SpyProductSearchAttributeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductSearchAttributes = new $collectionClassName;
                    $collSpyProductSearchAttributes->setModel('\Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttribute');

                    return $collSpyProductSearchAttributes;
                }
            } else {
                $collSpyProductSearchAttributes = SpyProductSearchAttributeQuery::create(null, $criteria)
                    ->filterBySpyProductAttributeKey($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductSearchAttributesPartial && count($collSpyProductSearchAttributes)) {
                        $this->initSpyProductSearchAttributes(false);

                        foreach ($collSpyProductSearchAttributes as $obj) {
                            if (false == $this->collSpyProductSearchAttributes->contains($obj)) {
                                $this->collSpyProductSearchAttributes->append($obj);
                            }
                        }

                        $this->collSpyProductSearchAttributesPartial = true;
                    }

                    return $collSpyProductSearchAttributes;
                }

                if ($partial && $this->collSpyProductSearchAttributes) {
                    foreach ($this->collSpyProductSearchAttributes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductSearchAttributes[] = $obj;
                        }
                    }
                }

                $this->collSpyProductSearchAttributes = $collSpyProductSearchAttributes;
                $this->collSpyProductSearchAttributesPartial = false;
            }
        }

        return $this->collSpyProductSearchAttributes;
    }

    /**
     * Sets a collection of SpyProductSearchAttribute objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductSearchAttributes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductSearchAttributes(Collection $spyProductSearchAttributes, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductSearchAttribute[] $spyProductSearchAttributesToDelete */
        $spyProductSearchAttributesToDelete = $this->getSpyProductSearchAttributes(new Criteria(), $con)->diff($spyProductSearchAttributes);


        $this->spyProductSearchAttributesScheduledForDeletion = $spyProductSearchAttributesToDelete;

        foreach ($spyProductSearchAttributesToDelete as $spyProductSearchAttributeRemoved) {
            $spyProductSearchAttributeRemoved->setSpyProductAttributeKey(null);
        }

        $this->collSpyProductSearchAttributes = null;
        foreach ($spyProductSearchAttributes as $spyProductSearchAttribute) {
            $this->addSpyProductSearchAttribute($spyProductSearchAttribute);
        }

        $this->collSpyProductSearchAttributes = $spyProductSearchAttributes;
        $this->collSpyProductSearchAttributesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductSearchAttribute objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductSearchAttribute objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductSearchAttributes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductSearchAttributesPartial && !$this->isNew();
        if (null === $this->collSpyProductSearchAttributes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductSearchAttributes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductSearchAttributes());
            }

            $query = SpyProductSearchAttributeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAttributeKey($this)
                ->count($con);
        }

        return count($this->collSpyProductSearchAttributes);
    }

    /**
     * Method called to associate a SpyProductSearchAttribute object to this object
     * through the SpyProductSearchAttribute foreign key attribute.
     *
     * @param SpyProductSearchAttribute $l SpyProductSearchAttribute
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductSearchAttribute(SpyProductSearchAttribute $l)
    {
        if ($this->collSpyProductSearchAttributes === null) {
            $this->initSpyProductSearchAttributes();
            $this->collSpyProductSearchAttributesPartial = true;
        }

        if (!$this->collSpyProductSearchAttributes->contains($l)) {
            $this->doAddSpyProductSearchAttribute($l);

            if ($this->spyProductSearchAttributesScheduledForDeletion and $this->spyProductSearchAttributesScheduledForDeletion->contains($l)) {
                $this->spyProductSearchAttributesScheduledForDeletion->remove($this->spyProductSearchAttributesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductSearchAttribute $spyProductSearchAttribute The SpyProductSearchAttribute object to add.
     */
    protected function doAddSpyProductSearchAttribute(SpyProductSearchAttribute $spyProductSearchAttribute): void
    {
        $this->collSpyProductSearchAttributes[]= $spyProductSearchAttribute;
        $spyProductSearchAttribute->setSpyProductAttributeKey($this);
    }

    /**
     * @param SpyProductSearchAttribute $spyProductSearchAttribute The SpyProductSearchAttribute object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductSearchAttribute(SpyProductSearchAttribute $spyProductSearchAttribute)
    {
        if ($this->getSpyProductSearchAttributes()->contains($spyProductSearchAttribute)) {
            $pos = $this->collSpyProductSearchAttributes->search($spyProductSearchAttribute);
            $this->collSpyProductSearchAttributes->remove($pos);
            if (null === $this->spyProductSearchAttributesScheduledForDeletion) {
                $this->spyProductSearchAttributesScheduledForDeletion = clone $this->collSpyProductSearchAttributes;
                $this->spyProductSearchAttributesScheduledForDeletion->clear();
            }
            $this->spyProductSearchAttributesScheduledForDeletion[]= clone $spyProductSearchAttribute;
            $spyProductSearchAttribute->setSpyProductAttributeKey(null);
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
        $this->id_product_attribute_key = null;
        $this->is_super = null;
        $this->key = null;
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
            if ($this->collSpyProductManagementAttributes) {
                foreach ($this->collSpyProductManagementAttributes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductSearchAttributeMaps) {
                foreach ($this->collSpyProductSearchAttributeMaps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductSearchAttributes) {
                foreach ($this->collSpyProductSearchAttributes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductManagementAttributes = null;
        $this->collSpyProductSearchAttributeMaps = null;
        $this->collSpyProductSearchAttributes = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductAttributeKeyTableMap::DEFAULT_STRING_FORMAT);
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_attribute_key.create';
        } else {
            $this->_eventName = 'Entity.spy_product_attribute_key.update';
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

        if ($this->_eventName !== 'Entity.spy_product_attribute_key.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_attribute_key',
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
            'name' => 'spy_product_attribute_key',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_attribute_key.delete',
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
            $field = str_replace('spy_product_attribute_key.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_attribute_key.', '', $additionalValueColumnName);
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
        $columnType = SpyProductAttributeKeyTableMap::getTableMap()->getColumn($column)->getType();
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
