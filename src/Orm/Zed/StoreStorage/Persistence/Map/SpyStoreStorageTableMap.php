<?php

namespace Orm\Zed\StoreStorage\Persistence\Map;

use Orm\Zed\StoreStorage\Persistence\SpyStoreStorage;
use Orm\Zed\StoreStorage\Persistence\SpyStoreStorageQuery;
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
 * This class defines the structure of the 'spy_store_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStoreStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.StoreStorage.Persistence.Map.SpyStoreStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_store_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStoreStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\StoreStorage\\Persistence\\SpyStoreStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.StoreStorage.Persistence.SpyStoreStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_spy_store_storage field
     */
    public const COL_ID_SPY_STORE_STORAGE = 'spy_store_storage.id_spy_store_storage';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_store_storage.fk_store';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_store_storage.data';

    /**
     * the column name for the store_name field
     */
    public const COL_STORE_NAME = 'spy_store_storage.store_name';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_store_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_store_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_store_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_store_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSpyStoreStorage', 'FkStore', 'Data', 'StoreName', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSpyStoreStorage', 'fkStore', 'data', 'storeName', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE, SpyStoreStorageTableMap::COL_FK_STORE, SpyStoreStorageTableMap::COL_DATA, SpyStoreStorageTableMap::COL_STORE_NAME, SpyStoreStorageTableMap::COL_ALIAS_KEYS, SpyStoreStorageTableMap::COL_KEY, SpyStoreStorageTableMap::COL_CREATED_AT, SpyStoreStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_spy_store_storage', 'fk_store', 'data', 'store_name', 'alias_keys', 'key', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdSpyStoreStorage' => 0, 'FkStore' => 1, 'Data' => 2, 'StoreName' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idSpyStoreStorage' => 0, 'fkStore' => 1, 'data' => 2, 'storeName' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE => 0, SpyStoreStorageTableMap::COL_FK_STORE => 1, SpyStoreStorageTableMap::COL_DATA => 2, SpyStoreStorageTableMap::COL_STORE_NAME => 3, SpyStoreStorageTableMap::COL_ALIAS_KEYS => 4, SpyStoreStorageTableMap::COL_KEY => 5, SpyStoreStorageTableMap::COL_CREATED_AT => 6, SpyStoreStorageTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_spy_store_storage' => 0, 'fk_store' => 1, 'data' => 2, 'store_name' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSpyStoreStorage' => 'ID_SPY_STORE_STORAGE',
        'SpyStoreStorage.IdSpyStoreStorage' => 'ID_SPY_STORE_STORAGE',
        'idSpyStoreStorage' => 'ID_SPY_STORE_STORAGE',
        'spyStoreStorage.idSpyStoreStorage' => 'ID_SPY_STORE_STORAGE',
        'SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE' => 'ID_SPY_STORE_STORAGE',
        'COL_ID_SPY_STORE_STORAGE' => 'ID_SPY_STORE_STORAGE',
        'id_spy_store_storage' => 'ID_SPY_STORE_STORAGE',
        'spy_store_storage.id_spy_store_storage' => 'ID_SPY_STORE_STORAGE',
        'FkStore' => 'FK_STORE',
        'SpyStoreStorage.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyStoreStorage.fkStore' => 'FK_STORE',
        'SpyStoreStorageTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_store_storage.fk_store' => 'FK_STORE',
        'Data' => 'DATA',
        'SpyStoreStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyStoreStorage.data' => 'DATA',
        'SpyStoreStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_store_storage.data' => 'DATA',
        'StoreName' => 'STORE_NAME',
        'SpyStoreStorage.StoreName' => 'STORE_NAME',
        'storeName' => 'STORE_NAME',
        'spyStoreStorage.storeName' => 'STORE_NAME',
        'SpyStoreStorageTableMap::COL_STORE_NAME' => 'STORE_NAME',
        'COL_STORE_NAME' => 'STORE_NAME',
        'store_name' => 'STORE_NAME',
        'spy_store_storage.store_name' => 'STORE_NAME',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyStoreStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyStoreStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyStoreStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_store_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyStoreStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyStoreStorage.key' => 'KEY',
        'SpyStoreStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_store_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyStoreStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyStoreStorage.createdAt' => 'CREATED_AT',
        'SpyStoreStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_store_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyStoreStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyStoreStorage.updatedAt' => 'UPDATED_AT',
        'SpyStoreStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_store_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_store_storage');
        $this->setPhpName('SpyStoreStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\StoreStorage\\Persistence\\SpyStoreStorage');
        $this->setPackage('src.Orm.Zed.StoreStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_spy_store_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_spy_store_storage', 'IdSpyStoreStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_store', 'FkStore', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('store_name', 'StoreName', 'VARCHAR', true, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'store'], 'queue_group' => ['value' => 'sync.storage.store'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'store_name']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSpyStoreStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStoreStorageTableMap::CLASS_DEFAULT : SpyStoreStorageTableMap::OM_CLASS;
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
     * @return array (SpyStoreStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStoreStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStoreStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStoreStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStoreStorageTableMap::OM_CLASS;
            /** @var SpyStoreStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStoreStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStoreStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStoreStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStoreStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStoreStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_STORE_NAME);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyStoreStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_spy_store_storage');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.store_name');
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
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_STORE_NAME);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyStoreStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_spy_store_storage');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.store_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStoreStorageTableMap::DATABASE_NAME)->getTable(SpyStoreStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStoreStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStoreStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\StoreStorage\Persistence\SpyStoreStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStoreStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyStoreStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStoreStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStoreStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_store_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStoreStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStoreStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStoreStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStoreStorage object
        }

        if ($criteria->containsKey(SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE) && $criteria->keyContainsValue(SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStoreStorageTableMap::COL_ID_SPY_STORE_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyStoreStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
