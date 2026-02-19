<?php

namespace Orm\Zed\NavigationStorage\Persistence\Map;

use Orm\Zed\NavigationStorage\Persistence\SpyNavigationStorage;
use Orm\Zed\NavigationStorage\Persistence\SpyNavigationStorageQuery;
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
 * This class defines the structure of the 'spy_navigation_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyNavigationStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.NavigationStorage.Persistence.Map.SpyNavigationStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_navigation_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyNavigationStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\NavigationStorage\\Persistence\\SpyNavigationStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.NavigationStorage.Persistence.SpyNavigationStorage';

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
     * the column name for the id_navigation_storage field
     */
    public const COL_ID_NAVIGATION_STORAGE = 'spy_navigation_storage.id_navigation_storage';

    /**
     * the column name for the fk_navigation field
     */
    public const COL_FK_NAVIGATION = 'spy_navigation_storage.fk_navigation';

    /**
     * the column name for the navigation_key field
     */
    public const COL_NAVIGATION_KEY = 'spy_navigation_storage.navigation_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_navigation_storage.data';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_navigation_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_navigation_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_navigation_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_navigation_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_navigation_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdNavigationStorage', 'FkNavigation', 'NavigationKey', 'Data', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idNavigationStorage', 'fkNavigation', 'navigationKey', 'data', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE, SpyNavigationStorageTableMap::COL_FK_NAVIGATION, SpyNavigationStorageTableMap::COL_NAVIGATION_KEY, SpyNavigationStorageTableMap::COL_DATA, SpyNavigationStorageTableMap::COL_LOCALE, SpyNavigationStorageTableMap::COL_ALIAS_KEYS, SpyNavigationStorageTableMap::COL_KEY, SpyNavigationStorageTableMap::COL_CREATED_AT, SpyNavigationStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_navigation_storage', 'fk_navigation', 'navigation_key', 'data', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdNavigationStorage' => 0, 'FkNavigation' => 1, 'NavigationKey' => 2, 'Data' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idNavigationStorage' => 0, 'fkNavigation' => 1, 'navigationKey' => 2, 'data' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE => 0, SpyNavigationStorageTableMap::COL_FK_NAVIGATION => 1, SpyNavigationStorageTableMap::COL_NAVIGATION_KEY => 2, SpyNavigationStorageTableMap::COL_DATA => 3, SpyNavigationStorageTableMap::COL_LOCALE => 4, SpyNavigationStorageTableMap::COL_ALIAS_KEYS => 5, SpyNavigationStorageTableMap::COL_KEY => 6, SpyNavigationStorageTableMap::COL_CREATED_AT => 7, SpyNavigationStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_navigation_storage' => 0, 'fk_navigation' => 1, 'navigation_key' => 2, 'data' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdNavigationStorage' => 'ID_NAVIGATION_STORAGE',
        'SpyNavigationStorage.IdNavigationStorage' => 'ID_NAVIGATION_STORAGE',
        'idNavigationStorage' => 'ID_NAVIGATION_STORAGE',
        'spyNavigationStorage.idNavigationStorage' => 'ID_NAVIGATION_STORAGE',
        'SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE' => 'ID_NAVIGATION_STORAGE',
        'COL_ID_NAVIGATION_STORAGE' => 'ID_NAVIGATION_STORAGE',
        'id_navigation_storage' => 'ID_NAVIGATION_STORAGE',
        'spy_navigation_storage.id_navigation_storage' => 'ID_NAVIGATION_STORAGE',
        'FkNavigation' => 'FK_NAVIGATION',
        'SpyNavigationStorage.FkNavigation' => 'FK_NAVIGATION',
        'fkNavigation' => 'FK_NAVIGATION',
        'spyNavigationStorage.fkNavigation' => 'FK_NAVIGATION',
        'SpyNavigationStorageTableMap::COL_FK_NAVIGATION' => 'FK_NAVIGATION',
        'COL_FK_NAVIGATION' => 'FK_NAVIGATION',
        'fk_navigation' => 'FK_NAVIGATION',
        'spy_navigation_storage.fk_navigation' => 'FK_NAVIGATION',
        'NavigationKey' => 'NAVIGATION_KEY',
        'SpyNavigationStorage.NavigationKey' => 'NAVIGATION_KEY',
        'navigationKey' => 'NAVIGATION_KEY',
        'spyNavigationStorage.navigationKey' => 'NAVIGATION_KEY',
        'SpyNavigationStorageTableMap::COL_NAVIGATION_KEY' => 'NAVIGATION_KEY',
        'COL_NAVIGATION_KEY' => 'NAVIGATION_KEY',
        'navigation_key' => 'NAVIGATION_KEY',
        'spy_navigation_storage.navigation_key' => 'NAVIGATION_KEY',
        'Data' => 'DATA',
        'SpyNavigationStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyNavigationStorage.data' => 'DATA',
        'SpyNavigationStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_navigation_storage.data' => 'DATA',
        'Locale' => 'LOCALE',
        'SpyNavigationStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyNavigationStorage.locale' => 'LOCALE',
        'SpyNavigationStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_navigation_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyNavigationStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyNavigationStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyNavigationStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_navigation_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyNavigationStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyNavigationStorage.key' => 'KEY',
        'SpyNavigationStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_navigation_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyNavigationStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyNavigationStorage.createdAt' => 'CREATED_AT',
        'SpyNavigationStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_navigation_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyNavigationStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyNavigationStorage.updatedAt' => 'UPDATED_AT',
        'SpyNavigationStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_navigation_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_navigation_storage');
        $this->setPhpName('SpyNavigationStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\NavigationStorage\\Persistence\\SpyNavigationStorage');
        $this->setPackage('src.Orm.Zed.NavigationStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_navigation_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_navigation_storage', 'IdNavigationStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_navigation', 'FkNavigation', 'INTEGER', true, null, null);
        $this->addColumn('navigation_key', 'NavigationKey', 'VARCHAR', true, 255, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
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
            'synchronization' => ['resource' => ['value' => 'navigation'], 'queue_group' => ['value' => 'sync.storage.category'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'navigation_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdNavigationStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyNavigationStorageTableMap::CLASS_DEFAULT : SpyNavigationStorageTableMap::OM_CLASS;
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
     * @return array (SpyNavigationStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyNavigationStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyNavigationStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyNavigationStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyNavigationStorageTableMap::OM_CLASS;
            /** @var SpyNavigationStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyNavigationStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyNavigationStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyNavigationStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyNavigationStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyNavigationStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_FK_NAVIGATION);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_NAVIGATION_KEY);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyNavigationStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_navigation_storage');
            $criteria->addSelectColumn($alias . '.fk_navigation');
            $criteria->addSelectColumn($alias . '.navigation_key');
            $criteria->addSelectColumn($alias . '.data');
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
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_FK_NAVIGATION);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_NAVIGATION_KEY);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyNavigationStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_navigation_storage');
            $criteria->removeSelectColumn($alias . '.fk_navigation');
            $criteria->removeSelectColumn($alias . '.navigation_key');
            $criteria->removeSelectColumn($alias . '.data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyNavigationStorageTableMap::DATABASE_NAME)->getTable(SpyNavigationStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyNavigationStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyNavigationStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\NavigationStorage\Persistence\SpyNavigationStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyNavigationStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyNavigationStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyNavigationStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyNavigationStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_navigation_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyNavigationStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyNavigationStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyNavigationStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyNavigationStorage object
        }

        if ($criteria->containsKey(SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE) && $criteria->keyContainsValue(SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyNavigationStorageTableMap::COL_ID_NAVIGATION_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyNavigationStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
