<?php

namespace Orm\Zed\FileManagerStorage\Persistence\Map;

use Orm\Zed\FileManagerStorage\Persistence\SpyFileStorage;
use Orm\Zed\FileManagerStorage\Persistence\SpyFileStorageQuery;
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
 * This class defines the structure of the 'spy_file_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyFileStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.FileManagerStorage.Persistence.Map.SpyFileStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_file_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyFileStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\FileManagerStorage\\Persistence\\SpyFileStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.FileManagerStorage.Persistence.SpyFileStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_file_storage field
     */
    public const COL_ID_FILE_STORAGE = 'spy_file_storage.id_file_storage';

    /**
     * the column name for the fk_file field
     */
    public const COL_FK_FILE = 'spy_file_storage.fk_file';

    /**
     * the column name for the file_name field
     */
    public const COL_FILE_NAME = 'spy_file_storage.file_name';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_file_storage.data';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_file_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_file_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_file_storage.key';

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
        self::TYPE_PHPNAME       => ['IdFileStorage', 'FkFile', 'FileName', 'Data', 'Locale', 'AliasKeys', 'Key', ],
        self::TYPE_CAMELNAME     => ['idFileStorage', 'fkFile', 'fileName', 'data', 'locale', 'aliasKeys', 'key', ],
        self::TYPE_COLNAME       => [SpyFileStorageTableMap::COL_ID_FILE_STORAGE, SpyFileStorageTableMap::COL_FK_FILE, SpyFileStorageTableMap::COL_FILE_NAME, SpyFileStorageTableMap::COL_DATA, SpyFileStorageTableMap::COL_LOCALE, SpyFileStorageTableMap::COL_ALIAS_KEYS, SpyFileStorageTableMap::COL_KEY, ],
        self::TYPE_FIELDNAME     => ['id_file_storage', 'fk_file', 'file_name', 'data', 'locale', 'alias_keys', 'key', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdFileStorage' => 0, 'FkFile' => 1, 'FileName' => 2, 'Data' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, ],
        self::TYPE_CAMELNAME     => ['idFileStorage' => 0, 'fkFile' => 1, 'fileName' => 2, 'data' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, ],
        self::TYPE_COLNAME       => [SpyFileStorageTableMap::COL_ID_FILE_STORAGE => 0, SpyFileStorageTableMap::COL_FK_FILE => 1, SpyFileStorageTableMap::COL_FILE_NAME => 2, SpyFileStorageTableMap::COL_DATA => 3, SpyFileStorageTableMap::COL_LOCALE => 4, SpyFileStorageTableMap::COL_ALIAS_KEYS => 5, SpyFileStorageTableMap::COL_KEY => 6, ],
        self::TYPE_FIELDNAME     => ['id_file_storage' => 0, 'fk_file' => 1, 'file_name' => 2, 'data' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdFileStorage' => 'ID_FILE_STORAGE',
        'SpyFileStorage.IdFileStorage' => 'ID_FILE_STORAGE',
        'idFileStorage' => 'ID_FILE_STORAGE',
        'spyFileStorage.idFileStorage' => 'ID_FILE_STORAGE',
        'SpyFileStorageTableMap::COL_ID_FILE_STORAGE' => 'ID_FILE_STORAGE',
        'COL_ID_FILE_STORAGE' => 'ID_FILE_STORAGE',
        'id_file_storage' => 'ID_FILE_STORAGE',
        'spy_file_storage.id_file_storage' => 'ID_FILE_STORAGE',
        'FkFile' => 'FK_FILE',
        'SpyFileStorage.FkFile' => 'FK_FILE',
        'fkFile' => 'FK_FILE',
        'spyFileStorage.fkFile' => 'FK_FILE',
        'SpyFileStorageTableMap::COL_FK_FILE' => 'FK_FILE',
        'COL_FK_FILE' => 'FK_FILE',
        'fk_file' => 'FK_FILE',
        'spy_file_storage.fk_file' => 'FK_FILE',
        'FileName' => 'FILE_NAME',
        'SpyFileStorage.FileName' => 'FILE_NAME',
        'fileName' => 'FILE_NAME',
        'spyFileStorage.fileName' => 'FILE_NAME',
        'SpyFileStorageTableMap::COL_FILE_NAME' => 'FILE_NAME',
        'COL_FILE_NAME' => 'FILE_NAME',
        'file_name' => 'FILE_NAME',
        'spy_file_storage.file_name' => 'FILE_NAME',
        'Data' => 'DATA',
        'SpyFileStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyFileStorage.data' => 'DATA',
        'SpyFileStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_file_storage.data' => 'DATA',
        'Locale' => 'LOCALE',
        'SpyFileStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyFileStorage.locale' => 'LOCALE',
        'SpyFileStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_file_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyFileStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyFileStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyFileStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_file_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyFileStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyFileStorage.key' => 'KEY',
        'SpyFileStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_file_storage.key' => 'KEY',
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
        $this->setName('spy_file_storage');
        $this->setPhpName('SpyFileStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\FileManagerStorage\\Persistence\\SpyFileStorage');
        $this->setPackage('src.Orm.Zed.FileManagerStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_file_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_file_storage', 'IdFileStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_file', 'FkFile', 'INTEGER', false, null, null);
        $this->addColumn('file_name', 'FileName', 'VARCHAR', false, 500, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 16, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'file'], 'queue_group' => ['value' => 'sync.storage.file'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'fk_file']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdFileStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyFileStorageTableMap::CLASS_DEFAULT : SpyFileStorageTableMap::OM_CLASS;
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
     * @return array (SpyFileStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyFileStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyFileStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyFileStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyFileStorageTableMap::OM_CLASS;
            /** @var SpyFileStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyFileStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyFileStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyFileStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyFileStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyFileStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_ID_FILE_STORAGE);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_FK_FILE);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_FILE_NAME);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyFileStorageTableMap::COL_KEY);
        } else {
            $criteria->addSelectColumn($alias . '.id_file_storage');
            $criteria->addSelectColumn($alias . '.fk_file');
            $criteria->addSelectColumn($alias . '.file_name');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.alias_keys');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_ID_FILE_STORAGE);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_FK_FILE);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_FILE_NAME);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyFileStorageTableMap::COL_KEY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_file_storage');
            $criteria->removeSelectColumn($alias . '.fk_file');
            $criteria->removeSelectColumn($alias . '.file_name');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.locale');
            $criteria->removeSelectColumn($alias . '.alias_keys');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyFileStorageTableMap::DATABASE_NAME)->getTable(SpyFileStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyFileStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyFileStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\FileManagerStorage\Persistence\SpyFileStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyFileStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyFileStorageTableMap::COL_ID_FILE_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyFileStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyFileStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyFileStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_file_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyFileStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyFileStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyFileStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyFileStorage object
        }

        if ($criteria->containsKey(SpyFileStorageTableMap::COL_ID_FILE_STORAGE) && $criteria->keyContainsValue(SpyFileStorageTableMap::COL_ID_FILE_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyFileStorageTableMap::COL_ID_FILE_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyFileStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
