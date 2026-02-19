<?php

namespace Orm\Zed\CmsStorage\Persistence\Map;

use Orm\Zed\CmsStorage\Persistence\SpyCmsPageStorage;
use Orm\Zed\CmsStorage\Persistence\SpyCmsPageStorageQuery;
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
 * This class defines the structure of the 'spy_cms_page_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsPageStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsStorage.Persistence.Map.SpyCmsPageStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_page_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsPageStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsStorage\\Persistence\\SpyCmsPageStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsStorage.Persistence.SpyCmsPageStorage';

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
     * the column name for the id_cms_page_storage field
     */
    public const COL_ID_CMS_PAGE_STORAGE = 'spy_cms_page_storage.id_cms_page_storage';

    /**
     * the column name for the fk_cms_page field
     */
    public const COL_FK_CMS_PAGE = 'spy_cms_page_storage.fk_cms_page';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_cms_page_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_cms_page_storage.store';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_cms_page_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_cms_page_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_page_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_cms_page_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_cms_page_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCmsPageStorage', 'FkCmsPage', 'Data', 'Store', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCmsPageStorage', 'fkCmsPage', 'data', 'store', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE, SpyCmsPageStorageTableMap::COL_FK_CMS_PAGE, SpyCmsPageStorageTableMap::COL_DATA, SpyCmsPageStorageTableMap::COL_STORE, SpyCmsPageStorageTableMap::COL_LOCALE, SpyCmsPageStorageTableMap::COL_ALIAS_KEYS, SpyCmsPageStorageTableMap::COL_KEY, SpyCmsPageStorageTableMap::COL_CREATED_AT, SpyCmsPageStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_cms_page_storage', 'fk_cms_page', 'data', 'store', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCmsPageStorage' => 0, 'FkCmsPage' => 1, 'Data' => 2, 'Store' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idCmsPageStorage' => 0, 'fkCmsPage' => 1, 'data' => 2, 'store' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE => 0, SpyCmsPageStorageTableMap::COL_FK_CMS_PAGE => 1, SpyCmsPageStorageTableMap::COL_DATA => 2, SpyCmsPageStorageTableMap::COL_STORE => 3, SpyCmsPageStorageTableMap::COL_LOCALE => 4, SpyCmsPageStorageTableMap::COL_ALIAS_KEYS => 5, SpyCmsPageStorageTableMap::COL_KEY => 6, SpyCmsPageStorageTableMap::COL_CREATED_AT => 7, SpyCmsPageStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_cms_page_storage' => 0, 'fk_cms_page' => 1, 'data' => 2, 'store' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsPageStorage' => 'ID_CMS_PAGE_STORAGE',
        'SpyCmsPageStorage.IdCmsPageStorage' => 'ID_CMS_PAGE_STORAGE',
        'idCmsPageStorage' => 'ID_CMS_PAGE_STORAGE',
        'spyCmsPageStorage.idCmsPageStorage' => 'ID_CMS_PAGE_STORAGE',
        'SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE' => 'ID_CMS_PAGE_STORAGE',
        'COL_ID_CMS_PAGE_STORAGE' => 'ID_CMS_PAGE_STORAGE',
        'id_cms_page_storage' => 'ID_CMS_PAGE_STORAGE',
        'spy_cms_page_storage.id_cms_page_storage' => 'ID_CMS_PAGE_STORAGE',
        'FkCmsPage' => 'FK_CMS_PAGE',
        'SpyCmsPageStorage.FkCmsPage' => 'FK_CMS_PAGE',
        'fkCmsPage' => 'FK_CMS_PAGE',
        'spyCmsPageStorage.fkCmsPage' => 'FK_CMS_PAGE',
        'SpyCmsPageStorageTableMap::COL_FK_CMS_PAGE' => 'FK_CMS_PAGE',
        'COL_FK_CMS_PAGE' => 'FK_CMS_PAGE',
        'fk_cms_page' => 'FK_CMS_PAGE',
        'spy_cms_page_storage.fk_cms_page' => 'FK_CMS_PAGE',
        'Data' => 'DATA',
        'SpyCmsPageStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyCmsPageStorage.data' => 'DATA',
        'SpyCmsPageStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_cms_page_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyCmsPageStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyCmsPageStorage.store' => 'STORE',
        'SpyCmsPageStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_cms_page_storage.store' => 'STORE',
        'Locale' => 'LOCALE',
        'SpyCmsPageStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyCmsPageStorage.locale' => 'LOCALE',
        'SpyCmsPageStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_cms_page_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyCmsPageStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyCmsPageStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyCmsPageStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_cms_page_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyCmsPageStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsPageStorage.key' => 'KEY',
        'SpyCmsPageStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_page_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyCmsPageStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCmsPageStorage.createdAt' => 'CREATED_AT',
        'SpyCmsPageStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_cms_page_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCmsPageStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCmsPageStorage.updatedAt' => 'UPDATED_AT',
        'SpyCmsPageStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_cms_page_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_cms_page_storage');
        $this->setPhpName('SpyCmsPageStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsStorage\\Persistence\\SpyCmsPageStorage');
        $this->setPackage('src.Orm.Zed.CmsStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_page_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_page_storage', 'IdCmsPageStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_cms_page', 'FkCmsPage', 'INTEGER', true, null, null);
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
            'synchronization' => ['resource' => ['value' => 'cms_page'], 'queue_group' => ['value' => 'sync.storage.cms'], 'queue_pool' => NULL, 'mappings' => ['value' => 'uuid:id_cms_page'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'fk_cms_page'], 'store' => ['required' => 'false']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsPageStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsPageStorageTableMap::CLASS_DEFAULT : SpyCmsPageStorageTableMap::OM_CLASS;
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
     * @return array (SpyCmsPageStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsPageStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsPageStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsPageStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsPageStorageTableMap::OM_CLASS;
            /** @var SpyCmsPageStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsPageStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsPageStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsPageStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsPageStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsPageStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_FK_CMS_PAGE);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCmsPageStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_page_storage');
            $criteria->addSelectColumn($alias . '.fk_cms_page');
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
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_FK_CMS_PAGE);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCmsPageStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_page_storage');
            $criteria->removeSelectColumn($alias . '.fk_cms_page');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsPageStorageTableMap::DATABASE_NAME)->getTable(SpyCmsPageStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsPageStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsPageStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsStorage\Persistence\SpyCmsPageStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsPageStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsPageStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsPageStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsPageStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_page_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsPageStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsPageStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsPageStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsPageStorage object
        }

        if ($criteria->containsKey(SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE) && $criteria->keyContainsValue(SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsPageStorageTableMap::COL_ID_CMS_PAGE_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyCmsPageStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
