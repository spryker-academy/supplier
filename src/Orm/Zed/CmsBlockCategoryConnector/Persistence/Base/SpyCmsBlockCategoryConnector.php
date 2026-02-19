<?php

namespace Orm\Zed\CmsBlockCategoryConnector\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Category\Persistence\SpyCategory;
use Orm\Zed\Category\Persistence\SpyCategoryQuery;
use Orm\Zed\Category\Persistence\SpyCategoryTemplate;
use Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery as ChildSpyCmsBlockCategoryConnectorQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryPosition as ChildSpyCmsBlockCategoryPosition;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryPositionQuery as ChildSpyCmsBlockCategoryPositionQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Map\SpyCmsBlockCategoryConnectorTableMap;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlock;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_cms_block_category_connector' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CmsBlockCategoryConnector.Persistence.Base
 */
abstract class SpyCmsBlockCategoryConnector implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\Map\\SpyCmsBlockCategoryConnectorTableMap';


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
     * The value for the id_cms_block_category_connector field.
     *
     * @var        int
     */
    protected $id_cms_block_category_connector;

    /**
     * The value for the fk_category field.
     *
     * @var        int
     */
    protected $fk_category;

    /**
     * The value for the fk_category_template field.
     *
     * @var        int
     */
    protected $fk_category_template;

    /**
     * The value for the fk_cms_block field.
     *
     * @var        int
     */
    protected $fk_cms_block;

    /**
     * The value for the fk_cms_block_category_position field.
     *
     * @var        int|null
     */
    protected $fk_cms_block_category_position;

    /**
     * @var        SpyCmsBlock
     */
    protected $aCmsBlock;

    /**
     * @var        SpyCategory
     */
    protected $aCategory;

    /**
     * @var        SpyCategoryTemplate
     */
    protected $aCategoryTemplate;

    /**
     * @var        ChildSpyCmsBlockCategoryPosition
     */
    protected $aCmsBlockCategoryPosition;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Orm\Zed\CmsBlockCategoryConnector\Persistence\Base\SpyCmsBlockCategoryConnector object.
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
     * Compares this with another <code>SpyCmsBlockCategoryConnector</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCmsBlockCategoryConnector</code>, delegates to
     * <code>equals(SpyCmsBlockCategoryConnector)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_cms_block_category_connector] column value.
     *
     * @return int
     */
    public function getIdCmsBlockCategoryConnector()
    {
        return $this->id_cms_block_category_connector;
    }

    /**
     * Get the [fk_category] column value.
     *
     * @return int
     */
    public function getFkCategory()
    {
        return $this->fk_category;
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
     * Get the [fk_cms_block] column value.
     *
     * @return int
     */
    public function getFkCmsBlock()
    {
        return $this->fk_cms_block;
    }

    /**
     * Get the [fk_cms_block_category_position] column value.
     *
     * @return int|null
     */
    public function getFkCmsBlockCategoryPosition()
    {
        return $this->fk_cms_block_category_position;
    }

    /**
     * Set the value of [id_cms_block_category_connector] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCmsBlockCategoryConnector($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_cms_block_category_connector !== $v) {
            $this->id_cms_block_category_connector = $v;
            $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_category] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCategory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_category !== $v) {
            $this->fk_category = $v;
            $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY] = true;
        }

        if ($this->aCategory !== null && $this->aCategory->getIdCategory() !== $v) {
            $this->aCategory = null;
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
            $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE] = true;
        }

        if ($this->aCategoryTemplate !== null && $this->aCategoryTemplate->getIdCategoryTemplate() !== $v) {
            $this->aCategoryTemplate = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_cms_block] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCmsBlock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_cms_block !== $v) {
            $this->fk_cms_block = $v;
            $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK] = true;
        }

        if ($this->aCmsBlock !== null && $this->aCmsBlock->getIdCmsBlock() !== $v) {
            $this->aCmsBlock = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_cms_block_category_position] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCmsBlockCategoryPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_cms_block_category_position !== $v) {
            $this->fk_cms_block_category_position = $v;
            $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION] = true;
        }

        if ($this->aCmsBlockCategoryPosition !== null && $this->aCmsBlockCategoryPosition->getIdCmsBlockCategoryPosition() !== $v) {
            $this->aCmsBlockCategoryPosition = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCmsBlockCategoryConnectorTableMap::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_cms_block_category_connector = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCmsBlockCategoryConnectorTableMap::translateFieldName('FkCategory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_category = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCmsBlockCategoryConnectorTableMap::translateFieldName('FkCategoryTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_category_template = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCmsBlockCategoryConnectorTableMap::translateFieldName('FkCmsBlock', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_cms_block = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCmsBlockCategoryConnectorTableMap::translateFieldName('FkCmsBlockCategoryPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_cms_block_category_position = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SpyCmsBlockCategoryConnectorTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryConnector'), 0, $e);
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
        if ($this->aCategory !== null && $this->fk_category !== $this->aCategory->getIdCategory()) {
            $this->aCategory = null;
        }
        if ($this->aCategoryTemplate !== null && $this->fk_category_template !== $this->aCategoryTemplate->getIdCategoryTemplate()) {
            $this->aCategoryTemplate = null;
        }
        if ($this->aCmsBlock !== null && $this->fk_cms_block !== $this->aCmsBlock->getIdCmsBlock()) {
            $this->aCmsBlock = null;
        }
        if ($this->aCmsBlockCategoryPosition !== null && $this->fk_cms_block_category_position !== $this->aCmsBlockCategoryPosition->getIdCmsBlockCategoryPosition()) {
            $this->aCmsBlockCategoryPosition = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCmsBlockCategoryConnectorQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCmsBlock = null;
            $this->aCategory = null;
            $this->aCategoryTemplate = null;
            $this->aCmsBlockCategoryPosition = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCmsBlockCategoryConnector::setDeleted()
     * @see SpyCmsBlockCategoryConnector::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCmsBlockCategoryConnectorQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
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
                SpyCmsBlockCategoryConnectorTableMap::addInstanceToPool($this);
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

            if ($this->aCmsBlock !== null) {
                if ($this->aCmsBlock->isModified() || $this->aCmsBlock->isNew()) {
                    $affectedRows += $this->aCmsBlock->save($con);
                }
                $this->setCmsBlock($this->aCmsBlock);
            }

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
            }

            if ($this->aCategoryTemplate !== null) {
                if ($this->aCategoryTemplate->isModified() || $this->aCategoryTemplate->isNew()) {
                    $affectedRows += $this->aCategoryTemplate->save($con);
                }
                $this->setCategoryTemplate($this->aCategoryTemplate);
            }

            if ($this->aCmsBlockCategoryPosition !== null) {
                if ($this->aCmsBlockCategoryPosition->isModified() || $this->aCmsBlockCategoryPosition->isNew()) {
                    $affectedRows += $this->aCmsBlockCategoryPosition->save($con);
                }
                $this->setCmsBlockCategoryPosition($this->aCmsBlockCategoryPosition);
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

        $this->modifiedColumns[SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR] = true;
        if (null !== $this->id_cms_block_category_connector) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR)) {
            $modifiedColumns[':p' . $index++]  = 'id_cms_block_category_connector';
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_category';
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_category_template';
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK)) {
            $modifiedColumns[':p' . $index++]  = 'fk_cms_block';
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'fk_cms_block_category_position';
        }

        $sql = sprintf(
            'INSERT INTO spy_cms_block_category_connector (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_cms_block_category_connector':
                        $stmt->bindValue($identifier, $this->id_cms_block_category_connector, PDO::PARAM_INT);

                        break;
                    case 'fk_category':
                        $stmt->bindValue($identifier, $this->fk_category, PDO::PARAM_INT);

                        break;
                    case 'fk_category_template':
                        $stmt->bindValue($identifier, $this->fk_category_template, PDO::PARAM_INT);

                        break;
                    case 'fk_cms_block':
                        $stmt->bindValue($identifier, $this->fk_cms_block, PDO::PARAM_INT);

                        break;
                    case 'fk_cms_block_category_position':
                        $stmt->bindValue($identifier, $this->fk_cms_block_category_position, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_cms_block_category_connector_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCmsBlockCategoryConnector($pk);

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
        $pos = SpyCmsBlockCategoryConnectorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCmsBlockCategoryConnector();

            case 1:
                return $this->getFkCategory();

            case 2:
                return $this->getFkCategoryTemplate();

            case 3:
                return $this->getFkCmsBlock();

            case 4:
                return $this->getFkCmsBlockCategoryPosition();

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
        if (isset($alreadyDumpedObjects['SpyCmsBlockCategoryConnector'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCmsBlockCategoryConnector'][$this->hashCode()] = true;
        $keys = SpyCmsBlockCategoryConnectorTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCmsBlockCategoryConnector(),
            $keys[1] => $this->getFkCategory(),
            $keys[2] => $this->getFkCategoryTemplate(),
            $keys[3] => $this->getFkCmsBlock(),
            $keys[4] => $this->getFkCmsBlockCategoryPosition(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCmsBlock) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlock';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block';
                        break;
                    default:
                        $key = 'CmsBlock';
                }

                $result[$key] = $this->aCmsBlock->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategory) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategory';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category';
                        break;
                    default:
                        $key = 'Category';
                }

                $result[$key] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aCmsBlockCategoryPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockCategoryPosition';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_category_position';
                        break;
                    default:
                        $key = 'CmsBlockCategoryPosition';
                }

                $result[$key] = $this->aCmsBlockCategoryPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyCmsBlockCategoryConnectorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCmsBlockCategoryConnector($value);
                break;
            case 1:
                $this->setFkCategory($value);
                break;
            case 2:
                $this->setFkCategoryTemplate($value);
                break;
            case 3:
                $this->setFkCmsBlock($value);
                break;
            case 4:
                $this->setFkCmsBlockCategoryPosition($value);
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
        $keys = SpyCmsBlockCategoryConnectorTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCmsBlockCategoryConnector($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCategory($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCategoryTemplate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkCmsBlock($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkCmsBlockCategoryPosition($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR)) {
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR, $this->id_cms_block_category_connector);
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY)) {
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY, $this->fk_category);
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE)) {
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE, $this->fk_category_template);
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK)) {
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK, $this->fk_cms_block);
        }
        if ($this->isColumnModified(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION)) {
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION, $this->fk_cms_block_category_position);
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
        $criteria = ChildSpyCmsBlockCategoryConnectorQuery::create();
        $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR, $this->id_cms_block_category_connector);

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
        $validPk = null !== $this->getIdCmsBlockCategoryConnector();

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
        return $this->getIdCmsBlockCategoryConnector();
    }

    /**
     * Generic method to set the primary key (id_cms_block_category_connector column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCmsBlockCategoryConnector($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCmsBlockCategoryConnector();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCategory($this->getFkCategory());
        $copyObj->setFkCategoryTemplate($this->getFkCategoryTemplate());
        $copyObj->setFkCmsBlock($this->getFkCmsBlock());
        $copyObj->setFkCmsBlockCategoryPosition($this->getFkCmsBlockCategoryPosition());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCmsBlockCategoryConnector(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector Clone of current object.
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
     * Declares an association between this object and a SpyCmsBlock object.
     *
     * @param SpyCmsBlock $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCmsBlock(SpyCmsBlock $v = null)
    {
        if ($v === null) {
            $this->setFkCmsBlock(NULL);
        } else {
            $this->setFkCmsBlock($v->getIdCmsBlock());
        }

        $this->aCmsBlock = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCmsBlock object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsBlockCategoryConnector($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCmsBlock object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCmsBlock The associated SpyCmsBlock object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCmsBlock(?ConnectionInterface $con = null)
    {
        if ($this->aCmsBlock === null && ($this->fk_cms_block != 0)) {
            $this->aCmsBlock = SpyCmsBlockQuery::create()->findPk($this->fk_cms_block, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCmsBlock->addSpyCmsBlockCategoryConnectors($this);
             */
        }

        return $this->aCmsBlock;
    }

    /**
     * Declares an association between this object and a SpyCategory object.
     *
     * @param SpyCategory $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCategory(SpyCategory $v = null)
    {
        if ($v === null) {
            $this->setFkCategory(NULL);
        } else {
            $this->setFkCategory($v->getIdCategory());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsBlockCategoryConnector($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCategory object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCategory The associated SpyCategory object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCategory(?ConnectionInterface $con = null)
    {
        if ($this->aCategory === null && ($this->fk_category != 0)) {
            $this->aCategory = SpyCategoryQuery::create()->findPk($this->fk_category, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addSpyCmsBlockCategoryConnectors($this);
             */
        }

        return $this->aCategory;
    }

    /**
     * Declares an association between this object and a SpyCategoryTemplate object.
     *
     * @param SpyCategoryTemplate $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCategoryTemplate(SpyCategoryTemplate $v = null)
    {
        if ($v === null) {
            $this->setFkCategoryTemplate(NULL);
        } else {
            $this->setFkCategoryTemplate($v->getIdCategoryTemplate());
        }

        $this->aCategoryTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCategoryTemplate object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsBlockCategoryConnector($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCategoryTemplate object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCategoryTemplate The associated SpyCategoryTemplate object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCategoryTemplate(?ConnectionInterface $con = null)
    {
        if ($this->aCategoryTemplate === null && ($this->fk_category_template != 0)) {
            $this->aCategoryTemplate = SpyCategoryTemplateQuery::create()->findPk($this->fk_category_template, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoryTemplate->addSpyCmsBlockCategoryConnectors($this);
             */
        }

        return $this->aCategoryTemplate;
    }

    /**
     * Declares an association between this object and a ChildSpyCmsBlockCategoryPosition object.
     *
     * @param ChildSpyCmsBlockCategoryPosition|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCmsBlockCategoryPosition(ChildSpyCmsBlockCategoryPosition $v = null)
    {
        if ($v === null) {
            $this->setFkCmsBlockCategoryPosition(NULL);
        } else {
            $this->setFkCmsBlockCategoryPosition($v->getIdCmsBlockCategoryPosition());
        }

        $this->aCmsBlockCategoryPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCmsBlockCategoryPosition object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCmsBlockCategoryConnector($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCmsBlockCategoryPosition object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCmsBlockCategoryPosition|null The associated ChildSpyCmsBlockCategoryPosition object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCmsBlockCategoryPosition(?ConnectionInterface $con = null)
    {
        if ($this->aCmsBlockCategoryPosition === null && ($this->fk_cms_block_category_position != 0)) {
            $this->aCmsBlockCategoryPosition = ChildSpyCmsBlockCategoryPositionQuery::create()->findPk($this->fk_cms_block_category_position, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCmsBlockCategoryPosition->addSpyCmsBlockCategoryConnectors($this);
             */
        }

        return $this->aCmsBlockCategoryPosition;
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
        if (null !== $this->aCmsBlock) {
            $this->aCmsBlock->removeSpyCmsBlockCategoryConnector($this);
        }
        if (null !== $this->aCategory) {
            $this->aCategory->removeSpyCmsBlockCategoryConnector($this);
        }
        if (null !== $this->aCategoryTemplate) {
            $this->aCategoryTemplate->removeSpyCmsBlockCategoryConnector($this);
        }
        if (null !== $this->aCmsBlockCategoryPosition) {
            $this->aCmsBlockCategoryPosition->removeSpyCmsBlockCategoryConnector($this);
        }
        $this->id_cms_block_category_connector = null;
        $this->fk_category = null;
        $this->fk_category_template = null;
        $this->fk_cms_block = null;
        $this->fk_cms_block_category_position = null;
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
        } // if ($deep)

        $this->aCmsBlock = null;
        $this->aCategory = null;
        $this->aCategoryTemplate = null;
        $this->aCmsBlockCategoryPosition = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCmsBlockCategoryConnectorTableMap::DEFAULT_STRING_FORMAT);
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
