<?php

namespace Orm\Zed\CategoryStorage\Persistence\Map;

use Orm\Zed\CategoryStorage\Persistence\SpyCategoryTreeStorage;
use Orm\Zed\CategoryStorage\Persistence\SpyCategoryTreeStorageQuery;
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
 * This class defines the structure of the 'spy_category_tree_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCategoryTreeStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CategoryStorage.Persistence.Map.SpyCategoryTreeStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_category_tree_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCategoryTreeStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CategoryStorage\\Persistence\\SpyCategoryTreeStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CategoryStorage.Persistence.SpyCategoryTreeStorage';

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
     * the column name for the id_category_tree_storage field
     */
    public const COL_ID_CATEGORY_TREE_STORAGE = 'spy_category_tree_storage.id_category_tree_storage';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_category_tree_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_category_tree_storage.store';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_category_tree_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_category_tree_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_category_tree_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_category_tree_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_category_tree_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCategoryTreeStorage', 'Data', 'Store', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCategoryTreeStorage', 'data', 'store', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE, SpyCategoryTreeStorageTableMap::COL_DATA, SpyCategoryTreeStorageTableMap::COL_STORE, SpyCategoryTreeStorageTableMap::COL_LOCALE, SpyCategoryTreeStorageTableMap::COL_ALIAS_KEYS, SpyCategoryTreeStorageTableMap::COL_KEY, SpyCategoryTreeStorageTableMap::COL_CREATED_AT, SpyCategoryTreeStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_category_tree_storage', 'data', 'store', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCategoryTreeStorage' => 0, 'Data' => 1, 'Store' => 2, 'Locale' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idCategoryTreeStorage' => 0, 'data' => 1, 'store' => 2, 'locale' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE => 0, SpyCategoryTreeStorageTableMap::COL_DATA => 1, SpyCategoryTreeStorageTableMap::COL_STORE => 2, SpyCategoryTreeStorageTableMap::COL_LOCALE => 3, SpyCategoryTreeStorageTableMap::COL_ALIAS_KEYS => 4, SpyCategoryTreeStorageTableMap::COL_KEY => 5, SpyCategoryTreeStorageTableMap::COL_CREATED_AT => 6, SpyCategoryTreeStorageTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_category_tree_storage' => 0, 'data' => 1, 'store' => 2, 'locale' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCategoryTreeStorage' => 'ID_CATEGORY_TREE_STORAGE',
        'SpyCategoryTreeStorage.IdCategoryTreeStorage' => 'ID_CATEGORY_TREE_STORAGE',
        'idCategoryTreeStorage' => 'ID_CATEGORY_TREE_STORAGE',
        'spyCategoryTreeStorage.idCategoryTreeStorage' => 'ID_CATEGORY_TREE_STORAGE',
        'SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE' => 'ID_CATEGORY_TREE_STORAGE',
        'COL_ID_CATEGORY_TREE_STORAGE' => 'ID_CATEGORY_TREE_STORAGE',
        'id_category_tree_storage' => 'ID_CATEGORY_TREE_STORAGE',
        'spy_category_tree_storage.id_category_tree_storage' => 'ID_CATEGORY_TREE_STORAGE',
        'Data' => 'DATA',
        'SpyCategoryTreeStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyCategoryTreeStorage.data' => 'DATA',
        'SpyCategoryTreeStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_category_tree_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyCategoryTreeStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyCategoryTreeStorage.store' => 'STORE',
        'SpyCategoryTreeStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_category_tree_storage.store' => 'STORE',
        'Locale' => 'LOCALE',
        'SpyCategoryTreeStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyCategoryTreeStorage.locale' => 'LOCALE',
        'SpyCategoryTreeStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_category_tree_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyCategoryTreeStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyCategoryTreeStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyCategoryTreeStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_category_tree_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyCategoryTreeStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyCategoryTreeStorage.key' => 'KEY',
        'SpyCategoryTreeStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_category_tree_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyCategoryTreeStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCategoryTreeStorage.createdAt' => 'CREATED_AT',
        'SpyCategoryTreeStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_category_tree_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCategoryTreeStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCategoryTreeStorage.updatedAt' => 'UPDATED_AT',
        'SpyCategoryTreeStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_category_tree_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_category_tree_storage');
        $this->setPhpName('SpyCategoryTreeStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CategoryStorage\\Persistence\\SpyCategoryTreeStorage');
        $this->setPackage('src.Orm.Zed.CategoryStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_category_tree_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_category_tree_storage', 'IdCategoryTreeStorage', 'BIGINT', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('store', 'Store', 'VARCHAR', true, 128, null);
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
            'synchronization' => ['resource' => ['value' => 'category_tree'], 'queue_group' => ['value' => 'sync.storage.category'], 'queue_pool' => NULL, 'locale' => ['required' => 'true'], 'store' => ['required' => 'true']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCategoryTreeStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCategoryTreeStorageTableMap::CLASS_DEFAULT : SpyCategoryTreeStorageTableMap::OM_CLASS;
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
     * @return array (SpyCategoryTreeStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCategoryTreeStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCategoryTreeStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCategoryTreeStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCategoryTreeStorageTableMap::OM_CLASS;
            /** @var SpyCategoryTreeStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCategoryTreeStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCategoryTreeStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCategoryTreeStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCategoryTreeStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCategoryTreeStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCategoryTreeStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_category_tree_storage');
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
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCategoryTreeStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_category_tree_storage');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCategoryTreeStorageTableMap::DATABASE_NAME)->getTable(SpyCategoryTreeStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCategoryTreeStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCategoryTreeStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTreeStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CategoryStorage\Persistence\SpyCategoryTreeStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCategoryTreeStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCategoryTreeStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCategoryTreeStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCategoryTreeStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_category_tree_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCategoryTreeStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCategoryTreeStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCategoryTreeStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTreeStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCategoryTreeStorage object
        }

        if ($criteria->containsKey(SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE) && $criteria->keyContainsValue(SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCategoryTreeStorageTableMap::COL_ID_CATEGORY_TREE_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyCategoryTreeStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
