<?php

namespace Orm\Zed\CmsSlotBlockStorage\Persistence\Map;

use Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorage;
use Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorageQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_cms_slot_block_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsSlotBlockStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsSlotBlockStorage.Persistence.Map.SpyCmsSlotBlockStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_slot_block_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsSlotBlockStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsSlotBlockStorage\\Persistence\\SpyCmsSlotBlockStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsSlotBlockStorage.Persistence.SpyCmsSlotBlockStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_cms_slot_block_storage field
     */
    public const COL_ID_CMS_SLOT_BLOCK_STORAGE = 'spy_cms_slot_block_storage.id_cms_slot_block_storage';

    /**
     * the column name for the fk_cms_slot field
     */
    public const COL_FK_CMS_SLOT = 'spy_cms_slot_block_storage.fk_cms_slot';

    /**
     * the column name for the fk_cms_slot_template field
     */
    public const COL_FK_CMS_SLOT_TEMPLATE = 'spy_cms_slot_block_storage.fk_cms_slot_template';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_cms_slot_block_storage.data';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_slot_block_storage.key';

    /**
     * the column name for the slot_template_key field
     */
    public const COL_SLOT_TEMPLATE_KEY = 'spy_cms_slot_block_storage.slot_template_key';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_cms_slot_block_storage.alias_keys';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_cms_slot_block_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_cms_slot_block_storage.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdCmsSlotBlockStorage', 'FkCmsSlot', 'FkCmsSlotTemplate', 'Data', 'Key', 'SlotTemplateKey', 'AliasKeys', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCmsSlotBlockStorage', 'fkCmsSlot', 'fkCmsSlotTemplate', 'data', 'key', 'slotTemplateKey', 'aliasKeys', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT, SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE, SpyCmsSlotBlockStorageTableMap::COL_DATA, SpyCmsSlotBlockStorageTableMap::COL_KEY, SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY, SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS, SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT, SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_block_storage', 'fk_cms_slot', 'fk_cms_slot_template', 'data', 'key', 'slot_template_key', 'alias_keys', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdCmsSlotBlockStorage' => 0, 'FkCmsSlot' => 1, 'FkCmsSlotTemplate' => 2, 'Data' => 3, 'Key' => 4, 'SlotTemplateKey' => 5, 'AliasKeys' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idCmsSlotBlockStorage' => 0, 'fkCmsSlot' => 1, 'fkCmsSlotTemplate' => 2, 'data' => 3, 'key' => 4, 'slotTemplateKey' => 5, 'aliasKeys' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE => 0, SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT => 1, SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE => 2, SpyCmsSlotBlockStorageTableMap::COL_DATA => 3, SpyCmsSlotBlockStorageTableMap::COL_KEY => 4, SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY => 5, SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS => 6, SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT => 7, SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_block_storage' => 0, 'fk_cms_slot' => 1, 'fk_cms_slot_template' => 2, 'data' => 3, 'key' => 4, 'slot_template_key' => 5, 'alias_keys' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsSlotBlockStorage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'SpyCmsSlotBlockStorage.IdCmsSlotBlockStorage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'idCmsSlotBlockStorage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'spyCmsSlotBlockStorage.idCmsSlotBlockStorage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'COL_ID_CMS_SLOT_BLOCK_STORAGE' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'id_cms_slot_block_storage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'spy_cms_slot_block_storage.id_cms_slot_block_storage' => 'ID_CMS_SLOT_BLOCK_STORAGE',
        'FkCmsSlot' => 'FK_CMS_SLOT',
        'SpyCmsSlotBlockStorage.FkCmsSlot' => 'FK_CMS_SLOT',
        'fkCmsSlot' => 'FK_CMS_SLOT',
        'spyCmsSlotBlockStorage.fkCmsSlot' => 'FK_CMS_SLOT',
        'SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT' => 'FK_CMS_SLOT',
        'COL_FK_CMS_SLOT' => 'FK_CMS_SLOT',
        'fk_cms_slot' => 'FK_CMS_SLOT',
        'spy_cms_slot_block_storage.fk_cms_slot' => 'FK_CMS_SLOT',
        'FkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'SpyCmsSlotBlockStorage.FkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'fkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'spyCmsSlotBlockStorage.fkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE' => 'FK_CMS_SLOT_TEMPLATE',
        'COL_FK_CMS_SLOT_TEMPLATE' => 'FK_CMS_SLOT_TEMPLATE',
        'fk_cms_slot_template' => 'FK_CMS_SLOT_TEMPLATE',
        'spy_cms_slot_block_storage.fk_cms_slot_template' => 'FK_CMS_SLOT_TEMPLATE',
        'Data' => 'DATA',
        'SpyCmsSlotBlockStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyCmsSlotBlockStorage.data' => 'DATA',
        'SpyCmsSlotBlockStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_cms_slot_block_storage.data' => 'DATA',
        'Key' => 'KEY',
        'SpyCmsSlotBlockStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsSlotBlockStorage.key' => 'KEY',
        'SpyCmsSlotBlockStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_slot_block_storage.key' => 'KEY',
        'SlotTemplateKey' => 'SLOT_TEMPLATE_KEY',
        'SpyCmsSlotBlockStorage.SlotTemplateKey' => 'SLOT_TEMPLATE_KEY',
        'slotTemplateKey' => 'SLOT_TEMPLATE_KEY',
        'spyCmsSlotBlockStorage.slotTemplateKey' => 'SLOT_TEMPLATE_KEY',
        'SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY' => 'SLOT_TEMPLATE_KEY',
        'COL_SLOT_TEMPLATE_KEY' => 'SLOT_TEMPLATE_KEY',
        'slot_template_key' => 'SLOT_TEMPLATE_KEY',
        'spy_cms_slot_block_storage.slot_template_key' => 'SLOT_TEMPLATE_KEY',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyCmsSlotBlockStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyCmsSlotBlockStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_cms_slot_block_storage.alias_keys' => 'ALIAS_KEYS',
        'CreatedAt' => 'CREATED_AT',
        'SpyCmsSlotBlockStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCmsSlotBlockStorage.createdAt' => 'CREATED_AT',
        'SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_cms_slot_block_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCmsSlotBlockStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCmsSlotBlockStorage.updatedAt' => 'UPDATED_AT',
        'SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_cms_slot_block_storage.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('spy_cms_slot_block_storage');
        $this->setPhpName('SpyCmsSlotBlockStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsSlotBlockStorage\\Persistence\\SpyCmsSlotBlockStorage');
        $this->setPackage('src.Orm.Zed.CmsSlotBlockStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_slot_block_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_slot_block_storage', 'IdCmsSlotBlockStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_cms_slot', 'FkCmsSlot', 'INTEGER', true, null, null);
        $this->addColumn('fk_cms_slot_template', 'FkCmsSlotTemplate', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 1024, null);
        $this->addColumn('slot_template_key', 'SlotTemplateKey', 'VARCHAR', true, 255, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'synchronization' => ['resource' => ['value' => 'cms_slot_block'], 'queue_group' => ['value' => 'sync.storage.cms'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'slot_template_key']],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdCmsSlotBlockStorage', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SpyCmsSlotBlockStorageTableMap::CLASS_DEFAULT : SpyCmsSlotBlockStorageTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SpyCmsSlotBlockStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsSlotBlockStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsSlotBlockStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsSlotBlockStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsSlotBlockStorageTableMap::OM_CLASS;
            /** @var SpyCmsSlotBlockStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsSlotBlockStorageTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpyCmsSlotBlockStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsSlotBlockStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsSlotBlockStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsSlotBlockStorageTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_slot_block_storage');
            $criteria->addSelectColumn($alias . '.fk_cms_slot');
            $criteria->addSelectColumn($alias . '.fk_cms_slot_template');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.slot_template_key');
            $criteria->addSelectColumn($alias . '.alias_keys');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_slot_block_storage');
            $criteria->removeSelectColumn($alias . '.fk_cms_slot');
            $criteria->removeSelectColumn($alias . '.fk_cms_slot_template');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.slot_template_key');
            $criteria->removeSelectColumn($alias . '.alias_keys');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME)->getTable(SpyCmsSlotBlockStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsSlotBlockStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsSlotBlockStorage object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsSlotBlockStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsSlotBlockStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsSlotBlockStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_slot_block_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsSlotBlockStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsSlotBlockStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsSlotBlockStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsSlotBlockStorage object
        }


        // Set the correct dbName
        $query = SpyCmsSlotBlockStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
