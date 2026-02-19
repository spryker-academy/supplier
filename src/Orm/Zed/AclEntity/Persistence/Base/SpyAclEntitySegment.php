<?php

namespace Orm\Zed\AclEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRule as ChildSpyAclEntityRule;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery as ChildSpyAclEntityRuleQuery;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment as ChildSpyAclEntitySegment;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery as ChildSpyAclEntitySegmentQuery;
use Orm\Zed\AclEntity\Persistence\Map\SpyAclEntityRuleTableMap;
use Orm\Zed\AclEntity\Persistence\Map\SpyAclEntitySegmentTableMap;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery;
use Orm\Zed\MerchantUser\Persistence\Base\SpyAclEntitySegmentMerchantUser as BaseSpyAclEntitySegmentMerchantUser;
use Orm\Zed\MerchantUser\Persistence\Map\SpyAclEntitySegmentMerchantUserTableMap;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery;
use Orm\Zed\Merchant\Persistence\Base\SpyAclEntitySegmentMerchant as BaseSpyAclEntitySegmentMerchant;
use Orm\Zed\Merchant\Persistence\Map\SpyAclEntitySegmentMerchantTableMap;
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
 * Base class that represents a row from the 'spy_acl_entity_segment' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.AclEntity.Persistence.Base
 */
abstract class SpyAclEntitySegment implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\AclEntity\\Persistence\\Map\\SpyAclEntitySegmentTableMap';


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
     * The value for the id_acl_entity_segment field.
     *
     * @var        int
     */
    protected $id_acl_entity_segment;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the reference field.
     * A reference to another resource or definition.
     * @var        string
     */
    protected $reference;

    /**
     * @var        ObjectCollection|ChildSpyAclEntityRule[] Collection to store aggregation of ChildSpyAclEntityRule objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclEntityRule> Collection to store aggregation of ChildSpyAclEntityRule objects.
     */
    protected $collSpyAclEntityRules;
    protected $collSpyAclEntityRulesPartial;

    /**
     * @var        ObjectCollection|SpyAclEntitySegmentMerchant[] Collection to store aggregation of SpyAclEntitySegmentMerchant objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntitySegmentMerchant> Collection to store aggregation of SpyAclEntitySegmentMerchant objects.
     */
    protected $collSpyAclEntitySegmentMerchants;
    protected $collSpyAclEntitySegmentMerchantsPartial;

    /**
     * @var        ObjectCollection|SpyAclEntitySegmentMerchantUser[] Collection to store aggregation of SpyAclEntitySegmentMerchantUser objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntitySegmentMerchantUser> Collection to store aggregation of SpyAclEntitySegmentMerchantUser objects.
     */
    protected $collSpyAclEntitySegmentMerchantUsers;
    protected $collSpyAclEntitySegmentMerchantUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyAclEntityRule[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyAclEntityRule>
     */
    protected $spyAclEntityRulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAclEntitySegmentMerchant[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntitySegmentMerchant>
     */
    protected $spyAclEntitySegmentMerchantsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAclEntitySegmentMerchantUser[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAclEntitySegmentMerchantUser>
     */
    protected $spyAclEntitySegmentMerchantUsersScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\AclEntity\Persistence\Base\SpyAclEntitySegment object.
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
     * Compares this with another <code>SpyAclEntitySegment</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyAclEntitySegment</code>, delegates to
     * <code>equals(SpyAclEntitySegment)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_acl_entity_segment] column value.
     *
     * @return int
     */
    public function getIdAclEntitySegment()
    {
        return $this->id_acl_entity_segment;
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
     * Get the [reference] column value.
     * A reference to another resource or definition.
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set the value of [id_acl_entity_segment] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdAclEntitySegment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_acl_entity_segment !== $v) {
            $this->id_acl_entity_segment = $v;
            $this->modifiedColumns[SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT] = true;
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
            $this->modifiedColumns[SpyAclEntitySegmentTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reference] column.
     * A reference to another resource or definition.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->reference !== $v) {
            $this->reference = $v;
            $this->modifiedColumns[SpyAclEntitySegmentTableMap::COL_REFERENCE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyAclEntitySegmentTableMap::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_acl_entity_segment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyAclEntitySegmentTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyAclEntitySegmentTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyAclEntitySegmentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyAclEntitySegmentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyAclEntityRules = null;

            $this->collSpyAclEntitySegmentMerchants = null;

            $this->collSpyAclEntitySegmentMerchantUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyAclEntitySegment::setDeleted()
     * @see SpyAclEntitySegment::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyAclEntitySegmentQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                SpyAclEntitySegmentTableMap::addInstanceToPool($this);
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

            if ($this->spyAclEntityRulesScheduledForDeletion !== null) {
                if (!$this->spyAclEntityRulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery::create()
                        ->filterByPrimaryKeys($this->spyAclEntityRulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclEntityRulesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclEntityRules !== null) {
                foreach ($this->collSpyAclEntityRules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyAclEntitySegmentMerchantsScheduledForDeletion !== null) {
                if (!$this->spyAclEntitySegmentMerchantsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery::create()
                        ->filterByPrimaryKeys($this->spyAclEntitySegmentMerchantsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclEntitySegmentMerchantsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclEntitySegmentMerchants !== null) {
                foreach ($this->collSpyAclEntitySegmentMerchants as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyAclEntitySegmentMerchantUsersScheduledForDeletion !== null) {
                if (!$this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery::create()
                        ->filterByPrimaryKeys($this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAclEntitySegmentMerchantUsers !== null) {
                foreach ($this->collSpyAclEntitySegmentMerchantUsers as $referrerFK) {
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

        $this->modifiedColumns[SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT] = true;
        if (null !== $this->id_acl_entity_segment) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT)) {
            $modifiedColumns[':p' . $index++]  = 'id_acl_entity_segment';
        }
        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }

        $sql = sprintf(
            'INSERT INTO spy_acl_entity_segment (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_acl_entity_segment':
                        $stmt->bindValue($identifier, $this->id_acl_entity_segment, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'reference':
                        $stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_acl_entity_segment_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdAclEntitySegment($pk);

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
        $pos = SpyAclEntitySegmentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAclEntitySegment();

            case 1:
                return $this->getName();

            case 2:
                return $this->getReference();

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
        if (isset($alreadyDumpedObjects['SpyAclEntitySegment'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyAclEntitySegment'][$this->hashCode()] = true;
        $keys = SpyAclEntitySegmentTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdAclEntitySegment(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getReference(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyAclEntityRules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclEntityRules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_entity_rules';
                        break;
                    default:
                        $key = 'SpyAclEntityRules';
                }

                $result[$key] = $this->collSpyAclEntityRules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyAclEntitySegmentMerchants) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclEntitySegmentMerchants';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_entity_segment_merchants';
                        break;
                    default:
                        $key = 'SpyAclEntitySegmentMerchants';
                }

                $result[$key] = $this->collSpyAclEntitySegmentMerchants->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyAclEntitySegmentMerchantUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAclEntitySegmentMerchantUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_acl_entity_segment_merchant_users';
                        break;
                    default:
                        $key = 'SpyAclEntitySegmentMerchantUsers';
                }

                $result[$key] = $this->collSpyAclEntitySegmentMerchantUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyAclEntitySegmentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdAclEntitySegment($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setReference($value);
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
        $keys = SpyAclEntitySegmentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdAclEntitySegment($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setReference($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyAclEntitySegmentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT)) {
            $criteria->add(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $this->id_acl_entity_segment);
        }
        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_NAME)) {
            $criteria->add(SpyAclEntitySegmentTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyAclEntitySegmentTableMap::COL_REFERENCE)) {
            $criteria->add(SpyAclEntitySegmentTableMap::COL_REFERENCE, $this->reference);
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
        $criteria = ChildSpyAclEntitySegmentQuery::create();
        $criteria->add(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $this->id_acl_entity_segment);

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
        $validPk = null !== $this->getIdAclEntitySegment();

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
        return $this->getIdAclEntitySegment();
    }

    /**
     * Generic method to set the primary key (id_acl_entity_segment column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdAclEntitySegment($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdAclEntitySegment();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setReference($this->getReference());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyAclEntityRules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclEntityRule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclEntitySegmentMerchants() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclEntitySegmentMerchant($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAclEntitySegmentMerchantUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAclEntitySegmentMerchantUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAclEntitySegment(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment Clone of current object.
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
        if ('SpyAclEntityRule' === $relationName) {
            $this->initSpyAclEntityRules();
            return;
        }
        if ('SpyAclEntitySegmentMerchant' === $relationName) {
            $this->initSpyAclEntitySegmentMerchants();
            return;
        }
        if ('SpyAclEntitySegmentMerchantUser' === $relationName) {
            $this->initSpyAclEntitySegmentMerchantUsers();
            return;
        }
    }

    /**
     * Clears out the collSpyAclEntityRules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclEntityRules()
     */
    public function clearSpyAclEntityRules()
    {
        $this->collSpyAclEntityRules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclEntityRules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclEntityRules($v = true): void
    {
        $this->collSpyAclEntityRulesPartial = $v;
    }

    /**
     * Initializes the collSpyAclEntityRules collection.
     *
     * By default this just sets the collSpyAclEntityRules collection to an empty array (like clearcollSpyAclEntityRules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclEntityRules(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclEntityRules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclEntityRuleTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclEntityRules = new $collectionClassName;
        $this->collSpyAclEntityRules->setModel('\Orm\Zed\AclEntity\Persistence\SpyAclEntityRule');
    }

    /**
     * Gets an array of ChildSpyAclEntityRule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclEntitySegment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyAclEntityRule[] List of ChildSpyAclEntityRule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclEntityRule> List of ChildSpyAclEntityRule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclEntityRules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclEntityRulesPartial && !$this->isNew();
        if (null === $this->collSpyAclEntityRules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclEntityRules) {
                    $this->initSpyAclEntityRules();
                } else {
                    $collectionClassName = SpyAclEntityRuleTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclEntityRules = new $collectionClassName;
                    $collSpyAclEntityRules->setModel('\Orm\Zed\AclEntity\Persistence\SpyAclEntityRule');

                    return $collSpyAclEntityRules;
                }
            } else {
                $collSpyAclEntityRules = ChildSpyAclEntityRuleQuery::create(null, $criteria)
                    ->filterBySpyAclEntitySegment($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclEntityRulesPartial && count($collSpyAclEntityRules)) {
                        $this->initSpyAclEntityRules(false);

                        foreach ($collSpyAclEntityRules as $obj) {
                            if (false == $this->collSpyAclEntityRules->contains($obj)) {
                                $this->collSpyAclEntityRules->append($obj);
                            }
                        }

                        $this->collSpyAclEntityRulesPartial = true;
                    }

                    return $collSpyAclEntityRules;
                }

                if ($partial && $this->collSpyAclEntityRules) {
                    foreach ($this->collSpyAclEntityRules as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclEntityRules[] = $obj;
                        }
                    }
                }

                $this->collSpyAclEntityRules = $collSpyAclEntityRules;
                $this->collSpyAclEntityRulesPartial = false;
            }
        }

        return $this->collSpyAclEntityRules;
    }

    /**
     * Sets a collection of ChildSpyAclEntityRule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclEntityRules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclEntityRules(Collection $spyAclEntityRules, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyAclEntityRule[] $spyAclEntityRulesToDelete */
        $spyAclEntityRulesToDelete = $this->getSpyAclEntityRules(new Criteria(), $con)->diff($spyAclEntityRules);


        $this->spyAclEntityRulesScheduledForDeletion = $spyAclEntityRulesToDelete;

        foreach ($spyAclEntityRulesToDelete as $spyAclEntityRuleRemoved) {
            $spyAclEntityRuleRemoved->setSpyAclEntitySegment(null);
        }

        $this->collSpyAclEntityRules = null;
        foreach ($spyAclEntityRules as $spyAclEntityRule) {
            $this->addSpyAclEntityRule($spyAclEntityRule);
        }

        $this->collSpyAclEntityRules = $spyAclEntityRules;
        $this->collSpyAclEntityRulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyAclEntityRule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyAclEntityRule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclEntityRules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclEntityRulesPartial && !$this->isNew();
        if (null === $this->collSpyAclEntityRules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclEntityRules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclEntityRules());
            }

            $query = ChildSpyAclEntityRuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclEntitySegment($this)
                ->count($con);
        }

        return count($this->collSpyAclEntityRules);
    }

    /**
     * Method called to associate a ChildSpyAclEntityRule object to this object
     * through the ChildSpyAclEntityRule foreign key attribute.
     *
     * @param ChildSpyAclEntityRule $l ChildSpyAclEntityRule
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclEntityRule(ChildSpyAclEntityRule $l)
    {
        if ($this->collSpyAclEntityRules === null) {
            $this->initSpyAclEntityRules();
            $this->collSpyAclEntityRulesPartial = true;
        }

        if (!$this->collSpyAclEntityRules->contains($l)) {
            $this->doAddSpyAclEntityRule($l);

            if ($this->spyAclEntityRulesScheduledForDeletion and $this->spyAclEntityRulesScheduledForDeletion->contains($l)) {
                $this->spyAclEntityRulesScheduledForDeletion->remove($this->spyAclEntityRulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyAclEntityRule $spyAclEntityRule The ChildSpyAclEntityRule object to add.
     */
    protected function doAddSpyAclEntityRule(ChildSpyAclEntityRule $spyAclEntityRule): void
    {
        $this->collSpyAclEntityRules[]= $spyAclEntityRule;
        $spyAclEntityRule->setSpyAclEntitySegment($this);
    }

    /**
     * @param ChildSpyAclEntityRule $spyAclEntityRule The ChildSpyAclEntityRule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclEntityRule(ChildSpyAclEntityRule $spyAclEntityRule)
    {
        if ($this->getSpyAclEntityRules()->contains($spyAclEntityRule)) {
            $pos = $this->collSpyAclEntityRules->search($spyAclEntityRule);
            $this->collSpyAclEntityRules->remove($pos);
            if (null === $this->spyAclEntityRulesScheduledForDeletion) {
                $this->spyAclEntityRulesScheduledForDeletion = clone $this->collSpyAclEntityRules;
                $this->spyAclEntityRulesScheduledForDeletion->clear();
            }
            $this->spyAclEntityRulesScheduledForDeletion[]= $spyAclEntityRule;
            $spyAclEntityRule->setSpyAclEntitySegment(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclEntitySegment is new, it will return
     * an empty collection; or if this SpyAclEntitySegment has previously
     * been saved, it will retrieve related SpyAclEntityRules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclEntitySegment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyAclEntityRule[] List of ChildSpyAclEntityRule objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyAclEntityRule}> List of ChildSpyAclEntityRule objects
     */
    public function getSpyAclEntityRulesJoinSpyAclRole(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyAclEntityRuleQuery::create(null, $criteria);
        $query->joinWith('SpyAclRole', $joinBehavior);

        return $this->getSpyAclEntityRules($query, $con);
    }

    /**
     * Clears out the collSpyAclEntitySegmentMerchants collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclEntitySegmentMerchants()
     */
    public function clearSpyAclEntitySegmentMerchants()
    {
        $this->collSpyAclEntitySegmentMerchants = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclEntitySegmentMerchants collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclEntitySegmentMerchants($v = true): void
    {
        $this->collSpyAclEntitySegmentMerchantsPartial = $v;
    }

    /**
     * Initializes the collSpyAclEntitySegmentMerchants collection.
     *
     * By default this just sets the collSpyAclEntitySegmentMerchants collection to an empty array (like clearcollSpyAclEntitySegmentMerchants());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclEntitySegmentMerchants(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclEntitySegmentMerchants && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclEntitySegmentMerchantTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclEntitySegmentMerchants = new $collectionClassName;
        $this->collSpyAclEntitySegmentMerchants->setModel('\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant');
    }

    /**
     * Gets an array of SpyAclEntitySegmentMerchant objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclEntitySegment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAclEntitySegmentMerchant[] List of SpyAclEntitySegmentMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntitySegmentMerchant> List of SpyAclEntitySegmentMerchant objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclEntitySegmentMerchants(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclEntitySegmentMerchantsPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchants || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclEntitySegmentMerchants) {
                    $this->initSpyAclEntitySegmentMerchants();
                } else {
                    $collectionClassName = SpyAclEntitySegmentMerchantTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclEntitySegmentMerchants = new $collectionClassName;
                    $collSpyAclEntitySegmentMerchants->setModel('\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant');

                    return $collSpyAclEntitySegmentMerchants;
                }
            } else {
                $collSpyAclEntitySegmentMerchants = SpyAclEntitySegmentMerchantQuery::create(null, $criteria)
                    ->filterBySpyAclEntitySegment($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclEntitySegmentMerchantsPartial && count($collSpyAclEntitySegmentMerchants)) {
                        $this->initSpyAclEntitySegmentMerchants(false);

                        foreach ($collSpyAclEntitySegmentMerchants as $obj) {
                            if (false == $this->collSpyAclEntitySegmentMerchants->contains($obj)) {
                                $this->collSpyAclEntitySegmentMerchants->append($obj);
                            }
                        }

                        $this->collSpyAclEntitySegmentMerchantsPartial = true;
                    }

                    return $collSpyAclEntitySegmentMerchants;
                }

                if ($partial && $this->collSpyAclEntitySegmentMerchants) {
                    foreach ($this->collSpyAclEntitySegmentMerchants as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclEntitySegmentMerchants[] = $obj;
                        }
                    }
                }

                $this->collSpyAclEntitySegmentMerchants = $collSpyAclEntitySegmentMerchants;
                $this->collSpyAclEntitySegmentMerchantsPartial = false;
            }
        }

        return $this->collSpyAclEntitySegmentMerchants;
    }

    /**
     * Sets a collection of SpyAclEntitySegmentMerchant objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclEntitySegmentMerchants A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclEntitySegmentMerchants(Collection $spyAclEntitySegmentMerchants, ?ConnectionInterface $con = null)
    {
        /** @var SpyAclEntitySegmentMerchant[] $spyAclEntitySegmentMerchantsToDelete */
        $spyAclEntitySegmentMerchantsToDelete = $this->getSpyAclEntitySegmentMerchants(new Criteria(), $con)->diff($spyAclEntitySegmentMerchants);


        $this->spyAclEntitySegmentMerchantsScheduledForDeletion = $spyAclEntitySegmentMerchantsToDelete;

        foreach ($spyAclEntitySegmentMerchantsToDelete as $spyAclEntitySegmentMerchantRemoved) {
            $spyAclEntitySegmentMerchantRemoved->setSpyAclEntitySegment(null);
        }

        $this->collSpyAclEntitySegmentMerchants = null;
        foreach ($spyAclEntitySegmentMerchants as $spyAclEntitySegmentMerchant) {
            $this->addSpyAclEntitySegmentMerchant($spyAclEntitySegmentMerchant);
        }

        $this->collSpyAclEntitySegmentMerchants = $spyAclEntitySegmentMerchants;
        $this->collSpyAclEntitySegmentMerchantsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAclEntitySegmentMerchant objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAclEntitySegmentMerchant objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclEntitySegmentMerchants(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclEntitySegmentMerchantsPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchants || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclEntitySegmentMerchants) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclEntitySegmentMerchants());
            }

            $query = SpyAclEntitySegmentMerchantQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclEntitySegment($this)
                ->count($con);
        }

        return count($this->collSpyAclEntitySegmentMerchants);
    }

    /**
     * Method called to associate a SpyAclEntitySegmentMerchant object to this object
     * through the SpyAclEntitySegmentMerchant foreign key attribute.
     *
     * @param SpyAclEntitySegmentMerchant $l SpyAclEntitySegmentMerchant
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclEntitySegmentMerchant(SpyAclEntitySegmentMerchant $l)
    {
        if ($this->collSpyAclEntitySegmentMerchants === null) {
            $this->initSpyAclEntitySegmentMerchants();
            $this->collSpyAclEntitySegmentMerchantsPartial = true;
        }

        if (!$this->collSpyAclEntitySegmentMerchants->contains($l)) {
            $this->doAddSpyAclEntitySegmentMerchant($l);

            if ($this->spyAclEntitySegmentMerchantsScheduledForDeletion and $this->spyAclEntitySegmentMerchantsScheduledForDeletion->contains($l)) {
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion->remove($this->spyAclEntitySegmentMerchantsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant The SpyAclEntitySegmentMerchant object to add.
     */
    protected function doAddSpyAclEntitySegmentMerchant(SpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant): void
    {
        $this->collSpyAclEntitySegmentMerchants[]= $spyAclEntitySegmentMerchant;
        $spyAclEntitySegmentMerchant->setSpyAclEntitySegment($this);
    }

    /**
     * @param SpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant The SpyAclEntitySegmentMerchant object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclEntitySegmentMerchant(SpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant)
    {
        if ($this->getSpyAclEntitySegmentMerchants()->contains($spyAclEntitySegmentMerchant)) {
            $pos = $this->collSpyAclEntitySegmentMerchants->search($spyAclEntitySegmentMerchant);
            $this->collSpyAclEntitySegmentMerchants->remove($pos);
            if (null === $this->spyAclEntitySegmentMerchantsScheduledForDeletion) {
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion = clone $this->collSpyAclEntitySegmentMerchants;
                $this->spyAclEntitySegmentMerchantsScheduledForDeletion->clear();
            }
            $this->spyAclEntitySegmentMerchantsScheduledForDeletion[]= clone $spyAclEntitySegmentMerchant;
            $spyAclEntitySegmentMerchant->setSpyAclEntitySegment(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclEntitySegment is new, it will return
     * an empty collection; or if this SpyAclEntitySegment has previously
     * been saved, it will retrieve related SpyAclEntitySegmentMerchants from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclEntitySegment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAclEntitySegmentMerchant[] List of SpyAclEntitySegmentMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntitySegmentMerchant}> List of SpyAclEntitySegmentMerchant objects
     */
    public function getSpyAclEntitySegmentMerchantsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAclEntitySegmentMerchantQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyAclEntitySegmentMerchants($query, $con);
    }

    /**
     * Clears out the collSpyAclEntitySegmentMerchantUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAclEntitySegmentMerchantUsers()
     */
    public function clearSpyAclEntitySegmentMerchantUsers()
    {
        $this->collSpyAclEntitySegmentMerchantUsers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAclEntitySegmentMerchantUsers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAclEntitySegmentMerchantUsers($v = true): void
    {
        $this->collSpyAclEntitySegmentMerchantUsersPartial = $v;
    }

    /**
     * Initializes the collSpyAclEntitySegmentMerchantUsers collection.
     *
     * By default this just sets the collSpyAclEntitySegmentMerchantUsers collection to an empty array (like clearcollSpyAclEntitySegmentMerchantUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAclEntitySegmentMerchantUsers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAclEntitySegmentMerchantUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAclEntitySegmentMerchantUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAclEntitySegmentMerchantUsers = new $collectionClassName;
        $this->collSpyAclEntitySegmentMerchantUsers->setModel('\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser');
    }

    /**
     * Gets an array of SpyAclEntitySegmentMerchantUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyAclEntitySegment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAclEntitySegmentMerchantUser[] List of SpyAclEntitySegmentMerchantUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntitySegmentMerchantUser> List of SpyAclEntitySegmentMerchantUser objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAclEntitySegmentMerchantUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAclEntitySegmentMerchantUsersPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchantUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAclEntitySegmentMerchantUsers) {
                    $this->initSpyAclEntitySegmentMerchantUsers();
                } else {
                    $collectionClassName = SpyAclEntitySegmentMerchantUserTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAclEntitySegmentMerchantUsers = new $collectionClassName;
                    $collSpyAclEntitySegmentMerchantUsers->setModel('\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser');

                    return $collSpyAclEntitySegmentMerchantUsers;
                }
            } else {
                $collSpyAclEntitySegmentMerchantUsers = SpyAclEntitySegmentMerchantUserQuery::create(null, $criteria)
                    ->filterBySpyAclEntitySegment($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAclEntitySegmentMerchantUsersPartial && count($collSpyAclEntitySegmentMerchantUsers)) {
                        $this->initSpyAclEntitySegmentMerchantUsers(false);

                        foreach ($collSpyAclEntitySegmentMerchantUsers as $obj) {
                            if (false == $this->collSpyAclEntitySegmentMerchantUsers->contains($obj)) {
                                $this->collSpyAclEntitySegmentMerchantUsers->append($obj);
                            }
                        }

                        $this->collSpyAclEntitySegmentMerchantUsersPartial = true;
                    }

                    return $collSpyAclEntitySegmentMerchantUsers;
                }

                if ($partial && $this->collSpyAclEntitySegmentMerchantUsers) {
                    foreach ($this->collSpyAclEntitySegmentMerchantUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAclEntitySegmentMerchantUsers[] = $obj;
                        }
                    }
                }

                $this->collSpyAclEntitySegmentMerchantUsers = $collSpyAclEntitySegmentMerchantUsers;
                $this->collSpyAclEntitySegmentMerchantUsersPartial = false;
            }
        }

        return $this->collSpyAclEntitySegmentMerchantUsers;
    }

    /**
     * Sets a collection of SpyAclEntitySegmentMerchantUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAclEntitySegmentMerchantUsers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAclEntitySegmentMerchantUsers(Collection $spyAclEntitySegmentMerchantUsers, ?ConnectionInterface $con = null)
    {
        /** @var SpyAclEntitySegmentMerchantUser[] $spyAclEntitySegmentMerchantUsersToDelete */
        $spyAclEntitySegmentMerchantUsersToDelete = $this->getSpyAclEntitySegmentMerchantUsers(new Criteria(), $con)->diff($spyAclEntitySegmentMerchantUsers);


        $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion = $spyAclEntitySegmentMerchantUsersToDelete;

        foreach ($spyAclEntitySegmentMerchantUsersToDelete as $spyAclEntitySegmentMerchantUserRemoved) {
            $spyAclEntitySegmentMerchantUserRemoved->setSpyAclEntitySegment(null);
        }

        $this->collSpyAclEntitySegmentMerchantUsers = null;
        foreach ($spyAclEntitySegmentMerchantUsers as $spyAclEntitySegmentMerchantUser) {
            $this->addSpyAclEntitySegmentMerchantUser($spyAclEntitySegmentMerchantUser);
        }

        $this->collSpyAclEntitySegmentMerchantUsers = $spyAclEntitySegmentMerchantUsers;
        $this->collSpyAclEntitySegmentMerchantUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAclEntitySegmentMerchantUser objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAclEntitySegmentMerchantUser objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAclEntitySegmentMerchantUsers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAclEntitySegmentMerchantUsersPartial && !$this->isNew();
        if (null === $this->collSpyAclEntitySegmentMerchantUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAclEntitySegmentMerchantUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAclEntitySegmentMerchantUsers());
            }

            $query = SpyAclEntitySegmentMerchantUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyAclEntitySegment($this)
                ->count($con);
        }

        return count($this->collSpyAclEntitySegmentMerchantUsers);
    }

    /**
     * Method called to associate a SpyAclEntitySegmentMerchantUser object to this object
     * through the SpyAclEntitySegmentMerchantUser foreign key attribute.
     *
     * @param SpyAclEntitySegmentMerchantUser $l SpyAclEntitySegmentMerchantUser
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAclEntitySegmentMerchantUser(SpyAclEntitySegmentMerchantUser $l)
    {
        if ($this->collSpyAclEntitySegmentMerchantUsers === null) {
            $this->initSpyAclEntitySegmentMerchantUsers();
            $this->collSpyAclEntitySegmentMerchantUsersPartial = true;
        }

        if (!$this->collSpyAclEntitySegmentMerchantUsers->contains($l)) {
            $this->doAddSpyAclEntitySegmentMerchantUser($l);

            if ($this->spyAclEntitySegmentMerchantUsersScheduledForDeletion and $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->contains($l)) {
                $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->remove($this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAclEntitySegmentMerchantUser $spyAclEntitySegmentMerchantUser The SpyAclEntitySegmentMerchantUser object to add.
     */
    protected function doAddSpyAclEntitySegmentMerchantUser(SpyAclEntitySegmentMerchantUser $spyAclEntitySegmentMerchantUser): void
    {
        $this->collSpyAclEntitySegmentMerchantUsers[]= $spyAclEntitySegmentMerchantUser;
        $spyAclEntitySegmentMerchantUser->setSpyAclEntitySegment($this);
    }

    /**
     * @param SpyAclEntitySegmentMerchantUser $spyAclEntitySegmentMerchantUser The SpyAclEntitySegmentMerchantUser object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAclEntitySegmentMerchantUser(SpyAclEntitySegmentMerchantUser $spyAclEntitySegmentMerchantUser)
    {
        if ($this->getSpyAclEntitySegmentMerchantUsers()->contains($spyAclEntitySegmentMerchantUser)) {
            $pos = $this->collSpyAclEntitySegmentMerchantUsers->search($spyAclEntitySegmentMerchantUser);
            $this->collSpyAclEntitySegmentMerchantUsers->remove($pos);
            if (null === $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion) {
                $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion = clone $this->collSpyAclEntitySegmentMerchantUsers;
                $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion->clear();
            }
            $this->spyAclEntitySegmentMerchantUsersScheduledForDeletion[]= clone $spyAclEntitySegmentMerchantUser;
            $spyAclEntitySegmentMerchantUser->setSpyAclEntitySegment(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyAclEntitySegment is new, it will return
     * an empty collection; or if this SpyAclEntitySegment has previously
     * been saved, it will retrieve related SpyAclEntitySegmentMerchantUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyAclEntitySegment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAclEntitySegmentMerchantUser[] List of SpyAclEntitySegmentMerchantUser objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAclEntitySegmentMerchantUser}> List of SpyAclEntitySegmentMerchantUser objects
     */
    public function getSpyAclEntitySegmentMerchantUsersJoinSpyMerchantUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAclEntitySegmentMerchantUserQuery::create(null, $criteria);
        $query->joinWith('SpyMerchantUser', $joinBehavior);

        return $this->getSpyAclEntitySegmentMerchantUsers($query, $con);
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
        $this->id_acl_entity_segment = null;
        $this->name = null;
        $this->reference = null;
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
            if ($this->collSpyAclEntityRules) {
                foreach ($this->collSpyAclEntityRules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclEntitySegmentMerchants) {
                foreach ($this->collSpyAclEntitySegmentMerchants as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAclEntitySegmentMerchantUsers) {
                foreach ($this->collSpyAclEntitySegmentMerchantUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyAclEntityRules = null;
        $this->collSpyAclEntitySegmentMerchants = null;
        $this->collSpyAclEntitySegmentMerchantUsers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyAclEntitySegmentTableMap::DEFAULT_STRING_FORMAT);
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
