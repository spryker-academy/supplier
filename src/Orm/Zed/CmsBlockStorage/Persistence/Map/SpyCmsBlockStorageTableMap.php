<?php

namespace Orm\Zed\CmsBlockStorage\Persistence\Map;

use Orm\Zed\CmsBlockStorage\Persistence\SpyCmsBlockStorage;
use Orm\Zed\CmsBlockStorage\Persistence\SpyCmsBlockStorageQuery;
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
 * This class defines the structure of the 'spy_cms_block_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsBlockStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsBlockStorage.Persistence.Map.SpyCmsBlockStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_block_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsBlockStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsBlockStorage\\Persistence\\SpyCmsBlockStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsBlockStorage.Persistence.SpyCmsBlockStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id_cms_block_storage field
     */
    public const COL_ID_CMS_BLOCK_STORAGE = 'spy_cms_block_storage.id_cms_block_storage';

    /**
     * the column name for the fk_cms_block field
     */
    public const COL_FK_CMS_BLOCK = 'spy_cms_block_storage.fk_cms_block';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_cms_block_storage.name';

    /**
     * the column name for the cms_block_key field
     */
    public const COL_CMS_BLOCK_KEY = 'spy_cms_block_storage.cms_block_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_cms_block_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_cms_block_storage.store';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_cms_block_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_cms_block_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_block_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_cms_block_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_cms_block_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCmsBlockStorage', 'FkCmsBlock', 'Name', 'CmsBlockKey', 'Data', 'Store', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCmsBlockStorage', 'fkCmsBlock', 'name', 'cmsBlockKey', 'data', 'store', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE, SpyCmsBlockStorageTableMap::COL_FK_CMS_BLOCK, SpyCmsBlockStorageTableMap::COL_NAME, SpyCmsBlockStorageTableMap::COL_CMS_BLOCK_KEY, SpyCmsBlockStorageTableMap::COL_DATA, SpyCmsBlockStorageTableMap::COL_STORE, SpyCmsBlockStorageTableMap::COL_LOCALE, SpyCmsBlockStorageTableMap::COL_ALIAS_KEYS, SpyCmsBlockStorageTableMap::COL_KEY, SpyCmsBlockStorageTableMap::COL_CREATED_AT, SpyCmsBlockStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_storage', 'fk_cms_block', 'name', 'cms_block_key', 'data', 'store', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['IdCmsBlockStorage' => 0, 'FkCmsBlock' => 1, 'Name' => 2, 'CmsBlockKey' => 3, 'Data' => 4, 'Store' => 5, 'Locale' => 6, 'AliasKeys' => 7, 'Key' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idCmsBlockStorage' => 0, 'fkCmsBlock' => 1, 'name' => 2, 'cmsBlockKey' => 3, 'data' => 4, 'store' => 5, 'locale' => 6, 'aliasKeys' => 7, 'key' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE => 0, SpyCmsBlockStorageTableMap::COL_FK_CMS_BLOCK => 1, SpyCmsBlockStorageTableMap::COL_NAME => 2, SpyCmsBlockStorageTableMap::COL_CMS_BLOCK_KEY => 3, SpyCmsBlockStorageTableMap::COL_DATA => 4, SpyCmsBlockStorageTableMap::COL_STORE => 5, SpyCmsBlockStorageTableMap::COL_LOCALE => 6, SpyCmsBlockStorageTableMap::COL_ALIAS_KEYS => 7, SpyCmsBlockStorageTableMap::COL_KEY => 8, SpyCmsBlockStorageTableMap::COL_CREATED_AT => 9, SpyCmsBlockStorageTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_storage' => 0, 'fk_cms_block' => 1, 'name' => 2, 'cms_block_key' => 3, 'data' => 4, 'store' => 5, 'locale' => 6, 'alias_keys' => 7, 'key' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsBlockStorage' => 'ID_CMS_BLOCK_STORAGE',
        'SpyCmsBlockStorage.IdCmsBlockStorage' => 'ID_CMS_BLOCK_STORAGE',
        'idCmsBlockStorage' => 'ID_CMS_BLOCK_STORAGE',
        'spyCmsBlockStorage.idCmsBlockStorage' => 'ID_CMS_BLOCK_STORAGE',
        'SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE' => 'ID_CMS_BLOCK_STORAGE',
        'COL_ID_CMS_BLOCK_STORAGE' => 'ID_CMS_BLOCK_STORAGE',
        'id_cms_block_storage' => 'ID_CMS_BLOCK_STORAGE',
        'spy_cms_block_storage.id_cms_block_storage' => 'ID_CMS_BLOCK_STORAGE',
        'FkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockStorage.FkCmsBlock' => 'FK_CMS_BLOCK',
        'fkCmsBlock' => 'FK_CMS_BLOCK',
        'spyCmsBlockStorage.fkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockStorageTableMap::COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'fk_cms_block' => 'FK_CMS_BLOCK',
        'spy_cms_block_storage.fk_cms_block' => 'FK_CMS_BLOCK',
        'Name' => 'NAME',
        'SpyCmsBlockStorage.Name' => 'NAME',
        'name' => 'NAME',
        'spyCmsBlockStorage.name' => 'NAME',
        'SpyCmsBlockStorageTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_cms_block_storage.name' => 'NAME',
        'CmsBlockKey' => 'CMS_BLOCK_KEY',
        'SpyCmsBlockStorage.CmsBlockKey' => 'CMS_BLOCK_KEY',
        'cmsBlockKey' => 'CMS_BLOCK_KEY',
        'spyCmsBlockStorage.cmsBlockKey' => 'CMS_BLOCK_KEY',
        'SpyCmsBlockStorageTableMap::COL_CMS_BLOCK_KEY' => 'CMS_BLOCK_KEY',
        'COL_CMS_BLOCK_KEY' => 'CMS_BLOCK_KEY',
        'cms_block_key' => 'CMS_BLOCK_KEY',
        'spy_cms_block_storage.cms_block_key' => 'CMS_BLOCK_KEY',
        'Data' => 'DATA',
        'SpyCmsBlockStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyCmsBlockStorage.data' => 'DATA',
        'SpyCmsBlockStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_cms_block_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyCmsBlockStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyCmsBlockStorage.store' => 'STORE',
        'SpyCmsBlockStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_cms_block_storage.store' => 'STORE',
        'Locale' => 'LOCALE',
        'SpyCmsBlockStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyCmsBlockStorage.locale' => 'LOCALE',
        'SpyCmsBlockStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_cms_block_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyCmsBlockStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyCmsBlockStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyCmsBlockStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_cms_block_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyCmsBlockStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsBlockStorage.key' => 'KEY',
        'SpyCmsBlockStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_block_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyCmsBlockStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCmsBlockStorage.createdAt' => 'CREATED_AT',
        'SpyCmsBlockStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_cms_block_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCmsBlockStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCmsBlockStorage.updatedAt' => 'UPDATED_AT',
        'SpyCmsBlockStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_cms_block_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_cms_block_storage');
        $this->setPhpName('SpyCmsBlockStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsBlockStorage\\Persistence\\SpyCmsBlockStorage');
        $this->setPackage('src.Orm.Zed.CmsBlockStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_block_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_block_storage', 'IdCmsBlockStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_cms_block', 'FkCmsBlock', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('cms_block_key', 'CmsBlockKey', 'VARCHAR', true, 255, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('store', 'Store', 'VARCHAR', false, 128, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 16, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'cms_block'], 'queue_group' => ['value' => 'sync.storage.cms'], 'queue_pool' => NULL, 'mappings' => ['value' => 'name:key'], 'key_suffix_column' => ['value' => 'cms_block_key'], 'store' => ['required' => 'false'], 'locale' => ['required' => 'true']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdCmsBlockStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsBlockStorageTableMap::CLASS_DEFAULT : SpyCmsBlockStorageTableMap::OM_CLASS;
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
     * @return array (SpyCmsBlockStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsBlockStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsBlockStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsBlockStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsBlockStorageTableMap::OM_CLASS;
            /** @var SpyCmsBlockStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsBlockStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsBlockStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsBlockStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsBlockStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsBlockStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_FK_CMS_BLOCK);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_CMS_BLOCK_KEY);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCmsBlockStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_block_storage');
            $criteria->addSelectColumn($alias . '.fk_cms_block');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.cms_block_key');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.store');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.alias_keys');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_FK_CMS_BLOCK);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_CMS_BLOCK_KEY);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCmsBlockStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_block_storage');
            $criteria->removeSelectColumn($alias . '.fk_cms_block');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.cms_block_key');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.store');
            $criteria->removeSelectColumn($alias . '.locale');
            $criteria->removeSelectColumn($alias . '.alias_keys');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsBlockStorageTableMap::DATABASE_NAME)->getTable(SpyCmsBlockStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsBlockStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsBlockStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsBlockStorage\Persistence\SpyCmsBlockStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsBlockStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsBlockStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsBlockStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsBlockStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_block_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsBlockStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsBlockStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsBlockStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsBlockStorage object
        }

        if ($criteria->containsKey(SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE) && $criteria->keyContainsValue(SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsBlockStorageTableMap::COL_ID_CMS_BLOCK_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyCmsBlockStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
